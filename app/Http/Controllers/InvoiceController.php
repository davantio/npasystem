<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoice;
use App\Models\author;
use App\Models\detail_invoice;
use App\Models\jurnal;
use App\Models\salesorder;
use App\Models\karyawan;
use App\Models\log_sistem;
use App\Models\suratjalan;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Response;
use Throwable;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = invoice::select('invoice.*','rekanan.nama as rekanan')
                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')->orderBy('invoice.kode','DESC')->get();
        $login = Auth::user();
        
        if($login->level == 'superadmin'){
            return DataTables::of($data)
            ->editColumn('perusahaan',function($data){
                if($data->perusahaan == "npa"){
                    return "CV. Nusa Pratama Anugrah";
                } else if($data->perusahaan == "herbivor"){
                    return "PT. Herbivor Satu Nusa";
                } else if($data->perusahaan == "triputra"){
                    return "PT. Triputra Sinergi Indonesia";
                } else {
                    return "-";
                }
            })
            ->addColumn('tempo',function($data){
                $fdate = $data->tanggal;
                $tdate = $data->tgl_tempo;
                $datetime1 = strtotime($fdate); // convert to timestamps
                $datetime2 = strtotime($tdate); // convert to timestamps
                $days = (int)(($datetime2 - $datetime1)/86400); // will give the difference in days , 86400 is the timestamp difference of a day
                return $days." Hari";
            })
            ->addColumn('barang',function($data){
                $barang = detail_invoice::select('barang.nama AS barang')->join('barang','detail_invoice.kode_brg','=','barang.kode')->where('detail_invoice.kode_inv',$data->kode)->get();
                
                $a = "";
                foreach($barang AS $brg){
                    $a = $brg->barang." || ".$a;
                }
                return $a;
            })
            ->addColumn('kekurangan',function($data){
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('keterangan',$data->kode)->where('status',"Selesai")->first();
                $total = detail_invoice::select(DB::raw("SUM(jumlah) AS jumlah"))
                    ->where('kode_inv',$data->kode)->first();
                $total = $total->jumlah;
                $kekurangan = $total-$kas->jumlah;
                return "Rp.".number_format($kekurangan,2,',','.');
            })
            ->addColumn('total',function($data){
                $total = detail_invoice::select(DB::raw("SUM(jumlah) AS jumlah"))
                    ->where('kode_inv',$data->kode)->first();
                $total = $total->jumlah;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
            if($data->status == 'Belum Diperiksa'){
            return "
                <div class='row'style='width:100%;'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                </div>
                
                ";   
            } elseif ($data->status == 'Sudah Diperiksa') {
            return "
                <div class='row'style='width:100%;'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                    </div>
                </div>
                <div class='row'>
                    <button type='button' class='btn btn-info ' data-toggle='dropdown'>Re-class</button>
                    <button type='button' class='btn btn-info dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item re-belum' style='color:red' data-kode='$data->kode'><b>Belum Diperiksa</b></a>
                    </div>
                </div>
                "; 
            } else {
            return "
                <div class='row'style='width:100%;'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                    </div>
                </div>
                <div class='row'>
                    <button type='button' class='btn btn-info ' data-toggle='dropdown'>Re-class</button>
                    <button type='button' class='btn btn-info dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item re-belum' style='color:red' data-kode='$data->kode'><b>Belum Diperiksa</b></a>
                        <a class='dropdown-item re-sudah' style='color:orange' data-kode='$data->kode'><b>Sudah Diperiksa</b></a>
                    </div>
                </div>
                
                ";
            }
                
            })->make(true);
        } else {
            return DataTables::of($data)
            ->addColumn('tempo',function($data){
                $fdate = $data->tanggal;
                $tdate = $data->tgl_tempo;
                $datetime1 = strtotime($fdate); // convert to timestamps
                $datetime2 = strtotime($tdate); // convert to timestamps
                $days = (int)(($datetime2 - $datetime1)/86400); // will give the difference in days , 86400 is the timestamp difference of a day
                return $days." Hari";
            })
            ->editColumn('perusahaan',function($data){
                if($data->perusahaan == "npa"){
                    return "CV. Nusa Pratama Anugrah";
                } else if($data->perusahaan == "herbivor"){
                    return "PT. Herbivor Satu Nusa";
                } else if($data->perusahaan == "triputra"){
                    return "PT. Triputra Sinergi Indonesia";
                } else {
                    return "-";
                }
            })
            ->addColumn('barang',function($data){
                $barang = detail_invoice::select('barang.nama AS barang')->join('barang','detail_invoice.kode_brg','=','barang.kode')->where('detail_invoice.kode_inv',$data->kode)->get();
                
                $a = "";
                foreach($barang AS $brg){
                    $a = $brg->barang." || ".$a;
                }
                return $a;
            })
            ->addColumn('kekurangan',function($data){
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('keterangan',$data->kode)->where('status',"Selesai")->first();
                $total = detail_invoice::select(DB::raw("SUM(jumlah) AS jumlah"))
                    ->where('kode_inv',$data->kode)->first();
                $total = $total->jumlah;
                $kekurangan = $total-$kas->jumlah;
                return "Rp.".number_format($kekurangan,2,',','.');
            })
            ->addColumn('total',function($data){
                $total = detail_invoice::select(DB::raw("SUM(jumlah) AS jumlah"))
                    ->where('kode_inv',$data->kode)->first();
                $total = $total->jumlah;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                return "
                    <button type='button' class='btn btn-default ' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";   
                } elseif ($data->status == 'Sudah Diperiksa') {
                return "
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                    </div>
                    "; 
                } else {
                return "
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                    
                    </div>
                    ";
                }
                
            })->make(true); 
        }
    }

    public function filterExport(Request $request)
    {
        try{
            if($request->marketing == "all"){
                if($request->konsumen == "all"){
                    if($request->status == "all"){
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('invoice.status',$request->status)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    }    
                } else {
                    if($request->status == "all"){
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.konsumen',$request->konsumen)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('salesorder','invoice.kode_so','=', 'salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.konsumen',$request->konsumen)->where('invoice.status',$request->status)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    }
                }
                
            } else {
                if($request->konsumen == "all"){
                    if($request->status == "all"){
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.marketing',$request->marketing)->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.status',$request->status)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    }    
                } else {
                    if($request->status == "all"){
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.konsumen',$request->konsumen)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = invoice::select('invoice.*','bank.bank AS bank','bank.rekening as rek','bank.atas_nama AS AN')
                                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                                ->join('bank','invoice.kode_bank','=','bank.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.konsumen',$request->konsumen)->where('invoice.status',$request->status)->whereBetween('invoice.tanggal',[$request->awal,$request->akhir])->get();
                    }
                }
            }
            $DATA = array();
            $n = 0;
            foreach($data AS $D){
                
                $detail  = detail_invoice::select('detail_invoice.*','barang.nama AS barang')
                        ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                        ->where('detail_invoice.kode_inv',$D->kode)->get();
                foreach($detail AS $dtl){
                    if($n == 0){
                        $DATA[$n]['INV'] = $dtl->kode_inv;
                    } else {
                        $m = $n-1;
                        if($DATA[$m]['INV'] == $dtl->kode_inv){
                            $DATA[$n]['INV'] = $DATA[$m]['INV'];
                        } else {
                            $DATA[$n]['INV'] = $dtl->kode_inv;    
                        }
                    }
                    $DATA[$n]['tanggal'] = $D->tanggal;
                    $DATA[$n]['so'] = $D->kode_so;
                    $DATA[$n]['sj'] = $D->kode_sj;
                    $DATA[$n]['bank'] = $D->bank." ".$D->rek." AN ".$D->AN;
                    $DATA[$n]['vat'] = $D->vat;
                    $DATA[$n]['tempo'] = $D->tgl_tempo;
                    $DATA[$n]['dp'] = $D->DP;
                    $DATA[$n]['KETERANGAN'] = $D->keterangan;
                    $DATA[$n]['status'] = $D->status;
                    $DATA[$n]['kd_brg'] = $dtl->kode_brg;
                    $DATA[$n]['barang'] = $dtl->barang;
                    $DATA[$n]['request'] = $dtl->nama_request;
                    $DATA[$n]['harga'] = $dtl->harga_jual;
                    $DATA[$n]['hpp'] = $dtl->hpp;
                    $DATA[$n]['diakui'] = $dtl->diakui;
                    $DATA[$n]['dikirim'] = $dtl->dikirim;
                    $DATA[$n]['diterima'] = $dtl->diterima;
                    $DATA[$n]['dpp'] = $dtl->dpp;
                    $DATA[$n]['jumlah'] = $dtl->jumlah;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $n++;    
                }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success'=>true,'data'=>$file]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastkode(Request $request)
    {
        $kode = 'INV.'.$request->tgl.'.';

        $data = invoice::select('kode')->where('kode', 'LIKE', $kode."%")->orderBy('kode','desc')->first();
        if($data == null){
            $kode = $kode.'0001';
            return $kode;
        } else {
            $a = $data->kode;
            $b = Str::substr($a,9,4);
            $a = intval($b);
            $b = $a+1;
            $next = $kode.sprintf('%04s', $b);
            return $next;
        }
    }

    public function dropdowninvsd(Request $request)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->where('kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($inv);
    }
    public function dropdowninvrekanan(Request $request, $kode)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("invoice.kode")
                    ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                    ->where('salesorder.konsumen',$kode)
                    ->where('invoice.status','Sudah Diperiksa')
            		->where('invoice.kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("invoice.kode")
                    ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                    ->where('salesorder.konsumen',$kode)
                    ->where('invoice.status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($inv);
    }
    public function dropdowninv(Request $request)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("kode")
                    ->where('status','Selesai')
            		->where('kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("kode")->where('status','Selesai')
            		->get();
        }
        return response()->json($inv);
    }

    public function dropdownso(Request $request)
    {
        $so = [];
        if($request->has('q')){
            $search = $request->q;
            $so =salesorder::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->where('kode', 'LIKE', "%$search%")
            		->orderBy('kode','desc')
            		->get();
        } else {
            $so = salesorder::select("kode")->where('status','Sudah Diperiksa')->orderBy('kode','desc')
            		->get();
        }
        return response()->json($so);
    }
    public function dropdownsj(Request $request,$kode)
    {
        if($request->has('q')){
            $search = $request->q;
            $sj =suratjalan::select('kode','status')
                ->where('status', 'Selesai')
                ->where('so',$kode)
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $sj =suratjalan::select('kode','status')
                ->where('status', 'Selesai')
                ->where('so',$kode)
                ->get();
        }
        return response()->json($sj);
    }
    
    public function reclass (Request $request,$kode)
    {
        try {
            DB::table('invoice')->where('kode',$kode)
            ->update([
                'status'=>$request->status,
                ]);
            
            DB::table('jurnal')->where('kode_transaksi','LIKE',"$kode%")
            ->update([
                'status'=>$request->status,
                ]);
                
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Reclass Data Invoice";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>"Reclass Berhasil"]);
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
        $data = new invoice();

        try{
            $data->kode = $request->kode;
            $data->tanggal = $request->tanggal;
            $data->kode_so = $request->so;
            $data->kode_sj = $request->sj;
            $data->kode_bank = $request->bank;
            $data->po_req = $request->po;
            $data->vat = $request->vat;
            $data->tgl_tempo = $request->tempo;
            $data->DP = $request->dp;
            $data->keterangan = $request->keterangan;
            $data->status = "Belum Diperiksa";
            $data->created_at = $request->time;
            $data->save();

            
    
            $data = new author();
            $data->transaksi = $request->kode;
            $data->kode_pembuat = $request->author;
            // "created_at" =>  date('Y-m-d H:i:s'),
            $data->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data Invoice";
            $log->save();



            return response()->json(['success'=> true,'author'=>$request->author, 'pesan'=> 'Data Berhasil Ditambahkan']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'pesan'=> $e->getMessage()]) ;
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
    public function selesai($kode)
    {
        try{
            $inv = invoice::where('kode',$kode)->first();
            $jinv = jurnal::select(DB::raw("SUM(qty_debit AS qty)"))->where('kode_transaksi','LIKE',$kode."%")->first();
            
            $sj = suratjalan::where('kode',$inv->kode_so)->where('status',"Selesai")->get();
            $qty = 0;
            foreach($sj AS $j){
                $jurnal = jurnal::select(DB::raw("SUM(qty_debit) AS qty"))->where('kode_transaksi','LIKE',$j."%")->first();
                $qty = $qty + $jurnal->qty;
            }
            if($jinv->qty == $qty){
                //Debit
                $kd = kode_akuntansi::select('kode')->where('jenis',"D")->get();
                $debit = 0;
                foreach($kd AS $d){
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS bayar"))->where('kode_transaksi','LIKE',"KAS%")->where('akun_debit',$d->kode)->where('keterangan',$kode)->where('status',"Selesai")->first();
                    $debit = $debit+$kas->bayar;
                }
                // Kredit
                $kk = kode_akuntansi::select('kode')->where('jenis',"K")->get();
                $kredit = 0;
                foreach($kk AS $k){
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS bayar"))->where('kode_transaksi','LIKE',"KAS%")->where('akun_debit',$d->kode)->where('keterangan',$kode)->where('status',"Selesai")->first();
                    $kredit = $kredit+$kas->bayar;
                }
                $bayar = $debit-$kredit;
                //Tagihan
                $tagihan = jurnal::select(DB::raw("SUM(jumlah_debit) AS tagihan"))->where('kode_transaksi','LIKE',"INV%")->where('keterangan',$kode)->first();
                
                $selisih = $bayar- $tagihan->tagihan;
                if($selisih == 0){
                    DB:: table('invoice')
                    ->where('kode',$kode)
                    ->update(['status'=>'Selesai']);
                    DB::table('jurnal')
                    ->where('kode_transaksi','LIKE',"$kode%")
                    ->update(['status'=>'Selesai']);
                    return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
                } else if($selisih>0) {
                    return response()->json(['success'=>false,'pesan'=>"Kelebihan Bayar <br> Kelebihan : Rp. ".number_format($selisih,2,',','.')]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Kekurangan Bayar <br> Kelebihan : Rp. ".number_format($selisih,2,',','.')]);
                }
                
            } else {
                return response()->json(['success'=>false,'pesan'=>"SJ Belum Terkirim Semua "]);
            }
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function cetakinv($kode)
    {
        $data = [];
        try{
            $inv = invoice::select('invoice.*','rekanan.nama as rekanan','rekanan.telp','bank.bank','bank.rekening','bank.atas_nama','karyawan.nama as marketing', 'salesorder.pembayaran', 'suratjalan.alamat' )
                ->join('salesorder', 'invoice.kode_so','=','salesorder.kode')
                ->join('bank','invoice.kode_bank','=','bank.kode')
                ->join('suratjalan', 'invoice.kode_sj','=','suratjalan.kode')
                ->join ('rekanan','salesorder.konsumen','=','rekanan.kode')
                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                ->where('invoice.kode',$kode)->first();
            $detail = detail_invoice::select('detail_invoice.*','gudang.nama as gudang','barang.nama as barang','barang.satuan')
                ->join('gudang', 'detail_invoice.kode_gdg','=','gudang.kode')
                ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                ->where('detail_invoice.kode_inv',$kode)->get();
                foreach ($detail as $d){
                    $diakui = number_format($d->diakui,2,',','.');
                    $d->diakui2 = $diakui;
                }
            $data['inv']= $inv;
            $data['detail']=$detail;
            $author = author::select('karyawan.nama AS pembuat')->join('karyawan','author.kode_pembuat','=','karyawan.kode')->where('author.transaksi',$kode)->first();
            $data['pembuat'] = $author->pembuat;
            return $data;
        } catch (\Exception $e){
            return $e->getMessage();
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
        try{
            $inv = invoice::select('invoice.*','rekanan.nama as rekanan','bank.bank','bank.rekening','bank.atas_nama','karyawan.nama as marketing', 'salesorder.pembayaran' )
                    ->join('salesorder', 'invoice.kode_so','=','salesorder.kode')
                    ->join('bank','invoice.kode_bank','=','bank.kode')
                    ->join ('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->where('invoice.kode',$kode)->first();
            $total = detail_invoice::select(DB::raw("SUM(jumlah) AS jumlah "))
                        ->where('kode_inv',$kode)->first();
            if($inv->perusahaan == "npa"){
                $inv->namaperusahaan = "CV. Nusa Pratama Anugrah";
            } else if($inv->perusahaan == "herbivor"){
                $inv->namaperusahaan = "PT. Herbivor Satu Nusa";
            } else if($inv->perusahaan == "triputra"){
                $inv->namaperusahaan = "PT. Triputra Sinergi Indonesia";
            } else {
                $inv->namaperusahaan = "-";
            }
            //DETAIL
                $detail = detail_invoice::select('barang.nama')->join('barang','barang.kode','=','detail_invoice.kode_brg')->where('detail_invoice.kode_inv',$kode)->get();
                $nama = "";
                foreach($detail AS $d){
                    $nama = $nama.$d->nama." || ";
                }
                
            //DETAIL
            //KEKURANGAN
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('akun_debit','12')->orWhere('akun_debit','310')->where('keterangan',$kode)->where('status',"Selesai")->first();
                if($kas->jumlah == null){
                    $kekurangan = $total->jumlah;
                } else {
                    $kekurangan = $total->jumlah - $kas->jumlah;
                }
                $data['kekurangan'] = $kekurangan;
            //KEKURANGAN
                        
            $author = author::all()
                    ->where('transaksi',$kode)->first();
            $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            $data['inv'] = $inv;
            $data['author']= $author;
            $data['total']=$total;
            return response()->json(['success'=>true,'data'=>$data,'barang'=>$nama]);

        } catch (\Exception $e) {
            
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;
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
            DB::table('invoice')
            ->where('kode',$kode)
            ->update(['kode_bank'=>$request->bank,'tgl_tempo'=>$request->tempo,'DP'=> $request->DP,'keterangan'=>$request->keterangan]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Invoice";
            $log->save();

            return response()->json(['success'=> true, 'pesan'=> 'Data Berhasil Diubah']);
        }catch (\Exception $e){
            return response()->json(['success'=>false, 'pesan' => $e->getMessage()]);
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
            //INV
            $data = invoice::where('kode',$kode)->first();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Invoice";
            $log->save();
            invoice::where('kode',$kode)->delete();
            detail_invoice::where('kode_inv',$kode)->delete();
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            author::where('transaksi',$kode)->delete();
            
            //SJ
            $logSJ = new log_sistem();
            $logSJ->transaksi = $kode;
            $logSJ->user = $request->user;
            $logSJ->keterangan = "Hapus Data Surat Jalan";
            $logSJ->save();
            DB::table('suratjalan')->where('kode',$data->kode_sj)->delete();
            DB::table('detail_sj')->where('kode_sj',$data->kode_sj)->delete();
            jurnal::where('kode_transaksi','LIKE',"$data->kode_sj%")->delete();
            author::where('transaksi',$data->kode_sj)->delete();

            return response()->json(['success'=>true, 'pesan'=>"Data Berhasil Ditambahkan"]);

        } catch (\Exception $e){
            return response()->json(['success'=>false ,'pesan'=>$e->getMessage()]);
        }
    }
}
