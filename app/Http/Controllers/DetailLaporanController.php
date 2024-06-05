<?php

namespace App\Http\Controllers;

use App\Models\db_marketing;
use App\Models\detail_laporan;
use App\Models\log_sistem;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $last = detail_laporan::latest('kode')->first();
            if(!$last){
                $kode = 1;
            }else {
                $kode = $last->kode+1;
            }
            $data = new detail_laporan();
            $data->kode     = $kode;
            $data->kode_laporan = $request->kode;
            $data->jenis        = $request->jenis;
            $data->jam          = $request->jam;
            $data->perusahaan   = $request->perusahaan;
            $data->rekanan      = $request->rekanan;
            $data->laporan      = $request->laporan;
            $data->save();
            
            $log = new log_sistem();
            $log->transaksi = $request->kode.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail Laporan Harian Marketing";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);
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
    public function show($id)
    {
        //
        try{
            $data = detail_laporan::select('detail_laporan.*','database_marketing.nama_perusahaan')
                    ->join('database_marketing','detail_laporan.perusahaan','database_marketing.kode')
                    ->where('detail_laporan.kode_laporan',$id)->get();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e){
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
            $data = detail_laporan::select('detail_laporan.*','database_marketing.nama_perusahaan')
                    ->join('database_marketing','detail_laporan.perusahaan','database_marketing.kode')
                    ->where('detail_laporan.kode',$id)->first();
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
            //DETAIL
            DB::table('detail_laporan')->where('kode',$id)
            ->update([
                'jenis'      => $request->jenis,
                'perusahaan' => $request->perusahaan,
                'jam'        => $request->jam,
                'rekanan'    => $request->rekanan,
                'laporan'    => $request->laporan,
            ]);
            //LOG
            $log = new log_sistem();
            $log->transaksi = $request->kode.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail Laporan Harian Marketing";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapuslaporan($kode)
    {
        try{
            detail_laporan::where('kode_laporan',$kode)->delete();
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy(Request $request,$id)
    {
        //
        try{
            $data = detail_laporan::where('kode',$id)->first();
            
            $log = new log_sistem();
            $log->transaksi = $data->kode_laporan.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail Laporan Harian Marketing";
            $log->save();
            
            detail_laporan::where('kode',$id)->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
