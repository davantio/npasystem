<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\karyawan;
use App\Models\invoice;
use App\Models\image;
use App\Models\detail_invoice;
use App\Models\detail_po;
use App\Models\detail_mr;
use App\Models\suratjalan;
use App\Models\detail_sj;
use App\Models\rekanan;
use App\Models\salesorder;
use App\Models\purchaseorder;
use App\Models\materialreceive;
use App\Models\tender_instansi;
use App\Models\aset;
use App\Models\tender;
use App\Models\author;
use App\Models\kode_akuntansi;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\InstansiTender;
use App\Models\Subinstansi;
use App\Models\SubinstansiTender;

class LayoutController extends Controller
{
    //
    public function index()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = Carbon::today();
        $tglkaryawan = karyawan::where('status', "Aktif")->get();
        // Mengecek apakah ada karyawan yang ulang tahun hari ini
        $karyawanUlangTahun = $tglkaryawan->filter(function ($tglkaryawan) use ($tanggalHariIni) {
            // Cast the birthdate to Carbon instance for comparison
            $tanggalLahir = Carbon::parse($tglkaryawan->ttl);
            return $tanggalLahir->isBirthday($tanggalHariIni);
        });

        // Calculate current age and format the data
        $karyawanUlangTahun = $karyawanUlangTahun->map(function ($tglkaryawan) use ($tanggalHariIni) {
            // Cast the birthdate to Carbon instance
            $tanggalLahir = Carbon::parse($tglkaryawan->ttl);
            // Calculate current age
            $umur = $tanggalLahir->diffInYears($tanggalHariIni);
            // Return only name and current age
            return [
                'nama' => $tglkaryawan->nama,
                'umur' => $umur,
            ];
        });

        return view('main')->with([
            'user' => Auth::user(),
            'detail' => $karyawan,
            'hbd' => $karyawanUlangTahun,
        ]);
    }
    public function login()
    {
        $login = Auth::user();

        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login == null) {
            return view('login');
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function laporan_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('laporan-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login == 'manager-marketing') {
            return view('laporan-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login == 'ceo') {
            return view('laporan-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login == 'superadmin' || $login->level == 'manager-admin') {
            return view('laporan-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function laporan_harian_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('laporan-harian-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'superadmin'  || $login->level == 'manager-admin') {
            return view('laporan-harian-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('laporan-harian-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('laporan-harian-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function laporan_marketing_personal()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('laporan-personal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('laporan-personal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('laporan-personal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('laporan-personal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function data_karyawan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-karyawan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-karyawan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-karyawan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_rekanan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-marketing' || $login->level == 'manager-admin') {
            return view('data-rekanan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-rekanan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-rekanan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing' || $login->level == 'admin-marketing') {
            return view('data-rekanan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function inv_hsn($kode)
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        $inv = invoice::select('invoice.*', 'rekanan.nama as rekanan', 'rekanan.telp', 'bank.bank', 'bank.rekening', 'bank.atas_nama', 'karyawan.nama as marketing', 'salesorder.pembayaran', 'suratjalan.alamat')
            ->join('salesorder', 'invoice.kode_so', '=', 'salesorder.kode')
            ->join('bank', 'invoice.kode_bank', '=', 'bank.kode')
            ->join('suratjalan', 'invoice.kode_sj', '=', 'suratjalan.kode')
            ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
            ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
            ->where('invoice.kode', $kode)->first();
        $detail = detail_invoice::select('detail_invoice.*', 'gudang.nama as gudang', 'barang.nama as barang', 'barang.satuan')
            ->join('gudang', 'detail_invoice.kode_gdg', '=', 'gudang.kode')
            ->join('barang', 'detail_invoice.kode_brg', '=', 'barang.kode')
            ->where('detail_invoice.kode_inv', $kode)->get();
        foreach ($detail as $d) {
            $diakui = number_format($d->diakui, 2, ',', '.');
            $d->diakui2 = $diakui;
        }
        $data['inv'] = $inv;
        $data['detail'] = $detail;
        $author = author::select('karyawan.nama AS pembuat')->join('karyawan', 'author.kode_pembuat', '=', 'karyawan.kode')->where('author.transaksi', $kode)->first();
        $data['pembuat'] = $author->pembuat;
        return view('cetak-invoice-herbivor')->with([
            'user' => Auth::user(),
            'detail' => $karyawan,
            'data' => $data
        ]);
    }

    public function cetak_so()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'admin-marketing'  || $login->level == 'marketing') {
            return view('cetak-so')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function cetak_po(Request $request)
    {
        $hasil = array();
        $perusahaan = purchaseorder::select('perusahaan')->where('kode', $request->kode)->first();
        if ($perusahaan->perusahaan == "npa") {
            $halaman = 'cetak-po';
        } else if ($perusahaan->perusahaan == "herbivor") {
            $halaman = 'cetak-po-herbivor';
        } else if ($perusahaan->perusahaan == "triputra") {
            $halaman = 'cetak-po';
        } else {
            $halaman = 'cetak-po';
        }
        $kode = $request->kode;
        $data = purchaseorder::where('kode', $kode)->first();
        $supplier = rekanan::where('kode', $data->supplier)->first();
        $date = Carbon::parse($data->time_delivery);
        $tanggal = $date->format('d F Y');
        $data->time_delivery = $tanggal;
        $detail = detail_po::select('detail_po.*', 'barang.nama as nama', 'barang.satuan')
            ->join('barang', 'detail_po.kode_brg', 'barang.kode')
            ->where('detail_po.kode_po', $kode)->get();
        foreach ($detail as $d) {
            $d->banyak = number_format($d->qty, 2, ',', '.');
        }
        $tglpo = Carbon::parse($data->tanggal);
        $data->tgl_po = $tglpo->format('d F Y');
        $ttd = image::where('nama', 'ttd purchasing herbivor')->first();
        $hasil['po'] = $data;
        $hasil['detail'] = $detail;
        $hasil['supplier'] = $supplier;
        $hasil['ttd'] = $ttd->url;
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'purchasing' || $login->level == 'accounting') {
            return view($halaman)->with([
                'user' => Auth::user(),
                'data' => $hasil,
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function cetak_mr(Request $request)
    {
        $perusahaan = materialreceive::select('perusahaan')->where('kode', $request->kode)->first();
        if ($perusahaan->perusahaan == "npa") {
            $halaman = 'cetak-mr';
        } else if ($perusahaan->perusahaan == "herbivor") {
            $halaman = 'cetak-mr-herbivor';
        } else if ($perusahaan->perusahaan == "triputra") {
            $halaman = 'cetak-mr';
        } else {
            $halaman = 'cetak-mr';
        }

        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $Login->level == "ceo" || $Login->level == "admin" || $Login->level == "staff-gudang" || $Login->level == "manager-operasional") {
            return view($halaman)->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view($halaman)->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function cetak_sj(Request $request)
    {
        $hasil = array();
        $perusahaan = suratjalan::select('perusahaan')->where('kode', $request->kode)->first();
        if ($perusahaan->perusahaan == "npa") {
            $halaman = 'cetak-sj';
        } else if ($perusahaan->perusahaan == "herbivor") {
            $halaman = 'cetak-sj-herbivor';
        } else if ($perusahaan->perusahaan == "triputra") {
            $halaman = 'cetak-sj';
        } else {
            $halaman = 'cetak-sj-herbivor';
        }
        $kode = $request->kode;
        $tipe = Str::substr($kode, 3, 2);
        if ($tipe == 41) {
            $data = suratjalan::where('kode', $kode)->first();
            $konsumen = rekanan::where('kode', $data->konsumen)->first();
            $invoice = invoice::select('kode', 'kode_so', 'tanggal', 'po_req')->where('kode_sj', $kode)->first();
            $so     = salesorder::select('no_po')->where('kode', $invoice->kode_so)->first();

            $date = Carbon::createFromFormat('Y-m-d', $invoice->tanggal);
            $formattedDate = $date->format('j F Y');
            $invoice->tanggal = $formattedDate;
            $data->invoice = $invoice->kode;
            $data->namakonsumen = $konsumen->nama;
            $data->telp = $konsumen->telp;
            $detail = detail_sj::select('detail_sj.*', 'barang.nama', 'barang.satuan')
                ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                ->where('detail_sj.kode_sj', $data->kode)->get();
            foreach ($detail as $d) {
                $d->qty = number_format($d->qty, 2, ",", ".");
            }
        } else {
            $data = suratjalan::where('kode', $kode)->first();
            $data->invoice = "-";
            $detail =  detail_sj::select('detail_sj.*', 'barang.nama', 'barang.satuan')
                ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                ->where('detail_sj.kode_sj', $data->kode)->get();
        }
        $date = Carbon::createFromFormat('Y-m-d', $data->tgl_kirim);
        $formattedDate = $date->format('j F Y');
        $data->tgl_kirim = $formattedDate;
        $hasil['sj'] = $data;
        $hasil['detail'] = $detail;
        $hasil['inv'] = $invoice;
        $hasil['so'] = $so;
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'staff-gudang' || $login->level == 'manager-operasional') {
            return view($halaman)->with([
                'user' => Auth::user(),
                'data' => $hasil,
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function cetak_invoice(Request $request)
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        $data = array();
        $inv = invoice::select('invoice.*', 'rekanan.nama as rekanan', 'rekanan.telp', 'bank.bank', 'bank.rekening', 'bank.atas_nama', 'karyawan.nama as marketing', 'salesorder.pembayaran', 'suratjalan.alamat')
            ->join('salesorder', 'invoice.kode_so', '=', 'salesorder.kode')
            ->join('bank', 'invoice.kode_bank', '=', 'bank.kode')
            ->join('suratjalan', 'invoice.kode_sj', '=', 'suratjalan.kode')
            ->join('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
            ->join('karyawan', 'salesorder.marketing', '=', 'karyawan.kode')
            ->where('invoice.kode', $request->kode)->first();
        $detail = detail_invoice::select('detail_invoice.*', 'gudang.nama as gudang', 'barang.nama as barang', 'barang.satuan')
            ->join('gudang', 'detail_invoice.kode_gdg', '=', 'gudang.kode')
            ->join('barang', 'detail_invoice.kode_brg', '=', 'barang.kode')
            ->where('detail_invoice.kode_inv', $request->kode)->get();
        foreach ($detail as $d) {
            $diakui = number_format($d->diakui, 2, ',', '.');
            $d->diakui2 = $diakui;
        }
        if ($inv->perusahaan == "npa" || $inv->perusahaan == null) {
            $view = 'cetak-invoice';
        } else if ($inv->perusahaan == "herbivor") {
            $view = 'cetak-invoice-herbivor';
        } else if ($inv->perusahaan == "triputra") {
            $view = 'cetak-invoice-triputra';
        } else {
            $view = 'invoice';
        }
        $data['inv'] = $inv;
        $data['detail'] = $detail;
        $author = author::select('karyawan.inisial AS pembuat')->join('karyawan', 'author.kode_pembuat', '=', 'karyawan.kode')->where('author.transaksi', $request->kode)->first();
        $data['pembuat'] = $author->pembuat;
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'purchasing') {
            return view($view)->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'data' => $data,
            ]);
        } else {
            return view('invoice')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_barang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-barang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-barang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin' || $login->level == 'admin-marketing') {
            return view('data-barang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('data-barang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_akuntansi()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('data-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_asset()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-asset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-asset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($lgin->level == 'manager-operasional') {
            return view('data-asset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-asset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('data-asset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_gudang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('data-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function purchaseorder()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('purchase-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('purchase-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('purchase-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('purchase-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function materialreceive()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'purchasing' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'staff-gudang' || $login->level == "manager-operasional" || $login->level == 'admin') {
            return view('material-receive')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function newsalesorder()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        return view('newsales-order')->with([
            'user' => Auth::user(),
            'detail' => $karyawan,
        ]);
    }
    public function salesorder()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('sales-order')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function invoice()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('invoice')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('invoice')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('invoice')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function data_bank()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('data-bank')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('data-bank')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('data-bank')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function suratjalan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('surat-jalan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('surat-jalan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('surat-jalan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'staff-gudang') {
            return view('surat-jalan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-operasional') {
            return view('surat-jalan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function plan_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('planning-mingguan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('planning-mingguan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('planning-mingguan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('planning-mingguan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function laporan_penjualan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('laporan-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('laporan-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('laporan-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('laporan-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('laporan-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function lpj_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('lpj-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('lpj-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('lpj-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('lpj-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('lpj-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function stock_gudang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-operasional') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'staff-gudang') {
            return view('stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function kartu_stock_gudang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-operasional') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'staff-gudang') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'marketing') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('kartu-stock-gudang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function barang_masuk()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-operasional') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'staff-gudang') {
            return view('barang-masuk')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function barang_keluar()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'admin') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-operasional') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'purchasing') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'staff-gudang') {
            return view('barang-keluar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function kas()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == "purchasing" || $login->level == 'ceo' || $login->level == 'accounting' || $login->level == 'admin') {
            return view('kas')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function jurnal_kas()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('jurnal-kas')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('jurnal-kas')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('jurnal-kas')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function jurnal_akuntansi()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('jurnal-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('jurnal-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('jurnal-akuntansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function laporan_bukubesar()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('laporan-bukubesar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('laporan-bukubesar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('laporan-bukubesar')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function search_jurnal()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('search-jurnal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('search-jurnal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('search-jurnal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function neraca()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('neraca')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('neraca')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('neraca')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function laporan_labarugi()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('laporan-labarugi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('laporan-labarugi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'accounting') {
            return view('laporan-labarugi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function database_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('database-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('database-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'marketing' || $login->level == 'admin-marketing') {
            return view('database-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('database-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function aksi_DBmarketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'marketing' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing') {
            return view('aksi-dbmarketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function riwayatpenjualan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('riwayat-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'ceo') {
            return view('riwayat-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'marketing' || $login->level == "admin-marketing") {
            return view('riwayat-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } elseif ($login->level == 'manager-marketing') {
            return view('riwayat-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function logsistem()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin') {
            return view('log-sistem')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function penjualanmarketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing' || $login->level == 'admin') {
            return view('penjualan-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function aset()
    {
        $login = Auth::user();

        // Query untuk mengambil jumlah aset berdasarkan nama_perkiraan
        $dataaset = "
        SELECT
            kodeakuntansi.nama_perkiraan,
            COUNT(*) AS jumlah_perkiraan
        FROM
            aset
        JOIN kodeakuntansi ON aset.tipe = kodeakuntansi.kode
        GROUP BY kodeakuntansi.nama_perkiraan;
    ";

        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();

        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'admin-marketing' || $login->level == 'manager-operasional' || $login->level == 'accounting' || $login->level == 'staff-gudang') {
            // Eksekusi query dan simpan hasilnya dalam variabel
            $results = DB::select(DB::raw($dataaset));

            return view('data-aset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'results' => $results, // Mengirim hasil query ke view
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function aset_tipe($kode)
    {
        $login = Auth::user();
        $tipeaset = kode_akuntansi::where('kode', $kode)->first();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'admin-marketing' || $login->level == 'manager-operasional' || $login->level == 'accounting') {
            return view('data-asetn')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'tipeaset' => $tipeaset,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function target_penjualan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin'  || $login->level == 'ceo' || $login->level = 'manager-marketing' || $login->level == 'admin-marketing') {
            return view('data-target-penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function aktifitas_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin-marketing') {
            return view('aktifitas-marketing')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function jurnalumum()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'accounting') {
            return view('jurnal-umum')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }

    public function pengiriman()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'admin-marketing' || $login->level == 'purchasing' || $login->level == 'marketing') {
            return view('data-pengiriman')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        }
    }
    public function lap_pembelian()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'purchasing') {
            return view('laporan-pembelian')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }
    public function targetomset()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing') {
            return view('target-omset')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function laporanpiutang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing') {
            return view('laporan-piutang')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function library_image()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo') {
            return view('library-image')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }
    public function vendor()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'manager-admin' || $login->level == 'staff-gudang' || $login->level == 'manager-operasional') {
            return view('vendor')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function tender_id($id)
    {
        $login = Auth::user();
        $instansi = tender_instansi::where('id', $id)->first();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing' || $login->level == 'marketing') {
            return view('tendern')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'instansi' => $instansi
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function subtender($id_subinstansi)
    {
        $login = Auth::user();
        $subinstansi = Subinstansi::where('id_subinstansi', $id_subinstansi)->first();
        $karyawan = Karyawan::where('kode', $login->kode_karyawan)->firstOrFail();

        if (in_array($login->level, ['superadmin', 'manager-admin', 'ceo', 'admin', 'manager-marketing', 'admin-marketing', 'marketing'])) {
            return view('subinstansi')->with([
                'user' => $login,
                'detail' => $karyawan,
                'subinstansi' => $subinstansi
            ]);
        } else {
            return view('main')->with([
                'user' => $login,
                'detail' => $karyawan
            ]);
        }
    }

    public function tender_subinstansi($id_instansi)
    {
        $tendersubinstansi = Subinstansi::where('id_instansi', $id_instansi)
            ->orderBy('status_priority', 'desc')
            ->orderBy('nama_subinstansi', 'asc')
            ->get();
        $instansi = InstansiTender::where('id_instansi', $id_instansi)->get();
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();

        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing' || $login->level == 'marketing') {
            return view('tender-subinstansi')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'tendersubinstansi' => $tendersubinstansi,
                'instansi' => $instansi

            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function tender()
    {
        // Mengambil data instansi tender
        $instansiTenders = InstansiTender::all();
        $return = "";

        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();

        if ($login->level == 'superadmin' || $login->level == 'manager-admin' || $login->level == 'ceo' || $login->level == 'admin' || $login->level == 'manager-marketing' || $login->level == 'admin-marketing' || $login->level == 'marketing') {
            return view('tender')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
                'menu' => $return,
                'instansiTenders' => $instansiTenders
            ]);
        } else {
            return view('main')->with([
                'user' => Auth::user(),
                'detail' => $karyawan
            ]);
        }
    }

    public function rnd()
    {
        $login = Auth::user();
        $karyawan = Karyawan::where('kode', $login->kode_karyawan)->firstOrFail();

        if (in_array($login->level, ['superadmin', 'ceo', 'admin'])) {
            return view('research')->with([
                'user' => $login,
                'detail' => $karyawan
            ]);
        } else {
            return view('main')->with([
                'user' => $login,
                'detail' => $karyawan
            ]);
        }
    }

    //Grand Royal
    public function grandroyal_home()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/home')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/index');
        }
    }

    public function grandroyal_datamaster()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/master')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/index');
        }
    }

    public function grandroyal_datamember()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/member')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/index');
        }
    }


    public function grandroyal_penjualan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/penjualan')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/home');
        }
    }

    public function grandroyal_pembelian()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/pembelian')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/home');
        }
    }

    public function grandroyal_jadwal()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'superadmin' || $login->level == 'adminroyal') {
            return view('grandroyal/jadwal')->with([
                'user' => Auth::user(),
                'detail' => $karyawan,
            ]);
        } else {
            return view('grandroyal/home');
        }
    }

    //Grand Royal

}
