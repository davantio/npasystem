<?php

namespace App\Http\Controllers;
use App\Models\gudang;
use App\Models\log_sistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Exception;
use stdClass;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = gudang::all();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return "
            <div class='row'>
                <button type='button' class='btn btn-default'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-dtl-gdg'><b>Detail</b></a>
                    <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edt-gdg'><b>Edit</b></a>
                    <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-target='#modal-hps-gdg'><b>Hapus</b></a>
                </div>
            </div>
            ";            
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dropdown(Request $request)
    {
        $gdg = [];
        if($request->has('q')){
            $search = $request->q;
            $gdg = gudang::select("kode","nama")
            		->where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $gdg = gudang::select("kode","nama")
            		->get();
        }
        return response()->json($gdg);
    }
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
        
        try{
            $gudang = new gudang();
            $gudang->kode = $request->kode;
            $gudang->nama = $request->nama;
            $gudang->alamat = $request->alamat;
            $gudang->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Gudang";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(Exception $e){
            return response()->json(['success'=>true,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        try{
            $data = gudang::where('kode',$kode)->first();
            return response()->json(['success'=>true,'result'=> $data]);
        } catch(Exception $e){
            return response()->json(['success'=>true,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        //
        try{
            $gudang = gudang::where('kode',$kode)->first();
            $gudang->kode = $request->kode;
            $gudang->nama = $request->nama;
            $gudang->alamat = $request->alamat;
            
            DB::table('gudang')
            ->where('kode', $kode)
            ->update(['nama' =>$gudang->nama, 'alamat' => $gudang->alamat]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Gudang";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(Exception $e){
            return response()->json(['success'=>true,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$kode)
    {
        //
        try{
            gudang::where('kode',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Gudang";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(Exception $e){
            return response()->json(['success'=>true,'pesan'=>$e->getMessage()]);
        }
       
    }
}
