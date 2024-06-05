<?php

namespace App\Http\Controllers;
use App\Models\author;
use App\Models\purchaseorder;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;
use Throwable;

class AuthorController extends Controller
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
            $data = new author();
            $data->transaksi = $request->transaksi;
            $data->kode_pembuat = $request->pembuat;
            // "created_at" =>  date('Y-m-d H:i:s'),
            $data->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(\Exception $e) {
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
            DB::table('author')
            ->where('transaksi', $kode)
            ->update(['kode_pemeriksa'=>$request->konfirmator ,'updated_at'=>$request->time]);
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"$kode%")
            ->update(['status'=>'Sudah Diperiksa']);
            if($request->type == 'po'){
                DB::table('purchaseorder')
                ->where('kode', $kode)
                ->update(['status'=>'Sudah Diperiksa' ]);
                
            } else if ($request->type == 'mr'){
                DB::table('materialreceive')
                ->where('kode', $kode)
                ->update(['status'=>'Sudah Diperiksa' ]);
            } else if ($request->type == 'so'){
                DB::table('salesorder')
                ->where('kode', $kode)
                ->update(['status'=>'Sudah Diperiksa' ]);
            } else if($request->type == 'sj'){
                DB::table('suratjalan')
                ->where('kode', $kode)
                ->update(['status'=>'Sudah Diperiksa' ]);
            
            } else if ($request->type == 'inv'){
                DB::table('invoice')
                ->where('kode',$kode)
                ->update(['status'=>'Sudah Diperiksa']);
                
            }
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dikonfirmasi']);
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
    }
}
