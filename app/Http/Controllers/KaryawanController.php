<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\gudang;
use App\Models\log_sistem;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = karyawan::select('karyawan.*', 'users.level as userlevel')
            ->join('users', 'karyawan.kode', '=', 'users.kode_karyawan')
            ->orderBy('karyawan.kode');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                if ($data->status == "Aktif") {
                    return "
                    <div class='row'>
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Action</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail-karyawan'><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-karyawan'><b>Edit</b></a>
                            <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-target='#modal-hapus-karyawan'><b>Hapus</b></a>
                        </div>
                    </div>
                    <div class='row'>
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item status text-danger' data-toggle='modal' data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-status='Resign' data-target='#modal-status'><b>Resign</b></a>
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
                            <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail-karyawan'><b>Detail</b></a>
                            <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-karyawan'><b>Edit</b></a>
                            <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-target='#modal-hapus-karyawan'><b>Hapus</b></a>
                        </div>
                    </div>
                    <div class='row'>
                        <button type='button' class='btn btn-default' data-toggle='dropdown'>Status</button>
                        <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item status text-success' data-toggle='modal' data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-status='Aktif'  data-target='#modal-status'><b>Aktif</b></a>
                        </div>
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
    public function dropdownsales(Request $request, $data)
    {
        $marketing = [];
        if ($request->has('q')) {
            $search = $request->q;
            $marketing = karyawan::select("karyawan.kode", "karyawan.nama")
                ->join('users', 'karyawan.kode', '=', 'users.kode_karyawan')
                ->where('users.level', 'marketing')
                ->where('perusahaan', $data)
                ->orWhere('users.level', 'manager-marketing')
                ->orWhere('users.level', 'ceo')
                ->where('perusahaan', $data)
                ->where('karyawan.status', 'Aktif')
                ->where('karyawan.nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $marketing = karyawan::select("karyawan.kode", "karyawan.nama")
                ->join('users', 'karyawan.kode', '=', 'users.kode_karyawan')
                ->where('users.level', 'marketing')
                ->where('perusahaan', $data)
                ->where('karyawan.status', 'Aktif')
                ->orWhere('users.level', 'manager-marketing')
                ->orWhere('users.level', 'ceo')
                ->get();

            $new = ['kode' => "ALL", 'nama' => "ALL"];
            $marketing->push($new);
        }
        return response()->json($marketing);
    }
    public function dropdownmarketing(Request $request)
    {

        $marketing = [];
        if ($request->has('q')) {
            $search = $request->q;
            $marketing = karyawan::select("karyawan.kode", "karyawan.nama")
                ->join('users', 'karyawan.kode', '=', 'users.kode_karyawan')
                ->where('users.level', 'marketing')
                ->orWhere('users.level', 'manager-marketing')
                ->orWhere('users.level', 'ceo')
                ->where('karyawan.status', 'Aktif')
                ->where('karyawan.nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $marketing = karyawan::select("karyawan.kode", "karyawan.nama")
                ->join('users', 'karyawan.kode', '=', 'users.kode_karyawan')
                ->where('users.level', 'marketing')
                ->where('karyawan.status', 'Aktif')
                ->orWhere('users.level', 'manager-marketing')
                ->orWhere('users.level', 'ceo')
                ->get();
            $new = ['kode' => "ALL", 'nama' => "ALL"];
            $marketing->push($new);
        }
        return response()->json($marketing);
    }
    public function create($data)
    {
        //

    }
    public function ubah_status(Request $request, $kode)
    {
        try {
            $login = Auth::user();
            $data = karyawan::where('kode', $kode)->first();
            if ($data) {
                // return response()->json(['success'=>false,'pesan'=>$data]);
                $simpan = DB::table('karyawan')->where('kode', $kode)->update([
                    'status' => $request->status,
                ]);
                if ($simpan) {
                    return response()->json(['success' => true, 'pesan' => "Status Berhasil Diubah"]);
                } else {
                    return response()->json(['success' => false, 'pesan' => "Error Ubah Status Karyawan"]);
                }
                // DB::table('karyawan')->where('kode',$kode)
                // ->update([
                //     'status'=>$request->status,
                //     ]);

                // // $data->status = $request->status;
                // // $simpan = $data->save();
                // if($simpan){
                //     $log = new log_sistem();
                //     $log->transaksi = "karyawan.".$kode;
                //     $log->user = $login->kode_karyawan;
                //     $log->keterangan = "Ubah Status Karyawan";
                //     $log->save();
                // return response()->json(['success'=>true,'pesan'=>"Status Berhasil Diubah"]);
                // } else {
                //     return response()->json(['success'=>false,'pesan'=>"Error Ubah Status Karyawan"]);
                // }
            } else {
                return response()->json(['success' => false, 'pesan' => "Data Tidak Ditemukan"]);
            }
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


            $validatedData = $request->validate([
                'tambah_foto' => 'required|image|max:5000'
            ]);
            $login = Auth::user();
            $username = User::select('username')->where('username', $request->tambah_username_karyawan)->first();
            if ($username == null) {
                $lastkode = karyawan::max('kode');
                if ($lastkode == null) {
                    $new = "NPA.0001";
                } else {
                    $ls = substr($lastkode, 4, 4);
                    $nwls = $ls + 1;
                    $new = "NPA." . sprintf('%04s', $nwls);
                }

                $pwd = bcrypt($request->tambah_pwd_karyawan);

                $karyawan = new Karyawan;
                $karyawan->kode = $new;
                $karyawan->perusahaan = $request->tambah_pt;
                $karyawan->nama = $request->tambah_nama_karyawan;
                $karyawan->ttl = $request->tambah_tgl_karyawan;
                $karyawan->telp = $request->tambah_telp_karyawan;
                $karyawan->alamat = $request->tambah_alamat_karyawan;
                $karyawan->divisi = $request->tambah_divisi_karyawan;
                $karyawan->lokasi = $request->tambah_penempatan_karyawan;
                $karyawan->status = "Aktif";
                if ($request->hasFile('tambah_foto')) {
                    $foto = $request->file('tambah_foto');
                    $nama_foto = $foto->getClientOriginalName();
                    $file = public_path('img/karyawan/' . $nama_foto);
                    if (file_exists($file)) {
                        return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                    } else {
                        $foto->move(public_path('img/karyawan'), $nama_foto);
                        $karyawan->foto = $nama_foto;
                    }
                }
                $karyawan->save();

                $users = new User;
                $users->username = $request->tambah_username_karyawan;
                $users->level = $request->tambah_role_karyawan;
                $users->kode_karyawan = $new;
                $users->password = $pwd;
                $users->save();

                $log = new log_sistem();
                $log->transaksi = $new;
                $log->user = $login->kode_karyawan;
                $log->keterangan = "Tambah Data Karyawan";
                $log->save();

                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Ditambahkan']);
            } else {
                return response()->json(['success' => false, 'pesan' => 'Username Sudah dipakai']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }

        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubahpassword(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'old_password' => ['required', new MatchOldPassword],
                'new_password' => ['required', 'min:8'],
            ]);
            if ($request->new_password == $request->confirm_password) {
                $user->update([
                    'password' => bcrypt($request->new_password),
                ]);
                return response()->json(['success' => true, 'pesan' => "Data berhasil Ditambahkan"]);
            } else {
                return response()->json(['success' => false, 'pesan' => "Password Baru Tidak Sama"]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        //
    }
    public function cek_lokasi()
    {
        try {
            $ip = $_SERVER['REMOTE_ADDR'];

            //Meng-Encode string JSON dan mengkonversi ke variable PHP

            //Menggunakan Plugin dari http://www.geoplugin.net/json.gp
            $ipdat = @json_decode(file_get_contents(
                "http://www.geoplugin.net/json.gp?ip=" . $ip
            ));

            return response()->json(['success' => true, 'data' => $ipdat]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function prosesabsensi(Request $request)
    {
        try {
            $ip = $_SERVER['REMOTE_ADDR'];

            //Meng-Encode string JSON dan mengkonversi ke variable PHP

            //Menggunakan Plugin dari http://www.geoplugin.net/json.gp
            $ipdat = @json_decode(file_get_contents(
                "http://www.geoplugin.net/json.gp?ip=" . $ip
            ));
            return response()->json(['success' => true, 'data' => $ipdat]);
            // $user = $request->userAgent();
            // $IP = $request->ip;
            // $data['user']=$request->device;
            // $data['ip'] = $IP;
            // return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function cekusername($request)
    {
        try {
            $username = User::select('username')->where('username', $request->edit_username_karyawan)->first();
            if ($username == null) {
                if ($request->edt_pwd_lama == $request->edt_pwd_baru) {
                } else {
                    return response()->json(['success' => false, 'pesan' => "Password Lama Tidak Sesuai"]);
                }
            } else {
                return response()->json(['success' => false, 'pesan' => 'Username Sudah Digunakan']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
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
            $data = karyawan::where('kode', $kode)->first();
            $user = user::where('kode_karyawan', $kode)->first();
            // $data = karyawan::select('karyawan.*','users.*')->join('users','karyawan.kode','=','users.kode_karyawan')->where('karyawan.kode',$kode)->first();
            $gudang = gudang::select('nama')->where('kode', $data->lokasi)->first();
            if ($user) {
                $data->username = $user->username;
                $data->level = $user->level;
            } else {
                $data->username = '';
                $data->level = '';
            }
            switch ($data->perusahaan) {
                case 'NPA':
                    $data->perusahaan = "CV. Nusa Pratama Anugrah";
                    break;
                case 'HERBIVOR':
                    $data->perusahaan = "PT. Herbivor Satu Nusa";
                    break;
                case 'HERBIVOR':
                    $data->perusahaan = "PT. Triputra Sinergi Indonesia";
                    break;
                case 'ALL':
                    $data->perusahaan = "Nusa Group";
                    break;
            }
            $data->namalokasi = $gudang->nama;
            $data->foto = "/img/karyawan/" . $data->foto;
            return response()->json(['success' => true, 'result' => $data]);
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
    public function ubah(Request $request, $kode)
    {
        try {
            $validatedData = $request->validate([
                'edit_foto' => 'image|max:5000',

            ]);
            $user = Auth::user();
            $data = User::where('kode_karyawan', $kode)->first();
            if ($request->edit_username == $data->username) {
                return response()->json(['success' => false, 'pesan' => "YA"]);
            } else {
                //Cek Username
                $cek = User::where('username', $request->edit_username)->first();
                if ($cek) {
                    return response()->json(['success' => false, 'pesan' => "Username sudah tersedia, silahkan ganti menjadi nama lainnya"]);
                } else {
                    // JIKA GANTI PASSWORD

                    // ubah password
                    if (!Hash::check($request->edit_pwd_lama, $user->password)) {
                        return response()->json(['success' => false, 'pesan' => 'Password lama tidak cocok'], 422);
                    }
                    if (!Hash::check($request->edit_repwd_baru, $request->edit_pwd_baru)) {
                        return response()->json(['success' => false, 'pesan' => 'Password Baru tidak sesuai'], 422);
                    }
                    $new_password = bcrypt($request->edit_pwd_baru);
                    //CEK INPUT FOTO
                    if ($request->hasFile('edit_foto')) {
                    } else {
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $kode)
    {
        try {

            //  $validatedData = $request->validate([
            //     'edit_foto' => 'required|image|max:50000'
            // ]);
            $user = Auth::user();
            $data = karyawan::where('kode', $kode)->first();
            $users = User::where('kode_karyawan', $kode)->first();
            $telp = karyawan::where('telp', $request->edit_telp)->first();
            //Cek edit username
            if ($request->edit_username_karyawan == $users->username) {
                //cek edit_password
                if ($request->edit_password == null) {
                    //cek edit_foto
                    if ($request->hasFile('edit_foto')) {
                        $request->validate([
                            'edit_foto'     => 'image|max:50000'
                        ]);
                        $foto = $request->file('edit_foto');
                        $nama_foto = $foto->getClientOriginalName();
                        $file = public_path('img/karyawan/' . $nama_foto);
                        if (file_exists($file)) {
                            return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                        } else {
                            $file = public_path('img/karyawan/' . $data->foto);
                            if (file_exists($file)) {
                                unlink($file);
                                $pindah = $foto->move(public_path('img/karyawan'), $nama_foto);
                                if ($pindah) {
                                    $update_karyawan = DB::table('karyawan')
                                        ->where('kode', $kode)
                                        ->update([
                                            'nama' => $request->edit_nama,
                                            'ttl' => $request->edit_tgl,
                                            'telp' => $request->edit_telp,
                                            'alamat' => $request->edit_alamat,
                                            'divisi' => $request->edit_divisi,
                                            'lokasi' => $request->edit_penempatan,
                                            'foto' => $nama_foto,
                                        ]);
                                    if ($update_karyawan) {
                                        $update_user = DB::table('users')
                                            ->where('kode_karyawan', $kode)
                                            ->update([
                                                'level' => $request->edit_role,
                                            ]);
                                        if ($update_user) {
                                            $log = new log_sistem();
                                            $log->transaksi = $kode;
                                            $log->user = $user->kode_karyawan;
                                            $log->keterangan = "Edit Data Karyawan";
                                            $save_log = $log->save();
                                            if ($save_log) {
                                                return response()->json(['success' => true, 'pesan' => "Data berhasil Diubah"]);
                                            } else {
                                                return response()->json(['success' => false, 'pesan' => "Error Tambah Log"]);
                                            }
                                        } else {
                                            return response()->json(['succecc' => false, 'pesan' => "Error Update User"]);
                                        }
                                    } else {
                                        return response()->json(['success' => false, 'pesan' => "Error Update Karyawan"]);
                                    }
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "Foto Gagal Disimpan"]);
                                }
                            } else {
                                return response()->json(['success' => false, 'pesan' => "File Foto tidak ditemukan !! Silahkan hubungi admin"]);
                            }
                        }
                    } else {
                        $update = DB::table('karyawan')
                            ->where('kode', $kode)
                            ->update([
                                'nama' => $request->edit_nama,
                                'ttl' => $request->edit_tgl,
                                'telp' => $request->edit_telp,
                                'alamat' => $request->edit_alamat,
                                'divisi' => $request->edit_divisi,
                                'lokasi' => $request->edit_penempatan,
                            ]);
                        // $data->nama = $request->edit_nama;
                        // $data->ttl = $request->edit_tgl;
                        // $data->telp = $request->edit_telp;
                        // $data->alamat = $request->edit_alamat;
                        // $data->divisi = $request->edit_divisi;
                        // $data->lokasi = $request->edit_penempatan;
                        // $update = $data->save();
                        if ($update) {
                            $update_user = DB::table('users')
                                ->where('kode_karyawan', $kode)
                                ->update([
                                    'level' => $request->edit_role,
                                ]);
                            if ($update_user > 0) {
                                $log = new log_sistem();
                                $log->transaksi = $kode;
                                $log->user = $user->kode_karyawan;
                                $log->keterangan = "Edit Data Karyawan";
                                $save_log = $log->save();
                                if ($save_log) {
                                    return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "Error Tambah Log"]);
                                }
                            } else {
                                return response()->json(['success' => false, 'pesan' => "Gagal Update User"]);
                            }
                        } else {
                            return response()->json(['success' => false, 'pesan' => "Gagal Update Karyawan"]);
                        }

                        // if($update_karyawan){
                        //     try{
                        //         $update_user = DB::table('users')
                        //         ->where('kode_karyawan',$kode)
                        //         ->update([
                        //             'level'=>$request->edit_role,
                        //         ]);
                        //         try{
                        //             $log = new log_sistem();
                        //             $log->transaksi = $kode;
                        //             $log->user = $user->kode_karyawan;
                        //             $log->keterangan = "Edit Data Karyawan";
                        //             $save_log = $log->save();
                        //             if($save_log){
                        //                 return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
                        //             } else {
                        //                 return response()->json(['success'=>false,'pesan'=>"Error Tambah Log"]);
                        //             }
                        //         } catch(Exception $e){
                        //             return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
                        //         }
                        //     } catch (Exception $e){
                        //         return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
                        //     }
                        //     // if($update_user){

                        //     //     if($save_log){
                        //     //         return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
                        //     //     } else {
                        //     //         return response()->json(['success'=>false,'pesan'=>"Error Tambah Log"]);
                        //     //     }
                        //     // } else {
                        //     //     return response()->json(['success'=>false,'pesan'=>"Error Update User"]);
                        //     // }
                        // } else {
                        //     return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
                        // }
                        // return response()->json(['success'=>false,'pesan'=>$request->edit_penempatan]);


                    }
                } else {
                    //Proses merubah password
                    if ($request->edit_pwd_baru == $request->edit_repwd_baru) {
                        if ($request->hasFile('edit_foto')) {
                            $request->validate([
                                'edit_password' => [new MatchOldPassword],
                                'edit_pwd_baru' => ['min:8'],
                                'edit_foto'     => 'image|max:50000'
                            ]);
                            $foto = $request->file('edit_foto');
                            $nama_foto = $foto->getClientOriginalName();
                            $file = public_path('img/karyawan/' . $nama_foto);
                            if (file_exists($file)) {
                                return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                            } else {
                                $file = public_path('img/karyawan/' . $data->foto);
                                if (file_exists($file)) {
                                    unlink($file);
                                    $foto->move(public_path('img/karyawan'), $nama_foto);
                                    DB::table('karyawan')
                                        ->where('kode', $kode)
                                        ->update([
                                            'nama' => $request->edit_nama,
                                            'ttl' => $request->edit_tgl,
                                            'telp' => $request->edit_telp,
                                            'alamat' => $request->edit_alamat,
                                            'divisi' => $request->edit_divisi,
                                            'lokasi' => $request->edit_penempatan,
                                            'foto' => $nama_foto,
                                        ]);
                                    DB::table('users')
                                        ->where('kode_karyawan', $kode)
                                        ->update([
                                            'username' => $request->edit_username,
                                            'level' => $request->edit_role,
                                            'password' => bcrypt($request->edit_pwd_baru),
                                        ]);

                                    $log = new log_sistem();
                                    $log->transaksi = $kode;
                                    $log->user = $user->kode_karyawan;
                                    $log->keterangan = "Edit Data Karyawan";
                                    $log->save();

                                    return response()->json(['success' => true, 'pesan' => "Data berhasil Diubah"]);
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "File Foto tidak ditemukan !! Silahkan hubungi admin"]);
                                }
                            }
                        } else {
                            $request->validate([
                                'edit_password' => [new MatchOldPassword],
                                'edit_pwd_baru' => ['min:8'],
                            ]);
                            $update_karyawan = DB::table('karyawan')
                                ->where('kode', $kode)
                                ->update([
                                    'nama' => $request->edit_nama,
                                    'ttl' => $request->edit_tgl,
                                    'telp' => $request->edit_telp,
                                    'alamat' => $request->edit_alamat,
                                    'divisi' => $request->edit_divisi,
                                    'lokasi' => $request->edit_penempatan,
                                ]);
                            if ($update_karyawan) {
                                $update_user = DB::table('users')
                                    ->where('kode_karyawan', $kode)
                                    ->update([
                                        'level' => $request->edit_role,
                                        'password' => bcrypt($request->edit_pwd_baru),
                                    ]);
                                if ($update_user) {
                                    $log = new log_sistem();
                                    $log->transaksi = $kode;
                                    $log->user = $user->kode_karyawan;
                                    $log->keterangan = "Edit Data Karyawan";
                                    $save_log = $log->save();
                                    if ($save_log) {
                                        return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                                    } else {
                                        return response()->json(['success' => false, 'pesan' => "Error Tambah Log"]);
                                    }
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "Error Update User"]);
                                }
                            } else {
                                return response()->json(['success' => false, 'pesan' => "Error Update Karyawan"]);
                            }
                        }
                    } else {
                        return response()->json(['success' => false, 'pesan' => "Password Baru Tidak Sama"]);
                    }
                }
            } else {
                //cek username
                $cek = User::where('username', $request->edit_username_karyawan)->first();
                if (!$cek) {
                    //cek password
                    if ($request->edit_password == null) {
                        if ($request->hasFile('edit_foto')) {
                            $request->validate([
                                'edit_foto'     => 'image|max:50000'
                            ]);
                            $foto = $request->file('edit_foto');
                            $nama_foto = $foto->getClientOriginalName();
                            $file = public_path('img/karyawan/' . $nama_foto);
                            if (file_exists($file)) {
                                return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                            } else {
                                $file = public_path('img/karyawan/' . $data->foto);
                                if (file_exists($file)) {
                                    unlink($file);
                                    $pindah = $foto->move(public_path('img/karyawan'), $nama_foto);
                                    if ($pindah) {
                                        $update_karyawan = DB::table('karyawan')
                                            ->where('kode', $kode)
                                            ->update([
                                                'nama' => $request->edit_nama,
                                                'ttl' => $request->edit_tgl,
                                                'telp' => $request->edit_telp,
                                                'alamat' => $request->edit_alamat,
                                                'divisi' => $request->edit_divisi,
                                                'lokasi' => $request->edit_penempatan,
                                                'foto' => $nama_foto,
                                            ]);
                                        if ($update_karyawan) {
                                            $update_user = DB::table('users')
                                                ->where('kode_karyawan', $kode)
                                                ->update([
                                                    'username' => $request->edit_username,
                                                    'level' => $request->edit_role,
                                                ]);
                                            if ($update_user) {
                                                $log = new log_sistem();
                                                $log->transaksi = $kode;
                                                $log->user = $user->kode_karyawan;
                                                $log->keterangan = "Edit Data Karyawan";
                                                $save_log = $log->save();

                                                if ($save_log) {
                                                    return response()->json(['success' => true, 'pesan' => "Data berhasil Diubah"]);
                                                } else {
                                                    return response()->json(['succecc' => false, 'pesan' => "Error Tambah Log"]);
                                                }
                                            } else {
                                                return response()->json(['success' => false, 'pesan' => "Error Update Data User"]);
                                            }
                                        } else {
                                            return response()->json(['success' => false, 'pesan' => "Error Update Data Karyawan"]);
                                        }
                                    } else {
                                        return response()->json(['success' => false, 'pesan' => "Foto Gagal Dipindah"]);
                                    }
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "File Foto tidak ditemukan !! Silahkan hubungi admin"]);
                                }
                            }
                        } else {
                            $update_karyawan = DB::table('karyawan')
                                ->where('kode', $kode)
                                ->update([
                                    'nama' => $request->edit_nama,
                                    'ttl' => $request->edit_tgl,
                                    'telp' => $request->edit_telp,
                                    'alamat' => $request->edit_alamat,
                                    'divisi' => $request->edit_divisi,
                                    'lokasi' => $request->edit_penempatan,
                                ]);
                            if ($update_karyawan) {
                                $update_user = DB::table('users')
                                    ->where('kode_karyawan', $kode)
                                    ->update([
                                        'username' => $request->edit_username,
                                        'level' => $request->edit_role,
                                        'password' => bcrypt($request->edit_pwd_baru),
                                    ]);
                                if ($update_user) {
                                    $log = new log_sistem();
                                    $log->transaksi = $kode;
                                    $log->user = $user->kode_karyawan;
                                    $log->keterangan = "Edit Data Karyawan";
                                    $save_log = $log->save();

                                    if ($save_log) {
                                        return response()->json(['success' => true, 'pesan' => "Data berhasil Diubah"]);
                                    } else {
                                        return response()->json(['succecc' => false, 'pesan' => "Error Tambah Log"]);
                                    }
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "Error Update Data User"]);
                                }
                            } else {
                                return response()->json(['success' => false, 'pesan' => "Error Update Data Karyawan"]);
                            }
                        }
                    } else {
                        if ($request->edit_pwd_baru == $request->edit_repwd_baru) {
                            if ($request->hasFile('edit_foto')) {
                                $request->validate([
                                    'edit_password' => [new MatchOldPassword],
                                    'edit_pwd_baru' => ['min:8'],
                                    'edit_foto'     => 'image|max:50000'
                                ]);
                                $foto = $request->file('edit_foto');
                                $nama_foto = $foto->getClientOriginalName();
                                $file = public_path('img/karyawan/' . $nama_foto);
                                if (file_exists($file)) {
                                    return response()->json(['sucess' => false, 'pesan' => "File Foto dengan Nama Berikut telah terdaftar, silahkan gunakan foto lain atau mengganti nama file"]);
                                } else {
                                    $file = public_path('img/karyawan/' . $data->foto);
                                    if (file_exists($file)) {
                                        unlink($file);
                                        $pindah = $foto->move(public_path('img/karyawan'), $nama_foto);
                                        if ($pindah) {
                                            $update_karyawan =  DB::table('karyawan')
                                                ->where('kode', $kode)
                                                ->update([
                                                    'nama' => $request->edit_nama,
                                                    'ttl' => $request->edit_tgl,
                                                    'telp' => $request->edit_telp,
                                                    'alamat' => $request->edit_alamat,
                                                    'divisi' => $request->edit_divisi,
                                                    'lokasi' => $request->edit_penempatan,
                                                    'foto' => $nama_foto,
                                                ]);
                                            if ($update_karyawan) {
                                                $update_user = DB::table('users')
                                                    ->where('kode_karyawan', $kode)
                                                    ->update([
                                                        'username' => $request->edit_username,
                                                        'level' => $request->edit_role,
                                                        'password' => bcrypt($request->edit_pwd_baru),
                                                    ]);
                                                if ($update_user) {
                                                    $log = new log_sistem();
                                                    $log->transaksi = $kode;
                                                    $log->user = $user->kode_karyawan;
                                                    $log->keterangan = "Edit Data Karyawan";
                                                    $save_log = $log->save();

                                                    if ($save_log) {
                                                        return response()->json(['success' => true, 'pesan' => "Data berhasil Diubah"]);
                                                    } else {
                                                        return response()->json(['succecc' => false, 'pesan' => "Error Tambah Log"]);
                                                    }
                                                } else {
                                                    return response()->json(['success' => false, 'pesan' => "Error Update Data User"]);
                                                }
                                            } else {
                                                return response()->json(['success' => false, 'pesan' => "Error Update Data Karyawan"]);
                                            }
                                        } else {
                                            return response()->json(['success' => false, 'pesan' => "Foto Gagal Dipindah"]);
                                        }
                                    } else {
                                        return response()->json(['success' => false, 'pesan' => "File Foto tidak ditemukan !! Silahkan hubungi admin"]);
                                    }
                                }
                            } else {
                                $request->validate([
                                    'edit_password' => [new MatchOldPassword],
                                    'edit_pwd_baru' => ['min:8'],
                                ]);
                                $update_karyawan = DB::table('karyawan')
                                    ->where('kode', $kode)
                                    ->update([
                                        'nama' => $request->edit_nama,
                                        'ttl' => $request->edit_tgl,
                                        'telp' => $request->edit_telp,
                                        'alamat' => $request->edit_alamat,
                                        'divisi' => $request->edit_divisi,
                                        'lokasi' => $request->edit_penempatan,
                                    ]);
                                if ($update_karyawan) {
                                    $update_user = DB::table('users')
                                        ->where('kode_karyawan', $kode)
                                        ->update([
                                            'username' => $request->edit_username,
                                            'level' => $request->edit_role,
                                            'password' => bcrypt($request->edit_pwd_baru),
                                        ]);
                                    if ($update_user) {
                                        $log = new log_sistem();
                                        $log->transaksi = $kode;
                                        $log->user = $user->kode_karyawan;
                                        $log->keterangan = "Edit Data Karyawan";
                                        $save_log = $log->save();

                                        if ($save_log) {
                                            return response()->json(['success' => true, 'pesan' => "Data Berhasil Diubah"]);
                                        } else {
                                            return response()->json(['success' => true, 'pesan' => "Error Tambah Log"]);
                                        }
                                    } else {
                                        return response()->json(['success' => false, 'pesan' => "Error Update Data User"]);
                                    }
                                } else {
                                    return response()->json(['success' => false, 'pesan' => "Error Update Data Karyawan"]);
                                }
                            }
                        } else {
                            return response()->json(['success' => false, 'pesan' => "Password Baru Tidak Sama"]);
                        }
                    }
                } else {
                    return response()->json(['success' => false, 'pesan' => "Username Sudah Digunakan"]);
                }
            }


            $pwd = bcrypt($request->pwd);
            // $newpwd = md5($pwd);
            // $kode = $request->kode;
            // $queries = DB::table('karyawan')
            // ->select('password')
            // ->where('id',$id)
            // ->get();
            // $pass = $queries[0]['password'];
            // return $pass;

            $karyawan = karyawan::where('kode', $kode)->first();

            $karyawan->kode = $request->kode;
            $karyawan->nama = $request->nama;
            $karyawan->ttl = $request->ttl;
            $karyawan->telp = $request->telp;
            $karyawan->alamat = $request->alamat;
            $karyawan->divisi = $request->divisi;
            $karyawan->lokasi = $request->lokasi;
            // $karyawan->save();

            DB::table('karyawan')
                ->where('kode', $kode)
                ->update([
                    'nama' => $karyawan->nama, 'alamat' => $karyawan->alamat, 'role' => $request->role, 'ttl' => $karyawan->ttl, 'telp' => $karyawan->telp, 'divisi' => $karyawan->divisi, 'lokasi' => $karyawan->lokasi, 'gaji' => $karyawan->gaji
                ]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Karyawan";
            $log->save();
            return response()->json(['success' => true, 'pesan' => 'Data Berhasil Diubah']);
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
        try {
            $data = karyawan::where('kode', $kode)->first();
            $file = public_path('img/karyawan/' . $data->foto);

            if (file_exists($file)) {
                unlink($file);
                karyawan::where('kode', $kode)->delete();
                User::where('kode_karyawan', $kode)->delete();
                $log = new log_sistem();
                $log->transaksi = $kode;
                $log->user = $request->user;
                $log->keterangan = "Hapus Data Karyawan";
                $log->save();
                return response()->json(['success' => true, 'pesan' => 'Data Berhasil Dihapus']);
            } else {
                return response()->json(['success' => false, 'pesan' => "File Foto Tidak Ditemukan"]);
            }
            // $hapus = Storage::delete(public_path('img/karyawan/'.$data->foto));
            // if(!$hapus){
            //     return response()->json(['success'=>false,'pesan'=>"Foto Gagal Dihapus"]);
            // } else {
            //     //  karyawan::where('kode',$kode)->delete();
            //     // User::where('kode_karyawan',$kode)->delete();
            //     // $log = new log_sistem();
            //     // $log->transaksi = $kode;
            //     // $log->user = $request->user;
            //     // $log->keterangan = "Hapus Data Karyawan";
            //     // $log->save();
            //     return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
            // }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'pesan' => $e->getMessage()]);
        }
    }
}
