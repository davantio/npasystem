<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\hpp;
use App\Models\jurnal;
use App\Models\log_sistem;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;

class HppController extends Controller
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
    public function updatehpp()
    {
        try{
            // $data = log_sistem::whereRaw('id MOD 2 != 0')->get();
            // if($data){
            //     return response()->json(['success'=>true,'pesan'=>"Data Ditemukan"]);
            // } else {
            //     return response()->json(['success'=>false,'pesan'=>"Data Not Found"]);
            // }
            $login = Auth::user();
            $now = Carbon::today();
            $tgl = $now->format('Y-m-d');
            $barang = barang::all();
            $masuk = 0; $keluar = 0;
            //CEK update
                $cek = hpp::select('tanggal')->orderBy('id','DESC')->first();
                if($cek->tanggal == $tgl){
                        return response()->json(['success'=>false,'pesan'=>"Hari ini HPP sudah di update"]);
                    } else {
                        
                    }
            //CEK update
            // $data = array();
            foreach($barang AS $brg){
                $hpp = hpp::where('barang',$brg->kode)->first();
                $last = hpp::where('barang',$brg->kode)->orderBy('id','DESC')->first();
                $count = hpp::where('barang',$brg->kode)->count();
                if($count > 5){
                    $hps = hpp::where('id',$hpp->id)->delete();
                    
                } else {
                    
                }
                if($last){
                     $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'),DB::raw('SUM(ongkir) as ONGKIR'))
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$brg->kode)
                        ->where('created_at','<',$tgl)
                        ->where('status','Selesai')->first();
                    if(!$jurnal){
                        $jumlah = $last->total;;
                        $qty = $last->qty;
                        $ongkir = $last->ongkir;
                        $HPP = $last->hpp;
                    } else {
                        
                        $jumlah = $last->total+$jurnal->JUMLAH;
                        $qty = $last->qty+$jurnal->QTY;
                        $ongkir = $last->ongkir+$jurnal->ONGKIR;
                        if($qty == 0){
                            $HPP = $ongkir+$jumlah;
                        } else {
                            $HPP = ($ongkir+$jumlah)/$qty;    
                        }
                        
                        
                    }
                } else {
                    $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'),DB::raw('SUM(ongkir) as ONGKIR'))
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$brg->kode)
                        ->where('created_at','<',$tgl)
                        ->where('status','Selesai')->first();
                    if(!$jurnal){
                        $qty = 0;
                        $jumlah = 0;
                        $ongkir = 0;
                        $HPP = 0;
                    } else {
                        
                        if($jurnal->QTY == NULL){
                            $qty =  0;
                        }else {
                            $qty =  $jurnal->QTY;    
                        }
                        if($jurnal->JUMLAH == NULL){
                            $jumlah = 0;
                        } else {
                            $jumlah = $jurnal->JUMLAH;
                        }
                        if($jurnal->ONGKIR == NULL){
                            $ongkir = 0;
                        } else {
                            $ongkir = $jurnal->ONGKIR;
                        }
                        if($qty == 0){
                            $HPP = $jumlah+$ongkir;
                        } else {
                            $HPP = ($jumlah+$ongkir)/$qty;    
                        }
                        
                    }
                }
                $data = new hpp();
                $data->tanggal = $tgl;
                $data->barang = $brg->kode;
                $data->qty = $qty;
                $data->ongkir = $ongkir;
                $data->total = $jumlah;
                $data->hpp  = $HPP;
                $simpan = $data->save();
                if($simpan){
                    
                    $log = new log_sistem();
                    $log->transaksi = "Tambah HPP";
                    $log->user = $login->kode_karyawan;
                    $log->keterangan = "Update HPP";
                    $tes = $log->save();
                    if($tes){
                        $masuk = $masuk+1;    
                    } else {
                        return response()->json(['success'=>false,'pesan'=>"Log Gagal Ditambahkan"]);
                    }
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Data Gagal Ditambahkan"]);
                }
                // $A = $tgl.", ".$brg->kode.", ".$qty.", ".$ongkir.", ".$jumlah.", ".$HPP;
                // $data[] = $A;
                
            }
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Ditambahkan",'data'=>$masuk]);
            
           
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    
    public function store(Request $request)
    {
        //
        try{
            $now = Carbon::today();
            $barang = barang::all();
            foreach($barang AS $brg){
                $hpp = hpp::where('barang',$brg->kode)->orderBy('id','DESC')->first();
                if($hpp){
                    return response()->json(['success'=>true,'data'=>"masuk"]);
                } else {
                    return response()->json(['success'=>false,'data'=>"keluar"]);
                }
            }
            
            // foreach($barang AS $brg){
            //     $hpp = hpp::where('barang',$brg->kode)->orderBy('id','DESC')->first();
            //     if(!$hpp){
            //         $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'),DB::raw('SUM(ongkir) as ONGKIR'))
            //             ->where('kode_transaksi','LIKE',"MR%D")
            //             ->where('kode_brg',$brg->kode)
            //             ->where('created_at','<',$request->created)
            //             ->where('status','Selesai')->first();
            //         if(!$jurnal){
            //             $jumlah = 0;
            //             $qty = 0;
            //             $HPP = 0;
            //         } else {
            //             $jumlah = $jurnal->JUMLAH;
            //             $qty = $jurnal->QTY;
            //             $ongkir = $jurna->ONGKIR;
            //             $HPP = ($jurnal->ONGKIR + $jurnal->JUMLAH)/$jurnal->QTY;
            //         }
            //     } else {
            //         $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'),DB::raw('SUM(ongkir) as ONGKIR'))
            //             ->where('kode_transaksi','LIKE',"MR%D")
            //             ->where('kode_brg',$brg->kode)
            //             ->whereBetween('created_at',[$hpp->tanggal,$request->created])
            //             ->where('status','Selesai')->first();
            //         if(!$jurnal){
            //             $qty = $hpp->qty;
            //             $jumlah = $hpp->total;
            //             $ongkir = $hpp->ongkir;
            //             $HPP = $hpp->hpp;
            //         } else {
            //             $qty = $hpp->qty + $jurnal->QTY;
            //             $jumlah = $hpp->total + $jurnal->JUMLAH;
            //             $ongkir = $hpp->ongkir + $jurnal->ONGKIR;
            //             $HPP = ($jumlah+$ongkir)/$qty;
            //         }
                    
            //     }
                
            //     $data = new hpp();
            //     $data->tanggal = $request->tanggal;
            //     $data->barang = $brg->kode;
            //     $data->qty = $qty;
            //     $data->ongkir = $ongkir;
            //     $data->total = $jumlah;
            //     $data->hpp  = $HPP;
            //     $data->save();
            // }
            // return response()->json(['success'=>true,'pesan'=>"Data berhasil Ditambahkan"]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
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
    public function update(Request $request, $id)
    {
        //
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
