<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\tender_pejabat;
use App\Models\tender_instansi;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;

class InstansiTenderController extends Controller
{
    public function index()
    {
        $login = Auth::user();
        if($login){
            $data = tender_instansi::orderBy('nama', 'ASC')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return "
                <div class='row'>
                    <button type='button' style='margin-right:1px' class='btn btn-warning editinstansi' data-kode='$data->id'><i class='fas fa-edit'></i></button>
                    <button type='button' class='btn btn-danger hapusinstansi' data-kode='$data->id' data-nama = '$data->nama'><i class='fas fa-trash-alt'></i></button>
                </div>
                ";            
            })->make(true);
        }else {
            
        }
        
        
    }
    public function dropdown(Request $request)
    {
        $gdg = [];
        if($request->has('q')){
            $search = $request->q;
            $gdg = tender_instansi::select("nama")
            		->where('nama', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $gdg = tender_instansi::select("nama")
                    ->distinct()
            		->get();
            $new = ['id'=> "baru",'nama' => "Baru"];
            $gdg->push($new);
        }
        return response()->json($gdg);
    }
    
    
    public function store (Request $request)
    {
        try{
            $login = Auth::user();
            if($login){
                
                $id = tender_instansi::max('id');
                $nid = $id+1;
                $new = new tender_instansi();
                $new->id        = $nid;
                if($request->tambahnamainstansi == "baru"){
                    $instansi = $request->tambah_nama_instansi;
                } else {
                    $instansi = $request->tambahnamainstansi;
                }
                //cek sub instansi
                $namaSubInstansi = strtolower($request->tambah_sub_instansi); // Mengubah input menjadi huruf kecil

                $cekSubInstansi = tender_instansi::whereRaw('LOWER(sub_instansi) = ?', [$namaSubInstansi])->exists();
                
                if ($cekSubInstansi) {
                    // Sub instansi ditemukan dalam tabel
                    return response()->json(['success'=>false,'pesan'=>"Nama Sub Instansi Telah Tersedia"]);
                } else {
                    // Sub instansi tidak ditemukan dalam tabel
                    $new->nama      = $instansi;
                    $new->sub_instansi = $request->tambah_sub_instansi;
                    $new->link      = $request->tambah_link_instansi;
                    $new->username  = $request->tambah_username_instansi;
                    $new->password  = $request->tambah_password_instansi;
                    $new->email     = $request->tambah_email_instansi;
                    $save = $new->save();
                    if($save){
                        $log = new log_sistem();
                        $log->transaksi = $nid;
                        $log->user = $login->kode_karyawan;
                        $log->keterangan = "Tambah Data Instansi Tender";
                        $log->save();
                        
                        return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan"]);    
                    } else {
                        
                        return response()->json(['success'=>false,'pesan'=>"Gagal Tambah Instansi Tender"]);    
                    }
                }
                
            } else {
                return response()->json(['success'=>false,'pesan'=>"Anda Tidak Memiliki Akses"]);
            }
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function dropdowninstansi(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = tender_instansi::select('nama')
            		->where('kategori', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $data = tender_instansi::select('nama')
                    ->distinct()
            		->get();
            $new = ['nama' => "baru"];
            $data->push($new);
        }
        return response()->json($data);
    }
    public function show ($id)
    {
        
    }
    public function dropdown_subinstansi(Request $request,$nama)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = tender_instansi::select('id','sub_instansi')
            		->where('sub_instansi', 'LIKE', "%$search%")
            		->where('nama',$nama)
            		->distinct()
            		->get();
        } else {
            $data = tender_instansi::select('id','sub_instansi')
                    ->where('nama',$nama)
                    ->distinct()
            		->get();
        }
        return response()->json($data);
    }
    public function subinstansi($nama)
    {
        try{
            $data = tender_instansi::select('id','sub_instansi')->where('nama',$nama)->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function edit ($id)
    {
        try{
            $data = tender_instansi::where('id',$id)->first();
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
            //cek sub instansi
                $namaSubInstansi = strtolower($request->sub_instansi); // Mengubah input menjadi huruf kecil

                $cekSubInstansi = tender_instansi::whereRaw('LOWER(sub_instansi) = ?', [$namaSubInstansi])->exists();
            if($cekSubInstansi){
                // Sub instansi ditemukan dalam tabel
                return response()->json(['success'=>false,'pesan'=>"Nama Sub Instansi Telah Tersedia"]);
            } else {
                $subinstansi = $request->sub_instansi;
            }
            $simpan = 
            DB::table('tender_instansi')->where('id',$id)
            ->update([
                'nama'          => $request->nama,
                'sub_instansi'  => $subinstansi,
                'link'          => $request->link,
                'username'      => $request->username,
                'password'      => $request->password,
                'email'         => $request->email,
                ]);
            ;
            if($simpan){
                $log = new log_sistem();
                $log->transaksi = $id;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Edit Data Instansi Tender";
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
            tender_instansi::where('id',$id)->delete();
            tender_pejabat::where('instansi',$id)->delete();
            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Hapus Data Instansi Tender";
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