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

class PejabatTenderController extends Controller
{
    public function index()
    {
        $login = Auth::user();
        if($login){
            $data = tender_pejabat::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('instansi',function($data){
                $nama = tender_instansi::select('nama')->where('id',$data->instansi)->first();
                return $nama->nama;
            })
            ->addColumn('action', function($data){
                return "
                <div class='row'>
                    <button type='button' class='btn btn-info detailpejabat' data-kode='$data->id'><i class='fas fa-eye'></i></button>
                    <button type='button' class='btn btn-warning editpejabat' data-kode='$data->id'><i class='fas fa-edit'></i></button>
                    <button type='button' class='btn btn-danger hapuspejabat' data-kode='$data->id' data-nama = '$data->nama'><i class='fas fa-trash-alt'></i></button>
                </div>
                ";            
            })->make(true);
        }else {
            
        }
        
        
    }
    public function dropdown($instansi,Request $request)
    {
        $gdg = [];
        if($request->has('q')){
            $search = $request->q;
            $gdg = tender_pejabat::select("id","nama")
            		->where('nama', 'LIKE', "%$search%")
            		->where('instansi',$instansi)
            		->get();
        } else {
            $gdg = tender_pejabat::select("id","nama")
                    ->where('instansi',$instansi)
            		->get();
        }
        return response()->json($gdg);
    }
    
    
    public function store (Request $request)
    {
        try{
            $login = Auth::user();
            if($login){
                $validatedData = $request->validate([
                    'tambah_foto_pejabat' => 'image|max:5000'
                ]);
                
                $id = tender_pejabat::max('id');
                $nid = $id+1;
                
                $data = new tender_pejabat;
                $data->id = $nid;
                $data->instansi = $request->tambah_instansi_pejabat;
                $data->nama = $request->tambah_nama_pejabat;
                $data->jabatan = $request->tambah_jabatan_pejabat;
                $data->telp = $request->tambah_telp_pejabat;
                $data->alamat = $request->tambah_alamat_pejabat;
                $data->sosmed = $request->tambah_sosmed_pejabat;
                $data->hobby = $request->tambah_hobby_pejabat;
                if ($request->hasFile('tambah_foto_pejabat')) {
                    $foto = $request->file('tambah_foto_pejabat');
                    $nama_foto = $foto->getClientOriginalName();
                    $file = public_path('img/tender/'.$nama_foto);
                    if(file_exists($file)){
                        return response()->json(['sucess'=>false,'pesan'=>"File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                    } else {
                        $foto->move(public_path('img/tender'), $nama_foto);
                        $data->foto = $nama_foto;    
                    }
                    
                }
                $save = $data->save();
                if($save){
                    $log = new log_sistem();
                    $log->transaksi = $nid;
                    $log->user = $login->kode_karyawan;
                    $log->keterangan = "Tambah Data Pejabat Tender";
                    $log->save();
                    return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Tambah Data Pejabat"]);
                }
                
                
                
            } else {
                return response()->json(['success'=>false,'pesan'=>"Anda Tidak Memiliki Akses"]);
            }
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function show ($id)
    {
        $login = Auth::user();
        if($login){
            $data = tender_pejabat::where('instansi',$id)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('instansi',function($data){
                $nama = tender_instansi::select('nama')->where('id',$data->instansi)->first();
                return $nama->nama;
            })
            ->addColumn('action', function($data){
                return "
                <div class='row'>
                    <button type='button' class='btn btn-info detailpejabat' data-kode='$data->id'><i class='fas fa-eye'></i></button>
                    <button type='button' class='btn btn-warning editpejabat' data-kode='$data->id'><i class='fas fa-edit'></i></button>
                    <button type='button' class='btn btn-danger hapuspejabat' data-kode='$data->id' data-nama = '$data->nama'><i class='fas fa-trash-alt'></i></button>
                </div>
                ";            
            })->make(true);
        }else {
            
        }
    }
    public function edit ($id)
    {
        try{
            $data = tender_pejabat::where('id',$id)->first();
            $instansi = tender_instansi::select('nama')->where('id',$data->instansi)->first();
            $data->namainstansi = $instansi->nama;
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            
            return response()->json(['success'=>false,'pesan'=>$request->edit_nama_pejabat]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy ($id)
    {
        try{
            $login = Auth::user();
            $data = tender_pejabat::where('id',$id)->first();
            $file = $data->foto;
            
            if($file !== null){
                unlink($file);    
            } else {
            
            }
            tender_pejabat::where('id',$id)->delete();
            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Hapus Pejabat Tender";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}