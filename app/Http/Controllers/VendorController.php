<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class VendorController extends Controller
{
    public function index()
    {
        $login = Auth::user();
        if($login->level == "superadmin" || $login->level == "ceo" || $login->level == "admin" ||$login->level == "manager-admin")
        {
            $data = vendor::orderBy('updated_at','DESC')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                    <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                    <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                </div>
                ";            
            })->make(true);  
        }
        else if( $login->level == "staff-gudang" || $login->level == "manager-operasional")
        {
            $data = vendor::orderBy('updated_at','DESC')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                    <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                </div>
                ";            
            })->make(true);    
        }
        else 
        {
            
        }
        
    }
    public function lastupdate()
    {
        try{
            $data = vendor::orderBy('updated_at','DESC')->first();
            if($data == null){
                $last = "Data Belum Tersedia";
                return response()->json(['success'=>true,'data'=>$last]);    
            } else {
                $last = $data->updated_at;
                return response()->json(['success'=>true,'data'=>$last]);    
            }
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function store (Request $request)
    {
        try{
            $login = Auth::user();
            
            $last = vendor::select('id')->orderBy('id','DESC')->first();
            if(!$last){
                $nkode = 1;
            } else {
                $nkode = $last->id+1;
            }
            //cek
                $nama = strtolower($request->nama);
                $produk = strtolower($request->produk);
                $cek = vendor::where('nama','LIKE',$nama.'%')->where('produk','LIKE',$produk.'%')->first();
                if($cek){
                    return response()->json(['success'=>false,'pesan'=>"Nama Vendor sudah tersedia silahkan gunakan nama lain"]);
                } else {
                    
                }
            //cek
            $vendor = new vendor();
            $vendor->id = $nkode;
            $vendor->nama = $request->nama;
            $vendor->produk = $request->produk;
            $vendor->telepon = $request->telepon;
            $vendor->alamat = $request->alamat;
            $vendor->keterangan = $request->keterangan;
            $save = $vendor->save();
            if($save){
                $log = new log_sistem();
                $log->transaksi = $nkode;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Tambah Data Vendor";
                $resultlog = $log->save();
                if($resultlog){
                    return response()->json(['success'=>true,'pesan'=> "Data Berhasil Ditambahkan"]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Simpan Log"]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Simpan Vendor"]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function show ($id)
    {
        
    }
    public function edit ($id)
    {
        try{
            $data = vendor::where('id',$id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            
            $login = Auth::user();
            // return response()->json(['success'=>false,'pesan'=>$login]);
            $simpan = 
            DB::table('vendor')->where('id',$id)
            ->update([
                'nama'          => $request->nama,
                'produk'        => $request->produk,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'keterangan'    => $request->keterangan,
                ]);
            ;
            if($simpan){
                $log = new log_sistem();
                $log->transaksi = $id;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Edit Data Vendor";
                $resultlog = $log->save();
                if($resultlog){
                    return response()->json(['success'=>true,'pesan'=> "Data Berhasil Diubah"]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Simpan Log"]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Update Data"]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy ($id)
    {
        try{
            $login = Auth::user();
            vendor::where('id',$id)->delete();
            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Hapus Data Vendor";
            $resultlog = $log->save();
            if($resultlog){
                return response()->json(['success'=>true,'pesan'=> "Data Berhasil Dihapus"]);
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Simpan Log"]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}