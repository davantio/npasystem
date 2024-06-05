<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_invoice;
use App\Models\detail_kas;
use App\Models\gudang;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\rekanan;
use App\Models\salesorder;
use App\Models\suratjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DetailKasController extends Controller
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
            if($request->dk == "D"){
                //last kode
                    $kode = detail_kas::max('kode');
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode + 1 ;
                    }
                //Detail
                    $detail = new detail_kas();
                    $detail->kode = $nkode;
                    $detail->kode_kas = $request->kode_kas;
                    $detail->kode_transaksi = $request->transaksi;
                    $detail->vat = $request->vat;
                    $detail->harga = $request->harga;
                    $detail->qty = $request->qty;
                    $total = $request->harga * $request->qty;
                    $VAT = ($total*$request->vat)/100;
                    $TOTAL = $total+$VAT;
                    $detail->total = $TOTAL;
                    $detail->keterangan = $request->keterangan;
                    $detail->debit = $request->debit;
                    $detail->kredit = $request->kredit;
                    $saveDetail = $detail->save();
                    if($saveDetail){
                        //Log System
                        $log = new log_sistem();
                        $log->transaksi = $request->kode_kas.".".$nkode;
                        $log->user = $request->user;
                        $log->keterangan = "Tambah Data Detail Kas";
                        $savelog = $log->save();        
                        if($savelog) {
                            if (Str::startsWith($request->keterangan, 'INV') ) {
                                $inv = jurnal::where('keterangan',$request->keterangan)->first();
                                $kodemarketing = $inv->kode_marketing;
                                $marketing = $inv->nama_marketing;
                                $koderekanan = $inv->kode_rekanan;
                                $rekanan = $inv->nama_rekanan;
                            } else  if(Str::startsWith($request->keterangan, 'PO')) {
                                $po = puchaseorder::select('purchaseorder.*','rekanan.nama as nama')->join('rekanan','po.supplier','=','rekanan.kode')->where('kode',$request->keterangan)->first();
                                $kodemarketing = "";
                                $marketing = "";
                                $koderekanan = $po->supplier;
                                $rekanan = $po->nama;
                            } else {
                                $kodemarketing = "";
                                $marketing = "";
                                $koderekanan = "";
                                $rekanan = "";
                            }
                            //Jurnal Debit
                            $jurnalD = new jurnal();
                            $jurnalD->kode_transaksi = $request->kode_kas.".".$nkode."D";
                            $jurnalD->tanggal = $request->tanggal;
                            $jurnalD->perusahaan         = $request->perusahaan;
                            $jurnalD->akun_debit = $request->debit;
                            $jurnalD->akun_kredit = $request->kredit;
                            $jurnalD->kode_marketing = $kodemarketing;
                            $jurnalD->nama_marketing = $marketing;
                            $jurnalD->kode_rekanan = $koderekanan;
                            $jurnalD->nama_rekanan = $rekanan;
                            $jurnalD->keterangan = $request->keterangan;
                            $jurnalD->qty_debit = $request->qty;
                            $jurnalD->harga_debit = $request->harga;
                            $jurnalD->jumlah_debit = $TOTAL;
                            $jurnalD->vat = $request->vat;
                            $jurnalD->status = "Belum Diperiksa";
                            $saveJD = $jurnalD->save();            
                            if($saveJD){
                                //Jurnal Kredit
                                $jurnalK = new jurnal();
                                $jurnalK->kode_transaksi = $request->kode_kas.".".$nkode."K";
                                $jurnalK->tanggal = $request->tanggal;
                                $jurnalK->perusahaan         = $request->perusahaan;
                                $jurnalK->akun_debit = $request->kredit;
                                $jurnalK->akun_kredit = $request->debit;
                                $jurnalK->kode_marketing = $kodemarketing;
                                $jurnalK->nama_marketing = $marketing;
                                $jurnalK->kode_rekanan = $koderekanan;
                                $jurnalK->nama_rekanan = $rekanan;
                                $jurnalK->keterangan = $request->keterangan;
                                $jurnalK->qty_kredit = $request->qty;
                                $jurnalK->harga_kredit = $request->harga;
                                $jurnalK->jumlah_kredit = $TOTAL;
                                $jurnalK->vat = $request->vat;
                                $jurnalK->status = "Belum Diperiksa";
                                $saveJK = $jurnalK->save();
                                if(saveJK){
                                    return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);
                                } else {
                                    return response()->json(['success'=>false,'pesan'=>"Error save Jurnal K"]);
                                }
                            } else {
                                return response()->json(['success'=>false,'pesan'=>"Error save Jurnal D"]);
                            }
                        } else {
                            return response()->json(['success'=>false,'pesan'=>"Error save Log"]);
                        }
                    } else {
                        return response()->json(['success'=>false,'pesan'=>"Error save detail"]);
                    }

            } elseif($request->dk == "K") {
                //last kode
                    $kode = detail_kas::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                //Detail
                    $detail = new detail_kas();
                    $detail->kode = $nkode;
                    $detail->kode_kas = $request->kode_kas;
                    $detail->kode_transaksi = $request->transaksi;
                    $detail->vat = $request->vat;
                    $detail->harga = $request->harga;
                    $detail->qty = $request->qty;
                    $total = $request->harga * $request->qty;
                    $VAT = ($total*$request->vat)/100;
                    $TOTAL = $total+$VAT;
                    $detail->total = $TOTAL;
                    $detail->keterangan = $request->keterangan;
                    $detail->debit = $request->kredit;
                    $detail->kredit = $request->debit;
                    $SD = $detail->save();
                    if($SD){
                        //Log System
                        $log = new log_sistem();
                        $log->transaksi = $request->kode_kas.".".$nkode;
                        $log->user = $request->user;
                        $log->keterangan = "Tambah Data Detail Kas";
                        $SL = $log->save();
                        if($SL){
                            //Jurnal Debit
                            $jurnalD = new jurnal();
                            $jurnalD->kode_transaksi = $request->kode_kas.".".$nkode."D";
                            $jurnalD->tanggal = $request->tanggal;
                            $jurnalD->perusahaan         = $request->perusahaan;
                            $jurnalD->akun_debit = $request->kredit;
                            $jurnalD->akun_kredit = $request->debit;
                            $jurnalD->keterangan = $request->keterangan;
                            $jurnalD->qty_debit = $request->qty;
                            $jurnalD->harga_debit = $request->harga;
                            $jurnalD->jumlah_debit = $TOTAL;
                            $jurnalD->vat = $request->vat;
                            $jurnalD->status = "Belum Diperiksa";
                            $SJD = $jurnalD->save();
                            if($SJD){
                                //Jurnal Kredit
                                $jurnalK = new jurnal();
                                $jurnalK->kode_transaksi = $request->kode_kas.".".$nkode."K";
                                $jurnalK->tanggal = $request->tanggal;
                                $jurnalK->perusahaan         = $request->perusahaan;
                                $jurnalK->akun_debit = $request->debit;
                                $jurnalK->akun_kredit = $request->kredit;
                                $jurnalK->keterangan = $request->keterangan;
                                $jurnalK->qty_kredit = $request->qty;
                                $jurnalK->harga_kredit = $request->harga;
                                $jurnalK->jumlah_kredit = $TOTAL;
                                $jurnalK->vat = $request->vat;
                                $jurnalK->status = "Belum Diperiksa";
                                $SJK = $jurnalK->save();
                                if($SJK){
                                    return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan"]);
                                } else {
                                    return response()->json(['success'=>false,'pesan'=>'Error Save Jurnal K']);    
                                }
                            } else {
                                return response()->json(['success'=>false,'pesan'=>'Error Save Jurnal D']);
                            }
                        } else {
                            return response()->json(['success'=>false,'pesan'=>'Error Save Log']);
                        }
                    } else {
                        return response()->json(['success'=>false,'pesan'=>'Error Save Detail']);
                    }
                
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
    public function show($id)
    {
        //
        try{
            $total = 0;
            $data = detail_kas::where('kode_kas',$id)->get();
            foreach($data AS $D){
                $total = $total+$D->total;
                $debit = kode_akuntansi::where('kode',$D->debit)->first();
                $kredit = kode_akuntansi::where('kode',$D->kredit)->first();
                $D->nama_debit = $debit->nama_perkiraan;
                $D->nama_kredit = $kredit->nama_perkiraan;
                $D->VAT = (($D->harga*$D->qty)*$D->vat)/100;
            }
            return response()->json(['success'=>true,'data'=>$data,'total'=>$total]);
            
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
            $data = detail_kas::where('kode',$id)->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_debit= $debit->nama_perkiraan;
            $data->nama_kredit = $kredit->nama_perkiraan;
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
            $data = detail_kas::where('kode',$id)->first();
            $total = $request->harga*$request->qty;
            $VAT = ($total*$request->vat)/100;
            $TOTAL = $total+$VAT;

            //DETAIL
            DB::table('detail_kas')->where('kode',$id)
            ->update([
                'qty'           => $request->qty,
                'harga'         => $request->harga,
                'total'         => $TOTAL,
                'keterangan'    => $request->keterangan,
            ]);
            //LOG
            $log = new log_sistem();
            $log->transaksi = $data->kode_kas.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail Kas";
            $log->save();
            //Jurnal
            DB::table('jurnal')->where('kode_transaksi',$data->kode_kas.".".$id."%")
            ->update([
                'keterangan'    => $request->keterangan,
                'qty_debit'     => $request->qty,
                'harga_debit'   => $request->harga,
                'jumlah_debit'  => $TOTAL,

            ]); 

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
    public function hapuskas($kode)
    {
        try{
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            detail_kas::where('kode_kas',$kode)->delete();

            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy(Request $request,$id)
    {
        //
        try{
            $data = detail_kas::where('kode',$id)->first();
            $kode = $data->kode_kas.".".$id;
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            $log = new log_sistem();
            $log->transaksi = $data->kode_kas.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail Kas";
            $log->save();
            detail_kas::where('kode',$id)->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
