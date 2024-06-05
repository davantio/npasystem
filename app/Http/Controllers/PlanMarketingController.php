<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;
use Throwable;
use App\Models\planmarketing;
use App\Models\author;
use App\Models\karyawan;

class PlanMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();
        if($user->level == 'marketing'){
            $data = planmarketing::select('planmarketing.*','karyawan.nama')
            ->join('karyawan','planmarketing.marketing','=','karyawan.kode')
            ->where('planmarketing.marketing',$user->kode_karyawan)->get();
            return DataTables::of($data)
            ->editColumn('plan',function($data){
                $plan = substr($data->plan,0,50)." ... ";
                return $plan;
            })
            ->addColumn('tanggal',function($data){
                return $data->awal." to ".$data->akhir;
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
        }else {
            $data = planmarketing::select('planmarketing.*','karyawan.nama')
            ->join('karyawan','planmarketing.marketing','=','karyawan.kode')->get();
            return DataTables::of($data)
            ->editColumn('plan',function($data){
                $plan = substr($data->plan,0,50)." ... ";
                return $plan;
            })
            ->addColumn('tanggal',function($data){
                return $data->awal." to ".$data->akhir;
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
            } elseif ($data->status == 'Sudah Diperiksa') {
            return "
                <button type='button' class='btn btn-default'>Action</button>
                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                    <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                    <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
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
                    <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                    <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $awal = $request->awal;
        $day = date('l', strtotime($awal));
        if($day != 'Monday'){
            return response()->json(['success'=>false,'pesan'=>'Pastikan tanggal Awal di hari senin']);
        } else {
            $akhir = $request->akhir;
            $day = date('l', strtotime($akhir));
            if($day != 'Saturday'){
                return response()->json(['success'=>false,'pesan'=>'Pastikan tanggal Akhir di hari Sabtu']);
            } else {
                $datetime1 = strtotime($awal); // convert to timestamps
                $datetime2 = strtotime($akhir); // convert to timestamps
                $days = (int)(($datetime2 - $datetime1)/86400); // will give the difference in days , 86400 is the timestamp difference of a day
                if($days != 5){
                    return response()->json(['success'=>false,'pesan'=>'Input tanggal dalam Minggu yang sama']);
                } else {
                    try{
                        $plan = new planmarketing();
                        $plan->marketing = $request->marketing;
                        $plan->awal = $awal;
                        $plan->akhir = $akhir;
                        $plan->plan = $request->plan;
                        $plan->status = 'Belum Diperiksa';
                        $plan->created_at = $request->time;
                        $plan->save();

                        return response()->json(['success'=>true,'pesan'=>'Plan Berhasil Ditambahkan']);
                    } catch(\Exception $e){
                        return response()->json(['success'=> false,'pesan'=>$e->getMessage()]);
                    }
                }
            }
            
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
            $data = planmarketing::select('planmarketing.*','karyawan.nama')
                    ->join('karyawan','planmarketing.marketing','=','karyawan.kode')
                    ->where('planmarketing.kode',$kode)->first();
            return response()->json(['success'=>true,'data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
            if($request->status == null){
                DB::table('planmarketing')
                ->where('kode',$kode)
                ->update(['awal'=>$request->awal,'akhir'=>$request->akhir,'plan'=>$request->plan]);
                return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diedit']);
            } else {
                DB::table('planmarketing')
                ->where('kode',$kode)
                ->update(['status'=>$request->status]);
                return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diperiksa']);
            }
            
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
    public function destroy($kode)
    {
        //
        try{
            planmarketing::where('kode',$kode)->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
