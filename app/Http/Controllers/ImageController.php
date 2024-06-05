<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lapmarketing;
use App\Models\karyawan;
use App\Models\log_sistem;
use App\Models\detail_laporan;
use App\Models\image;
use App\Models\target_marketing;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Response;
use Throwable;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = image::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image',function($data){
                return"
                    <img class='img-fluid img-square'style='width:50%;'src='{{asset('img')}}/$data->url'>
                ";
            })
            ->addColumn('action', function($data){
                return "
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->id' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";   
                
            })->make(true);
        
        //
        
    }

    public function laporan($id)
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    
    
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'image' => 'required|image|max:5000|mimes:png,jpeg,jpg',
            ]);
            return response()->json(['success'=>false,'pesan'=>$request->nama]);
            // if($request->hasFile('image')){
            //     $foto = $request->file('image');
            //     $nama = $foto->getClientOriginalName();
            //     $data = image::where('nama',$request->nama)->OrWhere('url',$nama)->first();
            //     if($data){
            //         return response()->json(['success'=>false,'pesan'=>"Nama Atau File yang di Upload Telah Tersedia"]);    
            //     } else {
            //         $file = public_path('img/'.$nama);
            //         if(file_exists($file)){
            //             return response()->json(['success'=>false,'pesan'=>"File Sudah Tersimpan di server"]);
            //             // unlink($file);
            //             // $foto->move(public_path('img/'), $nama_foto);
            //         } else {
            //             $image = new image();
            //             $image->nama = $request->nama;
            //             $image->url = $nama;
            //             $simpan = $image->save();
            //             if($simpan){
            //                 $foto->move(public_path('img/'), $nama);
            //                 $login = Auth::user();
            //                 $log = new log_sistem();
            //                 $log->transaksi = "library_image.".$nama;
            //                 $log->user = $login->kode_karyawan;
            //                 $log->keterangan = "Tambah Library Image";
            //                 $logs= $log->save();
            //                 if($logs){
                                
            //                     return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan"]);
            //                 } else {
            //                     return response()->json(['success'=>false,'pesan'=>"error tambah log"]);
            //                 }
            //             } else {
            //                 return response()->json(['success'=>false,'pesan'=>"Error Simpan Image"]);
            //             }
                        
            //         }
            //     }
            //     // $mimeType = $foto->getMimeType();
            //     // $pisah = Str::after($mimeType, '/');
            //     // 
                
            // } else {
            //     return response()->json(['success'=>false,'pesan'=>"Image Wajib Disertakan"]);
            // }
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //
        try {
            $data =image::find($kode);
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $login = Auth::user();
            $request->validate([
                'edit-image' => 'image|max:5000|mimes:png,jpeg,jpg',
            ]);
            if($request->hasFile('edit-image')){
                $foto = $request->file('edit-image');
                $nama = $foto->getClientOriginalName();
                $cek = image::where('nama',$request->edit-nama)->OrWhere('url',$nama)->first();
                if($cek){
                    return response()->json(['success'=>false,'pesan'=>"Nama  atau File yang anda upload telah tersedia"]);
                } else {
                    $data = image::find($id);
                    $data->nama = $request->edit-nama;
                    $data->url = $nama;
                    $save = $data->save();
                    if($save){
                        $foto->move(public_path('img/'), $nama);
                        $log = new log_sistem();
                        $log->transaksi = "library_image.".$request->edit-nama;
                        $log->user      = $login->kode_karyawan;
                        $log->keterangan = "Update Library Image";
                        $log->save();
                        return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diupdate"]);
                    } else {
                        return response()->json(['success'=>false,'pesan'=>"Error Update Library Image"]);
                    }
                    
                }
            } else {
                $data = image::find($id);
                $data->nama = $request->edit-nama;
                $save = $data->save();
                if($save){
                    $log = new log_sistem();
                    $log->transaksi = "library_image.".$request->edit-nama;
                    $log->user      = $login->kode_karyawan;
                    $log->keterangan = "Update Library Image";
                    $log->save();
                    return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diupdate"]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Update Library Image"]);
                }
            }
        }catch (\Exception $e){
           return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy(Request $request, $id)
    {
        //
        try{
            $login = Auth::user();
            $image = image::find($id);
            $url = $image->url;
            $file = public_path('img/'.$url);
            unlink($file);
            $log = new log_sistem();
            $log->transaksi = "library_image.".$image->nama;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Hapus Data Library Image";
            $log->save();
            image::where('id',$id)->delete();
            
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
