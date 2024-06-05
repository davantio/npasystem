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

class Target_OmsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = targetomset::select('omset.*','karyawan.nama AS marketing')
            ->LeftJoin('karyawan','omset.kd_karyawan','=','karyawan.kode')
            ->orderBy('omset.bulan','desc')
            ->get();
    
        return DataTables::of($data)
        ->addIndexColumn()
        ->editColumn('omset',function($data){
            return "Rp. ". number_format($data->omset,2,",",".");
        })
        // ->editColumn('omset.purchasing_baru',function($data){
        //     if($data->purchasing_baru == NULL){
        //         return "0";
        //     } else {
        //         return $data->purchasing_baru();
        //     }
        // })
        ->addColumn('action',function($data){
            return "
            <div class='row'>
                <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item edit' style='color:orange' data-kode='$data->id' ><b>Edit</b></a>
                    <a class='dropdown-item hapus' style='color:red' data-kode='$data->id' data-nama='$data->marketing' data-bulan ='$data->bulan' ><b>Hapus</b></a>
                </div>
            </div>
            ";
        })
        ->editColumn('plan_penjualan',function($data){
            return "Rp. ".number_format($data->plan_penjualan,2,",",".");
        })
        ->addColumn('KPI',function($data){
            // omset
                $X = (75*$data->omset)/$data->target;
            // omset
            // purchasing
                $Y = (25*$data->purchasing_baru)/$data->purchasing;
            // purchasing
            $KPI = $X+$Y;
            
            if($KPI == 100){
                return "A";
            } elseif($KPI > 85 && $KPI< 100){
                return "A-";
            } elseif($KPI> 69 && $KPI < 86){
                return "B";
            } elseif($KPI > 100){
                return "A+";
            } else {
                return "C";
            }
        })
        ->editColumn('target',function($data){
            return "Rp. ".number_format($data->target,2,",",".");
        })->make(true);
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function update () 
    // {
    //     try{
    //         $data = target_omset::where('omset',NULL)->get();
    //         if($data){
    //             foreach($data AS $d){
                    
    //             }
    //         } else {
    //             return response()->json(['success'=>false,'pesan'=>"Data Tidak Ditemukan"]);
    //         }
            
    //     } catch(\Excepiton $e){
    //         return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
    //     }
        
    // }
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
            $kode = targetomset::select('id')->orderBy('id','DESC')->first();
            if($kode == null){
                $nkode = 1;
            }else {
                $nkode = $kode->id+1;
            }
            $tanggal = $request->bulan."-01";
            // return response()->json(['success'=>false,'pesan'=>$request->omset]);
            $data = new targetomset();
            $data->id            = $nkode;
            $data->kd_karyawan   = $request->marketing;
            $data->bulan         = $tanggal;
            $data->target        = $request->omset;
            $data->purchasing    = $request->purchasing;
            $simpan = $data->save();
            if($simpan){
                $log = new log_sistem();
                $log->transaksi = "target_omset.".$nkode;
                $log->user      = $login->kode_karyawan;
                $log->keterangan = "Tambah Target Omset Marketing";
                $log->save();
                
                return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan"]);    
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Simpan Target"]);
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
    
    public function show($id)
    {
        //
        try{
           
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
            $data = targetomset::select('omset.*','karyawan.nama as marketing')
                    ->join('karyawan','omset.kd_karyawan','=','karyawan.kode')
                    ->where('omset.id',$id)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function updatedata()
    {
        try{
            $login = Auth::user();
            $tanggal = Carbon::now()->format('Y-m');
            // $tanggal = "2023-10";
            $count = targetomset::where('bulan','LIKE',$tanggal."%")->count();
            $target = targetomset::where('bulan','LIKE',$tanggal."%")->get();
            $omset = 0;
            $purchasing = 0;
            // return response()->json(['success'=>false,'pesan'=>$target]);
            
            if($count > 0){
                foreach($target AS $t){
                    $omset = 0;
                    //SALES ORDER
                        $so = salesorder::where('tanggal','LIKE',$tanggal."%")->where('marketing',$t->kd_karyawan)->get();
                        foreach($so AS $s){
                            $detail = detail_so::select(DB::raw("SUM(total) AS jumlah"))->where('kode_so',$s->kode)->first();
                            $omset = $omset + $detail->jumlah;
                        }
                        
                    // SALES ORDER
                    // PLAN
                    $plan = target_marketing::select(DB::raw("SUM(total) as total"))
                        ->where('kd_marketing',$t->kd_karyawan)
                        ->where('tanggal','LIKE',$tanggal."%")
                        ->first(); 
                    
                    // PLAN
                    
                    // DATA PURCHASING
                        $PURCHASING = DB::table('database_marketing')
                                    ->select(DB::raw("COUNT(purchasing.nomor) as purchasing"))
                                    ->join('purchasing', 'database_marketing.kode', '=', 'purchasing.db_marketing')
                                    ->where('database_marketing.PIC', $t->kd_karyawan)
                                    ->where('purchasing.updated_at', 'LIKE', $tanggal."%")
                                    ->first();
                    // DATA PURCHASING
                    $update = targetomset::find($t->id);
                    $update->omset = $omset;
                    $update->plan_penjualan = $plan->total;
                    $update->purchasing_baru = $PURCHASING->purchasing;
                    $update->update();
                }
                $log = new log_sistem();
                $log->transaksi = "update target omset ".$tanggal;
                $log->user      = $login->kode_karyawan;
                $log->keterangan = "Update Target Omset Marketing";
                $log->save();
                if($log->save()){
                    return response()->json(['success'=>true,'pesan'=>"Data Berhasil di Update"]);    
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Save Log"]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Data Tidak Ditemukan"]);
            }
            
            
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
    public function update(Request $request, $id)
    {
        //
        try{
            // return response()->json(['success'=>false,'pesan'=>"Hasii"]);
            $login = Auth::user();
            $target = targetomset::find($id);
            $target->target = $request->omset;
            $target->purchasing = $request->purchasing;
            $update = $target->update();
            if($update){
                $log = new log_sistem();
                $log->transaksi = "target_omset.".$id;
                $log->user  = $login->kode_karyawan;
                $log->keterangan  = "Update Target Omset";
                $save = $log->save();    
                if($save){
                    return response()->json(['success'=>true,'pesan'=>"Data berhasil Diupdate"]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Tambah Log"]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Update Target Omset"]);
            }
            
            
            
            
            
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
            // return response()->json(['success'=>false,'pesan'=>$id]);
            $login = Auth::user();
            $target = targetomset::find($id);
            targetomset::destroy($id);
            $log = new log_sistem();
            $log->transaksi = "Target Omset Marketing ".$id;
            $log->user      = $login->kode_karyawan;
            $log->keterangan = "Hapus Target Omset Marketing";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);  
            
            
            // if(!$login){
            //     return response()->json(['success'=>false,'pesan'=>"Error Login Authentification"]);
            // } else {
            //     $data = target_marketing::where('id',$id)->first();
            //     if(!$data){
            //         return response()->json(['success'=>false,'pesan'=>"Data Tidak Ditemukan"]);
            //     } else {
            //         $hapus = target_marketing::destroy($id);
            //         if(!$hapus){
            //             return response()->json(['success'=>false,'pesan'=>"Data Gagal Dihapus"]);        
            //         } else {
            //             $log = new log_sistem();
            //             $log->transaksi = "Target DB Marketing ".$data->id;
            //             $log->user      = $login->kode_karyawan;
            //             $log->keterangan = "Hapus Data Target DB Marketing";
            //             $log->save();
            //             if(!$log){
            //                 return response()->json(['success'=>false,'pesan'=>"Log Gagal Ditambahkan"]);
            //             } else {
            //                 return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);      
            //             }
            //         }
            //     }
            // }
            
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}