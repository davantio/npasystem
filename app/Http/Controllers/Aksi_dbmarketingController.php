<?php

namespace App\Http\Controllers;

use App\Imports\DBmarketingImport;
use Illuminate\Http\Request;
use App\Models\log_sistem;
use App\Models\db_marketing;
use App\Models\karyawan;
use App\Models\aksi_dbmarketing;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Response;

class Aksi_dbmarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan','database_marketing.kategori AS kategori','karyawan.nama AS marketing')
            ->leftJoin('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
            ->leftJoin('karyawan','aksi_dbmarketing.kd_marketing','=','karyawan.kode')
            ->orderBy('id','desc')
            ->get();
    
        return DataTables::of($data)
        ->addIndexColumn()->make(true);
    }
    public function filter_aksidb(Request $request)
    {
        try{
            $data = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan','database_marketing.kategori AS kategori','karyawan.nama AS marketing')
                ->leftJoin('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
                ->leftJoin('karyawan','aksi_dbmarketing.kd_marketing','=','karyawan.kode')
                ->whereBetween('aksi_dbmarketing.tanggal',[$request->awal,$request->akhir])
                ->where('aksi_dbmarketing.kd_marketing',$request->marketing)
                ->orderBy('id','desc')
                ->get();
        
            $file =  DataTables::of($data)
            ->addIndexColumn()->make(true);    
            return response()->json(['success'=>true,'data'=>$file]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
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
        try{
            $kode = aksi_dbmarketing::select('id')->orderBy('id','DESC')->first();
            if($kode == null){
                $nkode = 1;
            }else {
                $nkode = $kode->id+1;
            }
            
            $data = new aksi_dbmarketing();
            $data->id = $nkode;
            $data->kd_perusahaan = $request->kd_perusahaan;
            $data->kd_marketing  = $request->kd_marketing;
            $data->tanggal       = $request->tanggal;
            $data->jam           = $request->jam;
            $data->laporan       = $request->laporan;
            $data->save();
            
            $log = new log_sistem();
            $log->transaksi = "Aksi DB Marketing ".$request->kd_perusahaan.$nkode;
            $log->user      = $request->user;
            $log->keterangan = "Tambah Data Aksi DB Marketing";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan"]);
        } catch(\Exception $e){
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
        try{
            $data = aksi_dbmarketing::select('aksi_dbmarketing.*','karyawan.nama')
                    ->join('karyawan','aksi_dbmarketing.kd_marketing','=','karyawan.kode')
                    ->where('aksi_dbmarketing.kd_perusahaan',$id)->get();
                    
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
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
            $data = aksi_dbmarketing::select('aksi_dbmarketing.*','karyawan.nama')
                    ->join('karyawan','aksi_dbmarketing.kd_marketing','=','karyawan.kode')
                    ->where('aksi_dbmarketing.id',$id)->first();
                    
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
            $data = aksi_dbmarketing::where('id',$id)->first();
            DB::table('aksi_dbmarketing')->where('id',$id)
            ->update([
                'tanggal' =>$request->tanggal, 
                'jam' => $request->jam,
                'laporan' => $request->laporan,
            ]);
            
            $log = new log_sistem();
            $log->transaksi = "Aksi DB Marketing ".$data->kd_perusahaan.$id;
            $log->user      = $request->user;
            $log->keterangan = "Edit Data Aksi DB Marketing";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);   
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
            $data = aksi_dbmarketing::where('id',$id)->first();
            $hapus = aksi_dbmarketing::where('id',$id)->delete();
            if(!$hapus){
                return response()->json(['success'=>false,'pesan'=>"Data Gagal Dihapus"]);
            } else {
                $log = new log_sistem();
                $log->transaksi = "Aksi DB Marketing ".$data->kd_perusahaan.$id;
                $log->user      = $request->user;
                $log->keterangan = "Hapus Data Aksi DB Marketing";
                $log->save();
                return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);    
            }
            
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
