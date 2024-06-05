<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengiriman;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Carbon\Carbon;
use Throwable;
class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $X = Auth::user();
        if($X->level == 'marketing'){
             $data = pengiriman::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('kg', function($data){
                return "Rp. ".number_format($data->kg,2,",",".");
            })
            ->editColumn('l', function($data){
                return "Rp. ".number_format($data->l,2,",",".");
            })
            ->editColumn('ton', function($data){
                return "Rp. ".number_format($data->ton,2,",",".");
            })
            ->editColumn('pickup', function($data){
                return "Rp. ".number_format($data->pickup,2,",",".");
            })
            ->editColumn('cdd', function($data){
                return "Rp. ".number_format($data->cdd,2,",",".");
            })
            ->editColumn('fuso', function($data){
                return "Rp. ".number_format($data->fuso,2,",",".");
            })
            ->editColumn('tronton', function($data){
                return "Rp. ".number_format($data->tronton,2,",",".");
            })
            ->addColumn('action', function($data){
                    return "
                        -
                    ";       
                
            })->make(true);
        } else {
            $data = pengiriman::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('kg', function($data){
                return "Rp. ".number_format($data->kg,2,",",".");
            })
            ->editColumn('l', function($data){
                return "Rp. ".number_format($data->l,2,",",".");
            })
            ->editColumn('ton', function($data){
                return "Rp. ".number_format($data->ton,2,",",".");
            })
            ->editColumn('pickup', function($data){
                return "Rp. ".number_format($data->pickup,2,",",".");
            })
            ->editColumn('cdd', function($data){
                return "Rp. ".number_format($data->cdd,2,",",".");
            })
            ->editColumn('fuso', function($data){
                return "Rp. ".number_format($data->fuso,2,",",".");
            })
            ->editColumn('tronton', function($data){
                return "Rp. ".number_format($data->tronton,2,",",".");
            })
            ->addColumn('action', function($data){
                    return "
                        <button type='button' class='btn btn-default'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                            <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->id' data-target='#modal-hapus'><b>Hapus</b></a>
                        </div>
                    ";       
                
            })->make(true);
        }
        
    }
    public function filter (Request $request)
    {
        try{
            $X = Auth::user();
            $data = pengiriman:: where('asal',$request->asal)->where('tujuan',$request->tujuan)->get();
            
            if($X->level == 'marketing'){
                $D = DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kg', function($data){
                    return "Rp. ".number_format($data->kg,2,",",".");
                })
                ->editColumn('l', function($data){
                    return "Rp. ".number_format($data->l,2,",",".");
                })
                ->editColumn('ton', function($data){
                    return "Rp. ".number_format($data->ton,2,",",".");
                })
                ->editColumn('pickup', function($data){
                    return "Rp. ".number_format($data->pickup,2,",",".");
                })
                ->editColumn('cdd', function($data){
                    return "Rp. ".number_format($data->cdd,2,",",".");
                })
                ->editColumn('fuso', function($data){
                    return "Rp. ".number_format($data->fuso,2,",",".");
                })
                ->editColumn('tronton', function($data){
                    return "Rp. ".number_format($data->tronton,2,",",".");
                })
                ->addColumn('action', function($data){
                        return "
                            -
                        ";       
                    
                })->make(true);
            } else {
                $D= DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kg', function($data){
                    return "Rp. ".number_format($data->kg,2,",",".");
                })
                ->editColumn('l', function($data){
                    return "Rp. ".number_format($data->l,2,",",".");
                })
                ->editColumn('ton', function($data){
                    return "Rp. ".number_format($data->ton,2,",",".");
                })
                ->editColumn('pickup', function($data){
                    return "Rp. ".number_format($data->pickup,2,",",".");
                })
                ->editColumn('cdd', function($data){
                    return "Rp. ".number_format($data->cdd,2,",",".");
                })
                ->editColumn('fuso', function($data){
                    return "Rp. ".number_format($data->fuso,2,",",".");
                })
                ->editColumn('tronton', function($data){
                    return "Rp. ".number_format($data->tronton,2,",",".");
                })
                ->addColumn('action', function($data){
                        return "
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->id' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        ";       
                    
                })->make(true);
            }
            
            return response()->json(['success'=>true,'data'=>$D]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMassage()]);
        }
        
    }
    public function lastupdate()
    {
        try{
            $last = pengiriman::select('updated_at')->orderBy('updated_at','DESC')->first();
            $date = $last->updated_at;
            //Convert
            $d = Carbon::parse($date);
            $day = $d->isoFormat('dddd');
            $tgl = $d->format('d-M-Y');
            $time = $d->format('H:i:s');
            $output = "Last Update : ".$day." ".$tgl." || ".$time;
            
            // $tanggal = new DateTime($date);
            // $output = $tanggal->format('d-F-Y');
            return response()->json(['success'=>true,'data'=>$output]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMesssage()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastkode()
    {
        $last = barang::max('kode');
        $H  = intval($last);
        $N = $H+1;
        $newkode = sprintf('%09s',$N);
        return response($newkode);
    }
    public function dropdownnama(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =pengiriman::select("nama")
            		->where('nama', 'LIKE', "%$search%")
            		->distinct()
            		->get();
        } else {
            $data = pengiriman::select("nama")
                    ->distinct()
            		->get();
        }
        
        return response()->json($data);
    }
    // public function importbarang(Request $request)
    // {
    //     try{
    //         $this->validate($request, [
    //             'import-file' => 'required|mimes:xls,xlsx'
    //         ]);
    
    //         $file = $request->file('import-file');
            
    //         // $data = Excel::import($file);
    //         $n = 0;
    //         // $data = Excel::import(new BarangImport, $file);
    //         // foreach($data as $D){
    //         //     $n++;
    //         // }

    //         return response()->json(['success'=>true,'pesan'=>$n]);
    //     } catch(\Exception $e){
    //         return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
    //     }
        
    // }
    // public function uploadbarang(Request $request)
    // {
    //     try{
    //         $this->validate($request, [
    //             'upload-file' => 'required|mimes:xls,xlsx'
    //         ]);
    
    //         $file = $request->file('upload-file');
    //         $n = 0;
    //         // $data = Excel::import(new BarangImport,$file);
    //         $data = Excel::toCollection(new BarangImport, $file);
    //         foreach($data AS $D){
    //             $n++;
    //         }
    //         return response()->json(['success'=>true,'data'=>$data,'pesan'=>$n]);

    //     } catch(\Exception $e){
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
            $last = pengiriman::max('id');
            $lastkode  = $last+1;
            
            $pengiriman = new pengiriman();
            $pengiriman->id = $lastkode;
            $pengiriman->jenis = $request->jenis;
            if($request->newnama == null){
                $pengiriman->nama = $request->nama;    
            } else {
                $pengiriman->nama = $request->newnama;
            }
            $pengiriman->asal = $request->asal;
            $pengiriman->prov_tujuan = $request->prov;
            $pengiriman->tujuan = $request->tujuan;
            $pengiriman->kg = $request->kg;
            $pengiriman->l = $request->l;
            $pengiriman->ton = $request->ton;
            $pengiriman->pickup = $request->pickup;
            $pengiriman->cdd = $request->cdd;
            $pengiriman->fuso = $request->fuso;
            $pengiriman->tronton = $request->tronton;
            
           $simpan = $pengiriman->save();
            
            if($simpan){
                
                $log = new log_sistem();
                $log->transaksi = "Pengiriman ".$lastkode;
                $log->user      = $request->user;
                $log->keterangan = "Tambah Data Pengiriman";
                $save = $log->save();
                if($save){
                    return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Ditambahkan']);        
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Gagal Simpan Data Log"]);    
                }
                
            } else {
                return response()->json(['success'=>false,'pesan'=>"Gagal Simpan Data Pengiriman"]);
            }
            
        } catch(Exception $e){
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
            $data = pengiriman::where('id',$id)->first();
            return response()->json(['success'=> true ,'result'=> $data]);
        } catch(Exception $e){
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
            
            if($request->newnama == null){
                $update = DB::table('pengiriman')->where('id',$kode)->update([
                    'jenis' => $request->jenis,
                    'nama'  => $request->nama,
                    'asal'  => $request->asal,
                    'prov_tujuan' => $request->prov,
                    'tujuan'=> $request->tujuan,
                    'kg'    => $request->kg,
                    'l'     => $request->l,
                    'ton'   => $request->ton,
                    'pickup'=> $request->pickup,
                    'cdd'   => $request->cdd,
                    'fuso'  => $request->fuso,
                    'tronton'   => $request->tronton,
                ]);
            } else {
                $update = DB::table('pengiriman')->where('id',$kode)->update([
                    'jenis' => $request->jenis,
                    'nama'  => $request->newnama,
                    'asal'  => $request->asal,
                    'prov_tujuan' => $request->prov,
                    'tujuan'=> $request->tujuan,
                    'kg'    => $request->kg,
                    'l'     => $request->l,
                    'ton'   => $request->ton,
                    'pickup'=> $request->pickup,
                    'cdd'   => $request->cdd,
                    'fuso'  => $request->fuso,
                    'tronton'   => $request->tronton,
                ]);
            }
            if($update){
                $log = new log_sistem();
                $log->transaksi = "Pengiriman ".$kode;
                $log->user = $request->user;
                $log->keterangan = "Edit Data Pengiriman";
                $save = $log->save();
                if($save){
                    return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diupdate"]);
                } else {
                    return response()->json(['success'=>false,'pesan'=>"Error Log Save"]);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Update Pengiriman"]);
            }
        
        } catch(Exception $e){
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
        try{
            $delete = DB::table('pengiriman')
            ->where('id', $kode)
            ->delete();
            if($delete){
                $log = new log_sistem();
                $log->transaksi = "Pengiriman ".$kode;
                $log->user      = $request->user;
                $log->keterangan = "Hapus Data Pengiriman";
                $save = $log->save();
                if($save){
                    return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);       
                } else {
                    return response()->json(['success'=> false,'pesan'=> 'Error Log Save']);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Hapus Pengiriman"]);
            }
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
