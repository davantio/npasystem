<?php

namespace App\Http\Controllers;
use App\Models\wilayah;
use App\Models\log_sistem;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Exception;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dropdownprovinsi(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = wilayah::select("provinsi")
            		->where('provinsi', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $data = wilayah::select("provinsi")
                    ->distinct()
            		->get();
        }
        return response()->json($data);
    }
    public function dropdownkotakota(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            if($search == "Cikampek"||$search == "cikampek"){
                $search = "Karawang";
            }else {
                
            }
            $data = wilayah::select("kota")
        		->where('kota', 'LIKE', "%$search%")
        		->distinct()
        		->get();    
        } else {
            $data = wilayah::select("kota")
                    ->distinct()
            		->get();
        }
        return response()->json($data);
    }
    public function dropdownkota(Request $request,$prov)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $search = $request->q;
            if($search == "Cikampek"||$search == "cikampek"){
                $search = "Karawang";
            }else {
                
            }
            $data = wilayah::select("kota","tipe")
                    ->where('provinsi',$prov)
            		->where('kota', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $data = wilayah::select("kota","tipe")
                    ->where('provinsi',$prov)
                    ->distinct()
            		->get();
        }
        return response()->json($data);
    }
    public function dropdownkecamatan(Request $request,$kota)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = wilayah::select("kecamatan","kodepos")
                    ->where('provinsi',$kota)
            		->where('kota', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $data = wilayah::select("kecamatan","kodepos")
                    ->where('provinsi',$kota)
                    ->distinct()
            		->get();
        }
        return response()->json($data);
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
    public function edit($kode)
    {
       
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
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$kode)
    {
      
    }
}