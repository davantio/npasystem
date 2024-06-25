<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aset;
use App\Models\gudang;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\karyawan;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Carbon\carbon;
use Throwable;

class AsetController extends Controller
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
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();

        if ($login->level == 'superadmin' || $login->level == 'ceo' || $login->level == 'manager-admin') {
            $data = aset::select('aset.*', 'gudang.nama AS tempat', 'kodeakuntansi.nama_perkiraan AS nama_perkiraan')->join('gudang', 'aset.lokasi', '=', 'gudang.kode')->join('kodeakuntansi', 'kodeakuntansi.kode', '=', 'aset.tipe')->orderBy('aset.updated_at', "DESC")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('keterangan', "ASET." . $data->id)->where('status', "Selesai")->first();
                    $total = $data->harga_beli * $data->jumlah;
                    if ($kas->jumlah == $total) {
                        return "Lunas";
                    } else {
                        return "Belum Lunas";
                    }
                })
                ->editColumn('tgl_pembelian', function ($data) {
                    $date = Carbon::parse($data->tgl_pembelian);
                    $tanggal = $date->format('d F Y');
                    return $tanggal;
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == "Lunas") {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";
                    } else {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";
                    }
                })->make(true);
        } else {
            $data = aset::select('aset.*', 'gudang.nama AS tempat', 'kodeakuntansi.nama_perkiraan AS nama_perkiraan')->join('gudang', 'aset.lokasi', '=', 'gudang.kode')->join('kodeakuntansi', 'kodeakuntansi.kode', '=', 'aset.tipe')->where('aset.lokasi', '=', $karyawan->lokasi)->orderBy('aset.updated_at', "DESC")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('keterangan', "ASET." . $data->id)->where('status', "Selesai")->first();
                    $total = $data->harga_beli * $data->jumlah;
                    if ($kas->jumlah == $total) {
                        return "Lunas";
                    } else {
                        return "Belum Lunas";
                    }
                })
                ->addColumn('action', function ($data) {

                    if ($data->status == "Lunas") {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                    </div>
                ";
                    } else {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
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
    public function lastkode(Request $request)
    {
    }
    public function detail_aset($kode)
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();

        if ($login->level == 'superadmin' || $login->level == 'ceo' || $login->level == 'manager-admin') {
            $data = aset::select('aset.*', 'gudang.nama AS tempat', 'kodeakuntansi.nama_perkiraan AS nama_perkiraan')
                ->join('gudang', 'aset.lokasi', '=', 'gudang.kode')
                ->join('kodeakuntansi', 'kodeakuntansi.kode', '=', 'aset.tipe')
                ->where('aset.tipe', $kode)
                ->orderBy('aset.updated_at', "DESC")
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('keterangan', "ASET." . $data->id)->where('status', "Selesai")->first();
                    $total = $data->harga_beli * $data->jumlah;
                    if ($kas->jumlah == $total) {
                        return "Lunas";
                    } else {
                        return "Belum Lunas";
                    }
                })
                ->editColumn('tgl_pembelian', function ($data) {
                    $date = Carbon::parse($data->tgl_pembelian);
                    $tanggal = $date->format('d F Y');
                    return $tanggal;
                })
                ->addColumn('action', function ($data) {
                    if ($data->status == "Lunas") {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";
                    } else {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                ";
                    }
                })->make(true);
        } else {
            $data = aset::select('aset.*', 'gudang.nama AS tempat', 'kodeakuntansi.nama_perkiraan AS nama_perkiraan')->join('gudang', 'aset.lokasi', '=', 'gudang.kode')->join('kodeakuntansi', 'kodeakuntansi.kode', '=', 'aset.tipe')->where('aset.lokasi', '=', $karyawan->lokasi)->orderBy('aset.updated_at', "DESC")->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('keterangan', "ASET." . $data->id)->where('status', "Selesai")->first();
                    $total = $data->harga_beli * $data->jumlah;
                    if ($kas->jumlah == $total) {
                        return "Lunas";
                    } else {
                        return "Belum Lunas";
                    }
                })
                ->addColumn('action', function ($data) {

                    if ($data->status == "Lunas") {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                    </div>
                ";
                    } else {
                        return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                    </div>
                ";
                    }
                })->make(true);
        }
    }
    public function dropdownaset(Request $request, $tipe)
    {
        $output = array();

        if ($request->has('q')) {
            $search = $request->q;

            $data = aset::where('tipe', $tipe)
                ->where('nama', 'LIKE', "%$search")
                ->orWhere('id', 'LIKE', "%$search")
                ->orderBy('created_at', "DESC")
                ->get();
            foreach ($data as $d) {
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('status', "Selesai")->where('keterangan', "ASET." . $d->id)->first();
                $jumlah = $d->harga_beli * $d->jumlah;
                if ($kas->jumlah == $jumlah) {
                } else {
                    $d->status = "Belum Diperiksa";
                    $output[] = $d;
                }
            }
        } else {

            $data = aset::where('tipe', $tipe)
                ->orderBy('created_at', "DESC")
                ->get();
            foreach ($data as $d) {
                $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))->where('status', "Selesai")->where('keterangan', "ASET." . $d->id)->first();
                $jumlah = $d->harga_beli * $d->jumlah;
                if ($kas->jumlah == $jumlah) {
                } else {
                    $d->status = "Belum Diperiksa";
                    $output[] = $d;
                }
            }
        }
        return response()->json($output);
    }


    public function dropdowntipe(Request $request)
    {

        try {
            if ($request->has('q')) {
                $search = $request->q;
                $aset = aset::select("tipe")
                    ->where('tipe', 'LIKE', "%$search%")
                    ->distinct()
                    ->get();
            } else {
                $aset = aset::select("tipe")
                    ->distinct()
                    ->get();
            }
            return response()->json($aset);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
    public function create()
    {
        //
        try {




            return response()->json(['success' => true, 'pesan' => "Data Berhasil Ditambahkan"]);
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
            // return response()->json(['success'=>false,'pesan'=>"DONE"]);
            //lastkode
            $login = Auth::user();
            $validatedData = $request->validate([
                'tambah_foto' => 'required|image|max:5000'
            ]);
            $last = aset::select('id')->orderBy('id', 'DESC')->first();
            if (!$last) {
                $nkode = 1;
            } else {
                $nkode = $last->id + 1;
            }
            $aset = new aset();
            $aset->id = $nkode;
            $aset->tipe = $request->tambah_tipe;
            $aset->nama = $request->tambah_nama;
            $aset->tgl_pembelian = $request->tambah_pembelian;
            $aset->harga_beli = $request->tambah_harga;
            $aset->jumlah = $request->tambah_qty;
            $aset->lokasi = $request->tambah_lokasi;
            $aset->kondisi = $request->tambah_kondisi;
            $aset->keterangan = $request->tambah_keterangan;
            if ($request->hasFile('tambah_foto')) {
                $foto = $request->file('tambah_foto');
                $nama_foto = $foto->getClientOriginalName();
                $file = public_path('img/aset/' . $nama_foto);
                if (file_exists($file)) {
                    return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                } else {

                    $aset->foto = $nama_foto;
                }
            }
            if ($request->tambah_tipe == 'kendaraan') {
                $aset->no_mesin = $request->mesin;
                $aset->no_rangka = $request->rangka;
                $aset->plat_nomor = $request->plat;
            } else {
            }
            $simpan = $aset->save();
            if ($simpan) {
                $foto->move(public_path('img/aset'), $nama_foto);
                $log = new log_sistem();
                $log->transaksi = $nkode;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Tambah Data Aset";
                $resultlog = $log->save();
                if ($resultlog) {
                    return response()->json(['success' => true, 'data' => $aset, 'pesan' => "Data Berhasil Ditambahkan"]);
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Simpan Log"]);
                }
            } else {
                return response()->json(['success' => false, 'pesan' => "Error Simpan Asset"]);
            }
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
    public function edit($id)
    {
        //
        try {
            $data = aset::select('aset.*', 'gudang.nama AS tempat', 'kodeakuntansi.nama_perkiraan AS nama_perkiraan')->join('gudang', 'aset.lokasi', '=', 'gudang.kode')->join('kodeakuntansi', 'kodeakuntansi.kode', '=', 'aset.tipe')->where('aset.id', $id)->first();
            $total = $data->harga_beli * $data->jumlah;
            $data->total = $total;
            $data->foto = "/img/aset/" . $data->foto;
            return response()->json(['success' => true, 'data' => $data]);
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
    public function ubah(Request $request, $kode)
    {
        try {
            $login = Auth::user();
            $data = aset::where('id', $kode)->first();
            if ($request->hasFile('edit_foto')) {
                // ada gambar
                $request->validate([
                    'edit_foto' => 'image|max:50000'
                ]);
                $foto = $request->file('edit_foto');
                $nama_foto = $foto->getClientOriginalName();
                $file = public_path('img/aset/' . $nama_foto);
                if (file_exists($file)) {
                    return response()->json(['success' => false, 'pesan' => "File dengan nama berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file "]);
                } else {
                    if ($data->tipe == 'kendaraan') {
                        $update = DB::table('aset')
                            ->where('id', $kode)
                            ->update([
                                'nama' => $request->edit_nama,
                                'tgl_pembelian' => $request->edit_pembelian,
                                'harga_beli' => $request->edit_harga,
                                'jumlah' => $request->edit_qty,
                                'lokasi' => $request->edit_lokasi,
                                'keterangan' => $request->edit_keterangan,
                                'no_mesin' => $request->edit_mesin,
                                'no_rangka' => $request->edit_rangka,
                                'plat_nomor' => $request->edit_plat,
                                'kondisi' => $request->edit_kondisi,
                                'foto'      => $nama_foto,
                            ]);
                    } else {
                        $update = DB::table('aset')
                            ->where('id', $kode)
                            ->update([
                                'nama' => $request->edit_nama,
                                'tipe' => $request->edit_tipe,
                                'tgl_pembelian' => $request->edit_pembelian,
                                'harga_beli' => $request->edit_harga,
                                'jumlah' => $request->edit_qty,
                                'lokasi' => $request->edit_lokasi,
                                'kondisi' => $request->edit_kondisi,
                                'keterangan' => $request->edit_keterangan,
                                'foto'      => $nama_foto,
                            ]);
                    }
                    $oldfile = public_path('img/aset/' . $data->foto);
                    unlink($oldfile);
                    $foto->move(public_path('img/aset'), $nama_foto);
                }
            } else {
                //tidak ada gambar
                if ($data->tipe == 'kendaraan') {
                    $update = DB::table('aset')
                        ->where('id', $kode)
                        ->update([
                            'nama' => $request->edit_nama,
                            'tgl_pembelian' => $request->edit_pembelian,
                            'harga_beli' => $request->edit_harga,
                            'jumlah' => $request->edit_qty,
                            'lokasi' => $request->edit_lokasi,
                            'keterangan' => $request->edit_keterangan,
                            'no_mesin' => $request->edit_nomesin,
                            'no_rangka' => $request->edit_norangka,
                            'plat_nomor' => $request->edit_plat,
                            'kondisi' => $request->edit_kondisi,
                        ]);
                } else {
                    $update = DB::table('aset')
                        ->where('id', $kode)
                        ->update([
                            'nama' => $request->edit_nama,
                            'tipe' => $request->edit_tipe,
                            'tgl_pembelian' => $request->edit_pembelian,
                            'harga_beli' => $request->edit_harga,
                            'jumlah' => $request->edit_qty,
                            'lokasi' => $request->edit_lokasi,
                            'kondisi' => $request->edit_kondisi,
                            'keterangan' => $request->edit_keterangan,
                        ]);
                }
            }
            if ($update) {

                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Edit Data Aset";
                $log->save();
                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } else {
                return response()->json(['success' => false, 'pesan' => "Error Update Aset"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $kode)
    {
        //
        try {
            $login = Auth::user();
            $data = aset::where('id', $kode)->first();
            if ($request->hasFile('edit_foto')) {
                // ada gambar
                $request->validate([
                    'edit_foto' => 'image|max:50000'
                ]);
                $foto = $request->file('edit_foto');
                $nama_foto = $foto->getClientOriginalName();
                $file = public_path('img/aset/' . $nama_foto);
                if (file_exists($file)) {
                    return response()->json(['success' => false, 'pesan' => "File dengan nama berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file "]);
                } else {
                    if ($data->tipe == 'kendaraan') {
                        $update = DB::table('aset')
                            ->where('id', $kode)
                            ->update([
                                'nama' => $request->edit_nama,
                                'tgl_pembelian' => $request->edit_pembelian,
                                'harga_beli' => $request->edit_harga,
                                'jumlah' => $request->edit_qty,
                                'lokasi' => $request->edit_lokasi,
                                'keterangan' => $request->edit_keterangan,
                                'no_mesin' => $request->edit_mesin,
                                'no_rangka' => $request->edit_rangka,
                                'plat_nomor' => $request->edit_plat,
                                'kondisi' => $request->edit_kondisi,
                                'foto'      => $nama_foto,
                            ]);
                    } else {
                        $update = DB::table('aset')
                            ->where('id', $kode)
                            ->update([
                                'nama' => $request->edit_nama,
                                'tipe' => $request->edit_tipe,
                                'tgl_pembelian' => $request->edit_pembelian,
                                'harga_beli' => $request->edit_harga,
                                'jumlah' => $request->edit_qty,
                                'lokasi' => $request->edit_lokasi,
                                'kondisi' => $request->edit_kondisi,
                                'keterangan' => $request->edit_keterangan,
                                'foto'      => $nama_foto,
                            ]);
                    }
                }
            } else {
                //tidak ada gambar
                if ($data->tipe == 'kendaraan') {
                    DB::table('aset')
                        ->where('id', $kode)
                        ->update([
                            'nama' => $request->edit_nama,
                            'tgl_pembelian' => $request->edit_pembelian,
                            'harga_beli' => $request->edit_harga,
                            'jumlah' => $request->edit_qty,
                            'lokasi' => $request->edit_lokasi,
                            'keterangan' => $request->edit_keterangan,
                            'no_mesin' => $request->edit_nomesin,
                            'no_rangka' => $request->edit_norangka,
                            'plat_nomor' => $request->edit_plat,
                            'kondisi' => $request->edit_kondisi,
                        ]);
                } else {
                    DB::table('aset')
                        ->where('id', $kode)
                        ->update([
                            'nama' => $request->edit_nama,
                            'tipe' => $request->edit_tipe,
                            'tgl_pembelian' => $request->edit_pembelian,
                            'harga_beli' => $request->edit_harga,
                            'jumlah' => $request->edit_qty,
                            'lokasi' => $request->edit_lokasi,
                            'kondisi' => $request->edit_kondisi,
                            'keterangan' => $request->edit_keterangan,
                        ]);
                }
            }
            if ($update) {
                if ($data->foto !== null) {
                    $oldfile = public_path('img/aset/' . $data->foto);
                    // Periksa apakah file ada sebelum mencoba menghapusnya
                    if (file_exists($oldfile)) {
                        // Coba hapus file
                        if (!unlink($oldfile)) {
                            // Gagal menghapus file
                            return response()->json(['success' => false, 'pesan' => "Gagal menghapus file foto"]);
                        }
                    } else {
                        // File tidak ditemukan
                        return response()->json(['success' => false, 'pesan' => "File foto tidak ditemukan"]);
                    }
                }
                $foto->move(public_path('img/karyawan'), $nama_foto);
                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Edit Data Aset";
                $log->save();
                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
            } else {
                return response()->json(['success' => false, 'pesan' => "Error Update Aset"]);
            }
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
    public function destroy(Request $request, $id)
    {
        //
        try {
            $data = aset::where('id', $id)->first();
            $file = public_path('img/aset/' . $data->foto);
            if (file_exists($file)) {
                unlink($file);
            } else {
            }
            $login = Auth::user();
            aset::where('id', $id)->delete();
            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $login->kode_karyawan;
            $log->keterangan = "Hapus Data Aset";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
