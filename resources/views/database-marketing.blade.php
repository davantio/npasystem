<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Database Marketing</title>
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
            <h1 class="m-0">Database Marketing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Database Marketing</li>
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
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Database</button>
                    
                    <button type="button" id="btn-import" data-toggle="modal" data-target="#modal-import"class="btn bg-gradient-info">Import Data</button>
                  </div>
                  <br>
                  <div class="database" id="search-db">
                      <form id="form-filter" method="POST">
                        <div class="row form-group">
                            <div class="col-lg-3">
                              <label>Kategori</label>
                              <select id="filter-kategori" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                              <label>Wilayah</label>
                              <select id="filter-wilayah" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                              <label>Marketing</label>
                              <select id="filter-marketing" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                              <br>
                              <button id="submit-filter" type="submit" class="btn bg-gradient-success">Cari</button>
                            </div>
                            
                        </div>    
                      </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div id="table-filter" class="card-body table-responsive">
                    <h4 id="title-filter"></h4>
                        <br>
                    <div class="row">
                        
                        <div class="col-lg-2">
                            <label class="text-success">Sudah Order</label><br>
                            <label class="text-warning">Sedang Dikerjakan</label><br>
                            <label class="text-danger">Data Buruk</label><br>
                            <label>Total</label>
                        </div>
                        <div class="col-lg-1">
                            <label>:</label> <br>
                            <label>:</label> <br>
                            <label>:</label> <br>
                            <label>:</label>
                        </div>
                        <div class="col-lg-1">
                            <label id="so"></label><br>
                            <label id="sd"></label><br>
                            <label id="db"></label><br>
                            <label id="total"></label>
                        </div>
                    </div>
                  <table id="tabel-db-filter" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th width=15%>Action</th>
                      <th>PT</th>
                      <th>Kategori</th>
                      <th>Wilayah</th>
                      <th>Nama Perusahaan</th>
                      <th>Alamat Kantor</th>
                      <th>Alamat Pabrik</th>
                      <th>Nomor Telp/WA</th>
                      <th>Email</th>
                      <th>Link</th>
                      <th width="14%">Medsos</th>
                      <th width="14%">Kebutuhan</th>
                      <th width="20%">Target</th>
                      <th>PIC</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <div id="table-default" class="card-body table-responsive">
                  <table id="tabel-database" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th style="min-width:100px">Action</th>
                      <th>PT</th>
                      <th>Kategori</th>
                      <th>Wilayah</th>
                      <th>Nama Perusahaan</th>
                      <th>Alamat Kantor</th>
                      <th>Alamat Pabrik</th>
                      <th>Nomor Telp/WA</th>
                      <th>Email</th>
                      <th>Link</th>
                      <th width="14%">Medsos</th>
                      <th width="14%">Kebutuhan</th>
                      <th width="20%">Target</th>
                      <th>PIC</th>
                      <th>Keterangan</th>
                      <th>Status</th>
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
  <!-- MODAL TEST -->
  
  <!--<div class="modal fade" id="modal-test">-->
  <!--      <div class="modal-dialog modal-lg">-->
  <!--          <div class="modal-content">-->
  <!--              <form id="form-test">-->
  <!--                  <div class="modal-header bg-primary">-->
  <!--                      <h4 class="modal-title">Tambah Database Marketing</h4>-->
  <!--                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
  <!--                          <span aria-hidden="true">&times;</span>-->
  <!--                      </button>-->
  <!--                  </div>-->
  <!--                  <div class="modal-body">-->
  <!--                      <h3><b>Data Perusahaan</b></h3>-->
  <!--                      <hr>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label>Tipe <sup class="text-danger">*</sup></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <select id="tambah_filter_kategori"  class="form-control select2"></select>-->
  <!--                              <br>-->
  <!--                              <input id="tambah_kategori"  class="form-control" type="text" required>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>PT.<sup class="text-danger">*</sup></b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <select id="tambah-pt" class="form-control select2" required>-->
  <!--                                  <option value="NPA">CV. Nusa Pratama Anugrah</option>-->
  <!--                                  <option value="HERBIVOR">PT. Herbivor</option>-->
  <!--                                  <option value="ALL">ALL</option>-->
  <!--                              </select>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Wilayah<sup class="text-danger">*</sup></b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <select id="tambah_wilayah"  class="form-control select2" required></select>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Marketing<sup class="text-danger">*</sup></b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <select id="tambah_pic" class="form-control select2" required></select>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Nama Perusahaan<sup class="text-danger">*</sup></b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input class="form-control" type="text">-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Email</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_email" class="form-control" type="email">-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Rekanan</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_rekanan" class="form-control" type="text">-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Telepon / WA</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Alamat Kantor</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah_alamat_kantor" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Alamat Gudang</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah_alamat_pabrik" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Media Sosial</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah-medsos" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Kebutuhan</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah-kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <br>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
                                
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
                                
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Keterangan</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah-keterangan" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <hr>-->
  <!--                      <h3><b>Data Purchasing / PIC</b></h3>-->
  <!--                      <hr>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Nama Purchasing</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_nama_purchasing"  class="form-control" type="text" >-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Nomor Telepon/WA</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_nopurchasing"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Hobby</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input id="tambah_hobby" class="form-control" type="text" >-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Makanan/ Minuman Favorit</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <input  id="tambah_makanan" class="form-control" type="text" >-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                      <div class="row">-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Social Media</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah_sosmed" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-2">-->
  <!--                              <label><b>Alamat</b></label>-->
  <!--                          </div>-->
  <!--                          <div class="col-lg-4">-->
  <!--                              <textarea id="tambah-alamatpurchasing" class="form-control" style="resize:none;" width="3"></textarea>-->
  <!--                          </div>-->
  <!--                      </div>-->
  <!--                  </div>-->
  <!--                  <div class="modal-footer justify-content-between ">-->
  <!--                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
  <!--                      <button type="submit" id="btn-tt" class="col-sm-2 form-control btn btn-primary">Tambah</button>-->
  <!--                  </div>-->
  <!--              </form>-->
  <!--          </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!-- MODAL TEST -->
  <!-- MODAL Tambah  -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-tambah">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Database Marketing</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3><b>Data Perusahaan</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Tipe <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="tambah_filter_kategori"  class="form-control select2"></select>
                                <br>
                                <input id="tambah_kategori"  class="form-control" type="text" required>
                            </div>
                            <div class="col-lg-2">
                                <label><b>PT.<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="tambah_pt" class="form-control select2" required>
                                    <option value="NPA">CV. Nusa Pratama Anugrah</option>
                                    <option value="HERBIVOR">PT. Herbivor</option>
                                    <option value="ALL">ALL</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Wilayah<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="tambah_wilayah"  class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Marketing<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="tambah_pic" class="form-control select2" required></select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Perusahaan<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_nama" class="form-control" type="text">
                            </div>
                            <div class="col-lg-2">
                                <label><b>Email</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_email" class="form-control" type="email">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Rekanan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_rekanan" class="form-control" type="text">
                            </div>
                            <div class="col-lg-2">
                                <label><b>Telepon / WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Alamat Kantor</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_alamat_kantor" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat Gudang</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_alamat_pabrik" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Media Sosial</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_medsos" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Kebutuhan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <label>Kolom dengan tanda <b class="text-danger">(<sup>*</sup>)</b>Wajib Diisi</label>    
                            </div>
                            <div class="col-lg-2">
                                <label><b>Keterangan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_keterangan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3><b>Data Purchasing / PIC</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Purchasing</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_nama_purchasing"  class="form-control" type="text" >
                            </div>
                            <div class="col-lg-2">
                                <label><b>Nomor Telepon/WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_nopurchasing"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Hobby</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="tambah_hobby" class="form-control" type="text" >
                            </div>
                            <div class="col-lg-2">
                                <label><b>Makanan/ Minuman Favorit</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input  id="tambah_makanan" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Social Media</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_sosmed" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="tambah_alamatpurchasing" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
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
                        <h3><b>Data Perusahaan</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Tipe</label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_kategori"  class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>PT.</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_pt" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Wilayah</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_wilayah" class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Marketing</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_pic" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Perusahaan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_nama" class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Email</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_email" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Rekanan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_rekanan" class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Telepon / WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_telp" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Alamat Kantor</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_alamat_kantor" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat Gudang</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_alamat_pabrik" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Media Sosial</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_medsos" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Kebutuhan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_kebutuhan" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                
                            </div>
                            <div class="col-lg-4">
                                
                            </div>
                            <div class="col-lg-2">
                                <label><b>Keterangan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_keterangan" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3><b>Data Purchasing / PIC</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Purchasing</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_nama_purchasing"  class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Nomor Telepon/WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_nopurchasing"  class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Hobby</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="detail_hobby" class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Makanan/ Minuman Favorit</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input  id="detail_makanan" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Social Media</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_sosmed" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="detail_alamatpurchasing" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                  <!--<div class="modal-body">-->
                  <!--    <div class="row">-->
                  <!--          <div class="col-lg-4">-->
                  <!--              <div class="form-group">-->
                  <!--                  <label>Kategori</label>-->
                  <!--                  <input id="detail_kategori"  class="form-control" type="text" readonly>-->
                  <!--                  <label>Nama Perusahaan </label>-->
                  <!--                  <input id="detail_nama"  class="form-control" type="text" readonly>-->
                  <!--                  <label>Alamat Kantor</label>-->
                  <!--                  <input id="detail_alamat_kantor"  class="form-control" type="text" readonly>-->
                  <!--                  <label>Alamat Pabrik</label>-->
                  <!--                  <input id="detail_alamat_pabrik" class="form-control" type="text" readonly>-->
                  <!--                  <label>Nama Purchasing</label>-->
                  <!--                  <input id="detail_nama_purchasing" class="form-control" type="text" readonly>-->
                  <!--              </div>-->
                  <!--          </div>-->
                  <!--          <div class="col-lg-4">-->
                  <!--              <div class="form-group">-->
                  <!--                  <label>Rekanan</label>-->
                  <!--                  <textarea id="detail_rekanan" class="form-control" style="resize:none" width="3" placeholder="Tuliskan Nama&Telp" readonly></textarea>-->
                  <!--                  <label>Telfon/WA</label>-->
                  <!--                  <input id="detail_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" readonly>-->
                  <!--                  <label>Email</label>-->
                  <!--                  <input id="detail_email" class="form-control" type="email" readonly>-->
                  <!--                  <label>Media Sosial</label>-->
                  <!--                  <textarea id="detail-medsos" class="form-control" style="resize:none;" width="3" readonly></textarea>-->
                  <!--                  <label>No Purchasing</label>-->
                  <!--                  <input id="detail_nopurchasing" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15" readonly>-->
                  <!--              </div>-->
                  <!--          </div>-->
                  <!--          <div class="col-lg-4">-->
                  <!--              <div class="form-group">-->
                  <!--                  <label>PT</label>-->
                  <!--                  <input id="detail-pt" class="form-control" type="text" readonly>-->
                  <!--                  <label>Wilayah</label>-->
                  <!--                  <input id="detail_wilayah" class="form-control" type="text" readonly>-->
                  <!--                  <label>PIC Marketing</label>-->
                  <!--                  <input id="detail_pic" class="form-control" readonly>-->
                  <!--                  <label>Kebutuhan</label>-->
                  <!--                  <textarea id="detail-kebutuhan" class="form-control" style="resize:none;" width="3" readonly></textarea>-->
                  <!--                  <label>Keterangan</label>-->
                  <!--                  <textarea id="detail-keterangan" class="form-control" style="resize:none;" width="3" readonly></textarea>-->
                  <!--              </div>-->
                  <!--          </div>-->
                  <!--      </div>-->
                  <!--</div>-->
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    <!-- /Modal Detail -->
    <!-- MODAL Edit -->
      <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <form id="form-edit">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Database</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3><b>Data Perusahaan</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Tipe <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_kode"  class="form-control" type="text" hidden>
                                <select id="edit_filter_kategori"  class="form-control select2"></select>
                                <br>
                                <input id="edit_kategori"  class="form-control" type="text" required>
                            </div>
                            <div class="col-lg-2">
                                <label><b>PT.<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="edit_pt" class="form-control select2" required>
                                    <option value="NPA">CV. Nusa Pratama Anugrah</option>
                                    <option value="HERBIVOR">PT. Herbivor</option>
                                    <option value="ALL">ALL</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Wilayah<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="edit_wilayah"  class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Marketing<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <select id="edit_pic" class="form-control select2" required></select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Perusahaan<sup class="text-danger">*</sup></b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_nama" class="form-control" type="text">
                            </div>
                            <div class="col-lg-2">
                                <label><b>Email</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_email" class="form-control" type="email">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Rekanan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_rekanan" class="form-control" type="text">
                            </div>
                            <div class="col-lg-2">
                                <label><b>Telepon / WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Alamat Kantor</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_alamat_kantor" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat Gudang</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_alamat_pabrik" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Media Sosial</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_medsos" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Kebutuhan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <label>Kolom dengan tanda <b class="text-danger">(<sup>*</sup>)</b>Wajib Diisi</label>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Keterangan</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_keterangan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3><b>Data Purchasing / PIC</b></h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Nama Purchasing</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_nama_purchasing"  class="form-control" type="text" >
                            </div>
                            <div class="col-lg-2">
                                <label><b>Nomor Telepon/WA</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_nopurchasing"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Hobby</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input id="edit_hobby" class="form-control" type="text" >
                            </div>
                            <div class="col-lg-2">
                                <label><b>Makanan/ Minuman Favorit</b></label>
                            </div>
                            <div class="col-lg-4">
                                <input  id="edit_makanan" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label><b>Social Media</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_sosmed" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                            <div class="col-lg-2">
                                <label><b>Alamat</b></label>
                            </div>
                            <div class="col-lg-4">
                                <textarea id="edit_alamatpurchasing" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--<div class="modal-body">-->
                    <!--    <div class="row">-->
                    <!--    <div class="col-lg-4">-->
                    <!--            <div class="form-group">-->
                    <!--                <input id="edit_kode"  class="form-control" type="text" hidden>-->
                    <!--                <label>Kategori</label>-->
                    <!--                <select id="edit_filter_kategori" class="form-control select2" required></select>-->
                    <!--                <br>-->
                    <!--                <input id="edit_kategori"  class="form-control" type="text" required>-->
                    <!--                <label>Nama Perusahaan </label>-->
                    <!--                <input id="edit_nama"  class="form-control" type="text" required>-->
                    <!--                <label>Alamat Kantor</label>-->
                    <!--                <input id="edit_alamat_kantor"  class="form-control" type="text">-->
                    <!--                <label>Alamat Pabrik</label>-->
                    <!--                <input id="edit_alamat_pabrik" class="form-control" type="text" >-->
                    <!--                <label>Nama Purchasing</label>-->
                    <!--                <input id="edit_nama_purchasing" class="form-control" type="text" >-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-4">-->
                    <!--            <div class="form-group">-->
                    <!--                <label>Rekanan</label>-->
                    <!--                <textarea id="edit_rekanan" class="form-control" style="resize:none" width="3" placeholder="Tuliskan Nama&Telp"></textarea>-->
                    <!--                <label>Telfon/WA</label>-->
                    <!--                <input id="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">-->
                    <!--                <label>Email</label>-->
                    <!--                <input id="edit_email" class="form-control" type="email">-->
                    <!--                <label>Media Sosial</label>-->
                                           <!--<textarea id="edit_medsos" class="form-control" style="resize:none;" width="3"></textarea>-->
                    <!--                <label>No Purchasing</label>-->
                    <!--                <input id="edit_nopurchasing" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="15" >-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-4">-->
                    <!--            <div class="form-group">-->
                    <!--                <label>PT</label>-->
                    <!--                <select id="edit-pt" class="form-control" required>-->
                    <!--                    <option value="">Pilih PT</option>-->
                    <!--                    <option value="NPA">CV. Nusa Pratama Anugrah</option>-->
                    <!--                    <option value="HERBIVOR">PT. Herbivor</option>-->
                    <!--                    <option value="ALL">ALL</option>-->
                    <!--                </select>-->
                    <!--                <label>Wilayah</label>-->
                    <!--                <input id="edit_wilayah" class="form-control" type="text" readonly>-->
                    <!--                <label>PIC Marketing</label>-->
                    <!--                <select id="edit_pic"  class="form-control select2 " ></select> -->
                    <!--                <label>Kebutuhan</label>-->
                    <!--                <textarea id="edit-kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>-->
                    <!--                <label>Keterangan</label>-->
                    <!--                <textarea id="edit-keterangan" class="form-control" style="resize:none;" width="3"></textarea>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-edit" class="col-sm-2 form-control btn btn-warning">Edit</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    <!--/ Modal Edit -->
    <!-- MODAL Hapus -->
      <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Database</h4>
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
    <!--/ Modal Hapus -->
     <!-- MODAL PIC -->
      <div class="modal fade" id="modal-pic">
          <div class="modal-dialog modal-sm">
              <form id="form-pic">
                  <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Ubah PIC Database</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <input type="hidden" id='kode-db'>
                                      <select class="form-control select2" id="ubah-pic" required></select>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-submit-pic" class=" col-sm-4 form-control btn btn-info">Ubah</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    <!--/ Modal PIC -->
    <!-- MODAL Status -->
      <div class="modal fade" id="modal-status">
          <div class="modal-dialog modal-sm">
              <form id="form-status">
                  <div class="modal-content">
                      <div id="header-status" class="modal-header ">
                          <h4 class="modal-title">Ubah Status Database</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <input type="hidden" id='kode-status'>
                                      <input type="hidden" id="ubah-status">
                                      Apakah Anda Yakin Akan Mengubah Status Data ini ?
                                      <br>
                                      <h6 id="data-status"></h6>
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-submit-status" class=" col-sm-4 form-control btn btn-danger">Ubah</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    <!--/ Modal Status -->
    <!-- Modal Import -->
      <div class="modal fade" id="modal-import">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Import Database</h4>
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
                              <th>Kategori</th>
                              <th>Nama Perusahaan</th>
                              <th>Alamat Kantor</th>
                              <th>Alamat Pabrik</th>
                              <th>Nomor Telp/WA</th>
                              <th>Email</th>
                              <th>Orang Dalam</th>
                              <th>Medsos</th>
                              <th>Kebutuhan</th>
                              <th>PIC</th>
                              <th>Keterangan</th>
                              <th>Status</th>
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
    <!-- Modal Aksi -->
      <div class="modal fade" id="modal-aksi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah  Aksi Database Marketing</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input id="tambah-kode"  class="form-control" type="hidden" hidden>
                                <label class="text-muted">Nama Perusahaan </label>
                                <br>
                                <b id="tambah-nama"></b>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-muted">Alamat kantor</label>
                                <br>
                                <b id="tambah-kantor"></b>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-muted">Status</label>
                                <br> <b id="tambah-status"></b>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-primary" id="btn-tambah-aksi">Tambah Aksi</button>
                    <div id="tambah-aksi">
                        <form id="form-tambah-aksi">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" id="tambah-tanggal">
                                    <label>Marketing</label>
                                    <select class="form-control select2" id="tambah-marketing" required></select>
                                </div>    
                                <div class="col-lg-4">
                                    <label>Jam</label>
                                    <input type="time" class="form-control" id="tambah-jam" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Laporan</label>
                                    <textarea id="tambah-laporan" class="form-control" style="resize:none;" row="3" placeholder="Tulis Laporan Disini" required></textarea>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 justify-content-between">
                                    <button type="button" id="btn-aksi-cancel-tambah" class="btn btn-default col-sm-4">Cancel</button>
                                    <div class="col-lg-1"></div>
                                    
                                    <button type="submit" id="btn-aksi-tambah" class="btn btn-primary form-control col-sm-6">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="edit-aksi">
                        <form id="form-edit-aksi">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="hidden" class="form-control" id="edit-id" hidden>
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" id="edit-tanggal">
                                    <label>Marketing</label>
                                    <input type="text" class="form-control" id="edit-marketing" readonly>
                                </div>    
                                <div class="col-lg-4">
                                    <label>Jam</label>
                                    <input type="time" class="form-control" id="edit-jam" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Laporan</label>
                                    <textarea id="edit-laporan" class="form-control" style="resize:none;" row="3" placeholder="Tulis Laporan Disini" required></textarea>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 justify-content-between">
                                    <button type="button" id="btn-aksi-cancel-edit" class="btn btn-default col-sm-4">Cancel</button>
                                    <button type="submit" id="btn-aksi-edit" class="btn btn-warning form-control col-sm-6">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="hapus-aksi">
                        <form id="form-hapus-aksi">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" id="hapus-id" hidden>
                                    <label>Tanggal  : </label><b id="hapus-tanggal"></b>
                                    <br>
                                    <label>Laporan  : </label><p id="hapus-laporan"></p>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 justify-content-between">
                                    <button type="button" id="btn-aksi-cancel-hapus" class="btn btn-default col-sm-4">Cancel</button>
                                    <button type="submit" id="btn-aksi-hapus" class="btn btn-danger form-control col-sm-6">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>No.</th>
                                <th width="12%">Action</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Marketing</th>
                                <th>Laporan</th>
                            </thead>
                            <tbody id="tabel-body-aksi">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-tambah" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
      </div>
    <!--/ Modal Aksi -->
    <!-- Modal Target -->
      <div class="modal fade" id="modal-target">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Target Database Marketing</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input id="tambah-kode-target"  class="form-control" type="hidden" hidden>
                                <label class="text-muted">Nama Perusahaan </label>
                                <br>
                                <b id="tambah-nama-target"></b>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-muted">Alamat kantor</label>
                                <br>
                                <b id="tambah-kantor-target"></b>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-muted">Status</label>
                                <br> <b id="tambah-status-target"></b>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-primary" id="btn-tambah-target">Tambah Target</button>
                    <div id="input-tambah-target">
                        <form id="form-tambah-target">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" id="tambah-tgl-target" required>
                                </div>    
                                <div class="col-lg-4">
                                    <label>Marketing</label>
                                    <select class="form-control select2" id="tambah-marketing-target" required></select>
                                </div> 
                                <div class="col-lg-4">
                                    <label>Total</label>
                                    <input type="text" class="form-control" id="tambah-total-target" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Barang</label>
                                    <input type="text" class="form-control" id="tambah-barang-target" required>
                                </div>
                                <div class="col-lg-2">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" id="tambah-qty-target" min="0" required>
                                </div>
                                <div class="col-lg-3">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" id="tambah-harga-target" required>
                                </div>
                                <div class="col-lg-4  justify-content-between">
                                    <br>
                                    <button type="button" id="btn-target-cancel-tambah" class="btn btn-default col-sm-4">Cancel</button>
                                    <button type="submit" id="btn-target-tambah" class="btn btn-primary form-control col-sm-6">Tambah</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                
                            </div>
                        </form>
                    </div>
                    <div id="input-edit-target">
                        <form id="form-edit-target">
                            <div class="row">
                                <input type="hidden" id="edit-kode-target">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" id="edit-tgl-target" required>
                                </div>    
                                <div class="col-lg-4">
                                    <label>Marketing</label>
                                    <select class="form-control select2" id="edit-marketing-target" required></select>
                                </div> 
                                <div class="col-lg-4">
                                    <label>Total</label>
                                    <input type="text" class="form-control" id="edit-total-target" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>Barang</label>
                                    <input type="text" class="form-control" id="edit-barang-target" required>
                                </div>
                                <div class="col-lg-2">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" id="edit-qty-target" min="0" required>
                                </div>
                                <div class="col-lg-3">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" id="edit-harga-target" required>
                                </div>
                                <div class="col-lg-4 justify-content-between">
                                    <br>
                                    <button type="button" id="btn-target-cancel-edit" class="btn btn-default col-sm-4">Cancel</button>
                                    <button type="submit" id="btn-target-edit" class="btn btn-warning form-control col-sm-6">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="hapus-target">
                        <form id="form-hapus-target">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="hapus-id-target" >
                                    <h4>Apakah anda yakin menghapus data ini ?</h4>
                                    <br>
                                    <label>Tanggal  : </label><b id="hapus-tanggal-target"></b>
                                    <br>
                                    <label>Keterangan  : </label><b id="hapus-keterangan-target"></b>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 justify-content-between">
                                    <button type="button" id="btn-target-cancel-hapus" class="btn btn-default col-sm-4">Cancel</button>
                                    <button type="submit" id="btn-target-hapus" class="btn btn-danger form-control col-sm-6">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>No.</th>
                                <th width="12%">Action</th>
                                <th>Tanggal</th>
                                <th>Marketing</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </thead>
                            <tbody id="tabel-body-target">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
    <!--/ Modal Target -->
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
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script>
    
    
    $(document).ready(function() {
        document.getElementById("form-filter").reset();
        $('#tabel-database').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              if (aData['PIC'] != "-") {
                $('td', nRow).css('background-color', 'Yellow');
                if(aData['status'] == "Milik Rekanan" || aData['status'] == "Tutup" || aData['status'] == "Pembayaran Buruk") {
                    $('td', nRow).css('background-color', ' #FE3D3D');
                } else if(aData['status'] == "Sudah Order"){
                    $('td', nRow).css('background-color', ' #00FF64');
                }
              }else{
                $('td', nRow).css('background-color', '');
                if(aData['status'] == "Milik Rekanan" || aData['status'] == "Tutup" || aData['status'] == "Pembayaran Buruk") {
                    $('td', nRow).css('background-color', ' #FE3D3D');
                }
              } 
            },
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-dbmarketing") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'PT', name: 'PT',orderable:true,searchable:true},
                { data: 'kategori', name: 'kategori',orderable:false},
                { data: 'wilayah', name: 'wilayah',orderable:true},
                { data: 'nama_perusahaan', name: 'nama_perusahaan',orderable:true},
                { data: 'alamat_kantor', name: 'alamat_kantor',orderable:false},
                { data: 'alamat_pabrik', name: 'alamat_pabrik',orderable:false},
                { data: 'telp_wa', name: 'telp_wa',orderable:false},
                { data: 'email', name: 'email',orderable:false},
                { data: 'orang_dalam', name: 'orang_dalam',orderable:false},
                { data: 'medsos', name: 'medsos',orderable:false},
                { data: 'kebutuhan', name: 'kebutuhan',orderable:false},
                { data: 'target', name: 'target',orderable:false, searchable:false},
                { data: 'nama', name: 'nama',orderable:true},
                { data: 'keterangan', name: 'keterangan',orderable:false},
                { data: 'status', name: 'status',orderable:true},
                    
            ]
        });
        $('#table-filter').hide();
        $('#tabel-db-filter').DataTable({
            processing: true,
            serverSide: true,
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              if (aData['PIC'] != "-") {
                $('td', nRow).css('background-color', 'Yellow');
                if(aData['status'] == "Milik Rekanan" || aData['status'] == "Tutup" || aData['status'] == "Pembayaran Buruk") {
                    $('td', nRow).css('background-color', ' #FE3D3D');
                } else if(aData['status'] == "Sudah Order"){
                    $('td', nRow).css('background-color', ' #00FF64');
                }
              }else{
                $('td', nRow).css('background-color', '');
                if(aData['status'] == "Milik Rekanan" || aData['status'] == "Tutup" || aData['status'] == "Pembayaran Buruk") {
                    $('td', nRow).css('background-color', ' #FE3D3D');
                }
              } 
            },
            ajax: {
                url: '{!! url("filter-dbmarketing") !!}',
                type: 'POST',
                data: function (d) {
                    d.kategori = $('#filter-kategori').val();
                    d.wilayah = $('#filter-wilayah').val();
                    d.marketing = $('#filter-marketing').val();
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'PT', name: 'PT',orderable:true},
                { data: 'kategori', name: 'kategori',orderable:false},
                { data: 'wilayah', name: 'wilayah',orderable:true},
                { data: 'nama_perusahaan', name: 'nama_perusahaan',orderable:true},
                { data: 'alamat_kantor', name: 'alamat_kantor',orderable:false},
                { data: 'alamat_pabrik', name: 'alamat_pabrik',orderable:false},
                { data: 'telp_wa', name: 'telp_wa',orderable:false},
                { data: 'email', name: 'email',orderable:false},
                { data: 'orang_dalam', name: 'orang_dalam',orderable:false},
                { data: 'medsos', name: 'medsos',orderable:false},
                { data: 'kebutuhan', name: 'kebutuhan',orderable:false},
                { data: 'target', name: 'target',orderable:false},
                { data: 'nama', name: 'nama',orderable:false},
                { data: 'keterangan', name: 'keterangan',orderable:false},
                { data: 'status', name: 'status',orderable:false},
            ]
        });
        
        @if($user->level == 'superadmin')
            $('#btn-import').show();
        @else
            $('#btn-import').hide();
        @endif
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
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
      }
    function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    } 
//Filter
    $('#filter-kategori').select2({
      placeholder : 'Pilih Kategori',
      ajax  :{
        url : '{!! url("dropdown-kategori") !!}',
        dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.kategori,
                          id: item.kategori
                      }
                  })
              };
          },
          cache: true
      }
    });
    $("#filter-wilayah").select2({
        placeholder: "Pilih Provinsi",
        allowClear: true,
        data: [
          { id: '', text: 'Pilih Provinsi' },
          { id: 'all', text: 'ALL' },
          { id: 'Aceh', text: 'Aceh' },
          { id: 'Sumatera Utara', text: 'Sumatera Utara' },
          { id: 'Sumatera Barat', text: 'Sumatera Barat' },
          { id: 'Riau', text: 'Riau' },
          { id: 'Jambi', text: 'Jambi' },
          { id: 'Sumatera Selatan', text: 'Sumatera Selatan' },
          { id: 'Bengkulu', text: 'Bengkulu' },
          { id: 'Lampung', text: 'Lampung' },
          { id: 'Kepulauan Bangka Belitun', text: 'Kepulauan Bangka Belitung' },
          { id: 'Kepulauan Riau', text: 'Kepulauan Riau' },
          { id: 'DKI Jakarta', text: 'DKI Jakarta' },
          { id: 'Jawa Barat', text: 'Jawa Barat' },
          { id: 'Jawa Tengah', text: 'Jawa Tengah' },
          { id: 'DI Yogyakarta', text: 'DI Yogyakarta' },
          { id: 'Jawa Timur', text: 'Jawa Timur' },
          { id: 'Banten', text: 'Banten' },
          { id: 'Bali', text: 'Bali' },
          { id: 'Nusa Tenggara Barat', text: 'Nusa Tenggara Barat' },
          { id: 'Nusa Tenggara Timur', text: 'Nusa Tenggara Timur' },
          { id: 'Kalimantan Barat', text: 'Kalimantan Barat' },
          { id: 'Kalimantan Tengah', text: 'Kalimantan Tengah' },
          { id: 'Kalimantan Selatan', text: 'Kalimantan Selatan' },
          { id: 'Kalimantan Timur', text: 'Kalimantan Timur' },
          { id: 'Kalimantan Utara', text: 'Kalimantan Utara' },
          { id: 'Sulawesi Utara', text: 'Sulawesi Utara' },
          { id: 'Gorontalo', text: 'Gorontalo' },
          { id: 'Sulawesi Tengah', text: 'Sulawesi Tengah' },
          { id: 'Sulawesi Barat', text: 'Sulawesi Barat' },
          { id: 'Sulawesi Selatan', text: 'Sulawesi Selatan' },
          { id: 'Maluku', text: 'Maluku' },
          { id: 'Maluku Utara', text: 'Maluku Utara' },
          { id: 'Papua Barat', text: 'Papua Barat' },
          { id: 'Papua', text: 'Papua' },
        ]
      });
    //Filter Marketing
      @if($user->level == 'marketing')
        var datahandler = $('#filter-marketing');
        var Nrow = $("<option value=''>Pilih Marketing</option>");
        datahandler.append(Nrow);
        var Nrow = $("<option value='-'>-</option>");
        datahandler.append(Nrow);
        var Nrow = $("<option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
        datahandler.append(Nrow);
      @else
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#filter-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
            datahandler.append(Nrow);
            var Nrow = $("<option value='-'>-</option>");
            datahandler.append(Nrow);
            var Nrow = $("<option value='all'>ALL</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
      @endif
    //Filter Marketing
    
    $('#form-filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#submit-filter');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        $('#table-default').hide();
        var marketing = $('#filter-marketing').val();
        $.ajax({
            url :'{!! url("list-db-marketing") !!}',
            type : 'get',
            data :{
                _token      : token,
                kategori    : $('#filter-kategori') .val(),
                wilayah     : $('#filter-wilayah') .val(),
                marketing   : $('#filter-marketing') .val(),
            },
            success : function(data){
                // console.log(data);
                if(data.success == true){
                    $('#title-filter').html('Ringkasan Database '+marketing);
                    $('#so').html(data.so);
                    $('#sd').html(data.sd);
                    $('#db').html(data.db);
                    $('#total').html(data.total)
                } else {
                    $('#title-filter').html('');
                    $('#so').html('');
                    $('#sd').html('');
                    $('#db').html('');
                    $('#total').html('');
                    Toast.fire({
                        icon : "error",
                        title : data.pesan,
                    })
                }
            }
        });
        $('#tabel-db-filter').DataTable().draw();
        $('#table-filter').show();
        
    });
//Filter
//Tambah Data
  $(document).on('click','#tambahdata',function(){
      
    document.getElementById("form-tambah").reset();
    $('#tambah_filter_kategori').select2({
      placeholder : 'Pilih Kategori',
      ajax  :{
        url : '{!! url("dropdown-kategori") !!}',
        dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.kategori,
                          id: item.kategori
                      }
                  })
              };
          },
          cache: true
      }
    });
    $('#tambah_filter_kategori').on('change',function(){
        var data = $(this).val();
        $('#tambah_kategori').val(data);
    })
    // $('#tmb-rekanan').hide();
    @if($user->level == "marketing")
        $('#tambah_pic').empty();
        var datahandler = $('#tambah_pic');
        var Nrow = $("<option value=''>Pilih Marketing</option><option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
        datahandler.append(Nrow);
        $('#tambah_pt').empty();
        var handler = $('#tambah_pt');
        var Krow = $("<option value=''>Pilih PT</option><option value='{{$detail->perusahaan}}'>{{$detail->perusahaan}}</option>");
        handler.append(Krow);
    @else
        $('#tambah_pic').empty();
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#tambah_pic');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
            datahandler.append(Nrow);
            var Nrow = $("<option value='-'>-</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
    @endif
    $("#tambah_wilayah").select2({
        placeholder: "Pilih Provinsi",
        allowClear: true,
        data: [
          { id: 'Aceh', text: 'Aceh' },
          { id: 'Sumatera Utara', text: 'Sumatera Utara' },
          { id: 'Sumatera Barat', text: 'Sumatera Barat' },
          { id: 'Riau', text: 'Riau' },
          { id: 'Jambi', text: 'Jambi' },
          { id: 'Sumatera Selatan', text: 'Sumatera Selatan' },
          { id: 'Bengkulu', text: 'Bengkulu' },
          { id: 'Lampung', text: 'Lampung' },
          { id: 'Kepulauan Bangka Belitun', text: 'Kepulauan Bangka Belitung' },
          { id: 'Kepulauan Riau', text: 'Kepulauan Riau' },
          { id: 'DKI Jakarta', text: 'DKI Jakarta' },
          { id: 'Jawa Barat', text: 'Jawa Barat' },
          { id: 'Jawa Tengah', text: 'Jawa Tengah' },
          { id: 'DI Yogyakarta', text: 'DI Yogyakarta' },
          { id: 'Jawa Timur', text: 'Jawa Timur' },
          { id: 'Banten', text: 'Banten' },
          { id: 'Bali', text: 'Bali' },
          { id: 'Nusa Tenggara Barat', text: 'Nusa Tenggara Barat' },
          { id: 'Nusa Tenggara Timur', text: 'Nusa Tenggara Timur' },
          { id: 'Kalimantan Barat', text: 'Kalimantan Barat' },
          { id: 'Kalimantan Tengah', text: 'Kalimantan Tengah' },
          { id: 'Kalimantan Selatan', text: 'Kalimantan Selatan' },
          { id: 'Kalimantan Timur', text: 'Kalimantan Timur' },
          { id: 'Kalimantan Utara', text: 'Kalimantan Utara' },
          { id: 'Sulawesi Utara', text: 'Sulawesi Utara' },
          { id: 'Gorontalo', text: 'Gorontalo' },
          { id: 'Sulawesi Tengah', text: 'Sulawesi Tengah' },
          { id: 'Sulawesi Barat', text: 'Sulawesi Barat' },
          { id: 'Sulawesi Selatan', text: 'Sulawesi Selatan' },
          { id: 'Maluku', text: 'Maluku' },
          { id: 'Maluku Utara', text: 'Maluku Utara' },
          { id: 'Papua Barat', text: 'Papua Barat' },
          { id: 'Papua', text: 'Papua' },
        ]
      });
  });
//   $('#tambah-rekanan').on('click',function(){
//       if ($('#tmb-rekanan').is(':visible')) {
//           // Jika elemen sedang di-show
//           $('#tmb-rekanan').hide();
//         } else {
//           // Jika elemen sedang di-hide
//           $('#tmb-rekanan').show();
//           $('#tambah-nama').val("");
//           $('#tambah-nama').prop('placeholder','Ketik Nama Disini');
//           $('#tambah-telp').val("");
//           $('#tambah-telp').prop('placeholder','Ketik Telp Disini');
//         }
//   });
//   $('#submit-rekanan').on('click',function(){
//       var nama = $('#tambah-nama').val();
//       var telp = $('#tambah-telp').val();
      
//       if(nama == ''){
//           Toast.fire({
//               icon  : 'error',
//               title : "Isi Nama Dulu"
//           });
//       } else {
//           if(telp == ''){
//              Toast.fire({
//                   icon  : 'error',
//                   title : "Isi Telp Dulu"
//               }); 
//           } else {
//               // console.log(nama+"--"+telp);
//           }
//       }
//   });
  $('#form-tambah').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    // console.log(token);
    $.ajax({
      type  : 'post',
      url   : '{!! url("data-dbmarketing") !!}',
      data  : {
        user        : "{{$user->kode_karyawan}}",
        kategori    : $('#tambah_kategori').val(),
        nama        : $('#tambah_nama').val(),
        _token      : token,
        wilayah     : $('#tambah_wilayah').val(),
        kantor      : $('#tambah_alamat_kantor').val(),
        pabrik      : $('#tambah_alamat_pabrik').val(),
        rekanan     : $('#tambah_rekanan').val(),
        telp        : $('#tambah_telp').val(),
        email       : $('#tambah_email').val(),
        medsos      : $('#tambah_medsos').val(),
        purchasing  : $('#tambah_nama_purchasing').val(),
        nopurchasing: $('#tambah_nopurchasing').val(),
        pic         : $('#tambah_pic').val(),
        kebutuhan   : $('#tambah_kebutuhan').val(),
        PT          : $('#tambah_pt').val(),
        keterangan  : $('#tambah_keterangan').val(),
        hobby       : $('#tambah_hobby').val(),
        makanan     : $('#tambah_makanan').val(),
        sosmed      : $('#tambah_sosmed').val(),
        alamat      : $('#tambah_alamatpurchasing').val(),
      }, // serializes form input
      success:function(response) {
        // console.log(response);
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: response.pesan
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel-database').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: response.pesan
          })
        }
        
      }
    });
  });
//Tambah Data
//Detail Data
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-dbmarketing/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            // console.log(response);
          $('#detail_kategori').val(response.data.kategori);
          $('#detail_nama').val(response.data.nama_perusahaan);
          $('#detail_alamat_kantor').val(response.data.alamat_kantor);
          $('#detail_alamat_pabrik').val(response.data.alamat_pabrik);
          $('#detail_rekanan').val(response.data.orang_dalam);
          $('#detail_telp').val(response.data.telp_wa);
          $('#detail_email').val(response.data.email);
          $('#detail_medsos').val(response.data.medsos);
          $('#detail_wilayah').val(response.data.wilayah);
          $('#tambah_nama_purchasing').val(response.data.purchasing);
          $('#tambah_nopurchasing').val(response.data.no_purchasing);
          $('#detail_pic').val(response.data.marketing);
          $('#detail_kebutuhan').val(response.data.kebutuhan);
          $('#detail_pt').val(response.data.PT);
          $('#detail_keterangan').val(response.data.keterangan);
          $('#detail_nama_purchasing').val(response.data.purchasing);
          $('#detail_nopurchasing').val(response.data.no_purchasing);
          $('#detail_sosmed').val(response.data.sosmed);
          $('#detail_hobby').val(response.data.hobby);
          $('#detail_makanan').val(response.data.makanan);
          $('#detail_alamatpurchasing').val(response.data.alamat);
        }
      });
  });
//Detail Data
//Edit Data
  $('body').on('click', '.edit', function () {
      var kode = $(this).data('kode');
      $("#edit_wilayah").select2({
        placeholder: "Pilih Provinsi",
        allowClear: true,
        data: [
          { id: 'Aceh', text: 'Aceh' },
          { id: 'Sumatera Utara', text: 'Sumatera Utara' },
          { id: 'Sumatera Barat', text: 'Sumatera Barat' },
          { id: 'Riau', text: 'Riau' },
          { id: 'Jambi', text: 'Jambi' },
          { id: 'Sumatera Selatan', text: 'Sumatera Selatan' },
          { id: 'Bengkulu', text: 'Bengkulu' },
          { id: 'Lampung', text: 'Lampung' },
          { id: 'Kepulauan Bangka Belitun', text: 'Kepulauan Bangka Belitung' },
          { id: 'Kepulauan Riau', text: 'Kepulauan Riau' },
          { id: 'DKI Jakarta', text: 'DKI Jakarta' },
          { id: 'Jawa Barat', text: 'Jawa Barat' },
          { id: 'Jawa Tengah', text: 'Jawa Tengah' },
          { id: 'DI Yogyakarta', text: 'DI Yogyakarta' },
          { id: 'Jawa Timur', text: 'Jawa Timur' },
          { id: 'Banten', text: 'Banten' },
          { id: 'Bali', text: 'Bali' },
          { id: 'Nusa Tenggara Barat', text: 'Nusa Tenggara Barat' },
          { id: 'Nusa Tenggara Timur', text: 'Nusa Tenggara Timur' },
          { id: 'Kalimantan Barat', text: 'Kalimantan Barat' },
          { id: 'Kalimantan Tengah', text: 'Kalimantan Tengah' },
          { id: 'Kalimantan Selatan', text: 'Kalimantan Selatan' },
          { id: 'Kalimantan Timur', text: 'Kalimantan Timur' },
          { id: 'Kalimantan Utara', text: 'Kalimantan Utara' },
          { id: 'Sulawesi Utara', text: 'Sulawesi Utara' },
          { id: 'Gorontalo', text: 'Gorontalo' },
          { id: 'Sulawesi Tengah', text: 'Sulawesi Tengah' },
          { id: 'Sulawesi Barat', text: 'Sulawesi Barat' },
          { id: 'Sulawesi Selatan', text: 'Sulawesi Selatan' },
          { id: 'Maluku', text: 'Maluku' },
          { id: 'Maluku Utara', text: 'Maluku Utara' },
          { id: 'Papua Barat', text: 'Papua Barat' },
          { id: 'Papua', text: 'Papua' },
        ]
      });
      $('#edit_pic').empty();
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#edit_pic');
            var Nrow = $("<option value='-'>-</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
    
    $('#edit_filter_kategori').on('change',function(){
        var data = $(this).val();
        $('#edit_kategori').val(data);
    })
      $.ajax({
        url :'{!! url("data-dbmarketing/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            // console.log(response);
          $('#edit_kode').val(kode);
          $('#edit_kategori').val(response.data.kategori);
          $('#edit_nama').val(response.data.nama_perusahaan);
          $('#edit_alamat_kantor').val(response.data.alamat_kantor);
          $('#edit_alamat_pabrik').val(response.data.alamat_pabrik);
          $('#edit_rekanan').val(response.data.orang_dalam);
          @if($user->level == 'marketing')
            $('#edit_telp').val("-");
          @else
            $('#edit_telp').val(response.data.telp_wa);
          @endif
          $('#edit_filter_kategori').select2({
              placeholder : 'Pilih Kategori',
              ajax  :{
                url : '{!! url("dropdown-kategori") !!}',
                dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.kategori,
                                  id: item.kategori
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
            $('#edit_filter_kategori')
              .empty() //empty select
              .append($("<option/>") //add option tag in select
                  .val(response.data.kategori) //set value for option to post it
                  .text(response.data.kategori )) //set a text for show in select
              .val(response.data.kategori) //select option of select2
              .trigger("change"); //apply to select2
          $('#edit_email').val(response.data.email);
          $('#edit_wilayah').val(response.data.wilayah).trigger('change');
          $('#edit_nama_purchasing').val(response.data.purchasing);
          $('#edit_nopurchasing').val(response.data.no_purchasing);
          $('#edit_medsos').val(response.data.medsos);
          $('#edit_kebutuhan').val(response.data.kebutuhan);
          $('#edit_pt').val(response.data.PT);
          $('#edit_keterangan').val(response.data.keterangan);
          $('#edit_pic').val(response.data.PIC).trigger('change');
          $('#edit_nama_purchasing').val(response.data.purchasing);
          $('#edit_nopurchasing').val(response.data.no_purchasing);
          $('#edit_hobby').val(response.data.hobby);
          $('#edit_makanan').val(response.data.makanan);
          $('#edit_sosmed').val(response.data.sosmed);
          $('#edit_alamatpurchasing').val(response.data.alamat);
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
      type: 'put',
      url: '{!! url("data-dbmarketing/'+kode+'") !!}',
      data : {
        user        : "{{$user->kode_karyawan}}",
        kategori    : $('#edit_kategori').val(),
        nama        : $('#edit_nama').val(),
        _token      : token,
        kantor      : $('#edit_alamat_kantor').val(),
        pabrik      : $('#edit_alamat_pabrik').val(),
        rekanan     : $('#edit_rekanan').val(),
        telp        : $('#edit_telp').val(),
        wilayah     : $('#edit_wilayah').val(),
        email       : $('#edit_email').val(),
        medsos      : $('#edit_medsos').val(),
        purchasing  : $('#edit_nama_purchasing').val(),
        nopurchasing: $('#edit_nopurchasing').val(),
        pic         : $('#edit_pic').val(),
        kebutuhan   : $('#edit_kebutuhan').val(),
        PT          : $('#edit_pt').val(),
        keterangan  : $('#edit_keterangan').val(),
        sosmed      : $('#edit_sosmed').val(),
        hobby       : $('#edit_hobby').val(),
        makanan     : $('#edit_makanan').val(),
        alamat      : $('#edit_alamat').val(),
      }, // serializes form input
      success:function(response) {
          // console.log(response)
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-database').DataTable(); 
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
  
//Edit Data
//Hapus Data
  $('body').on('click', '.hapus', function () {
      document.getElementById("form-hapus").reset();
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      document.getElementById("kode").innerHTML = kode;
      document.getElementById("nama").innerHTML = nama;
      $('#hapus_kode').val(kode);

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
      url     : '{!! url("data-dbmarketing/'+kode+'") !!}',
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
          var table = $('#tabel-database').DataTable(); 
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
//Hapus Data
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
      // console.log(formData);
      $.ajax({
        type: 'post',
        url: '{!! url("upload-dbmarketing") !!}',
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
                Nrow.html("<td>"+nomor+"</td><td>"+data.data[0][n][0]+"</td><td>"+data.data[0][n][1]+"</td><td>"+data.data[0][n][2]+"</td><td>"+data.data[0][n][3]+"</td><td>"+data.data[0][n][4]+"</td><td>"+data.data[0][n][5]+"</td><td>"+data.data[0][n][6]+"</td><td>"+data.data[0][n][7]+"</td><td>"+data.data[0][n][8]+"</td><td>"+data.data[0][n][9]+"</td><td>"+data.data[0][n][10]+"</td><td>"+data.data[0][n][11]+"</td><td>"+data.data[0][n][12]+"</td><td>"+data.data[0][n][13]+"</td><td>"+data.data[0][n][14]+"</td></tr>");
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
// Aksi Data
    $(document).on('click','.aksi',function(){
        var data = $(this).data('kode');
        $('#tambah-nama').html('');$('#tambah-kantor').html('');$('#tambah-status').html('');
        $('#tambah-aksi').hide();$('#edit-aksi').hide();$('#hapus-aksi').hide();
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-dbmarketing/'+data+'/edit") !!}',
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $("#tambah-kode").val(data);
                    $('#tambah-nama').html(response.data.nama_perusahaan);
                    $('#tambah-kantor').html(response.data.alamat_kantor);
                    $('#tambah-status').html(response.data.status);
                    $('#btn-tambah-aksi').show();
                    tabelaksi(data);
                }else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    });
                }
            }
        });
    });
    
    //Tambah Aksi
        $('#btn-tambah-aksi').on('click',function(){
            document.getElementById("form-tambah-aksi").reset();
            @if($user->level == "marketing")
                $('#tambah-marketing').empty();
                var datahandler = $('#tambah-marketing');
                var Nrow = $("<option value=''>Pilih Marketing</option><option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
                datahandler.append(Nrow);
            @else
                $('#tambah-marketing').select2({
                    placeholder: 'Pilih Marketing',
                    ajax: {
                        url: '{!! url("dropdown-marketing") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.nama,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            @endif
            $('#tambah-aksi').show();$('#btn-tambah-aksi').hide();
        });
        $('#btn-aksi-cancel-tambah').on('click',function(){
            $('#tambah-aksi').hide();$('#btn-tambah-aksi').show();
        });
        $('#form-tambah-aksi').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-aksi-tambah');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var token = "{!! csrf_token() !!}";
            var kode =  $('#tambah-kode').val();
            $.ajax({
                type    : 'post',
                url     : '{!! url("data-aksidbmarketing")!!}',
                data    : {
                    _token : token,
                    kd_perusahaan : kode,
                    kd_marketing  : $('#tambah-marketing').val(),
                    tanggal       : $('#tambah-tanggal').val(),
                    jam           : $('#tambah-jam').val(),
                    laporan       : $('#tambah-laporan').val(),
                    user          : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        tabelaksi(kode);
                        document.getElementById("form-tambah-aksi").reset();
                        $('#btn-tambah-aksi').show();$('#tambah-aksi').hide();
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Tambah Aksi
    //Edit Aksi
        $(document).on('click','.editaksi',function(){
            $('#tambah-aksi').hide();$('#btn-tambah-aksi').hide();$('#hapus-aksi').hide();
            var data = $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-aksidbmarketing/'+data+'/edit")!!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        $('#edit-id').val(data);
                        $('#edit-tanggal').val(response.data.tanggal);
                        $('#edit-marketing').val(response.data.nama);
                        $('#edit-jam').val(response.data.jam);
                        $('#edit-laporan').val(response.data.laporan);
                        $('#edit-aksi').show();
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#btn-aksi-cancel-edit').on('click',function(){
            $('#edit-aksi').hide();$('btn-tambah-aksi').show();
        });
        $('#form-edit-aksi').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-aksi-edit');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var token = "{!! csrf_token() !!}";
            var data = $('#tambah-kode').val();
            var kode =  $('#edit-id').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-aksidbmarketing/'+kode+'")!!}',
                data    : {
                    _token : token,
                    tanggal       : $('#edit-tanggal').val(),
                    jam           : $('#edit-jam').val(),
                    laporan       : $('#edit-laporan').val(),
                    user          : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        document.getElementById("form-edit-aksi").reset();
                        $('#edit-aksi').hide();$('#btn-tambah-aksi').show();
                        tabelaksi(data);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Aksi
    //Hapus Aksi
        $(document).on('click','.hapusaksi',function(){
            $('#tambah-aksi').hide();$('#btn-tambah-aksi').hide();$('#edit-aksi').hide();$('#hapus-aksi').show();
            var data= $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-aksidbmarketing/'+data+'/edit")!!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        $('#hapus-id').val(data);
                        $('#hapus-tanggal').html(response.data.tanggal);
                        $('#hapus-laporan').html(response.data.laporan);
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#btn-aksi-cancel-hapus').on('click',function(){
            $('#hapus-aksi').hide();$('#btn-tambah-aksi').show();
        });
        $('#form-hapus-aksi').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-aksi-hapus');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var token = "{!! csrf_token() !!}";
            var data = $('#tambah-kode').val();
            var kode =  $('#hapus-id').val();
            $.ajax({
                type    : 'delete',
                url     : '{!! url("data-aksidbmarketing/'+kode+'") !!}',
                data    : {user: "{{$user->kode_karyawan}}"},
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        document.getElementById("form-tambah-aksi").reset();
                        $('#hapus-aksi').hide();$('#btn-tambah-aksi').show();
                        tabelaksi(data);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Hapus Aksi
    
    function tabelaksi(kode){
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-aksidbmarketing/'+kode+'") !!}',
            success : function(response){
                // console.log(response)
                if(response.success == true){
                    $('#tabel-body-aksi').empty();
                    var datahandler = $('#tabel-body-aksi');
                    var n = 0;
                    $.each(response.data,function(key,val){
                        var Nrow = $("<tr>");
                        var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td><button type='button' class='btn btn-default dropdown-toggle'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editaksi' style='color:orange' data-kode='"+response.data[n]['id']+"'><b>Edit</b></a><a class='dropdown-item hapusaksi' style='color:red' data-kode='"+response.data[n]['id']+"'><b>Hapus</b></a></div></td><td>"+response.data[n]['tanggal']+"</td><td>"+response.data[n]['jam']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['laporan']+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });
                }else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    });
                }
            }
        });
    }
// Aksi Data

 //UBAH PIC
    $(document).on('click','.PIC',function(){
        var data= $(this).data('kode');
        $('#kode-db').val(data);
        $('#ubah-pic').select2({
            placeholder: 'Pilih Marketing',
            ajax: {
                url: '{!! url("dropdown-marketing") !!}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.kode
                            }
                        })
                    };
                },
                cache: true
            }
        });
    })
    $('#form-pic').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-submit-pic');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var kode = $('#kode-db').val();
        $.ajax({
            type    : 'put',
            url     : '{!! url("ubah-pic-database/'+kode+'") !!}',
            data    : {
                marketing : $('#ubah-pic').val(),
                user    : "{{$user->kode_karyawan}}",
            },
            success:function(response){
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan
                    })
                    $('#modal-pic').modal('hide');
                    var table = $('#tabel-database').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    })
                }
            }
        })
    })
//UBAH PIC

//UBAH STATUS
    $(document).on('click','.status',function(){
        var data= $(this).data('kode');
        var status= $(this).data('status');
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-dbmarketing/'+data+'/edit") !!}',
            success : function(response){
                $('#kode-status').val(data);
                $('#ubah-status').val(status);
                if(status == '-'){
                    document.getElementById("header-status").className = "modal-header";
                    document.getElementById("btn-submit-status").className = "col-sm-4 form-control btn btn-primary";
                } else if(status == 'sudah-order'){
                    document.getElementById("header-status").className = "modal-header bg-success";
                    document.getElementById("btn-submit-status").className = "col-sm-4 form-control btn btn-success";
                } else {
                    document.getElementById("header-status").className = "modal-header bg-danger";
                    document.getElementById("btn-submit-status").className = "col-sm-4 form-control btn btn-danger";
                }
                $('#data-status').html(response.data.nama_perusahaan+" - "+response.data.marketing);
            }
        })
    })
    $('#form-status').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-submit-status');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var kode = $('#kode-status').val();
        $.ajax({
            type    : 'put',
            url     : '{!! url("ubah-status-database/'+kode+'") !!}',
            data    : {
                
                status : $('#ubah-status').val(),
                user    : "{{$user->kode_karyawan}}",
            },
            success:function(response){
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan
                    })
                    $('#modal-status').modal('hide');
                    var table = $('#tabel-database').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    })
                }
            }
        })
    })
//UBAH STATUS
//TARGET
    $(document).on('click','.target',function(){
        var data = $(this).data('kode');
        $('#tambah-nama-target').html('');$('#tambah-kantor-target').html('');$('#tambah-status-target').html('');
        $('#input-tambah-target').hide();
        $('#input-edit-target').hide();
        $('#hapus-target').hide();
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-dbmarketing/'+data+'/edit") !!}',
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $("#tambah-kode-target").val(data);
                    $('#tambah-nama-target').html(response.data.nama_perusahaan);
                    $('#tambah-kantor-target').html(response.data.alamat_kantor);
                    $('#tambah-status-target').html(response.data.status);
                    $('#btn-tambah-target').show();
                    tabeltarget(data);
                }else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    });
                }
            }
        });
    })
    //Tambah Target
        $('#btn-tambah-target').on('click',function(){
            $('#input-tambah-target').show();
            $('#btn-tambah-target').hide();
            document.getElementById("form-tambah-target").reset();
            @if($user->level == "marketing")
                $('#tambah-marketing-target').empty();
                var datahandler = $('#tambah-marketing-target');
                var Nrow = $("<option value=''>Pilih Marketing</option><option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
                datahandler.append(Nrow);
            @else
                $('#tambah-marketing-target').empty();
                $.ajax({
                  url :'{!! url("dropdown-marketing") !!}',
                  type : 'get',
                  success : function(data){
                    var datahandler = $('#tambah-marketing-target');
                    var Nrow = $("<option value=''>Pilih Marketing</option>");
                    datahandler.append(Nrow);
                    $.each(data, function(key,val){
                      var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                      datahandler.append(Nrow);
                    });
                    
                  }
                });
            @endif
        })
        $('#tambah-qty-target').keyup(function(){
          var qty = $(this).val();
          if( qty == null ){
            return false;
          } else{
            var harga = $('#tambah-harga-target').val();
            if (harga == null){
                return false;
            } else {
                var total =  qty*harga;
                $('#tambah-total-target').val(formatRupiah(total));
            }
          }
        });
        $('#tambah-harga-target').keyup(function(){
          var harga = $(this).val();
          if( harga == null ){
            return false;
          } else{
            var qty = $('#tambah-qty-target').val();
            if (qty == null){
                return false;
            } else {
                var total =  qty*harga;
                $('#tambah-total-target').val(formatRupiah(total));
            }
          }
        });
        $('#btn-target-cancel-tambah').on('click',function(){
            $('#btn-tambah-target').show();
            $('#input-tambah-target').hide();
        })
        $('#form-tambah-target').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-target-tambah');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            $.ajax({
                type : 'post',
                url     : '{!! url("data-target-marketing") !!}',
                data    :{
                    perusahaan:$('#tambah-kode-target').val(),
                    marketing :$('#tambah-marketing-target').val(),
                    tanggal   :$('#tambah-tgl-target').val(),
                    barang    :$('#tambah-barang-target').val(),
                    qty       :$('#tambah-qty-target').val(),
                    harga     :$('#tambah-harga-target').val(),
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        })
                        document.getElementById("form-tambah-target").reset();
                        $('#input-tambah-target').hide();
                        $('#btn-tambah-target').show();
                        var data = $('#tambah-kode-target').val();
                        tabeltarget(data);
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            })
        })
    //Tambah Target
    //Edit Target
        $(document).on('click','.edittarget',function(){
            var data = $(this).data('kode');
            $('#input-tambah-target').hide();
            $('#input-edit-target').show();
            $('#hapus-target').hide();
            $('#btn-tambah-target').hide();
             @if($user->level == "marketing")
                $('#edit-marketing-target').empty();
                var datahandler = $('#edit-marketing-target');
                var Nrow = $("<option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
                datahandler.append(Nrow);
                $('#edit-marketing-target').prop('disabled',true);
            @else
                $('#edit-marketing-target').empty();
                $.ajax({
                  url :'{!! url("dropdown-marketing") !!}',
                  type : 'get',
                  success : function(data){
                    var datahandler = $('#edit-marketing-target');
                    
                    $.each(data, function(key,val){
                      var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                      datahandler.append(Nrow);
                    });
                  }
                });
            @endif
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-target-marketing/'+data+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        $("#edit-kode-target").val(data);
                        $('#edit-tgl-target').val(response.data.tanggal);
                        $('#edit-barang-target').val(response.data.barang);
                        $('#edit-qty-target').val(response.data.qty);
                        $('#edit-harga-target').val(response.data.harga);
                        $('#edit-total-target').val(formatRupiah(response.data.total));
                        var datahandler = $('#edit-marketing-target');
                        var Nrow = $("<option value='"+response.data.kd_marketing+"' selected>"+response.data.marketing+"</option>");
                        datahandler.append(Nrow);
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        })
        $('#btn-target-cancel-edit').on('click',function(){
            $('#input-edit-target').hide();
            $('#btn-tambah-target').show();
        })
        $('#edit-qty-target').keyup(function(){
          var qty = $(this).val();
          if( qty == null ){
            return false;
          } else{
            var harga = $('#edit-harga-target').val();
            if (harga == null){
                return false;
            } else {
                var total =  qty*harga;
                $('#edit-total-target').val(formatRupiah(total));
            }
          }
        });
        $('#edit-harga-target').keyup(function(){
          var harga = $(this).val();
          if( harga == null ){
            return false;
          } else{
            var qty = $('#edit-qty-target').val();
            if (qty == null){
                return false;
            } else {
                var total =  qty*harga;
                $('#edit-total-target').val(formatRupiah(total));
            }
          }
        });
        $('#form-edit-target').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-target-edit');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var kode = $('#edit-kode-target').val();
            $.ajax({
                type : 'put',
                url     : '{!! url("data-target-marketing/'+kode+'") !!}',
                data    :{
                    marketing :$('#edit-marketing-target').val(),
                    tanggal   :$('#edit-tgl-target').val(),
                    barang    :$('#edit-barang-target').val(),
                    qty       :$('#edit-qty-target').val(),
                    harga     :$('#edit-harga-target').val(),
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        })
                        $('#input-edit-target').hide();
                        $('#btn-tambah-target').show();
                        var data = $('#tambah-kode-target').val();
                        tabeltarget(data);
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            })
        });
    //Edit Target
    //Hapus Target
        $(document).on('click','.hapustarget',function(){
            var data = $(this).data('kode');
            // console.log(data);
            $('#input-tambah-target').hide();
            $('#input-edit-target').hide();
            $('#hapus-target').show();
            $('#btn-tambah-target').hide();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-target-marketing/'+data+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        $("#hapus-id-target").val(data);
                        $('#hapus-tanggal-target').html(" "+response.data.tanggal);
                        $('#hapus-keterangan-target').html(" "+response.data.barang+" => "+formatRupiah(response.data.total));
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#btn-target-cancel-hapus').on('click',function(){
            $('#hapus-target').hide();
            $('#btn-tambah-target').show();
        });
        $('#form-hapus-target').submit(function(e){
             e.preventDefault(); // prevent actual form submit
            var el = $('#btn-target-hapus');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var kode = $('#hapus-id-target').val();
            $.ajax({
                type : 'delete',
                url     : '{!! url("data-target-marketing/'+kode+'") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        })
                        var data = $('#tambah-kode-target').val();
                        tabeltarget(data);
                        $('#hapus-target').hide();
                        $('#btn-tambah-target').show();
                    }else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            })
        });
    //Hapus Target
    function tabeltarget(kode){
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-target-marketing/'+kode+'") !!}',
            success : function(response){
                // console.log(response)
                if(response.success == true){
                    $('#tabel-body-target').empty();
                    var datahandler = $('#tabel-body-target');
                    var n = 0;
                    $.each(response.data,function(key,val){
                        var Nrow = $("<tr>");
                        var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td><button type='button' class='btn btn-default dropdown-toggle'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edittarget' style='color:orange' data-kode='"+response.data[n]['id']+"'><b>Edit</b></a><a class='dropdown-item hapustarget' style='color:red' data-kode='"+response.data[n]['id']+"'><b>Hapus</b></a></div></td><td>"+response.data[n]['tanggal']+"</td><td>"+response.data[n]['marketing']+"</td><td>"+response.data[n]['barang']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });
                }else {
                    Toast.fire({
                        icon    : 'error',
                            title   : response.pesan
                    });
                }
            }
        });
    }
//TARGET
</script>
</body>
</html>
