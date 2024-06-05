<?php

namespace App\Http\Controllers;

use App\Models\salesorder;
use App\Models\detail_so;
use App\Models\karyawan;
use App\Models\rekanan;
use App\Models\author;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\suratjalan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;

class SOController extends Controller
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
            $data = salesorder::select('salesorder.*','rekanan.nama as rekanan','karyawan.nama as karyawan')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->orderBy('salesorder.kode','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('barang',function($data){
                $barang = detail_so::select('barang.nama AS barang')->join('barang','detail_so.kode_brg','=','barang.kode')->where('detail_so.kode_so',$data->kode)->get();
                
                $a = "";
                foreach($barang AS $brg){
                    $a = $brg->barang." || ".$a;
                }
                return $a;
            })
            ->editColumn('tanggal',function($data){
                $data = Carbon::parse($data->tanggal)->format('d F Y');
                return $data;
            })
            ->addColumn('total',function($data){
                $total = detail_so::select(DB::raw("SUM(total) AS jumlah"))
                    ->where('kode_so',$data->kode)->first();
                $total = $total->jumlah;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default'>Action</button>
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
                } elseif ($data->status == 'Sudah Diperiksa' || $data->status == 'ON Progress') {
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-selesai'><b>Selesai</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
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
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                                
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
            $data = salesorder::select('salesorder.*','rekanan.nama as rekanan','karyawan.nama as karyawan')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->orderBy('salesorder.kode','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('barang',function($data){
                $barang = detail_so::select('barang.nama AS barang')->join('barang','detail_so.kode_brg','=','barang.kode')->where('detail_so.kode_so',$data->kode)->get();
                
                $a = "";
                foreach($barang AS $brg){
                    $a = $brg->barang." || ".$a;
                }
                return $a;
            })
            ->editColumn('tanggal',function($data){
                $data = Carbon::parse($data->tanggal)->format('d F Y');
                return $data;
            })
            ->addColumn('total',function($data){
                $total = detail_so::select(DB::raw("SUM(total) AS jumlah"))
                    ->where('kode_so',$data->kode)->first();
                $total = $total->jumlah;
                return "Rp.".number_format($total,2,',','.');
            })
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                            <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                        </div>
                        ";   
                } elseif ($data->status == 'Sudah Diperiksa' || $data->status == 'ON Progress') {
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                            <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-selesai'><b>Selesai</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                        </div>
                        "; 
                } else {
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        //
    }
    public function cetakso($kode)
    {
        try{
            $SO = salesorder::select('salesorder.*','karyawan.nama AS MRKT')
            ->join('karyawan','salesorder.marketing','=','karyawan.kode')
            ->where('salesorder.kode',$kode)->first();
           $date = Carbon::parse($SO->tanggal);
           $tanggal = $date->format('d F Y');
           $SO->date = $tanggal;
           // estimasi diterima
           $terima = Carbon::parse($SO->tgl_diterima);
           $terima = $terima->format('d F Y');
           $SO->estimasi = $terima;
           $konsumen = rekanan::where('kode',$SO->konsumen)->first();
           
           $detail  = detail_so::select('detail_so.*','barang.nama AS barang','barang.satuan AS satuan')
                        ->join('barang','detail_so.kode_brg','=','barang.kode')
                        ->where('detail_so.kode_so',$kode)->get();
            // foreach ($detail AS $d){
            //     $d->harga = number_format($d->harga,2,'','');
            //     $d->qty = number_format($d->qty,2,'','');
            //     $d->dpp = number_format($d->dpp,2,'','');
            //     $d->total = number_format($d->total,2,'','');
            // }
            
            return response()->json(['success'=>true,'so'=>$SO,'konsumen'=>$konsumen,'detail'=>$detail]);
            
            
        } catch(\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function filterExport(Request $request)
    {
        try{
            if($request->marketing == "all"){
                if($request->konsumen == "all"){
                    if($request->status == "all"){
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.status',$request->status)->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    }    
                } else {
                    if($request->status == "all"){
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT', 'rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.konsumen',$request->konsumen)->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.konsumen',$request->konsumen)->where('salesorder.status',$request->status)->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    }
                }
                
            } else {
                if($request->konsumen == "all"){
                    if($request->status == "all"){
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.marketing',$request->marketing)->whereBetween('salesorder.tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                    }    
                } else {
                    if($request->status == "all"){
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.konsumen',$request->konsumen)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                    } else {
                        $data = salesorder::select('salesorder.*','karyawan.nama AS MRKT','rekanan.nama AS KSM')
                                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                                ->where('salesorder.marketing',$request->marketing)->where('salesorder.konsumen',$request->konsumen)->where('status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                    }
                }
            }
            $DATA = array();
            $n = 0;
            foreach($data AS $D){
                
                $detail  = detail_so::select('detail_so.*','barang.nama AS barang')
                        ->join('barang','detail_so.kode_brg','=','barang.kode')
                        ->where('detail_so.kode_so',$D->kode)->get();
                foreach($detail AS $dtl){
                    if($n == 0){
                        $DATA[$n]['SO'] = $dtl->kode_so;
                    } else {
                        $m = $n-1;
                        if($DATA[$m]['SO'] == $dtl->kode_so){
                            $DATA[$n]['SO'] = $DATA[$m]['SO'];
                        } else {
                            $DATA[$n]['SO'] = $dtl->kode_so;    
                        }
                    }
                    $DATA[$n]['tanggal'] = $D->tanggal;
                    $DATA[$n]['konsumen'] = $D->KSM;
                    $DATA[$n]['marketing'] = $D->MRKT;
                    $DATA[$n]['pembayaran'] = $D->pembayaran;
                    $DATA[$n]['vat'] = $D->vat;
                    $DATA[$n]['term_payment'] = $D->term_payment;
                    $DATA[$n]['KETERANGAN'] = $D->keterangan;
                    $DATA[$n]['status'] = $D->status;
                    $DATA[$n]['kd_brg'] = $dtl->kode_brg;
                    $DATA[$n]['barang'] = $dtl->barang;
                    $DATA[$n]['request'] = $dtl->nama_request;
                    $DATA[$n]['harga'] = $dtl->harga;
                    $DATA[$n]['qty'] = $dtl->qty;
                    $DATA[$n]['dpp'] = $dtl->dpp;
                    $DATA[$n]['total'] = $dtl->total;
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
    public function grafikbulanan(Request $request)
    {
        try{
            
            $penjualan = array();
            $marketing = array();
            $carbonDate = Carbon::createFromFormat('Y-m', $request->bulanan);
            $monthName = $carbonDate->format('F Y');
            if($request->marketing == "ALL"){
                $jumlah = 0;
                $m = salesorder::select('salesorder.marketing','karyawan.nama')->join('karyawan','salesorder.marketing','=','karyawan.kode')->where('salesorder.tanggal','LIKE',"$request->bulanan%")->distinct()->get();
                
                
                foreach($m AS $mrt){
                    $all = 0;
                    $data = salesorder::select('salesorder.kode','karyawan.nama')->join('karyawan','salesorder.marketing','=','karyawan.kode')->where('salesorder.marketing',$mrt->marketing)->where('salesorder.tanggal','LIKE',"$request->bulanan%")->get();
                    foreach($data AS $d){
                        $detail = detail_so::select(DB::raw('SUM(total) as JUMLAH'))
                                ->where('kode_so',$d->kode)->first();
                        $d->jumlah = $detail->JUMLAH;
                        $all = $all + $detail->JUMLAH;
                    }
                    $jumlah = $jumlah + $all;
                    $marketing[] = $mrt->nama;
                    $penjualan[] = $all;
                }
                $percentages = array_map(function($value) use ($jumlah) {
                    return round((($value / $jumlah) * 100),2);
                }, $penjualan);
                
                $karyawan = array_map(function($nama, $persentase) {
                    return $nama . " - " . $persentase . "%";
                }, $marketing, $percentages);
                $jml = "Rp. ".number_format($jumlah,2,",",".");
                return response()->json(['success'=>true,'marketing'=>$karyawan,'penjualan'=>$penjualan,'jumlah'=>$jml,'bln'=>$monthName, 'persentase'=>$percentages]);
            } else {
                $jumlah = array();
                $data = salesorder::select('salesorder.kode','salesorder.tanggal','rekanan.nama AS rekanan')
                        ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                        ->where('salesorder.marketing',$request->marketing)->where('salesorder.tanggal','LIKE',"$request->bulanan%")->orderBy('salesorder.tanggal','ASC')->get();
                $all = 0;
                foreach($data AS $d){
                    $d->tanggal = Carbon::parse($d->tanggal)->format('d F Y');
                    $detail = detail_so::select('detail_so.total','barang.nama AS barang')
                            ->join('barang','detail_so.kode_brg','=','barang.kode')
                            ->where('detail_so.kode_so',$d->kode)->get();
                    $total = 0;
                    $barang ="";
                    foreach($detail AS $dtl){
                        $barang = $barang." || ".$dtl->barang;
                        $total = $total + $dtl->total;
                    }
                    $d->barang = $barang;
                    $d->penjualan = "Rp. ".number_format($total,2,",",".");
                    $jumlah[] = $total;
                    $all = $all+ $total;
                }
                $penjualan =array (
                    'kode' => "-",
                    'barang' =>"TOTAL PENJUALAN",
                    'tanggal'=>"-",
                    'rekanan' =>"-",
                    'penjualan' => "Rp. ".number_format($all,2,",","."),
                    );
                $kode = $data->pluck('kode');
                $data->push($penjualan);
                $all = "Rp. ".number_format($all,2,",",".");
                return response()->json(['success'=>true,'label'=>$kode,'value'=>$jumlah,'data'=>$data,'bln'=>$monthName,'all'=>$all]);
            }
            
            
        } catch(\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function grafik(Request $request)
    {
        try{
            $AwalfromDate = Carbon::createFromFormat('Y-m-d', $request->awal."-01")->startOfDay();
            $AkhirfromDate = Carbon::createFromFormat('Y-m-d', $request->akhir."-01")->endOfDay();
            $perusahaan = $request->perusahaan;
            if($perusahaan == "NPA"){
                $nama = "CV. Nusa Pratama Anugrah";
            } else if($perusahaan == "HERBIVOR"){
                $nama = "PT. Herbivor Satu Nusa";
            } else if ($perusahaan == "TRIPUTRA"){
                $nama = "PT. Triputra Sinergi Indonesia";
            } else {
                $nama = "ALL Perusahaan";
            }
            
            $awal = substr($request->awal,-2)+0;
            $akhir = substr($request->akhir,-2);
            $bulan = array();
            $jumlah = array();
            $kode = array();
            $data = array();
            $bln = Carbon::createFromFormat('Y-m', $request->awal);
            $date = $request->awal;
            //selisih tanggal
            $selisih = $AwalfromDate->diffInMonths($AkhirfromDate);
            $tglawal = $AwalfromDate->format('F Y');
            $tglakhir = $AkhirfromDate->format('F Y');
            $title = "Grafik Penjualan ".$nama." Periode ".$tglawal." - ".$tglakhir;
            
            for($a=0;$a<$selisih;$a++){
                $tanggal = $bln->copy()->addMonths($a);
                $nama = $tanggal->format('F Y');
                $tanggal = $tanggal->format('Y-m');
                // $tanggal = $tanggal>format('Y-m');
                $bulan[]=$nama;
                if($request->marketing == "ALL"){
                    // Query Jika Perusahaan 
                    if($perusahaan == "ALL"){
                        $file = salesorder::select(DB::raw("SUM(detail_so.total) AS total "))->join('detail_so','detail_so.kode_so','=','salesorder.kode')->where('salesorder.tanggal','LIKE',"$tanggal%")->first();
                    } else {
                        // $file = salesorder::select(DB::raw("SUM(detail_so.total) AS total "))->join('detail_so','detail_so.kode_so','=','salesorder.kode')->where('salesorder.perusahaan',$perusahaan)->where('salesorder.tanggal','LIKE',"$tanggal%")->first();    
                        $file = salesorder::select(DB::raw("SUM(detail_so.total) AS total "))->join('detail_so','detail_so.kode_so','=','salesorder.kode')->where('salesorder.tanggal','LIKE',"$tanggal%")->first();
                    }
                    
                    if($file->total == NULL){
                        $data[] = 0;
                    } else {
                        $data[] = $file->total;    
                    }
                    // Query Jika Perusahaan 
                    
                    
                } else {
                    $file = salesorder::select(DB::raw("SUM(detail_so.total) AS total "))->join('detail_so','detail_so.kode_so','=','salesorder.kode')->where('salesorder.tanggal','LIKE',"$tanggal%")->where('salesorder.marketing',$request->marketing)->first();
                    if($file->total == NULL){
                        $data[] = 0;
                    } else {
                        $data[] = $file->total;    
                    }
                }
            }
            return response()->json(['success'=>true,'label'=>$bulan,'value'=>$data,'title'=>$title]);
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
    public function grafikpie(Request $request)
    {
        
    }
    public function grafikpiebulanan(Request $request)
    {
        try{
            $data = [
                'Slices 1' => 30,
                'Slices 2' => 20,
                'Slices 3' => 50,
            ];
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function lastkode(Request $request){

        $kode = 'SO.'.$request->jenis.'.'.$request->tanggal.'.';
        $data = salesorder::select('kode')->where('kode','LIKE',"$kode%")->orderBy('kode','desc')->first();
        // return $data;
        if($data == null){
            $kode = $kode.'0001';
            return $kode;
        } else {
            $a = $data->kode;
            $a = Str::substr($a,11);
            
            $a = (int)$a;
            $b = $a+1;
            $next = $kode.sprintf('%04s', $b);
            return $next;
        }
    }
    public function reclass (Request $request,$kode)
    {
        try {
            DB::table('salesorder')->where('kode',$kode)
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
            $log->keterangan = "Reclass Data SO";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>"Reclass Berhasil"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
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
            $SO = new salesorder();
            $SO->kode = $request->kode;
            $SO->perusahaan = $request->perusahaan;
            $SO->jenis = $request->jenis;
            $SO->tanggal = $request->tanggal;
            $SO->konsumen = $request->konsumen;
            $SO->pembayaran = $request->pembayaran;
            $SO->marketing = $request->marketing;
            $SO->no_po = $request->po;
            $SO->tgl_diterima = $request->delivery;;
            $SO->term_payment = $request->term;
            $SO->vat = $request->vat;
            $SO->keterangan = $request->keterangan;
            $SO->status = 'Belum Diperiksa';
            $SO->save();


            $author = new author();
            $author->transaksi = $request->kode;
            $author->kode_pembuat = $request->author;
            $author->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data SO";
            $log->save();

            return response()->json(['success'=>true,'pesan'=> "Data Berhasil Ditembahkan"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
            $data = salesorder::
                select('salesorder.*', 'rekanan.nama as rekanan','rekanan.alamat','karyawan.nama as karyawan')
                ->join('karyawan', 'salesorder.marketing','=','karyawan.kode')
                ->join('rekanan', 'salesorder.konsumen','=','rekanan.kode')
                ->where('salesorder.kode',$id)->first();
            if($data->perusahaan == "npa"){ 
                $data->namaperusahaan = "CV. Nusa Pratama Anugrah" ;
            } else if($data->perusahaan == "herbivor") {
                $data->namaperusahaan = "PT. Herbivor Satu Nusa";
            } else if($data->perusahaan == "triputra") {
                $data->namaperusahaan = "PT. Triputra Sinergi Indonesia";
            } else {
                $data->namaperusahaan = "-";
            }
            $barang = detail_so::select('barang.nama AS barang')->join('barang','detail_so.kode_brg','=','barang.kode')->where('detail_so.kode_so',$id)->get();
            $a = "";
            foreach($barang AS $brg){
                $a = $brg->barang." || ".$a;
            }
            $data['barang'] = $a;
            $total = detail_so::select(DB::raw("SUM(total) AS jumlah"))
                    ->where('kode_so',$id)->first();
            $data['total'] = "Rp.".number_format($total->jumlah,2,',','.');
            $author = author::
                select('author.*')
                ->where('author.transaksi',$id)->first();
            $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            return response()->json(['success'=>true,'so'=> $data,'author'=> $author]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    public function selesai(Request $request,$kode)
    {
        try{
            DB:: table('salesorder')
            ->where('kode',$kode)
            ->update(['status'=>'Selesai']);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data SO Selesai";
            $log->save();

            return response()->json(['success'=>true,'pesan'=>'Data Berhasil diupdate']);
        } catch(\Exception $e) {
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
            DB::table('salesorder')
            ->where('kode', $kode)
            ->update(['marketing' =>$request->marketing,'perusahaan'=>$request->perusahaan, 'konsumen' => $request->konsumen,'pembayaran' => $request->pembayaran,'no_po' => $request->po,'vat'=>$request->vat,'tgl_diterima'=> $request->delivery,'term_payment'=>$request->term,'keterangan' => $request->keterangan,'updated_at'=>$request->time]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data SO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
            salesorder::where('kode',$kode)->delete();
            detail_so::where('kode_so',$kode)->delete();
            author::where('transaksi',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data SO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
