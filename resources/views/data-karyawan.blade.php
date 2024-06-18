<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Data Karyawan</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">

    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div>
  @include('layout/navbar')

  <!-- Main Sidebar Container -->
  @include('layout/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah-karyawan"class="btn  bg-gradient-primary">Tambah Karyawan</button>
                  <!--<button type="button"  data-toggle="modal" data-target="#modal-test"class="btn  bg-gradient-primary">Test</button>-->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="tabel-karyawan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Action</th>
                      <th>Kode Karyawan</th>
                      <th>Nama Karyawan</th>
                      <th>Role</th>
                      <th>Nomor Telp</th>
                      <th>Divisi</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
  <!-- TEST-->

  <!--TEST-->
    <!-- MODAL Tambah Karyawan -->
      <div class="modal fade" id="modal-tambah-karyawan">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary">
              <h4 class="modal-title">Tambah Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <!--<form id="tambahkaryawan" method="POST" enctype="multipart/form-data" >-->
              <form action="#" method="POST" id="tambahkaryawan" enctype="multipart/form-data">
                  @csrf
              <div class="modal-body">
                  <div class="form-group">
                    <div class="row">
                      <!--KIRI-->
                      <div class="col-lg-6">
                           @csrf
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Perusahaan<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8" required>
                                  <select id="tambah_pt" name="tambah_pt" class="form-control select2">
                                      <option value="">Pilih Perusahaan</option>
                                      <option value="NPA"> CV. Nusa Pratama Anugrah</option>
                                      <option value="HERBIVOR"> Herbivor Satu Nusa</option>
                                      <option value="TRIPUTRA"> Triputra Sinergi Indonesia</option>
                                      <option value="ALL">ALL</option>
                                  </select>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Nama Karyawan<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="tambah_nama_karyawan" name="tambah_nama_karyawan" class="form-control" type="text" required>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Tanggal Lahir</label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="tambah_tgl_karyawan" name="tambah_tgl_karyawan" class="form-control" type="date">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>No. Telp / WA</label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="tambah_telp_karyawan" name="tambah_telp_karyawan" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required >
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Alamat</label>
                              </div>
                              <div class="col-lg-8">
                                  <textarea id="tambah_alamat_karyawan" name="tambah_alamat_karyawan" class="form-control" style="resize:none;"  rows="4" placeholder="Alamat Lengkap" required></textarea>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Divisi</label>
                              </div>
                              <div class="col-lg-8">
                                  <select id="tambah_divisi_karyawan" name="tambah_divisi_karyawan" class="form-control select2"  required>
                                  <option value="">Pilih Divisi</option>
                                  <option value="Accounting">Accounting</option>
                                  <option value="Administrasi">Administasi</option>
                                  <option value="Administrasi Internal">Administasi Internal </option>
                                  <option value="Admin Marketing">Admin Marketing</option>
                                  <option value="Desain Grafis">Desain Grafis</option>
                                  <option value="IT/jaringan">IT/Jaringan</option>
                                  <option value="Manager Administrasi">Manager Administrasi</option>
                                  <option value="Manager Operasional">Manager Operasional</option>
                                  <option value="Manager Marketing">Manager Marketing</option>
                                  <option value="Marketing Agro-Chemidal">Marketing Agro-Chemical</option>
                                  <option value="Marketing Chemical-Industri">Marketing Chemical-Industri</option>
                                  <option value="Marketing Chemical Cleaning">Marketing Chemical Cleaning</option>
                                  <option value="RnD">Research and Development</option>
                                </select>

                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Penempatan<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8">
                                <select id="tambah_penempatan_karyawan" name="tambah_penempatan_karyawan" class="form-control select2"  required>

                                </select>
                              </div>
                          </div>
                      </div>
                      <!--KANAN-->
                      <div class="col-lg-6" >

                          <div class="row">
                              <div class="col-lg-4">
                                  <label> Foto Karyawan</label>
                              </div>
                              <div class="col-lg-8">
                                <img class="profile-user-img img-fluid img-square" style="width:100%;"
                                    id="preview"
                                    alt="Foto Profil Karyawan">
                                <input type="file" id="tambah_foto" name="tambah_foto" >
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label> Username<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" id="tambah_username_karyawan" name="tambah_username_karyawan"  class="form-control" required placeholder="gunakan huruf kecil semua">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Password<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8">
                                <input id="tambah_pwd_karyawan" name="tambah_pwd_karyawan" class="form-control" type="password" maxlength="12" minlength="6" required>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Role<sup><b class="text-danger">*</b></sup></label>
                              </div>
                              <div class="col-lg-8">
                                <select id="tambah_role_karyawan" name="tambah_role_karyawan" class="form-control select2"  required>
                                  <option value="">Pilih Role</option>
                                  <option value="superadmin">Super Admin</option>
                                  <option value="admin">Admin Penjualan</option>
                                  <option value="purchasing">Purchasing</option>
                                  <option value="accounting">Accounting</option>
                                  <option value="manager-admin">Manager Admin</option>
                                  <option value="manager-operasional">Operasional Manager</option>
                                  <option value="marketing">Marketing</option>
                                  <option value="admin-marketing">Admin Marketing</option>
                                  <option value="manager-marketing">Marketing Manager</option>
                                </select>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

              </div>
              <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" id="btn-tambah" class="btn btn-save btn-primary">Simpan</button>
              </div>
          </form>
          </div>
          </div>
      </div>
    <!--/ Modal Tambah Karyawan -->
    <!-- Modal Detail Karyawan -->
      <div class="modal fade" id="modal-detail-karyawan">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
            <h4 class="modal-title">Detail Data Karyawan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                      <!--KIRI-->
                      <div class="col-lg-6 form-group">
                           @csrf
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Perusahaan</label>
                              </div>
                              <div class="col-lg-8" required>
                                  <input type="text" id="detail_pt" class="form-control" readonly>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Nama Karyawan</label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="detail_nama" class="form-control" type="text" readonly>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Tanggal Lahir</label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="detail_tgl"class="form-control" type="date" readonly>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>No. Telp / WA</label>
                              </div>
                              <div class="col-lg-8">
                                  <input id="detail_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" readonly >
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Alamat</label>
                              </div>
                              <div class="col-lg-8">
                                  <textarea id="detail_alamat"  class="form-control" style="resize:none;"  rows="4" placeholder="Alamat Lengkap" readonly></textarea>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Divisi</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" id="detail_divisi" readonly>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Penempatan</label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" id="detail_penempatan" class="form-control" readonly>
                              </div>
                          </div>
                      </div>
                      <!--KANAN-->
                      <div class="col-lg-6 form-group" >

                          <div class="row">
                              <div class="col-lg-4">
                                  <label> Foto Karyawan</label>
                              </div>
                              <div class="col-lg-8">
                                <img class="profile-user-img img-fluid img-square" style="width:100%;"
                                        id="detail-preview"
                                        style="object-fit: cover; width: 100%; height: 100%;"
                                        alt="Foto Profil Karyawan">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label> Username</label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" id="detail_username" class="form-control" readonly placeholder="gunakan huruf kecil semua">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Role</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" id="detail_role" class="form-control" readonly>
                              </div>
                          </div>
                      </div>
                  </div>
                <hr>
              <!--<div class="row">-->
              <!--  <div class="col-lg-6">-->
              <!--    <div class="form-group">-->
              <!--      <label>Kode Karyawan</label>-->
              <!--      <input id="detail_kode_karyawan" class="form-control" type="text" readonly>-->
              <!--      <label>Nama Karyawan </label>-->
              <!--      <input id="detail_nama_karyawan" class="form-control" type="text" readonly>-->
              <!--      <label >Usename</label>-->
              <!--      <input type="text" id="detail_username_karyawan" class="form-control" readonly>-->
              <!--      <label>Tanggal Lahir </label>-->
              <!--      <input id="detail_tgl_karyawan"  class="form-control" type="date" readonly>-->
              <!--      <label>Nomor Telepon</label>-->
              <!--      <input id="detail_telp_karyawan"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" readonly>-->
              <!--      <label>Alamat</label>-->
              <!--      <textarea id="detail_alamat_karyawan"  class="form-control"  rows="3" placeholder="Alamat Lengkap" readonly></textarea>-->
              <!--    </div>-->
              <!--  </div>-->
              <!--  <div class="col-lg-6">-->
              <!--    <label>Foto Karyawan</label>-->
              <!--    <br>-->
              <!--    <div style="width:200px; height:200px">-->
              <!--      <img class="profile-user-img img-fluid img-square" style="width:100%;"-->
              <!--          id="detail-preview"-->
              <!--          style="object-fit: cover; width: 100%; height: 100%;"-->
              <!--          alt="Foto Profil Karyawan">    -->
              <!--    </div>-->
              <!--    <br><br>-->
              <!--    <br><br>-->
              <!--    <label> Divisi</label>-->
              <!--    <input type="text" id="detail_divisi_karyawan" class="form-control" disabled>-->
              <!--    <label> Role</label>-->
              <!--    <input type="text" class="form-control" id="detail_role_karyawan" readonly>-->
              <!--    <label>Penempatan</label>-->
              <!--    <input id="detail_penempatan_karyawan"  class="form-control" type="text" readonly>-->


              <!--  </div>-->
              <!--</div>-->
            </div>
            <div class="modal-footer justify-content-between ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
        </div>
      </div>
    <!--/ Modal Detail Karyawan -->
    <!-- MODAL Edit Karyawan -->
      <div class="modal fade" id="modal-edit-karyawan">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header bg-warning">
                      <h4 class="modal-title">Edit Data Karyawan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="editkaryawan" method="POST" enctype="multipart/form-data">
                      @csrf
                  <div class="modal-body">
                      <div class="row">
                          <!--KIRI-->
                          <div class="col-lg-6 form-group">
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Perusahaan</label>
                                  </div>
                                  <input type="hidden" id="edt_kode" name="edt_kode" class="form-control">
                                  <div  class="col-lg-8" required>
                                      <select id="edit_pt" name="edit_pt" class="form-control select2">
                                          <option value="NPA"> CV. Nusa Pratama Anugrah</option>
                                          <option value="HERBIVOR"> Herbivor Satu Nusa</option>
                                          <option value="TRIPUTRA"> Triputra Sinergi Indonesia</option>
                                          <option value="ALL">ALL</option>
                                      </select>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Nama Karyawan</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <input id="edit_nama" name="edit_nama" class="form-control" type="text" required>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Tanggal Lahir</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <input id="edit_tgl" name="edit_tgl" class="form-control" type="date">
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>No. Telp / WA</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <input id="edit_telp" name="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required >
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Alamat</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <textarea id="edit_alamat" name="edit_alamat" class="form-control" style="resize:none;"  rows="4" placeholder="Alamat Lengkap" required></textarea>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Divisi</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <select id="edit_divisi" name="edit_divisi" class="form-control select2"  required>
                                      <option value="">Pilih Divisi</option>
                                      <option value="Accounting">Accounting</option>
                                      <option value="Administrasi">Administasi</option>
                                      <option value="Administrasi Internal">Administasi Internal </option>
                                      <option value="Admin Marketing">Admin Marketing</option>
                                      <option value="Desain Grafis">Desain Grafis</option>
                                      <option value="IT/jaringan">IT/Jaringan</option>
                                      <option value="Manager Administrasi">Manager Administrasi</option>
                                      <option value="Manager Operasional">Manager Operasional</option>
                                      <option value="Manager Marketing">Manager Marketing</option>
                                      <option value="Marketing Agro-Chemidal">Marketing Agro-Chemical</option>
                                      <option value="Marketing Chemical-Industri">Marketing Chemical-Industri</option>
                                      <option value="Marketing Chemical Cleaning">Marketing Chemical Cleaning</option>
                                      <option value="RnD">Research and Development</option>
                                    </select>

                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Penempatan</label>
                                  </div>
                                  <div class="col-lg-8">
                                    <select id="edit_penempatan" name="edit_penempatan" class="form-control select2"  required>

                                    </select>
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Role</label>
                                  </div>
                                  <div class="col-lg-8">
                                    <select id="edit_role" name="edit_role" class="form-control select2">
                                      <option value="superadmin">Super Admin</option>
                                      <option value="admin">Admin Penjualan</option>
                                      <option value="purchasing">Purchasing</option>
                                      <option value="accounting">Accounting</option>
                                      <option value="manager-admin">Manager Admin</option>
                                      <option value="manager-operasional">Operasional Manager</option>
                                      <option value="marketing">Marketing</option>
                                      <option value="admin-marketing">Admin Marketing</option>
                                      <option value="manager-marketing">Marketing Manager</option>
                                    </select>
                                  </div>
                              </div>
                          </div>
                          <!--KANAN-->
                          <div class="col-lg-6 form-group" >

                              <div class="row">
                                  <div class="col-lg-4">
                                      <label> Foto Karyawan</label>
                                  </div>
                                  <div class="col-lg-8">
                                    <img class="profile-user-img img-fluid img-square" style="width:100%;"
                                        id="edit-preview"
                                        alt="Foto Profil Karyawan">
                                    <input type="file" id="edit_foto" name="edit_foto" >
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label> Username</label>
                                  </div>
                                  <div class="col-lg-8">
                                    <input type="text" id="edit_username" name="edit_username"  class="form-control" required placeholder="gunakan huruf kecil semua">
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Password Lama</label>
                                  </div>
                                  <div class="col-lg-8">
                                    <input id="edit_pwd_lama" name="edit_pwd_lama" class="form-control" type="password" maxlength="12" minlength="6">
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Password Baru</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <input id="edit_pwd_baru" name="edit_pwd_baru" class="form-control" type="password" maxlength="12" minlength="6">
                                  </div>
                              </div>
                              <br>
                              <div class="row">
                                  <div class="col-lg-4">
                                      <label>Re-Password Baru</label>
                                  </div>
                                  <div class="col-lg-8">
                                      <input id="edit_repwd_baru" name="edit_repwd_baru" class="form-control" type="password" maxlength="12" minlength="6">
                                  </div>
                              </div>
                          </div>
                        </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-edit" class=" col-sm-2 form-control btn btn-warning">Edit</button>
                  </div>
              </form>
              </div>
          </div>
      </div>
    <!--/ Modal Edit Karyawan -->
    <!-- MODAL Hapus Karyawan -->
      <div class="modal fade" id="modal-hapus-karyawan">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="hapuskaryawan">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    Apakah Anda Yakin Akan Menghapus Data ini ?
                    <input id="hapus_kode_karyawan"  class="form-control" type="text" hidden >
                    <div class="row">
                      <label class=" col-md-3">Kode </label>
                      <h6 class="col-md-6" id="hapus_kode"></h6>
                    </div>
                    <div class="row">
                      <label class=" col-md-3">Nama </label>
                      <h6 class="col-md-6" id="hapus_nama"></h6>
                    </div>
                    <div class="row">
                      <label class=" col-md-3">Divisi </label>
                      <h6 class="col-md-6"id="hapus_divisi"></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
            </div>
        </form>
          </div>
        </div>
      </div>
    <!--/ Modal Hapus Karyawan -->
    <!-- Modal Status Karyawan -->
        <div class="modal fade" id="modal-status">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h4 class="modal-title">Ubah Status Karyawan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="ubah-status">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        Apakah Anda Yakin Akan Mengubah Status Karyawan ini ?
                        <input id="status_karyawan"  class="form-control" type="text" hidden >
                        <input id="status_id"  class="form-control" type="text" hidden >
                        <div class="row">
                          <label class=" col-md-3">Kode </label>
                          <h6 class="col-md-6" id="status_kode"></h6>
                        </div>
                        <div class="row">
                          <label class=" col-md-3">Nama </label>
                          <h6 class="col-md-6" id="status_nama"></h6>
                        </div>
                        <div class="row">
                          <label class=" col-md-3">Divisi </label>
                          <h6 class="col-md-6"id="status_divisi"></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" id="btn-status" class=" col-sm-4 form-control btn btn-warning">Ubah</button>
                </div>
            </form>
              </div>
            </div>
          </div>
    <!-- //Modal Status Karayawan -->
<!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('AdminLTE/plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.js"></script>
<!-- AdminLTE for demo purposes -->
<script>
    function previewImage() {
      var preview = document.querySelector('#preview');
      var file    = document.querySelector('#tambah_foto').files[0];
      var reader  = new FileReader();

      reader.onloadend = function () {
        preview.src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
      }
    }
    $('#tambah_foto').change(function() {
      var size = this.files[0].size;
      var preview = document.querySelector('#preview');
      if(size > 5000000) {
          Toast.fire({
                icon: 'error',
                title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
            })
          $('#tambah_foto').val('');
          document.getElementById("preview").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
      } else {
          var preview = document.querySelector('#preview');
          var file    = document.querySelector('#tambah_foto').files[0];
          var reader  = new FileReader();

          reader.onloadend = function () {
            preview.src = reader.result;
          }

          if (file) {
            reader.readAsDataURL(file);
          } else {
            preview.src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
          }
      }
    });
    $('#edit_foto').change(function() {
       var size = this.files[0].size;
       var preview = document.querySelector('#edit-preview');
       if(size > 2000000) {
           Toast.fire({
                icon: 'error',
                title: "Ukuran file Foto terlalu besar. Maksimum 2MB"
            })
           $('#edit_foto').val('');
       } else {
          var preview = document.querySelector('#edit-preview');
          var file    = document.querySelector('#edit_foto').files[0];
          var reader  = new FileReader();

          reader.onloadend = function () {
            preview.src = reader.result;
          }

          if (file) {
            reader.readAsDataURL(file);
          } else {
          }
       }
    });
    $(document).ready(function() {

        $('#tabel-karyawan').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-karyawan") !!}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'userlevel', name: 'userlevel',orderable:false,searchable:false},
            { data: 'telp', name: 'telp',orderable:true},
            { data: 'divisi', name: 'divisi',orderable:true},

        ]
    });
    });
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      });

  $('#tambahkaryawan').submit(function(event)   {
    event.preventDefault();
    if(document.getElementById('preview').src == "https://img.freepik.com/free-icon/user_318-804790.jpg"){
        Toast.fire({
            icon : 'error',
            title : 'Pilih Foto Karyawan !!',
        });
        return false;
    }
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var data = new FormData(form[0]);
    // console.log(data);
    $.ajax({
        url: '{!! url("data-karyawan") !!}',
        type: method,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {

            if(response.success == true){
                Toast.fire({
                    icon: 'success',
                    title: response.pesan
                })
                $('#modal-tambah-karyawan').modal('hide');
                var table = $('#tabel-karyawan').DataTable();
                table.ajax.reload( null, false );
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.pesan
                })
            }

            // Proses response setelah submit form berhasil
        },
        error: function(response) {
            console.log(response);
            Toast.fire({
                icon: 'error',
                title: response.pesan
            })
            // Proses response setelah submit form gagal
        }
    });
  });

    $('#editkaryawan').submit(function (e) {
        e.preventDefault();
        var kode = $('#edt_kode').val();
        var formData = new FormData(this);

        $.ajax({
            url: '{!! url("datakaryawan/'+kode+'") !!}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon : "success",
                        title : response.pesan
                    })
                    $('#modal-edit-karyawan').modal('hide');
                    var table = $('#tabel-karyawan').DataTable();
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon : "error",
                        title : response.pesan
                    })
                }
                // Tambahkan logika lainnya sesuai kebutuhan
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                // Tampilkan pesan kesalahan 500 Internal Server Error di console.log()
                console.error('Internal Server Error:', jqXHR.responseText);
                // Lakukan sesuatu setelah terjadi kesalahan
                var errorMessage = "Terjadi kesalahan: " + jqXHR.responseJSON.message;
                Toast.fire({
                    icon: 'error',
                    title: errorMessage
                });
            }
        });
    });

  $('#hapuskaryawan').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#hapus_kode_karyawan').val();

    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-karyawan/'+kode+'") !!}',
      data    : {
        user  : "{{$user->kode_karyawan}}",
        _token  : token,
      },
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hapus-karyawan').modal('hide');
          var table = $('#tabel-karyawan').DataTable();
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: hasil
          })
        }
      }
    });
  });


  $('#ubah-status').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-status');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        var kode = $('#status_id').val();
        console.log(kode);
        $.ajax({
          type    : 'get',
          url     : '{!! url("ubah-status-karyawan/'+kode+'") !!}',
          data    : {
             status : $('#status_karyawan').val(),
            _token  : token,
          },
          success:function(response) {
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true){
              Toast.fire({
                icon: 'success',
                title: hasil
              })
              $('#modal-status').modal('hide');
              var table = $('#tabel-karyawan').DataTable();
              table.ajax.reload( null, false );
            } else {
              Toast.fire({
                icon: 'error',
                title: hasil
              })
            }
          }
        });
  });
  function angka(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
      return true;
  }

  $(document).on('click','#tambahdata',function(){
    document.getElementById("tambahkaryawan").reset();
    $('#tambah_penempatan_karyawan').empty();
    document.getElementById('preview').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
    $.ajax({
      url :'{!! url("dropdown-gudang") !!}',
      type : 'get',
      success : function(response){

        var datahandler = $('#tambah_penempatan_karyawan');
        var Nrow = $("<option value=''>Pilih Penempatan</option>");
        datahandler.append(Nrow);
        $.each(response, function(key,val){
          var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
          datahandler.append(Nrow);
        });
      }
    });

  });
  $('body').on('click', '.edit', function () {
    var kode = $(this).data('kode');
    document.getElementById("editkaryawan").reset();
    $.ajax({
      url :'{!! url("data-karyawan/'+kode+'/edit") !!}',
      type : 'get',
      success : function(response){
          console.log(response);
        Toast.fire({
          icon: 'info',
          title: 'Password tidak perlu di isi jika tidak dirubah'
        })
        $('#edit_penempatan').empty();
        $.ajax({
          url :'{!! url("dropdown-gudang") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#edit_penempatan');
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
          }
        });
        console.log(response.result);
        var kode = response.result.kode;
        $('#edt_kode').val(kode);
        $('#edit_nama').val(response.result.nama);
        $('#edit_tgl').val(response.result.ttl);
        $('#edit_alamat').val(response.result.alamat);
        $('#edit_username').val(response.result.username);
        $('#edit_username_karyawan').val(response.result.username);
        $('#edit_telp').val(response.result.telp);
        switch(response.result.perusahaan){
            case 'CV. Nusa Pratama Anugrah':
                $('#edit_pt').val('NPA').trigger('change');
                break;
            case 'PT. Herbivor Satu Nusa':
                $('#edit_pt').val('HERBIVOR').trigger('change');
                break;
            case 'PT. Triputra Singergi Indonesia':
                $('#edit_pt').val('TRIPUTRA').trigger('change');
                break;
            case 'Nusa Group':
                $('#edit_pt').val('ALL').trigger('change');
                break;
        }
        $('#edit_divisi').val(response.result.divisi).trigger('change');
        $('#edit_role').val(response.result.level);
        var $option = $("<option selected='selected'></option>").val(response.result.lokasi).text(response.result.namalokasi);
        $('#edit_penempatan').append($option).trigger('change');
        document.getElementById("edit_divisi").value = response.result.divisi;
        if(response.result.foto == "/img/karyawan/"){
              document.getElementById('edit-preview').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
          } else {
              var baseUrl = window.location.origin;
              var fotoUrl = baseUrl + response.result.foto;
              document.getElementById('edit-preview').src = fotoUrl;
          }
    }
    });
  });
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-karyawan/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          console.log(response.result);
          $('#detail_pt').val(response.result.perusahaan);
          $('#detail_nama').val(response.result.nama);
          $('#detail_tgl').val(response.result.ttl);
          $('#detail_alamat').val(response.result.alamat);
          $('#detail_telp').val(response.result.telp);
          $('#detail_username').val(response.result.username);
          $('#detail_role').val(response.result.level);
          $('#detail_penempatan').val(response.result.namalokasi);
          $('#detail_divisi').val(response.result.divisi);
          if(response.result.foto == "/img/karyawan/"){
              document.getElementById('detail-preview').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
          } else {
              var baseUrl = window.location.origin;
              var fotoUrl = baseUrl + response.result.foto;
              document.getElementById('detail-preview').src = fotoUrl;
          }

        }
      });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("hapuskaryawan").reset();

      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      var divisi = $(this).data('divisi');
      document.getElementById("hapus_kode").innerHTML = kode;
      document.getElementById("hapus_nama").innerHTML = nama;
      document.getElementById("hapus_divisi").innerHTML = divisi;
      $('#hapus_kode_karyawan').val(kode);
  });
  $('body').on('click', '.status', function () {
      document.getElementById("ubah-status").reset();

      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      var divisi = $(this).data('divisi');
      document.getElementById("status_kode").innerHTML = kode;
      document.getElementById("status_nama").innerHTML = nama;
      document.getElementById("status_divisi").innerHTML = divisi;
      $('#status_id').val(kode);
      $('#status_karyawan').val($(this).data('status'));
  });
  function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
      { style: 'currency', currency: 'IDR' }
    ).format(money);
  }


</script>
</body>
</html>
