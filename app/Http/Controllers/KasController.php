<?php

namespace App\Http\Controllers;

use App\Models\detail_kas;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\kas;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;

class KasController extends Controller
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
        $data = kas::orderBy('kode', 'DESC')->get();
        if($login->level == "superadmin"){
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        ";   
                } elseif ($data->status == 'Sudah Diperiksa') {
                    return "
                        <div class='row'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
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
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if($data->status == 'Belum Diperiksa'){
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                            <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                        </div>
                        ";   
                } elseif ($data->status == 'Sudah Diperiksa') {
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                            <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
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
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                            
                        </div>
                        "; 
                }
                         
            })->make(true);    
        }
        
    }
    
     public function filterExport(Request $request)
    {
        try{
            if($request->jenis == "all"){
                if($request->status == "all"){
                    $data = kas::whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                } else {
                    
                    $data = kas::where('status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                }    
            } else {
                if($request->status == "all"){
                    $data = kas::where('dk',$request->jenis)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                } else {
                    $data = kas::where('dk',$request->jenis)->where('status',$request->status)->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
                }
            }
            $DATA = array();
            $n = 0;
            foreach($data AS $D){
                $DATA[$n]['KAS'] = $D->kode;
                $DATA[$n]['tanggal'] = $D->tanggal;
                $DATA[$n]['jenis'] = $D->dk;
                $DATA[$n]['KETERANGAN'] = $D->keterangan;
                $DATA[$n]['status'] = $D->status;
                $s = 0;
                $detail  = detail_kas::where('kode_kas',$D->kode)->get();
                foreach($detail AS $dtl){
                    
                    
                    $DATA[$n]['transaksi'] = $dtl->kode_transaksi;
                    $DATA[$n]['vat'] = $dtl->vat;
                    $DATA[$n]['harga'] = $dtl->harga;
                    $DATA[$n]['qty'] = $dtl->qty;
                    $DATA[$n]['total'] = $dtl->total;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $n++;
                    $s++;
                }
                for($i=1;$i<$s;$i++){
                    $c = $n-$i;
                    $DATA[$c]['KAS'] = "-";
                    $DATA[$c]['tanggal'] = "-";
                    $DATA[$c]['jenis'] = "-";
                    $DATA[$c]['KETERANGAN'] = "-";
                    $DATA[$c]['status'] = "-";
                }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success'=>true,'data'=>$file]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
        }
    }
    
    
    public function jurnal_kas(Request $request)
    {
        try{
            $n = 0 ;
            $data = [];
            //Sebelum
                $no = 0;
                $data[$n]['no'] = null;
                $data[$n]['tanggal'] = null;
                $data[$n]['transaksi'] = null;
                $data[$n]['keterangan'] = " // Saldo Transaksi Sebelumnya //";
                //Masuk
                    $masuk = detail_kas::select(DB::raw('SUM(detail_kas.total) AS MASUK'))
                                ->join('kas','detail_kas.kode_kas','kas.kode')
                                ->where('detail_kas.debit',$request->kas)
                                ->where('kas.status','Selesai')
                                ->where('kas.tanggal','<',$request->awal)->first();

                    $data[$n]['pemasukkan'] = "Rp.".number_format($masuk->MASUK,2,',','.');
                    
                //Masuk
                //Keluar
                    $keluar = detail_kas::select(DB::raw('SUM(detail_kas.total) AS KELUAR'))
                                ->join('kas','detail_kas.kode_kas','kas.kode')
                                ->where('detail_kas.kredit',$request->kas)
                                ->where('kas.status','Selesai')
                                ->where('kas.tanggal','<',$request->awal)->first();
                    $data[$n]['pengeluaran'] = "Rp.".number_format($keluar->KELUAR,2,',','.');
                //Keluar
                //Saldo
                    $saldo = $masuk->MASUK - $keluar->KELUAR;
                    $data[$n]['saldo'] = "Rp.".number_format($saldo,2,',','.');
                    $sumD = $masuk->MASUK+0;
                    $sumK = $keluar->KELUAR+0;
                //Saldo
            //Sebelum
            //Saat ini

                $DATA = detail_kas::join('kas','detail_kas.kode_kas','kas.kode')
                        ->where('detail_kas.debit',$request->kas)
                        ->where('kas.status','Selesai')
                        ->whereBetween('kas.tanggal',[$request->awal,$request->akhir])
                        ->orWhere('detail_kas.kredit',$request->kas)
                        ->where('kas.status','Selesai')
                        ->whereBetween('kas.tanggal',[$request->awal,$request->akhir])
                        ->orderBy('kas.tanggal','Asc')->get();
                foreach($DATA AS $D){
                    $n++;
                    $no++;
                    $data[$n]['n'] = $n;
                    $data[$n]['no'] = $no;
                    $data[$n]['tanggal'] = $D->tanggal;
                    $data[$n]['transaksi'] = $D->kode;
                    $data[$n]['keterangan'] = $D->keterangan;
                    if($D->dk == 'D'){
                        $data[$n]['pemasukkan'] = "Rp.".number_format($D->total,2,',','.');
                        $data[$n]['pengeluaran'] = "Rp.0,00";
                        $saldo = $saldo + $D->total;
                        $data[$n]['saldo'] = "Rp.".number_format($saldo,2,',','.');
                        $sumD = $sumD+$D->total;
                    } else {
                        $data[$n]['pemasukkan'] = "Rp.0,00";
                        $data[$n]['pengeluaran'] = "Rp.".number_format($D->total,2,',','.');
                        $saldo = $saldo - $D->total;
                        $data[$n]['saldo'] = "Rp.".number_format($saldo,2,',','.');
                        $sumK = $sumK+$D->total;
                    }
                }
            //Saat ini
            //Bawahan
                $n++;
                $data[$n]['no']="N/A";
                $data[$n]['tanggal'] = "N/A";
                $data[$n]['transaksi'] = "N/A";
                $data[$n]['keterangan'] = " // TOTAL //";
                $data[$n]['pemasukkan'] = "Rp.".number_format($sumD,2,',','.');
                $data[$n]['pengeluaran'] = "Rp.".number_format($sumK,2,',','.');
                $sumTotal = $sumD-$sumK;
                $data[$n]['saldo'] = "Rp.".number_format($sumTotal,2,',','.');
            //Bawahan
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function data_kas($dk)
    {
        $data = kas::where('dk',$dk)->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            if($data->status == 'Belum Diperiksa'){
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";   
            } elseif ($data->status == 'Sudah Diperiksa') {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
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
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        
                    </div>
                    "; 
            }
                     
        })->make(true);
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

    public function lastkode(Request $request)
    {
        $kode = 'KAS.'.$request->tanggal.'.';
        $data = kas::select('kode')->where('kode', 'like', $kode.'%')->orderBy('kode','desc')->first();
        if($data == null){
            $kode = $kode.'001';
            return $kode;
        } else {
            $a = $data->kode;
            $a = Str::substr($a,9);
            $a = (int)$a;
            $b = $a+1;
            $next = $kode.sprintf('%03s', $b);
            return $next;
        }
    }
    
    public function reclass (Request $request,$kode)
    {
        try {
            DB::table('kas')->where('kode',$kode)
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
            $log->keterangan = "Reclass Data KAS";
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
            $kas             = new kas();
            $kas->kode       = $request->kode;
            $kas->tanggal    = $request->tanggal;
            $kas->dk         = $request->dk;
            $kas->keterangan = $request->keterangan;
            $kas->status     = "Belum Diperiksa";
            $kas->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Kas";
            $log->save();


            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);
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
        try {
            
            $test = jurnal::select(DB::raw("SUM(jurnal.jumlah_debit) as jumlah"))->join('kodeakuntansi','jurnal.akun_debit','=','kodeakuntansi.kode')->where('jurnal.kode_transaksi','LIKE',"KAS%")->where('kodeakuntansi.jenis',"D")->first();
            
            return response()->json(['success'=>false,'pesan'=>"Rp. ".number_format($test->jumlah,2,',','.')]);
            
            // $data = kas::where('kode',$id)->first();
            // return response()->json(['success'=>true, 'data'=>$data]);
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
     
    public function selesai ($kode)
    {
        try{
            return response()->json(['success'=>false,'pesan'=>$request->user]);
            // $login = Auth::user();
            // DB:: table('kas')
            // ->where('kode',$kode)
            // ->update(['status'=>'Selesai']);
            // DB::table('jurnal')
            // ->where('kode_transaksi','LIKE',"$kode%")
            // ->update(['status'=>'Selesai']);
            // $log = new log_sistem();
            // $log->transaksi = $kode;
            // $log->user = $login->kode_karyawan;
            // $log->keterangan = "Data Kas Selesai";
            // $log->save();
            // return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    
    public function statuskas(Request $request, $kode)
    {
        try{
            
            DB:: table('kas')->where('kode',$kode)
            ->update(['status'=>$request->status]);
            DB::table('jurnal')->where('kode_transaksi','LIKE',"$kode%")
            ->update(['status'=>$request->status]);
            
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Kas ".$request->status;
            $log->save();
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        //
        try {
            
            DB::table('kas')->where('kode',$id)
            ->update(['keterangan'=>$request->keterangan]);

            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Kas";
            $log->save();


            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diedit"]);
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
    
    public function destroy(Request $request,$id)
    {
        //
        try{
            kas::where('kode',$id)->delete();
            detail_kas::where('kode_kas',$id)->delete();
            jurnal::where('kode_transaksi','LIKE',"$id%")->delete();

            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Kas";
            $log->save();

            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
