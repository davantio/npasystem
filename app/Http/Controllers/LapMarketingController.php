<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lapmarketing;
use App\Models\karyawan;
use App\Models\log_sistem;
use App\Models\detail_laporan;
use App\Models\aksi_dbmarketing;
use App\Models\target_marketing;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Response;
use Throwable;

class LapMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Auth::user();
        if($login->level == 'marketing'){
            $marketing = $login->kode_karyawan;
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
                    ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
                    ->where('lapmarketing.marketing',$marketing)
                    ->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                return "
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";   
                
            })->make(true);
        } else {
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
                    ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
                    ->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
            return "
                <div class='row'>
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
                
            })->make(true);
        }
        //
        
    }
    public function data_aktifitas(Request $request)
    {
        try{
            $data= array();
            $n = 0;
            
            if($request->marketing == "all"){
                $marketing =karyawan::select("karyawan.kode", "karyawan.nama")
                    ->join('users','karyawan.kode','=','users.kode_karyawan')
                    ->where('users.level','marketing')
                    ->orWhere('users.level','manager-marketing')
                    ->orWhere('users.level','ceo')
            		->get();
            	
            	foreach($marketing AS $m){
            	    $laporan = lapmarketing::where('tanggal',$request->tanggal)->where('marketing',$m->kode)->get();
                    if ($laporan->count() > 0){
                        foreach($laporan as $lapor){
                            $detail = DB::table('detail_laporan')->select('detail_laporan.*','database_marketing.nama_perusahaan AS company')
                                        ->join('database_marketing','detail_laporan.perusahaan','=','database_marketing.kode')
                                        ->where('detail_laporan.kode_laporan',$lapor->kode)->get();
                            foreach($detail AS $d){
                                $data[$n]['tanggal'] = $lapor->tanggal;
                                $data[$n]['jenis'] = $d->jenis;
                                $data[$n]['perusahaan'] = $d->company;
                                $data[$n]['marketing'] = $m->nama;
                                $data[$n]['laporan'] = $d->laporan;
                                $n++;    
                            }
                            
                        }
                        $aksi = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('aksi_dbmarketing.tanggal',$request->tanggal)->where('aksi_dbmarketing.kd_marketing',$m->kode)->get();
                        if($aksi->count() > 0){
                            foreach($aksi AS $a){
                                $data[$n]['tanggal'] = $a->tanggal;
                                $data[$n]['jenis'] = "Tambah Aksi Database";
                                $data[$n]['perusahaan'] = $a->perusahaan;
                                $data[$n]['marketing'] = $m->nama;
                                $data[$n]['laporan'] = $a->laporan;
                                $n++;
                            }
                            $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                    ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                    ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$m->kode)->get();
                            if($target->count() > 0){
                                foreach($target AS $t){
                                    $data[$n]['tanggal'] = $t->tanggal;
                                    $data[$n]['jenis'] = "Tambah Target Database";
                                    $data[$n]['perusahaan'] = $t->perusahaan;
                                    $data[$n]['marketing'] = $m->nama;
                                    $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                    $n++;
                                }
                            } else {
                            }
                        } else {
                            $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                    ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                    ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$m->kode)->get();
                            if($target->count() > 0){
                                foreach($target AS $t){
                                    $data[$n]['tanggal'] = $t->tanggal;
                                    $data[$n]['jenis'] = "Tambah Target Database";
                                    $data[$n]['perusahaan'] = $t->perusahaan;
                                    $data[$n]['marketing'] = $m->nama;
                                    $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                    $n++;
                                }
                            } else {
                            }
                        }
                    } else {
                        $aksi = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('aksi_dbmarketing.tanggal',$request->tanggal)->where('aksi_dbmarketing.kd_marketing',$m->kode)->get();
                        if($aksi->count() > 0){
                            foreach($aksi AS $a){
                                $data[$n]['tanggal'] = $a->tanggal;
                                $data[$n]['jenis'] = "Tambah Aksi Database";
                                $data[$n]['perusahaan'] = $a->perusahaan;
                                $data[$n]['marketing'] = $m->nama;
                                $data[$n]['laporan'] = $a->laporan;
                                $n++;
                            }
                            $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                    ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                    ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$m->kode)->get();
                            if($target->count() > 0){
                                foreach($target AS $t){
                                    $data[$n]['tanggal'] = $t->tanggal;
                                    $data[$n]['jenis'] = "Tambah Target Database";
                                    $data[$n]['perusahaan'] = $t->perusahaan;
                                    $data[$n]['marketing'] = $m->nama;
                                    $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                    $n++;
                                }
                            } else {
                            }
                        } else {
                            $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                    ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                    ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$m->kode)->get();
                            if($target->count() > 0){
                                foreach($target AS $t){
                                    $data[$n]['tanggal'] = $t->tanggal;
                                    $data[$n]['jenis'] = "Tambah Target Database";
                                    $data[$n]['perusahaan'] = $t->perusahaan;
                                    $data[$n]['marketing'] = $m->nama;
                                    $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                    $n++;
                                }
                            } else {
                            }
                        }
                    }
                    
            	}
            } else {
                $karyawan = karyawan::where('kode',$request->marketing)->first();
                $laporan = lapmarketing::where('tanggal',$request->tanggal)->where('marketing',$request->marketing)->get();
                if ($laporan->count() > 0){
                    foreach($laporan as $lapor){
                        $detail = DB::table('detail_laporan')->select('detail_laporan.*','database_marketing.nama_perusahaan AS company')
                                    ->join('database_marketing','detail_laporan.perusahaan','=','database_marketing.kode')
                                    ->where('detail_laporan.kode_laporan',$lapor->kode)->get();
                        foreach($detail AS $d){
                            $data[$n]['tanggal'] = $lapor->tanggal;
                            $data[$n]['jenis'] = $d->jenis;
                            $data[$n]['perusahaan'] = $d->company;
                            $data[$n]['marketing'] = $karyawan->nama;
                            $data[$n]['laporan'] = $d->laporan;
                            $n++;    
                        }
                        
                    }
                    
                    $aksi = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan')
                            ->join('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
                            ->where('aksi_dbmarketing.tanggal',$request->tanggal)->where('aksi_dbmarketing.kd_marketing',$request->marketing)->get();
                    if($aksi->count() > 0){
                        foreach($aksi AS $a){
                            $data[$n]['tanggal'] = $a->tanggal;
                            $data[$n]['jenis'] = "Tambah Aksi Database";
                            $data[$n]['perusahaan'] = $a->perusahaan;
                            $data[$n]['marketing'] = $karyawan->nama;
                            $data[$n]['laporan'] = $a->laporan;
                            $n++;
                        }
                        $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$request->marketing)->get();
                        if($target->count() > 0){
                            foreach($target AS $t){
                                $data[$n]['tanggal'] = $t->tanggal;
                                $data[$n]['jenis'] = "Tambah Target Database";
                                $data[$n]['perusahaan'] = $t->perusahaan;
                                $data[$n]['marketing'] = $karyawan->nama;
                                $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                $n++;
                            }
                        } else {
                        }
                    } else {
                        $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$request->marketing)->get();
                        if($target->count() > 0){
                            foreach($target AS $t){
                                $data[$n]['tanggal'] = $t->tanggal;
                                $data[$n]['jenis'] = "Tambah Target Database";
                                $data[$n]['perusahaan'] = $t->perusahaan;
                                $data[$n]['marketing'] = $karyawan->nama;
                                $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                $n++;
                            }
                        } else {
                        }
                    }
                } else {
                    $aksi = aksi_dbmarketing::select('aksi_dbmarketing.*','database_marketing.nama_perusahaan AS perusahaan')
                            ->join('database_marketing','aksi_dbmarketing.kd_perusahaan','=','database_marketing.kode')
                            ->where('aksi_dbmarketing.tanggal',$request->tanggal)->where('aksi_dbmarketing.kd_marketing',$request->marketing)->get();
                    if($aksi->count() > 0){
                        foreach($aksi AS $a){
                            $data[$n]['tanggal'] = $a->tanggal;
                            $data[$n]['jenis'] = "Tambah Aksi Database";
                            $data[$n]['perusahaan'] = $a->perusahaan;
                            $data[$n]['marketing'] = $karyawan->nama;
                            $data[$n]['laporan'] = $a->laporan;
                            $n++;
                        }
                        $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$request->marketing)->get();
                        if($target->count() > 0){
                            foreach($target AS $t){
                                $data[$n]['tanggal'] = $t->tanggal;
                                $data[$n]['jenis'] = "Tambah Target Database";
                                $data[$n]['perusahaan'] = $t->perusahaan;
                                $data[$n]['marketing'] = $karyawan->nama;
                                $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                $n++;
                            }
                        } else {
                        }
                    } else {
                        $target = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan')
                                ->join('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                                ->where('target_marketing.tanggal',$request->tanggal)->where('target_marketing.kd_marketing',$request->marketing)->get();
                        if($target->count() > 0){
                            foreach($target AS $t){
                                $data[$n]['tanggal'] = $t->tanggal;
                                $data[$n]['jenis'] = "Tambah Target Database";
                                $data[$n]['perusahaan'] = $t->perusahaan;
                                $data[$n]['marketing'] = $karyawan->nama;
                                $data[$n]['laporan'] = $t->barang." x ".$t->qty." x Rp.".number_format($t->harga,2,",",".")." = Rp.".number_format($t->total,2,",",".");
                                $n++;
                            }
                        } else {
                        }
                    }
                }
                
            }
            $file = Datatables::of($data)
                ->addIndexColumn()->make(true);
            return response()->json(['success'=>true,'data'=>$file]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function reclass(Request $request,$kode)
    {
        try{
            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = "Re-Class Data Laporan Harian Marketing";
            $log->save();
            
            lapmarketing::where('kode',$kode)
            ->update([
                'status'=>"Belum Diperiksa",
                ]);
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    public function laporan($id)
    {
        
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
    public function lap_marketing($tanggal)
    {
        $awal = Str::substr($tanggal,0,10);
        $akhir = Str::substr($tanggal,10);
        $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
        ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
        ->whereBetween('lapmarketing.tanggal',[$awal,$akhir])->get();
        return DataTables::of($data)
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
        } elseif ($data->status == 'Sudah Diperiksa') {
        return "
            <button type='button' class='btn btn-default'>Action</button>
            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function input (Request $request)
    {
        try{
            //CEK
            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Laporan Harian Marketing";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);    
        }catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    
    public function konfirmasi (Request $request,$kode)
    {
        try{
            lapmarketing::where('kode',$kode)
            ->update([
                'status' => "Sudah Diperiksa",
                ]);
            
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Konfirmasi Data Laporan Harian Marketing";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dikonfirmasi"]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    
    public function store(Request $request)
    {
        //
        try {
            //CEK
            $cek = lapmarketing::where('marketing',$request->marketing)
                    ->where('tanggal',$request->tanggal)->first();
            if(!$cek){
                //last kode
                $kode = lapmarketing::latest('kode')->first();
                if(!$kode){
                    $kode = 1;
                } else {
                    $kode = $kode->kode +1;
                }
                $data = new lapmarketing();
                $data->kode      = $kode;
                $data->marketing = $request->marketing;
                $data->tanggal = $request->tanggal;
                $data->status = 'Belum Diperiksa';
                $data->save();
                return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan','kode'=>$kode]);    
            } else {
                return response()->json(['success'=>false,'pesan'=>'Data Telah Ditambahkan Sebelumnya']);
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
    public function show($marketing)
    {
        //
        $user = Auth::user();
        if($user->level == 'marketing')
        {
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
            ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
            ->where('lapmarketing.marketing',$marketing)->get();
            return DataTables::of($data)
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
            } elseif ($data->status == 'Sudah Diperiksa') {
            return "
                <button type='button' class='btn btn-default'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
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
        else 
        {
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
            ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
            ->where('lapmarketing.marketing',$marketing)->get();
            return DataTables::of($data)
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
            } elseif ($data->status == 'Sudah Diperiksa') {
            return "
                <button type='button' class='btn btn-default'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //
        try {
            $data = lapmarketing::select('lapmarketing.*', 'karyawan.nama')
                    ->join ('karyawan','lapmarketing.marketing','=','karyawan.kode')
                    ->where('lapmarketing.kode',$kode)->first();
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
    public function update(Request $request, $kode)
    {
        //
        try{
            
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
        }catch (\Exception $e){
           return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function hapus(Request $request)
     {
         try{
            
            detail_laporan::join('lapmarketing','detail_laporan.kode_laporan','=','lapmarketing.kode')->where('lapmarketing.marketing',$request->marketing)->where('lapmarketing.tanggal',$request->tanggal)->delete();
            lapmarketing::where('marketing',$request->marketing)->where('tanggal',$request->tanggal)->delete();
            return response()->json(['success'=>true,'pesan'=>"Data berhasil Dihapus"]);
         } catch(\Exception $e){
             return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
         }
     }
    public function destroy(Request $request, $kode)
    {
        //
        try{
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Laporan";
            $log->save();
            lapmarketing::where('kode',$kode)->delete();
            detail_laporan::where('kode_laporan',$kode)->delete();
            
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
