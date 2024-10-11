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

class BaranginController extends Controller
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
                ->leftjoin('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                ->whereIn('materialreceive.status', ['Sudah Diperiksa', 'Selesai'])
                ->orderBy('materialreceive.kode', 'desc')->get();
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
            $data = materialreceive::select('materialreceive.*', 'purchaseorder.pembayaran', 'rekanan.nama')
                ->whereBetween('materialreceive.tanggal', [$request->awal, $request->akhir])
                ->leftJoin('purchaseorder', 'materialreceive.transaksi', '=', 'purchaseorder.kode')
                ->leftJoin('rekanan', 'purchaseorder.supplier', '=', 'rekanan.kode')
                ->orderBy('materialreceive.kode', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barang', function ($data) {
                    $barang = detail_mr::select('barang.nama AS barang')
                        ->join('barang', 'detail_mr.kode_brg', '=', 'barang.kode')
                        ->where('detail_mr.kode_mr', $data->kode)
                        ->get();
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
                })->make(true);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
