<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\suratjalan;
use App\Models\detail_sj;
use App\Models\detail_mr;
use App\Models\detail_so;
use App\Models\gudang;
use App\Models\jurnal;
use App\Models\karyawan;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\rekanan;
use App\Models\salesorder;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
use App\Services\PayUService\Exception;
use Exception as GlobalException;

class DetailSJController extends Controller
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
            if($request->qty > $request->stock){
                if($request->gudang == 'BUFFER'){

                } else {
                    return response()->json(['success'=>false,'pesan'=> 'QTY Melebihi Stock yang ada']);
                }
            } else {
                $kode = detail_sj::orderBy('kode','desc')->first();
                if($kode == null){
                    $nkode = 1;
                } else {
                    $nkode = $kode->kode + 1 ;
                }
                $tipe = Str::substr($request->sj, 3, 2);

                if($tipe == '41'){
                    $data = new detail_sj();
                    $data->kode = $nkode;
                    $data->kode_sj = $request->sj;
                    $data->kode_brg = $request->barang;
                    $data->kode_gdg = $request->gudang;
                    $data->nama_request = $request->nama;
                    $data->qty = $request->qty;
                    $data->keterangan = $request->keterangan;
                    $data->debit = $request->debit;
                    $data->kredit = $request->kredit;
                    $data->save();

                    //DEBIT
                    $so = salesorder:: where('kode',$request->so)->first();
                    $rekanan = rekanan::where('kode',$so->konsumen)->first();
                    $karyawan = karyawan::where('kode',$so->marketing)->first();
                    $barang = barang::where('kode',$request->barang)->first();
                    $gudang = gudang::where('kode',$request->gudang)->first();

                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->sj.".".$nkode."D";
                    $jurnalD->perusahaan     = $request->perusahaan;
                    $jurnalD->akun_debit     = $request->debit;
                    $jurnalD->akun_kredit    = $request->kredit;
                    $jurnalD->kode_brg       = $request->barang;
                    $jurnalD->nama_brg       = $barang->nama;
                    $jurnalD->nama_request   = $request->nama;
                    $jurnalD->kode_marketing = $so->marketing;
                    $jurnalD->nama_marketing = $karyawan->nama;
                    $jurnalD->kode_rekanan   = $so->konsumen;
                    $jurnalD->nama_rekanan   = $rekanan->nama;
                    $jurnalD->satuan         = $barang->satuan;
                    $jurnalD->kode_gdg       = $request->gudang;
                    $jurnalD->nama_gdg       = $gudang->nama;
                    $jurnalD->qty_debit      = $request->qty;
                    $jurnalD->harga_debit    = $request->hpp;
                    $jurnalD->jumlah_debit   = sprintf("%.3f",$request->hpp*$request->qty);
                    $jurnalD->keterangan     = $request->keterangan;
                    $jurnalD->status         = "Belum Diperiksa";
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK= new jurnal();
                    $jurnalK->kode_transaksi = $request->sj.".".$nkode."K";
                    $jurnalK->perusahaan     = $request->perusahaan;
                    $jurnalK->akun_debit     = $request->kredit;
                    $jurnalK->akun_kredit    = $request->debit;
                    $jurnalK->kode_brg       = $request->barang;
                    $jurnalK->nama_brg       = $barang->nama;
                    $jurnalK->nama_request   = $request->nama;
                    $jurnalK->kode_marketing = $so->marketing;
                    $jurnalK->nama_marketing = $karyawan->nama;
                    $jurnalK->kode_rekanan   = $so->konsumen;
                    $jurnalK->nama_rekanan   = $rekanan->nama;
                    $jurnalK->satuan         = $barang->satuan;
                    $jurnalK->kode_gdg       = $request->gudang;
                    $jurnalK->nama_gdg       = $gudang->nama;
                    $jurnalK->qty_kredit     = $request->qty;
                    $jurnalD->harga_kredit   = $request->hpp;
                    $jurnalD->jumlah_kredit  = sprintf("%.3f",$request->hpp*$request->qty);
                    $jurnalK->keterangan     = $request->keterangan;
                    $jurnalK->status         = "Belum Diperiksa";
                    $jurnalK->save();

                } else {

                    
                    $data = new detail_sj();
                    $data->kode = $nkode;
                    $data->kode_sj = $request->sj;
                    $data->kode_brg = $request->barang;
                    $data->kode_gdg = $request->gudang;
                    $data->nama_request = $request->nama;
                    $data->qty = $request->qty;
                    $data->keterangan = $request->keterangan;
                    $data->debit = $request->debit;
                    $data->kredit = $request->kredit;
                    $data->save();

                    //DEBIT
                    $barang = barang::where('kode',$request->barang)->first();
                    $gudang = gudang::where('kode',$request->gudang)->first();

                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->sj.".".$nkode."D";
                    $jurnalD->perusahaan     = $request->perusahaan;
                    $jurnalD->akun_debit     = $request->debit;
                    $jurnalD->akun_kredit    = $request->kredit;
                    $jurnalD->kode_brg       = $request->barang;
                    $jurnalD->nama_brg       = $barang->nama;
                    $jurnalD->nama_request   = $request->nama;
                    $jurnalD->satuan         = $barang->satuan;
                    $jurnalD->kode_gdg       = $request->gudang;
                    $jurnalD->nama_gdg       = $gudang->nama;
                    $jurnalD->qty_debit      = $request->qty;
                    $jurnalD->harga_debit    = $request->hpp;
                    $jurnalD->jumlah_debit   = sprintf("%.3f",$request->hpp*$request->qty);
                    $jurnalD->keterangan     = $request->keterangan;
                    $jurnalD->status         = "Belum Diperiksa";
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK= new jurnal();
                    $jurnalK->kode_transaksi = $request->sj.".".$nkode."K";
                    $jurnalK->perusahaan     = $request->perusahaan;
                    $jurnalK->akun_debit     = $request->kredit;
                    $jurnalK->akun_kredit    = $request->debit;
                    $jurnalK->kode_brg       = $request->barang;
                    $jurnalK->nama_brg       = $barang->nama;
                    $jurnalK->nama_request   = $request->nama;
                    $jurnalK->satuan         = $barang->satuan;
                    $jurnalK->kode_gdg       = $request->gudang;
                    $jurnalK->nama_gdg       = $gudang->nama;
                    $jurnalK->qty_kredit     = $request->qty;
                    $jurnalK->harga_kredit   = $request->hpp;
                    $jurnalK->jumlah_kredit  = sprintf("%.3f",$request->hpp*$request->qty);
                    $jurnalK->keterangan     = $request->keterangan;
                    $jurnalK->status         = "Belum Diperiksa";
                    $jurnalK->save();
                }

                $log = new log_sistem();
                $log->transaksi = $nkode;
                $log->user = $request->user;
                $log->keterangan = "Tambah Data Detail SJ";
                $log->save();
                
                return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']); 
            }
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
    public function dropdownbarangsj(Request $request,$kode)
    {
        try{
            $data = [];
            if($request->has('q')){
                $search = $request->q;
                $data = detail_sj::select('detail_sj.kode_brg','barang.nama as barang')
                        ->join('barang','detail_sj.kode_brg','=','barang.kode')
                        ->where('detail_sj.kode_sj',$kode)
                        ->where('barang','LIKE',"%$search")
                        ->get();
                
            } else {
                $data = detail_sj::select('detail_sj.kode_brg','barang.nama as barang')
                        ->join('barang','detail_sj.kode_brg','=','barang.kode')
                        ->where('detail_sj.kode_sj',$kode)
                        ->get();
            }
            return response()->json($data);
        } catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
    public function kodedetail(Request $request)
    {
        try{
            $data = detail_sj::where('kode_sj',$request->sj)
                    ->where('kode_brg',$request->barang)
                    ->where('qty',$request->qty)
                    ->where('kode_gdg',$request->gudang)->first();
            return response()->json(['success'=>true,'data'=>$data->kode]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function show($kode)
    {
        //
        
        try {
            // Validate the value...
            $data = detail_sj::select('detail_sj.*','gudang.nama as gudang','barang.nama','barang.satuan')
                ->join('gudang','detail_sj.kode_gdg','=','gudang.kode')
                ->join('barang','detail_sj.kode_brg','=','barang.kode')
                ->where('detail_sj.kode_sj',$kode)
                ->get();
            foreach($data AS $A){
                $debit = kode_akuntansi::where('kode',$A->debit)->first();
                $kredit = kode_akuntansi::where('kode',$A->kredit)->first();
                $A->nama_debit = $debit->nama_perkiraan;
                $A->nama_kredit = $kredit->nama_perkiraan;
            }
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e) {
            return response()->json(['success'=>true,'pesan'=>$e->getMessage()]);
        }
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
            // Validate the value...
            $data = detail_sj::select('detail_sj.*','barang.nama as nama','barang.satuan as satuan','gudang.nama as gudang')
                ->join('barang','detail_sj.kode_brg','=','barang.kode')
                ->join('gudang','detail_sj.kode_gdg','=','gudang.kode')
                ->where('detail_sj.kode',$kode)
                ->first();
            //
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$data->kredit)->first();
            $data['nama_debit'] = $debit->nama_perkiraan;
            $data['nama_kredit'] = $kredit->nama_perkiraan;
            //Stock
            $mr = jurnal::select(DB::raw('SUM(qty_debit) as qty'))
                ->where('kode_transaksi','LIKE',"MR%")
                ->where('kode_gdg',$data->kode_gdg)
                ->where('kode_brg',$data->kode_brg)
                ->where('status','Selesai')->first();
            $sj = jurnal::select(DB::raw('SUM(qty_debit) as qty'))
                ->where('kode_transaksi','LIKE',"SJ%")
                ->where('kode_gdg',$data->kode_gdg)
                ->where('kode_brg',$data->kode_brg)
                ->where('status','Selesai')->first();
            if($sj->qty == null){
                $data->stock = $mr->qty;
            } else {
                $data->stock = $mr->qty - $sj->qty;
            }
            
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e) {
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
            
            $data = detail_sj::where('kode',$kode)->first();
            $jumlah = $request->hpp*$request->qty;

            DB::table('detail_sj')
            ->where('kode', $kode)
            ->update([
                'nama_request' => $request->nama,
                'qty' => $request->qty,
                'keterangan' => $request->keterangan,
                'debit' => $request->debit,
                'kredit' => $request->kredit,
            ]);
            $log = new log_sistem();
            $log->transaksi = $data->kode_sj.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail SJ";
            $log->save();
            //DEBIT
            DB::table('jurnal')
            ->where('kode_transaksi',$data->kode_sj.".".$kode."D")
            ->update([
                'nama_request'=>$request->nama,
                'qty_debit'=> $request->qty,
                'jumlah_debit'=>$jumlah,
                'keterangan'=>$request->keterangan,
                'akun_debit' => $request->debit,
                'akun_kredit' => $request->kredit,
            ]);
            //KREDI
            DB::table('jurnal')
            ->where('kode_transaksi',$data->kode_sj.".".$kode."K")
            ->update([
                'nama_request'=>$request->nama,
                'qty_kredit'=> $request->qty,
                'jumlah_kredit'=>$jumlah,
                'keterangan'=>$request->keterangan,
                'akun_debit' => $request->kredit,
                'akun_kredit' => $request->debit,
            ]);
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);

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
    public function hpsedtdetailsj(Request $request, $kode)
    {
        try {
            // Validate the value...
            detail_sj::where('kode_sj',$kode)
            -> whereBetween('created_at',[$request->start,$request->end])->delete();
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"kode%")
            ->whereBetween('created_at',[$request->start,$request->end])->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']) ;
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        

    }
    public function hpsdetailsj($kode)
    {
        try {
            // Validate the value...
            DB::table('detail_sj')
            ->where('kode_sj',$kode)
            ->delete();
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"$kode%")->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']) ;
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy(Request $request,$kode)
    {
        //
        try{
            $data = detail_sj::where('kode',$kode)->first();
            detail_sj::where('kode',$kode)->delete();
            jurnal::where('kode_transaksi','LIKE',"$data->kode_sj.".".$kode%")->delete();
            $log = new log_sistem();
            $log->transaksi = $data->kode_sj.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail SJ";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']) ;
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
