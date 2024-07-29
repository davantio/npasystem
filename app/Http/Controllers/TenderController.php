<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\tender_barang;
use App\Models\tender_dokumen;
use App\Models\tender_history;
use App\Models\tender_instansi;
use App\Models\tender_pejabat;
use App\Models\tender;
use App\Models\log_sistem;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;
use Throwable;

class TenderController extends Controller
{
    public function index()
    {
        $login = Auth::user();
        if ($login) {
            // $data = tender::select('tender.*','tender_instansi.nama AS instansi')->join('tender_instansi','tender.instansi','=','tender_instansi.id')->orderBy('tender.updated_at','DESC')->get();
            $data = tender::orderBy('updated_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('instansi', function ($data) {
                    $instansi = tender_instansi::where('id', $data->instansi)->first();
                    if ($instansi) {
                        return $instansi;
                    } else {
                        return "";
                    }
                })
                ->editColumn('jenis', function ($data) {
                    if ($data->jenis == "terbuka") {
                        return "Terbuka";
                    } else {
                        return "Tertutup";
                    }
                })

                ->editColumn('pendaftaran', function ($data) {
                    $tanggalBaru = Carbon::createFromFormat('Y-m-d', $data->pendaftaran)->isoFormat('D MMMM YYYY');
                    return $tanggalBaru;
                })
                ->addColumn('barang', function ($data) {
                    $barang = tender_barang::select('nama')->where('tender_id', $data->id)->get();
                    return $barang;
                })
                ->addColumn('qty', function ($data) {
                    $qty = tender_barang::select('qty', 'satuan')->where('tender_id', $data->id)->get();
                    return $qty;
                })
                ->addColumn('hps', function ($data) {
                    $hps = tender_barang::select('hps')->where('tender_id', $data->id)->get();
                    if ($hps) {
                        return $hps;
                    } else {
                        return "";
                    }
                })
                ->addColumn('harga', function ($data) {
                    $barang = tender_barang::select('harga')->where('tender_id', $data->id)->get();
                    if ($barang) {
                        return $barang;
                    } else {
                        return "";
                    }
                })
                ->addColumn('ongkir', function ($data) {
                    $barang = tender_barang::select('ongkir')->where('tender_id', $data->id)->get();
                    if ($barang) {
                        return $barang;
                    } else {
                        return "";
                    }
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "-") {
                        // Tanggal yang akan dibandingkan
                        $tanggalBanding = Carbon::createFromFormat('Y-m-d', $data->pendaftaran);

                        // Tanggal sekarang
                        $tanggalSekarang = Carbon::now();

                        // Memeriksa apakah tanggal sekarang melebihi tanggal yang ditentukan
                        if ($tanggalSekarang->gt($tanggalBanding)) {
                            // Jika tanggal sekarang melebihi tanggal yang ditentukan
                            $data->status = "Tidak Ikut";
                        } else {
                            // Jika tanggal sekarang tidak melebihi tanggal yang ditentukan

                        }
                    } else {
                    }
                    return $data->status;
                })
                ->addColumn('dokumen', function ($data) {
                    $dokumen = tender_dokumen::where('tender_id', $data->id)->get();

                    return $dokumen;
                })
                ->addColumn('kompetitor', function ($data) {
                    // $history = tender_history::where('tender_id',$data->id)->get();
                    // $count = tender_history::where('tender_id',$data->id)->count();
                    // $kompetitor = "";
                    // if($count > 0){
                    //     foreach($history AS $h){
                    //         $kompetitor = $h->perusahaan." - "."Rp. ".number_format($h->harga,2,',','.')."<br>" ;
                    //     }
                    //     return $kompetitor;
                    // } else {
                    //     return $kompetitor;
                    // }
                    $history = tender_history::where('tender_id', $data->id)->get();

                    return $history;
                })

                ->addColumn('action', function ($data) {
                    return "
                <div class='row'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>

                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                </div>
                <div class='row'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>

                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item status text-warning' data-toggle='modal' data-kode='$data->id' data-nama='$data->nama' data-awal='$data->status' data-status='Mengikuti' data-target='#modal-status'><b>Mengikuti</b></a>
                        <a class='dropdown-item status text-success'  data-toggle='modal' data-kode='$data->id' data-nama='$data->nama' data-awal='$data->status' data-status='Berhasil' data-target='#modal-status'><b>Berhasil</b></a>
                        <a class='dropdown-item status text-danger' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-awal='$data->status' data-status='Gugur' data-target='#modal-status'><b>Gugur</b></a>
                        <a class='dropdown-item status text-danger'  data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-awal='$data->status' data-status='Tidak Ikut' data-target='#modal-status'><b>Tidak Ikut</b></a>
                    </div>
                </div>
                ";
                })
                ->addColumn('total', function ($data) {
                    $total = tender_barang::select(DB::raw("SUM(qty*hps) as total"))->where('tender_id', $data->id)->first();
                    return "Rp. " . number_format($total->total, 2, ',', '.');
                })->make(true);
        } else {
        }
    }
    public function dropdowninstansi()
    {
    }

    public function ubahstatus($id, Request $request)
    {
        try {
            $login = Auth::user();
            $simpan =
                DB::table('tender')->where('id', $id)
                ->update([
                    'status'          => $request->status,
                ]);;
            if ($simpan) {
                $log = new log_sistem();
                $log->transaksi = $id;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Ubah Status Tender";
                $resultlog = $log->save();
                if ($resultlog) {
                    return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Simpan Log"]);
                }
            } else {
                return response()->json(['success' => false, 'pesan' => "Error Ubah Status Tender"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function store(Request $request)
    {
        try {
            $login = Auth::user();
            if ($login) {
                $last = tender::select('id')->orderBy('id', 'DESC')->first();
                if (!$last) {
                    $nkode = 1;
                } else {
                    $nkode = $last->id + 1;
                }

                $tender = new tender();
                $tender->id = $nkode;
                $tender->instansi = $request->instansi;
                $tender->nama = $request->tender;
                $tender->lokasi = $request->lokasi;
                $tender->perusahaan = $request->perusahaan;
                $tender->jenis = $request->jenis;
                $tender->skala = $request->skala;
                $tender->pendaftaran = $request->deadline;
                $tender->pic = $request->pic;
                $tender->status =  "-";
                $save = $tender->save();
                if ($save) {
                    if ($request->barang == null) {
                    } else {
                        foreach ($request->barang as $data) {
                            $barang = new tender_barang();
                            $barang->tender_id = $nkode;
                            $barang->nama = $data['nama'];
                            $barang->qty = $data['qty'];
                            $barang->satuan = $data['satuan'];
                            $barang->hps = $data['hps'];
                            $barang->harga = $data['harga'];
                            $barang->ongkir = $data['ongkir'];
                            $barang->kegunaan = $data['kegunaan'];
                            $barang->spec = $data['spec'];
                            $sbarang = $barang->save();
                        }
                    }
                    if ($request->dokumen == null) {
                    } else {
                        foreach ($request->dokumen as $doc) {
                            $dokumen = new tender_dokumen();
                            $dokumen->tender_id = $nkode;
                            $dokumen->nama = $doc['nama'];
                            $dokumen->keterangan = $doc['keterangan'];
                            $dokumen->siap = $doc['siap'];
                            $sdokumen = $dokumen->save();
                        }
                    }

                    if ($request->pesaing == null) {
                    } else {
                        foreach ($request->pesaing as $hist) {
                            $pesaing = new tender_history();
                            $pesaing->tender_id = $nkode;
                            $pesaing->tender = $hist['tender'];
                            $pesaing->perusahaan = $hist['perusahaan'];
                            $pesaing->keterangan = $hist['keterangan'];
                            $pesaing->harga = $hist['harga'];
                            $pesaing->menang = $hist['menang'];
                            $spesaing = $pesaing->save();
                        }
                    }



                    return response()->json(['success' => true, 'pesan' => "Data Berhasil Ditambahkan"]);
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Save Tender"]);
                }
            } else {
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $login = Auth::user();

        if ($login) {
            // $data = tender::select('tender.*','tender_instansi.nama AS instansi')->join('tender_instansi','tender.instansi','=','tender_instansi.id')->orderBy('tender.updated_at','DESC')->get();
            $data = tender::where('instansi', $id)->orderBy('updated_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('instansi', function ($data) {
                    $instansi = tender_instansi::where('id', $data->instansi)->first();
                    if ($instansi) {
                        return $instansi;
                    } else {
                        return "";
                    }
                })
                ->editColumn('jenis', function ($data) {
                    if ($data->jenis == "terbuka") {
                        return "Terbuka";
                    } else {
                        return "Tertutup";
                    }
                })

                ->editColumn('pendaftaran', function ($data) {
                    $tanggalBaru = Carbon::createFromFormat('Y-m-d', $data->pendaftaran)->isoFormat('D MMMM YYYY');
                    return $tanggalBaru;
                })
                ->addColumn('barang', function ($data) {
                    $barang = tender_barang::select('nama')->where('tender_id', $data->id)->get();
                    return $barang;
                })
                ->addColumn('qty', function ($data) {
                    $qty = tender_barang::select('qty', 'satuan')->where('tender_id', $data->id)->get();
                    return $qty;
                })
                ->addColumn('hps', function ($data) {
                    $hps = tender_barang::select('hps')->where('tender_id', $data->id)->get();
                    if ($hps) {
                        return $hps;
                    } else {
                        return "";
                    }
                })
                ->addColumn('harga', function ($data) {
                    $barang = tender_barang::select('harga')->where('tender_id', $data->id)->get();
                    if ($barang) {
                        return $barang;
                    } else {
                        return "";
                    }
                })
                ->addColumn('ongkir', function ($data) {
                    $barang = tender_barang::select('ongkir')->where('tender_id', $data->id)->get();
                    if ($barang) {
                        return $barang;
                    } else {
                        return "";
                    }
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "-") {
                        // Tanggal yang akan dibandingkan
                        $tanggalBanding = Carbon::createFromFormat('Y-m-d', $data->pendaftaran);

                        // Tanggal sekarang
                        $tanggalSekarang = Carbon::now();

                        // Memeriksa apakah tanggal sekarang melebihi tanggal yang ditentukan
                        if ($tanggalSekarang->gt($tanggalBanding)) {
                            // Jika tanggal sekarang melebihi tanggal yang ditentukan
                            $data->status = "Tidak Ikut";
                        } else {
                            // Jika tanggal sekarang tidak melebihi tanggal yang ditentukan

                        }
                    } else {
                    }
                    return $data->status;
                })
                ->addColumn('dokumen', function ($data) {
                    $dokumen = tender_dokumen::where('tender_id', $data->id)->get();
                    return $dokumen;
                })
                ->addColumn('kompetitor', function ($data) {
                    // $history = tender_history::where('tender_id',$data->id)->get();
                    // $count = tender_history::where('tender_id',$data->id)->count();
                    // $kompetitor = "";
                    // if($count > 0){
                    //     foreach($history AS $h){
                    //         $kompetitor = $h->perusahaan." - "."Rp. ".number_format($h->harga,2,',','.')."<br>" ;
                    //     }
                    //     return $kompetitor;
                    // } else {
                    //     return $kompetitor;
                    // }
                    $history = tender_history::where('tender_id', $data->id)->get();

                    return $history;
                })

                ->addColumn('action', function ($data) {
                    return "
                <div class='row' style='margin-bottom:5px'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>

                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                </div>
                <div class='row'>
                    <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>

                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item status text-warning' data-toggle='modal' data-kode='$data->id' data-nama='$data->nama' data-warna='bg-warning' data-awal='$data->status' data-status='Mengikuti' data-target='#modal-status'><b>Mengikuti</b></a>
                        <a class='dropdown-item status text-success'  data-toggle='modal' data-kode='$data->id' data-nama='$data->nama' data-warna='bg-success' data-awal='$data->status' data-status='Berhasil' data-target='#modal-status'><b>Berhasil</b></a>
                        <a class='dropdown-item status text-danger' data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-warna='bg-danger' data-awal='$data->status' data-status='Gugur' data-target='#modal-status'><b>Gugur</b></a>
                        <a class='dropdown-item status text-danger'  data-toggle='modal'  data-kode='$data->id' data-nama='$data->nama' data-warna='bg-danger' data-awal='$data->status' data-status='Tidak Ikut' data-target='#modal-status'><b>Tidak Ikut</b></a>
                    </div>
                </div>
                ";
                })
                ->addColumn('total', function ($data) {
                    $total = tender_barang::select(DB::raw("SUM(qty*hps) as total"))->where('tender_id', $data->id)->first();
                    return "Rp. " . number_format($total->total, 2, ',', '.');
                })->make(true);
        } else {
        }
    }
    public function edit($id)
    {
        try {
            $data = tender::where('id', $id)->first();
            $instansi = tender_instansi::where('id', $data->instansi)->first();

            $data->namainstansi = $instansi->nama;
            $data->subinstansi = $instansi->sub_instansi;
            $data->link = $instansi->link;
            $data->email = $instansi->email;
            $pejabat = tender_pejabat::where('id', $data->pic)->first();
            if ($pejabat === null) {
                $data->namapic = "";
                $data->cp = "";
            } else {
                $data->namapic = $pejabat->nama;
                $data->cp = $pejabat->telp;
            }


            $barang = tender_barang::where('tender_id', $id)->get();
            foreach ($barang as $d) {
                $d->status = "-";
            }
            $dokumen = tender_dokumen::where('tender_id', $id)->get();
            foreach ($dokumen as $d) {
                $d->status = "-";
            }
            $history = tender_history::where('tender_id', $id)->get();
            foreach ($history as $d) {
                $d->status = "-";
            }
            return response()->json(['success' => true, 'tender' => $data, 'barang' => $barang, 'dokumen' => $dokumen, 'pesaing' => $history]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $login = Auth::user();

            $tender =
                DB::table('tender')->where('id', $id)
                ->update([
                    'perusahaan' => $request->perusahaan,
                    'jenis'     => $request - jenis,
                    'instansi'  => $request->instansi,
                    'nama'      => $request->tender,
                    'pendaftaran' => $request->deadline,
                    'skala'     => $request->skala,
                    'lokasi'    => $request->lokasi,
                    'pic'       => $request->pic
                ]);
            foreach ($request->barang as $brg) {
                if ($brg['status'] == "tambah") {
                    $bar = new tender_barang();
                    $bar->tender_id = $id;
                    $bar->nama = $brg['nama'];
                    $bar->qty = $brg['qty'];
                    $bar->satuan = $brg['satuan'];
                    $bar->hps = $brg['hps'];
                    $bar->harga = $brg['harga'];
                    $bar->kegunaan = $brg['kegunaan'];
                    $bar->spec = $brg['spec'];
                    $bar->save();
                } else if ($brg['status'] == "edit") {
                    DB::table('tender_barang')->where('id', $brg['id'])->update([
                        'nama'      => $brg['nama'],
                        'qty'       => $brg['qty'],
                        'satuan'    => $brg['satuan'],
                        'hps'       => $brg['hps'],
                        'harga'     => $brg['harga'],
                        'kegunaan'  => $brg['kegunaan'],
                        'spec'      => $brg['spec']
                    ]);
                } else if ($brg['status'] == "hapus") {
                    $hapus = tender_barang::where('id', $brg['id'])->delete();
                } else {
                }
            }
            foreach ($request->dokumen as $doc) {
                if ($doc['status'] == "tambah") {
                    $dokumen = new tender_dokumen();
                    $dokumen->tender_id = $id;
                    $dokumen->nama = $doc['nama'];
                    $dokumen->keterangan = $doc['keterangan'];
                    $dokumen->siap = $doc['siap'];
                    $sdokumen = $dokumen->save();
                } else if ($doc['status'] == "edit") {
                    DB::table('tender_dokumen')->where('id', $brg['id'])->update([
                        'nama'      => $doc['nama'],
                        'keterangan' => $doc['keterangan'],
                        'siap'      => $doc['siap']
                    ]);
                } else if ($doc['status'] == "hapus") {
                    $hapus = tender_dokumen::where('id', $doc['id'])->delete();
                } else {
                }
            }
            foreach ($request->history as $his) {
                if ($his['status'] == "tambah") {
                    $pesaing = new tender_history();
                    $pesaing->tender_id = $id;
                    $pesaing->tender = $his['tender'];
                    $pesaing->perusahaan = $his['perusahaan'];
                    $pesaing->keterangan = $his['keterangan'];
                    $pesaing->harga = $his['harga'];
                    $pesaing->menang = $his['menang'];
                    $pesaing->save();
                } else if ($his['status'] == "edit") {
                    DB::table('tender_history')->where('id', $brg['id'])->update([
                        'tender'    => $his['tender'],
                        'perusahaan' => $his['perusahaan'],
                        'keterangan' => $his['keterangan'],
                        'harga'     => $his['harga'],
                        'menang'    => $his['menang']
                    ]);
                } else if ($his['status'] == "hapus") {
                    $hapus = tender_history::where('id', $his['id'])->delete();
                } else {
                }
            }
            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $login = Auth::user();
            if ($login) {
                tender::where('id', $id)->delete();
                tender_barang::where('tender_id', $id)->delete();
                tender_dokumen::where('tender_id', $id)->delete();
                tender_history::where('tender_id', $id)->delete();

                $log = new log_sistem();
                $log->transaksi = $id;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Hapus Data Tender";
                $resultlog = $log->save();
                if ($resultlog) {
                    return response()->json(['success' => true, 'pesan' => "Data Berhasil Dihapus"]);
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Simpan Log"]);
                }
            } else {
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
