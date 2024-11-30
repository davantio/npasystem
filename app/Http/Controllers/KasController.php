<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\detail_kas;
use App\Models\detail_po;
use App\Models\detail_so;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\kas;
use App\Models\jurnal;
use App\Models\karyawan;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\purchaseorder;
use App\Models\salesorder;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = Auth::user();
        $data = kas::orderBy('kode', 'DESC')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use ($login) {
                $actions = '<div class="btn-group">';
                $actions .= '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                $actions .= 'Action <span class="caret"></span>';
                $actions .= '</button>';
                $actions .= '<div class="dropdown-menu">';

                if ($data->status == 'Belum Diperiksa') {
                    $actions .= "<a class='dropdown-item edit' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-tambah'>Edit</a>";
                    $actions .= "<a class='dropdown-item hapus text-danger' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-hapus'>Hapus</a>";
                } elseif ($data->status == 'Sudah Diperiksa') {
                    $actions .= "<a class='dropdown-item selesai text-success' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-selesai'>Selesai</a>";
                    $actions .= "<a class='dropdown-item edit text-warning' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-edit'>Edit</a>";
                }

                // if ($login->level == 'superadmin') {
                //     if ($data->status == 'Belum Diperiksa') {
                //         $actions .= "<a class='dropdown-item re-belum text-danger' data-kode='{$data->kode}'>Re-Class: Belum Diperiksa</a>";
                //     } elseif ($data->status == 'Sudah Diperiksa') {
                //         $actions .= "<a class='dropdown-item re-sudah text-warning' data-kode='{$data->kode}'>Re-Class: Sudah Diperiksa</a>";
                //     }
                // }

                $actions .= '</div>';
                $actions .= '</div>';

                return $actions;
            })
            ->make(true);
    }


    public function filterExport(Request $request)
    {
        try {
            if ($request->jenis == "all") {
                if ($request->status == "all") {
                    $data = kas::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                } else {

                    $data = kas::where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                }
            } else {
                if ($request->status == "all") {
                    $data = kas::where('dk', $request->jenis)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                } else {
                    $data = kas::where('dk', $request->jenis)->where('status', $request->status)->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
                }
            }
            $DATA = array();
            $n = 0;
            foreach ($data as $D) {
                $DATA[$n]['KAS'] = $D->kode;
                $DATA[$n]['tanggal'] = $D->tanggal;
                $DATA[$n]['jenis'] = $D->dk;
                $DATA[$n]['KETERANGAN'] = $D->keterangan;
                $DATA[$n]['status'] = $D->status;
                $s = 0;
                $detail  = detail_kas::where('kode_kas', $D->kode)->get();
                foreach ($detail as $dtl) {


                    $DATA[$n]['transaksi'] = $dtl->kode_transaksi;
                    $DATA[$n]['vat'] = $dtl->vat;
                    $DATA[$n]['harga'] = $dtl->harga;
                    $DATA[$n]['qty'] = $dtl->qty;
                    $DATA[$n]['total'] = $dtl->total;
                    $DATA[$n]['keterangan'] = $dtl->keterangan;
                    $n++;
                    $s++;
                }
                for ($i = 1; $i < $s; $i++) {
                    $c = $n - $i;
                    $DATA[$c]['KAS'] = "-";
                    $DATA[$c]['tanggal'] = "-";
                    $DATA[$c]['jenis'] = "-";
                    $DATA[$c]['KETERANGAN'] = "-";
                    $DATA[$c]['status'] = "-";
                }
            }
            $file =  DataTables::of($DATA)->make(true);
            return response()->json(['success' => true, 'data' => $file]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }


    public function jurnal_kas(Request $request)
    {
        try {
            $n = 0;
            $data = [];
            //Sebelum
            $no = 0;
            $data[$n]['no'] = null;
            $data[$n]['tanggal'] = null;
            $data[$n]['transaksi'] = null;
            $data[$n]['keterangan'] = " // Saldo Transaksi Sebelumnya //";
            //Masuk
            $masuk = detail_kas::select(DB::raw('SUM(detail_kas.total) AS MASUK'))
                ->join('kas', 'detail_kas.kode_kas', 'kas.kode')
                ->where('detail_kas.debit', $request->kas)
                ->where('kas.status', 'Selesai')
                ->where('kas.tanggal', '<', $request->awal)->first();

            $data[$n]['pemasukkan'] = "Rp." . number_format($masuk->MASUK, 2, ',', '.');

            //Masuk
            //Keluar
            $keluar = detail_kas::select(DB::raw('SUM(detail_kas.total) AS KELUAR'))
                ->join('kas', 'detail_kas.kode_kas', 'kas.kode')
                ->where('detail_kas.kredit', $request->kas)
                ->where('kas.status', 'Selesai')
                ->where('kas.tanggal', '<', $request->awal)->first();
            $data[$n]['pengeluaran'] = "Rp." . number_format($keluar->KELUAR, 2, ',', '.');
            //Keluar
            //Saldo
            $saldo = $masuk->MASUK - $keluar->KELUAR;
            $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
            $sumD = $masuk->MASUK + 0;
            $sumK = $keluar->KELUAR + 0;
            //Saldo
            //Sebelum
            //Saat ini

            $DATA = detail_kas::join('kas', 'detail_kas.kode_kas', 'kas.kode')
                ->where('detail_kas.debit', $request->kas)
                ->where('kas.status', 'Selesai')
                ->whereBetween('kas.tanggal', [$request->awal, $request->akhir])
                ->orWhere('detail_kas.kredit', $request->kas)
                ->where('kas.status', 'Selesai')
                ->whereBetween('kas.tanggal', [$request->awal, $request->akhir])
                ->orderBy('kas.tanggal', 'Asc')->get();
            foreach ($DATA as $D) {
                $n++;
                $no++;
                $data[$n]['n'] = $n;
                $data[$n]['no'] = $no;
                $data[$n]['tanggal'] = $D->tanggal;
                $data[$n]['transaksi'] = $D->kode;
                $data[$n]['keterangan'] = $D->keterangan;
                if ($D->dk == 'D') {
                    $data[$n]['pemasukkan'] = "Rp." . number_format($D->total, 2, ',', '.');
                    $data[$n]['pengeluaran'] = "Rp.0,00";
                    $saldo = $saldo + $D->total;
                    $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
                    $sumD = $sumD + $D->total;
                } else {
                    $data[$n]['pemasukkan'] = "Rp.0,00";
                    $data[$n]['pengeluaran'] = "Rp." . number_format($D->total, 2, ',', '.');
                    $saldo = $saldo - $D->total;
                    $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
                    $sumK = $sumK + $D->total;
                }
            }
            //Saat ini
            //Bawahan
            $n++;
            $data[$n]['no'] = "N/A";
            $data[$n]['tanggal'] = "N/A";
            $data[$n]['transaksi'] = "N/A";
            $data[$n]['keterangan'] = " // TOTAL //";
            $data[$n]['pemasukkan'] = "Rp." . number_format($sumD, 2, ',', '.');
            $data[$n]['pengeluaran'] = "Rp." . number_format($sumK, 2, ',', '.');
            $sumTotal = $sumD - $sumK;
            $data[$n]['saldo'] = "Rp." . number_format($sumTotal, 2, ',', '.');
            //Bawahan
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function data_kas($dk)
    {
        $data = kas::where('dk', $dk)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                if ($data->status == 'Belum Diperiksa') {
                    return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>

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

                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
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


                    </div>
                    ";
                }
            })->make(true);
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
        $kode = 'KAS.' . $request->tanggal . '.';
        $data = kas::select('kode')->where('kode', 'like', $kode . '%')->orderBy('kode', 'desc')->first();
        if ($data == null) {
            $kode = $kode . '001';
            return $kode;
        } else {
            $a = $data->kode;
            $a = Str::substr($a, 9);
            $a = (int)$a;
            $b = $a + 1;
            $next = $kode . sprintf('%03s', $b);
            return $next;
        }
    }

    public function reclass(Request $request, $kode)
    {
        try {
            DB::table('kas')->where('kode', $kode)
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
            $log->keterangan = "Reclass Data KAS";
            $log->save();

            return response()->json(['success' => true, 'pesan' => "Reclass Berhasil"]);
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
        try {
            $kas = $request->id ? kas::find($request->id) : new kas();

            $kas->kode        = $request->kode;
            $kas->tanggal     = $request->tanggal;
            $kas->dk          = $request->dk;
            $kas->keterangan  = $request->keterangan;
            $kas->jenis       = $request->jenis;
            $kas->kode_ref    = $request->kode_ref;
            $kas->barang      = $request->barang;
            $kas->atas_nama   = $request->atas_nama;
            $kas->dpp         = $request->dpp;
            $kas->ppn         = $request->ppn;
            $kas->jumlah      = $request->jumlah;
            $kas->debit       = $request->debit;
            $kas->kredit      = $request->kredit;
            $kas->status      = "Belum Diperiksa";
            $kas->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->user;
            $log->keterangan = $request->id ? "Update Data Kas" : "Tambah Data Kas";
            $log->save();

            return response()->json(['success' => true, 'pesan' => 'Data berhasil ' . ($request->id ? 'diupdate' : 'ditambahkan')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function edit_modal($kode)
    {
        $kas = Kas::where('kode', $kode)->first();

        if ($kas) {
            return response()->json([
                'success' => true,
                'data' => $kas
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data not found'
        ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //
        try {
            $data = purchaseorder::select('purchaseorder.*', 'rekanan.nama')
                ->join('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                ->where('purchaseorder.kode', $kode)->first();

            if ($data->perusahaan == 'npa') {
                $data->namaperusahaan = "CV. Nusa Pratama Anugrah";
            } else if ($data->perusahaan == "herbivor") {
                $data->namaperusahaan = "PT. Herbivor Satu Nusa";
            } else if ($data->perusahaan == "triputra") {
                $data->namaperusahaan = "PT. Triputra Sinergi Indonesia";
            } else {
                $data->namaperusahaan = "-";
            }

            $total = detail_po::select(DB::raw("SUM(jumlah) AS jumlah"), DB::raw("SUM(ongkir) AS ongkir"))
                ->where('kode_po', $kode)->first();
            $barang = detail_po::select('barang.nama AS barang', 'detail_po.harga', 'detail_po.qty')
                ->join('barang', 'detail_po.kode_brg', '=', 'barang.kode')
                ->where('detail_po.kode_po', $kode)
                ->get();

            $a = "";
            $dpp = 0;
            foreach ($barang as $brg) {
                $harga = $brg->harga;
                $qty = $brg->qty;
                $dpp += ($harga * $qty);  // Kalkulasi DPP (harga * qty)

                $formattedHarga = "Rp " . number_format($harga, 0, ',', '.');
                $a .= $brg->barang . " - " . $formattedHarga . " - Qty " . $qty . " || ";
            }
            // Menghapus ' || ' terakhir
            $a = rtrim($a, ' || ');

            $total = $total->jumlah + $total->ongkir;
            $data['total'] = $total;
            $data['barang'] = $a;
            $data['dpp'] = $dpp;  // Menambahkan DPP ke data yang akan dikirim

            //DETAIL
            $detail = detail_po::select('barang.nama')
                ->join('barang', 'detail_po.kode_brg', '=', 'barang.kode')
                ->where('detail_po.kode_po', $kode)->get();
            $nama = "";
            foreach ($detail as $d) {
                $nama = $nama . $d->nama . " || ";
            }

            //Kekurangan
            $kas = jurnal::select(DB::raw("SUM(jumlah_debit) AS jumlah"))
                ->where('kode_transaksi', 'LIKE', "KAS%D")
                ->where('akun_debit', 'LIKE', "12%")
                ->orWhere('akun_debit', 'LIKE', "30%")
                ->where('keterangan', $kode)
                ->where('status', "Selesai")
                ->first();

            if ($kas->jumlah == null) {
                $kekurangan = $data->total;
            } else {
                $kekurangan = $data->total - $kas->jumlah;
            }

            $data['kekurangan'] = $kekurangan;

            $author = author::select('author.*')
                ->where('author.transaksi', $kode)->first();
            $author['creator'] = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();

            return response()->json(['success' => true, 'po' => $data, 'author' => $author, 'barang' => $nama]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function edit_so($kode)
    {
        //
        try {
            $data = salesorder::select('salesorder.*', 'rekanan.nama')
                ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->where('salesorder.kode', $kode)->first();

            if ($data->perusahaan == 'npa') {
                $data->namaperusahaan = "CV. Nusa Pratama Anugrah";
            } else if ($data->perusahaan == "herbivor") {
                $data->namaperusahaan = "PT. Herbivor Satu Nusa";
            } else if ($data->perusahaan == "triputra") {
                $data->namaperusahaan = "PT. Triputra Sinergi Indonesia";
            } else {
                $data->namaperusahaan = "-";
            }

            $total = detail_so::select(DB::raw("SUM(total) AS total"))
                ->where('kode_so', $kode)->first();
            $barang = detail_so::select('barang.nama AS barang', 'detail_so.harga', 'detail_so.qty')
                ->join('barang', 'detail_so.kode_brg', '=', 'barang.kode')
                ->where('detail_so.kode_so', $kode)
                ->get();

            $a = "";
            $dpp = 0;
            foreach ($barang as $brg) {
                $harga = $brg->harga;
                $qty = $brg->qty;
                $dpp += ($harga * $qty);  // Kalkulasi DPP (harga * qty)

                $formattedHarga = "Rp " . number_format($harga, 0, ',', '.');
                $a .= $brg->barang . " - " . $formattedHarga . " - Qty " . $qty . " || ";
            }
            // Menghapus ' || ' terakhir
            $a = rtrim($a, ' || ');

            $total = $total->total;
            $data['total'] = $total;
            $data['barang'] = $a;
            $data['dpp'] = $dpp;  // Menambahkan DPP ke data yang akan dikirim

            //DETAIL
            $detail = detail_so::select('barang.nama')
                ->join('barang', 'detail_so.kode_brg', '=', 'barang.kode')
                ->where('detail_so.kode_so', $kode)->get();
            $nama = "";
            foreach ($detail as $d) {
                $nama = $nama . $d->nama . " || ";
            }

            $author = author::select('author.*')
                ->where('author.transaksi', $kode)->first();
            $author['creator'] = karyawan::select('nama')->where('kode', $author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode', $author['kode_pemeriksa'])->first();

            return response()->json(['success' => true, 'so' => $data, 'author' => $author, 'barang' => $nama]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function selesai($kode)
    {
        try {
            return response()->json(['success' => false, 'pesan' => $request->user]);
            // $login = Auth::user();
            // DB:: table('kas')
            // ->where('kode',$kode)
            // ->update(['status'=>'Selesai']);
            // DB::table('jurnal')
            // ->where('kode_transaksi','LIKE',"$kode%")
            // ->update(['status'=>'Selesai']);
            // $log = new log_sistem();
            // $log->transaksi = $kode;
            // $log->user = $login->kode_karyawan;
            // $log->keterangan = "Data Kas Selesai";
            // $log->save();
            // return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function statuskas(Request $request, $kode)
    {
        try {

            DB::table('kas')->where('kode', $kode)
                ->update(['status' => $request->status]);
            DB::table('jurnal')->where('kode_transaksi', 'LIKE', "$kode%")
                ->update(['status' => $request->status]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Kas " . $request->status;
            $log->save();
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        //
        try {

            DB::table('kas')->where('kode', $id)
                ->update(['keterangan' => $request->keterangan]);

            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Kas";
            $log->save();


            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diedit"]);
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
            kas::where('kode', $id)->delete();
            detail_kas::where('kode_kas', $id)->delete();
            jurnal::where('kode_transaksi', 'LIKE', "$id%")->delete();

            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Kas";
            $log->save();

            return response()->json(['success' => true, 'pesan' => "Data Berhasil Dihapus"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function dropdownpokas(Request $request)
    {
        $po = [];
        if ($request->has('q')) {
            $search = $request->q;
            $po = purchaseorder::select('purchaseorder.kode', 'rekanan.nama', 'purchaseorder.updated_at')
                ->join('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                ->where('kode', 'LIKE', "%$search%")
                ->orderBy('updated_at', "DESC")
                ->get();
        } else {
            $po = purchaseorder::select('purchaseorder.kode', 'rekanan.nama', 'purchaseorder.updated_at')
                ->join('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                ->orderBy('updated_at', "DESC")
                ->get();
        }
        return response()->json($po);
    }
    public function dropdownsokas(Request $request)
    {
        $so = [];
        if ($request->has('q')) {
            $search = $request->q;
            $so = salesorder::select('salesorder.kode', 'rekanan.nama', 'salesorder.updated_at')
                ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->where('kode', 'LIKE', "%$search%")
                ->orderBy('updated_at', "DESC")
                ->get();
        } else {
            $so = salesorder::select('salesorder.kode', 'rekanan.nama', 'salesorder.updated_at')
                ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->orderBy('updated_at', "DESC")
                ->get();
        }
        return response()->json($so);
    }
}
