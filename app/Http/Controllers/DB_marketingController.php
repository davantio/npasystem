<?php

namespace App\Http\Controllers;

use App\Imports\DBmarketingImport;
use Illuminate\Http\Request;
use App\Models\log_sistem;
use App\Models\db_marketing;
use App\Models\database;
use App\Models\karyawan;
use App\Models\target_marketing;
use App\Models\purchasing;
use App\Models\aksi_dbmarketing;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;

class DB_marketingController extends Controller
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
        switch ($login->level) {
            case ('marketing'):
                $karyawan = $login->kode_karyawan;
                $PT = karyawan::select('perusahaan')->where('kode', $karyawan)->first();

                $data = DB::table('database_marketing')
                    ->select('database_marketing.*', 'karyawan.nama')
                    ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                    ->where(function ($query) use ($PT, $karyawan) {
                        $query->where('database_marketing.PT', $PT->perusahaan)
                            ->where('database_marketing.PIC', $karyawan)
                            ->orWhere('database_marketing.PIC', "-");
                    })
                    ->orWhere(function ($query) use ($PT) {
                        $query->where('database_marketing.PT', $PT->perusahaan)
                            ->orWhere('database_marketing.PT', 'ALL');
                    })
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('telp_wa', function ($data) {
                        return "-";
                    })
                    ->editColumn('nama', function ($data) {
                        if ($data->nama == null) {
                            return "-";
                        } else {
                            return $data->nama;
                        }
                    })
                    ->editColumn('orang_dalam', function ($data) {
                        if ($data->PIC == "-") {
                            return "hidden";
                        } else {
                            return $data->orang_dalam;
                        }
                    })
                    ->editColumn('telp_wa', function ($data) {
                        if ($data->PIC == "-") {
                            return "hidden";
                        } else {
                            return $data->telp_wa;
                        }
                    })
                    ->editColumn('medsos', function ($data) {
                        if ($data->PIC == "-") {
                            return "hidden";
                        } else {
                            return $data->medsos;
                        }
                    })
                    ->editColumn('email', function ($data) {
                        if ($data->PIC == "-") {
                            return "hidden";
                        } else {
                            return $data->email;
                        }
                    })
                    ->editColumn('target', function ($data) {
                        $now = Carbon::today();
                        $awal = Carbon::today()->startOfMonth();
                        $akhir = Carbon::today()->endOfMonth();
                        $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                        if (!$target) {
                            return $data->target;
                        } else {
                            return "Rp. " . number_format($target->total, 2, ",", ".");
                        }
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->PIC == "-") {
                            return "
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                        </div>
                        ";
                        } else {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        }
                    })->make(true);
                break;
            case ('superadmin'):
                $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                    ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                // $data = DB::table('database_marketing')
                //         ->select('database_marketing.*','karyawan.nama')
                //         ->leftJoin('karyawan','database_marketing.PIC','=','karyawan.kode')
                //         ->get();
                return DataTables::of($data)
                    ->addIndexColumn()

                    ->editColumn('nama', function ($data) {
                        if ($data->nama == null) {
                            return "-";
                        } else {
                            return $data->nama;
                        }
                    })
                    ->editColumn('target', function ($data) {
                        $now = Carbon::today();
                        $awal = Carbon::today()->startOfMonth();
                        $akhir = Carbon::today()->endOfMonth();
                        $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                        if (!$target) {
                            return $data->target;
                        } else {
                            return "Rp. " . number_format($target->total, 2, ",", ".");
                        }
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->PIC == "-") {
                            return "

                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item PIC' style='color:green' data-toggle='modal' data-kode='$data->kode' data-target='#modal-pic'><b>Ubah PIC</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        } else {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        }
                    })
                    ->make(true);
                break;
            case ('ceo'):
                $data = DB::table('database_marketing')
                    ->select('database_marketing.*', 'karyawan.nama')
                    ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nama', function ($data) {
                        if ($data->nama == null) {
                            return "-";
                        } else {
                            return $data->nama;
                        }
                    })
                    ->editColumn('target', function ($data) {
                        $now = Carbon::today();
                        $awal = Carbon::today()->startOfMonth();
                        $akhir = Carbon::today()->endOfMonth();
                        $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                        if (!$target) {
                            return $data->target;
                        } else {
                            return "Rp. " . number_format($target->total, 2, ",", ".");
                        }
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->PIC == "-") {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item PIC' style='color:green' data-toggle='modal' data-kode='$data->kode' data-target='#modal-pic'><b>Ubah PIC</b></a>
                                <a class='dropdown-item detail' style='color:lightblue' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        } else {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        }
                    })->make(true);
                break;
            case ('manager-marketing'):
                $karyawan = $login->kode_karyawan;
                $PT = karyawan::select('perusahaan')->where('kode', $karyawan)->first();

                $data = DB::table('database_marketing')
                    ->select('database_marketing.*', 'karyawan.nama')
                    ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                    ->where(function ($query) use ($PT) {
                        $query->where('database_marketing.PT', $PT->perusahaan)
                            ->orWhere('database_marketing.PT', 'ALL');
                    })
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nama', function ($data) {
                        if ($data->nama == null) {
                            return "-";
                        } else {
                            return $data->nama;
                        }
                    })
                    ->editColumn('target', function ($data) {
                        $now = Carbon::today();
                        $awal = Carbon::today()->startOfMonth();
                        $akhir = Carbon::today()->endOfMonth();
                        $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                        if (!$target) {
                            return $data->target;
                        } else {
                            return "Rp. " . number_format($target->total, 2, ",", ".");
                        }
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->PIC == "-") {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item PIC' style='color:green' data-toggle='modal' data-kode='$data->kode' data-target='#modal-pic'><b>Ubah PIC</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        } else {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        }
                    })->make(true);
                break;
            case ('admin-marketing'):
                $karyawan = $login->kode_karyawan;
                $PT = karyawan::select('perusahaan')->where('kode', $karyawan)->first();
                $data = DB::table('database_marketing')
                    ->select('database_marketing.*', 'karyawan.nama')
                    ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                    ->where('database_marketing.PT', $PT->perusahaan)
                    ->orderBy('database_marketing.updated_at', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nama', function ($data) {
                        if ($data->nama == null) {
                            return "-";
                        } else {
                            return $data->nama;
                        }
                    })
                    ->editColumn('target', function ($data) {
                        $now = Carbon::today();
                        $awal = Carbon::today()->startOfMonth();
                        $akhir = Carbon::today()->endOfMonth();
                        $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                        if (!$target) {
                            return $data->target;
                        } else {
                            return "Rp. " . number_format($target->total, 2, ",", ".");
                        }
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->PIC == "-") {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item PIC' style='color:green' data-toggle='modal' data-kode='$data->kode' data-target='#modal-pic'><b>Ubah PIC</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        } else {
                            return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-nama='$data->nama_perusahaan' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                        }
                    })->make(true);
                break;
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
    public function list_db(Request $request)
    {
        try {
            $kategori = $request->kategori;
            $wilayah = $request->wilayah;
            $pic = $request->marketing;
            $login = Auth::user();
            $pt = karyawan::select('perusahaan')->where('kode', $login->kode_karyawan)->first();
            if ($login->level == 'marketing') {
                if ($kategori == "ALL" || $kategori == "all") {
                    if ($wilayah == "all") {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('status', 'Sudah Order')->where('PT', $pt->perusahaan)->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('status', 'Belum Diperiksa')->where('PT', $pt->perusahaan)->count();
                            //Data Buruk
                            $DB = db_marketing::where('status', '!=', '-')
                                ->where('PT', $pt->perusahaan)
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('PIC', $request->marketing)->where('status', 'Sudah Order')->where('PT', $pt->perusahaan)->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->where('PT', $pt->perusahaan)->count();
                            //Data Buruk
                            $DB = db_marketing::where('PIC', $request->marketing)->whereNotIn('status', ['-', 'Sudah Diperiksa', 'Belum Diperiksa'])->where('PT', $pt->perusahaan)
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    } else {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('wilayah', $request->wilayah)->where('status', 'Sudah Order')->where('PT', $pt->perusahaan)->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('wilayah', $request->wilayah)->where('status', 'Belum Diperiksa')->where('PT', $pt->perusahaan)->count();
                            //Data Buruk
                            $DB = db_marketing::where('wilayah', $request->wilayah)->where('status', '!=', '-')->where('PT', $pt->perusahaan)
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->where('PT', $pt->perusahaan)->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->where('PT', $pt->perusahaan)->count();
                            //Data Buruk
                            $DB = db_marketing::where('PIC', $request->marketing)->where('status', '!=', '-')->where('PT', $pt->perusahaan)
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    }
                } else {
                    if ($wilayah == "all") {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->here('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    } else {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    }
                }
            } else {
                if ($kategori == "ALL" || $kategori == "all") {
                    if ($wilayah == "all") {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    } else {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('wilayah', $request->wilayah)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('wilayah', $request->wilayah)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('wilayah', $request->wilayah)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    }
                } else {
                    if ($wilayah == "all") {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->here('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    } else {
                        if ($pic == "all") {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        } else {
                            //Sudah Order
                            $SO = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Sudah Order')->count();
                            //Sedang Dikerjakan
                            $SD = db_marketing::where('kategori', $request->kategori)->where('wilayah', $request->wilayah)->where('PIC', $request->marketing)->where('status', 'Belum Diperiksa')->count();
                            //Data Buruk
                            $DB = db_marketing::where('kategori', $request->kategori)->where('PIC', $request->marketing)->where('status', '!=', '-')
                                ->whereNotIn('status', ['Sudah Order', 'Belum Diperiksa'])->count();
                        }
                    }
                }
            }

            $total = $SO + $SD + $DB;

            return response()->json(['success' => true, 'so' => $SO, 'sd' => $SD, 'db' => $DB, 'total' => $total]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function FilterData(Request $request)
    {
        $kategori = $request->input('kategori');
        $wilayah = $request->input('wilayah');
        $pic = $request->input('marketing');
        $login = Auth::user();
        $pt = karyawan::select('perusahaan')->where('kode', $login->kode_karyawan)->first();
        if ($login->level == 'marketing') {
            if ($kategori == "ALL" || $kategori == "all") {
                if ($wilayah == "all") {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                } else {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                }
            } else {
                if ($wilayah == "all") {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.kategori', $kategori)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                } else {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('PT', $pt->perusahaan)
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                }
            }
        } else {
            if ($kategori == "ALL" || $kategori == "all") {
                if ($wilayah == "all") {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                } else {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.wilayah', $wilayah)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.wilayah', $wilayah)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                }
            } else {
                if ($wilayah == "all") {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.kategori', $kategori)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                } else {
                    if ($pic == "all") {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->get();
                    } else {
                        $data = db_marketing::select('database_marketing.*', 'karyawan.nama')
                            ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                            ->where('database_marketing.kategori', $kategori)
                            ->where('database_marketing.wilayah', $wilayah)
                            ->where('database_marketing.PIC', $pic)
                            ->get();
                    }
                }
            }
        }

        if ($login->level == 'marketing') {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    if ($data->nama == null) {
                        return "-";
                    } else {
                        return $data->nama;
                    }
                })
                ->editColumn('email', function ($data) {
                    if ($data->PIC == "-") {
                        return "hidden";
                    } else {
                        return $data->email;
                    }
                })
                ->editColumn('telp_wa', function ($data) {
                    if ($data->PIC == "-") {
                        return "hidden";
                    } else {
                        return $data->telp_wa;
                    }
                })
                ->editColumn('orang_dalam', function ($data) {
                    if ($data->PIC == "-") {
                        return "hidden";
                    } else {
                        return $data->orang_dalam;
                    }
                })
                ->editColumn('target', function ($data) {
                    $now = Carbon::today();
                    $awal = Carbon::today()->startOfMonth();
                    $akhir = Carbon::today()->endOfMonth();
                    $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                    if (!$target) {
                        return $data->target;
                    } else {
                        return "Rp. " . number_format($target->total, 2, ",", ".");
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->PIC == "-") {
                        return "
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        </div>
                        ";
                    } else {
                        return "
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                            <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:green' data-toggle='modal' data-kode='$data->kode' data-status='sudah-order' data-target='#modal-status'><b>Sudah Order</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                    }
                })->make(true);
        } else {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    if ($data->nama == null) {
                        return "-";
                    } else {
                        return $data->nama;
                    }
                })
                ->editColumn('target', function ($data) {
                    $now = Carbon::today();
                    $awal = Carbon::today()->startOfMonth();
                    $akhir = Carbon::today()->endOfMonth();
                    $target = target_marketing::select(DB::raw("SUM(total) as total"))->where('kd_perusahaan', $data->kode)->whereBetween('tanggal', [$awal, $akhir])->first();
                    if (!$target) {
                        return $data->target;
                    } else {
                        return "Rp. " . number_format($target->total, 2, ",", ".");
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->PIC == "-") {
                        return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item PIC' style='color:green' data-toggle='modal' data-kode='$data->kode' data-target='#modal-pic'><b>Ubah PIC</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                    } else {
                        return "
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item aksi' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-target='#modal-aksi'><b>Tambah Aksi DB</b></a>
                                <a class='dropdown-item target' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-target'><b>Target Penjualan</b></a>
                                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                                <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu'>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='rekanan' data-target='#modal-status'><b>Milik Rekanan</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='buruk' data-target='#modal-status'><b>Pembayaran Buruk</b></a>
                                <a class='dropdown-item status' style='color:red' data-toggle='modal' data-kode='$data->kode' data-status='tutup' data-target='#modal-status'><b>Tutup</b></a>
                                <a class='dropdown-item status' style='color:blue' data-toggle='modal' data-kode='$data->kode' data-status='-' data-target='#modal-status'><b>Default</b></a>
                            </div>
                        </div>
                        ";
                    }
                })->make(true);
        }
    }

    public function importdatabase(Request $request)
    {
        try {
            $this->validate($request, [
                'import-file' => 'required|mimes:xls,xlsx'
            ]);

            $file = $request->file('import-file');

            // $data = Excel::import($file);
            $n = 0;
            // $data = Excel::import(new BarangImport, $file);
            // foreach($data as $D){
            //     $n++;
            // }

            return response()->json(['success' => true, 'pesan' => $n]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function uploaddatabase(Request $request)
    {
        try {
            $this->validate($request, [
                'upload-file' => 'required|mimes:xls,xlsx'
            ]);
            $file = $request->file('upload-file');
            $n = 0;
            $data;
            $import = Excel::import(new DBmarketingImport, $file);
            if ($import) {
                $pesan = "Data Berhasil Ditambahkan";
            } else {
                $pesan = "Data Tidak Berhasil Ditambahkan";
            }
            // $data = Excel::toCollection(new DBmarketingImport, $file);
            return response()->json(['success' => true, 'pesan' => $pesan]);
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

    public function ubahpic(Request $request, $kode)
    {
        try {
            $log = new log_sistem();
            $log->transaksi = "DB Marketing " . $kode;
            $log->user      = $request->user;
            $log->keterangan = "Ubah PIC Data DB Marketing";
            $log->save();

            db_marketing::where('kode', $kode)
                ->update([
                    'PIC' => $request->marketing,
                ]);
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function ubahstatus(Request $request, $kode)
    {
        try {
            if ($request->status == "rekanan") {
                $status = "Milik Rekanan";

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $kode;
                $log->user      = $request->user;
                $log->keterangan = "Ubah status Data DB Marketing";
                $log->save();

                db_marketing::where('kode', $kode)
                    ->update([
                        'status' => $status,
                    ]);
                return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
            } else if ($request->status == "buruk") {
                $status = "Pembayaran Buruk";

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $kode;
                $log->user      = $request->user;
                $log->keterangan = "Ubah status Data DB Marketing";
                $log->save();

                db_marketing::where('kode', $kode)
                    ->update([
                        'status' => $status,
                    ]);
                return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
            } else if ($request->status == "tutup") {
                $status = "Perusahaan Tutup";

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $kode;
                $log->user      = $request->user;
                $log->keterangan = "Ubah status Data DB Marketing";
                $log->save();

                db_marketing::where('kode', $kode)
                    ->update([
                        'status' => $status,
                    ]);
                return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
            } else if ($request->status == "-") {
                $status = "-";

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $kode;
                $log->user      = $request->user;
                $log->keterangan = "Ubah status Data DB Marketing";
                $log->save();

                db_marketing::where('kode', $kode)
                    ->update([
                        'status' => $status,
                    ]);
                return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
            } else if ($request->status == "sudah-order") {
                $status = "Sudah Order";

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $kode;
                $log->user      = $request->user;
                $log->keterangan = "Ubah status Data DB Marketing";
                $log->save();

                db_marketing::where('kode', $kode)
                    ->update([
                        'status' => $status,
                    ]);
                return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
            } else {
                return response()->json(['success' => false, 'pesan' => "Illegal Function !!"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        //
        try {
            $last  = DB::table('database_marketing')->select('kode')->orderBy('kode', 'DESC')->first();
            // $last = db_marketing::select('kode')->orderBy('kode','DESC')->first();
            $newkode  = $last->kode + 1;

            //CEK Nama Perusahaan
            $nama = strtolower($request->nama);
            $cek = db_marketing::select('nama_perusahaan')->where('nama_perusahaan', 'LIKE', $nama . '%')->first();
            //CEK Nama Perusahaan

            if ($cek) {
                return response()->json(['success' => false, 'pesan' => "Nama Perusahaan Sudah Ada"]);
            } else {
                $data = DB::table('database_marketing')->insert([
                    'kode'      => $newkode,
                    'kategori'  => $request->kategori,
                    'wilayah'   => $request->wilayah,
                    'nama_perusahaan'   => $request->nama,
                    'alamat_kantor'   => $request->kantor,
                    'alamat_pabrik'   => $request->pabrik,
                    'telp_wa'   => $request->telp,
                    'email'   => $request->email,
                    'orang_dalam'   => $request->rekanan,
                    'medsos'   => $request->medsos,
                    'kebutuhan'   => $request->kebutuhan,
                    'PT' => $request->PT,
                    'PIC'   => $request->pic,
                    'keterangan'   => $request->keterangan,
                    'status'   => "Belum Diperiksa",
                ]);
                $purchasing = new purchasing();
                $purchasing->db_marketing = $newkode;
                $purchasing->nama = $request->purchasing;
                $purchasing->nomor = $request->nopurchasing;
                $purchasing->sosial_media = $request->sosmed;
                $purchasing->alamat = $request->alamat;
                $purchasing->hobby = $request->hobby;
                $purchasing->makanan = $request->makanan;
                $purchasing->save();

                // $data = new db_marketing();
                // $data->kode = $newkode;
                // $data->kategori = $request->kategori;
                // $data->nama_perusahaan = $request->nama;
                // $data->alamat_kantor = $request->kantor;
                // $data->alamat_pabrik = $request->pabrik;
                // $data->wilayah      = $request->wilayah;
                // $data->telp_wa = $request->telp;
                // $data->email = $request->email;
                // $data->orang_dalam = $request->rekanan;
                // $data->medsos = $request->medsos;
                // $data->kebutuhan = $request->kebutuhan;
                // $data->PIC = $request->pic;
                // $data->keterangan = $request->keterangan;
                // $data->status = "Belum Diperiksa";
                // $data->save();

                $log = new log_sistem();
                $log->transaksi = "DB Marketing " . $newkode;
                $log->user      = $request->user;
                $log->keterangan = "Tambah Data DB Marketing";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            }
        } catch (Exception $e) {
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

    public function dropdownkategori(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = db_marketing::select('kategori')
                ->where('kategori', 'LIKE', "%$search%")
                ->distinct()
                ->get();
        } else {
            $data = db_marketing::select('kategori')
                ->distinct()
                ->get();
            $new = ['kategori' => "ALL"];
            $data->push($new);
        }
        return response()->json($data);
    }

    public function dropdownperusahaan(Request $request, $kode)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = db_marketing::select('kode', 'nama_perusahaan')
                ->where('PIC', $kode)
                ->where('nama_perusahaan', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = db_marketing::select('kode', 'nama_perusahaan')
                ->where('PIC', $kode)
                ->get();
        }
        return response()->json($data);
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
            $login = Auth::user();
            $data = DB::table('database_marketing')
                ->select('database_marketing.*', 'karyawan.nama as marketing', 'purchasing.nama AS purchasing', 'purchasing.nomor AS no_purchasing', 'purchasing.sosial_media AS sosial_media', 'purchasing.alamat AS alamat', 'purchasing.hobby AS hobby', 'purchasing.makanan AS makanan')
                ->leftJoin('karyawan', 'database_marketing.PIC', '=', 'karyawan.kode')
                ->leftJoin('purchasing', 'purchasing.db_marketing', '=', 'database_marketing.kode')
                ->where('database_marketing.kode', $kode)->first();
            if ($login->level == "marketing") {
                if ($data->PIC == "-") {
                    $data->marketing = "-";
                    $data->orang_dalam = "Anda Tidak Punya Akses untuk melihat Data ini";
                    $data->telp_wa = 0;
                    $data->email = "hidden";
                    $data->medsos = "hidden";
                } else {
                }
            } else {
            }

            // $data = db_marketing::select('database_marketing.*','karyawan.nama AS marketing')
            //         ->join('karyawan','database_marketing.PIC','=','karyawan.kode')
            //         ->where('database_marketing.kode',$kode)->first();
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
    public function update(Request $request, $kode)
    {
        //
        try {
            $login = Auth::user();
            // $pu = purchasing::where('db_marketing',$kode);
            // $cont = $pu->count();
            // if ($cont){
            //     $purchase = $pu->nama;
            //     $no = $pu->nomor;
            // } else {
            //     $purchase = "";
            //     $no = "";
            // }

            if ($login->level == 'marketing') {
                $data = db_marketing::where('kode', $kode)->first();
                if ($request->purchasing == "" && $request->nopurchasing == "") {
                    DB::table('database_marketing')->where('kode', $kode)
                        ->update([
                            'kategori' => $request->kategori,
                            'nama_perusahaan' => $request->nama,
                            'alamat_kantor' => $request->kantor,
                            'alamat_pabrik' => $request->pabrik,
                            'wilayah'   => $request->wilayah,
                            'telp_wa' => $request->telp,
                            'email' => $request->email,
                            'orang_dalam' => $request->rekanan,
                            'medsos' => $request->medsos,
                            'PT' => $request->PT,
                            'kebutuhan' => $request->kebutuhan,
                            'keterangan' => $request->keterangan,
                        ]);
                } else {
                    $pu = purchasing::where('db_marketing', $kode)->count();
                    if ($pu > 0) {
                        DB::table('database_marketing')->where('kode', $kode)
                            ->update([
                                'kategori' => $request->kategori,
                                'nama_perusahaan' => $request->nama,
                                'alamat_kantor' => $request->kantor,
                                'alamat_pabrik' => $request->pabrik,
                                'wilayah'   => $request->wilayah,
                                'telp_wa' => $request->telp,
                                'email' => $request->email,
                                'orang_dalam' => $request->rekanan,
                                'medsos' => $request->medsos,
                                'PT' => $request->PT,
                                'kebutuhan' => $request->kebutuhan,
                                'keterangan' => $request->keterangan,
                            ]);
                        DB::table('purchasing')->where('db_marketing', $kode)
                            ->update([
                                'nama' => $request->purchasing,
                                'nomor' => $request->nopurchasing,
                                'sosial_media' => $request->sosmed,
                                'hobby' => $request->hobby,
                                'makanan' => $request->makanan,
                            ]);
                        return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                    } else {
                        DB::table('database_marketing')->where('kode', $kode)
                            ->update([
                                'kategori' => $request->kategori,
                                'nama_perusahaan' => $request->nama,
                                'alamat_kantor' => $request->kantor,
                                'alamat_pabrik' => $request->pabrik,
                                'wilayah'   => $request->wilayah,
                                'telp_wa' => $request->telp,
                                'email' => $request->email,
                                'orang_dalam' => $request->rekanan,
                                'medsos' => $request->medsos,
                                'PT' => $request->PT,
                                'kebutuhan' => $request->kebutuhan,
                                'keterangan' => $request->keterangan,
                            ]);
                        $pur = new purchasing();
                        $pur->db_marketing = $kode;
                        $pur->nama         = $request->purchasing;
                        $pur->nomor          = $request->nopurchasing;
                        $pur->save();
                    }
                }
            } else {
                $data = db_marketing::where('kode', $kode)->first();
                if ($request->purchasing == "" && $request->nopurchasing == "") {
                    DB::table('database_marketing')->where('kode', $kode)
                        ->update([
                            'kategori' => $request->kategori,
                            'nama_perusahaan' => $request->nama,
                            'alamat_kantor' => $request->kantor,
                            'alamat_pabrik' => $request->pabrik,
                            'wilayah'   => $request->wilayah,
                            'telp_wa' => $request->telp,
                            'email' => $request->email,
                            'orang_dalam' => $request->rekanan,
                            'medsos' => $request->medsos,
                            'kebutuhan' => $request->kebutuhan,
                            'PT' => $request->PT,
                            'PIC' => $request->pic,
                            'keterangan' => $request->keterangan,
                        ]);
                } else {
                    $pu = purchasing::where('db_marketing', $kode)->count();
                    if ($pu > 0) {

                        DB::table('database_marketing')->where('kode', $kode)
                            ->update([
                                'kategori' => $request->kategori,
                                'nama_perusahaan' => $request->nama,
                                'alamat_kantor' => $request->kantor,
                                'alamat_pabrik' => $request->pabrik,
                                'wilayah'   => $request->wilayah,
                                'telp_wa' => $request->telp,
                                'email' => $request->email,
                                'orang_dalam' => $request->rekanan,
                                'medsos' => $request->medsos,
                                'PT' => $request->PT,
                                'PIC' => $request->pic,
                                'kebutuhan' => $request->kebutuhan,
                                'keterangan' => $request->keterangan,
                            ]);
                        DB::table('purchasing')->where('db_marketing', $kode)
                            ->update([
                                'nama' => $request->purchasing,
                                'nomor' => $request->nopurchasing,
                                'sosial_media' => $request->sosmed,
                                'hobby' => $request->hobby,
                                'makanan' => $request->makanan,
                            ]);
                        return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                    } else {
                        DB::table('database_marketing')->where('kode', $kode)
                            ->update([
                                'kategori' => $request->kategori,
                                'nama_perusahaan' => $request->nama,
                                'alamat_kantor' => $request->kantor,
                                'alamat_pabrik' => $request->pabrik,
                                'wilayah'   => $request->wilayah,
                                'telp_wa' => $request->telp,
                                'email' => $request->email,
                                'orang_dalam' => $request->rekanan,
                                'medsos' => $request->medsos,
                                'kebutuhan' => $request->kebutuhan,
                                'PT' => $request->PT,
                                'PIC' => $request->pic,
                                'keterangan' => $request->keterangan,
                            ]);
                        $pur = new purchasing();
                        $pur->db_marketing = $kode;
                        $pur->nama          = $request->purchasing;
                        $pur->nomor          = $request->nopurchasing;
                        $pur->save();
                    }
                }
            }

            $log = new log_sistem();
            $log->transaksi = "DB Marketing " . $kode;
            $log->user      = $request->user;
            $log->keterangan = "Edit Data DB Marketing";
            $log->save();
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);

            // return response()->json(['success'=>false,'pesan'=>$cont]);
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
        try {
            DB::table('database_marketing')
                ->where('kode', $kode)
                ->delete();
            DB::table('purchasing')
                ->where('db_marketing', $kode)
                ->delete();

            aksi_dbmarketing::where('kd_perusahaan', $kode)->delete();

            $log = new log_sistem();
            $log->transaksi = "DB Marketing " . $kode;
            $log->user      = $request->user;
            $log->keterangan = "Hapus Data DB Marketing";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
