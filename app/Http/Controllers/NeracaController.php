<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\neraca;
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

class NeracaController extends Controller
{
    public function index()
    {
        $login = Auth::user();
        // Query dengan join
        $data = neraca::select(
            'neraca.*', 
            'neraca.kode as kode_transaksi',
            'kode_debit_akuntansi.nama_perkiraan as nama_perkiraan_debit', 
            'kode_kredit_akuntansi.nama_perkiraan as nama_perkiraan_kredit',
            //'kode_akun_akuntansi.nama_perkiraan as nama_perkiraan_akun',
            'bank.bank', // Hanya kolom bank
            'bank.rekening', // Hanya kolom rekening
            'bank.atas_nama' // Hanya kolom atas_nama
            )
        ->leftJoin('kodeakuntansi as kode_debit_akuntansi', 'neraca.debit', '=', 'kode_debit_akuntansi.kode')
        ->leftJoin('kodeakuntansi as kode_kredit_akuntansi', 'neraca.kredit', '=', 'kode_kredit_akuntansi.kode')
        //->leftJoin('kodeakuntansi as kode_akun_akuntansi', 'neraca.akun', '=', 'kode_akun_akuntansi.kode') 
        ->leftJoin('bank', 'neraca.akun', '=', 'bank.kode')// Join baru untuk kolom kas
        ->orderBy('neraca.kode', 'DESC')
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
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
                    // $actions .= "<a class='dropdown-item hapus text-danger' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-hapus'>Hapus</a>";
                } elseif ($data->status == 'Selesai') {
                    $actions .= "<a class='dropdown-item detail text-info' data-toggle='modal' data-kode='{$data->kode}' data-target='#modal-detail'>Detail</a>";
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
            //Ubah nama perusahaan
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
            ->editColumn('kode_transaksi', function ($data) {
                return $data->kode_transaksi; // Pastikan menggunakan alias kode_transaksi dari tabel neraca
            })
            ->editColumn('nama_bank', function ($data) {
                return $data->bank . " " . $data->rekening . " ".  $data->atas_nama;
            })
            ->make(true);
    }

    public function lastkode(Request $request)
    {
        $kode = 'NRC.' . $request->tanggal . '.';
        $data = neraca::select('kode')->where('kode', 'like', $kode . '%')->orderBy('kode', 'desc')->first();
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

    public function store(Request $request)
    {
        try {
            $neraca = $request->id ? neraca::find($request->id) : new neraca();

            $neraca->kode        = $request->kode;
            $neraca->tanggal     = $request->tanggal;
            $neraca->akun        = $request->akun; 
            $neraca->perusahaan  = $request->perusahaan; 
            $neraca->jumlah      = $request->jumlah; 
            $neraca->debit       = $request->debit;
            $neraca->kredit      = $request->kredit;
            $neraca->keterangan  = $request->keterangan;
            $neraca->status      = "Belum Diperiksa";
            //$neraca->save();
            $resultneraca = $neraca->save();

            if($resultneraca){
                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->user;
                $log->keterangan = $request->id ? "Update Data Neraca" : "Tambah Data Neraca";
                $resultlog = $log->save();

                if($resultlog){
                    // Menentukan iterasi untuk kode transaksi DEBIT
                    $lastDebit = jurnal::where('kode_transaksi', 'like', 'NRC.%D')->orderBy('kode_transaksi', 'desc')->first();

                    // Extract the number part correctly
                    $nextDebitIteration = 1; // Default value if no previous record exists
                    if ($lastDebit) {
                        // Use regex to extract the number part before the 'D'
                        preg_match('/\.(\d+)D$/', $lastDebit->kode_transaksi, $matches);
                        if (isset($matches[1])) {
                            $nextDebitIteration = intval($matches[1]) + 1;
                        }
                    }

                    // Membuat kode transaksi DEBIT dengan iterasi
                    $kodeDebit = str_pad($request->kode, 4, '0', STR_PAD_LEFT) . "." . str_pad($nextDebitIteration, 3, '0', STR_PAD_LEFT) . "D";

                    //Jurnal DEBIT
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi     = $kodeDebit;
                    $jurnalD->tanggal            = $request->tanggal;
                    $jurnalD->perusahaan         = $request->perusahaan;
                    $jurnalD->akun_debit         = $request->debit;
                    $jurnalD->akun_kredit        = $request->kredit;
                    $jurnalD->jumlah_debit       = $request->jumlah;
                    $jurnalD->keterangan         = $request->keterangan;
                    $jurnalD->status             = "Belum Diperiksa";
        
                    $resultjurnalDinv = $jurnalD->save();
                        if($resultjurnalDinv){
                        // Menentukan iterasi untuk kode transaksi DEBIT
                        $lastCredit = jurnal::where('kode_transaksi', 'like', 'NRC.%K')->orderBy('kode_transaksi', 'desc')->first();

                        // Extract the number part correctly
                        $nextCreditIteration = 1; // Default value if no previous record exists
                        if ($lastCredit) {
                            // Use regex to extract the number part before the 'D'
                            preg_match('/\.(\d+)K$/', $lastCredit->kode_transaksi, $matches);
                            if (isset($matches[1])) {
                                $nextCreditIteration = intval($matches[1]) + 1;
                            }
                        }

                        // Membuat kode transaksi Credit dengan iterasi
                        $kodeCredit = str_pad($request->kode, 4, '0', STR_PAD_LEFT) . "." . str_pad($nextCreditIteration, 3, '0', STR_PAD_LEFT) . "K";

                        //Jurnal KREDIT
                        $jurnalK = new jurnal();

                        $jurnalK->kode_transaksi    = $kodeCredit;
                        $jurnalK->tanggal            = $request->tanggal;
                        $jurnalK->perusahaan         = $request->perusahaan;
                        $jurnalK->akun_debit         = $request->kredit;
                        $jurnalK->akun_kredit        = $request->debit;
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

    public function edit($kode)
    {
        try {
            $neraca = Neraca::where('neraca.kode', $kode)
            ->leftJoin('bank', 'bank.kode', '=', 'neraca.akun') // Join dengan bank
            ->leftJoin('kodeakuntansi as debit_akun', 'debit_akun.kode', '=', 'neraca.debit') // Alias untuk debit
            ->leftJoin('kodeakuntansi as kredit_akun', 'kredit_akun.kode', '=', 'neraca.kredit') // Alias untuk kredit
            ->select(
                'neraca.*', // Semua kolom dari kas
                'bank.bank as bank_nama', // Alias untuk menghindari bentrok dengan kas.bank
                'bank.rekening as bank_rekening', // Tetap sesuai dengan tabel bank
                'bank.atas_nama as bank_atas_nama', // Alias untuk menghindari bentrok dengan kas.atas_nama
                'debit_akun.nama_perkiraan as nama_perkiraan_debit', // Nama perkiraan dari debit
                'kredit_akun.nama_perkiraan as nama_perkiraan_kredit', // Nama perkiraan dari kredit
                DB::raw("
                    CASE 
                        WHEN neraca.perusahaan = 'npa' THEN 'CV. Nusa Pratama Anugrah'
                        WHEN neraca.perusahaan = 'herbivor' THEN 'PT. Herbivor Satu Nusa'
                        WHEN neraca.perusahaan = 'triputra' THEN 'PT. Triputra Sinergi Indonesia'
                        ELSE neraca.perusahaan
                    END as nama_perusahaan
                ") // Konversi atas_nama berdasarkan kondisi
            )
            ->firstOrFail();
            

            return response()->json([
                'success' => true,
                'data' => $neraca
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'pesan' => 'Data tidak ditemukan!'
            ]);
        }
    }

    public function update(Request $request, $kode)
    {
        try {
            // Update data kas
            DB::table('neraca')->where('kode', $kode)
                ->update([
                    'tanggal' => $request->tanggal,
                    'akun' => $request->akun,
                    'perusahaan' => $request->perusahaan,
                    'debit' => $request->debit,
                    'kredit' => $request->kredit,
                    'jumlah' => $request->jumlah,
                    'keterangan' => $request->keterangan
                ]);
    
            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Neraca";
            $log->save();
    
            // Update data jurnal DEBIT
            DB::table('jurnal')
                ->where('kode_transaksi', 'like', "{$kode}.%D") // Mencari kode_transaksi dengan format KAS.xxxx.D
                ->update([
                    'tanggal' => $request->tanggal,
                    'perusahaan' => $request->perusahaan,
                    'akun_debit' => $request->debit,
                    'akun_kredit' => $request->kredit,
                    'jumlah_debit' => $request->jumlah,
                    'keterangan' => $request->keterangan,
                    'status' => 'Belum Diperiksa'
                ]);
    
            // Update data jurnal KREDIT
            DB::table('jurnal')
                ->where('kode_transaksi', 'like', "{$kode}.%K") // Mencari kode_transaksi dengan format KAS.xxxx.K
                ->update([
                    'tanggal' => $request->tanggal,
                    'perusahaan' => $request->perusahaan,
                    'akun_debit' => $request->kredit,
                    'akun_kredit' => $request->debit,
                    'jumlah_kredit' => $request->jumlah,
                    'keterangan' => $request->keterangan,
                    'status' => 'Belum Diperiksa'
                ]);
    
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diedit"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request, $kode)
    {
        try {
            // Validasi input
            $request->validate(['status' => 'required|string']);

            // Cari data berdasarkan kode
            DB::table('neraca')->where('kode', $kode)
                ->update([
                    'status' => $request->status
                ]);
         

            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Update Status Neraca " . $request->status;
            $log->save();

            // Perbarui status jurnal terkait
            jurnal::where('kode_transaksi', 'like', "{$kode}.%")
                ->update(['status' => $request->status]);


            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function selesai(Request $request, $kode)
    {
        try {
            // Validasi input
            $request->validate(['status' => 'required|string']);

            // Cari data berdasarkan kode
            DB::table('neraca')->where('kode', $kode)
                ->update([
                    'status' => $request->status
                ]);
         

            // Log perubahan data
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Update Status Neraca " . $request->status;
            $log->save();

            // Perbarui status jurnal terkait
            jurnal::where('kode_transaksi', 'like', "{$kode}.%")
                ->update(['status' => $request->status]);

            return response()->json(['success' => true, 'pesan' => 'Status berhasil diperbarui menjadi Selesai.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    

    public function destroy(Request $request, $id)
    {
        //
        try {
            neraca::where('kode', $id)->delete();
            jurnal::where('kode_transaksi', 'LIKE', "$id%")->delete();

            $log = new log_sistem();
            $log->transaksi = $id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Neraca";
            $log->save();

            return response()->json(['success' => true, 'pesan' => "Data Berhasil Dihapus"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
