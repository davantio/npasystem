<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\kode_akuntansi;
use App\Models\invoice;
use App\Models\log_sistem;

class KodeAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = kode_akuntansi::orderBy('no_group', 'ASC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('group', function ($data) {
                if ($data->no_group == 1) {
                    return "Kas";
                } elseif ($data->no_group == 2) {
                    return "Bank";
                } elseif ($data->no_group == 3) {
                    return "Deposito";
                } elseif ($data->no_group == 4) {
                    return "Piutang Usaha";
                } elseif ($data->no_group == 5) {
                    return "Piutang LainLain";
                } elseif ($data->no_group == 6) {
                    return "Uang Muka Pembelian";
                } elseif ($data->no_group == 7) {
                    return "Uang Muka Pembelian";
                } elseif ($data->no_group == 8) {
                    return "Pajak Dibayar Dimuka";
                } elseif ($data->no_group == 9) {
                    return "Persediaan";
                } elseif ($data->no_group == 10) {
                    return "Aktiva Tetap";
                } elseif ($data->no_group == 11) {
                    return "Aktiva Tetap";
                } elseif ($data->no_group == 12) {
                    return "Akumulasi Penyusutan";
                } elseif ($data->no_group == 13) {
                    return "Hutang Usaha";
                } elseif ($data->no_group == 14) {
                    return "Hutang Usaha";
                } elseif ($data->no_group == 141) {
                    return "Hutang Lain-lain";
                } elseif ($data->no_group == 15) {
                    return "Hutang Biaya";
                } elseif ($data->no_group == 16) {
                    return "Hutang Lainnya";
                } elseif ($data->no_group == 17) {
                    return "Hutang Pajak";
                } elseif ($data->no_group == 18) {
                    return "Laba Ditahan";
                } elseif ($data->no_group == 19) {
                    return "Uang Muka Penjualan";
                } elseif ($data->no_group == 20) {
                    return "Modal";
                } elseif ($data->no_group == 21) {
                    return "Penjualan";
                } elseif ($data->no_group == 22) {
                    return "Penjualan";
                } elseif ($data->no_group == 23) {
                    return "Biaya Karyawan";
                } elseif ($data->no_group == 24) {
                    return "Biaya General/Operasional";
                } elseif ($data->no_group == 25) {
                    return "Biaya Pembelian/ Perolehan";
                } elseif ($data->no_group == 26) {
                    return "Biaya Penjualan";
                } elseif ($data->no_group == 27) {
                    return "Pendapatan Lain-Lain";
                } elseif ($data->no_group == 28) {
                    return "Beban Lain-Lain";
                } else {
                    return "";
                }
            })
            ->addColumn('action', function ($data) {
                return "
            <button type='button' class='btn btn-default'>Action</button>
            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->kode'  data-target='#modal-hapus'><b>Hapus</b></a>
            </div>
            ";
            })->make(true);
    }
    public function kodeakun()
    {
        try {
            $data = "haii";
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
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
        try {

            $cek = kode_akuntansi::select('kode')->where('kode', $request->kode)->first();
            if ($cek == null) {

                $data = new kode_akuntansi();
                $data->kode = $request->kode;
                $data->nama_perkiraan = $request->nama;
                $data->jenis = $request->jenis;
                $data->no_group = $request->group;
                $data->nomor = $request->nomor;
                $data->no_urut_group = $request->urutan1;
                $data->no_urut_laporan = $request->urutan2;
                $data->jenis_laporan = $request->laporan;
                $data->group_laporan = $request->glaporan;
                $data->keterangan = $request->keterangan;
                $data->save();

                $log = new log_sistem();
                $log->transaksi = $request->kode;
                $log->user = $request->user;
                $log->keterangan = "Tambah Data Kode Akuntansi";
                $log->save();
                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } else {
                return response()->json(['success' => false, 'pesan' => 'Kode Akuntansi Sudah Digunakan']);
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
    public function dropdownakun(Request $request)
    {
        try {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('nama_perkiraan', 'LIKE', "$search%")
                    ->orWhere('kode', 'LIKE', "$search%")
                    ->get();
            } else {
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->get();
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function dropdownkas(Request $request)
    {
        try {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', '10%')
                    ->orWhere('kode', "330")
                    ->where('nama_perkiraan', 'LIKE', "%$search")
                    ->get();
            } else {
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', "10%")
                    ->orWhere('kode', "330")
                    ->get();
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function dropdownuangmasuk(Request $request)
    {
        try {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('nama_perkiraan', 'LIKE', 'pendapatan%')
                    ->orWhere('nama_perkiraan', 'LIKE', "modal%")
                    ->orWhere('kode', 'LIKE', "12%")
                    ->orWhere('kode', 'LIKE', "4%")
                    ->orWhere('kode', 'LIKE', "31%")
                    ->where('nama_perkiraan', 'LIKE', "%$search")
                    ->get();
            } else {
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('nama_perkiraan', 'LIKE', "pendapatan%")
                    ->orWhere('nama_perkiraan', 'LIKE', "modal%")
                    ->orWhere('kode', 'LIKE', "12%")
                    ->orWhere('kode', 'LIKE', "4%")
                    ->orWhere('kode', 'LIKE', "31%")
                    ->get();

                $data1 = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('nama_perkiraan', 'LIKE', "modal%")
                    ->get();
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function dropdownuangkeluar(Request $request)
    {
        try {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', "50%")
                    ->where('nama_perkiraan', 'LIKE', "%$search")
                    ->get();
            } else {
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', "50%")
                    ->get();
                $data1 = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('nama_perkiraan', 'LIKE', "modal%")
                    ->get();
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function dropdownkodeaset(Request $request)
    {
        try {
            $data = [];
            if ($request->has('q')) {
                $search = $request->q;
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', "25%")
                    ->where('nama_perkiraan', 'LIKE', "%$search")
                    ->get();
            } else {
                $data = kode_akuntansi::select('kode', 'nama_perkiraan')
                    ->where('kode', 'LIKE', "25%")
                    ->get();
            }
            $n = 0;
            foreach ($data as $d) {
                if ($d->kode == 25) {
                    unset($data[$n]);
                } else {
                }
                $n++;
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function  akundebit(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = kode_akuntansi::select("kode", "nama_perkiraan")
                ->where('jenis', 'D')
                ->where('nama_perkiraan', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = kode_akuntansi::select("kode", "nama_perkiraan")
                ->where('jenis', 'D')
                ->get();
        }
        return response()->json($data);
    }
    public function  akunkredit(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = kode_akuntansi::select("kode", "nama_perkiraan")
                ->where('jenis', 'K')
                ->where('nama_perkiraan', 'LIKE', "%$search%")
                ->get();
        } else {
            $data = kode_akuntansi::select("kode", "nama_perkiraan")
                ->where('jenis', 'K')
                ->get();
        }
        return response()->json($data);
    }
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
            $data = kode_akuntansi::where('kode', $id)->first();
            if ($data->no_group == 1) {
                $data->group =  "Kas";
            } elseif ($data->no_group == 2) {
                $data->group = "Bank";
            } elseif ($data->no_group == 3) {
                $data->group = "Deposito";
            } elseif ($data->no_group == 4) {
                $data->group = "Piutang Usaha";
            } elseif ($data->no_group == 5) {
                $data->group = "Piutang LainLain";
            } elseif ($data->no_group == 6) {
                $data->group = "Uang Muka Pembelian";
            } elseif ($data->no_group == 7) {
                $data->group = "Uang Muka Pembelian";
            } elseif ($data->no_group == 8) {
                $data->group = "Pajak Dibayar Dimuka";
            } elseif ($data->no_group == 9) {
                $data->group = "Persediaan";
            } elseif ($data->no_group == 10) {
                $data->group = "Aktiva Tetap";
            } elseif ($data->no_group == 11) {
                $data->group = "Aktiva Tetap";
            } elseif ($data->no_group == 12) {
                $data->group = "Akumulasi Penyusutan";
            } elseif ($data->no_group == 13) {
                $data->group = "Hutang Usaha";
            } elseif ($data->no_group == 14) {
                $data->group = "Hutang Usaha";
            } elseif ($data->no_group == 141) {
                $data->group = "Hutang Lain-Lain";
            } elseif ($data->no_group == 15) {
                $data->group = "Hutang Biaya";
            } elseif ($data->no_group == 16) {
                $data->group = "Hutang Lainnya";
            } elseif ($data->no_group == 17) {
                $data->group = "Hutang Pajak";
            } elseif ($data->no_group == 18) {
                $data->group = "Laba Ditahan";
            } elseif ($data->no_group == 19) {
                $data->group = "Uang Muka Penjualan";
            } elseif ($data->no_group == 20) {
                $data->group = "Modal";
            } elseif ($data->no_group == 21) {
                $data->group = "Penjualan";
            } elseif ($data->no_group == 22) {
                $data->group = "Penjualan";
            } elseif ($data->no_group == 23) {
                $data->group = "Biaya Karyawan";
            } elseif ($data->no_group == 24) {
                $data->group = "Biaya General/Operasional";
            } elseif ($data->no_group == 25) {
                $data->group = "Biaya Pembelian/ Perolehan";
            } elseif ($data->no_group == 26) {
                $data->group = "Biaya Penjualan";
            } elseif ($data->no_group == 24) {
                $data->group = "Pendapatan Lain-Lain";
            } elseif ($data->no_group == 24) {
                $data->group = "Beban Lain-Lain";
            } else {
                $data->group = "";
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => 'Data Tidak Ditemukan']);
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
            DB::table('kodeakuntansi')
                ->where('kode', $kode)
                ->update([
                    'nama_perkiraan' => $request->nama,
                    'jenis' => $request->jenis,
                    'no_group' => $request->group,
                    'nomor' => $request->nomor,
                    'no_urut_group' => $request->urutan1,
                    'no_urut_laporan' => $request->urutan2,
                    'jenis_laporan' => $request->laporan,
                    'group_laporan' => $request->glaporan,
                    'keterangan' => $request->keterangan,
                ]);
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Update Data Kode Akuntansi";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diupdate']);
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
            kode_akuntansi::where('kode', $kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Kode Akuntansi";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
