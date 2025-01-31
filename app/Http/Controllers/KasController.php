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
            //Ubah nama perusahaan
            ->editColumn('atas_nama', function ($data) {
                if ($data['atas_nama'] == "npa") {
                    return "CV. Nusa Pratama Anugrah";
                } else if ($data['atas_nama'] == "herbivor") {
                    return "PT. Herbivor Satu Nusa";
                } else if ($data['atas_nama'] == "triputra") {
                    return "PT. Triputra Sinergi Indonesia";
                } else {
                    return "-";
                }
            })
            ->addColumn('action', function ($data) use ($login) {
                $actions = '<div class="btn-group">';
                $actions .= '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                $actions .= 'Action <span class="caret"></span>';
                $actions .= '</button>';
                $actions .= '<div class="dropdown-menu">';

                if ($data->status == 'Belum Diperiksa') {
                    $actions .= "<a class='dropdown-item detail text-info' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-detail'>Detail</a>";
                    $actions .= "<a class='dropdown-item edit text-warning' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-edit'>Edit</a>";
                    $actions .= "<a class='dropdown-item hapus text-danger' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-hapus'>Hapus</a>";
                } elseif ($data->status == 'Sudah Diperiksa') {
                    $actions .= "<a class='dropdown-item detail text-info' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-detail'>Detail</a>";
                    $actions .= "<a class='dropdown-item selesai text-success' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-selesai'>Selesai</a>";
                } elseif ($data->status == 'Selesai') {
                    $actions .= "<a class='dropdown-item detail text-info' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-detail'>Detail</a>";
                }

                // if ($login->level === 'Superadmin') {
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


    // public function jurnal_kas(Request $request)
    // {
    //     try {
    //         $n = 0;
    //         $data = [];
    //         //Sebelum
    //         $no = 0;
    //         $data[$n]['no'] = null;
    //         $data[$n]['tanggal'] = null;
    //         $data[$n]['transaksi'] = null;
    //         $data[$n]['keterangan'] = " // Saldo Transaksi Sebelumnya //";
    //         //Masuk
    //         $masuk = detail_kas::select(DB::raw('SUM(detail_kas.total) AS MASUK'))
    //             ->join('kas', 'detail_kas.kode_kas', 'kas.kode')
    //             ->where('detail_kas.debit', $request->kas)
    //             ->where('kas.status', 'Selesai')
    //             ->where('kas.tanggal', '<', $request->awal)->first();

    //         $data[$n]['pemasukkan'] = "Rp." . number_format($masuk->MASUK, 2, ',', '.');

    //         //Masuk
    //         //Keluar
    //         $keluar = detail_kas::select(DB::raw('SUM(detail_kas.total) AS KELUAR'))
    //             ->join('kas', 'detail_kas.kode_kas', 'kas.kode')
    //             ->where('detail_kas.kredit', $request->kas)
    //             ->where('kas.status', 'Selesai')
    //             ->where('kas.tanggal', '<', $request->awal)->first();
    //         $data[$n]['pengeluaran'] = "Rp." . number_format($keluar->KELUAR, 2, ',', '.');
    //         //Keluar
    //         //Saldo
    //         $saldo = $masuk->MASUK - $keluar->KELUAR;
    //         $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
    //         $sumD = $masuk->MASUK + 0;
    //         $sumK = $keluar->KELUAR + 0;
    //         //Saldo
    //         //Sebelum
    //         //Saat ini

    //         $DATA = detail_kas::join('kas', 'detail_kas.kode_kas', 'kas.kode')
    //             ->where('detail_kas.debit', $request->kas)
    //             ->where('kas.status', 'Selesai')
    //             ->whereBetween('kas.tanggal', [$request->awal, $request->akhir])
    //             ->orWhere('detail_kas.kredit', $request->kas)
    //             ->where('kas.status', 'Selesai')
    //             ->whereBetween('kas.tanggal', [$request->awal, $request->akhir])
    //             ->orderBy('kas.tanggal', 'Asc')->get();
    //         foreach ($DATA as $D) {
    //             $n++;
    //             $no++;
    //             $data[$n]['n'] = $n;
    //             $data[$n]['no'] = $no;
    //             $data[$n]['tanggal'] = $D->tanggal;
    //             $data[$n]['transaksi'] = $D->kode;
    //             $data[$n]['keterangan'] = $D->keterangan;
    //             if ($D->dk == 'D') {
    //                 $data[$n]['pemasukkan'] = "Rp." . number_format($D->total, 2, ',', '.');
    //                 $data[$n]['pengeluaran'] = "Rp.0,00";
    //                 $saldo = $saldo + $D->total;
    //                 $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
    //                 $sumD = $sumD + $D->total;
    //             } else {
    //                 $data[$n]['pemasukkan'] = "Rp.0,00";
    //                 $data[$n]['pengeluaran'] = "Rp." . number_format($D->total, 2, ',', '.');
    //                 $saldo = $saldo - $D->total;
    //                 $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
    //                 $sumK = $sumK + $D->total;
    //             }
    //         }
    //         //Saat ini
    //         //Bawahan
    //         $n++;
    //         $data[$n]['no'] = "N/A";
    //         $data[$n]['tanggal'] = "N/A";
    //         $data[$n]['transaksi'] = "N/A";
    //         $data[$n]['keterangan'] = " // TOTAL //";
    //         $data[$n]['pemasukkan'] = "Rp." . number_format($sumD, 2, ',', '.');
    //         $data[$n]['pengeluaran'] = "Rp." . number_format($sumK, 2, ',', '.');
    //         $sumTotal = $sumD - $sumK;
    //         $data[$n]['saldo'] = "Rp." . number_format($sumTotal, 2, ',', '.');
    //         //Bawahan
    //         return response()->json(['success' => true, 'data' => $data]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
    //     }
    // }
    
    // public function jurnal_kas(Request $request)
    // {
    //     try {
    //         $n = 0;
    //         $data = [];

    //         // Awal saldo sebelumnya
    //         $data[$n]['no'] = null;
    //         $data[$n]['tanggal'] = null;
    //         $data[$n]['transaksi'] = null;
    //         $data[$n]['keterangan'] = " // Saldo Transaksi Sebelumnya //";

    //         // Hitung total pemasukan sebelum tanggal awal
    //         $masuk = kas::where('kas.debit', $request->kas)
    //             ->where('kas.status', 'Belum Diperiksa')
    //             ->where('kas.tanggal', '<', $request->awal)
    //             ->sum('jumlah');

    //         $data[$n]['pemasukkan'] = "Rp." . number_format($masuk, 2, ',', '.');

    //         // Hitung total pengeluaran sebelum tanggal awal
    //         $keluar = kas::where('kas.kredit', $request->kas)
    //             ->where('kas.status', 'Belum Diperiksa')
    //             ->where('kas.tanggal', '<', $request->awal)
    //             ->sum('jumlah');

    //         $data[$n]['pengeluaran'] = "Rp." . number_format($keluar, 2, ',', '.');

    //         // Hitung saldo awal
    //         $saldo = $masuk - $keluar;
    //         $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');

    //         $sumD = $masuk; // Total pemasukan
    //         $sumK = $keluar; // Total pengeluaran

    //         // Ambil data transaksi dalam rentang tanggal
    //         $transactions = kas::where('kas.status', 'Belum Diperiksa')
    //             ->whereBetween('kas.tanggal', [$request->awal, $request->akhir])
    //             ->where(function ($query) use ($request) {
    //                 $query->where('kas.debit', $request->kas)
    //                     ->orWhere('kas.kredit', $request->kas);
    //             })
    //             ->orderBy('kas.tanggal', 'asc')
    //             ->get();

    //         // Iterasi setiap transaksi
    //         foreach ($transactions as $transaction) {
    //             $n++;
    //             $data[$n]['no'] = $n;
    //             $data[$n]['tanggal'] = $transaction->tanggal;
    //             $data[$n]['transaksi'] = $transaction->kode;
    //             $data[$n]['keterangan'] = $transaction->keterangan;

    //             if ($transaction->debit == $request->kas) {
    //                 // Transaksi pemasukan
    //                 $data[$n]['pemasukkan'] = "Rp." . number_format($transaction->jumlah, 2, ',', '.');
    //                 $data[$n]['pengeluaran'] = "Rp.0,00";
    //                 $saldo += $transaction->jumlah;
    //                 $sumD += $transaction->jumlah;
    //             } else {
    //                 // Transaksi pengeluaran
    //                 $data[$n]['pemasukkan'] = "Rp.0,00";
    //                 $data[$n]['pengeluaran'] = "Rp." . number_format($transaction->jumlah, 2, ',', '.');
    //                 $saldo -= $transaction->jumlah;
    //                 $sumK += $transaction->jumlah;
    //             }

    //             $data[$n]['saldo'] = "Rp." . number_format($saldo, 2, ',', '.');
    //         }

    //         // Total keseluruhan
    //         $n++;
    //         $data[$n]['no'] = "N/A";
    //         $data[$n]['tanggal'] = "N/A";
    //         $data[$n]['transaksi'] = "N/A";
    //         $data[$n]['keterangan'] = " // TOTAL //";
    //         $data[$n]['pemasukkan'] = "Rp." . number_format($sumD, 2, ',', '.');
    //         $data[$n]['pengeluaran'] = "Rp." . number_format($sumK, 2, ',', '.');
    //         $data[$n]['saldo'] = "Rp." . number_format($sumD - $sumK, 2, ',', '.');

    //         return response()->json(['success' => true, 'data' => $data]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
    //     }
    // }

    public function jurnal_kas(Request $request)
    {
        try {
            // Ambil data transaksi dengan `bank` sama dengan `request->kas`
            $transactions = kas::where('bank', $request->kas)
                ->whereBetween('tanggal', [$request->awal, $request->akhir])
                ->where('status', 'Selesai')
                ->orderBy('tanggal', 'asc')
                ->get();

            $data = [];
            foreach ($transactions as $transaction) {
                // Cari nama perkiraan untuk debit dan kredit
                $nama_debit = kode_akuntansi::where('kode', $transaction->debit)->value('nama_perkiraan');
                $nama_kredit = kode_akuntansi::where('kode', $transaction->kredit)->value('nama_perkiraan');

                $data[] = [
                    'tanggal' => $transaction->tanggal,
                    'kode_transaksi' => $transaction->kode,
                    'keterangan' => $transaction->keterangan,
                    'akun_debit' => $nama_debit ?: 'Tidak Ditemukan', // Nama akun debit
                    'akun_kredit' => $nama_kredit ?: 'Tidak Ditemukan', // Nama akun kredit
                    'jumlah' => "Rp." . number_format($transaction->jumlah, 2, ',', '.'),
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'pesan' => $e->getMessage(),
            ]);
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
            $kas->bank        = $request->bank; 
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
            $resultkas = $kas->save();

            //Add ke jurnal
            if($resultkas){
                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->user;
                $log->keterangan = $request->id ? "Update Data Kas" : "Tambah Data Kas";
                $resultlog = $log->save();

                if($resultlog){
                     // Menentukan iterasi untuk kode transaksi DEBIT
                    $lastDebit = jurnal::where('kode_transaksi', 'like', 'KAS.%D')->orderBy('kode_transaksi', 'desc')->first();
                    $nextDebitIteration = $lastDebit ? (substr($lastDebit->kode_transaksi, strrpos($lastDebit->kode_transaksi, '.') + 1, -1) + 1) : 1;

                    // Membuat kode transaksi DEBIT dengan iterasi
                    $kodeDebit = str_pad($request->kode, 4, '0', STR_PAD_LEFT) . "." . str_pad($nextDebitIteration, 3, '0', STR_PAD_LEFT) . "D";

                    //Jurnal DEBIT
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $kodeDebit;
                    $jurnalD->tanggal            = $request->tanggal;
                    $jurnalD->perusahaan         = $request->atas_nama;
                    $jurnalD->akun_debit         = $request->debit;
                    $jurnalD->akun_kredit        = $request->kredit;
                    $jurnalD->nama_brg           = $request->barang;
                    $jurnalD->jumlah_debit       = $request->jumlah;
                    $jurnalD->keterangan         = $request->keterangan;
                    $jurnalD->status             = "Belum Diperiksa";
        
                    $resultjurnalDinv = $jurnalD->save();
                    if($resultjurnalDinv){
                        // Menentukan iterasi untuk kode transaksi KREDIT
                        $lastCredit = jurnal::where('kode_transaksi', 'like', 'KAS.%K')->orderBy('kode_transaksi', 'desc')->first();
                        $nextCreditIteration = $lastCredit ? (substr($lastCredit->kode_transaksi, strrpos($lastCredit->kode_transaksi, '.') + 1, -1) + 1) : 1;

                        // Membuat kode transaksi KREDIT dengan iterasi
                        $kodeCredit = str_pad($request->kode, 4, '0', STR_PAD_LEFT) . "." . str_pad($nextCreditIteration, 3, '0', STR_PAD_LEFT) . "K";

                        //Jurnal KREDIT
                        $jurnalK = new jurnal();

                        $jurnalK->kode_transaksi = $kodeCredit;
                        $jurnalK->tanggal            = $request->tanggal;
                        $jurnalK->perusahaan         = $request->atas_nama;
                        $jurnalK->akun_debit         = $request->kredit;
                        $jurnalK->akun_kredit        = $request->debit;
                        $jurnalK->nama_brg           = $request->barang;
                        $jurnalK->jumlah_kredit      = $request->jumlah;
                        $jurnalK->keterangan         = $request->keterangan;
                        $jurnalK->status             = "Belum Diperiksa";
                        $jurnalK->save();
                    }
                }
            }

            return response()->json(['success' => true, 'pesan' => 'Data berhasil ' . ($request->id ? 'diupdate' : 'ditambahkan')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    //Logika modal edit dan detail
    public function edit_modal($kode)
    {
        try {
            $kas = Kas::where('kas.kode', $kode)
            ->leftJoin('bank', 'bank.kode', '=', 'kas.bank') // Join dengan bank
            ->leftJoin('kodeakuntansi as debit_akun', 'debit_akun.kode', '=', 'kas.debit') // Alias untuk debit
            ->leftJoin('kodeakuntansi as kredit_akun', 'kredit_akun.kode', '=', 'kas.kredit') // Alias untuk kredit
            ->select(
                'kas.*', // Semua kolom dari kas
                'bank.bank as bank_nama', // Alias untuk menghindari bentrok dengan kas.bank
                'bank.rekening as bank_rekening', // Tetap sesuai dengan tabel bank
                'bank.atas_nama as bank_atas_nama', // Alias untuk menghindari bentrok dengan kas.atas_nama
                'debit_akun.nama_perkiraan as nama_perkiraan_debit', // Nama perkiraan dari debit
                'kredit_akun.nama_perkiraan as nama_perkiraan_kredit', // Nama perkiraan dari kredit
                DB::raw("
                    CASE 
                        WHEN kas.atas_nama = 'npa' THEN 'CV. Nusa Pratama Anugrah'
                        WHEN kas.atas_nama = 'herbivor' THEN 'PT. Herbivor Satu Nusa'
                        WHEN kas.atas_nama = 'triputra' THEN 'PT. Triputra Sinergi Indonesia'
                        ELSE kas.atas_nama
                    END as atas_nama_perusahaan
                ") // Konversi atas_nama berdasarkan kondisi
            )
            ->firstOrFail();


            return response()->json([
                'success' => true,
                'data' => $kas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'pesan' => 'Data tidak ditemukan!'
            ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Jangan HAPUS (Untuk Edit PO)
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

    //Update Data Edit
    public function update(Request $request, $kode)
    {
        try {
            // Update data kas
            DB::table('kas')->where('kode', $kode)
                ->update([
                    'tanggal' => $request->tanggal,
                    'bank' => $request->bank,
                    'dk' => $request->dk,
                    'jenis' => $request->jenis,
                    'debit' => $request->debit,
                    'kredit' => $request->kredit,
                    'atas_nama' => $request->atas_nama,
                    'dpp' => $request->dpp,
                    'ppn' => $request->ppn,
                    'barang' => $request->barang,
                    'jumlah' => $request->jumlah,
                    'kode_ref' => $request->kode_ref,
                    'keterangan' => $request->keterangan
                ]);
    
            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Kas";
            $log->save();
    
            // Update data jurnal DEBIT
            DB::table('jurnal')
                ->where('kode_transaksi', 'like', "{$kode}.%D") // Mencari kode_transaksi dengan format KAS.xxxx.D
                ->update([
                    'tanggal' => $request->tanggal,
                    'perusahaan' => $request->atas_nama,
                    'akun_debit' => $request->debit,
                    'akun_kredit' => $request->kredit,
                    'nama_brg' => $request->barang,
                    'jumlah_debit' => $request->jumlah,
                    'keterangan' => $request->keterangan,
                    'status' => 'Belum Diperiksa'
                ]);
    
            // Update data jurnal KREDIT
            DB::table('jurnal')
                ->where('kode_transaksi', 'like', "{$kode}.%K") // Mencari kode_transaksi dengan format KAS.xxxx.K
                ->update([
                    'tanggal' => $request->tanggal,
                    'perusahaan' => $request->atas_nama,
                    'akun_debit' => $request->kredit,
                    'akun_kredit' => $request->debit,
                    'nama_brg' => $request->barang,
                    'jumlah_kredit' => $request->jumlah,
                    'keterangan' => $request->keterangan,
                    'status' => 'Belum Diperiksa'
                ]);
    
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diedit"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    
    //Ubah Status Ke Sudah Diperiksa
    public function updateStatus(Request $request, $kode)
    {
        try {
            // Validasi input
            $request->validate(['status' => 'required|string']);

            // Cari data berdasarkan kode
            DB::table('kas')->where('kode', $kode)
                ->update([
                    'status' => $request->status
                ]);
         

            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Update Status Kas " . $request->status;
            $log->save();

            // Perbarui status jurnal terkait
            jurnal::where('kode_transaksi', 'like', "{$kode}.%")
                ->update(['status' => $request->status]);

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    //Ubah status ke Selesai
    public function selesai(Request $request, $kode)
    {
        try {
            // Validasi input
            $request->validate(['status' => 'required|string']);

            // Cari data berdasarkan kode
            DB::table('kas')->where('kode', $kode)
                ->update([
                    'status' => $request->status
                ]);
         

            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Update Status Kas " . $request->status;
            $log->save();

            // Perbarui status jurnal terkait
            jurnal::where('kode_transaksi', 'like', "{$kode}.%")
                ->update(['status' => $request->status]);

            // Cari kode_ref di tabel kas
            // $kas = DB::table('kas')->where('kode', $kode)->first();

            // Cari kode_ref di tabel kas dan join dengan materialreceive untuk mendapatkan kode dari transaksi yang sama
            $kas = DB::table('kas')
            ->leftJoin('materialreceive', 'materialreceive.transaksi', '=', 'kas.kode_ref')
            ->leftJoin('invoice', 'invoice.kode_so', '=', 'kas.kode_ref')
            ->select(
                'kas.*', 
                'materialreceive.kode as materialreceive_kode', 
                'invoice.kode as invoice_kode')
            ->where('kas.kode', $kode)
            ->first();

            if ($kas && str_starts_with($kas->kode_ref, 'SO')) { // Jika kode_ref diawali dengan 'SO'
                // Ekstrak kode_ref menjadi format yang diinginkan
                jurnal::where('kode_transaksi', 'like', "$kas->kode.%K")->delete(); 

                $kodeInvoice = $kas->invoice_kode ?? "Data Tidak Ditemukan";
                jurnal::where('kode_transaksi', 'like', "$kodeInvoice.%D")->delete();

                // $kodeRefParts = explode('.', $kas->kode_ref); // Pecah kode_ref berdasarkan '.'
                // if (count($kodeRefParts) >= 4) {
                //     // Ambil bagian yang relevan dari kode_ref
                //     $kodeRefFormatted = "{$kodeRefParts[2]}.{$kodeRefParts[3]}";

                //     // Bentuk pola kode_transaksi untuk INV
                //     $kodeTransaksiINV = "INV.{$kodeRefFormatted}.%D";

                //     // Bentuk pola kode_transaksi untuk SJ
                //     //$kodeTransaksiSJ = "SJ.%.{$kodeRefFormatted}.%D";

                //     // Hapus data di tabel jurnal dengan kode_transaksi yang sesuai untuk INV
                //     jurnal::where('kode_transaksi', 'like', $kodeTransaksiINV)->delete();

                //     // Hapus data di tabel jurnal dengan kode_transaksi yang sesuai untuk SJ
                //     //jurnal::where('kode_transaksi', 'like', $kodeTransaksiSJ)->delete();
                // }
            }

            if ($kas && str_starts_with($kas->kode_ref, 'PO')) { // Jika kode_ref diawali dengan 'PO'
                // Ekstrak kode_ref menjadi format yang diinginkan
                jurnal::where('kode_transaksi', 'like', "$kas->kode.%D")->delete(); 

                // Gunakan nilai kode dari materialreceive
                $kodeMaterialReceive = $kas->materialreceive_kode ?? "Data Tidak Ditemukan";

                jurnal::where('kode_transaksi', 'like', "$kodeMaterialReceive.%K")->delete();

                // $kodeRefParts = explode('.', $kas->kode_ref); // Pecah kode_ref berdasarkan '.'
                // if (count($kodeRefParts) >= 4) {
                //     // Ambil bagian yang relevan dari kode_ref
                //     $kodeRefFormatted = "{$kodeRefParts[2]}.{$kodeRefParts[3]}";

                //     // Bentuk pola kode_transaksi untuk MR
                //     $kodeTransaksiMR = "MR.%.{$kodeRefFormatted}.%K";


                //     // Hapus data di tabel jurnal dengan kode_transaksi yang sesuai untuk MR
                //     jurnal::where('kode_transaksi', 'like', $kodeTransaksiMR)->delete();
                // }
            }

            return response()->json(['success' => true, 'pesan' => 'Status berhasil diperbarui menjadi Selesai.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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
