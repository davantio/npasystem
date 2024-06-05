<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\detail_po;
use App\Models\detail_mr;
use App\Models\detail_sj;
use App\Models\gudang;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\materialreceive;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Exception;

class DetailMRController extends Controller
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
            $tipe = Str::substr($request->mr, 3, 2);
            if($request->type == 'po'){
                $po = $request->transaksi;
                $PO = purchaseorder::select('purchaseorder.*','rekanan.nama AS nama_rekanan')->join('rekanan','purchaseorder.supplier','=','rekanan.kode')->where('purchaseorder.kode',$po)->first();
                $po = detail_po::where('kode_po',$po)->get();
                foreach ($po as $po) {
                    $kode = detail_mr::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                    $barang = barang::where('kode',$po->kode_brg)->first();
                    $data = new detail_mr();
                    $data->kode = $nkode;
                    $data->kode_mr = $request->mr;
                    $data->kode_brg = $po->kode_brg;
                    $data->kode_gdg = "BB";
                    $data->harga    = $po->harga;
                    $data->dikirim  = $po->qty;
                    $data->diakui   = $po->qty;
                    $data->diterima = $po->qty;
                    $data->ongkir   =$po->ongkir;
                    $data->dpp = sprintf("%.3f",$po->harga*$po->qty);
                    $data->vat = $PO->vat;
                    $data->keterangan = $po->keterangan;
                    $data->created_at = $request->time;
                    $data->total = $po->jumlah;
                    $data->kode_debit = $barang->kd_persediaan;
                    if($PO->vat > 0){
                        $data->kode_kredit = "300.1";
                    } else {
                        $data->kode_kredit = "300";
                    }
                    
                    $data->save();

                    //DEBIT
                    
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                    $jurnalD->tanggal   = $request->tanggal;
                    $jurnalD->perusahaan         = $request->perusahaan;
                    $jurnalD->akun_debit = $barang->kd_persediaan;
                    $jurnalD->akun_kredit = $data->kode_kredit;
                    $jurnalD->kode_brg = $po->kode_brg;
                    $jurnalD->nama_brg = $barang->nama;
                    $jurnalD->satuan = $barang->satuan;
                    $jurnalD->kode_gdg = "BB";
                    $jurnalD->nama_gdg = "Balung Bendo";
                    $jurnalD->kode_rekanan = $PO->supplier;
                    $jurnalD->nama_rekanan = $PO->nama_rekanan;
                    $jurnalD->ongkir    = $po->ongkir;
                    $jurnalD->keterangan = $po->keterangan;
                    $jurnalD->qty_debit = $po->qty;
                    $jurnalD->harga_debit = $po->harga;
                    $jurnalD->jumlah_debit = $po->jumlah;
                    $jurnalD->vat = $PO->vat;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->created_at = $request->time;
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK = new jurnal();
                    $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                    $jurnalK->tanggal   = $request->tanggal;
                    $jurnalK->perusahaan         = $request->perusahaan;
                    $jurnalK->akun_debit = $data->kode_kredit;
                    $jurnalK->akun_kredit = $barang->kd_persediaan;
                    $jurnalK->kode_brg = $po->kode_brg;
                    $jurnalK->nama_brg = $barang->nama;
                    $jurnalK->satuan = $barang->satuan;
                    $jurnalK->kode_gdg = "BB";
                    $jurnalK->nama_gdg = "Balung Bendo";
                    $jurnalK->kode_rekanan = $PO->supplier;
                    $jurnalK->nama_rekanan = $PO->nama_rekanan;
                    $jurnalK->ongkir    = $po->ongkir;
                    $jurnalK->keterangan = $po->keterangan;
                    $jurnalK->qty_kredit = $po->qty;
                    $jurnalK->harga_kredit = $po->harga;
                    $jurnalK->jumlah_kredit = $po->jumlah;
                    $jurnalK->vat = $PO->vat;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->created_at = $request->time;
                    $jurnalK->save();

                    $log = new log_sistem();
                    $log->transaksi = $request->mr.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail MR";
                    $log->save();
                    
                }
                return response()->json(['success'=>true, 'pesan'=> 'Ubah Gudang Penerima dan Jumlah Barang yang diterima sesuai dengan kondisi di lapangan']);
            } elseif($request->type == 'sj'){
                if($tipe == 43){
                    $kode = detail_mr::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                    $data = new detail_mr();
                    $data->kode = $nkode;
                    $data->kode_mr = $request->mr;
                    $data->kode_brg = $request->barang;
                    $data->kode_gdg = $request->gudang;
                    $data->harga = $request->harga;
                    $data->dikirim = $request->qty;
                    $data->diakui = $request->diakui;
                    $data->diterima = $request->diterima;
                    $data->dpp = $request->dpp;
                    $data->vat = 0;
                    $data->total = $request->dpp;
                    $data->keterangan = $request->keterangan;
                    $data->kode_debit = $request->debit;
                    $data->kode_kredit = $request->kredit;
                    $data->save();

                    $gudang = gudang::where('kode',$request->gudang)->first();
                    $barang = barang::where('kode',$request->barang)->first();
                    //DEBIT
                    $jurnalD = new jurnal();
                    $jurnalD->tanggal = $request->tanggal;
                    $jurnalD->perusahaan         = $request->perusahaan;
                    $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                    $jurnalD->akun_debit = $request->debit;
                    $jurnalD->akun_kredit = $request->kredit;
                    $jurnalD->kode_brg = $request->barang;
                    $jurnalD->nama_brg = $barang->nama;
                    $jurnalD->satuan = $barang->satuan;
                    $jurnalD->kode_gdg = $request->gudang;
                    $jurnalD->nama_gdg = $gudang->nama;
                    $jurnalD->keterangan = $request->keterangan;
                    $jurnalD->qty_debit = $request->qty;
                    $jurnalD->harga_debit = sprintf("%.3f", $request->harga);
                    $jurnalD->jumlah_debit = sprintf("%.3f", $request->dpp);
                    $jurnalD->vat = 0;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK = new jurnal();
                    $jurnalK = $request->tanggal;
                    $jurnalK->perusahaan         = $request->perusahaan;
                    $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                    $jurnalK->akun_debit = $request->kredit;
                    $jurnalK->akun_kredit = $request->debit;
                    $jurnalK->kode_brg = $request->barang;
                    $jurnalK->nama_brg = $barang->nama;
                    $jurnalK->satuan = $barang->satuan;
                    $jurnalK->kode_gdg = $request->gudang;
                    $jurnalK->nama_gdg = $gudang->nama;
                    $jurnalK->keterangan = $request->keterangan;
                    $jurnalK->qty_kredit = $request->qty;
                    $jurnalK->harga_kredit = sprintf("%.3f",$request->harga);
                    $jurnalK->jumlah_kredit = sprintf("%.3f",$request->dpp);
                    $jurnalK->vat = 0;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->save();

                    $log = new log_sistem();
                    $log->transaksi = $request->mr.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail MR";
                    $log->save();

                } elseif($tipe == 44){
                    $sj = detail_sj::where('kode_sj', $request->transaksi)->get();
                    foreach($sj as $sj){
                        $kode = detail_mr::orderBy('kode','desc')->first();
                        if($kode == null){
                            $nkode = 1;
                        } else {
                            $nkode = $kode->kode + 1 ;
                        }
                        $data = new detail_mr();
                        $data->kode = $nkode;
                        $data->kode_mr = $request->mr;
                        $data->kode_brg = $sj->kode_brg;
                        $data->kode_gdg = $sj->kode_gdg;
                        $data->harga = 0;
                        $data->dikirim = $sj->qty;
                        $data->diakui = $sj->qty;
                        $data->diterima = $sj->qty;
                        $data->dpp = 0;
                        $data->vat = 0;
                        $data->total = 0;
                        $data->keterangan = $sj->keterangan;
                        $data->kode_debit = $sj->debit;
                        $data->kode_kredit = $sj->kredit;
                        $data->save();

                        //log
                        $log = new log_sistem();
                        $log->transaksi = $request->mr.".".$nkode;
                        $log->user = $request->user;
                        $log->keterangan = "Tambah Data Detail MR";
                        $log->save();
                        //endlog

                        $gudang = gudang::where('kode',$sj->kode_gdg)->first();
                        $barang = barang::where('kode',$sj->kode_brg)->first();
                        //DEBIT
                        $jurnalD = new jurnal();
                        $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                        $jurnalD->tangggal = $request->tanggal;
                        $jurnalD->perusahaan         = $request->perusahaan;
                        $jurnalD->akun_debit = $sj->debit;
                        $jurnalD->akun_kredit = $sj->kredit;
                        $jurnalD->kode_brg = $sj->kode_brg;
                        $jurnalD->nama_brg = $barang->nama;
                        $jurnalD->satuan = $barang->satuan;
                        $jurnalD->kode_gdg = $sj->kode_gdg;
                        $jurnalD->nama_gdg = $gudang->nama;
                        $jurnalD->keterangan = $sj->keterangan;
                        $jurnalD->qty_debit = $sj->qty;
                        $jurnalD->harga_debit = 0;
                        $jurnalD->jumlah_debit = 0;
                        $jurnalD->vat = 0;
                        $jurnalD->status = "Belum Diperiksa";
                        $jurnalD->save();

                        //KREDIT
                        $jurnalK = new jurnal();
                        $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                        $jurnalK->tanggal = $request->tanggal;
                        $jurnalK->perusahaan         = $request->perusahaan;
                        $jurnalK->akun_debit = $sj->kredit;
                        $jurnalK->akun_kredit = $sj->debit;
                        $jurnalK->kode_brg = $sj->kode_brg;
                        $jurnalK->nama_brg = $barang->nama;
                        $jurnalK->satuan = $barang->satuan;
                        $jurnalK->kode_gdg = $sj->kode_gdg;
                        $jurnalK->nama_gdg = $gudang->nama;
                        $jurnalK->keterangan = $sj->keterangan;
                        $jurnalK->qty_kredit = $sj->qty;
                        $jurnalK->harga_kredit = 0;
                        $jurnalK->jumlah_kredit = 0;
                        $jurnalK->vat = 0;
                        $jurnalK->status = "Belum Diperiksa";
                        $jurnalK->save();
                    }
                }
                
                return response()->json(['success'=> true, 'pesan'=> 'Data berhasil Ditambahkan']);
            }
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mr)
    {
        //
        try{
            $login = Auth::user();
            $detail = detail_mr::
                select('detail_mr.*', 'barang.nama as barang','barang.satuan','gudang.nama as gudang' )
                ->join('barang','detail_mr.kode_brg','=','barang.kode')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_mr', $mr )->get();
            foreach($detail as $A){
                if($login->level == "superadmin"|| $login->level == "ceo" || $login->level == "purchasing"){
                    
                } else {
                    $A->dpp = 0; $A->harga = 0;$A->total = 0;
                }
                $diakui    = number_format($A->diakui,2,',','.');
                $dikirim   = number_format($A->dikirim,2,',','.');
                $diterima  = number_format($A->diterima,2,',','.');
                $A->diakui = $diakui;
                $A->diterima = $diterima;
                $A->dikirim = $dikirim;
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->kode_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->kode_kredit)->first();
                $A->nama_debit = $debit->nama_perkiraan;
                $A->nama_kredit = $kredit->nama_perkiraan;
            }
            // foreach ($detail as $detail) {
            //     $dpp = $detail['dpp'];
            //     $vat = $detail['vat'];
            //     $detail['VAT'] = ($dpp*$vat)/100;
            // }
        return response()->json(['success'=>true ,'data' => $detail]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        

    }
    public function dropdownbarang(Request $request,$gudang)
    {
        $barang = [];
        if($request->has('q')){
            $search = $request->q;
            $barang = DB::table('detail_mr')
                    -> select ('detail_mr.kode_brg','barang.nama')
                    -> join ('barang','detail_mr.kode_brg','=','barang.kode')
                    -> join ('materialreceive','detail_mr.kode_mr','=','materialreceive.kode')
                    -> where('materialreceive.status','Selesai')
                    -> where('detail_mr.kode_gdg',$gudang)
                    -> where ('barang.nama','LIKE',"%$search")
                    -> distinct()->get();
            
        } else {
            $barang = DB::table('detail_mr')
                -> select ('detail_mr.kode_brg as kode','barang.nama')
                -> join ('barang','detail_mr.kode_brg','=','barang.kode')
                -> join ('materialreceive','detail_mr.kode_mr','=','materialreceive.kode')
                -> where('materialreceive.status','Selesai')
                -> where('detail_mr.kode_gdg',$gudang)
                -> distinct()->get();
        }
        return response()->json($barang);
    }
    public function gudangso(Request $request, $kode)
    {
        $gdg = [];
        if($request->has('q')){
            $search = $request->q;
            $gdg = $gdg = detail_mr::select('detail_mr.kode_gdg','gudang.nama')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_brg',$kode)
                ->where('gudang.nama', 'LIKE', "%$search%")
                ->distinct()->get();
        } else {
            $gdg = detail_mr::select('detail_mr.kode_gdg as kode','gudang.nama')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_brg',$kode)->distinct()->get();
           
            
        }
        return response()->json($gdg);
    }
    public function stockbarang(Request $request ,$kode)
    {

        try {
            // Validate the value...
            $masuk = jurnal::select(DB::raw('SUM(qty_debit) as qty'))
                    ->where('kode_transaksi','LIKE',"MR%")
                    ->where('kode_gdg',$kode)
                    ->where('kode_brg',$request->barang)
                    ->where('status','Selesai')->first();
            $keluar = jurnal::select(DB::raw('SUM(qty_debit)as qty'))
                    ->where('kode_transaksi','LIKE',"SJ%")
                    ->where('kode_gdg',$kode)
                    ->where('kode_brg',$request->barang)
                    ->where('status','Selesai')->first();
            
            if($masuk->qty == null){
                $qty= 0;
            } else {
                $qty = $masuk->qty - $keluar->qty;
            }
            return response()->json(['success'=>true,'data'=>$qty]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
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
            $detail = detail_mr::
                    select('detail_mr.*', 'barang.nama as barang','barang.satuan','gudang.nama as gudang' )
                    ->join('barang','detail_mr.kode_brg','=','barang.kode')
                    ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                    ->where('detail_mr.kode', $kode )->first();
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$detail->kode_debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$detail->kode_kredit)->first();
            $detail['nama_debit'] = $debit->nama_perkiraan;
            $detail['nama_kredit'] = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$detail]);
        } catch (\Exception $e){
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
            $data = detail_mr::where('kode',$kode)->first();
            if($data){
                $tipe = Str::substr($data->kode_mr, 3, 2);
                if($tipe == 61){
                    $po = purchaseorder::where('kode',$request->po)->first();
                    $gudang = gudang::where('kode',$request->gudang)->first();
                    $data->kode_gdg = $request->gudang;
                    $data->diakui   = sprintf("%.3f",$request->diakui);
                    $data->diterima = sprintf("%.3f",$request->diterima);
                    $data->dpp      = sprintf("%.3f",$request->dpp);
                    $data->kode_debit = $request->debit;
                    $data->kode_kredit = $request->kredit;
                    $data->keterangan = $request->keterangan;
                    if($request->diterima > $request->diakui){
                       $qty = $request->diakui; 
                    } else {
                        $qty = $request->diterima;
                    }
                    $save = DB::table('detail_mr')->where('kode',$kode)->update([
                        'kode_gdg'      => $request->gudang,
                        'diterima'      => sprintf("%.3f",$qty),
                        'dpp'           => sprintf("%.3f",$request->dpp),
                        'kode_debit'    => $request->debit,
                        'kode_kredit'   => $request->kredit,
                        'keterangan'    => $request->keterangan,
                    ]);
                    
                    $mr = materialreceive::select('status')->where('kode',$data->kode_mr)->first();
                    if($mr){
                        $status = "Sudah Diperiksa";
                    } else {
                        $status = "Belum Diperiksa";
                    }
                    $jurnalD = jurnal::where('kode_transaksi',$data->kode_mr.".".$kode."D")->first();
                    $jurnalD->kode_gdg = $request->gudang;
                    $jurnalD->nama_gdg = $gudang->nama;
                    $jurnalD->akun_debit  = $request->debit;
                    $jurnalD->akun_kredit = $request->kredit;
                    DB::table('jurnal')->where('kode_transaksi',$data->kode_mr.".".$kode."D")->update([
                        'kode_gdg'      => $request->gudang,
                        'nama_gdg'      => $gudang->nama,
                        'qty_debit'     => sprintf("%.3f",$qty),
                        'jumlah_debit'  => sprintf("%.3f",$jurnalD->harga*$qty),
                        'akun_debit'    => $request->debit,
                        'akun_kredit'   => $request->kredit,
                        'keterangan'    => $request->keterangan,
                    ]);
                    
                    $jurnalK = jurnal::where('kode_transaksi',$data->kode_mr.".".$kode."K")->first();
                    $jurnalK->kode_gdg = $request->gudang;
                    $jurnalK->nama_gdg = $gudang->nama;
                    $jurnalK->akun_debit  = $request->kredit;
                    $jurnalK->akun_kredit = $request->debit;
                    $savejurnalK = $savejurnalD = $save = DB::table('jurnal')->where('kode_transaksi',$data->kode_mr.".".$kode."K")->update([
                        'kode_gdg'      => $request->gudang,
                        'nama_gdg'      => $gudang->nama,
                        'qty_kredit'    => sprintf("%.3f",$qty),
                        'jumlah_kredit' => sprintf("%.3f",$jurnalD->harga*$qty),
                        'akun_debit'    => $request->kredit,
                        'akun_kredit'   => $request->debit,
                        'keterangan'    => $request->keterangan,
                    ]);
                    // IF DATA TIDAK SAMA     
                    if($request->diterima > $request->diakui){
                        $qty = $request->diterima-$request->diakui;
                        $nkode = detail_mr::orderBy('kode','desc')->first();
                        $nkode = $nkode->kode+1;
                        
                        $newdetail = new detail_mr();
                        $newdetail->kode = $nkode;
                        $newdetail->kode_mr = $data->kode_mr;
                        $newdetail->kode_brg = $data->kode_brg;
                        $newdetail->kode_gdg = $data->kode_gdg;
                        $newdetail->harga    = $data->harga;
                        $newdetail->dikirim  = $qty;
                        $newdetail->diakui   = $qty;
                        $newdetail->diterima = $qty;
                        $newdetail->ongkir   =$data->ongkir;
                        $newdetail->dpp = sprintf("%.3f",$data->harga*$qty);
                        $newdetail->vat = $data->vat;
                        $newdetail->keterangan = "Selisih Lebih";
                        $vat = sprintf("%.3f",(($data->harga*$data->vat)/100));
                        $VAT = sprintf("%.3f",$vat*$qty);
                        $newdetail->total = $newdetail->dpp+$VAT;
                        $newdetail->kode_debit = $data->kode_debit;
                        $newdetail->kode_kredit = 511;
                        $savenewdetail = $newdetail->save();
                        if($savenewdetail){
                            $newJD = new jurnal();
                            $newJD->kode_transaksi = $data->kode_mr.".".$nkode."D";
                            $newJD->tanggal = $jurnalD->tanggal;
                            $newJD->akun_debit = $data->kode_debit;
                            $newJD->akun_kredit = 511;
                            $newJD->kode_brg = $data->kode_brg;
                            $newJD->nama_brg = $jurnalD->nama_brg;
                            $newJD->satuan = $jurnalD->satuan;
                            $newJD->kode_gdg = $jurnalD->kode_gdg;
                            $newJD->nama_gdg = $jurnalD->nama_gdg;
                            $newJD->kode_rekanan = $jurnalD->kode_rekanan;
                            $newJD->nama_rekanan = $jurnalD->nama_rekanan;
                            $newJD->keterangan = $jurnalD->keterangan;
                            $newJD->qty_debit = $qty;
                            $newJD->harga_debit = $jurnalD->harga_debit;
                            $newJD->jumlah_debit = $newdetail->dpp+$VAT;
                            $newJD->vat = $jurnalD->vat;
                            $newJD->status = $jurnalD->status;
                            $savenewJD = $newJD->save();
                            if($savenewJD){
                                $newJK = new jurnal();
                                $newJK->kode_transaksi = $data->kode_mr.".".$nkode."K";
                                $newJK->tanggal = $jurnalK->tanggal;
                                $newJK->akun_debit = 511;
                                $newJK->akun_kredit = $data->kode_debit;
                                $newJK->kode_brg = $data->kode_brg;
                                $newJK->nama_brg = $jurnalK->nama_brg;
                                $newJK->satuan = $jurnalK->satuan;
                                $newJK->kode_gdg = $jurnalK->kode_gdg;
                                $newJK->nama_gdg = $jurnalK->nama_gdg;
                                $newJK->kode_rekanan = $jurnalK->kode_rekanan;
                                $newJK->nama_rekanan = $jurnalK->nama_rekanan;
                                $newJK->keterangan = $jurnalK->keterangan;
                                $newJK->qty_kredit = $qty;
                                $newJK->harga_kredit = $jurnalK->harga_kredit;
                                $newJK->jumlah_kredit = $newdetail->dpp+$VAT;
                                $newJK->vat = $jurnalK->vat;
                                $newJK->status = $jurnalK->status;
                                $savenewJK = $newJK->save();
                                if($savenewJK){
                                    $log = new log_sistem();
                                    $log->transaksi = $data->kode_mr.".".$kode;
                                    $log->user = $request->user;
                                    $log->keterangan = "Edit Data Detail MR";
                                    $savelog = $log->save();
                                    if($savelog){
                                        return response()->json(['success'=>true,'pesan'=>"Data Berhasil Di Update"]);
                                    } else {
                                        return response()->json(['success'=>false,'pesan'=>"Error Save Log Update"]);
                                    }
                                } else {
                                    return response()->json(['success'=>false,'pesan'=>"Error Save Jurnal D Baru"]);
                                }   
                            } else {
                                return response()->json(['success'=>false,'pesan'=>"Error Save Jurnal D Baru"]);
                            }
                        } else {
                            return response()-json(['success'=>false,'pesan'=>"Error Simpan New Detail Selisih"]);
                        }
                        
                    } else if($request->diterima < $request->diakui) {
                        $qty = $request->diakui-$request->diterima;
                        $nkode = detail_mr::orderBy('kode','desc')->first();
                        $nkode = $nkode->kode+1;
                        $newdetail = new detail_mr();
                        $newdetail->kode = $nkode;
                        $newdetail->kode_mr = $data->kode_mr;
                        $newdetail->kode_brg = $data->kode_brg;
                        $newdetail->kode_gdg = $data->kode_gdg;
                        $newdetail->harga    = $data->harga;
                        $newdetail->dikirim  = $qty;
                        $newdetail->diakui   = $qty;
                        $newdetail->diterima = $qty;
                        $newdetail->ongkir   =$data->ongkir;
                        $newdetail->dpp = sprintf("%.3f",$data->harga*$qty);
                        $newdetail->vat = $data->vat;
                        $newdetail->keterangan = "Selisih Kurang ";
                        $vat = sprintf("%.3f",($data->harga*$data->vat)/100);
                        $VAT = sprintf("%.3f",$vat*$qty);
                        $newdetail->total = $newdetail->dpp+$VAT;
                        $newdetail->kode_debit = 640.2;
                        $newdetail->kode_kredit = $data->kode_debit;
                        $savenewdetail = $newdetail->save();
                        if($savenewdetail){
                            $newJD = new jurnal();
                            $newJD->kode_transaksi = $data->kode_mr.".".$nkode."D";
                            $newJD->tanggal = $jurnalD->tanggal;
                            $newJD->akun_debit = 640.2;
                            $newJD->akun_kredit = $data->kode_debit;
                            $newJD->kode_brg = $data->kode_brg;
                            $newJD->nama_brg = $jurnalD->nama_brg;
                            $newJD->satuan = $jurnalD->satuan;
                            $newJD->kode_gdg = $jurnalD->kode_gdg;
                            $newJD->nama_gdg = $jurnalD->nama_gdg;
                            $newJD->keterangan = $jurnalD->keterangan;
                            $newJD->qty_debit = $qty;
                            $newJD->harga_debit = $jurnalD->harga_debit;
                            $newJD->jumlah_debit = $newdetail->dpp+$VAT;
                            $newJD->vat = $jurnalD->vat;
                            $newJD->status = $jurnalD->status;
                            $savenewJD = $newJD->save();
                            if($savenewJD){
                                $newJK = new jurnal();
                                $newJK->kode_transaksi = $data->kode_mr.".".$nkode."K";
                                $newJK->tanggal = $jurnalK->tanggal;
                                $newJK->akun_debit = $data->kode_debit;
                                $newJK->akun_kredit = 640.2;
                                $newJK->kode_brg = $data->kode_brg;
                                $newJK->nama_brg = $jurnalK->nama_brg;
                                $newJK->satuan = $jurnalK->satuan;
                                $newJK->kode_gdg = $jurnalK->kode_gdg;
                                $newJK->nama_gdg = $jurnalK->nama_gdg;
                                $newJK->keterangan = $jurnalK->keterangan;
                                $newJK->qty_kredit = $qty;
                                $newJK->harga_kredit = $jurnalK->harga_debit;
                                $newJK->jumlah_kredit = $newdetail->dpp+$VAT;
                                $newJK->vat = $jurnalK->vat;
                                $newJK->status = $jurnalK->status;
                                $savenewJK = $newJK->save();
                                if($savenewJK){
                                    $log = new log_sistem();
                                    $log->transaksi = $data->kode_mr.".".$kode;
                                    $log->user = $request->user;
                                    $log->keterangan = "Edit Data Detail MR";
                                    $savelog = $log->save();
                                    if($savelog){
                                        return response()->json(['success'=>true,'pesan'=>"Data Berhasil Di Update"]);
                                    } else {
                                        return response()->json(['success'=>false,'pesan'=>"Error Save Log Update"]);
                                    }
                                } else {
                                    return response()->json(['success'=>false,'pesan'=>"Error Save Jurnal D Baru"]);
                                }
                            } else {
                                return response()->json(['success'=>false,'pesan'=>"Error Save Jurnal D Baru"]);
                            }
                        } else {
                            return response()-json(['success'=>false,'pesan'=>"Error Simpan New Detail Selisih"]);
                        }
                    } else {
                        $log = new log_sistem();
                        $log->transaksi = $data->kode_mr.".".$kode;
                        $log->user = $request->user;
                        $log->keterangan = "Edit Data Detail MR";
                        $savelog = $log->save();
                        if($savelog){
                            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Di Update"]);
                        } else {
                            return response()->json(['success'=>false,'pesan'=>"Error Save Log Update"]);
                        }
                    }
                       
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Pemindahan,Produksi,Pemakaian"]);
                }
                
                // $data->kode_gdg = $request->gudang;
                // $data->diakui = $request->diakui;
                // $data->diterima = $request->diterima;
                // $data->dpp = $request->dpp;
                // $data->keterangan = $request->keterangan;
                // $vat = $data->vat;
                // $dpp =  $request->dpp;
                // $VAT = ($data->harga*$vat)/100;
                
                // $total = $dpp+$VAT;
                // $data->total = $total;
                // $gudang  = gudang::where('kode',$request->gudang)->first();
                // $mr = materialreceive::select('status')->where('kode',$data->kode_mr)->first();
                // if($mr){
                //     $simpan = $data->save();
                //     if($simpan){
                //         //update Debit
                //             $UD = DB::table('jurnal')->where('kode_transaksi',$data->kode_mr.".".$kode."D")
                //             ->update([
                //                 'qty_debit'=>$request->diterima,
                //                 'kode_gdg'=>$request->gudang,
                //                 'nama_gdg'=> $gudang->nama,
                //                 'qty_debit'=>$data->diakui,
                //                 'jumlah_debit'=>$data->total,
                //                 'keterangan'=>$request->keterangan,
                                
                //             ]);
                //         //update debit
                //     } else {
                //         return response()->json(['success'=>false,'pesan'=>"UPDATE Data MR Gagal"]);
                //     }
                // } else {
                //     return response()->json(['success'=>false , 'pesan'=>"BBBB"]);
                // }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Tidak Data Ditemukan"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success'=>false , 'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hpsdetailmr(Request $request,$kode){
        
        
        try {
            // Validate the value...
            DB::table('detail_mr')
            ->where('kode_mr',$kode)
            ->delete();
            jurnal::where('kode_transaksi','LIKE',"$kode%")
            ->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail MR";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch (Exception $e) {
            return response()->json(['success'=> false ,'pesan'=> $e->getMessage()]);
        }
    }
    public function destroy(Request $request,$kode)
    {
        //
        try{
            $data = detail_mr::where('kode',$kode)->first();
            jurnal::where('kode_transaksi','LIKE',"$data->kode_mr.".".$kode%")->delete();
            detail_mr::where('kode',$kode)->delete();
            //log
            $log = new log_sistem();
            $log->transaksi = $data->kode_mr.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail MR";
            $log->save();
            return response()->json(['success'=> true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
