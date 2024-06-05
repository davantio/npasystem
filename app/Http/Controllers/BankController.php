<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bank;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = bank::all();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return "
            <button type='button' class='btn btn-default'>Action</button>
            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-bank='$data->bank' data-kode='$data->kode' data-rekening='$data->rekening' data-nama='$data->atas_nama' data-target='#modal-hapus'><b>Hapus</b></a>
            </div>
            ";            
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastkode(Request $request)
    {

    }
    public function dropdownbank(Request $request)
    {
        
        try {
            $bank = [];
            if($request->has('q')){
                $search = $request->q;
                $bank =bank::select("kode","bank","rekening","atas_nama")
                        ->where('bank', 'LIKE', "%$search%")
                        ->orWhere('rekening','LIKE', "%$search%")
                        ->orWhere('atas_nama','LIKE', "%$search%")
                        ->get();
            } else {
                $bank = bank::select("kode","bank","rekening","atas_nama")
                        ->get();
            }
            return response()->json($bank);
        } catch (\Exception $e) {
            
            return $e->getMessage();
        }
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
        //
        try{
            $bank = new bank();
            $bank->bank = $request->bank;
            $bank->rekening = $request->rekening;
            $bank->atas_nama = $request->an;
            $bank->created_at = $request->time;
            $bank->save();

            $bank = bank::select('kode')->orderBy('kode','Desc')->first();
            
            $log = new log_sistem();
            $log->transaksi = $bank->kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Bank";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
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
    public function edit($id)
    {
        //
        try{
            $data = bank::where('kode',$id)->first();
            return response()->json(['success'=>true,'data'=> $data]);
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
    public function update(Request $request, $kode)
    {
        //
        try{
            DB::table('bank')
            ->where('kode', $kode)
            ->update(['bank'=> $request->bank,'rekening'=> $request->rekening,'atas_nama'=>$request->an,'updated_at'=>$request->time]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Bank";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        try{
            bank::where('kode',$id)->delete();
            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Bank";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
