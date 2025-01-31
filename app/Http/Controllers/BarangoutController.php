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

class BarangoutController extends Controller
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
            $data = suratjalan::select('suratjalan.*', 'rekanan.nama AS nama_rekanan')
                ->leftJoin('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                ->leftJoin('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->whereIn('suratjalan.status', ['Sudah Diperiksa', 'Selesai'])
                ->orderBy('suratjalan.tgl_diterima', 'DESC')->get();
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
                //Add Nama Rekanan
                ->editColumn('rekanan', function ($data) {
                    return $data->nama_rekanan;
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
                    $barang = detail_sj::select('barang.nama AS barang')
                        ->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')
                        ->where('detail_sj.kode_sj', $data->kode)->get();
        
                    $a = "";
                    foreach ($barang as $brg) {
                        $a .= $brg->barang . " || ";
                    }
                    return rtrim($a, " || "); // Menghapus separator terakhir
                })->make(true);
        } else {
            $data = suratjalan::select('suratjalan.*', 'rekanan.nama AS nama_rekanan')
                ->leftJoin('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                ->leftJoin('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->whereIn('suratjalan.status', ['Sudah Diperiksa', 'Selesai'])
                ->orderBy('suratjalan.tgl_diterima', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tgl_diterima', function ($data) {
                    if ($data->tgl_diterima == null) {
                        return "NULL";
                    } else {
                        return $data->tgl_diterima;
                    }
                })
                ->editColumn('tgl_diterima', function ($data) {
                    $data = Carbon::parse($data->tgl_diterima)->format('d F Y');
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
                //Add Nama Rekanan
                ->editColumn('rekanan', function ($data) {
                    return $data->nama_rekanan;
                })
                ->addColumn('barang', function ($data) {
                    $barang = detail_sj::select('barang.nama AS barang')->join('barang', 'detail_sj.kode_brg', '=', 'barang.kode')->where('detail_sj.kode_sj', $data->kode)->get();

                    $a = "";
                    foreach ($barang as $brg) {
                        $a = $brg->barang . " || " . $a;
                    }
                    return $a;
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

    public function filterExport(Request $request)
    {
        try {
            $data = suratjalan::select('suratjalan.*', 'rekanan.nama AS nama_rekanan')
                ->leftJoin('salesorder', 'suratjalan.so', '=', 'salesorder.kode')
                ->leftJoin('rekanan', 'salesorder.konsumen', '=', 'rekanan.kode')
                ->whereIn('suratjalan.status', ['Sudah Diperiksa', 'Selesai'])
                ->whereBetween('suratjalan.tgl_diterima', [$request->awal, $request->akhir])
                ->orderBy('suratjalan.tgl_diterima', 'DESC')->get();
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
                //Add Nama Rekanan
                ->editColumn('rekanan', function ($data) {
                    return $data->nama_rekanan;
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
                })->make(true);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
