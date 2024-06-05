<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\materialreceive;
use App\Models\kode_akuntansi;
use App\Models\detail_po;
use App\Models\detail_mr;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\image;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;
class POController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $login = Auth::user();
        
        if($login->level == "superadmin"){
            $data = purchaseorder::select('purchaseorder.*','rekanan.nama AS rekanan')
                    ->join('rekanan','purchaseorder.supplier','=','rekanan.kode')->orderBy('purchaseorder.kode','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('barang',function($data){
                $barang = detail_po::select('barang.nama AS barang')
                        ->join('barang','detail_po.kode_brg','=','barang.kode')
                        ->where('kode_po',$data->kode)->get();
                $a ="";
                foreach($barang AS $brg){
                    $a = $brg->barang." || ".$a;
                }
                return $a;
            })
            ->editColumn('perusahaan',function($data){
                if($data->perusahaan == 'npa'){
                    return "CV. Nusa Pratama Anugrah";
                } else if($data->perusahaan == "herbivor"){
                    return "PT. Herbivor Satu Nusa";
                } else if($data->perusahaan == "triputra"){
                    return "PT. Triputra Sinergi Indonesia";
                } else {
                    return "-";
                }
            })
            ->editColumn('pembayaran',function($data){
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('keterangan',$data->kode)->where('status',"Selesai")->first();
                $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"),DB::raw("SUM(ongkir)AS ongkir"))
                    ->where('kode_po',$data->kode)->first();
                $total = $total->jumlah+$total->ongkir;
                if($total == $kas->jumlah){
                    return $data->pembayaran." - Lunas";
                } else {
                    return $data->pembayaran." - Belum Lunas";
                }
            })
            ->addColumn('total',function($data){
                $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"),DB::raw("SUM(ongkir)AS ongkir"))
                    ->where('kode_po',$data->kode)->first();
                $total = $total->jumlah+$total->ongkir;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static' ><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus-po'><b>Hapus</b></a>
                            </div>
                        </div>
                        
                        ";   
                } elseif ($data->status == 'Sudah Diperiksa') {
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static'><b>Edit</b></a>
                            </div>
                        </div>
                        <div class='row'>
                            <button type='button' class='btn btn-info' data-toggle='dropdown'>Re-Class</button>
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
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                
                            </div>
                        </div>
                        <div class='row'>
                            <button type='button' class='btn btn-info' data-toggle='dropdown'>Re-Class</button>
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
            $data = purchaseorder::select('purchaseorder.*','rekanan.nama AS rekanan')
                    ->join('rekanan','purchaseorder.supplier','=','rekanan.kode')->orderBy('purchaseorder.kode','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('barang',function($data){
                $barang = detail_po::select('barang.nama AS barang')
                        ->join('barang','detail_po.kode_brg','=','barang.kode')
                        ->where('kode_po',$data->kode)->get();
                $a ="";
                foreach($barang AS $brg){
                    $a = $a." || ".$brg->barang;
                }
                return $a;
            })
            ->editColumn('perusahaan',function($data){
                if($data->perusahaan == 'npa'){
                    return "CV. Nusa Pratama Anugrah";
                } else if($data->perusahaan == "herbivor"){
                    return "PT. Herbivor Satu Nusa";
                } else if($data->perusahaan == "triputra"){
                    return "PT. Triputra Sinergi Indonesia";
                } else {
                    return "-";
                }
            })
            ->editColumn('pembayaran',function($data){
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('keterangan',$data->kode)->where('status',"Selesai")->first();
                $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"),DB::raw("SUM(ongkir)AS ongkir"))
                    ->where('kode_po',$data->kode)->first();
                $total = $total->jumlah+$total->ongkir;
                if($total == $kas->jumlah){
                    return $data->pembayaran." - Lunas";
                } else {
                    return $data->pembayaran." - Belum Lunas";
                }
            })
            ->addColumn('total',function($data){
                $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"),DB::raw("SUM(ongkir)AS ongkir"))
                    ->where('kode_po',$data->kode)->first();
                $total = $total->jumlah+$total->ongkir;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static' ><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus-po'><b>Hapus</b></a>
                            </div>
                        </div>
                        ";   
                } elseif ($data->status == 'Sudah Diperiksa') {
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static'><b>Edit</b></a>
                            </div>
                        </div>
                        "; 
                } else {
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                
                            </div>
                        </div>
                        "; 
                }
                         
            })->make(true);   
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selesai(Request $request,$kode)
    {
        try{
            
            $mr = materialreceive::where('transaksi',$kode)->where('status',"Selesai")->count();
            if($mr>0){
                
                // Barang yang Diakui
                $mm = materialreceive::select('kode')->where('transaksi',$kode)->where('status',"Selesai")->get();
                $total = 0;
                foreach($mm as $m){
                    $aa = jurnal::select(DB::raw("SUM(jumlah_debit) AS tagihan"))->where('kode_transaksi','LIKE',$m->kode."%")->where('status',"Selesai")->first();
                    $total = $total+$aa->tagihan;
                }
                //Barang yang diakui
                // KAS
                    //Debit
                    $kd = kode_akuntansi::select('kode')->where('jenis',"D")->get();
                    $debit = 0;
                    foreach($kd AS $d){
                        $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS bayar"))->where('kode_transaksi','LIKE',"KAS%")->where('akun_debit',$d->kode)->where('keterangan',$kode)->first();
                        $debit = $debit+$kas->bayar;
                    }
                    // Kredit
                    $kk = kode_akuntansi::select('kode')->where('jenis',"K")->get();
                    $kredit = 0;
                    foreach($kk AS $k){
                        $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS bayar"))->where('kode_transaksi','LIKE',"KAS%")->where('akun_debit',$d->kode)->where('keterangan',$kode)->first();
                        $kredit = $kredit+$kas->bayar;
                    }
                $bayar = $debit-$kredit;
                // KAS
                $selisih = $bayar - $total ;
                if($bayar == $total){
                    DB:: table('purchaseorder')
                    ->where('kode',$kode)
                    ->update(['status'=>'Selesai']);
        
                    $log = new log_sistem();
                    $log->transaksi = $kode;
                    $log->user = $request->user;
                    $log->keterangan = "Edit Data PO Selesai";
                    $log->save();
                   
                    return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
                } elseif($bayar > $total){
                    
                    return response()->json(['success'=>false,'pesan'=>"PO Kelebihan Bayar <br> Kelebihan : Rp. ".number_format($selisih,2,',','.')]);
                }else {
                    
                    return response()->json(['success'=>false,'pesan'=>"PO Belum Dibayar Lunas <br> Kekurangan : Rp. ".number_format($selisih,2,',','.')]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"MR(Penerimaan Barang) Belum Selesai"]);
            }
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function uploadttdpurchasing (Request $request)
    {
        try{
             $request->validate([
                'ttd_purchasing' => 'required|image|max:5000|mimes:png',
            ]);
            if($request->hasFile('ttd_purchasing')){
                
                $foto = $request->file('ttd_purchasing');
                $mimeType = $foto->getMimeType();
                $pisah = Str::after($mimeType, '/');
                $nama_foto = "ttd_purchasing.png";
                $file = public_path('img/'.$nama_foto);
                
                if(file_exists($file)){
                    unlink($file);
                    $foto->move(public_path('img/'), $nama_foto);
                } else {
                    $foto->move(public_path('img/'), $nama_foto);
                }
                return response()->json(['success'=>true,'pesan'=>"TTD Berhasil Diubah"]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function dropdownsupplier(Request $request)
    {
        $supplier = [];
        if($request->has('q')){
            $search = $request->q;
            $supplier = purchaseorder::select('purchaseorder.supplier','rekanan.nama AS NAMA')
                    ->join('rekanan','purchaseorder.supplier','=','rekanan.kode')
                    ->where('NAMA','LIKE',"%$search%")->distinct()->get();
        } else {
            $supplier = purchaseorder::select('purchaseorder.supplier','rekanan.nama AS NAMA')
                    ->join('rekanan','purchaseorder.supplier','=','rekanan.kode')->distinct()->get();
            $all = [
                'supplier'=>'all',
                'NAMA'=>'All',
                ];
            $supplier->push($all);
        }
        return response()->json($supplier);
    }
    public function lastkode(Request $request, $jns){
        
        try{
            $kode = 'PO.'.$request->jenis.'.'.$request->tanggal.'.';
            $data = purchaseorder::where('kode','LIKE',"$kode%")->orderBy('kode','DESC')->first();
            if($data == null){
                $next = $kode.'0001';
            } else {
                $Lkode = $data->kode;
                $angka = Str::substr($Lkode,11,4);
                $a = intval($angka);
                $b = $a+1;
                $next = $kode.sprintf('%04s', $b);
            }
            return response()->json(['success'=>true,'data'=>$next]);
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        

    }
    public function dropdownbarangpo(){
        $data = barang::select('kode','nama','satuan')->get();
        return $data;
    }
    public function cetakpo($kode){
        $data = purchaseorder::where('kode',$kode)->first();
        $supplier = rekanan:: where('kode',$data->supplier)->first();
        $date = Carbon::parse($data->time_delivery);
        $tanggal = $date->format('d F Y');
        $data->tgl = $tanggal;
        $detail = detail_po::select('detail_po.*','barang.nama as nama','barang.satuan')
                    ->join('barang','detail_po.kode_brg','barang.kode')
                    ->where('detail_po.kode_po',$kode)->get();
        foreach($detail AS $d ){
            
            $d->banyak = number_format($d->qty,2,',','.');
        }
        $ttd = image::where('nama','ttd purchasing')->first();
        return response()->json(['po'=> $data,'detail'=> $detail,'supplier'=> $supplier,'ttd'=>$ttd->url]);
        
    }
    
    public function filterExport (Request $request)
    {
        try{
            if($request->supplier == "all"){
                if($request->status == "all"){
                    $data = purchaseorder::whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                } else {
                    $data = purchaseorder::where('status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                }
            } else {
                if($request->status == "all"){
                    $data = purchaseorder::where('supplier',$request->supplier)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                } else {
                    $data = purchaseorder::where('supplier',$request->supplier)->where('status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                }
            }
            $DATA = array();
            $n = 0;
            foreach($data AS $D){
                $rekanan = rekanan::where('kode',$D->supplier)->first();
                $detail = detail_po::select('detail_po.*','barang.nama AS barang')->join('barang','detail_po.kode_brg','=','barang.kode')->where('detail_po.kode_po',$D->kode)->get();
                foreach($detail AS $dtl){
                    if($n == 0){
                        $DATA[$n]['PO'] = $D->kode;
                    } else {
                        $m = $n-1;
                        if($DATA[$m]['PO'] == $dtl->kode_po){
                            $DATA[$n]['PO'] = "";
                        } else {
                            $DATA[$n]['PO'] = $D->kode;    
                        }
                    }
                    
                    $DATA[$n]['tanggal'] = $D->tanggal;
                    $DATA[$n]['kd_supplier'] = $D->supplier;
                    $DATA[$n]['supplier'] = $rekanan->nama;
                    $DATA[$n]['kd_brg'] = $dtl->kode_brg;
                    $DATA[$n]['barang'] = $dtl->barang;
                    $DATA[$n]['harga'] = $dtl->harga;
                    $DATA[$n]['qty'] = $dtl->qty;
                    $DATA[$n]['ongkir'] = $dtl->ongkir;
                    $DATA[$n]['jumlah'] = $dtl->jumlah;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $DATA[$n]['status'] = $D->status;
                    $n++;
                }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success'=>true,'data'=>$file]);
            
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    
    public function reclass (Request $request,$kode)
    {
        try {
            DB::table('purchaseorder')->where('kode',$kode)
            ->update([
                'status'=>$request->status,
                ]);
                
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Reclass Data PO";
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
        try{
            
            $PO = new purchaseorder();
            $PO->kode = $request->kode;
            $PO->perusahaan = $request->perusahaan;
            $PO->tanggal = $request->tanggal;
            $PO->jenis = $request->jenis;
            $PO->supplier = $request->supplier;
            $PO->pembayaran = $request->pembayaran;
            $PO->spk = $request->spk;
            $PO->term_payment = $request->term;
            $PO->vat = $request->vat;
            $PO->time_delivery = $request->delivery;
            $PO->status = "Belum Diperiksa";
            $PO->keterangan = $request->keterangan;
            // return $PO;
            $simpan = $PO->save();
            if($simpan){
                // $data = new author();
                // $data->transaksi = $request->kode;
                // $data->kode_pembuat = $request->author;
                // $data->created_at =  date('Y-m-d H:i:s');
                // $save = $data->save();
                
                // if($save){
                    
                // }else {
                //     return response()->json(['success'=>false,'pesan'=>"Error Tambah Author"]);
                // }
                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->author;
                $log->keterangan = "Tambah Data PO";
                $logs = $log->save();
                if($logs){
                    return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Ditambahkan']);
                } else {
                    return resoinse()->json(['success'=>false,'pesan'=>"Error Tambah Log"]);
                }
                
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Tambah PO"]);
            }
            
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
    public function show($kode)
    {
        //
        try{
            $po = purchaseorder::where('kode',$kode)->first();
            return response()->json(['success'=>true,'data'=> $po]);
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
    public function edit($kode)
    {
        //
        try{
            $data = purchaseorder::
                select('purchaseorder.*', 'rekanan.nama')
                ->join('rekanan', 'purchaseorder.supplier','=','rekanan.kode')
                ->where('purchaseorder.kode',$kode)->first();
                if($data->perusahaan == 'npa'){
                    $data->namaperusahaan = "CV. Nusa Pratama Anugrah";
                } else if($data->perusahaan == "herbivor"){
                    $data->namaperusahaan = "PT. Herbivor Satu Nusa";
                } else if($data->perusahaan == "triputra"){
                    $data->namaperusahaan = "PT. Triputra Sinergi Indonesia";
                } else {
                    $data->namaperusahaan = "-";
                }
                
            $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"),DB::raw("SUM(ongkir)AS ongkir"))
                    ->where('kode_po',$kode)->first();
            $barang = detail_po::select('barang.nama AS barang')->join('barang','detail_po.kode_brg','=','barang.kode')->where('detail_po.kode_po',$kode)->get();
            $a = "";
            foreach($barang AS $brg){
                $a = $brg->barang." || ".$a;
            }
            $total = $total->jumlah+$total->ongkir;
            $data['total'] = $total;
            $data['barang'] = $a;
            //DETAIL
                $detail = detail_po::select('barang.nama')->join('barang','detail_po.kode_brg','=','barang.kode')->where('detail_po.kode_po',$kode)->get();
                $nama = "";
                foreach($detail AS $d){
                    $nama = $nama.$d->nama." || ";
                }
            //DETAIL
            //Kekurangan
            $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('kode_transaksi','LIKE',"KAS%D")->where('akun_debit','LIKE',"12%")->orWhere('akun_debit','LIKE',"30%")->where('keterangan',$kode)->where('status',"Selesai")->first();
            if($kas->jumlah == null){
                $kekurangan = $data->total;
            } else {
                $kekurangan = $data->total-$kas->jumlah;
            }
            
            $data['kekurangan'] = $kekurangan;
            //kekurangan
            
            $author = author::
                select('author.*')
                ->where('author.transaksi',$kode)->first();
            $author['creator'] = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            return response()->json(['success'=>true,'po'=> $data,'author'=> $author, 'barang'=>$nama]);
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
            $po = purchaseorder::where('kode',$kode)->first();
            if($request->vat == $po->vat) {
                DB::table('purchaseorder')
                ->where('kode',$kode)
                ->update(['perusahaan'=>$request->perusahaan,'supplier'=>$request->supplier,'pembayaran'=>$request->pembayaran,'spk'=>$request->spk,'time_delivery'=>$request->delivery,'term_payment'=>$request->term,'keterangan'=>$request->keterangan]);
                
            } else {
                DB::table('purchaseorder')
                ->where('kode',$kode)
                ->update(['perusahaan'=>$request->perusahaan,'supplier'=>$request->supplier,'pembayaran'=>$request->pembayaran,'spk'=>$request->spk,'time_delivery'=>$request->delivery,'term_payment'=>$request->term,'vat'=>$request->vat,'keterangan'=>$request->keterangan]);
  
            }
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data PO";
            $log->save();
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
    public function destroy(Request $request,$kode)
    {
        //
        try{
            purchaseorder::where('kode',$kode)->delete();
            detail_po::where('kode_po',$kode)->delete();
            author::where('transaksi',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data PO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
