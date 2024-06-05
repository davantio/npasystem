<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\log_sistem;
use App\Models\db_marketing;
use App\Models\salesorder;
use App\Models\detail_so;
use App\Models\karyawan;
use App\Models\target_marketing;
use App\Models\targetomset;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;

class Target_MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan AS perusahaan','karyawan.nama AS marketing')
            ->leftJoin('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
            ->leftJoin('karyawan','target_marketing.kd_marketing','=','karyawan.kode')
            ->orderBy('id','desc')
            ->get();
    
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('harga',function($data){
            return "Rp. ".number_format($data->harga,2,",",".");
        })
        ->editColumn('total',function($data){
            return "Rp. ".number_format($data->total,2,",",".");
            
        })
        ->addColumn('total_omset',function($data){
            $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_marketing',$data->kd_marketing)->first();    
                return "Rp. ".number_format($target->total,2,",",".");
            
        })->make(true);
    }
    public function filterdata(Request $request)
    {
        try{
            $bulan = $request->bulan;
            if($request->marketing == "ALL"){
                $data = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan as perusahaan','karyawan.nama as marketing')
                    ->join ('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                    ->join ('karyawan','target_marketing.kd_marketing','=','karyawan.kode')
                    ->where('target_marketing.tanggal',"LIKE",$bulan."%")
                    ->orderBy('target_marketing.id','desc')
                    ->get();
                $marketing = "ALL";
                $file = DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('harga',function($data){
                    return "Rp. ".number_format($data->harga,2,",",".");
                })
                ->editColumn('total',function($data){
                    return "Rp. ".number_format($data->total,2,",",".");
                    
                })
                ->make(true);
                $plan = target_marketing::select(DB::raw("SUM(total) as total"))->where('tanggal','LIKE',$bulan."%")->first(); 
                $target = targetomset::select(DB::raw("SUM(target) as target"))->where('bulan','LIKE',$bulan."%")->first();
                if($target){
                    $target = $target->target;
                } else {
                    $target = 0;
                }
                $so = salesorder::where('tanggal','LIKE',$bulan."%")->get();
                $omset = 0;
                foreach($so AS $SO){
                    $detail = detail_so::select(DB::raw('SUM(dpp)AS total'))
                            ->where('kode_so',$SO->kode)
                            ->first();
                    $omset = $omset + $detail->total;
                }
                return response()->json(['success'=>true,'data'=>$file,'marketing'=>$marketing,'target'=>$target,'plan'=>$plan->total,'omset'=>$omset]);
                // return response()->json(['success'=>true,'data'=>$file,'target'=>$target->total,'marketing'=>$marketing->nama,'omset'=>$omset]);
            } else {
                $data = target_marketing::select('target_marketing.*','database_marketing.nama_perusahaan as perusahaan','karyawan.nama as marketing')
                    ->join ('database_marketing','target_marketing.kd_perusahaan','=','database_marketing.kode')
                    ->join ('karyawan','target_marketing.kd_marketing','=','karyawan.kode')
                    ->where('target_marketing.tanggal',"LIKE",$bulan."%")
                    ->where('target_marketing.kd_marketing',$request->marketing)
                    ->orderBy('target_marketing.id','desc')
                    ->get();
                $marketing = karyawan::select('nama')->where('kode',$request->marketing)->first();
                $file = DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('harga',function($data){
                    return "Rp. ".number_format($data->harga,2,",",".");
                })
                ->editColumn('total',function($data){
                    return "Rp. ".number_format($data->total,2,",",".");
                    
                })
                ->addColumn('total_omset',function($data){
                    $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_marketing',$data->kd_marketing)->first();    
                        return "Rp. ".number_format($target->total,2,",",".");
                    
                })->make(true);
                $plan = target_marketing::select(DB::raw("SUM(total) as total"))
                        ->where('kd_marketing',$request->marketing)
                        ->where('tanggal','LIKE',$bulan."%")
                        ->first(); 
                $target = targetomset::select('target')->where('kd_karyawan',$request->marketing)->where('bulan','LIKE',$bulan."%")->first();
                if($target){
                    $target = $target->target;
                } else {
                    $target = 0;
                }
                $so = salesorder::where('marketing',$request->marketing)->where('tanggal','LIKE',$bulan."%")->get();
                $omset = 0;
                
                foreach($so AS $SO){
                    //AKTIFKAN SAAT DATA DAN USER SUDAH SIAP
                    
                    //STATUS SO harus Selesai
                    // $cek = log_sistem::select('transaksi')->where('transaksi',$SO->kode)->where('keterangan','LIKE',"%Selesai")->first();
                    // if($cek){
                    //     $detail = detail_so::select(DB::raw('SUM(dpp)AS total'))
                    //             ->where('kode_so',$SO->kode)
                    //             ->first();
                    //     $omset = $omset + $detail->total;    
                    // } else {
                    //     $omset = $omset + 1;
                    // }
                    // //STATUS SO BEBAS
                    $detail = detail_so::select(DB::raw('SUM(dpp)AS total'))
                            ->where('kode_so',$SO->kode)
                            ->first();
                    $omset = $omset + $detail->total;
                    
                    
                    
                }
                return response()->json(['success'=>true,'data'=>$file,'target'=>$target,'plan'=>$plan->total,'marketing'=>$marketing->nama,'omset'=>$omset]);
            }
            
            // $bulan= Carbon::createFromFormat('Y-m-d', $bulan)
            //             ->firstOfMonth();
            
            // $awal = $bulan->startOfMonth();
            // $akhir = $bulan->endOfMonth();
            
        } catch(\Exception $e) {
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
            $login = Auth::user();
            $kode = target_marketing::select('id')->orderBy('id','DESC')->first();
            if($kode == null){
                $nkode = 1;
            }else {
                $nkode = $kode->id+1;
            }
            
            $data = new target_marketing();
            $data->id = $nkode;
            $data->kd_perusahaan = $request->perusahaan;
            $data->kd_marketing  = $request->marketing;
            $data->tanggal       = $request->tanggal;
            $data->barang        = $request->barang;
            $data->qty           = $request->qty;
            $data->harga         = $request->harga;
            $data->total         = $request->qty*$request->harga;
            $data->save();
            
            $log = new log_sistem();
            $log->transaksi = "Target DB Marketing ".$request->perusahaan.".".$nkode;
            $log->user      = $login->kode_karyawan;
            $log->keterangan = "Tambah Data Target DB Marketing";
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
           $data = target_marketing::select('target_marketing.*','karyawan.nama as marketing')
                    ->join('karyawan','target_marketing.kd_marketing','=','karyawan.kode')
                    ->where('target_marketing.kd_perusahaan',$id)->get();
                    
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
            $data = target_marketing::select('target_marketing.*','karyawan.nama as marketing')
                    ->join('karyawan','target_marketing.kd_marketing','=','karyawan.kode')
                    ->where('target_marketing.id',$id)->first();
            
           
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
            $login = Auth::user();
            $total = $request->harga*$request->qty;
            $data = target_marketing::where('id',$id)->first();
            if($login->level == 'marketing'){
                DB::table('target_marketing')->where('id',$id)
                ->update([
                    'tanggal'=> $request->tanggal,
                    'barang' => $request->barang,
                    'harga'  => $request->harga,
                    'qty'    => $request->qty,
                    'total'  => $total,
                    ]);    
            } else {
                DB::table('target_marketing')->where('id',$id)
                ->update([
                    'kd_marketing' => $request->marketing,
                    'tanggal'=> $request->tanggal,
                    'barang' => $request->barang,
                    'harga'  => $request->harga,
                    'qty'    => $request->qty,
                    'total'  => $total,
                    ]);
            }
            $log = new log_sistem();
            $log->transaksi = "Target DB Marketing".$data->kd_perusahaan.".".$id;
            $log->user      = $login->kode_karyawan;
            $log->keterangan = "Edit Data Target DB Marketing";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
            // $data = aksi_dbmarketing::where('id',$id)->first();
            // DB::table('aksi_dbmarketing')->where('id',$id)
            // ->update([
            //     'tanggal' =>$request->tanggal, 
            //     'jam' => $request->jam,
            //     'laporan' => $request->laporan,
            // ]);
            
            // $log = new log_sistem();
            // $log->transaksi = "Aksi DB Marketing ".$data->kd_perusahaan.$id;
            // $log->user      = $request->user;
            // $log->keterangan = "Edit Data Aksi DB Marketing";
            // $log->save();
            
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
    public function destroy($id)
    {
        //
        try{
            $login = Auth::user();
            if(!$login){
                return response()->json(['success'=>false,'pesan'=>"Error Login Authentification"]);
            } else {
                $data = target_marketing::where('id',$id)->first();
                if(!$data){
                    return response()->json(['success'=>false,'pesan'=>"Data Tidak Ditemukan"]);
                } else {
                    $hapus = target_marketing::destroy($id);
                    if(!$hapus){
                        return response()->json(['success'=>false,'pesan'=>"Data Gagal Dihapus"]);        
                    } else {
                        $log = new log_sistem();
                        $log->transaksi = "Target DB Marketing ".$data->id;
                        $log->user      = $login->kode_karyawan;
                        $log->keterangan = "Hapus Data Target DB Marketing";
                        $log->save();
                        if(!$log){
                            return response()->json(['success'=>false,'pesan'=>"Log Gagal Ditambahkan"]);
                        } else {
                            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);      
                        }
                    }
                }
            }
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}