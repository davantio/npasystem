<?php

namespace App\Http\Controllers;

use App\Models\detail_po;
use App\Models\barang;
use App\Models\detail_kas;
use App\Models\detail_mr;
use App\Models\detail_so;
use App\Models\detail_invoice;
use App\Models\gudang;
use App\Models\hpp;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\bank;
use App\Models\kas;
use App\Models\kode_akuntansi;
use App\Models\purchaseorder;
use App\Models\materialreceive;
use App\Models\rekanan;
use App\Models\salesorder;
use App\Models\suratjalan;
use App\Models\target_marketing;
use App\Models\targetomset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
use Throwable;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail_po($kode)
    {
        try {
            $data = [];
            $jurnal = jurnal::where('kode_transaksi', 'LIKE', "$kode%")->get();
            foreach ($jurnal as $jurnal) {
                $sub = substr($jurnal->kode_transaksi, 11, 4);
                $sub  = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_kredit)->first();
                $detail = detail_po::where('kode', $sub)->first();
                $jurnal->kode = $sub;
                $jurnal->hpp = $detail->harga;
                $jurnal->disc = $detail->diskon;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function detail_mr($kode)
    {
        try {
            $data = [];
            $jurnal = jurnal::where('kode_transaksi', 'LIKE', "$kode%")->get();
            foreach ($jurnal as $jurnal) {
                $sub = substr($jurnal->kode_transaksi, 11, 4);
                $sub = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_kredit)->first();
                $detail = detail_mr::where('kode', $sub)->first();
                $jurnal->kode = $sub;
                $jurnal->hpp = $detail->harga;
                $jurnal->disc = $detail->diskon;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function cek_so(Request $request)
    {
        try {
            if ($request->user == null) {
                $data = salesorder::select('salesorder.kode', 'rekanan.nama', 'salesorder.status')
                    ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                    ->where('salesorder.status', "Belum Diperiksa")
                    ->get();
            } else {
                $data = salesorder::select('salesorder.kode', 'rekanan.nama', 'salesorder.status')
                    ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                    ->where('salesorder.status', "Belum Diperiksa")
                    ->where('salesorder.marketing', $request->user)
                    ->get();
            }
            foreach ($data as $D) {
                $detail = detail_so::select(DB::raw('SUM(total)as TOTAL'))
                    ->where('kode_so', $D->kode)->first();
                $D->total = $detail->TOTAL;
            }

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function cek_sj(Request $request)
    {
        try {
            if ($request->user == null) {
                $data = suratjalan::select('suratjalan.*', 'rekanan.nama')
                    ->join('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                    ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                    ->where('suratjalan.status', "Sudah Diperiksa")->get();
            } else {
                $data = suratjalan::select('suratjalan.*', 'rekanan.nama')
                    ->join('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                    ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                    ->where('salesorder.marketing', $request->user)
                    ->where('suratjalan.status', "Sudah Diperiksa")->get();
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        try {
            $data = DB::table('invoice')
                ->where('status', 'Selesai')
                ->whereBetween('tanggal', [$request->awal, $request->akhir])->get();
            $output = array();
            foreach ($data as $D) {
                $n = 0;
                $detail = jurnal::where('kode_transaksi', 'LIKE', "$D->kode%D")->get();
                $totalharga = 0;
                foreach ($detail as $barang) {
                    $total = jurnal::select(DB::raw('SUM(jumlah_debit)as total'))
                        ->where('kode_transaksi', 'LIKE', "$D->kode%D")->first();
                    $output[$n]['tanggal_invoice'] = $D->tanggal;
                    $output[$n]['invoice'] = $D->kode;
                    $output[$n]['SO'] = $D->kode_so;
                    $output[$n]['Customer'] = $barang->nama_rekanan;
                    $output[$n]['Marketing'] = $barang->nama_marketing;
                    $output[$n]['Barang'] = $barang->nama_brg;
                    $output[$n]['Qty'] = $barang->qty_debit;
                    $output[$n]['Satuan'] = $barang->satuan;
                    $output[$n]['Harga'] = $barang->harga_debit;
                    $output[$n]['DPP'] = $barang->qty_debit * $barang->harga_debit;
                    if ($barang->vat == 0) {
                        $output[$n]['PPN'] = 0;
                    } else {
                        $PPN = (($barang->qty_debit * $barang->harga_debit) * $barang->vat) / 100;
                        $output[$n]['PPN'] = $PPN;
                    }
                    $output[$n]['Penjualan'] = $barang->jumlah_debit;
                    $output[$n]['Asal_Gudang'] = $barang->nama_gdg;
                    if ($n == 0) {
                        $s = 1;
                        $kas = jurnal::where('kode_transaksi', 'LIKE', "KAS%D")
                            ->where('keterangan', $D->kode)->where('status', 'Selesai')->get();
                        $totalbayar = 0;
                        foreach ($kas as $pembayaran) {
                            $output[$n]['Pembayaran ' . $s] = $pembayaran->jumlah_debit;

                            $totalbayar = $totalbayar + $pembayaran->jumlah_debit;
                            $s++;
                        }
                        for ($s = $s; $s <= 5; $s++) {
                            $output[$n]['Pembayaran ' . $s] = "-";
                        }
                    } else {
                        $totalbayar = 0;
                        for ($s = 1; $s <= 5; $s++) {
                            $output[$n]['Pembayaran ' . $s] = "-";
                        }
                    }
                    if ($D->kode_bank == 3) {
                        $output[$n]['VIA'] = "Tunai";
                        $output[$n]['BANK'] = "-";
                    } else {
                        $bank = bank::where('kode', $D->kode_bank)->first();
                        $output[$n]['VIA'] = "TF";
                        $output[$n]['BANK'] = $bank->bank;
                    }
                    $sisa = $total->total - $totalbayar;
                    $output[$n]['Sisa_Piutang'] = $sisa;
                    if ($sisa == 0) {
                        $output[$n]['status'] = "LUNAS";
                    } else {
                        $output[$n]['status'] = "BELUM LUNAS";
                    }
                    $n++;
                }
            }
            return response()->json(['success' => true, 'data' => $output]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    //Laporan Piutang
    public function laporanpiutang(Request $request)
    {
        try {
            $keterangan = array();
            $laporan = array();
            $total = 0;
            $data = $result = jurnal::where(function ($query) {
                $query->where('kode_transaksi', 'LIKE', "INV%D")
                    ->where('status', '!=', 'Belum Diperiksa')
                    ->orWhere('kode_transaksi', 'LIKE', "KAS%D")
                    ->where('status', 'Selesai');
            })
                ->where('kode_rekanan', $request->customer)
                ->whereBetween('updated_at', [
                    date('Y-m-d', strtotime($request->awal)),
                    date('Y-m-d', strtotime($request->akhir))
                ])
                ->where(function ($query) {
                    $query->where('akun_debit', 12)
                        ->orWhere('akun_kredit', 12);
                })
                ->orderBy('updated_at', 'ASC')->get();

            $n = 0;
            foreach ($data as $d) {
                $a = substr($d->kode_transaksi, 0, 3);
                if ($n > 0) {
                    if ($a == "INV") {
                        $kode = substr($d->kode_transaksi, 0, 13);
                    } else {
                        $kode = substr($d->kode_transaksi, 0, 12);
                    }

                    $transaksi_values = array_column($laporan, 'transaksi');

                    if (in_array($kode, $transaksi_values)) {
                    } else {
                        if ($a == "INV") {

                            $sum = jurnal::select(DB::raw("SUM(jumlah_debit) AS total"))->where('kode_transaksi', 'LIKE', "$kode%D")->first();
                            $sum = $sum->total;
                            $total = $total + $sum;
                        } else {
                            $sum = $d->jumlah_debit;
                            $total = $total - $sum;
                        }
                        $D = kode_akuntansi::where('kode', $d->akun_debit)->first();
                        $K = kode_akuntansi::where('kode', $d->akun_kredit)->first();
                        $laporan[$n]['d'] = $d->akun_debit . " - " . $D->nama_perkiraan;
                        $laporan[$n]['k'] = $d->akun_kredit . " - " . $K->nama_perkiraan;
                        $laporan[$n]['transaksi'] = $kode;
                        $laporan[$n]['nominal'] = "Rp." . number_format($sum, 2, ',', '.');
                        $laporan[$n]['total'] = "Rp." . number_format($total, 2, ',', '.');

                        $n++;
                    }
                } else {

                    if ($a == "INV") {
                        $kode = substr($d->kode_transaksi, 0, 13);

                        $sum = jurnal::select(DB::raw("SUM(jumlah_debit) AS total"))->where('kode_transaksi', 'LIKE', "$kode%D")->first();
                        $sum = $sum->total;
                        $total = $total + $sum;
                    } else {
                        $sum = $d->jumlah_debit;
                        $kode = substr($d->kode_transaksi, 0, 12);
                        $total = $total - $sum;
                    }
                    $D = kode_akuntansi::where('kode', $d->akun_debit)->first();
                    $K = kode_akuntansi::where('kode', $d->akun_kredit)->first();
                    $laporan[$n]['d'] = $d->akun_debit . " - " . $D->nama_perkiraan;
                    $laporan[$n]['k'] = $d->akun_kredit . " - " . $K->nama_perkiraan;
                    $laporan[$n]['transaksi'] = $kode;
                    $laporan[$n]['nominal'] = "Rp." . number_format($sum, 2, ',', '.');
                    $laporan[$n]['total'] = "Rp." . number_format($total, 2, ',', '.');

                    $n++;
                }
            }
            $data = DataTables::of($laporan)->addIndexColumn()->make(true);
            $awal = Carbon::createFromFormat('Y-m-d', $request->awal);
            $akhir = Carbon::createFromFormat('Y-m-d', $request->akhir);
            $tgl_awal = $awal->translatedFormat('j F Y');
            $tgl_akhir = $akhir->translatedFormat('j F Y');
            $keterangan['tanggal'] = $tgl_awal . " - " . $tgl_akhir;
            $keterangan['selisih'] =  "<b>Rp. " . number_format($total, 2, ',', '.') . "</b>";
            return response()->json(['success' => true, 'data' => $data, 'keterangan' => $keterangan]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function cek_inv(Request $request)
    {
        try {
            if ($request->user == null) {
                $data = [];
                $n = 0;
                $inv = invoice::select('kode')->where('status', "Sudah Diperiksa")->distinct()->get();
                foreach ($inv as $V) {

                    $konsumen = jurnal::where('kode_transaksi', 'LIKE', "$V->kode%D")->first();

                    $nilai = jurnal::select(DB::raw('SUM(jumlah_debit) AS total'))
                        ->where('kode_transaksi', 'LIKE', "$V->kode%")
                        ->where('status', "Sudah Diperiksa")
                        ->first();
                    $kas = jurnal::select(DB::raw('SUM(jumlah_debit) as total'))
                        ->where('keterangan', 'LIKE', "$V->kode%")
                        ->where('status', "Sudah Diperiksa")
                        ->first();
                    $selisih = $nilai->total - $kas->total;
                    $data[$n]['kode'] = $V->kode;
                    $data[$n]['konsumen'] = $konsumen->nama_rekanan;
                    $data[$n]['nilai']   = $nilai->total;

                    if ($kas->total == null) {
                        $data[$n]['pembayaran'] = 0;
                        $data[$n]['selisih'] = 0 - $nilai->total;
                    } else {
                        $data[$n]['pembayaran'] = $kas->total;
                        $data[$n]['selisih'] = $nilai->total - $kas->total;
                    }
                    $n++;
                }
            } else {
                $data = [];
                $n = 0;
                $inv = jurnal::select('kode_transaksi')->where('kode_marketing', $request->user)->where('kode_transaksi', 'LIKE', "INV%D")->get();
                foreach ($inv as $V) {
                    $kode = substr($V->kode_transaksi, 0, 13);

                    $konsumen = jurnal::where('kode_transaksi', 'LIKE', "$kode%")->where('kode_marketing', $request->user)->first();

                    $nilai = jurnal::select(DB::raw('SUM(jumlah_debit) AS total'))
                        ->where('kode_transaksi', 'LIKE', "$kode%")
                        ->where('kode_marketing', $request->user)
                        ->where('status', "Sudah Diperiksa")
                        ->first();
                    $kas = jurnal::select(DB::raw('SUM(jumlah_debit) as total'))
                        ->where('keterangan', 'LIKE', "$kode%")
                        ->where('status', "Sudah Diperiksa")
                        ->first();
                    $selisih = $nilai->total - $kas->total;
                    $data[$n]['kode'] = $kode;
                    $data[$n]['konsumen'] = $konsumen->nama_rekanan;
                    $data[$n]['nilai']   = $nilai->total;

                    if ($kas->total == null) {
                        $data[$n]['pembayaran'] = 0;
                        $data[$n]['selisih'] = 0 - $nilai->total;
                    } else {
                        $data[$n]['pembayaran'] = $kas->total;
                        $data[$n]['selisih'] = $nilai->total - $kas->total;
                    }
                    $n++;
                }
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function cek_po()
    {
        try {
            $n = 0;
            $po = purchaseorder::select('purchaseorder.kode', 'rekanan.nama')->join('rekanan', 'rekanan.kode', 'purchaseorder.supplier')->where('purchaseorder.status', 'Belum Diperiksa')->get();
            foreach ($po as $p) {
                $n++;
                $p->no = $n;
                $dtl = detail_po::select(DB::raw("harga*qty AS total"))->where('kode_po', $p->kode)->first();
                $p->total = $dtl->total;
            }
            return response()->json(['success' => true, 'data' => $po]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function detail_so($kode)
    {
        $data = [];
        $detail = jurnal::where('kode_transaksi', 'LIKE', "$kode%")->get();
        foreach ($detail as $jurnal) {
            $sub = substr($jurnal->kode_transaksi, 11, 4);
            $sub = intval($sub);
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_kredit)->first();
            $detail = detail_so::where('kode', $sub)->first();
            $jurnal->kode = $sub;
            $jurnal->dpp = $detail->harga * $detail->qty;
            $jurnal->nama_debit = $debit->nama_perkiraan;
            $jurnal->nama_kredit = $kredit->nama_perkiraan;
            $data[] = $jurnal;
        }
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function detail_sj($kode)
    {
        try {
            $data = [];
            $jurnal = jurnal::where('kode_transaksi', 'LIKE', "$kode%")->get();
            foreach ($jurnal as $jurnal) {
                $sub = substr($jurnal->kode_transaksi, 11, 4);
                $sub = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode', $jurnal->akun_kredit)->first();
                $jurnal->kode = $sub;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function data_bukubesar(Request $request)
    {
        try {
            // Ambil daftar kode akun
            $data = kode_akuntansi::select('kode', 'nama_perkiraan')->get();
            $allTransactions = []; // Menyimpan semua transaksi debit dan kredit

            foreach ($data as $D) {
                $D->perkiraan = $D->kode . " - " . $D->nama_perkiraan;

                // Ambil data jurnal berdasarkan akun_debit
                $debitTransaksi = jurnal::select('tanggal', 'jumlah_debit AS jumlah')
                    ->where('akun_debit', $D->kode)
                    ->whereBetween('tanggal', [$request->awal, $request->akhir]) // Menggunakan kolom tanggal
                    ->where('jumlah_debit', '>', 0) // Hanya ambil yang memiliki nilai > 0
                    ->where('status', 'Selesai')
                    ->orderBy('tanggal', 'asc')
                    ->get();

                // Ambil data jurnal berdasarkan akun_kredit
                $kreditTransaksi = jurnal::select('tanggal', 'jumlah_kredit AS jumlah')
                    ->where('akun_debit', $D->kode)
                    ->whereBetween('tanggal', [$request->awal, $request->akhir]) // Menggunakan kolom tanggal
                    ->where('jumlah_kredit', '>', 0) // Hanya ambil yang memiliki nilai > 0
                    ->where('status', 'Selesai')
                    ->orderBy('tanggal', 'asc')
                    ->get();

                // Gabungkan data debit dan kredit ke dalam satu koleksi
                foreach ($debitTransaksi as $transaksi) {
                    $saldoAkhir = $transaksi->jumlah; // Saldo akhir dari transaksi debit
                    $allTransactions[] = [
                        'tanggal' => $transaksi->tanggal,
                        'perkiraan' => $D->perkiraan,
                        'debit_masuk' => "Rp." . number_format($transaksi->jumlah, 2, ',', '.'),
                        'kredit_masuk' => "Rp.0,00",
                        'saldo_akhir' => "Rp." . number_format($saldoAkhir, 2, ',', '.'),
                    ];
                }

                foreach ($kreditTransaksi as $transaksi) {
                    $saldoAkhir = $transaksi->jumlah; // Saldo akhir dari transaksi kredit (tidak negatif)
                    $allTransactions[] = [
                        'tanggal' => $transaksi->tanggal,
                        'perkiraan' => $D->perkiraan,
                        'debit_masuk' => "Rp.0,00",
                        'kredit_masuk' => "Rp." . number_format($transaksi->jumlah, 2, ',', '.'),
                        'saldo_akhir' => "Rp." . number_format($saldoAkhir, 2, ',', '.'),
                    ];
                }
            }

            // Urutkan data berdasarkan tanggal (dari kecil ke besar)
            // usort($allTransactions, function ($a, $b) {
            //     return strtotime($a['tanggal']) - strtotime($b['tanggal']);
            // });

            // Setelah data diurutkan, format ulang tanggal
            // foreach ($allTransactions as &$transaction) {
            //     $transaction['tanggal'] = \Carbon\Carbon::parse($transaction['tanggal'])->translatedFormat('j F Y');
            // }

            return response()->json(['success' => true, 'data' => $allTransactions]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }


    //Kode LAMA

    // public function data_labarugi(Request $request)
    // {
    //     try {
    //         $awal = $request->awal;
    //         $akhir = $request->akhir;

    //         $query = "
    //                 WITH total_pendapatan AS (
    //             SELECT
    //                 SUM(j.jumlah_debit) AS total_pendapatan
    //             FROM
    //                 jurnal j
    //                 JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //             WHERE
    //                 j.jumlah_debit IS NOT NULL
    //                 AND ka.jenis_laporan = 'laba/rugi'
    //                 AND ka.jenis = 'K'
    //                 AND j.created_at BETWEEN '$awal' AND '$akhir'
    //         ),
    //         total_beban AS (
    //             SELECT
    //                 SUM(j.jumlah_debit) AS total_beban
    //             FROM
    //                 jurnal j
    //                 JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //             WHERE
    //                 j.jumlah_debit IS NOT NULL
    //                 AND ka.jenis_laporan = 'laba/rugi'
    //                 AND ka.jenis = 'D'
    //                 AND j.created_at BETWEEN '$awal' AND '$akhir'
    //         )
    //         SELECT
    //             jurnal.kode_transaksi,
    //             jurnal.jumlah_debit,
    //             kodeakuntansi.nama_perkiraan,
    //             kodeakuntansi.jenis,
    //             jurnal.created_at,
    //             total_pendapatan.total_pendapatan,
    //             total_beban.total_beban,
    //             (total_pendapatan.total_pendapatan - total_beban.total_beban) AS total_labarugi
    //         FROM
    //             jurnal
    //         JOIN kodeakuntansi ON kodeakuntansi.kode = jurnal.akun_debit OR kodeakuntansi.kode = jurnal.akun_kredit
    //         CROSS JOIN total_pendapatan
    //         CROSS JOIN total_beban
    //         WHERE
    //             jurnal.jumlah_debit IS NOT NULL
    //             AND kodeakuntansi.jenis_laporan = 'laba/rugi'
    //             AND jurnal.created_at BETWEEN '$awal' AND '$akhir'
    //             ORDER BY jurnal.created_at DESC

    //             ";

    //         $data = DB::select($query);

    //         foreach ($data as $item) {
    //             $item->jumlah_debit = "Rp. " . number_format($item->jumlah_debit, 0, ',', '.');
    //             $item->total_pendapatan = "Rp. " . number_format($item->total_pendapatan, 0, ',', '.');
    //             $item->total_beban = "Rp. " . number_format($item->total_beban, 0, ',', '.');
    //             $item->total_labarugi = "Rp. " . number_format($item->total_labarugi, 0, ',', '.');
    //             $item->created_at = date('d-m-Y', strtotime($item->created_at));
    //         }

    //         return response()->json(['success' => true, 'data' => $data]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
    //     }
    // }

    //END KODE LAMA

    //KODE BARU

    public function data_labarugi(Request $request)
    {
        try {
            // Validasi input awal dan akhir
            $awal = $request->awal;
            $akhir = $request->akhir;
    
            // Total Pendapatan
            $totalPendapatan = DB::table('jurnal')
                ->join('kodeakuntansi', function ($join) {
                    $join->on('kodeakuntansi.kode', '=', 'jurnal.akun_debit');
                        //Agar menampilkan hanya kode akun_debit karena D dan K
                        // ->orOn('kodeakuntansi.kode', '=', 'jurnal.akun_kredit'); 
                })
                ->whereNotNull('jurnal.jumlah_kredit')
                ->where('kodeakuntansi.jenis_laporan', 'laba/rugi')
                ->where('kodeakuntansi.jenis', 'K')
                ->where('jurnal.status', 'Selesai')
                ->whereBetween('jurnal.tanggal', [$awal, $akhir])
                ->sum('jurnal.jumlah_kredit');
    
            // Total Beban
            $totalBeban = DB::table('jurnal')
                ->join('kodeakuntansi', function ($join) {
                    $join->on('kodeakuntansi.kode', '=', 'jurnal.akun_debit');
                        // ->orOn('kodeakuntansi.kode', '=', 'jurnal.akun_kredit');
                })
                ->whereNotNull('jurnal.jumlah_debit')
                ->where('kodeakuntansi.jenis_laporan', 'laba/rugi')
                ->where('kodeakuntansi.jenis', 'D')
                ->where('jurnal.status', 'Selesai')
                ->whereBetween('jurnal.tanggal', [$awal, $akhir])
                ->sum('jurnal.jumlah_debit');
    
            // Data Jurnal Detail
            $data = DB::table('jurnal')
                ->join('kodeakuntansi', function ($join) {
                    $join->on('kodeakuntansi.kode', '=', 'jurnal.akun_debit');
                        // ->orOn('kodeakuntansi.kode', '=', 'jurnal.akun_kredit');
                })
                ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->whereNotNull('jurnal.jumlah_kredit')
                          ->where('kodeakuntansi.jenis', 'K'); // Sama dengan totalPendapatan
                    })->orWhere(function ($q) {
                        $q->whereNotNull('jurnal.jumlah_debit')
                          ->where('kodeakuntansi.jenis', 'D'); // Sama dengan totalBeban
                    });
                })
                ->where('kodeakuntansi.jenis_laporan', 'laba/rugi')
                ->where('jurnal.status', 'Selesai')
                ->whereBetween('jurnal.tanggal', [$awal, $akhir])
                ->select(
                    'jurnal.kode_transaksi',
                    'jurnal.jumlah_debit',
                    'jurnal.jumlah_kredit',
                    'kodeakuntansi.nama_perkiraan',
                    'kodeakuntansi.jenis',
                    'jurnal.tanggal'
                )
                ->where(function ($query) {
                    $query->where('jurnal.jumlah_debit', '>', 0)
                          ->orWhere('jurnal.jumlah_kredit', '>', 0);
                })
                ->orderBy('jurnal.tanggal', 'desc')
                ->get();
    
            // Menambahkan total pendapatan, total beban, dan laba rugi ke setiap baris
            foreach ($data as $item) {
                $item->jumlah_kredit = "Rp. " . number_format($item->jumlah_kredit, 0, ',', '.');
                $item->jumlah_debit = "Rp. " . number_format($item->jumlah_debit, 0, ',', '.');
                $item->total_pendapatan = "Rp. " . number_format($totalPendapatan, 0, ',', '.');
                $item->total_beban = "Rp. " . number_format($totalBeban, 0, ',', '.');
                $item->total_labarugi = "Rp. " . number_format($totalPendapatan - $totalBeban, 0, ',', '.');
                $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
            }
    
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    

    //END KODE BARU

    //KODE BARU NERACA

    public function data_neraca(Request $request)
    {
        try {
            $awal = $request->awal;
            $akhir = $request->akhir;

            // Total Aktiva Lancar
            $totalAktivaLancar = DB::table('jurnal as j')
                ->join('kodeakuntansi as ka', function ($join) {
                    $join->on('ka.kode', '=', 'j.akun_debit');
                        // ->orOn('ka.kode', '=', 'j.akun_kredit');
                })
                ->where('ka.jenis_laporan', 'neraca')
                ->where('ka.group_laporan', 'aktiva lancar')
                ->where('j.status', 'Selesai')
                ->whereBetween('j.tanggal', [$awal, $akhir])
                ->selectRaw('SUM(j.jumlah_debit) as total_debit, SUM(j.jumlah_kredit) as total_kredit')
                ->first();

                //Hitung Total Final Aktiva Lancar
                $totalAktivaLancarDebet = $totalAktivaLancar->total_debit ?? 0;
                $totalAktivaLancarKredit = $totalAktivaLancar->total_kredit ?? 0;
                $totalAktivaLancarFinal = $totalAktivaLancarDebet - $totalAktivaLancarKredit;

            // Total Aktiva Tetap
            $totalAktivaTetap = DB::table('jurnal as j')
                ->join('kodeakuntansi as ka', function ($join) {
                    $join->on('ka.kode', '=', 'j.akun_debit');
                        // ->orOn('ka.kode', '=', 'j.akun_kredit');
                })
                ->whereNotNull('j.jumlah_debit')
                ->where('ka.jenis_laporan', 'neraca')
                ->where('ka.group_laporan', 'aktiva tetap')
                ->where('j.status', 'Selesai')
                ->whereBetween('j.tanggal', [$awal, $akhir])
                // ->sum('j.jumlah_debit');
                ->selectRaw('SUM(j.jumlah_debit) as total_debit, SUM(j.jumlah_kredit) as total_kredit')
                ->first();

                //Hitung Total Final Aktiva Tetap
                $totalAktivaTetapDebet = $totalAktivaTetap->total_debit ?? 0;
                $totalAktivaTetapKredit = $totalAktivaTetap->total_kredit ?? 0;
                $totalAktivaTetapFinal = $totalAktivaTetapDebet - $totalAktivaTetapKredit;


            // Total Passiva Lancar
            $totalPassivaLancar = DB::table('jurnal as j')
                ->join('kodeakuntansi as ka', function ($join) {
                    $join->on('ka.kode', '=', 'j.akun_debit');
                        // ->orOn('ka.kode', '=', 'j.akun_kredit');
                })
                // ->whereNotNull('j.jumlah_debit')
                ->where('ka.jenis_laporan', 'neraca')
                ->where('ka.group_laporan', 'passiva lancar')
                ->where('j.status', 'Selesai')
                ->whereBetween('j.tanggal', [$awal, $akhir])
                // ->sum('j.jumlah_debit');
                ->selectRaw('SUM(j.jumlah_debit) as total_debit, SUM(j.jumlah_kredit) as total_kredit')
                ->first();

                //Hitung Total Final Passiva lancar
                $totalPassivaLancarDebet = $totalPassivaLancar->total_debit ?? 0;
                $totalPassivaLancarKredit = $totalPassivaLancar->total_kredit ?? 0;
                $totalPassivaLancarFinal = $totalPassivaLancarKredit - $totalPassivaLancarDebet ;

            // Total Ekuitas
            $totalEkuitas = DB::table('jurnal as j')
                ->join('kodeakuntansi as ka', function ($join) {
                    $join->on('ka.kode', '=', 'j.akun_debit');
                        // ->orOn('ka.kode', '=', 'j.akun_kredit');
                })
                //->whereNotNull('j.jumlah_debit')
                ->where('ka.jenis_laporan', 'neraca')
                ->where(function ($query) {
                    $query->where('ka.group_laporan', 'modal')
                        ->orWhere('ka.group_laporan', 'laba yang ditahan');
                })
                ->where('j.status', 'Selesai')
                ->whereBetween('j.tanggal', [$awal, $akhir])
                // ->sum('j.jumlah_debit');
                ->selectRaw('SUM(j.jumlah_debit) as total_debit, SUM(j.jumlah_kredit) as total_kredit')
                ->first();

                //Hitung Total Final Ekuitas
                $totalEkuitasDebet = $totalEkuitas->total_debit ?? 0;
                $totalEkuitasKredit = $totalEkuitas->total_kredit ?? 0;
                $totalEkuitasFinal = $totalEkuitasKredit - $totalEkuitasDebet ;

            // Tambahkan setelah perhitungan total aset dan total kewajiban-ekuitas
            $isBalanced = ($totalAktivaLancarFinal + $totalAktivaTetapFinal) === ($totalPassivaLancarFinal + $totalEkuitasFinal);


            // Main Query
            // $data = DB::table('jurnal')
            //     ->join('kodeakuntansi', function ($join) {
            //         $join->on('kodeakuntansi.kode', '=', 'jurnal.akun_debit')
            //             ->orOn('kodeakuntansi.kode', '=', 'jurnal.akun_kredit');
            //     })
            //     ->whereNotNull('jurnal.jumlah_debit')
            //     ->where('kodeakuntansi.jenis_laporan', 'neraca')
            //     ->where('jurnal.status', 'Selesai')
            //     ->whereBetween('jurnal.tanggal', [$awal, $akhir])
            //     ->orderByDesc('jurnal.kode_transaksi')
            //     ->select(
            //         'jurnal.kode_transaksi',
            //         'jurnal.jumlah_debit',
            //         'jurnal.jumlah_kredit',
            //         'kodeakuntansi.nama_perkiraan',
            //         'kodeakuntansi.jenis',
            //         'jurnal.tanggal',
            //         DB::raw("$totalAktivaTetap as total_aktivatetap"),
            //         DB::raw("$totalAktivaLancar as total_aktivalancar"),
            //         DB::raw("$totalPassivaLancar as total_passivalancar"),
            //         DB::raw("$totalEkuitas as total_ekuitas"),
            //         DB::raw("($totalAktivaTetap + $totalAktivaLancar) as total_aset"),
            //         DB::raw("($totalPassivaLancar + $totalEkuitas) as total_kewajibanekuitas")
            //     )
            //     ->get();

            // Data Jurnal Detail untuk Laporan Neraca
            $data = DB::table('jurnal')
            ->join('kodeakuntansi', function ($join) {
                $join->on('kodeakuntansi.kode', '=', 'jurnal.akun_debit');
            })
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('jurnal.jumlah_kredit'); // Sama dengan total Passiva & Ekuitas
                })->orWhere(function ($q) {
                    $q->whereNotNull('jurnal.jumlah_debit'); // Sama dengan total Aktiva
                });
            })
            ->where('kodeakuntansi.jenis_laporan', 'neraca')
            ->where('jurnal.status', 'Selesai')
            ->whereBetween('jurnal.tanggal', [$awal, $akhir])
            ->select(
                'jurnal.kode_transaksi',
                'jurnal.jumlah_debit',
                'jurnal.jumlah_kredit',
                'kodeakuntansi.nama_perkiraan',
                'kodeakuntansi.jenis',
                'jurnal.tanggal',
                DB::raw("$totalAktivaTetapFinal as total_aktivatetap"),
                DB::raw("$totalAktivaLancarFinal as total_aktivalancar"),
                DB::raw("$totalPassivaLancarFinal as total_passivalancar"),
                DB::raw("$totalEkuitasFinal as total_ekuitas"),
                DB::raw("($totalAktivaTetapFinal + $totalAktivaLancarFinal) as total_aset"),
                DB::raw("($totalPassivaLancarFinal + $totalEkuitasFinal) as total_kewajibanekuitas")
            )
            ->where(function ($query) {
                $query->where('jurnal.jumlah_debit', '>', 0)
                    ->orWhere('jurnal.jumlah_kredit', '>', 0);
            })
            ->orderBy('jurnal.tanggal', 'desc')
            ->get();

            // Format Data
            foreach ($data as $item) {
                $item->jumlah_debit = "Rp. " . number_format($item->jumlah_debit, 0, ',', '.');
                $item->jumlah_kredit = "Rp. " . number_format($item->jumlah_kredit, 0, ',', '.');
                $item->total_aktivatetap = "Rp. " . number_format($item->total_aktivatetap, 0, ',', '.');
                $item->total_aktivalancar = "Rp. " . number_format($item->total_aktivalancar, 0, ',', '.');
                $item->total_passivalancar = "Rp. " . number_format($item->total_passivalancar, 0, ',', '.');
                $item->total_ekuitas = "Rp. " . number_format($item->total_ekuitas, 0, ',', '.');
                $item->total_aset = "Rp. " . number_format($item->total_aset, 0, ',', '.');
                $item->total_kewajibanekuitas = "Rp. " . number_format($item->total_kewajibanekuitas, 0, ',', '.');
                $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
            }

            return response()->json(['success' => true, 'data' => $data, 'isBalanced' => $isBalanced]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    //END KODE BARU NERACA

    //KODE LAMA NERACA

    // public function data_neraca(Request $request)
    // {
    //     try {
    //         $awal = $request->awal;
    //         $akhir = $request->akhir;

    //         $query = "
    //                 WITH total_aktivalancar AS (
    //                 SELECT
    //                     SUM(j.jumlah_debit) AS total_aktivalancar
    //                 FROM
    //                     jurnal j
    //                     JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //                 WHERE
    //                     j.jumlah_debit IS NOT NULL
    //                     AND ka.jenis_laporan = 'neraca'
    //                     AND ka.group_laporan = 'aktiva lancar'
    //                     AND j.created_at BETWEEN '$awal' AND '$akhir'
    //             ),
    //             total_aktivatetap AS (
    //                 SELECT
    //                     SUM(j.jumlah_debit) AS total_aktivatetap
    //                 FROM
    //                     jurnal j
    //                     JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //                 WHERE
    //                     j.jumlah_debit IS NOT NULL
    //                     AND ka.jenis_laporan = 'neraca'
    //                     AND ka.group_laporan = 'aktiva tetap'
    //                     AND j.created_at BETWEEN '$awal' AND '$akhir'
    //             ),
    //             total_passivalancar AS (
    //                 SELECT
    //                     SUM(j.jumlah_debit) AS total_passivalancar
    //                 FROM
    //                     jurnal j
    //                     JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //                 WHERE
    //                     j.jumlah_debit IS NOT NULL
    //                     AND ka.jenis_laporan = 'neraca'
    //                     AND ka.group_laporan = 'passiva lancar'
    //                     AND j.created_at BETWEEN '$awal' AND '$akhir'
    //             ),
    //             total_ekuitas AS (
    //                 SELECT
    //                     SUM(j.jumlah_debit) AS total_ekuitas
    //                 FROM
    //                     jurnal j
    //                     JOIN kodeakuntansi ka ON ka.kode = j.akun_debit OR ka.kode = j.akun_kredit
    //                 WHERE
    //                     j.jumlah_debit IS NOT NULL
    //                     AND ka.jenis_laporan = 'neraca'
    //                     AND (ka.group_laporan = 'modal' OR ka.group_laporan = 'laba yang ditahan')
    //                     AND j.created_at BETWEEN '$awal' AND '$akhir'
    //             )
    //             SELECT
    //                 jurnal.kode_transaksi,
    //                 jurnal.jumlah_debit,
    //                 kodeakuntansi.nama_perkiraan,
    //                 kodeakuntansi.jenis,
    //                 jurnal.created_at,
    //                 total_aktivatetap.total_aktivatetap,
    //                 total_aktivalancar.total_aktivalancar,
    //                 total_passivalancar.total_passivalancar,
    //                 total_ekuitas.total_ekuitas,
    //                 (total_aktivatetap.total_aktivatetap + total_aktivalancar.total_aktivalancar) AS total_aset,
    //                 (total_passivalancar.total_passivalancar + total_ekuitas.total_ekuitas) AS total_kewajibanekuitas
    //             FROM
    //                 jurnal
    //             JOIN kodeakuntansi ON kodeakuntansi.kode = jurnal.akun_debit OR kodeakuntansi.kode = jurnal.akun_kredit
    //             CROSS JOIN total_aktivatetap
    //             CROSS JOIN total_aktivalancar
    //             CROSS JOIN total_passivalancar
    //             CROSS JOIN total_ekuitas
    //             WHERE
    //                 jurnal.jumlah_debit IS NOT NULL
    //                 AND kodeakuntansi.jenis_laporan = 'neraca'
    //                 AND jurnal.created_at BETWEEN '$awal' AND '$akhir'
    //             ORDER BY
    //                 jurnal.kode_transaksi DESC


    //             ";

    //         $data = DB::select($query);

    //         foreach ($data as $item) {
    //             $item->jumlah_debit = "Rp. " . number_format($item->jumlah_debit, 0, ',', '.');
    //             $item->total_aktivatetap = "Rp. " . number_format($item->total_aktivatetap, 0, ',', '.');
    //             $item->total_aktivalancar = "Rp. " . number_format($item->total_aktivalancar, 0, ',', '.');
    //             $item->total_passivalancar = "Rp. " . number_format($item->total_passivalancar, 0, ',', '.');
    //             $item->total_ekuitas = "Rp. " . number_format($item->total_ekuitas, 0, ',', '.');
    //             $item->total_aset = "Rp. " . number_format($item->total_aset, 0, ',', '.');
    //             $item->total_kewajibanekuitas = "Rp. " . number_format($item->total_kewajibanekuitas, 0, ',', '.');
    //             $item->created_at = date('d-m-Y', strtotime($item->created_at));
    //         }

    //         return response()->json(['success' => true, 'data' => $data]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
    //     }
    // }

    //END KODE LAMA NERACA


    public function laporan_penjualan(Request $request)
    {
        // $awal = substr($tanggal,0,10);
        // $akhir = substr($tanggal,11);

        try {
            $n = 0;
            $data = salesorder::select('salesorder.*', 'rekanan.nama AS rekanan', 'karyawan.nama AS karyawan', 'invoice.kode AS invoice')
                ->join('invoice', 'invoice.kode_so', '=', 'salesorder.kode')
                ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
                ->where('salesorder.status', 'Selesai')
                ->whereBetween('salesorder.created_at', [$request->awal, $request->akhir])->get();
            if (!$data) {
            } else {
                foreach ($data as $D) {
                    $kode = $D->invoice;
                    $totalSO = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                        ->where('kode_transaksi', 'LIKE', "$kode%D")
                        ->first();
                    $D->jumlahSO = $totalSO->jumlah;
                    $D->penjualan = "Rp." . number_format($totalSO->jumlah, 2, ',', '.');
                    $D->action = "
                    <button type='button' class='btn btn-info detail' data-toggle='modal' data-kode='$D->kode' data-target='#modal-detail'>Detail</button>
                ";
                }
            }




            // foreach($data AS $D){
            //     $n++;
            //     $D->no = $n;
            //     $D->transaksi = $D->kode;
            //     $totalSO = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
            //                 ->where('kode_transaksi','LIKE',$D->kode."%")
            //                 ->first();
            //     $totalSO = $totalSO->jumlah;
            //     $D->penjualan = "Rp.".number_format($totalSO,2,',','.');
            //     //INVOICE
            //     $debit = 0;
            //         $inv = invoice::where('kode_so',$D->kode)
            //                 ->where('status','Selesai')->get();
            //         foreach($inv AS $I){
            //             $detail = jurnal::select('jumlah_debit')
            //                         ->where('kode_transaksi','LIKE',$I->kode."%")->first();
            //             $debit = $debit+$detail->jumlah_debit;
            //         }
            //         if($debit == $totalSO){
            //             $D->status = 'Lunas';

            //         } else {
            //             $D->status = 'Belum Lunas';
            //         }
            //     //INVOICE


            // }

            // $data = salesorder::select('salesorder.*','rekanan.nama as nama_konsumen','karyawan.nama as nama_marketing')
            //         ->join('rekanan','salesorder.konsumen','rekanan.kode')
            //         ->join('karyawan','salesorder.marketing','karyawan.kode')
            //         ->whereBetween('salesorder.created_at',[$awal,$akhir])
            //         ->get();
            // return DataTables::of($data)
            // ->addIndexColumn()
            // ->addColumn('total',function($data){
            //     $detail = detail_so::select(DB::raw('SUM(total) as total'))
            //             ->where('kode_so',$data->kode)->first();
            //     $hasil = "Rp " . number_format($detail->total,2,',','.');
            //     return $hasil;
            // })
            // ->addColumn('action', function($data){
            //     return "
            //         <button type='button' class='btn btn-default'>Action</button>
            //         <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
            //             <span class='sr-only'>Toggle Dropdown</span>
            //         </button>
            //         <div class='dropdown-menu' role='menu'>
            //             <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
            //         </div>
            //         ";
            // })->make(true);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function detail_penjualan($kode)
    {
        try {
            $data = salesorder::select('salesorder.*', 'rekanan.nama AS rekanan', 'karyawan.nama AS karyawan')
                ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
                ->where('salesorder.kode', $kode)->first();
            if (!$data) {
                return response()->json(['success' => false, 'pesan' => "Data Tidak Ditemukan"]);
            } else {
                $detail = detail_so::select('detail_so.*', 'barang.nama as barang', 'barang.satuan as satuan')
                    ->join('barang', 'detail_so.kode_brg', '=', 'barang.kode')
                    ->where('detail_so.kode_so', $kode)
                    ->get();
                $totalSO = 0;
                foreach ($detail as $dtl) {
                    $dtl->PPn = ($dtl->dpp * $dtl->vat) / 100;
                    $totalSO = $totalSO + $dtl->total;
                }
                $data->detail = $detail;
                $inv = invoice::select('invoice.*', 'bank.bank AS bank', 'bank.rekening as rekening')
                    ->join('bank', 'invoice.kode_bank', '=', 'bank.kode')
                    ->where('invoice.kode_so', $kode)->get();
                $totalINV = 0;
                foreach ($inv as $IN) {
                    $kode = $IN->kode;
                    $kodekas = detail_kas::select('kode_kas')->where('kode_transaksi', $kode)->first();
                    $kas = detail_kas::select(DB::raw('SUM(total) AS jumlah'))
                        ->where('kode_transaksi', $kode)->first();
                    $Dinv = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                        ->where('kode_transaksi', 'LIKE', "$kode%D")->first();
                    $IN->kode_kas = $kodekas->kode_kas;
                    $IN->total = $kas->jumlah;
                    $totalINV = $totalINV + $kas->jumlah;
                    if ($kas->jumlah == $Dinv->jumlah) {
                        $IN->status = "<strong style='color:green;'>LUNAS</strong>";
                    } else if (!$kas->jumlah) {
                        $IN->status = "<strong style='color:red;'>Belum Di Input ke Kas</strong>";
                    }
                }
                return response()->json(['success' => true, 'data' => $data, 'inv' => $inv]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function exportpenjualan(Request $request)
    {
        try {
            $awal = $request->awal;
            $akhir = $request->akhir;

            $query = "
                SELECT
                    salesorder.kode,
                    invoice.kode AS kode_invoice,
                    rekanan.nama AS nama_rekanan,
                    salesorder.tanggal,
                    detail_invoice.tgl_kirim,
                    karyawan.nama AS nama_marketing,
                    barang.nama AS nama_barang,
                    detail_invoice.harga_jual,
                    detail_invoice.diakui,
                    detail_invoice.dpp,
                    detail_so.vat,
                    detail_invoice.jumlah,
                    salesorder.pembayaran,
                    bank.bank AS nama_bank,
                    bank.atas_nama,
                    invoice.DP,
                    salesorder.no_po AS nomor_po,
                    salesorder.term_payment,
                    salesorder.vat AS vat_so,
                    salesorder.keterangan,
                    salesorder.status AS status_so,
                    invoice.status AS status_pembayaran,
                    invoice.updated_at AS tgl_bayar,
                    CASE
                        WHEN invoice.status IN ('Belum Diperiksa', 'Sudah Diperiksa') THEN 'Belum Bayar'
                        WHEN invoice.status = 'Selesai' THEN 'Lunas'
                        ELSE 'Status Tidak Diketahui'
                    END AS status_pembayaran_keterangan,
                    detail_so.hpp,
                    barang.jenis,
                    barang.packing,
                    barang.perusahaan,
                    barang.keterangan AS keterangan_barang,
                    rekanan.nama_perusahaan AS perusahaan_kustomer,
                    ROUND(detail_so.vat / 100 * detail_invoice.dpp, 3) AS hasil_ppn
                FROM
                    salesorder
                    JOIN detail_so ON salesorder.kode = detail_so.kode_so
                    JOIN barang ON detail_so.kode_brg = barang.kode
                    JOIN rekanan ON salesorder.konsumen = rekanan.kode
                    JOIN karyawan ON salesorder.marketing = karyawan.kode
                    JOIN invoice ON salesorder.kode = invoice.kode_so
                    JOIN bank ON invoice.kode_bank = bank.kode
                    JOIN detail_invoice ON invoice.kode = detail_invoice.kode_inv
                WHERE
                    salesorder.tanggal BETWEEN ? AND ?
                ORDER BY
                    salesorder.tanggal DESC
            ";

            $data = DB::select($query, [$awal, $akhir]);

            foreach ($data as $item) {
                $item->harga_jual = "Rp. " . number_format($item->harga_jual, 0, ',', '.');
                $item->dpp = "Rp. " . number_format($item->dpp, 0, ',', '.');
                $item->jumlah = "Rp. " . number_format($item->jumlah, 0, ',', '.');
                $item->hasil_ppn = "Rp. " . number_format($item->hasil_ppn, 0, ',', '.');
                $item->tgl_bayar = date('d-m-Y', strtotime($item->tgl_bayar));
                $item->tgl_kirim = date('d-m-Y', strtotime($item->tgl_kirim));
                $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
            }

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function lpj_penjualan_marketing(Request $request)
    {
        try {
            $awal = $request->awal;
            $akhir = $request->akhir;
            $marketing = $request->marketing;

            if ($marketing == "ALL") {
                $query = "
                SELECT
                    salesorder.kode,
                    invoice.kode AS kode_invoice,
                    rekanan.nama AS nama_rekanan,
                    salesorder.tanggal,
                    detail_invoice.tgl_kirim,
                    karyawan.kode AS kode_marketing,
                    karyawan.nama AS nama_marketing,
                    barang.nama AS nama_barang,
                    detail_invoice.harga_jual,
                    detail_invoice.diakui,
                    detail_invoice.dpp,
                    detail_so.vat,
                    detail_invoice.jumlah,
                    salesorder.pembayaran,
                    bank.bank AS nama_bank,
                    bank.atas_nama,
                    invoice.DP,
                    salesorder.no_po AS nomor_po,
                    salesorder.term_payment,
                    salesorder.vat AS vat_so,
                    salesorder.keterangan,
                    salesorder.status AS status_so,
                    invoice.status AS status_pembayaran,
                    invoice.updated_at AS tgl_bayar,
                    CASE
                        WHEN invoice.status IN ('Belum Diperiksa', 'Sudah Diperiksa') THEN 'Belum Bayar'
                        WHEN invoice.status = 'Selesai' THEN 'Lunas'
                        ELSE 'Status Tidak Diketahui'
                    END AS status_pembayaran_keterangan,
                    detail_so.hpp,
                    barang.jenis,
                    barang.packing,
                    barang.perusahaan,
                    barang.keterangan AS keterangan_barang,
                    rekanan.nama_perusahaan AS perusahaan_kustomer,
                    ROUND(detail_so.vat / 100 * detail_invoice.dpp, 3) AS hasil_ppn
                FROM
                    salesorder
                    JOIN detail_so ON salesorder.kode = detail_so.kode_so
                    JOIN barang ON detail_so.kode_brg = barang.kode
                    JOIN rekanan ON salesorder.konsumen = rekanan.kode
                    JOIN karyawan ON salesorder.marketing = karyawan.kode
                    JOIN invoice ON salesorder.kode = invoice.kode_so
                    JOIN bank ON invoice.kode_bank = bank.kode
                    JOIN detail_invoice ON invoice.kode = detail_invoice.kode_inv
                WHERE
                    salesorder.tanggal BETWEEN ? AND ?
                ORDER BY
                    salesorder.tanggal DESC
            ";
                $data = DB::select($query, [$awal, $akhir]);
            } else {
                $query = "
                SELECT
                    salesorder.kode,
                    invoice.kode AS kode_invoice,
                    rekanan.nama AS nama_rekanan,
                    salesorder.tanggal,
                    detail_invoice.tgl_kirim,
                    karyawan.kode AS kode_marketing,
                    karyawan.nama AS nama_marketing,
                    barang.nama AS nama_barang,
                    detail_invoice.harga_jual,
                    detail_invoice.diakui,
                    detail_invoice.dpp,
                    detail_so.vat,
                    detail_invoice.jumlah,
                    salesorder.pembayaran,
                    bank.bank AS nama_bank,
                    bank.atas_nama,
                    invoice.DP,
                    salesorder.no_po AS nomor_po,
                    salesorder.term_payment,
                    salesorder.vat AS vat_so,
                    salesorder.keterangan,
                    salesorder.status AS status_so,
                    invoice.status AS status_pembayaran,
                    invoice.updated_at AS tgl_bayar,
                    CASE
                        WHEN invoice.status IN ('Belum Diperiksa', 'Sudah Diperiksa') THEN 'Belum Bayar'
                        WHEN invoice.status = 'Selesai' THEN 'Lunas'
                        ELSE 'Status Tidak Diketahui'
                    END AS status_pembayaran_keterangan,
                    detail_so.hpp,
                    barang.jenis,
                    barang.packing,
                    barang.perusahaan,
                    barang.keterangan AS keterangan_barang,
                    rekanan.nama_perusahaan AS perusahaan_kustomer,
                    ROUND(detail_so.vat / 100 * detail_invoice.dpp, 3) AS hasil_ppn
                FROM
                    salesorder
                    JOIN detail_so ON salesorder.kode = detail_so.kode_so
                    JOIN barang ON detail_so.kode_brg = barang.kode
                    JOIN rekanan ON salesorder.konsumen = rekanan.kode
                    JOIN karyawan ON salesorder.marketing = karyawan.kode
                    JOIN invoice ON salesorder.kode = invoice.kode_so
                    JOIN bank ON invoice.kode_bank = bank.kode
                    JOIN detail_invoice ON invoice.kode = detail_invoice.kode_inv
                WHERE
                    salesorder.tanggal BETWEEN ? AND ?
                    AND karyawan.kode = ?
                ORDER BY
                    salesorder.tanggal DESC
            ";
                $data = DB::select($query, [$awal, $akhir, $marketing]);
            }

            foreach ($data as $item) {
                $item->harga_jual = "Rp. " . number_format($item->harga_jual, 0, ',', '.');
                $item->dpp = "Rp. " . number_format($item->dpp, 0, ',', '.');
                $item->jumlah = "Rp. " . number_format($item->jumlah, 0, ',', '.');
                $item->hasil_ppn = "Rp. " . number_format($item->hasil_ppn, 0, ',', '.');
                $item->tgl_bayar = date('d-m-Y', strtotime($item->tgl_bayar));
                $item->tgl_kirim = date('d-m-Y', strtotime($item->tgl_kirim));
                $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
            }

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    public function exportpembelian(Request $request)
    {
        try {
            $awal = $request->awal;
            $akhir = $request->akhir;

            $query = "
                SELECT DISTINCT
                purchaseorder.tanggal,
                purchaseorder.kode,
                rekanan.nama AS nama_supplier,
                purchaseorder.pembayaran,
                purchaseorder.spk,
                purchaseorder.time_delivery,
                purchaseorder.term_payment,
                purchaseorder.vat,
                purchaseorder.`status`,
                CASE
                    WHEN purchaseorder.`status` IN ('Belum Diperiksa', 'Sudah Diperiksa') THEN 'Belum Bayar'
                    WHEN purchaseorder.`status` = 'Selesai' THEN 'Lunas'
                    ELSE 'Status Tidak Diketahui'
                END AS status_keterangan,
                purchaseorder.keterangan,
                purchaseorder.updated_at AS tgl_bayar,
                materialreceive.kode AS kode_mr,
                materialreceive.keterangan AS keterangan_mr,
                materialreceive.tanggal AS tanggal_mr,
                barang.nama AS nama_barang,
                gudang.nama AS nama_gudang,
                detail_mr.harga AS harga_satuan,
                detail_mr.diakui AS qty,
                detail_mr.ongkir,
                detail_mr.dpp,
                detail_mr.total,
                ROUND(purchaseorder.vat / 100 * detail_mr.dpp, 3) AS hasil_ppn
            FROM
                purchaseorder
            JOIN detail_po ON purchaseorder.kode = detail_po.kode_po
            JOIN materialreceive ON purchaseorder.kode = materialreceive.transaksi
            JOIN detail_mr ON materialreceive.kode = detail_mr.kode_mr
            JOIN barang ON detail_mr.kode_brg = barang.kode
            JOIN gudang ON detail_mr.kode_gdg = gudang.kode
            JOIN rekanan ON purchaseorder.supplier = rekanan.kode
            WHERE
                purchaseorder.tanggal BETWEEN ? AND ?;
            ";

            $data = DB::select($query, [$awal, $akhir]);

            foreach ($data as $item) {
                $item->harga_satuan = "Rp. " . number_format($item->harga_satuan, 0, ',', '.');
                $item->dpp = "Rp. " . number_format($item->dpp, 0, ',', '.');
                $item->total = "Rp. " . number_format($item->total, 0, ',', '.');
                $item->hasil_ppn = "Rp. " . number_format($item->hasil_ppn, 0, ',', '.');
                $item->ongkir = "Rp. " . number_format($item->ongkir, 0, ',', '.');
                $item->tanggal_mr = date('d-m-Y', strtotime($item->tanggal_mr));
                $item->tgl_bayar = date('d-m-Y', strtotime($item->tgl_bayar));
                $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
            }

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    public function dropdownbarangpo(Request $request, $po)
    {
        try {
            $barang = [];
            if ($request->has('q')) {
                $search = $request->q;
                $barang = jurnal::select('kode_brg', 'nama_brg')
                    ->where('kode_transaksi', 'LIKE', '$po%')
                    ->where('nama_brg', 'LIKE', "%$search")
                    ->get();
            } else {
                $barang = jurnal::select('kode_brg', 'nama_brg')
                    ->where('kode_transaksi', 'LIKE', "$po%")
                    ->get();
            }
            return response()->json($barang);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function hpp_barang(Request $request, $barang)
    {
        try {
            $hpp  = hpp::where('barang', $barang)
                ->where('created_at', '<', $request->tanggal)
                ->orderBy('created_at', 'desc')->first();

            $data = jurnal::select(DB::raw('SUM(jumlah_debit) as JUMLAH'), DB::raw('SUM(qty_debit) as QTY'), DB::raw('SUM(ongkir) as ONGKIR'))
                ->where('kode_transaksi', 'LIKE', "MR%D")
                ->where('kode_brg', $barang)
                ->where('status', 'Selesai')->first();
            if ($data->JUMLAH == null || $data->QTY == null) {
                if (!$hpp) {
                    $HPP = 0;
                } else {
                    $HPP = $hpp->hpp;
                }
            } else {
                if (!$hpp) {
                    $HPP = ($data->JUMLAH + $data->ONGKIR) / $data->QTY;
                } else {
                    $A = ($data->JUMLAH + $data->ONGKIR) / $data->QTY;
                    $HPP = ($hpp->hpp + $A) / 2;
                }
            }

            return response()->json(['success' => true, 'data' => $HPP]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function filter_jurnal(Request $request)
    {
        $data = jurnal::select('jurnal.*', 'kodeakuntansi.nama_perkiraan AS perkiraan')
            ->join('kodeakuntansi', 'jurnal.akun_debit', '=', 'kodeakuntansi.kode')
            ->whereBetween('jurnal.tanggal', [$request->awal, $request->akhir])
            ->orderBy('jurnal.tanggal', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('perkiraanD', function ($data) {
                if (Str::endsWith($data->kode_transaksi, 'D')) {
                    return $data->perkiraan;
                } else {
                }
            })
            ->addColumn('perkiraanK', function ($data) {
                if (Str::endsWith($data->kode_transaksi, 'K')) {
                    return $data->perkiraan;
                } else {
                }
            })
            ->editColumn('jumlah_debit', function ($data) {
                if ($data->jumlah_debit == null) {
                    return "-";
                } else {
                    return number_format($data->jumlah_debit, 2, ",", ".");
                }
            })
            ->editColumn('jumlah_kredit', function ($data) {
                if ($data->jumlah_kredit == null) {
                    return "-";
                } else {
                    return number_format($data->jumlah_kredit, 2, ",", ".");
                }
            })->make(true);
    }

    public function index()
    {
        $data = jurnal::select('jurnal.*', 'kodeakuntansi.nama_perkiraan AS perkiraan')
            ->join('kodeakuntansi', 'jurnal.akun_debit', '=', 'kodeakuntansi.kode')
            ->orderBy('jurnal.tanggal', 'desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('perkiraanD', function ($data) {
                if (Str::endsWith($data->kode_transaksi, 'D')) {
                    return $data->perkiraan;
                } else {
                }
            })
            ->addColumn('perkiraanK', function ($data) {
                if (Str::endsWith($data->kode_transaksi, 'K')) {
                    return $data->perkiraan;
                } else {
                }
            })
            ->editColumn('jumlah_debit', function ($data) {
                if ($data->jumlah_debit == null) {
                    return "-";
                } else {
                    return number_format($data->jumlah_debit, 2, ",", ".");
                }
            })
            ->editColumn('jumlah_kredit', function ($data) {
                if ($data->jumlah_kredit == null) {
                    return "-";
                } else {
                    return number_format($data->jumlah_kredit, 2, ",", ".");
                }
            })->make(true);
    }

    public function filterjurnal(Request $request)
    {
        try {
            $data = jurnal::select('jurnal.*', 'kodeakuntansi.nama_perkiraan AS perkiraan')
                ->join('kodeakuntansi', 'jurnal.akun_debit', '=', 'kodeakuntansi.kode')
                ->whereBetween('updated_at', [$request->awal, $request->akhir])
                ->orderBy('jurnal.tanggal', 'desc')->get();
            $file = Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('perkiraanD', function ($data) {
                    if (Str::endsWith($data->kode_transaksi, 'D')) {
                        return $data->perkiraan;
                    } else {
                    }
                })
                ->addColumn('perkiraanK', function ($data) {
                    if (Str::endsWith($data->kode_transaksi, 'K')) {
                        return $data->perkiraan;
                    } else {
                    }
                })
                ->editColumn('jumlah_debit', function ($data) {
                    if ($data->jumlah_debit == null) {
                        return "-";
                    } else {
                        return number_format($data->jumlah_debit, 2, ",", ".");
                    }
                })
                ->editColumn('jumlah_kredit', function ($data) {
                    if ($data->jumlah_kredit == null) {
                        return "-";
                    } else {
                        return number_format($data->jumlah_kredit, 2, ",", ".");
                    }
                })->make(true);
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
    public function edit(Request $request, $id)
    {
        //
        try {
            $data = jurnal::where('kode_transaksi', 'LIKE', "$request->transaksi%")
                ->where('kode_brg', $id)->first();
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode', $data->akun_debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode', $data->akun_kredit)->first();
            $data['nama_debit'] = $debit->nama_perkiraan;
            $data['nama_kredit'] = $kredit->nama_perkiraan;
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function test(Request $request)
    {
        $data = $request;
        return "MAsuk";
    }
    public function rekap_jurnal(Request $request)
    {
        try {
            $data = jurnal::where('kode_transaksi', 'LIKE', "$request->transaksi%")
                ->whereBetween('created_at', [$request->awal, $request->akhir])->orderBy('created_at')->get();
            foreach ($data as $D) {
                $debit = kode_akuntansi::where('kode', $D->akun_debit)->first();
                $D->transaksi = $D->akun_debit . " - " . $debit->nama_perkiraan;
                $D->debit = number_format($D->jumlah_debit, 2, ',', '.');
                $D->kredit = number_format($D->jumlah_kredit, 2, ',', '.');
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function total_so(Request $request)
    {
        try {
            if ($request->marketing == null) {
                $data = salesorder::select(DB::raw("COUNT(kode) AS SO"))
                    ->where('status', $request->status)->first();
                // $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SO"))
                //     ->where('kode_transaksi','LIKE',"SO%D")
                //     ->where('status',$request->status)
                //     ->distinct()->first();
            } else {
                $data = salesorder::select(DB::raw("COUNT(kode) AS SO"))
                    ->where('marketing', $request->marketing)
                    ->where('status', $request->status)->first();
                // $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SO"))
                //     ->where('kode_transaksi','LIKE',"SO%D")
                //     ->where('status',$request->status)
                //     ->where('kode_marketing',$request->marketing)
                //     ->distinct()->first();
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getmessage()]);
        }
    }

    public function total_po(Request $request)
    {
        try {
            //PO Belum diperiksa
            $po = purchaseorder::select(DB::raw("COUNT(kode) AS PO"))->where('status', 'Belum Diperiksa')->first();
            //Dalam Perjalanan
            $kas = detail_kas::select("detail_kas.kode_transaksi")->join('kas', 'detail_kas.kode_kas', 'kas.kode')->where('detail_kas.kode_transaksi', 'LIKE', "PO%")->where('status', 'Selesai')->get();
            $SS = array();
            foreach ($kas as $K) {
                //jumlah pesanan
                $qty = detail_po::select('detail_po.kode_brg', 'detail_po.qty')->join('purchaseorder', 'purchaseorder.kode', 'detail_po.kode_po')->where('detail_po.kode_po', $K->kode_transaksi)->get();
                foreach ($qty as $q) {
                    $mr = detail_mr::select(DB::raw("SUM(detail_mr.dikirim) AS dikirim"))
                        ->join('materialreceive', 'materialreceive.kode', 'detail_mr.kode_mr')
                        ->where('materialreceive.transaksi', $K->kode_transaksi)
                        ->where('detail_mr.kode_brg', $q->kode_brg)->first();
                    if ($mr->dikirim == $q->qty) {
                    } else {
                        $SS[] = $K->kode_transaksi;
                    }
                }
            }
            $SS = array_unique($SS);
            $data = array();
            foreach ($SS as $A) {
                $data[] = $A;
            }
            $QW = array();
            $no = 0;
            foreach ($data as $S) {
                $tot = 0;
                $total = detail_po::select(DB::raw("detail_po.harga*detail_po.qty AS total"))->join('purchaseorder', 'purchaseorder.kode', 'detail_po.kode_po')->where('detail_po.kode_po', $S)->get();
                foreach ($total as $ttl) {
                    $tot = $tot + $ttl->total;
                }
                $rekanan = purchaseorder::select('rekanan.nama')->join('rekanan', 'rekanan.kode', 'purchaseorder.supplier')->where('purchaseorder.kode', $S)->first();
                $no++;
                $QW[] = [
                    'no' => $no,
                    'po' => $S,
                    'supplier' => $rekanan->nama,
                    'nilai' => "Rp. " . number_format($tot, 2, ',', '.'),
                ];
                // $sum = array_sum($total->total);
                // $QW[]=[
                //     'po'=>$S,
                //     'sum'=>$sum,
                //     ];
            }
            $T = count($SS);
            //Belum Lunas
            $LL = purchaseorder::select('purchaseorder.kode', 'rekanan.nama')->join('rekanan', 'purchaseorder.supplier', 'rekanan.kode')->where('purchaseorder.status', 'Sudah Diperiksa')->get();
            $p = 0;
            $p1 = array();
            foreach ($LL as $l) {
                $dtl = detail_po::select(DB::raw("harga*qty AS total"))->where('kode_po', $l->kode)->get();
                $detail = 0;
                foreach ($dtl as $d) {
                    $detail = $detail + $d->total;
                }

                $kas = detail_kas::select(DB::raw("Sum(harga) AS total"))->where('kode_transaksi', $l->kode)->first();

                if ($kas->total == $detail) {
                } else {
                    $p++;
                    $p1[] = [
                        'no' => $p,
                        'po' => $l->kode,
                        'rekanan' => $l->nama,
                        'kekurangan' => "Rp. " . number_format($detail - $kas->total, 2, ',', '.'),
                    ];
                }
            }
            // $sum = 0;
            // foreach($mr AS $m){
            //     $a = purchaseorder::select('status')->where('kode',$m->transaksi)->first();
            //     if($a->status == "Selesai"){
            //         $sum++;
            //     } else {

            //     }
            // }
            return response()->json(['success' => true, 'po' => $po->PO, 'mr' => $T, 'dtlmr' => $QW, 'pol' => $p, 'dtlpol' => $p1]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function total_sj(Request $request)
    {
        try {
            if ($request->marketing == null) {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SJ"))
                    ->where('kode_transaksi', 'LIKE', "SJ%D")
                    ->where('status', $request->status)
                    ->distinct()->first();
            } else {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SJ"))
                    ->where('kode_transaksi', 'LIKE', "SJ%D")
                    ->where('status', $request->status)
                    ->where('kode_marketing', $request->marketing)
                    ->distinct()->first();
            }

            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getmessage()]);
        }
    }

    public function total_invoice(Request $request)
    {
        try {
            if ($request->marketing == null) {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS INV"))
                    ->where('kode_transaksi', 'LIKE', "INV%D")
                    ->where('status', $request->status)
                    ->distinct()->first();
            } else {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS INV"))
                    ->where('kode_transaksi', 'LIKE', "INV%D")
                    ->where('status', $request->status)
                    ->where('kode_marketing', $request->marketing)
                    ->distinct()->first();
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getmessage()]);
        }
    }

    public function stockbarang(Request $request, $gudang)
    {
        try {
            $barang = barang::where('kode', $request->barang)->first();
            $akutansi = kode_akuntansi::where('kode', $barang->kd_persediaan)->first();
            if ($gudang == "all") {
                $stock = jurnal::select(DB::raw("SUM(qty_debit) AS SM"))->where('kode_brg', $request->barang)->where('akun_debit', $barang->kd_persediaan)->where('status', "Selesai")->first();
                if ($stock) {
                    $out = jurnal::select(DB::raw("SUM(qty_debit) AS SK"))->where('kode_brg', $request->barang)->where('akun_kredit', $barang->kd_persediaan)->where('status', "Selesai")->first();
                    if ($out) {
                        $stok = $stock->SM - $out->SK;
                        return response()->json(['success' => true, 'data' => $stok, 'kode' => $barang->kd_persediaan, 'nama' => $akutansi->nama_perkiraan]);
                    } else {
                        return response()->json(['success' => false, 'pesan' => "Error STOCK  KELUAR"]);
                    }
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error STOK MASUK"]);
                }
            } else {
                $stock = jurnal::select(DB::raw("SUM(qty_debit) AS SM"))->where('kode_gdg', $gudang)->where('kode_brg', $request->barang)->where('akun_debit', $barang->kd_persediaan)->where('status', "Selesai")->first();
                if ($stock) {
                    $out = jurnal::select(DB::raw("SUM(qty_debit) AS SK"))->where('kode_gdg', $gudang)->where('kode_brg', $request->barang)->where('akun_kredit', $barang->kd_persediaan)->where('status', "Selesai")->first();
                    if ($out) {
                        $stok = $stock->SM - $out->SK;
                        return response()->json(['success' => true, 'data' => $stok, 'kode' => $barang->kd_persediaan, 'nama' => $akutansi->nama_perkiraan]);
                    } else {
                        return response()->json(['success' => false, 'pesan' => "Error STOCK  KELUAR"]);
                    }
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error STOK MASUK"]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function gudangbarang(Request $request, $kode)
    {

        if ($request->has('q')) {
            $search = $request->q;
            $data = jurnal::select('kode_gdg', 'nama_gdg')
                ->where('kode_brg', $kode)
                ->where('nama_gdg', 'LIKE', "%$search%")
                ->distinct()->get();
        } else {
            $data = jurnal::select('kode_gdg', 'nama_gdg')
                ->where('kode_brg', $kode)
                ->distinct()->get();
        }
        return response()->json($data);
    }

    public function stock_gudang(Request $request)
    {
        try {
            $data = barang::all();
            // belum selesai
            foreach ($data as $A) {
                if ($request->gudang == "ALL") {
                    $gudang = gudang::select('nama')->first();
                    $A['gudang'] = $gudang->nama;
                    //Awal
                    $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                        ->where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('created_at', '<', $request->awal)->first();
                    $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                        ->where('kode_transaksi', 'LIKE', "SJ%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('created_at', '<', $request->awal)->first();
                    if ($saldoA == null) {
                        $saldoA = 0;
                    } else {
                        $saldoA = $saldoA->SA;
                    }
                    if ($saldoB == null) {
                        $saldoB = 0;
                    } else {
                        $saldoB = $saldoB->SA;
                    }
                    $saldo_awal = $saldoA - $saldoB;
                    $A['awal_qty'] = $saldo_awal;
                    //NILAI AWAL
                    $nilaiA = jurnal::where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('created_at', '<', $request->awal)->get();
                    $nilaiawal = 0;
                    foreach ($nilaiA as $nilai) {
                        $nilaiawal = $nilaiawal + $nilai->jumlah_debit;
                    }

                    $nilaiB = jurnal::where('kode_transaksi', 'LIKE', "INV%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('created_at', '<', $request->awal)->get();
                    $nilaiakhir = 0;
                    foreach ($nilaiB as $nilai) {
                        $nilaiakhir = $nilaiakhir + $nilai->jumlah_debit;
                    }
                    $A['awal_nilai'] = "Rp." . number_format($nilaiawal - $nilaiakhir, 2, ',', '.');
                    $Nawal = $nilaiawal - $nilaiakhir;
                    //Awal
                    //Masuk & Keluar
                    $dataA = jurnal::select(DB::raw("SUM(qty_debit) as SA"), DB::raw("SUM(jumlah_debit) as JUMLAH"))
                        ->where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('created_at', [$request->awal, $request->akhir])->first();
                    $dataB = jurnal::select(DB::raw("SUM(qty_debit) as SA"), DB::raw("SUM(jumlah_debit) as JUMLAH"))
                        ->where('kode_transaksi', 'LIKE', "SJ%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('created_at', [$request->awal, $request->akhir])->first();
                    $dataC = jurnal::select(DB::raw("SUM(jumlah_debit) as JUMLAH"))
                        ->where('kode_transaksi', 'LIKE', "INV%")
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('created_at', [$request->awal, $request->akhir])->first();
                    if ($dataA == null) {
                        $A['masuk_qty'] = $data->SA + 0;
                        $A['masuk_nilai'] = "Rp." . number_format($dataA->JUMLAH + 0, 2, ',', '.');
                        $Nmasuk = $dataA->JUMLAH + 0;
                    } else {
                        $A['masuk_qty'] = $dataA->SA + 0;
                        $A['masuk_nilai'] = "Rp." . number_format($dataA->JUMLAH + 0, 2, ',', '.');
                        $Nmasuk = $dataA->JUMLAH + 0;
                    }
                    if ($dataB == null) {
                        $A['keluar_qty'] = 0;
                        $A['keluar_nilai'] = "Rp." . number_format($dataB->JUMLAH + 0, 2, ',', '.');
                        $Nkeluar = $dataA->JUMLAH + 0;
                    } else {
                        $A['keluar_qty'] = $dataB->SA + 0;
                        $A['keluar_nilai'] = "Rp." . number_format($dataB->JUMLAH + 0, 2, ',', '.');
                        $Nkeluar = $dataA->JUMLAH + 0;
                    }
                    if ($dataC == null) {
                    } else {
                    }
                    //Masuk & Keluar
                    //Akhir
                    $A['akhir_qty'] = $A['awal_qty'] + $A['masuk_qty'] - $A['keluar_qty'];
                    $A['akhir_nilai'] = "Rp." . number_format($Nawal + $Nmasuk - $Nkeluar, 2, ',', '.');
                    //Akhir
                } else {
                    $gudang = gudang::select('nama')
                        ->where('kode', $request->gudang)->first();
                    $A['gudang'] = $gudang->nama;
                    //Awal
                    $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                        ->where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('tanggal', '<', $request->awal)->first(); //Ubah Tanggal Created_At
                    $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                        ->where('kode_transaksi', 'LIKE', "SJ%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('tanggal', '<', $request->awal)->first();
                    if ($saldoA == null) {
                        $saldoA = 0;
                    } else {
                        $saldoA = $saldoA->SA;
                    }
                    if ($saldoB == null) {
                        $saldoB = 0;
                    } else {
                        $saldoB = $saldoB->SA;
                    }
                    $saldo_awal = $saldoA - $saldoB;
                    $A['awal_qty'] = $saldo_awal;
                    //NILAI AWAL
                    $nilaiA = jurnal::where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('tanggal', '<', $request->awal)->get();
                    $nilaiawal = 0;
                    foreach ($nilaiA as $nilai) {
                        $nilaiawal = $nilaiawal + $nilai->jumlah_debit;
                    }

                    $nilaiB = jurnal::where('kode_transaksi', 'LIKE', "INV%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->where('tanggal', '<', $request->awal)->get();
                    $nilaiakhir = 0;
                    foreach ($nilaiB as $nilai) {
                        $nilaiakhir = $nilaiakhir + $nilai->jumlah_debit;
                    }
                    $A['awal_nilai'] = "Rp." . number_format($nilaiawal - $nilaiakhir, 2, ',', '.');
                    $Nawal = $nilaiawal - $nilaiakhir;
                    //Awal
                    //Masuk & Keluar
                    $dataA = jurnal::select(DB::raw("SUM(qty_debit) as SA"), DB::raw("SUM(jumlah_debit) as JUMLAH"))
                        ->where('kode_transaksi', 'LIKE', "MR%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('tanggal', [$request->awal, $request->akhir])->first();
                    $dataB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                        ->where('kode_transaksi', 'LIKE', "SJ%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('tanggal', [$request->awal, $request->akhir])->first();
                    $dataC = jurnal::select(DB::raw("SUM(jumlah_debit) as JUMLAH"))
                        ->where('kode_transaksi', 'LIKE', "INV%")
                        ->where('kode_gdg', $request->gudang)
                        ->where('kode_brg', $A->kode)
                        ->where('status', 'Selesai')
                        ->whereBetween('tanggal', [$request->awal, $request->akhir])->first();
                    if ($dataA == null) {
                        $A['masuk_qty'] = $data->SA + 0;
                        $Nmasuk = $dataA->JUMLAH + 0;
                        $A['masuk_nilai'] = $dataA->JUMLAH + 0;
                    } else {
                        $A['masuk_qty'] = $dataA->SA + 0;
                        $Nmasuk = $dataA->JUMLAH + 0;
                        $A['masuk_nilai'] = "Rp." . number_format($dataA->JUMLAH + 0, 2, ',', '.');
                    }
                    if ($dataB == null) {
                        $A['keluar_qty'] = 0;
                    } else {
                        $A['keluar_qty'] = $dataB->SA + 0;
                    }
                    if ($dataC == null) {
                        $A['keluar_nilai'] = 0;
                        $Nkeluar = 0;
                    } else {
                        $Nkeluar = $dataC->JUMLAH;
                        $A['keluar_nilai'] = "Rp." . number_format(($dataC->JUMLAH + 0), 2, ',', '.');
                    }
                    //Masuk & Keluar
                    //Akhir
                    $A['akhir_qty'] = $A['awal_qty'] + $A['masuk_qty'] - $A['keluar_qty'];
                    $A['akhir_nilai'] = "Rp." . number_format($Nawal + $Nmasuk - $Nkeluar, 2, ',', '.');
                    //AKhir
                }
            }
            return $data;
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function kartu_stock_gudang(Request $request)
    {
        try {
            $data = [];
            $totalmasuk = 0;
            $totalkeluar = 0;
            $totalsaldo = 0;
            $gudang = gudang::select('nama')->where('kode', $request->gudang)->first();
            $barang = barang::where('kode', $request->barang)->first();
            $title['barang'] = $barang->nama;
            $title['gudang'] = $gudang->nama;
            $title['satuan'] = $barang->satuan;
            if ($request->gudang == "ALL") {
            } else {

                //SEBLUMNYA
                $data[0]['tanggal'] = null;
                $data[0]['kode_transaksi'] = null;
                $data[0]['keterangan'] = "Saldo periode Sebelumya";

                //MASUK
                $A = jurnal::select(DB::raw("SUM(qty_debit) AS MASUK"))
                    ->where('kode_transaksi', 'LIKE', "MR%D")
                    ->where('kode_brg', $request->barang)
                    ->where('kode_gdg', $request->gudang)
                    ->where('status', 'Selesai')
                    ->where('tanggal', '<', $request->awal)->first();

                $data[0]['masuk'] = $A->MASUK + 0;
                //KELUAR
                $B = jurnal::select(DB::raw("SUM(qty_debit) AS KELUAR"))
                    ->where('kode_transaksi', 'LIKE', "SJ%D")
                    ->where('kode_brg', $request->barang)
                    ->where('kode_gdg', $request->gudang)
                    ->where('status', 'Selesai')
                    ->where('tanggal', '<', $request->awal)->first();

                $data[0]['keluar'] = $B->KELUAR + 0;

                $data[0]['saldo'] = $A->MASUK - $B->KELUAR;
                $totalmasuk = $totalmasuk + $data[0]['masuk'];
                $totalkeluar = $totalkeluar + $data[0]['keluar'];
                $totalsaldo = $totalmasuk - $totalkeluar;
                //SEBELUMNYA
                //DATA
                $n = 1;
                $awal = strval($request->awal);
                $akhir = strval($request->akhir);

                //Add Select Tanggal
                $dalam = jurnal::select('kode_transaksi', 'keterangan', 'qty_debit', 'qty_kredit', 'tanggal')
                    ->where('kode_transaksi', 'LIKE', "MR%D")
                    ->where('kode_brg', $request->barang)
                    ->where('kode_gdg', $request->gudang)
                    ->where('akun_debit', 'LIKE', '17%')
                    ->where('status', 'Selesai')
                    ->whereBetween('tanggal', [$awal, $akhir])
                    ->orWhere('kode_transaksi', 'LIKE', "SJ%K")
                    ->where('kode_brg', $request->barang)
                    ->where('kode_gdg', $request->gudang)
                    ->where('akun_debit', 'LIKE', '17%')
                    ->where('status', 'Selesai')
                    ->whereBetween('tanggal', [$awal, $akhir])->get();
                // foreach($dalam as $d){
                //     $transaksi = substr($d->kode_transaksi,0,19);
                //     $date = substr($d->kode_transaksi,6,6);
                //     $thn = substr($date,0,2); $bln = substr($date,2,2); $tgl = substr($date,4,2);
                //     $tahun = "20".$thn;
                //     $date = $tgl."/".$bln."/".$tahun;
                //     $data[$n]['tanggal']=$date;
                //     $data[$n]['kode_transaksi']=$transaksi;
                //     $data[$n]['keterangan']=$d->keterangan;
                //     $data[$n]['kode_transaksi']=
                //     $n++;
                // }
                foreach ($dalam as $d) {
                    $DK = substr(strrev($d->kode_transaksi), 0, 1);
                    $transaksi = substr($d->kode_transaksi, 0, 15);
                    $date = substr($d->kode_transaksi, 6, 4);
                    $thn = substr($date, 0, 2);
                    $bln = substr($date, 2, 2);
                    $tahun = "20" . $thn;
                    $date = $bln . "/" . $tahun;

                    //$data[$n]['tanggal'] = $date;
                    $data[$n]['tanggal'] = $d->tanggal;
                    $data[$n]['kode_transaksi'] = $transaksi;
                    $data[$n]['keterangan'] = $d->keterangan;
                    if (strpos($d->kode_transaksi, "MR") !== false) {
                        //MASUK

                        $data[$n]['masuk'] = $d->qty_debit;
                        $data[$n]['keluar'] = 0;
                        $data[$n]['saldo'] = $d->qty_debit + 0;
                        //MASUK
                    } else {
                        $data[$n]['keluar'] = $d->qty_kredit;
                        $data[$n]['masuk'] = 0;
                        $data[$n]['saldo'] = $d->qty_kredit + 0;
                    }
                    $totalmasuk = $totalmasuk + $data[$n]['masuk'];
                    $totalkeluar = $totalkeluar + $data[$n]['keluar'];
                    $totalsaldo = $totalmasuk - $totalkeluar;
                    $n++;
                }
                //DATA
                //TOTAL
                $data[$n]['tanggal'] = "NA";
                $data[$n]['kode_transaksi'] = "NA";
                $data[$n]['keterangan'] = "TOTAL";
                $data[$n]['masuk'] = $totalmasuk;
                $data[$n]['keluar'] = $totalkeluar;
                $data[$n]['saldo'] = $totalsaldo;
                //TOTAL
            }
            // if($request->barang == "ALL"){
            //     $data = jurnal::where('kode_gdg',$request->gudang)
            //         ->whereBetween('created_at',[$request->awal,$request->akhir])
            //         ->get();
            // } else {
            //     $data = jurnal::where('kode_gdg',$request->gudang)
            //         ->where('kode_brg',$request->barang)
            //         ->whereBetween('created_at',[$request->awal,$request->akhir])
            //         ->get();
            // }
            // foreach($data as $A){
            //     $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
            //             ->where('kode_transaksi','LIKE','MR%')
            //             ->where('kode_gdg',$A->kode_gdg)
            //             ->where('kode_brg',$A->kode_brg)
            //             ->where('status','!=','Selesai')
            //             ->where('created_at','<',$A->created_at)->first();
            //     $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
            //             ->where('kode_transaksi','LIKE','SJ%')
            //             ->where('kode_gdg',$A->kode_gdg)
            //             ->where('kode_brg',$A->kode_brg)
            //             ->where('status','!=','Selesai')
            //             ->where('created_at','<',$A->created_at)->first();
            //     if($saldoA == null ){
            //         $saldoA = 0;
            //     } else {
            //         $saldoA = $saldoA->SA;
            //     }
            //     if($saldoB == null ){
            //         $saldoB = 0;
            //     } else {
            //         $saldoB = $saldoB->SA;
            //     }
            //     $saldo_awal = $saldoA-$saldoB;
            //     $A['saldo_awal'] = $saldo_awal;
            //     $saldo_akhir = $saldo_awal+$A->qty;
            //     $A['saldo_akhir'] = $saldo_akhir;
            // }
            return response()->json(['success' => true, 'title' => $title, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    //Mengubah Total Omset Bulan Ini
    public function omsetmarketing(Request $request)
    {
        try {
            $now = Carbon::now();
            $bulan = $now->format('Y-m'); // Format tahun-bulan dengan padding nol
            $tanggal = $request->tanggal;
    
            if ($request->marketing == "ALL") {
                $so = salesorder::where('tanggal', 'LIKE', $bulan . "%")->get();
                $omset = 0;
    
                foreach ($so as $SO) {
                    $detail = detail_so::select(DB::raw('SUM(dpp) AS total'))
                        ->where('kode_so', $SO->kode)
                        ->first();
                    $omset += $detail->total ?? 0;
                }
    
                $target = targetomset::select(DB::raw('SUM(target) AS target'))
                    ->where('bulan', 'LIKE', $bulan . "%")
                    ->first()
                    ->target ?? 0;
    
                $plan = target_marketing::select(DB::raw('SUM(total) AS total'))
                    ->where('tanggal', 'LIKE', $bulan . "%")
                    ->first()
                    ->total ?? 0;
    
                return response()->json([
                    'success' => true,
                    'omset' => $omset,
                    'so' => $so,
                    'target' => $target,
                    'plan' => $plan,
                    'tanggal' => $bulan
                ]);
            } else {
                $so = salesorder::where('tanggal', 'LIKE', $bulan . "%")
                    ->where('marketing', $request->marketing)
                    ->get();
                $omset = 0;
    
                foreach ($so as $SO) {
                    $detail = detail_so::select(DB::raw('SUM(dpp) AS total'))
                        ->where('kode_so', $SO->kode)
                        ->first();
                    $omset += $detail->total ?? 0;
                }
    
                $target = targetomset::select('target')
                    ->where('kd_karyawan', $request->marketing)
                    ->where('bulan', 'LIKE', $bulan . "%")
                    ->first()
                    ->target ?? 0;
    
                $plan = target_marketing::select(DB::raw('SUM(total) AS total'))
                    ->where('kd_marketing', $request->marketing)
                    ->where('tanggal', 'LIKE', $bulan . "%")
                    ->first()
                    ->total ?? 0;
    
                return response()->json([
                    'success' => true,
                    'omset' => $omset,
                    'so' => $so,
                    'target' => $target,
                    'plan' => $plan,
                    'tanggal' => $bulan
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    

    public function targetmarketing(Request $request)
    {
        try {
            if ($request->marketing == "ALL") {
            } else {
                $X = target_marketing::select(DB::raw('SUM(total)AS total'))
                    ->where('kd_marketing', $request->marketing)
                    ->first();
                return response()->json(['success' => true, 'target' => $X->total]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function riwayatpenjualan(Request $request)
    {
        try {
            $awal = $request->awal;
            $akhir  = $request->akhir;
            $marketing = $request->marketing;

            if ($marketing == "all") {
                $data = invoice::select('invoice.kode_so', 'invoice.kode', 'karyawan.nama as marketing', 'invoice.tanggal', 'invoice.status')
                    ->join('salesorder', 'invoice.kode_so', '=', 'salesorder.kode')
                    ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
                    ->whereBetween('invoice.tanggal', [$awal, $akhir])
                    ->get();
            } else {
                $data = invoice::select('invoice.kode_so', 'invoice.kode', 'karyawan.nama as marketing', 'invoice.tanggal', 'invoice.status')
                    ->join('salesorder', 'invoice.kode_so', '=', 'salesorder.kode')
                    ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
                    ->where('salesorder.marketing', $marketing)
                    ->whereBetween('invoice.tanggal', [$awal, $akhir])
                    ->get();
            }
            $total = 0;
            foreach ($data as $D) {
                $barang = jurnal::select('nama_brg')
                    ->where('kode_transaksi', 'LIKE', "$D->kode%D")
                    ->get();
                $a = '';
                foreach ($barang as $brg) {
                    $a = $a . "," . $brg->nama_brg;
                }
                $D->barang = $a;
                $X = jurnal::select(DB::raw('SUM(jumlah_debit)AS total'))
                    ->where('kode_transaksi', 'LIKE', "$D->kode%D")
                    ->first();
                $D->total = "Rp." . number_format($X->total, 2, ',', '.');
                $total = $total + $X->total;
            }

            return response()->json(['success' => true, 'data' => $data, 'total' => $total]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
        // $awal = $request->input('awal');
        // $akhir  = $request->input('akhir');
        // $marketing = $request->input('marketing');
        // if($marketing == "all"){
        //     $data = invoice::select('invoice.so','invoice.kode','karyawan.nama as marketing','invoice.tanggal','invoice.status')
        //             ->join('salesorder','invoice.so','=','salesorder.kode')
        //             ->join('karyawan','salesorder.marketing','=','karyawan.kode')
        //             ->whereBetween('invoice.tanggal',[$awal,$akhir])
        //             ->get();
        // } else {
        //     $data = invoice::select('invoice.so','invoice.kode','karyawan.nama as marketing','invoice.tanggal','invoice.status')
        //             ->join('salesorder','invoice.so','=','salesorder.kode')
        //             ->join('karyawan','salesorder.marketing','=','karyawan.kode')
        //             ->where('salesorder.marketing',$marketing)
        //             ->whereBetween('invoice.tanggal',[$awal,$akhir])
        //             ->get();
        // }
        // $total = 0;
        // foreach($data AS $D){
        //     $X = jurnal::select(DB::raw('SUM(jumlah_debit)AS total'))
        //                 ->where('kode_transaksi','LIKE',"$D->kode%D")
        //                 ->first();
        //     $total = $total+$X->total;
        // }
        // $data['so'][] = "";$data['kode'][]="";$data['tanggal'][]="";$data['status'][]="";

        // return DataTables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('total',function($data){
        //         if($data->kode == ""){
        //             return "Rp.".number_format($total,2,',','.');
        //         } else {
        //             $total = jurnal::select(DB::raw('SUM(jumlah_debit)AS total'))
        //                 ->where('kode_transaksi','LIKE',"$data->kode%D")
        //                 ->first();
        //             return "Rp.".number_format($total->total,2,',','.');
        //         }

        //     })
        //     ->addColumn('barang',function($data){
        //         if($data->kode == ""){
        //             return "";
        //         } else {
        //             $barang = jurnal::select('nama_brg')
        //                     ->where('kode_transaksi','LIKE',"$data->kode%D")
        //                     ->get();
        //             $a = '';
        //             foreach($barang AS $brg){
        //                 $a = $a.",".$brg->nama_brg;
        //             }
        //             return $a;
        //         }

        //     })->make(true);
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
