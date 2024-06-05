<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Data Rekanan</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
            <h1 class="m-0">Data Rekanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Rekanan</li>
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
                  <div class="row justify-content-between">
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Rekanan</button>
                    <button type="button" id="btn-import" data-toggle="modal" data-target="#modal-import"class="btn bg-gradient-info">Import Data</button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="tabel-rekanan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Action</th>
                      <th>ID Rekanan</th>
                      <th>Nama Rekanan</th>
                      <th>Nama Perusahaan</th>
                      <th>Mitra</th>
                      <th>Nomor Telp WA</th>
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
  <!-- MODAL Tambah  -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-tambah">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Data Rekanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <!--Kiri-->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Kode Rekanan</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_kode"  class="form-control" type="text" required readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nama Rekanan<sup><b class="text-danger">*</b></sup></label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_nama"  class="form-control" type="text" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nomor Rekanan / WA</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_cp"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Rek. Bank</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_bank1" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16" >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Email </label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_email" class="form-control" type="email" >
                                </div>
                            </div>
                        </div>
                        <!--Kanan-->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nama Perusahaan</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_perusahaan" class="form-control" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>NIB</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_nib" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Telpon kantor</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>NPWP</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="tambah_npwp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea id="tambah_alamat" class="form-control" style="resize:none;" rows="4" placeholder="Alamat Lengkap"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--      <label>Kode Rekanan </label>-->
                        <!--      <input id="tambah_kode"  class="form-control" type="text" required readonly>-->
                        <!--        <label> Mitra</label>-->
                        <!--        <select id="tambah_mitra"  class="form-control select2 " required>-->
                        <!--          <option value="">Pilih Mitra</option>-->
                        <!--          <option value="SUPPLIER">Supplier</option>-->
                        <!--          <option value="CUSTOMER">Customer</option>-->
                        <!--        </select> -->
                        <!--        <label>Nama Rekanan </label>-->
                        <!--        <input id="tambah_nama"  class="form-control" type="text" required>-->
                        <!--        <label>Nomor Rekanan (WA)</label>-->
                        <!--        <input id="tambah_cp"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >-->
                        <!--        <label>Rek. Bank 1</label>-->
                        <!--        <input id="tambah_bank1" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16" >-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--        <label>Nama Perusahaan</label>-->
                        <!--        <input id="tambah_perusahaan" class="form-control" type="text">-->
                        <!--        <label>Telpon Kantor</label>-->
                        <!--        <input id="tambah_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">-->
                        <!--        <label>Email</label>-->
                        <!--        <input id="tambah_email" class="form-control" type="email" >-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--        {{-- <label> Marketing</label>-->
                        <!--        <select id="tambah_marketing"  class="form-control select2 " >-->
                        <!--        </select> --}}-->
                        <!--        <label>Alamat</label>-->
                        <!--        <textarea id="tambah_alamat" class="form-control"  rows="5" placeholder="Alamat Lengkap"></textarea>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-tambah" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
  </div>
<!--/ Modal Tambah -->
<!-- Modal Detail-->
  <div class="modal fade" id="modal-detail">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Data</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                      <div class="row form-group">
                        <!--Kiri-->
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Kode Rekanan</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_kode"  class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Nama Rekanan</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_nama"  class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Nomor Rekanan / WA</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_cp"  class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Rek. Bank</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_bank1" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Email </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_email" class="form-control" type="email" readonly>
                                    </div>
                                </div>
                            </div>
                        <!--Kanan-->
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Nama Perusahaan</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_perusahaan" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>NIB</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_nib" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Telpon kantor</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_telp" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>NPWP</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input id="detail_npwp" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <textarea id="detail_alamat" class="form-control" style="resize:none;" rows="4" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        
                      </div>
              </div>
              <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
<!-- /Modal Detail Customer -->
<!-- MODAL Edit Customer -->
  <div class="modal fade" id="modal-edit">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form id="form-edit">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <!--Kiri-->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Kode Rekanan</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_kode"  class="form-control" type="text" required readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nama Rekanan<sup><b class="text-danger">*</b></sup></label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_nama"  class="form-control" type="text" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nomor Rekanan / WA</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_cp"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Rek. Bank</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_bank1" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16" >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Email </label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_email" class="form-control" type="email" >
                                </div>
                            </div>
                        </div>
                        <!--Kanan-->
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nama Perusahaan</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_perusahaan" class="form-control" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>NIB</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_nib" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Telpon kantor</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>NPWP</label>
                                </div>
                                <div class="col-lg-8">
                                    <input id="edit_npwp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea id="edit_alamat" class="form-control" style="resize:none;" rows="4" placeholder="Alamat Lengkap"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--        <label>Kode Rekanan</label>-->
                        <!--        <input id="edit_kode"class="form-control" type="text" readonly required>-->
                        <!--        {{-- <label>Mitra</label>-->
                        <!--        <select id="edit_mitra"  class="form-control select2 " required>-->
                        <!--          <option value="">Pilih Mitra</option>-->
                        <!--          <option value="SUPPLIER">Supplier</option>-->
                        <!--          <option value="CUSTOMER">Customer</option>-->
                        <!--        </select> --}}-->
                        <!--        <label>Nama Rekanan </label>-->
                        <!--        <input id="edit_nama" class="form-control" type="text" >-->
                        <!--        <label>Nomor Rekanan (WA)</label>-->
                        <!--        <input id="edit_cp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >-->
                        <!--        <label>Rek. Bank 1</label>-->
                        <!--        <input id="edit_bank1" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16" >-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--        <label>Nama Perusahaan</label>-->
                        <!--        <input id="edit_perusahaan" class="form-control" type="text" >-->
                        <!--        <label>Telpon Kantor</label>-->
                        <!--        <input id="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >-->
                        <!--        <label>Email</label>-->
                        <!--        <input id="edit_email" class="form-control" type="email" >-->
                        <!--        {{-- <label>Fax</label>-->
                        <!--        <input id="edit_fax" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">-->
                        <!--        <label>Rek. Bank 2</label>-->
                        <!--        <input id="edit_bank2" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="16" >  --}}-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-4">-->
                        <!--    <div class="form-group">-->
                        <!--        {{-- <label> Marketing</label>-->
                        <!--        <select id="edit_marketing"  class="form-control select2 ">-->
                        <!--        </select> --}}-->
                        <!--        <label>Alamat</label>-->
                        <!--        <textarea id="edit_alamat" class="form-control" rows="5"></textarea>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-edit" class="col-sm-2 form-control btn btn-warning">Edit</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<!--/ Modal Edit Customer -->
<!-- MODAL Hapus Customer -->
  <div class="modal fade" id="modal-hapus">
      <div class="modal-dialog modal-sm">
          <form id="form-hapus">
              <div class="modal-content">
                  <div class="modal-header bg-danger">
                      <h4 class="modal-title">Hapus Data Rekanan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group">
                                  Apakah Anda Yakin Akan Menghapus Data ini ?
                                  <input id="hapus_kode" class="form-control" type="text" hidden >
                                  <div class="row">
                                      <label class=" col-md-3">ID </label> 
                                      <h6 class="col-md-6" id="kode"></h6>
                                  </div>
                                  <div class="row">
                                      <label class=" col-md-3">Nama </label> 
                                      <h6 class="col-md-6" id="nama"></h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
<!--/ Modal Hapus Customer -->
 <!-- Modal Import -->
  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-info">
              <h4 class="modal-title">Import Data Barang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="upload-data" enctype="multipart/form-data" >
              <div class="row">
                <div class="col-lg-6">
                  <label for="Pilih File">Pilih File Excel</label>
                  <input type="file" id="upload-file" name="upload-file" class="form-control" accept=".xls,.xlsx">
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                  <br>
                  <button type="submit" id="submit-file" class="btn btn-info">Input Data</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table id="tabel-preview" class="table table-bordered ">
                      <thead>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama Rekanan</th>
                        <th>Whatsapp</th>
                        <th>Nama Perusahaan</th>
                        <th>Telepon</th>
                        <th>Bank</th>
                        <th>Email</th>
                        <th>Alamat</th>
                      </thead>
                      <tbody id="body-tabel-preview"></tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between ">
            <input type="file" id="import-file" name="import-file" class="form-control" hidden>
            <button type="button"  id="edt-btn-cancel-edit-barang" data-dismiss="modal" class="col-sm-4 form-control btn btn-default">Cancel</button>
            <button type="button"  id="submit-import" class="col-sm-4 form-control btn btn-info ">Upload Barang</button>
          </div>
      </div>
    </div>
  </div>
<!--/ Modal Import -->
<!--/ MODAL -->

<!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
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
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<script>
    
    
    $(document).ready(function() {   
    $('#tabel-rekanan').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-rekanan") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'nama_perusahaan', name: 'nama_perusahaan',orderable:true},
            { data: 'wa', name: 'wa',orderable:true},
            { data: 'telp', name: 'telp',orderable:true},
        ]
    });
  }); 
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    } 

  $(document).on('click','#tambahdata',function(){
    document.getElementById("form-tambah").reset();
    $.ajax({
      type  : 'get',
      url   : '{!! url("lastkode-rekanan")!!}',
      success : function(response){
        // console.log(response);
        $('#tambah_kode').val(response);
      }
    });
    // $('#tambah_marketing').empty();
    // $.ajax({
    //   url :'{!! url("dropdown-marketing") !!}',
    //   type : 'get',
    //   success : function(data){
    //     var datahandler = $('#tambah_marketing');
    //     var Nrow = $("<option value=''>Pilih Marketing</option>");
    //     datahandler.append(Nrow);
    //     var Nrow = $("<option value='-'>-</option>");
    //     datahandler.append(Nrow);
    //     $.each(data, function(key,val){
    //       var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
    //       datahandler.append(Nrow);
    //     });
        
    //   }
    // });
  });
  // $('#tambah_mitra').on('change',function(){
  //   $('#tambah_kode').val('');
  //   var mitra = $(this).val();
  //   if(mitra != ''){
  //     $.ajax({
  //       url :'{!! url("lastkode-rekanan/'+mitra+'") !!}',
  //       type : 'get',
  //       success : function(data){
  //         // console.log(data);
  //         $('#tambah_kode').val(data);
  //       }
  //     });
  //   } else {
  //     $('#tambah_kode').val('');
  //   }
    
  // });
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-rekanan/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            console.log(response);
          var  nama = response.result.nama_perusahaan;
          $('#detail_kode').val(response.result.kode);
          // $('#detail_mitra').val(response.result.mitra);
          $('#detail_nama').val(response.result.nama);
          $('#detail_cp').val(response.result.wa);
          $('#detail_bank1').val(response.result.bank1);
          $('#detail_perusahaan').val(nama);
          $('#detail_telp').val(response.result.telp);
          $('#detail_email').val(response.result.email);
          // $('#detail_fax').val(response.result.fax);
          // $('#detail_bank2').val(response.result.bank2);
          // $('#detail_marketing').val(response.result.marketing);
          $('#detail_alamat').val(response.result.alamat);
          $('#detail_nib').val(response.result.nib);
          $('#detail_npwp').val(response.result.npwp);
        }
      });
  });
  $('body').on('click', '.edit', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-rekanan/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          // $('#edit_marketing').empty();
          // $.ajax({
          //   url :'{!! url("dropdown-marketing") !!}',
          //   type : 'get',
          //   success : function(data){
          //     var datahandler = $('#edit_marketing');
          //     var Nrow = $("<option value=''>Pilih Marketing</option>");
          //     datahandler.append(Nrow);
          //     var Nrow = $("<option value='-'>-</option>");
          //     datahandler.append(Nrow);
          //     $.each(data, function(key,val){
          //       var Nrow = $("<option value='"+val.kode+"' selected>"+val.nama+"</option>");
          //       datahandler.append(Nrow);
          //     });
              
          //   }
          // });
          $('#edit_kode').val(response.result.kode);
          // $('#edit_mitra').val(response.result.mitra);
          $('#edit_nama').val(response.result.nama);
          $('#edit_cp').val(response.result.wa);
          $('#edit_bank1').val(response.result.bank1);
          $('#edit_perusahaan').val(response.result.nama_perusahaan);
          $('#edit_telp').val(response.result.telp);
          $('#edit_email').val(response.result.email);
          // $('#edit_fax').val(response.result.fax);
          // $('#edit_bank2').val(response.result.bank2);
          // $('#edit_marketing').append('<option value="'+response.result.marketing+'" selected >'+response.result.marketing+'</option>');
          $('#edit_alamat').val(response.result.alamat);
          $('#edit_nib').val(response.result.nib);
          $('#edit_npwp').val(response.result.npwp);
        }
      });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("form-hapus").reset();
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      document.getElementById("kode").innerHTML = kode;
      document.getElementById("nama").innerHTML = nama;
      $('#hapus_kode').val(kode);

  });
  $('#form-tambah').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-rekanan") !!}',
      data : {
        kode      : $('#tambah_kode').val(),
        user : "{{$user->kode_karyawan}}",
        nama      : $('#tambah_nama').val(),
        _token    : token,
        nib       : $('#tambah_nib').val(),
        npwp      : $('#tambah_npwp').val(),
        // mitra     : $('#tambah_mitra').val(),
        wa        : $('#tambah_cp').val(),
        bank      : $('#tambah_bank1').val(),
        email     : $('#tambah_email').val(),
        perusahaan : $('#tambah_perusahaan').val(),
        telp      : $('#tambah_telp').val(),
        // fax       : $('#tambah_fax').val(),
        // bank2     : $('#tambah_bank2').val(),
        // marketing : $('#tambah_marketing').val(),
        alamat    : $('#tambah_alamat').val()
      }, // serializes form input
      success:function(response) {
        // console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel-rekanan').DataTable(); 
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
  $('#form-edit').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edit_kode').val();
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-rekanan/'+kode+'") !!}',
      data : {
        kode      : kode,
        nama      : $('#edit_nama').val(),
        _token    : token,
        user : "{{$user->kode_karyawan}}",
        // mitra     : $('#edit_mitra').val(),
        nib       : $('#edit_nib').val(),
        npwp      : $('#edit_npwp').val(),
        wa        : $('#edit_cp').val(),
        bank     : $('#edit_bank1').val(),
        email     : $('#edit_email').val(),
        perusahaan : $('#edit_perusahaan').val(),
        telp      : $('#edit_telp').val(),
        alamat    : $('#edit_alamat').val()
      }, // serializes form input
      success:function(response) {
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-rekanan').DataTable(); 
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
  $('#form-hapus').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode =  $('#hapus_kode').val();
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-rekanan/'+kode+'") !!}',
      data    : {
        _token  : token,
        user : "{{$user->kode_karyawan}}",
      },
      success:function(response) {
        // console.log(response);
        var hasil = response.pesan;
        if(response.success){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hapus').modal('hide');
          var table = $('#tabel-rekanan').DataTable(); 
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
  //Import Data
   $('#btn-import').on('click',function(){
      document.getElementById("upload-data").reset();
      $('#upload-file').prop('disabled',false);
      $('#body-table-preview').empty();
    });
    $('#upload-data').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#submit-file');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '{!! url("upload-rekanan") !!}',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if(data.success == true){
            Toast.fire({
              icon  : 'success',
              title : data.pesan,
            });
            $('#upload-file').prop('disabled',true);
            $('#body-tabel-preview').empty();
            var datahandler = $('#body-tabel-preview');
            // console.log(data.data);
            var n= 0;
            $.each(data.data[0], function(key,val){
                var nomor = n+1;
                var Nrow = $("<tr>");
                Nrow.html("<td>"+nomor+"</td><td>"+data.data[0][n][0]+"</td><td>"+data.data[0][n][1]+"</td><td>"+data.data[0][n][2]+"</td><td>"+data.data[0][n][3]+"</td><td>"+data.data[0][n][4]+"</td><td>"+data.data[0][n][5]+"</td><td>"+data.data[0][n][6]+"</td><td>"+data.data[0][n][7]+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          } else {
            Toast.fire({
              icon  : 'error',
              title  : data.pesan
            });
          }
          // console.log(data);
        }
      });
    });
    $('#submit-import').on('click',function(e){
      var el = $('#submit-import');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData('#upload-data');
      // console.log(formData);
    });
    // $('#import-data').submit(function(e){
    //   var el = $('#submit-import');
    //   el.prop('disabled', true);
    //   setTimeout(function(){el.prop('disabled', false); }, 4000);
    //   var formData = new FormData('#upload-data');
    //   // console.log(formData);
    //   $.ajax({
    //     type: 'POST',
    //     url: '{!! url("import-barang") !!}',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function(response) {
    //       // console.log(response);
    //       if(response.success == true){
    //         Toast.fire({
    //           icon  : "success",
    //           title : response.pesan
    //         });
            
    //       } else {
    //         Toast.fire({
    //           icon  : 'error',
    //           title  : response.pesan
    //         });
    //       }
          
    //     }
    //   });
    // });
  //Import Data
</script>
</body>
</html>
