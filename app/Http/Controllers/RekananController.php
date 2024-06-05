<?php

namespace App\Http\Controllers;

use App\Imports\RekananImport;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\log_sistem;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Response;

class RekananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $data = rekanan::orderBy('kode');
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
                <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-target='#modal-hapus'><b>Hapus</b></a>
            </div>
            ";            
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dropdownsupplier(Request $request)
    {
        $supplier = [];
        if($request->has('q')){
            $search = $request->q;
            $supplier =rekanan::where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $supplier =rekanan::all();
        }
        return response()->json($supplier);
    }
    public function dropdownkonsumen(Request $request)
    {
        $konsumen = [];
        if($request->has('q')){
            $search = $request->q;
            $konsumen =rekanan::where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $konsumen =rekanan::all();
        }
        return response()->json($konsumen);
    }
    
    
    public function lastkode(Request $request)
    {
        $data = DB::table('rekanan')
                ->select('kode')->orderBy('kode','desc')->first();
        $kode = substr($data->kode,5);
        $kode = intval($kode);
        $kode = $kode+1;
        $next = "NP-C-".sprintf('%08s', $kode);
        return $next;
        
    }
    public function importrekanan(Request $request)
    {
        try{
            $this->validate($request, [
                'import-file' => 'required|mimes:xls,xlsx'
            ]);
    
            $file = $request->file('import-file');
            
            // $data = Excel::import($file);
            $n = 0;
            // $data = Excel::import(new BarangImport, $file);
            // foreach($data as $D){
            //     $n++;
            // }

            return response()->json(['success'=>true,'pesan'=>$n]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
    public function uploadrekanan(Request $request)
    {
        try{
            $this->validate($request, [
                'upload-file' => 'required|mimes:xls,xlsx'
            ]);
    
            $file = $request->file('upload-file');
            $n = 0;
            $import = Excel::import(new RekananImport,$file);
            if($import){
                $pesan = "Data Berhasil Ditambahkan";
            } else {
                $pesan = "Data Tidak Berhasil Ditambahkan";
            }
            $data = Excel::toCollection(new RekananImport, $file);
            return response()->json(['success'=>true,'data'=>$data,'pesan'=>$pesan]);

        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
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
            
            //cek kesamaan data nama/ perusahaan
            $rekanan = new rekanan();
            $rekanan->kode = $request->kode;
            // $rekanan->mitra = $request->mitra;
            $rekanan->nama = $request->nama;
            $rekanan->wa = $request->wa;
            $rekanan->nama_perusahaan = $request->perusahaan;
            $rekanan->telp = $request->telp;
            $rekanan->bank = $request->bank;
            $rekanan->email = $request->email;
            // $rekanan->marketing = $request->marketing;
            $rekanan->alamat = $request->alamat;
            $rekanan->nib   = $request->nib;
            $rekanan->npwp  = $request->npwp;
            
            $rekanan->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Rekanan";
            $log->save();
            return response()->json(['success'=> true,'pesan'=>'Data Berhasil Ditambahkan']);    
            
            
        } catch(\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
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
        
        try{
            $data = rekanan::where('kode',$kode)->first();
           return response()->json(['success'=>true,'result'=> $data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
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
            $rekanan = rekanan::where('kode',$kode)->first();
            $rekanan->kode = $request->kode;
            $rekanan->nama = $request->nama;
            $rekanan->wa = $request->wa;
            $rekanan->nama_perusahaan = $request->perusahaan;
            $rekanan->telp = $request->telp;
            $rekanan->bank = $request->bank;
            $rekanan->email = $request->email;
            $rekanan->alamat = $request->alamat;
            
            DB::table('rekanan')
            ->where('kode', $kode)
            ->update(['nama' =>$rekanan->nama,'wa' => $rekanan->wa,
            'nama_perusahaan' => $rekanan->nama_perusahaan,'telp' => $rekanan->telp,'bank' => $rekanan->bank,
            'email' => $rekanan->email,'alamat' =>$rekanan->alamat ,'nib'=>$request->nib,'npwp'=>$request->npwp]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Rekanan";
            $log->save();
            
            return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Ditambahkan']);
        } catch(\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
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
            rekanan::where('kode',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Rekanan";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
        } 
        
    }
}
