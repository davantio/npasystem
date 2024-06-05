<?php

namespace App\Http\Controllers;

use App\Imports\BarangImport;
use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Throwable;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = barang::all();
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
    public function lastkode()
    {
        $last = barang::max('kode');
        $H  = intval($last);
        $N = $H+1;
        $newkode = sprintf('%09s',$N);
        return response($newkode);
    }
    public function dropdownbarang(Request $request)
    {
        $barang = [];
        if($request->has('q')){
            $search = $request->q;
            $barang =barang::select("kode", "nama")
            		->where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $barang = barang::select("kode", "nama")
            		->get();
        }
        $all['kode']="all";
        $all['nama']='All';
        $barang[] = $all;
        return response()->json($barang);
    }
    public function importbarang(Request $request)
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
    public function uploadbarang(Request $request)
    {
        try{
            $this->validate($request, [
                'upload-file' => 'required|mimes:xls,xlsx'
            ]);
    
            $file = $request->file('upload-file');
            $n = 0;
            // $data = Excel::import(new BarangImport,$file);
            $data = Excel::toCollection(new BarangImport, $file);
            foreach($data AS $D){
                $n++;
            }
            return response()->json(['success'=>true,'data'=>$data,'pesan'=>$n]);

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
            $last = barang::max('kode');
            $H  = $last+1;
            $newkode = sprintf('%09s',$H);

            $barang = new barang();
            $barang->kode = $newkode;
            $barang->nama = $request->nama;
            $barang->jenis = $request->jenis;
            $barang->satuan = $request->satuan;
            $barang->perusahaan = $request->perusahaan;
            $barang->keterangan = $request->keterangan;
            if($request->packing == "BARU"){
                $packing = strtoupper($request->packingnew);
                $barang->packing = $packing;
            } else {
                $packing = strtoupper($request->packing);
                $barang->packing = $packing;
            }
            if($barang->jenis == "CAIR"){
                $barang->kd_persediaan = "170.1";
            }elseif($barang->jenis == "PADAT"){
                $barang->kd_persediaan = "170.2";
            }elseif($barang->jenis == "GAS"){
                $barang->kd_persediaan = "170.3";
            }else {
                $barang->kd_persediaan = "170.4";
            }
            $barang->kd_persediaan_hpp = "410";
            $barang->kd_pendapatan = "400";
            $barang->kd_persediaan_intransit = "172";
            $barang->save();

            $log = new log_sistem();
            $log->transaksi = $newkode;
            $log->user      = $request->user;
            $log->keterangan = "Tambah Data Barang";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
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
            $data = barang::where('kode',$kode)->first();
            $akuntansi = DB::table('kodeakuntansi')->where('kode',$data->kd_persediaan)->first();
            return response()->json(['success'=> true ,'result'=> $data,'akuntansi'=>$akuntansi]);
        } catch(Exception $e){
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
            $barang = barang::where('kode',$kode)->first();
            $barang->kode = $request->kode;
            $barang->nama = $request->nama;
            $barang->jenis = $request->jenis;
            $barang->satuan = $request->satuan;
            $barang->perusahaan = $request->perusahaan;
            $barang->keterangan = $request->keterangan;
            if($request->packing == "BARU"){
                $packing = strtoupper($request->packingnew);
                $barang->packing = $packing;
            } else {
                $packing = strtoupper($request->packing);
                $barang->packing = $packing;
            }
            if($barang->jenis == "CAIR"){
                $barang->kd_persediaan = "170.1";
            }elseif($barang->jenis == "PADAT"){
                $barang->kd_persediaan = "170.2";
            }elseif($barang->jenis == "GAS"){
                $barang->kd_persediaan = "170.3";
            }else {
                $barang->kd_persediaan = "170.4";
            }
            $barang->kd_persediaan_hpp = "410";
            $barang->kd_pendapatan = "400";
            $barang->kd_persediaan_intransit = "172";
            
            DB::table('barang')
            ->where('kode', $kode)
            ->update(['nama' =>$barang->nama, 'jenis' => $barang->jenis,'satuan' => $barang->satuan,
            'perusahaan' => $barang->perusahaan,'packing' => $barang->packing,'keterangan' => $barang->keterangan,
            'kd_persediaan' => $barang->kd_persediaan, 'kd_persediaan_hpp' => $barang->kd_persediaan_hpp,
            'kd_persediaan_intransit' => $barang->kd_persediaan_intransit,'kd_pendapatan' => $barang->kd_pendapatan,]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user      = $request->user;
            $log->keterangan = "Edit Data Barang";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
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
        try{
            DB::table('barang')
            ->where('kode', $kode)
            ->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user      = $request->user;
            $log->keterangan = "Hapus Data Barang";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
