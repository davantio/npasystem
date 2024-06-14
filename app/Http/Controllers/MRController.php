<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\detail_mr;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\materialreceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;

class MRController extends Controller
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
        if ($login->level == "superadmin") {
            $data = materialreceive::select('materialreceive.*', 'purchaseorder.pembayaran', 'rekanan.nama')
                ->leftjoin('purchaseorder', 'materialreceive.transaksi', '=', 'purchaseorder.kode')
                ->leftjoin('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')->orderBy('materialreceive.kode', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barang', function ($data) {
                    $barang = detail_mr::select('barang.nama AS barang')
                        ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                        ->where('detail_mr.kode_mr', $data->kode)->get();
                    return $barang;
                })
                ->editColumn('perusahaan', function ($data) {
                    if ($data->perusahaan == 'npa') {
                        return "CV. Nusa Pratama Anugrah";
                    } else if ($data->perusahaan == "herbivor") {
                        return "PT. Herbivor Satu Nusa";
                    } else if ($data->perusahaan == "triputra") {
                        return "PT. Triputra Sinergi Indonesia";
                    } else {
                        return "-";
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 'Belum Diperiksa') {
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
                    } elseif ($data->status == 'Sudah Diperiksa') {
                        return "
                        <div class='row' style='margin-bottom:1px'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-info ' data-toggle='dropdown'>Re-class</button>
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
                        <div class='row' style='margin-bottom:1px'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>

                            </div>
                        </div>
                        <div class='row'>
                            <button type='button' class='btn btn-info ' data-toggle='dropdown'>Re-class</button>
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
            $data = materialreceive::select('materialreceive.*', 'purchaseorder.pembayaran', 'rekanan.nama')
                ->leftjoin('purchaseorder', 'materialreceive.transaksi', '=', 'purchaseorder.kode')
                ->leftjoin('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')->orderBy('materialreceive.kode', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barang', function ($data) {
                    $barang = detail_mr::select('barang.nama AS barang')
                        ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                        ->where('detail_mr.kode_mr', $data->kode)->get();
                    return $barang;
                })
                ->editColumn('perusahaan', function ($data) {
                    if ($data->perusahaan == 'npa') {
                        return "CV. Nusa Pratama Anugrah";
                    } else if ($data->perusahaan == "herbivor") {
                        return "PT. Herbivor Satu Nusa";
                    } else if ($data->perusahaan == "triputra") {
                        return "PT. Triputra Sinergi Indonesia";
                    } else {
                        return "-";
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 'Belum Diperiksa') {
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
                    } elseif ($data->status == 'Sudah Diperiksa') {
                        return "
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                            <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                        </div>
                        ";
                    } else {
                        return "
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
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
    public function lastkode(Request $request)
    {
        $kode = 'MR.' . $request->jenis . '.' . $request->tanggal . '.';

        $data = materialreceive::select('kode')->where('kode', 'LIKE', "$kode%")->orderBy('kode', 'desc')->first();
        if ($data == null) {
            $kode = $kode . '0001';
            return $kode;
        } else {
            $a = $data->kode;
            $a = Str::substr($a, 11);
            $a = (int)$a;
            $b = $a + 1;
            $next = $kode . sprintf('%04s', $b);
            return $next;
        }
    }
    public function selesai($kode)
    {
        try {
            DB::table('materialreceive')
                ->where('kode', $kode)
                ->update(['status' => 'Selesai']);
            DB::table('jurnal')
                ->where('kode_transaksi', 'LIKE', "$kode%")
                ->update(['status' => 'Selesai']);
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function dropdownpo(Request $request)
    {
        $po = [];
        if ($request->has('q')) {
            $search = $request->q;
            $po = purchaseorder::select("kode")
                ->where('status', 'Sudah Diperiksa')
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $po = purchaseorder::select("kode")->where('status', 'Sudah Diperiksa')->orderBy('updated_at', "DESC")
                ->get();
        }
        return response()->json($po);
    }

    public function dropdownmr(Request $request)
    {
        $po = [];
        if ($request->has('q')) {
            $search = $request->q;
            $po = materialreceive::select("kode")
                ->where('status', 'Sudah Diperiksa')
                ->where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $po = materialreceive::select("kode")->where('status', 'Sudah Diperiksa')
                ->get();
        }
        return response()->json($po);
    }

    public function filterExport(Request $request)
    {
        try {
            if ($request->jenis == "all") {
                if ($request->status == "all") {
                    $data = materialreceive::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                } else {

                    $data = materialreceive::where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                }
            } else {
                $jenis = "MR." . $request->jenis;
                if ($request->status == "all") {
                    $data = materialreceive::where('kode', 'LIKE', "$jenis%")->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                } else {
                    $data = materialreceive::where('kode', 'LIKE', "$jenis%")->where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                }
            }
            $DATA = array();
            $n = 0;
            foreach ($data as $D) {

                $detail  = detail_mr::select('detail_mr.*', 'barang.nama AS barang', 'gudang.nama AS gudang')
                    ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                    ->join('gudang', 'detail_mr.kode_gdg', '=', 'gudang.kode')
                    ->where('detail_mr.kode_mr', $D->kode)->get();
                foreach ($detail as $dtl) {
                    if ($n == 0) {
                        $DATA[$n]['MR'] = $dtl->kode_mr;
                    } else {
                        $m = $n - 1;
                        if ($DATA[$m]['MR'] == $dtl->kode_mr) {
                            $DATA[$n]['MR'] = $DATA[$m]['MR'];
                        } else {
                            $DATA[$n]['MR'] = $dtl->kode_mr;
                        }
                    }
                    $DATA[$n]['tanggal'] = $D->tanggal;
                    $DATA[$n]['transaksi'] = $D->transaksi;
                    $DATA[$n]['KETERANGAN'] = $D->keterangan;
                    $DATA[$n]['status'] = $D->status;
                    $DATA[$n]['kd_brg'] = $dtl->kode_brg;
                    $DATA[$n]['barang'] = $dtl->barang;
                    $DATA[$n]['kd_gdg'] = $dtl->kode_gdg;
                    $DATA[$n]['gudang'] = $dtl->gudang;
                    $DATA[$n]['harga'] = $dtl->harga;
                    $DATA[$n]['dikirim'] = $dtl->dikirim;
                    $DATA[$n]['diakui'] = $dtl->diterima;
                    $DATA[$n]['diterima'] = $dtl->diterima;
                    $DATA[$n]['ongkir'] = $dtl->ongkir;
                    $DATA[$n]['dpp'] = $dtl->dpp;
                    $DATA[$n]['vat'] = $dtl->vat;
                    $DATA[$n]['total'] = $dtl->total;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $tipe = Str::substr($dtl->kode_mr, 3, 2);
                    if ($tipe == "61") {
                        $DATA[$n]['jenis'] = "Purchase Order";
                    } else if ($tipe == "42") {
                        $DATA[$n]['jenis'] = "Pemakaian";
                    } else if ($tipe == "43") {
                        $DATA[$n]['jenis'] = "Produksi";
                    } else if ($tipe == "44") {
                        $DATA[$n]['jenis'] = "Pemindahan";
                    } else {
                    }

                    $n++;
                }
                // $detail = detail_mr::select('detail_mr.*','barang.nama AS barang','gudang.nama AS gudang')
                //         ->join('barang','detail_mr.kode_brg','=','barang.kode')
                //         ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                //         ->where('detail_mr.kode_mr','$D->kode')->get();
                // foreach($detail as $dtl){
                //     // if($n == 0){
                //     //     $DATA[$n]['MR'] = $D->kode;
                //     // } else {
                //     //     $m = $n-1;
                //     //     if($DATA[$m]['MR'] == $dtl->kode_po){
                //     //         $DATA[$n]['MR'] = "";
                //     //         $DATA[$n]['tanggal'] = "";
                //     //         $DATA[$n]['transaksi'] = "";
                //     //         $DATA[$n]['KETERANGAN'] = "";
                //     //         $DATA[$n]['status'] = "";
                //     //     } else {
                //     //         $DATA[$n]['MR'] = $D->kode;
                //     //         $DATA[$n]['tanggal'] = $D->tanggal;
                //     //         $DATA[$n]['transaksi'] = $D->transaksi;
                //     //         $DATA[$n]['KETERANGAN'] = $D->keterangan;
                //     //         $DATA[$n]['status'] = $D->status;
                //     //     }
                //     // }
                //     $tipe = Str::substr($dtl->kode_mr, 3, 2);
                //     if($tipe == "61"){
                //         $DATA[$n]['Jenis'] = "Purchase Order";
                //     } else if($tipe == "42"){
                //         $DATA[$n]['Jenis'] = "Pemakaian";
                //     } else if($tipe == "43"){
                //         $DATA[$n]['Jenis'] = "Produksi";
                //     } else if($tipe == "44"){
                //         $DATA[$n]['Jenis'] = "Pemindahan";
                //     } else {

                //     }
                //     $DATA[$n]['MR'] = $D->kode;
                //     $DATA[$n]['tanggal'] = $D->tanggal;
                //     $DATA[$n]['transaksi'] = $D->transaksi;
                //     $DATA[$n]['KETERANGAN'] = $D->keterangan;
                //     $DATA[$n]['status'] = $D->status;

                //     $DATA[$n]['kode_brg'] = $dtl->kode_brg;
                //     $DATA[$n]['barang'] = $dtl->barang;
                //     $DATA[$n]['kode_gdg'] = $dtl->kode->brg;
                //     $DATA[$n]['gudang'] = $dtl->gudang;
                //     $DATA[$n]['harga'] = $dtl->harga;
                //     $DATA[$n]['dikirim'] = $dtl->dikirim;
                //     $DATA[$n]['diakui'] = $dtl->diterima;
                //     $DATA[$n]['diterima'] = $dtl->diterima;
                //     $DATA[$n]['ongkir'] = $dtl->ongkir;
                //     $DATA[$n]['dpp'] = $dtl->dpp;
                //     $DATA[$n]['vat'] = $dtl->vat;
                //     $DATA[$n]['total'] = $dtl->total;
                //     $DATA[$n]['keterangan'] = $dtl->keterangan;
                //     $n++;
                // }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success' => true, 'data' => $file]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function cetakmr($kode)
    {
        $tipe = Str::substr($kode, 3, 2);
        if ($tipe == 61) {
            try {
                $MR = materialreceive::select('materialreceive.*', 'rekanan.*')
                    ->join('purchaseorder', 'materialreceive.transaksi', '=', 'purchaseorder.kode')
                    ->join('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                    ->where('materialreceive.kode', $kode)->first();
                $detail = detail_mr::select('detail_mr.*', 'barang.nama AS barang', 'barang.satuan AS satuan', 'barang.packing AS packing', 'gudang.nama as gudang', 'gudang.alamat as alamat')
                    ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                    ->join('gudang', 'detail_mr.kode_gdg', '=', 'gudang.kode')
                    ->where('detail_mr.kode_mr', $kode)->get();
                foreach ($detail as $d) {
                    $dikirim = number_format($d->dikirim, 2, ',', '.');
                    $diakui = number_format($d->diakui, 2, ',', '.');
                    $diterima = number_format($d->diterima, 2, ',', '.');

                    $d->dikirim = $dikirim;
                    $d->diakui = $diakui;
                    $d->diterima = $diterima;
                }
                return response()->json(['success' => true, 'mr' => $MR, 'detail' => $detail]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else {
            try {
                $MR = materialreceive::where('kode', $kode)->first();
                $detail = detail_mr::select('detail_mr.*', 'barang.nama AS barang', 'barang.satuan AS satuan', 'barang.packing AS packing', 'gudang.nama as gudang', 'gudang.alamat as alamat')
                    ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                    ->join('gudang', 'detail_mr.kode_gdg', '=', 'gudang.kode')
                    ->where('detail_mr.kode_mr', $kode)->get();
                foreach ($detail as $d) {
                    $dikirim = number_format($d->dikirim, 2, ',', '.');
                    $diakui = number_format($d->diakui, 2, ',', '.');
                    $diterima = number_format($d->diterima, 2, ',', '.');

                    $d->dikirim = $dikirim;
                    $d->diakui = $diakui;
                    $d->diterima = $diterima;
                }
                return response()->json(['success' => true, 'mr' => $MR, 'detail' => $detail]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        }
    }

    public function reclass(Request $request, $kode)
    {
        try {
            // return response()->json(['success'=>false,'pesan'=>$kode]);

            $simpan = DB::table('materialreceive')->where('kode', $kode)
                ->update([
                    'status' => $request->status,
                ]);
            if ($simpan) {
                $jurnal = DB::table('jurnal')->where('kode_transaksi', 'LIKE', "$kode%")
                    ->update([
                        'status' => $request->status,
                    ]);
                if ($jurnal) {
                    $log = new log_sistem();
                    $log->transaksi = $kode;
                    $log->user = $request->user;
                    $log->keterangan = "Reclass Data MR";
                    $ls = $log->save();
                    if ($ls) {
                        return response()->json(['success' => true, 'pesan' => "Reclass Berhasil"]);
                    } else {
                        return response()->json(['success' => false, 'pesan' => "Error Tambah Log"]);
                    }
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Update Status Jurnal MR"]);
                }
            } else {
                return response()->json(['success' => false, 'pesan' => "Error Update Status MR"]);
            }

            // return response()->json(['success'=>true,'pesan'=>"Reclass Berhasil"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
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
        try {
            $data = new materialreceive();
            $data->perusahaan = $request->perusahaan;
            if ($request->jenis == 61) {

                $data->kode = $request->kode;
                $data->perusahaan = $request->perusahaan;
                $data->transaksi = $request->transaksi;
                $data->tanggal = $request->tanggal;
                $data->surat_jalan = $request->sj;
                $data->keterangan = $request->keterangan;
                $data->status = "Belum Diperiksa";
                $data->save();


                $data = new author();
                $data->transaksi = $request->kode;
                $data->kode_pembuat = $request->author;
                // "created_at" =>  date('Y-m-d H:i:s'),
                $data->save();
            } else {

                $data->kode = $request->kode;
                $data->transaksi = $request->transaksi;
                $data->tanggal = $request->tanggal;
                $data->keterangan = $request->keterangan;
                $data->status = "Belum Diperiksa";
                $data->save();

                $data = new author();
                $data->transaksi = $request->kode;
                $data->kode_pembuat = $request->author;
                $data->created_at = $request->time;
                // "created_at" =>  date('Y-m-d H:i:s'),
                $data->save();
            }
            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data MR";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
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
    public function edit($kode)
    {
        //
        try {
            // return response()->json(['success'=>false,'pesan'=>"haii"]);
            $tipe = Str::substr($kode, 3, 2);
            if ($tipe == 61) {
                $data = materialreceive::select('materialreceive.*', 'purchaseorder.tanggal as tanggalpo', 'purchaseorder.pembayaran', 'purchaseorder.vat')
                    ->join('purchaseorder', 'materialreceive.transaksi', '=', 'purchaseorder.kode')
                    ->where('materialreceive.kode', $kode)->first();
                $author = author::select('author.*')
                    ->where('author.transaksi', $kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();

                $total = detail_mr::select(DB::raw("SUM(dpp) AS dpp"), DB::raw("SUM(total) AS total"))->where('kode_mr', $kode)->first();
                $data['dpp'] = $total->dpp;
                $data['total'] = $total->total;
                $vat = detail_mr::select('vat')->where('kode_mr', $kode)->first();
                $data['vat'] = $vat->vat;

                //Nama
                $detail = detail_mr::select('barang.nama as nama')->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')->where('detail_mr.kode_mr', $kode)->get();
                $nama = "";
                foreach ($detail as $d) {
                    $nama = $d->nama . " || ";
                }
                //Nama
                if ($data['perusahaan'] == "npa") {
                    $data['namaperusahaan'] = "CV. Nusa Pratama Anugrah";
                } else if ($data['perusahaan'] == "herbivor") {
                    $data['namaperusahaan'] = "PT. Herbivor Satu Nusa";
                } else if ($data['perusahaan'] == "triputra") {
                    $data['namaperusahaan'] = "PT. Triputra Sinergi Indonesia";
                } else {
                    $data['namaperusahaan'] = "-";
                }
                return response()->json(['success' => true, 'mr' => $data, 'author' => $author, 'barang' => $nama]);
                // return response()->json(['success'=>true,'mr'=> $data,'author'=>$author]);
            } else {
                $data = materialreceive::where('kode', $kode)->first();
                if ($data['perusahaan'] == "npa") {
                    $data['namaperusahaan'] = "CV. Nusa Pratama Anugrah";
                } else if ($data['perusahaan'] == "herbivor") {
                    $data['namaperusahaan'] = "PT. Herbivor Satu Nusa";
                } else if ($data['perusahaan'] == "triputra") {
                    $data['namaperusahaan'] = "PT. Triputra Sinergi Indonesia";
                } else {
                    $data['namaperusahaan'] = "-";
                }
                $author = author::select('author.*')
                    ->where('author.transaksi', $kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();
                return response()->json(['success' => true, 'mr' => $data, 'author' => $author]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'success' => $e->getMessage()]);
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
        try {
            $login = Auth::user();
            DB::table('materialreceive')
                ->where('kode', $kode)
                ->update(['surat_jalan' => $request->sj, 'perusahaan' => $request->perusahaan]);
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Edit Data MR";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $kode)
    {
        //
        materialreceive::where('kode', $kode)->delete();
        detail_mr::where('kode_mr', $kode)->delete();
        author::where('transaksi', $kode)->delete();
        jurnal::where('kode_transaksi', 'LIKE', "$kode%")->delete();
        $log = new log_sistem();
        $log->transaksi = $kode;
        $log->user = $request->user;
        $log->keterangan = "Hapus Data MR";
        $log->save();
        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }
}
