<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Aset</title>
    </head>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
          <!-- Navbar -->
          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">

            <h4><b> Nusa Pratama Anugerah </b></h4>
          </div>
          <!-- /.navbar -->
          @include('layout/navbar')

          <!-- Main Sidebar Container -->
          @include('layout/sidebar')


          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Data Aset</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="main">Home</a></li>
                      <li class="breadcrumb-item active">Data Aset</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-orange">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>0</h4>
                                        <p><strong>Sarana dan prasarana</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>86</h4>
                                        <p><strong>Inventaris kantor</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>14</h4>
                                        <p><strong>Mesin dan tangki</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>8</h4>
                                        <p><strong>Kendaraan</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>0</h4>
                                        <p><strong>Tanah</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>0</h4>
                                        <p><strong>Bangunan</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>0</h4>
                                        <p><strong>Other</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>0</h4>
                                        <p><strong>Aset dalam penyelesaian</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-lime">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4>12</h4>
                                        <p><strong>Peralatan dan perlengkapan gudang</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <a class="small-box-footer subinstansi" data-toggle="modal"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                          <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Aset</button>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="tabel-aset" class="table  table-striped">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th style="min-width:120px">Action</th>
                            <th style="min-width:150px" >Tipe</th>
                            <th style="min-width:200px">Nama</th>
                            <th style="min-width:120px">TGL Pembelian</th>
                            <th>Jumlah</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
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
          <!-- /.content-wrapper -->

        <!-- MODAL -->
          <!-- MODAL Tambah Aset -->
            <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <form id="form-tambah" action="#" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="modal-header bg-primary">
                              <h4 class="modal-title">Tambah Data Aset</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <b><span aria-hidden="true">&times;</span></b>
                              </button>
                          </div>
                          <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tipe</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" id="tambah-tipe" name="tambah_tipe" required >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="tambah-nama" name="tambah_nama" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tgl Pembelian</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="tambah-pembelian" name="tambah_pembelian" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Harga</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" id="tambah-harga" name="tambah_harga" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Qty</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" id="tambah-qty" name="tambah_qty" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Kondisi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control" id="tambah-kondisi" name="tambah_kondisi" required>
                                                <option value="">Pilih Kondisi</option>
                                                <option value="normal">Normal</option
                                                <option value="bekas">Bekas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Preview Foto</label>
                                            <br>
                                            <img class="img-fluid" id="preview" style="max-height:280px;" src="https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png" alt="Photo">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-2">
                                    <label>Lokasi</label>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control" id="tambah-lokasi" name="tambah_lokasi" required></select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Foto</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="file" id="tambah-foto" name="tambah_foto" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group kendaraan">
                                <div class="col-lg-2">
                                    <label>No Mesin</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="tambah-nomesin" name="tambah_nomesin">
                                </div>
                                <div class="col-lg-2">
                                    <label>No Rangka</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="tambah-norangka" name="tambah_norangka">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-2">
                                    <label class="kendaraan">Plat Nomor</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control kendaraan" id="tambah-plat" name="tambah_plat">
                                </div>
                                <div class="col-lg-2">
                                    <label>Keterangan</label>
                                </div>
                                <div class="col-lg-4">
                                    <textarea class="form-control" id="tambah-keterangan" name="tambah_keterangan"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between ">
                              <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" id="btn-tambah" class=" col-sm-4 form-control btn btn-primary">Tambah</button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
          <!--/ Modal Tambah Aset -->
          <!-- Modal Detail Aset -->
            <div class="modal fade" id="modal-detail">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Detail Data Aset</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-lg-6">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tipe</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-tipe" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-nama" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tgl Pembelian</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-pembelian" readonly>

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Harga</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-harga" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Qty</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-qty" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Kondisi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-kondisi" readonly>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <label>Preview Foto</label>
                                            <br>
                                            <img class="img-fluid" id="detail-preview" style="max-height:300px;"  alt="Photo">
                                        </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Lokasi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-lokasi" readonly>
                                        </div>
                                    </div>
                                    <div class="row kendaraan">
                                        <div class="col-lg-4">
                                            <label>No Mesin</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-nomesin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row kendaraan">
                                        <div class="col-lg-4">
                                            <label>Plat Nomor</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control kendaraan" id="detail-plat" readonly>
                                        </div>
                                    </div>
                                    <div class="row kendaraan">
                                        <div class="col-lg-4">
                                            <label>No Rangka</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="detail-norangka" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" id="tambah-keterangan" readonly style="resize:none;" rows="3"></textarea>
                                        </div>
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
          <!-- /Modal Detail Aset -->
          <!-- MODAL Edit Aset -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="form-edit" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header bg-warning">
                                <h4 class="modal-title">Edit Data Aset</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <input type="hidden" id="edit-kode" name="edit_kode">
                                            <label>Tipe</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" id="edit-tipe" name="edit_tipe" required >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="edit-nama" name="edit_nama" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tgl Pembelian</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="date" class="form-control" id="edit-pembelian" name="edit_pembelian">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Harga</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" id="edit-harga" name="edit_harga" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Qty</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="number" class="form-control" id="edit-qty" name="edit_qty" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Kondisi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control" id="edit-kondisi" name="edit_kondisi" required>
                                                <option value="">Pilih Kondisi</option>
                                                <option value="baru">Baru</option>
                                                <option value="normal">Normal</option>
                                                <option value="bekas">Bekas</option>
                                                <option value="rusak ringan">Rusak Ringan</option>
                                                <option value="rusak sedang">Rusak Sedang</option>
                                                <option value="rusak berat">Rusak Berat</option>
                                                <option value="habis pakai">Habis Pakai</option>
                                                <option value="kadaluarsa">Kadaluarsa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <label>Preview Foto</label> <br>
                                            <img class="img-fluid" id="edit-preview" style="max-height:280px;" src="https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png" alt="Photo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-2">
                                    <label>Lokasi</label>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control" id="edit-lokasi" name="edit_lokasi" required></select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Foto</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="file" id="edit-foto" name="edit_foto" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group kendaraan">
                                <div class="col-lg-2">
                                    <label>No Mesin</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" id="edit-nomesin" name="edit_nomesin">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" id="edit-norangka" name="edit_norangka">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="kendaraan">Plat Nomor</label>
                                </div>
                                <div class="col-lg-4">
                                    <label class="kendaraan">Plat Nomor</label>
                                    <input type="text" class="form-control kendaraan" id="edit-plat" name="edit_plat" >
                                </div>
                                <div class="col-lg-2">
                                    <label> Keterangan</label>
                                </div>
                                <div class="col-lg-4">
                                    <textarea class="form-control" id="edit-keterangan" name="edit_keterangan" style="resize:none;" rows="3"></textarea>
                                </div>
                            </div>
                          </div>
                            <div class="modal-footer justify-content-between ">
                                <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-edit" class=" col-sm-4 form-control btn btn-warning">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!--/ Modal Edit Aset -->
          <!-- MODAL Hapus Aset -->
            <div class="modal fade" id="modal-hapus">
                <div class="modal-dialog modal-sm">
                    <form id="form-hapus">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h4 class="modal-title">Hapus Data Aset</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                  Apakah Anda Yakin Akan Menghapus Data ini ?
                                  <div class="row">
                                      <input id="hapus-kode" class="form-control" type="text" required hidden>
                                      <label class=" col-md-3">Nama </label>
                                      <label class="col-md-1">:</label>
                                      <label class="col-md-8" id="hapus-nama" ></label>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between ">
                                <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          <!--/ Modal Hapus Bank -->
        <!--/ MODAL -->

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
        <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- Page specific script -->
        <script>
            $('.select2').select2();
          $(document).ready(function() {
            $('#tabel-aset').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                ajax: '{!! url("data-aset") !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'nama_perkiraan', name: 'nama_perkiraan',orderable:true},
                    { data: 'nama', name: 'nama',orderable:true},
                    { data: 'tgl_pembelian', name: 'tgl_pembelian',orderable:true},
                    { data: 'jumlah', name: 'jumlah',orderable:true},
                    { data: 'tempat', name: 'tempat',orderable:true},
                    { data: 'kondisi', name: 'kondisi',orderable:true},
                    { data: 'status', name: 'status',orderable:true},
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

          //Tambah
              $(document).on('click','#tambahdata',function(){
                document.getElementById("form-tambah").reset();
                document.getElementById('preview').src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                $('#tambah-tipe').empty();
                $('#tambah-tipe').select2({
                    placeholder: 'Pilih Tipe Aset',
                    ajax: {
                      url: '{!! url("dropdown-kodeaset") !!}',
                      dataType: 'json',
                      processResults: function (data) {
                          return {
                              results: $.map(data, function (item) {
                                  return {
                                      text: item.nama_perkiraan,
                                      id: item.kode
                                  }
                              })
                          };
                      },
                      cache: true
                    }
                });
                document.getElementById("tambah-tipe").focus();

                $('.kendaraan').hide();
                $('#tambah-lokasi').empty();
                $('#tambah-lokasi').select2({
                    placeholder: 'Pilih Lokasi Aset',
                    ajax: {
                        url: '{!! url("dropdown-gudang") !!}',
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
              });
              $('#tambah-tipe').on('change',function(){
                  var tipe = $(this).val();
                  if(tipe == 253){
                      $('.kendaraan').show();
                  } else {
                      $('.kendaraan').hide();
                  }
              });
              $('#tambah-foto').change(function() {
                  var size = this.files[0].size;
                  var preview = document.querySelector('#preview');
                  if(size > 5000000) {
                      Toast.fire({
                            icon: 'error',
                            title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
                        })
                      $('#tambah_foto').val('');
                      document.getElementById("preview").src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                  } else {
                      var preview = document.querySelector('#preview');
                      var file    = document.querySelector('#tambah-foto').files[0];
                      var reader  = new FileReader();

                      reader.onloadend = function () {
                        preview.src = reader.result;
                      }

                      if (file) {
                        reader.readAsDataURL(file);
                      } else {
                        preview.src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                      }
                  }
                });
              $('#form-tambah').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-tambah');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var token = "{!! csrf_token() !!}";
                var tipe = $('#tambah-tipe').val();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = new FormData(form[0]);
                $.ajax({
                  url: '{!! url("data-aset") !!}',
                  type: method,
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType: 'json',
                //   data : {
                //     tipe     : $('#tambah-tipe').val(),
                //     _token   : token,
                //     nama     : $('#tambah-nama').val(),
                //     qty      : $('#tambah-qty').val(),
                //     tgl_beli : $('#tambah-pembelian').val(),
                //     harga    : $('#tambah-harga').val(),
                //     lokasi   : $('#tambah-lokasi').val(),
                //     kondisi  : $('#tambah-kondisi').val(),
                //     mesin    : $('#tambah-nomesin').val(),
                //     rangka   : $('#tambah-norangka').val(),
                //     plat     : $('#tambah-plat').val(),
                //     keterangan : $('#tambah-keterangan').val(),

                //   }, // serializes form input
                  success:function(response) {

                    if(response.success == true ){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-tambah').modal('hide');
                      var table = $('#tabel-aset').DataTable();
                      $('#tambahdata').focus();
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
          //Tambah
          //Detail
            $('body').on('click', '.detail', function () {
              var kode = $(this).data('kode');
              $('.kendaraan').hide();
              $.ajax({
                url :'{!! url("data-aset/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response)
                  if(response.success == true){
                    $('#detail-nama').val(response.data.nama);
                    $('#detail-qty').val(response.data.jumlah);
                    $('#detail-pembelian').val(response.data.tgl_pembelian);
                    $('#detail-harga').val(formatRupiah(response.data.harga_beli));
                    $('#detail-kondisi').val(response.data.kondisi);
                    $('#detail-keterangan').val(response.data.keterangan);
                    $('#detail-lokasi').val(response.data.tempat);
                    $('#detail-tipe').val(response.data.nama_perkiraan);
                    if(response.data.tipe == 253){
                        $('#detail-nomesin').val(response.data.no_mesin);
                        $('#detail-norangka').val(response.data.no_rangka);
                        $('#detail-plat').val(response.data.plat_nomor);
                        $('.kendaraan').show();
                    } else {
                        $('#detail-nomesin').val('');
                        $('#detail-norangka').val('');
                        $('#detail-plat').val('');
                        $('.kendaraan').hide();
                    }
                    if(response.data.foto == "/img/aset/"){
                        document.getElementById('detail-preview').src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                    } else {
                        var baseUrl = window.location.origin;
                        var fotoUrl = baseUrl + response.data.foto;
                        document.getElementById('detail-preview').src = fotoUrl;
                    }
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: response.pesan
                    })
                  }
                }
              });
          });
          //Detail
          //Edit
            $('body').on('click', '.edit', function () {
                var kode = $(this).data('kode');
                document.getElementById("form-edit").reset();
                $('.kendaraan').hide();
                $.ajax({
                    url :'{!! url("data-aset/'+kode+'/edit") !!}',
                    type : 'get',
                    success : function(response){

                      if(response.success == true){
                        $('#edit-kode').val(kode);
                        $('#edit-nama').val(response.data.nama);
                        $('#edit-qty').val(response.data.jumlah);
                        $('#edit-pembelian').val(response.data.tgl_pembelian);
                        $('#edit-harga').val(response.data.harga_beli);
                        $('#edit-kondisi').val(response.data.kondisi);
                        $('#edit-keterangan').val(response.data.keterangan);
                        $('#edit-tipe').empty();
                        $('#edit-tipe').select2({
                            placeholder: 'Pilih Tipe Aset',
                            ajax: {
                              url: '{!! url("dropdown-kodeaset") !!}',
                              dataType: 'json',
                              processResults: function (data) {
                                  return {
                                      results: $.map(data, function (item) {
                                          return {
                                              text: item.nama_perkiraan,
                                              id: item.kode
                                          }
                                      })
                                  };
                              },
                              cache: true
                            }
                        });
                        $('#edit-tipe')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.tipe) //set value for option to post it
                                .text(response.data.nama_perkiraan)) //set a text for show in select
                            .val(response.data.tipe) //select option of select2
                            .trigger("change"); //apply to select2
                        $('#edit-lokasi').empty();
                        $('#edit-lokasi').select2({
                            ajax: {
                                url: '{!! url("dropdown-gudang") !!}',
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
                        $('#edit-lokasi')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.lokasi) //set value for option to post it
                                .text(response.data.tempat)) //set a text for show in select
                            .val(response.data.lokasi) //select option of select2
                            .trigger("change"); //apply to select2
                        if(response.data.tipe == 253){
                            $('#edit-nomesin').val(response.data.no_mesin);
                            $('#edit-norangka').val(response.data.no_rangka);
                            $('#edit-plat').val(response.data.plat_nomor);
                            $('.kendaraan').show();
                        } else {
                            $('#edit-nomesin').val("");
                            $('#edit-norangka').val("");
                            $('#edit-plat').val("");
                            $('.kendaraan').hide();
                        }
                        if(response.data.foto == "/img/aset/"){
                              document.getElementById('edit-preview').src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                        } else {
                              var baseUrl = window.location.origin;
                              var fotoUrl = baseUrl + response.data.foto;
                              document.getElementById('edit-preview').src = fotoUrl;
                        }
                      } else {
                        Toast.fire({
                          icon: 'error',
                          title: response.pesan
                        })
                      }
                    }
                });
            });
            $('#edit-foto').change(function() {
              var size = this.files[0].size;
              var preview = document.querySelector('#edit-preview');
              if(size > 5000000) {
                  Toast.fire({
                        icon: 'error',
                        title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
                    })
                  $('#tambah_foto').val('');
                  document.getElementById("edit-preview").src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
              } else {
                  var preview = document.querySelector('#edit-preview');
                  var file    = document.querySelector('#edit-foto').files[0];
                  var reader  = new FileReader();

                  reader.onloadend = function () {
                    preview.src = reader.result;
                  }

                  if (file) {
                    reader.readAsDataURL(file);
                  } else {
                    preview.src = "https://temonwetan-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png";
                  }
              }
            });
            $('#form-edit').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-edit');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var kode = $('#edit-kode').val();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(form[0]);
                console.log(data);
                $.ajax({
                  url: '{!! url("update-aset/'+kode+'") !!}',
                  method: 'POST',
                  data: data,
                  processData: false,
                  contentType: false,
                //   data : {
                //     tipe     : $('#edit-tipe').val(),
                //     nama     : $('#edit-nama').val(),
                //     _token   : token,
                //     qty      : $('#edit-qty').val(),
                //     harga    : $('#edit-harga').val(),
                //     tgl_pembelian : $('#edit-pembelian').val(),
                //     lokasi   : $('#edit-lokasi').val(),
                //     kondisi  : $('#edit-kondisi').val(),
                //     keterangan : $('#edit-keterangan').val(),
                //     mesin    : $('#edit-nomesin').val(),
                //     rangka   : $('#edit-norangka').val(),
                //     plat     : $('#edit-plat').val(),
                //   }, // serializes form input
                  success:function(response) {
                    console.log(response);
                    if(response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-edit').modal('hide');
                      var table = $('#tabel-aset').DataTable();
                      table.ajax.reload( null, false );
                      $('#tambahdata').focus();
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }

                  },
                });
              });
          //Edit
          //Hapus
            $('body').on('click', '.hapus', function () {
              document.getElementById("form-hapus").reset();
              var nama = $(this).data('nama');
              var kode = $(this).data('kode');

              document.getElementById("hapus-nama").innerHTML = nama ;
              $('#hapus-kode').val(kode);
            });
            $('#form-hapus').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-hapus');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var token = "{!! csrf_token() !!}";
                var kode = $('#hapus-kode').val();
                $.ajax({
                  type    : 'delete',
                  url     : '{!! url("data-aset/'+kode+'") !!}',
                  data    : {
                    _token  : token,
                  },
                  success:function(response) {

                    if(response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-hapus').modal('hide');
                      var table = $('#tabel-aset').DataTable();
                      table.ajax.reload( null, false );
                      $('#tambahdata').focus();
                    } else{
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  },
                });
            });
          //Hapus






          function angka(evt){
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (charCode > 31 && (charCode < 48 || charCode > 57))

                  return false;
              return true;
          }
          function formatRupiah(money) {
            return new Intl.NumberFormat('id-ID',
              { style: 'currency', currency: 'IDR' }
            ).format(money);
          }
        </script>
    </body>
</html>
