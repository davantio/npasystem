<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\suratjalan;
use App\Models\salesorder;
use App\Models\detail_sj;
use App\Models\detail_so;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\log_sistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Response;

class SJController extends Controller
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
            $data = suratjalan::select('suratjalan.*', 'rekanan.nama')
                ->leftJoin('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                ->leftJoin('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->orderBy('suratjalan.kode', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tgl_diterima', function ($data) {
                    if ($data->tgl_diterima == null) {
                        return "NULL";
                    } else {
                        return $data->tgl_diterima;
                    }
                })
                ->editColumn('tgl_kirim', function ($data) {
                    $data = Carbon::parse($data->tgl_kirim)->format('d F Y');
                    return $data;
                })
                ->editColumn('tgl_diterima', function ($data) {
                    $data = Carbon::parse($data->tgl_diterima)->format('d F Y');
                    return $data;
                })
                ->editColumn('perusahaan', function ($data) {
                    if ($data['perusahaan'] == "npa") {
                        return "CV. Nusa Pratama Anugrah";
                    } else if ($data['perusahaan'] == "herbivor") {
                        return "PT. Herbivor Satu Nusa";
                    } else if ($data['perusahaan'] == "triputra") {
                        return "PT. Triputra Sinergi Indonesia";
                    } else {
                        return "-";
                    }
                })
                ->addColumn('barang', function ($data) {
                    $barang = detail_sj::select('barang.nama AS barang')->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')->where('detail_sj.kode_sj', $data->kode)->get();

                    $a = "";
                    foreach ($barang as $brg) {
                        $a = $brg->barang . " || " . $a;
                    }
                    return $a;
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 'Belum Diperiksa') {
                        return "
                            <div class='row'>
                                <button type='button' class='btn btn-default'>Action</button>
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
                    } elseif ($data->status == 'Sudah Diperiksa') {
                        return "
                            <div class='row'>
                                <button type='button' class='btn btn-default'>Action</button>
                                <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                    <span class='sr-only'>Toggle Dropdown</span>
                                </button>
                                <div class='dropdown-menu' role='menu'>
                                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                                    <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-selesai'><b>Selesai</b></a>
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
                                    <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>

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
            $data = suratjalan::select('suratjalan.*', 'rekanan.nama')
                ->leftJoin('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                ->leftJoin('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')->orderBy('suratjalan.tanggal', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tgl_diterima', function ($data) {
                    if ($data->tgl_diterima == null) {
                        return "NULL";
                    } else {
                        return $data->tgl_diterima;
                    }
                })
                ->editColumn('tanggal', function ($data) {
                    $data = Carbon::parse($data->tanggal)->format('d F Y');
                    return $data;
                })
                ->editColumn('tgl_kirim', function ($data) {
                    $data = Carbon::parse($data->tgl_kirim)->format('d F Y');
                    return $data;
                })
                ->editColumn('tgl_diterima', function ($data) {
                    $data = Carbon::parse($data->tgl_diterima)->format('d F Y');
                    return $data;
                })
                ->addColumn('barang', function ($data) {
                    $barang = detail_sj::select('barang.nama AS barang')->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')->where('detail_sj.kode_sj', $data->kode)->get();

                    $a = "";
                    foreach ($barang as $brg) {
                        $a = $brg->barang . " || " . $a;
                    }
                    return $a;
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == 'Belum Diperiksa') {
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
                                <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-selesai'><b>Selesai</b></a>
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

    public function filterExport(Request $request)
    {
        try {
            if ($request->perusahaan == "all" || $request->perusahaan == '') {
                if ($request->konsumen == "all") {
                    if ($request->status == "all") {
                        $data = suratjalan::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    } else {

                        $data = suratjalan::where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    }
                } else {
                    if ($request->status == "all") {
                        $data = suratjalan::where('konsumen', $request->konsumen)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    } else {
                        $data = suratjalan::where('konsumen', $request->konsumen)->where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    }
                }
            } else {
                if ($request->konsumen == "all") {
                    if ($request->status == "all") {
                        $data = suratjalan::where('perusahaan', $request->perusahaan)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    } else {

                        $data = suratjalan::where('perusahaan', $request->perusahaan)->where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    }
                } else {
                    if ($request->status == "all") {
                        $data = suratjalan::where('perusahaan', $request->perusahaan)->where('konsumen', $request->konsumen)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    } else {
                        $data = suratjalan::where('perusahaan', $request->perusahaan)->where('konsumen', $request->konsumen)->where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                    }
                }
            }

            $DATA = array();
            $n = 0;
            foreach ($data as $D) {

                $detail  = detail_sj::select('detail_sj.*', 'barang.nama AS barang', 'gudang.nama AS gudang', 'barang.satuan AS satuan')
                    ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                    ->join('gudang', 'detail_sj.kode_gdg', '=', 'gudang.kode')
                    ->where('detail_sj.kode_sj', $D->kode)->get();
                foreach ($detail as $dtl) {
                    if ($n == 0) {
                        $DATA[$n]['SJ'] = $dtl->kode_sj;
                    } else {
                        $m = $n - 1;
                        if ($DATA[$m]['SJ'] == $dtl->kode_sj) {
                            $DATA[$n]['SJ'] = $DATA[$m]['SJ'];
                        } else {
                            $DATA[$n]['SJ'] = $dtl->kode_sj;
                        }
                    }
                    $DATA[$n]['tanggal'] = $D->tanggal;
                    $DATA[$n]['so'] = $D->so;
                    $DATA[$n]['tgl_kirim'] = $D->tgl_kirim;
                    $DATA[$n]['tgl_terima'] = $D->tgl_terima;
                    $DATA[$n]['ekspedisi'] = $D->ekspedisi;
                    $DATA[$n]['nopol'] = $D->nopol;
                    $DATA[$n]['no_resi'] = $D->no_resi;
                    $DATA[$n]['KETERANGAN'] = $D->keterangan;
                    $DATA[$n]['status'] = $D->status;
                    $DATA[$n]['kd_brg'] = $dtl->kode_brg;
                    $DATA[$n]['barang'] = $dtl->barang;
                    $DATA[$n]['satuan'] = $dtl->satuan;
                    $DATA[$n]['request'] = $dtl->nama_request;
                    $DATA[$n]['kd_gdg'] = $dtl->kode_gdg;
                    $DATA[$n]['gudang'] = $dtl->gudang;
                    $DATA[$n]['qty'] = number_format($dtl->qty, 2, ',', '.');
                    $DATA[$n]['ongkir'] = $dtl->ongkir;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $n++;
                }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success' => true, 'data' => $file]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastkode(Request $request)
    {
        $kode = 'SJ.' . $request->jenis . '.' . $request->tanggal . '.';

        $data = suratjalan::select('kode')->where('kode', 'LIKE', "$kode%")->orderBy('kode', 'desc')->first();
        if ($data == null) {
            $kode = $kode . '0001';
            return $kode;
        } else {
            $a = $data->kode;
            $a = Str::substr($a, 11, 4);
            $a = (int)$a;
            $b = $a + 1;
            $next = $kode . sprintf('%04s', $b);
            return $next;
        }
    }
    public function dropdownso(Request $request)
    {
        $so = [];
        if ($request->has('q')) {
            $search = $request->q;
            $so = salesorder::select("kode")
                ->where('status', 'Sudah Diperiksa')
                ->orWhere('status', 'Selesai')
                ->orWhere('status', 'ON Progress')
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $so = salesorder::select("kode")
                ->where('status', 'Sudah Diperiksa')
                ->orWhere('status', 'Selesai')
                ->orWhere('status', 'ON Progress')
                ->get();
        }
        return response()->json($so);
    }
    public function dropdownbarangso(Request $request, $kode)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $so = detail_so::select("detail_so.kode_brg as kode", 'barang.nama')
                ->join('barang', 'detail_so.kode_brg', '=', 'barang.kode')
                ->where('detail_so.kode_so', $kode)
                ->where('barang.nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $so = detail_so::select("detail_so.kode_brg as kode", 'barang.nama')
                ->join('barang', 'detail_so.kode_brg', '=', 'barang.kode')
                ->where('detail_so.kode_so', $kode)
                ->get();
        }
        return response()->json($so);
    }
    public function dropdownsj(Request $request, $kode)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $kode = "SJ";
            $sj = suratjalan::select('kode')
                ->where('kode', 'LIKE', "SJ." . $kode . "%")
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $sj = suratjalan::select("kode")
                ->where('kode', 'LIKE', "SJ." . $kode . "%")
                ->get();
        }
        return response()->json($sj);
    }

    public function reclass(Request $request, $kode)
    {
        try {
            DB::table('suratjalan')->where('kode', $kode)
                ->update([
                    'status' => $request->status,
                ]);

            DB::table('jurnal')->where('kode_transaksi', 'LIKE', "$kode%")
                ->update([
                    'status' => $request->status,
                ]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Reclass Data SJ";
            $log->save();

            return response()->json(['success' => true, 'pesan' => "Reclass Berhasil"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
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
        //

        $SO = salesorder::select('salesorder.*','rekanan.nama','karyawan.nama as mrkting')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->where('salesorder.kode',$request->so)->first();

        if ($request->tipe == 41) {
            try {

                $data = new suratjalan();
                $data->kode = $request->kode;
                $data->perusahaan = $request->perusahaan;
                $data->so = $request->so;
                $data->tipe = $request->tipe;
                $data->konsumen = $request->konsumen;
                $data->tanggal = $request->tanggal;
                $data->tgl_kirim = $request->tanggal;
                $data->tgl_diterima = $SO->tgl_diterima; //Add tanggal diterima setelah membuat invoice

                $rekanan = rekanan::where('kode', $request->konsumen)->first();

                $data->alamat = $rekanan->alamat;
                $data->keterangan = $request->keterangan;
                $data->status = 'Belum Diperiksa';
                $data->save();

                $author = new author();
                $author->transaksi = $request->kode;
                $author->kode_pembuat = $request->author;
                $author->save();

                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->author;
                $log->keterangan = "Tambah Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } catch (\Exception $e) {

                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else if ($request->tipe == 42) {
            try {
                $data = new suratjalan();
                $data->kode = $request->kode;
                $data->perusahaan = $request->perusahaan;
                $data->tipe = $request->tipe;
                $data->tanggal = $request->tanggal;
                $data->keterangan = $request->ketpakai;
                $data->status = 'Belum Diperiksa';
                $data->save();

                $author = new author();
                $author->transaksi = $request->kode;
                $author->kode_pembuat = $request->author;
                $author->save();

                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->author;
                $log->keterangan = "Tambah Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } catch (\Exception $e) {

                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else if ($request->tipe == 43) {
            try {
                $data = new suratjalan();
                $data->kode = $request->kode;
                $data->perusahaan = $request->perusahaan;
                $data->tipe = $request->tipe;
                $data->tanggal = $request->tanggal;
                $data->keterangan = $request->ketproduksi;
                $data->status = 'Belum Diperiksa';
                $data->save();

                $author = new author();
                $author->transaksi = $request->kode;
                $author->kode_pembuat = $request->author;
                $author->save();

                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->author;
                $log->keterangan = "Tambah Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else if ($request->tipe == 44) {
            try {
                $data = new suratjalan();
                $data->kode = $request->kode;
                $data->perusahaan = $request->perusahaan;
                $data->tipe = $request->tipe;
                $data->tanggal = $request->tanggal;
                $data->keterangan = $request->ketpemindahan;
                $data->status = 'Belum Diperiksa';
                $data->save();

                $author = new author();
                $author->transaksi = $request->kode;
                $author->kode_pembuat = $request->author;
                $author->save();

                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->author;
                $log->keterangan = "Tambah Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
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
    public function suratjalaninv($kode)
    {
        try {
            $data = suratjalan::select('kode')->where('so', $kode)->first();
            return response()->json(['success' => true, 'pesan' => $data]);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function cekinvoice($kode)
    {
        try {
            $data = invoice::select('kode')->where('kode_sj', $kode)->first();
            if ($data == null) {
                return response()->json(['success' => false, 'pesan' => "Invoice Belum Dibuat"]);
            } else {
                return response()->json(['success' => true, 'data' => $data]);
            }
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function edit($kode)
    {
        //
        $tipe = Str::substr($kode, 3, 2);
        if ($tipe == 41) {
            try {
                $sj = suratjalan::where('kode', $kode)->first();
                $so = salesorder::where('kode', $sj->so)->first();
                $rekanan = rekanan::where('kode', $so->konsumen)->first();
                $sj['nama'] = $rekanan->nama;
                if ($sj['perusahaan'] == "npa") {
                    $sj['namaperusahaan'] = "CV. Nusa Pratama Anugrah";
                } else if ($sj['perusahaan'] == "herbivor") {
                    $sj['namaperusahaan'] = "PT. Herbivor Satu Nusa";
                } else if ($sj['perusahaan'] == "triputra") {
                    $sj['namaperusahaan'] = "PT. Triputra Sinergi Indonesia";
                } else {
                    $sj['namaperusahaan'] = "-";
                }
                $author = author::all()
                    ->where('transaksi', $kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();
                $data['sj'] = $sj;
                $data['author'] = $author;
                return response()->json(['success' => true, 'data' => $data]);
            } catch (\Exception $e) {

                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else {
            try {
                $sj = suratjalan::where('kode', $kode)->first();
                $author = author::all()
                    ->where('transaksi', $kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();
                $data['sj'] = $sj;
                $data['author'] = $author;
                return response()->json(['success' => true, 'data' => $data]);
            } catch (\Exception $e) {

                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        }
    }
    public function selesai(Request $request, $kode)
    {
        try {
            DB::table('suratjalan')
                ->where('kode', $kode)
                ->update(['status' => 'Selesai']);
            DB::table('jurnal')
                ->where('kode_transaksi', 'LIKE', "$kode%")
                ->update(['status' => 'Selesai']);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data SJ Selesai";
            $log->save();

            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function cetaksj($kode)
    {
        try {
            $tipe = Str::substr($kode, 3, 2);
            if ($tipe == 41) {
                $data = suratjalan::where('kode', $kode)->first();
                $konsumen = rekanan::where('kode', $data->konsumen)->first();
                $invoice = invoice::select('kode', 'kode_so')->where('kode_sj', $kode)->first();
                $so     = salesorder::select('no_po')->where('kode', $invoice->kode_so)->first();
                $data->invoice = $invoice->kode;
                $data->namakonsumen = $konsumen->nama;
                $data->telp = $konsumen->telp;
                $detail = detail_sj::select('detail_sj.*', 'barang.nama', 'barang.satuan')
                    ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                    ->where('detail_sj.kode_sj', $data->kode)->get();
                return response()->json(['success' => true, 'sj' => $data, 'detail' => $detail, 'konsumen' => $konsumen, 'invoice' => $invoice, 'so' => $so]);
            } else {
                $data = suratjalan::where('kode', $kode)->first();
                $konsumen = rekanan::where('kode', $data->konsumen)->first();
                $invoice = invoice::select('kode', 'kode_so')->where('kode_sj', $kode)->first();
                $so     = salesorder::select('no_po')->where('kode', $invoice->kode_so)->first();
                $data->invoice = $invoice->kode;
                $data->namakonsumen = $konsumen->nama;
                $data->telp = $konsumen->telp;
                $detail =  detail_sj::select('detail_sj.*', 'barang.nama', 'barang.satuan')
                    ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                    ->where('detail_sj.kode_sj', $data->kode)->get();
                return response()->json(['success' => true, 'sj' => $data, 'detail' => $detail, 'so' => $so]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
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

        // return $request;
        $tipe = Str::substr($kode, 3, 2);
        if ($tipe == 41) {
            try {

                if ($request->tgl_terima != null) {
                    $data = suratjalan::select('so')->where('kode', $kode)->first();

                    DB::table('salesorder')->where('kode', $data->so)
                        ->update(['tgl_diterima' => $request->tgl_terima]);
                }
                DB::table('suratjalan')
                    ->where('kode', $kode)
                    ->update(['kota' => $request->kota, 'nopol' => $request->nopol, 'alamat' => $request->alamat, 'ekspedisi' => $request->ekspedisi, 'no_resi' => $request->resi, 'tgl_kirim' => $request->tgl_kirim, 'tgl_diterima' => $request->tgl_terima, 'keterangan' => $request->keterangan]);

                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $request->user;
                $log->keterangan = "Edit Data SJ";
                $log->save();
                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else if ($tipe == 42) {
            try {
                DB::table('suratjalan')
                    ->where('kode', $kode)
                    ->update(['tgl_diterima' => $request->tgl_terima, 'keterangan' => $request->ketpakai]);

                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $request->user;
                $log->keterangan = "Edit Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else if ($tipe == 43) {

            try {
                DB::table('suratjalan')
                    ->where('kode', $kode)
                    ->update(['tgl_diterima' => $request->tgl_terima, 'keterangan' => $request->ketproduksi]);

                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $request->user;
                $log->keterangan = "Edit Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
        } else {
            try {
                DB::table('suratjalan')
                    ->where('kode', $kode)
                    ->update(['tgl_diterima' => $request->tgl_terima, 'keterangan' => $request->ketpemindahan]);

                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $request->user;
                $log->keterangan = "Edit Data SJ";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
            }
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
        try {
            $data = suratjalan::select('so')->where('kode', $kode)->first();
            DB::table('salesorder')->where('kode', $data->so)->update(['status' => 'Sudah Diperiksa']);
            suratjalan::where('kode', $kode)->delete();
            detail_sj::where('kode_sj', $kode)->delete();
            jurnal::where('kode_transaksi', 'LIKE', "$kode%")->delete();
            author::where('transaksi', $kode)->delete();

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data SJ";
            $log->save();

            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
