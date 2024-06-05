<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Transaksi Kas</title>
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
            <h1>Transaksi Kas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row justify-content-between">
                    
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Transaksi Kas/Bank</button>
                    <div>
                        <button type="button" id="ke-kas" class="btn btn-danger"><i class="fas fa-file"></i> Jurnal</button>
                        <button type="button" id="cancel-filter" class="btn btn-default">Cancel</button>
                        <button type="button" id="cek-filter" class="btn bg-gradient-success"><i class="fas fa-filter"></i>Filter</button>
                    </div>
                </div>
                <br>
                <form id="form-filter">
                    <div id="filter" class="row">
                        <div class="col-lg-2">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control" id="filter-awal" required>
                            
                        </div>
                        <div class="col-lg-2">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" id="filter-akhir" required>
                        </div>
                        <div class="col-lg-3">
                            <label>Jenis</label>
                            <select id="filter-jenis" class="form-control" required>
                                <option value="">Pilih Jenis KAS</option>
                                <option value="d">Debit</option>
                                <option value="k">Kredit</option>
                                <option value="all">Semua</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Status</label>
                            <select id="filter-status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Belum Diperiksa">Belum Diperiksa</option>
                                <option value="Sudah Diperiksa">Sudah Diperiksa</option>
                                <option value="Selesai">Selesai</option>
                                <option value="all">Semua</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <br>
                            <button type="submit" class="btn btn-primary" id="btn-submit-filter">Cari</button>
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-filter" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>KAS</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Keterangan KAS</th>
                            <th>Status</th>
                            <th>Kode Transaksi</th>
                            <th>Vat</th>
                            <th>Harga</th>
                            <th>QTY</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                </table>
                <table id="tabel-kas" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>D/K</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
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
  <!-- /.content-wrapper -->

<!-- MODAL -->
<!-- MODAL Tambah  -->
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Buat Transaksi Kas/Bank</h4>
                    <button type="button" id="btn-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Kas</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Tanggal</label>
                                        <input id="tmb-tgl" class="form-control" type="date" required>
                                        <label>Kas Masuk/Keluar</label>
                                        <select id="tmb-jenis" class="form-control">
                                            <option value="">Pilih Jenis Transaksi</option>
                                            <option value="D">Masuk</option>
                                            <option value="K">Keluar</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Kode Transaksi</label>
                                        <input id="tmb-kode" class="form-control" type="text" value=""readonly required>
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <label> Kas</label>
                                        <select id="tmb-debit" class="form-control select2" required></select>
                                        <label> Keterangan</label>
                                        <textarea  id="tmb-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Kas Masuk" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row ">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4 custom control custom-switch">
                                    
                                    <input type="checkbox" class="custom-control-input form-control" id="kunci">
                                    <label class="custom-control-label" for="kunci" >Kunci </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Barang</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <div class="row">
                                                <button id="btn-add-barang" class="btn btn-primary">Tambah Transaksi</button>
                                            </div>
                                            <div class="row" id="tambah-barang">
                                                <form id="form-tambah-barang">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label>Tujuan Transaksi</label>
                                                            <select id="tambah-kredit-barang" class="form-control select2"></select>
                                                        <div id="tambah-transaksi">
                                                            <label>Transaksi</label>
                                                            <select id="tambah-transaksi-barang" class="form-control select2"></select>
                                                        </div>
                                                        <div id="tambah-lain">
                                                            <label>Invoice Transaksi</label>
                                                            <input id="tambah-invoice-barang" class="form-control" type="text" >
                                                        </div>
                                                        <div id="tambah-data-barang">
                                                            <label>Barang</label>
                                                            <input id="tambah-nama-barang" class="form-control" type="text" readonly>
                                                            <label>Kekurangan</label>
                                                            <input id="tambah-kekurangan-bayar" class="form-control" type="text" readonly>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Harga</label>
                                                        <input id="tambah-harga-barang" class="form-control" type="number" step=".001" min="0" required >
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>QTY</label>
                                                        <input id="tambah-qty-barang" class="form-control" type="number" min="1" required > 
                                                        <label> VAT</label>
                                                        <input id="tambah-vat-barang" type="number" min="0" max="20" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label> Total</label>
                                                        <input type="text" class="form-control" id="tambah-total-barang" readonly >
                                                        <label>Keterangan</label>
                                                        <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                    </div>
                                                    <div class="col-lg-4">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <br>
                                                        <div class="row justify-content-between">
                                                        <button type="submit" id="btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Transaksi</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="row" id="edit-barang">
                                                <form id="form-edit-barang">
                                                    <div class="row">
                                                    <div class="col-lg-4">
                                                        <input id="edit-kode-barang" class="form-control" type="text" hidden>
                                                        <label> Tujuan Transaksi</label>
                                                        <input id="edit-kredit-barang" class="form-control" readonly>
                                                        <label>Invoice Transaksi</label>
                                                        <input id="edit-invoice-barang" class="form-control" type="text" readonly>
                                                        
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>Harga</label>
                                                        <input id="edit-harga-barang" class="form-control" step=".001" type="number" min="0" required >
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>QTY</label>
                                                        <input id="edit-qty-barang" class="form-control" type="number" min="1" required >  
                                                        <label> VAT</label>
                                                        <input id="edit-vat-barang" type="number" min="0" max="20" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-4 ">
                                                        <label>Total</label>
                                                        <input type="text" class="form-control" id="edit-total-barang" readonly>
                                                        <label>Keterangan</label>
                                                        <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                        </div>
                                                        <div class="col-lg-4">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <br>
                                                            <div class="row justify-content-between">
                                                            <button type="button" id="btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                            <button type="submit" id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Transaksi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="row" id="hapus-barang">
                                                <form id="form-hapus-barang">
                                                    <input id="hapus-kode-barang" class="form-control" type="text" hidden>
                                                    <div class="row justify-content-center ">
                                                    <label> Apakah Anda yakin akan menghapus Transaksi ini ??</label>
                                                    </div>
                                                    <div class="row justify-content-center" > 
                                                        <label class="col-lg-3">Kode Transaksi </label>
                                                        <label id ="hapus-transaksi" class="col-lg-9"></label>
                                                    </div>
                                                    <br>
                                                    <div class="row justify-content-between ">
                                                    <button type="button"  id="btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                                    <button type="submit"  id="btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Transaksi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table  class="table table-responsive table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">Action</th>
                                                <th rowspan="2">No.</th>
                                                <th rowspan="2">Kode Transaksi</th>
                                                <th rowspan="2">Harga</th>
                                                <th rowspan="2">QTY</th>
                                                <th rowspan="2">VAT</th>
                                                <th rowspan="2">Total</th>
                                                <th rowspan="2">Keterangan</th>
                                                <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                                <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                            </tr>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Perkiraan</th>
                                                <th>Kode</th>
                                                <th>Nama Perkiraan</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbl_kas_tambah">
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <form id="tmbkas">
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--/ Modal Tambah -->
  
  <!-- Modal Detail  -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Detail Transaksi Kas</h4>
                        <button type="button" id="btn-detail-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Tanggal</label>
                                <input id="dtl-tgl" class="form-control" type="date" readonly>
                                <label>Jenis Transaksi</label>
                                <input id="dtl-jenis" class="form-control" type="text" readonly>
                            </div>
                            <div class="col-lg-4">
                                <label>Kode Transaksi</label>
                                <input id="dtl-kode" class="form-control" type="text" value=""readonly>
                            </div>
                            <div class="col-lg-4">
                                <label> Keterangan</label>
                                <textarea  id="dtl-keterangan" class="form-control" row="2" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table  class="table table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Kode Transaksi</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">QTY</th>
                                    <th rowspan="2">VAT</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Keterangan</th>
                                    <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                    <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                </tr>
                                </thead>
                                <tbody id="tbl_kas_detail">
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <form id="dtlkas">
                    <div class="modal-footer justify-content-between ">
                        <input type="text" id="dtl-status" class="form-control" hidden>
                        <button type="button" id="btn-close-detail" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-detail"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <!-- /Modal Detail  -->
  <!-- MODAL Edit  -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Transaksi/Kas</h4>
                    <button type="button" id="btn-edit-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Tanggal</label>
                            <input id="edt-tgl" class="form-control" type="date" readonly>
                            <label>Jenis Transaksi</label>
                            <input id="edt-dk" class="form-control" type="hidden">
                            <input id="edt-jenis" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Kode Transaksi</label>
                            <input id="edt-kode" class="form-control" type="text" value=""readonly required>
                        </div>
                        <div class="col-lg-4">
                            
                            <label> Keterangan</label>
                            <textarea  id="edt-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Transaksi Kas" ></textarea>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4 custom control custom-switch">
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                            <button id="edt-btn-add-barang" class="btn btn-primary">Tambah Transaksi</button>
                            </div>
                            <div class="row" id="edt-tambah-barang">
                                <form id="edt-form-tambah-barang">
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <label>Kas</label>
                                        <select id="edt-tambah-debit-barang" class="form-control select2" required></select>
                                        <label>Tujuan Transaksi</label>
                                        <select id="edt-tambah-kredit-barang" class="form-control select2"></select>
                                        <div id="edt-tambah-transaksi">
                                            <label>Transaksi</label>
                                            <select id="edt-tambah-transaksi-barang" class="form-control select2"></select>
                                        </div>
                                        <div id="edt-tambah-lain">
                                            <label>Invoice Transaksi</label>
                                            <input id="edt-tambah-invoice-barang" class="form-control" type="text" >
                                        </div>
                                        <div class="edt-tambah-nama">
                                            <label>Barang</label>
                                            <input id="edt-tambah-nama-barang" class="form-control" type="text" readonly>
                                            <label>Kekurangan</label>
                                            <input id="edt-tambah-kekurangan-bayar" class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Harga</label>
                                                <input id="edt-tambah-harga-barang" class="form-control" step=".001" type="number" min="1" required >    
                                            </div>
                                            <div class="col-lg-6">
                                                <label>QTY</label>
                                                <input id="edt-tambah-qty-barang" class="form-control" type="number" min="1" required > 
                                                <label>VAT</label>
                                                <input type="number" min='0' max='100' class="form-control" id="edt-tambah-vat-barang" required>    
                                            </div>    
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Total</label>
                                        <input type="text" class="form-control" id="edt-tambah-total-barang" readonly>
                                        <label>Keterangan</label>
                                        <textarea id="edt-tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                    </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                            
                                        </div>
                                        <div class="col-lg-4 justify-content-between">
                                            <button id="edt-btn-cancel-barang" type="button" class="form-control col-sm-4 btn btn-default">Cancel</button>
                                            <button type="submit" id="edt-btn-tambah-barang" class=" form-control col-sm-7 btn btn-primary ">Tmb Transaksi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row" id="edt-edit-barang">
                                <form id="edt-form-edit-barang">
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <input id="edt-edit-kode-barang" class="form-control" type="text" hidden>
                                        <label>Kas</label>
                                        <input id="edt-edit-debit-barang" class="form-control" type="text" readonly>
                                        <label>Tujuan Transaksi</label>
                                        <input type="text" id="edt-edit-kredit-barang" class="form-control" readonly>
                                        <label>Invoice Transaksi</label>
                                        <input id="edt-edit-invoice-barang" class="form-control" type="text" readonly>
                                        <label>Nama Barang</label>
                                        <input id="edt-edit-nama-barang" class="form-control" type="text" readonly>
                                        <label>Kekurangan</label>
                                        <input id="edt-edit-kekurangan-bayar" class="form-control" type="text" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Harga</label>
                                        <input id="edt-edit-harga-barang" class="form-control" step=".001" type="number" min="1" required >
                                    </div>
                                    <div class="col-lg-2">
                                        <label>QTY</label>
                                        <input id="edt-edit-qty-barang" class="form-control" type="number" min="1" required >  
                                        <label>VAT</label>
                                        <input type="number" min='0' max='100' class="form-control" id="edt-edit-vat-barang" required>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <label>Total</label>
                                        <input type="text" class="form-control" id="edt-edit-total-barang" readonly>
                                        <label>Keterangan</label>
                                        <textarea id="edt-edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row justify-content-between">
                                            <button type="button" id="edt-btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                            <button type="submit" id="edt-btn-edit-barang" class="col-sm-6 form-control btn btn-warning ">Edit Transaksi</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row" id="edt-hapus-barang">
                                <form id="edt-form-hapus-barang">
                                    <input id="edt-hapus-kode-barang" class="form-control" type="text" hidden>
                                    <div class="row justify-content-center ">
                                    <label> Apakah Anda yakin akan menghapus Transaksi ini ??</label>
                                    </div>
                                    <div class="row justify-content-center" > 
                                        <label class="col-lg-3">Transaksi </label>
                                        <label id ="edt-hapus-transaksi" class="col-lg-9"></label>
                                    </div>
                                    <br>
                                    <div class="row justify-content-between ">
                                    <button type="button"  id="edt-btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                    <button type="submit"  id="edt-btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Transaksi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table  class="table table-responsive table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2">Action</th>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Kode Transaksi</th>
                                <th rowspan="2">Harga</th>
                                <th rowspan="2">QTY</th>
                                <th rowspan="2">VAT</th>
                                <th rowspan="2">Total</th>
                                <th rowspan="2">Keterangan</th>
                                <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                            </tr>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Perkiraan</th>
                                <th>Kode</th>
                                <th>Nama Perkiraan</th>
                            </tr>
                            </thead>
                            <tbody id="tbl_kas_edit">
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            <form id="edtkas">
                <div class="modal-footer justify-content-between ">
                    <button type="button" id="edt-btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-edit-kas"class="col-sm-2 form-control btn btn-warning">Edit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
  <!--/ Modal Edit  -->
  <!-- MODAL Hapus  -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Transaksi Kas/Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          Apakah Anda Yakin Akan Menghapus Data ini ?
                          <div class="row">
                              <input id="hps-kode" class="form-control" type="text" required hidden>
                              <label class=" col-md-3">KODE </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8" id="hps_kode" > 	</label>
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
  <!--/ Modal Hapus  -->
  <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data Kas</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Mengupdate Status Data ini ?
                                      <input id="selesai-kode" class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class="col-md-3">Kode </label> 
                                          <h6 class="col-md-6" id="kode-selesai"></h6>
                                      </div>
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-selesai" class=" col-sm-4 form-control btn btn-success">Selesai</button>
                      </div>
                  </div>
              </form>
          </div>
        </div>
      <!--/ Modal Selesai -->  
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
<script src="{{asset('AdminLTE/plugins')}}/jszip/jszip.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {   
    $('#tabel-filter').hide();
    $('#cancel-filter').hide();
    $('#filter').hide();
    $('#tabel-kas').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
          if (aData['status'] == "Sudah Diperiksa") {
            $('td', nRow).css('background-color', 'Yellow');
          } else if(aData['status'] == "Selesai"){
            $('td', nRow).css('background-color', ' #00FF64');
          } else{
            $('td', nRow).css('background-color', '');
          } 
        },
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-kas") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'dk', name: 'dk',orderable:true},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'keterangan', name: 'keterangan',orderable:false},
            { data: 'status', name: 'status',orderable:false},
            
        ]
    });
  }); 
  
  $('#cancel-filter').on('click',function(){
         
      $('#filter').hide();
      $('#tabel-filter').DataTable().clear().destroy();
      $('#tabel-filter').hide();
      $('#tabel-kas').DataTable().clear().destroy();
      $('#tabel-kas').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-kas") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'dk', name: 'dk',orderable:true},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'keterangan', name: 'keterangan',orderable:false},
                { data: 'status', name: 'status',orderable:false},
            ]
        });
        $('#cancel-filter').hide();
        $('#cek-filter').show();
      $('#tabel-kas').show();
  });
  $(document).on('click','#cek-filter',function(){
      $('#tabel-kas').DataTable().clear().destroy();
      $('#tabel-kas').hide();
      document.getElementById("form-filter").reset();
      $('#cek-filter').hide();
      $('#filter').show();
      $('#cancel-filter').show();
  });
  $('#form-filter').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-submit-filter');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    $.ajax({
        type : 'get',
        url  : '{!! url("filter-kas")!!}',
        data :{
            awal    : $('#filter-awal').val(),
            akhir   : $('#filter-akhir').val(),
            jenis   : $('#filter-jenis').val(),
            status  : $('#filter-status').val(),
        },
        success : function(response){
            // console.log(response);
            if(response.success == true){
                $('#tabel-kas').DataTable().clear().destroy();
                $('#tabel-filter').DataTable().clear().destroy();
                $('#tabel-filter').DataTable({
                    paging      : true,
                    lengthChange: true,
                    autoWidth   : true,
                    search      : false,
                    order       : false,
                      buttons: [
                          'copy', 'csv', 'excel', 'pdf', 'print'
                      ],
                    dom: 'Blfrtip',
                  data : response.data.original.data,
                  columns : [
                    { data: 'KAS', name: 'KAS',orderable:false, searchable:false},
                    { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                    { data: 'jenis', name: 'jenis',orderable:false, searchable:false},
                    { data: 'KETERANGAN', name: 'KETERANGAN',orderable:false, searchable:false},
                    { data: 'status', name: 'status',orderable:false, searchable:false},
                    { data: 'transaksi', name: 'transaksi',orderable:false, searchable:false},
                    { data: 'vat', name: 'vat',orderable:false, searchable:false},
                    { data: 'harga', name: 'harga',orderable:false, searchable:false},
                    { data: 'qty', name: 'qty',orderable:false, searchable:false},
                    { data: 'total', name: 'total',orderable:false, searchable:false},
                    { data: 'keterangan', name: 'keterangan',orderable:false, searchable:false},
                  ],
                });
                $('#tabel-filter').show();
                $('#tabel-kas').hide();
            } else {
                Toast.fire({
                    icon    :'error',
                    title   : response.pesan
                })
            }
        }
    })
  });
  
  $('#ke-kas').on('click',function(){
      window.open('jurnal-kas');
  });
  
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var today = new Date();
  var tgl = today.getDate();
  if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
    tgl = '0'+tgl;
    }
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var time = date+' '+time;

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  var token = "{!! csrf_token() !!}";
  //TAMBAH DATA
    $(document).on('click','#tambahdata',function(){
        $('#tmb-tgl').val('');$('#tmb-kode').val('');$('#tmb-debit').val('');$('#tmb-rekanan').val('');$('#tmb-keterangan').val('');$('#kunci').prop('checked',false);
        $('#tmb-tgl').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
        $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
        $('#tmb-debit').select2({
          placeholder : 'Pilih Kas Terima',
          ajax  :{
            url : '{!! url("dropdown-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama_perkiraan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        
    });
    
    $('#tmb-tgl').on('change',function(){
        var tgl = $(this).val();
        var th = tgl.substr(2,2);
        var bln = tgl.substr(5,2);
        var n = th+bln;
        $.ajax({
            url     :'{!! url("lastkode-kas") !!}',
            type    : 'get',
            data    : {
                tanggal : n,
            },
            success : function(data){
                $('#tmb-kode').val(data);
            }
        });
    });
    $('#kunci').on('change',function(){
        var kode =  $('#tmb-kode').val();
        var tanggal = $('#tmb-tgl').val();
        var kas = $('#tmb-debit').val();var jenis = $('#tmb-jenis').val();
        var checkBox = document.getElementById("kunci");
        if( kode == null){
            Toast.fire({icon: 'error',title: 'Semua Field Wajib Diisi !!'}) 
            return false;
        } else if( tanggal == null){
            Toast.fire({icon: 'error',title: 'Tanggal Wajib Diisi !!'}) 
            return false;
        } else if (kas == null){
            Toast.fire({icon: 'error',title: 'Kas Wajib Diisi !!'}) 
            return false;
        }  else if (jenis == null){
            Toast.fire({icon: 'error',title: 'Jenis Wajib Diisi !!'}) 
            return false;
        } else {
            
        }
        if(checkBox.checked == true){
            $('#btn-add-barang').show();
            $('#tmb-tgl').prop('disabled',true);$('#tmb-jenis').prop('disabled',true);$('#tmb-keterangan').prop('disabled',true);$('#tmb-debit').prop('disabled',true);
        } else {
            $('#tmb-tgl').prop('disabled',false);$('#tmb-jenis').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
            $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
           $.ajax({
            type    : 'delete',
            url     : '{!! url ("hapus-kas/'+kode+'")!!}',
            data    : {_token : token,user : "{{$user->kode_karyawan}}"},
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan,
                    });
                    $('#tbl_kas_tambah').empty();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
           });
        }
    });
    //Tambah Barang
        $('#btn-add-barang').on('click',function(){
            var jenis = $("#tmb-jenis").val();
            $('#tambah-lain').hide();$('#tambah-transaksi').hide();$('#tambah-data-barang').hide();
            $('#tambah-qty-barang').prop('disabled',true);$('#tambah-vat-barang').prop('disabled',true);
            if (jenis == "D"){
                $('#tambah-kredit-barang').empty();
                $('#tambah-kredit-barang').select2({
                    placeholder:"Pilih Jenis Pemasukkan",
                        ajax: {
                            url: '{!! url("dropdown-akuntansi") !!}',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.kode+" - "+item.nama_perkiraan,
                                            id: item.kode
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                });
            } else if(jenis == "K"){
                $('#tambah-kredit-barang').empty();
                $('#tambah-kredit-barang').select2({
                    placeholder:"Pilih Jenis Pemasukkan",
                        ajax: {
                            url: '{!! url("dropdown-akuntansi") !!}',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.kode+" - "+item.nama_perkiraan,
                                            id: item.kode
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                });
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : 'Pilih Jenis Transaksi !!'
                });
            }
            $('#btn-add-barang').hide();
            document.getElementById("form-tambah-barang").reset();
            $('#edit-barang').hide();$('hapus-barang').hide();$('#tambah-barang').show();
           
        });
        // $('#tambah-kredit-barang').on('change',function(){
        //     var kredit = $(this).val();
        //     if(kredit == 12 || kredit == 310 ){
        //         $('#tambah-lain').hide();
        //         $('#tambah-invoice-barang').val('');
        //         $('#tambah-penjualan').show();
        //         $('#tambah-pembelian').hide();
        //         $('#tambah-po-barang').empty();
        //         $('#tambah-inv-barang').empty();
        //         $('#tambah-inv-barang').prop('required',true);
        //         $('#tambah-inv-barang').select2({
        //             placeholder: "Pilih Invoice",
        //             ajax :{
        //                 url: '{!! url("dropdown-invsd") !!}',
        //                 dataType: 'json',
        //                 processResults: function (data) {
        //                     return {
        //                         results: $.map(data, function (item) {
        //                             return {
        //                                 text: item.kode,
        //                                 id: item.kode
        //                             }
        //                         })
        //                     };
        //                 },
        //                 cache: true
        //             }
        //         });
        //         $('#tambah-harga-barang').prop('disabled',false);
        //         $('#tambah-qty-barang').prop('disabled',true);
        //         $('#tambah-vat-barang').prop('disabled',true);
        //         $('#tambah-keterangan-barang').prop('disabled',true);
        //     } else if(kredit == 30 ||kredit == 300 || kredit == 300.1 || kredit == 300.2){
        //         $('#tambah-lain').hide();
        //         $('#tambah-invoice-barang').val('');
        //         $('#tambah-penjualan').hide();
        //         $('#tambah-inv-barang').prop('required',false);
        //         $('#tambah-pembelian').show();
        //         $('#tambah-inv-barang').empty();
        //         $('#tambah-po-barang').empty();
        //         $('#tambah-po-barang').prop('required',true);
        //         $('#tambah-po-barang').select2({
        //             placeholder: "Pilih PO",
        //             ajax :{
        //                 url: '{!! url("dropdown-po-mr") !!}',
        //                 dataType: 'json',
        //                 processResults: function (data) {
        //                     return {
        //                         results: $.map(data, function (item) {
        //                             return {
        //                                 text: item.kode,
        //                                 id: item.kode
        //                             }
        //                         })
        //                     };
        //                 },
        //                 cache: true
        //             }
        //         });
        //         $('#tambah-harga-barang').prop('disabled',false);
        //         $('#tambah-qty-barang').prop('disabled',true);
        //         $('#tambah-vat-barang').prop('disabled',true);
        //         $('#tambah-keterangan-barang').prop('disabled',true);
        //     }else {
        //         $('#tambah-lain').show();
        //         $('#tambah-penjualan').hide();
        //         $('#tambah-pembelian').hide();
        //         $('#tambah-harga-barang').prop('disabled',false);
        //         $('#tambah-qty-barang').prop('disabled',false);
        //         $('#tambah-vat-barang').prop('disabled',false);
        //         $('#tambah-vat-barang').prop('disabled',false);
        //         $('#tambah-keterangan-barang').prop('disabled',false);
        //     }
            
        // });
        
        $('#tambah-kredit-barang').on('change',function(){
            var kredit = $(this).val();
            $('#tambah-transaksi-barang').empty();
            if(kredit == 12 || kredit == 310){
                $('#tambah-pembelian').hide();$('#tambah-penjualan').hide();$('#tambah-lain').hide();$('#tambah-data-barang').hide();
                $('#tambah-transaksi').show();
                $('#tambah-po-barang').val('');$('#tambah-nama-barang').val('');
                $('#tambah-transaksi-barang').empty();
                $('#tambah-transaksi-barang').select2({
                    placeholder: "Pilih Invoice",
                    ajax :{
                        url: '{!! url("dropdown-invsd") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#tambah-qty-barang').prop('disabled',true);
                $('#tambah-vat-barang').prop('disabled',true);
                $('#tambah-keterangan-barang').prop('disabled',true);
            // } else if(kredit == 30 || kredit == 300 || kredit == 300.1 || kredit == 300.2){
            //     $('#tambah-pembelian').hide();$('#tambah-penjualan').hide();$('#tambah-lain').hide();$('#tambah-data-barang').hide();
            //     $('#tambah-transaksi').show();
            //     $('#tambah-po-barang').val('');$('#tambah-nama-barang').val('');
            //     $('#tambah-transaksi-barang').empty();
            //     $('#tambah-transaksi-barang').select2({
            //         placeholder: "Pilih MR",
            //         ajax :{
            //             url: '{!! url("dropdown-mr") !!}',
            //             dataType: 'json',
            //             processResults: function (data) {
            //                 return {
            //                     results: $.map(data, function (item) {
            //                         return {
            //                             text: item.kode,
            //                             id: item.kode
            //                         }
            //                     })
            //                 };
            //             },
            //             cache: true
            //         }
            //     });
            //     $('#tambah-qty-barang').prop('disabled',true);
            //     $('#tambah-vat-barang').prop('disabled',true);
            } else if(kredit.startsWith("13") || kredit.startsWith("30")) {
                $('#tambah-pembelian').hide();$('#tambah-penjualan').hide();$('#tambah-lain').hide();$('#tambah-data-barang').hide();
                $('#tambah-transaksi').show();
                $('#tambah-po-barang').val('');$('#tambah-nama-barang').val('');
                $('#tambah-transaksi-barang').empty();
                $('#tambah-transaksi-barang').select2({
                    placeholder: "Pilih PO",
                    ajax :{
                        url: '{!! url("dropdown-po-mr") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#tambah-qty-barang').prop('disabled',true);
                $('#tambah-vat-barang').prop('disabled',true);
                $('#tambah-keterangan-barang').prop('disabled',true);
            } else if(kredit.startsWith("25")){
                $('#tambah-pembelian').hide();$('#tambah-penjualan').hide();$('#tambah-lain').hide();$('#tambah-data-barang').hide();
                $('#tambah-transaksi').show();
                $('#tambah-po-barang').val('');$('#tambah-nama-barang').val('');
                $('#tambah-transaksi-barang').empty();
                $('#tambah-transaksi-barang').select2({
                    placeholder: "Pilih Aset",
                    ajax :{
                        url: '{!! url("dropdown-aset/'+kredit+'") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    
                                    return {
                                        
                                        text: item.nama,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#tambah-qty-barang').prop('disabled',true);
                $('#tambah-vat-barang').prop('disabled',true);
                $('#tambah-keterangan-barang').prop('disabled',true);
            } else {
                $('#tambah-lain').show();
                $('#tambah-penjualan').hide();$('#tambah-pembelian').hide();$('#tambah-transaksi').hide();$('#tambah-data-barang').hide();
                $('#tambah-po-barang').val('');$('#tambah-nama-barang').val('');
                $('#tambah-qty-barang').prop('disabled',false);
                $('#tambah-vat-barang').prop('disabled',false);
                $('#tambah-keterangan-barang').prop('disabled',false);
            }
        });
        $('#tambah-transaksi-barang').on('change',function(){
            var data = $(this).val();
            
            console.log(data);
             if (/^PO/.test(data)) {
                $.ajax({
                    type :'get',
                    url  : '{!! url("data-po/'+data+'/edit")!!}',
                    success: function(response){
                        // console.log(response);
                        if(response.success == true){
                            $('#tambah-data-barang').show();
                            $('#tambah-harga-barang').val(response.po.total);
                            $('#tambah-total-barang').val(formatRupiah(response.po.total));
                            $('#tambah-qty-barang').val(1);
                            $('#tambah-vat-barang').val(response.po.vat);
                            $('#tambah-keterangan-barang').val(data);
                            $('#tambah-nama-barang').val(response.barang);
                            $('#tambah-kekurangan-bayar').val(formatRupiah(response.po.kekurangan));
                        } else {
                            $('#tambah-data-barang').hide();
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            } else if (/^INV/.test(data)) {
                $.ajax({
                    type    : 'get',
                    url     : '{!! url("data-inv/'+data+'/edit") !!}',
                    success : function(response){
                        // console.log(response);
                        if(response.success == true){
                            $('#tambah-data-barang').show();
                            $('#tambah-harga-barang').val(response.data.total.jumlah);
                            $('#tambah-total-barang').val(formatRupiah(response.data.total.jumlah));
                            $('#tambah-qty-barang').val(1);
                            $('#tambah-vat-barang').val(response.data.inv.vat);
                            $('#tambah-keterangan-barang').val(data);
                            $('#tambah-nama-barang').val(response.barang);
                            $('#tambah-kekurangan-bayar').val(formatRupiah(response.data.kekurangan));
                        } else {
                            $('#tambah-data-barang').hide();
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            // } else if (/^MR/.test(data)) {
            //     $.ajax({
            //         type :'get',
            //         url  : '{!! url("data-mr/'+data+'/edit")!!}',
            //         success: function(response){
            //             // console.log(response);
            //             if(response.success == true){
            //                 $('#tambah-data-barang').show();
            //                 $('#tambah-harga-barang').val(response.mr.dpp);
            //                 $('#tambah-total-barang').val(formatRupiah(response.mr.total));
            //                 $('#tambah-qty-barang').val(1);
            //                 $('#tambah-vat-barang').val(response.mr.vat);
            //                 $('#tambah-keterangan-barang').val(data);
            //                 $('#tambah-po-barang').val(response.mr.transaksi);
            //                 $('#tambah-nama-barang').val(response.barang);
            //             } else {
            //                 $('#tambah-data-barang').hide();
            //                 Toast.fire({
            //                     icon    : 'error',
            //                     title   : response.pesan
            //                 });
            //             }
            //         }
            //     });
            } else {
                $.ajax({
                    type :'get',
                    url  : '{!! url("data-aset/'+data+'/edit")!!}',
                    success: function(response){
                        console.log(response);
                        if(response.success == true){
                            // $('#tambah-data-barang').show();
                            $('#tambah-harga-barang').val(response.data.harga_beli);
                            $('#tambah-total-barang').val(formatRupiah(response.data.total));
                            $('#tambah-qty-barang').val(response.data.jumlah);
                            $('#tambah-vat-barang').val(0);
                            $('#tambah-keterangan-barang').val("ASET."+response.data.id);
                            // $('#tambah-nama-barang').val(response.barang);
                            // $('#tambah-kekurangan-bayar').val(formatRupiah(response.po.kekurangan));
                        } else {
                            $('#tambah-data-barang').hide();
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            }
        });
        // $('#tambah-inv-barang').on('change',function(){
        //     var data = $(this).val();
        //     $.ajax({
        //         type    : 'get',
        //         url     : '{!! url("data-inv/'+data+'/edit") !!}',
        //         success : function(response){
        //             // console.log(response);
        //             if(response.success == true){
        //                 $('#tambah-harga-barang').val(response.data.total.jumlah);
        //                 $('#tambah-total-barang').val(formatRupiah(response.data.total.jumlah));
        //                 $('#tambah-qty-barang').val(1);
        //                 $('#tambah-vat-barang').val(response.data.inv.vat);
        //                 $('#tambah-keterangan-barang').val(data);
        //             } else {
        //                 Toast.fire({
        //                     icon    : 'error',
        //                     title   : response.pesan
        //                 });
        //             }
        //         }
        //     });
        // });
        // $('#tambah-po-barang').on('change',function(){
        //     var data = $(this).val();
        //     $.ajax({
        //         type :'get',
        //         url  : '{!! url("data-po/'+data+'/edit")!!}',
        //         success: function(response){
        //             // console.log(response);
        //             if(response.success == true){
        //                 $('#tambah-harga-barang').val(response.po.total);
        //                 $('#tambah-total-barang').val(formatRupiah(response.po.total));
        //                 $('#tambah-qty-barang').val(1);
        //                 $('#tambah-vat-barang').val(response.po.vat);
        //                 $('#tambah-keterangan-barang').val(data);
        //             } else {
        //                 Toast.fire({
        //                     icon    : 'error',
        //                     title   : response.pesan
        //                 });
        //             }
        //         }
        //     });
        // });
        $('#tambah-harga-barang').keyup(function(){
            var harga = $(this).val();
            if(harga == null || harga == 0){
                $('#tambah-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var qty = $('#tambah-qty-barang').val();
                if(qty == null || qty == 0){
                    $('#tambah-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#tambah-total-barang').val(formatRupiah(total));
                }
                
            }
            
        });
        $('#tambah-qty-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null || qty == 0){
                $('#tambah-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var harga = $('#tambah-harga-barang').val();
                if(harga == null || harga == 0){
                    $('#tambah-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#tambah-total-barang').val(formatRupiah(total));
                    
                }
                
            }
            
        });
        // $('#tambah-vat-barang').keyup(function(){
        //     var vat = $(this).val();
        //     if(vat == null){
        //         $('#tambah-total-barang').val(formatRupiah(0));
        //         return false;
        //     }else if(vat == 0){
        //         var harga = $('#tambah-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#tambah-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
        //             var qty = $('#tambah-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#tambah-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 $('#tambah-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
        //     } else {
        //         var harga = $('#tambah-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#tambah-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
                    
        //             var qty = $('#tambah-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#tambah-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 var VAT = (total*vat)/100;
        //                 total = total +VAT;
        //                 $('#tambah-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
                
        //     }
            
        // });
        $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kas = $('#tmb-kode').val();
            var kredit = $('#tambah-kredit-barang').val();
            if(kredit == 12 || kredit == 310 || kredit.startsWith("13") || kredit.startsWith("30") ){
                var invoice = $('#tambah-transaksi-barang').val();
            } else if (kredit.startsWith("25")){
                var invoice = "ASET."+$('#tambah-transaksi-barang').val();
            }else {
                var invoice = $('#tambah-invoice-barang').val();
            }
            $.ajax({
                type : 'post',
                url  : '{!! url("data-detailkas") !!}',
                data : {
                    _token      :token,
                    kode_kas    : kas,
                    transaksi   : invoice,
                    tanggal     : $('#tmb-tgl').val(),
                    dk          : $('#tmb-jenis').val(),
                    vat         : $('#tambah-vat-barang').val(),
                    harga       : $('#tambah-harga-barang').val(),
                    qty         : $('#tambah-qty-barang').val(),
                    keterangan  : $('#tambah-keterangan-barang').val(),
                    debit       : $('#tmb-debit').val(),
                    kredit      : $('#tambah-kredit-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#tambah-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
            
            
        });
    //Tambah Barang
    //Edit Barang
        $(document).on('click','.editbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#hapus-barang').hide();
            $('#edit-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#edit-kode-barang').val(response.data.kode);
                        $('#edit-qty-barang').val(response.data.qty);
                        $('#edit-harga-barang').val(response.data.harga);
                        $('#edit-vat-barang').val(response.data.vat)
                        $('#edit-invoice-barang').val(response.data.kode_transaksi);
                        $('#edit-kredit-barang').val(response.data.kredit+" "+response.data.nama_kredit);
                        $('#edit-keterangan-barang').val(response.data.keterangan);
                        $('#edit-vat-barang').prop('disabled',true);
                        $('#edit-qty-barang').prop('disabled',true);
                        $('#edit-total-barang').val(formatRupiah(response.data.total));
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
            
        });
        $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            document.getElementById("form-edit-barang").reset();
            $('#btn-add-barang').show();
        });
        $('#edit-harga-barang').keyup(function(){
            var harga = $(this).val();
            if(harga == null || harga == 0){
                $('#edit-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var qty = $('#edit-qty-barang').val();
                if(qty == null || qty == 0){
                    $('#edit-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#edit-total-barang').val(formatRupiah(total));
                }
                
            }
            
        });
        $('#edit-qty-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null || qty == 0){
                $('#edit-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var harga = $('#edit-harga-barang').val();
                if(harga == null || harga == 0){
                    $('#edit-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#edit-total-barang').val(formatRupiah(total));
                    
                }
                
            }
            
        });
        // $('#edit-vat-barang').keyup(function(){
        //     var vat = $(this).val();
        //     if(vat == null){
        //         $('#edit-total-barang').val(formatRupiah(0));
        //         return false;
        //     }else if(vat == 0){
        //         var harga = $('#edit-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edit-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
        //             var qty = $('#edit-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edit-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 $('#edit-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
        //     } else {
        //         var harga = $('#edit-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edit-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
                    
        //             var qty = $('#edit-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edit-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 var VAT = (total*vat)/100;
        //                 total = total +VAT;
        //                 $('#edit-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
                
        //     }
            
        // });
        $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edit-kode-barang').val();
            var kas  = $('#tmb-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detailkas/'+kode+'")!!}',
                data    : {
                    _token  : token,
                    tanggal : $('#tmb-tgl').val(),
                    barang  : $('#edit-nama-barang').val(),
                    transaksi : $('#edit-invoice-barang').val(),
                    harga   : $('#edit-harga-barang').val(),
                    qty     : $('#edit-qty-barang').val(),
                    keterangan : $('#edit-keterangan-barang').val(),
                    user : "{{$user->kode_karyawan}}",

                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("form-edit-barang").reset();
                        $('#edit-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Barang
    //Hapus Barang
        $('body').on('click','.hapusbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#edit-barang').hide();
            $('#hapus-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#hapus-kode-barang').val(kode);
                        $('#hapus-transaksi').html(response.data.kode_transaksi);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
        $('#btn-cancel-hapus').on('click',function(){
            $('#hapus-barang').hide();
            $('#btn-add-barang').show();
        });
        $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#hapus-kode-barang').val();
            var kas = $('#tmb-kode').val();
            $.ajax({
                type : 'delete',
                url     : '{!! url("data-detailkas/'+kode+'") !!}',
                data    : {_token : token,user : "{{$user->kode_karyawan}}"},
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#hapus-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
    //Hapus Barang

    $('#tmbkas').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-tambah');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var tanggal = $('#tmb-tgl').val();
        var kas =  $('#tmb-debit').val();
        var ket     = $('#tmb-keterangan').val();
        var kode = $('#tmb-kode').val();
        //Validasi
            if(tanggal == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Tanggal Wajib Diisi',
                });
                return false ;
            } else {}
            if(kode == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kode Wajib Diisi',
                });
                return false ;
            } else {}
            if(kas == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kas Wajib Diisi',
                });
                return false  ;
            } else {}
            if(ket == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Keterangan Wajib Diisi',
                });
                return false ;
            } else {}
        //Validasi
        $.ajax({
            type    : 'post',
            url     : "{!! url('data-kas')!!}",
            data    : {
                _token :token,
                kode    : $('#tmb-kode').val(),
                keterangan  : $('#tmb-keterangan').val(),
                tanggal : $('#tmb-tgl').val(),
                dk      : $('#tmb-jenis').val(),
                user : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon :'success',
                        title: response.pesan,
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon :'error',
                        title: response.pesan,
                    });
                }
            }
        });
    });
  //TAMBAH DATA

  //DETAIL DATA
    $('body').on('click', '.detail', function () {
        var kode = $(this).data('kode');
        $('#btn-submit-detail').hide();
        $.ajax({
            url :'{!! url("data-kas/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
            // console.log(response);
            if(response.success == true){
                $('#dtl-kode').val(response.data.kode);
                $('#dtl-tgl').val(response.data.tanggal);
                if(response.data.dk == "D"){
                    $('#dtl-jenis').val("KAS/BANK MASUK");
                } else {
                    $('#dtl-jenis').val("KAS/BANK KELUAR");
                }
                $('#dtl-keterangan').val(response.data.keterangan);
                if(response.data.status == 'Belum Diperiksa'){
                  $('#btn-submit-detail').show();
                  $('#dtl-status').val('Sudah Diperiksa');
                } else if( response.data.status == 'Sudah Diperiksa'){
                  $('#btn-submit-detail').show();
                  $('#dtl-status').val('Selesai');
                } else {
                  $('#btn-submit-detail').hide();
                }
                tabeldetail(kode);
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : response.pesan,
                });
            }
            
            }
        });
    });
    $('#dtlkas').submit(function(e){
      e.preventDefault(); // prevent actual form submit
        var el = $('#btn-detail');
        var kode = $('#dtl-kode').val();
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        $.ajax({
            type    : 'put',
            url     : "{!! url('status-kas/"+kode+"')!!}",
            data    : {
                _token :token,
                status : $('#dtl-status').val(),
                user : "{{$user->kode_karyawan}}",

            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon :'success',
                        title: response.pesan,
                    });
                    $('#modal-detail').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon :'error',
                        title: response.pesan,
                    });
                }
            }
        });
    });
  //DETAIL DATA

  //EDIT DATA
    $('body').on('click', '.edit', function () {
        var kode = $(this).data('kode');
        // console.log(kode);
        $.ajax({
            url :'{!! url("data-kas/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#edt-kode').val(response.data.kode);
                    $('#edt-tgl').val(response.data.tanggal);
                    $('#edt-dk').val(response.data.dk);
                    if(response.data.dk == "D"){
                        $('#edt-jenis').val("KAS/BANK MASUK");
                    } else {
                        $('#edt-jenis').val("KAS/BANK KELUAR");
                    }
                    $('#edt-keterangan').val(response.data.keterangan);
                    tabeledit(kode);
                    $('#edt-btn-add-barang').show();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
        });
    });
    $('#edtkas').on('submit',function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-edit-kas');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var kode = $('#edt-kode').val();
        $.ajax({
            type    : 'put',
            url     : "{!! url('data-kas/"+kode+"')!!}",
            data    : {
                _token :token,
                keterangan  : $('#edt-keterangan').val(),
                user : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon  : 'success',
                        title : response.pesan,
                    });
                    $('#modal-edit').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon  : 'error',
                        title : response.pesan,
                    });
                }
            }
        });
    });
    //Tambah Barang
        $('#edt-btn-add-barang').on('click',function(){
            $('#edt-tambah-barang').show();
            $('#edt-tambah-transaksi').hide();
            $('#edt-tambah-po-barang').hide(); $('#edt-tambah-nama-barang').hide();
            $('#edt-tambah-lain').hide();
            var jenis = $("#edt-jenis").val();
            $('#edt-tambah-vat-barang').prop('disabled',true);
            $('#edt-btn-add-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();
            
            $('#edt-tambah-debit-barang').select2({
                placeholder : 'Pilih Kas',
                ajax  :{
                    url : '{!! url("dropdown-kas") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama_perkiraan,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            if (jenis == "KAS/BANK MASUK"){
                $('#edt-tambah-kredit-barang').select2({
                    placeholder:"Pilih Jenis Pemasukkan",
                        ajax: {
                            url: '{!! url("dropdown-uangmasuk") !!}',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.kode+" - "+item.nama_perkiraan,
                                            id: item.kode
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                });
            } else if(jenis == "KAS/BANK KELUAR"){
                $('#edt-tambah-kredit-barang').select2({
                    placeholder:"Pilih Jenis Pemasukkan",
                        ajax: {
                            url: '{!! url("dropdown-akuntansi") !!}',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.kode+" - "+item.nama_perkiraan,
                                            id: item.kode
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                });
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : 'Pilih Jenis Transaksi !!'
                });
            }
        });
        $('#edt-tambah-kredit-barang').on('change',function(){
            var kredit = $(this).val();
            if(kredit == 12 || kredit == 310 ){
                $('#edt-tambah-lain').hide();
                $('#edt-tambah-transaksi').show();
                $('#edt-tambah-transaksi-barang').empty();
                $('#edt-tambah-transaksi-barang').select2({
                    placeholder: "Pilih Invoice",
                    ajax :{
                        url: '{!! url("dropdown-invsd") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#edt-tambah-qty-barang').prop('disabled',true);
                $('#edt-tambah-vat-barang').prop('disabled',true);
            // } else if(){
            //     $('#edt-tambah-lain').hide();
            //     $('#edt-tambah-transaksi').show();
            //     $('#edt-tambah-transaksi-barang').empty();
            //     $('#edt-tambah-transaksi-barang').select2({
            //         placeholder: "Pilih MR",
            //         ajax :{
            //             url: '{!! url("dropdown-mr") !!}',
            //             dataType: 'json',
            //             processResults: function (data) {
            //                 return {
            //                     results: $.map(data, function (item) {
            //                         return {
            //                             text: item.kode,
            //                             id: item.kode
            //                         }
            //                     })
            //                 };
            //             },
            //             cache: true
            //         }
            //     });
            //     $('#edt-tambah-qty-barang').prop('disabled',true);
            //     $('#edt-tambah-vat-barang').prop('disabled',true);
            } else if(kredit == 13 || kredit == 130 || kredit == 131 || kredit == 131.1 || kredit == 132 || kredit == 133 || kredit == 30 ||kredit == 300 || kredit == 300.1 || kredit == 300.2){
                $('#edt-tambah-lain').hide();
                $('#edt-tambah-transaksi').show();
                $('#edt-tambah-transaksi-barang').empty();
                $('#edt-tambah-transaksi-barang').select2({
                    placeholder: "Pilih PO",
                    ajax :{
                        url: '{!! url("dropdown-po-mr") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#edt-tambah-qty-barang').prop('disabled',true);
                $('#edt-tambah-vat-barang').prop('disabled',true);
            } else {
                $('#edt-tambah-nama-barang').hide(); $('#edt-tambah-po-barang').hide();
                $('#edt-tambah-lain').show();
                $('#edt-tambah-transaksi').hide();
                $('#edt-tambah-qty-barang').prop('disabled',false);
                $('#edt-tambah-vat-barang').prop('disabled',false);
            }
            
        });
        $('#edt-tambah-transaksi-barang').on('change',function(){
            var data = $(this).val();
            if (/^PO/.test(data)){
                $.ajax({
                    type :'get',
                    url  : '{!! url("data-po/'+data+'/edit")!!}',
                    success: function(response){
                        // console.log(response);
                        if(response.success == true){
                            $('#edt-tambah-po').hide();$('#edt-tambah-nama').show();
                            $('#edt-tambah-nama-barang').val(response.barang);
                            $('#edt-tambah-kekurangan-bayar').val(formatRupiah(response.po.kekurangan));
                            $('#edt-tambah-harga-barang').val(response.po.total);
                            $('#edt-tambah-total-barang').val(formatRupiah(response.po.total));
                            $('#edt-tambah-qty-barang').val(1);
                            $('#edt-tambah-vat-barang').val(response.po.vat);
                            $('#edt-tambah-keterangan-barang').val(data);
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            // } else if (/^MR/.test(data)){
            //     $.ajax({
            //         type :'get',
            //         url  : '{!! url("data-mr/'+data+'/edit")!!}',
            //         success: function(response){
            //             // console.log(response);
            //             if(response.success == true){
            //                 $('#edt-tambah-po').show();$('#edt-tambah-nama').show();
            //                 $('#edt-tambah-nama-barang').val(response.barang);
            //                 $('#edt-tambah-po-barang').val(response.mr.transaksi);
            //                 $('#edt-tambah-harga-barang').val(response.mr.dpp);
            //                 $('#edt-tambah-total-barang').val(formatRupiah(response.mr.total));
            //                 $('#edt-tambah-qty-barang').val(1);
            //                 $('#edt-tambah-vat-barang').val(response.mr.vat);
            //                 $('#edt-tambah-keterangan-barang').val(data);
            //             } else {
            //                 Toast.fire({
            //                     icon    : 'error',
            //                     title   : response.pesan
            //                 });
            //             }
            //         }
            //     });
            } else if (/^INV/.test(data)){
                $.ajax({
                    type    : 'get',
                    url     : '{!! url("data-inv/'+data+'/edit") !!}',
                    success : function(response){
                        // console.log(response);
                        if(response.success == true){
                            $('#edt-tambah-po').hide();$('#edt-tambah-nama').show();
                            $('#edt-tambah-nama-barang').val(response.barang);
                            $('#edt-tambah-kekurangan-bayar').val(formatRupiah(response.data.kekurangan));
                            $('#edt-tambah-harga-barang').val(response.data.total.jumlah);
                            $('#edt-tambah-total-barang').val(formatRupiah(response.data.total.jumlah));
                            $('#edt-tambah-qty-barang').val(1);
                            $('#edt-tambah-vat-barang').val(response.data.inv.vat);
                            $('#edt-tambah-keterangan-barang').val(data);
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : "Transaksi Error",
                });
            }
        });
        $('#edt-tambah-harga-barang').keyup(function(){
            var harga = $(this).val();
            if(harga == null || harga == 0){
                $('#edt-tambah-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var qty = $('#edt-tambah-qty-barang').val();
                if(qty == null || qty == 0){
                    $('#edt-tambah-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#edt-tambah-total-barang').val(formatRupiah(total));
                }
                
            }
            
        });
        $('#edt-tambah-qty-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null || qty == 0){
                $('#edt-tambah-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var harga = $('#edt-tambah-harga-barang').val();
                if(harga == null || harga == 0){
                    $('#edt-tambah-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#edt-tambah-total-barang').val(formatRupiah(total));
                    
                }
                
            }
            
        });
        // $('#edt-tambah-vat-barang').keyup(function(){
        //     var vat = $(this).val();
        //     if(vat == null){
        //         $('#edt-tambah-total-barang').val(formatRupiah(0));
        //         return false;
        //     }else if(vat == 0){
        //         var harga = $('#edt-tambah-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edt-tambah-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
        //             var qty = $('#edt-tambah-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edt-tambah-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 $('#edt-tambah-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
        //     } else {
        //         var harga = $('#edt-tambah-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edt-tambah-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
                    
        //             var qty = $('#edt-tambah-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edt-tambah-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 var VAT = (total*vat)/100;
        //                 total = total +VAT;
        //                 $('#edt-tambah-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
                
        //     }
            
        // });
        $('#edt-btn-cancel-barang').on('click',function(){
            $('#edt-btn-add-barang').show();
            $('#edt-tambah-barang').hide();
        });
        $('#edt-form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kas = $('#edt-kode').val();
            var kredit = $('#edt-tambah-kredit-barang').val();
            if(kredit == 12 || kredit == 310 || kredit == 13 || kredit == 130 || kredit == 131 || kredit == 131.1 || kredit == 132 || kredit == 133 || kredit == 300 || kredit == 30 || kredit == 300.1 ||kredit == 300.2){
                var invoice = $('#edt-tambah-transaksi-barang').val();
            } else {
                var invoice = $('#edt-tambah-invoice-barang').val();
            }
            $.ajax({
                type    : 'post',
                url     : '{!! url("data-detailkas") !!}',
                data    : {
                    _token  : token,
                    kode_kas: $('#edt-kode').val(),
                    transaksi   : invoice,
                    dk          : $('#edt-dk').val(),
                    tanggal     : $('#edt-tgl').val(),
                    vat         : $('#edt-tambah-vat-barang').val(),
                    harga       : $('#edt-tambah-harga-barang').val(),
                    qty         : $('#edt-tambah-qty-barang').val(),
                    keterangan  : $('#edt-tambah-keterangan-barang').val(),
                    debit       : $('#edt-tambah-debit-barang').val(),
                    kredit      : $('#edt-tambah-kredit-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success:function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("edt-form-tambah-barang").reset();
                        tabeledit(kas);
                        $('#edt-tambah-barang').hide();
                        $('#edt-btn-add-barang').show();
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
    //Tambah Barang
    //Edit Barang
        $('body').on('click','.edtbarang',function(){
            var kode = $(this).data('kode');
            $('#edt-btn-add-barang').hide();$('#edt-edit-barang').show();$('#edt-tambah-barang').hide();$('#edt-hapus-barang').hide();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#edt-edit-kode-barang').val(response.data.kode);
                        $('#edt-edit-harga-barang').val(response.data.harga);
                        $('#edt-edit-satuan-barang').val(response.data.satuan);
                        $('#edt-edit-qty-barang').val(response.data.qty);
                        $('#edt-edit-total-barang').val(formatRupiah(response.data.total));
                        $('#edt-edit-invoice-barang').val(response.data.kode_transaksi);
                        $('#edt-edit-keterangan-barang').val(response.data.keterangan);
                        $('#edt-edit-vat-barang').val(response.data.vat);
                        $('#edt-edit-debit-barang').val(response.data.debit+" "+response.data.nama_debit);
                        $('#edt-edit-kredit-barang').val(response.data.kredit+" "+response.data.nama_kredit);
                        $('#edt-edit-debit-barang').prop('disabled',true);
                        $('#edt-edit-kredit-barang').prop('disabled',true);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
        $('#edt-edit-harga-barang').keyup(function(){
            var harga = $(this).val();
            if(harga == null || harga == 0){
                $('#edt-edit-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var qty = $('#edt-edit-qty-barang').val();
                if(qty == null || qty == 0){
                    $('#edt-edit-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#edt-edit-total-barang').val(formatRupiah(total));
                    
                }
                
            }
            
        });
        $('#edt-edit-qty-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null || qty == 0){
                $('#edt-edit-total-barang').val(formatRupiah(0));
                return false;
            } else {
                var harga = $('#edt-edit-harga-barang').val();
                if(harga == null || harga == 0){
                    $('#edt-edit-total-barang').val(formatRupiah(0));
                    return false;
                } else {
                    var total = harga*qty;
                    $('#tambah-total-barang').val(formatRupiah(total));
                    
                }
                
            }
            
        });
        // $('#edt-edit-vat-barang').keyup(function(){
        //     var vat = $(this).val();
        //     if(vat == null){
        //         $('#edt-edit-total-barang').val(formatRupiah(0));
        //         return false;
        //     }else if(vat == 0){
        //         var harga = $('#edt-edit-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edt-edit-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
        //             var qty = $('#edt-edit-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edt-edit-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 $('#edt-edit-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
        //     } else {
        //         var harga = $('#edt-edit-harga-barang').val();
        //         if(harga == null || harga == 0){
        //             $('#edt-edit-total-barang').val(formatRupiah(0));
        //             return false;
        //         } else {
                    
        //             var qty = $('#edt-edit-qty-barang').val();
        //             if(qty == null || qty == 0){
        //                 $('#edt-edit-total-barang').val(formatRupiah(0));
        //                 return false;
        //             }else {
        //                 var total = harga*qty;
        //                 var VAT = (total*vat)/100;
        //                 total = total +VAT;
        //                 $('#edt-edit-total-barang').val(formatRupiah(total));
        //             }
                    
        //         }
                
        //     }
            
        // });
        $('#edt-btn-cancel-edit-barang').on('click',function(){
            $('#edt-btn-add-barang').show();
            $('#edt-edit-barang').hide();
        });
        $('#edt-form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-edit-kode-barang').val();
            var kas = $('#edt-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detailkas/'+kode+'")!!}',
                data    : {
                    _token  : token,
                    tanggal : $('#edt-tgl').val(),
                    vat  : $('#edt-edit-vat-barang').val(),
                    harga   : $('#edt-edit-harga-barang').val(),
                    qty     : $('#edt-edit-qty-barang').val(),
                    keterangan : $('#edt-edit-keterangan-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("edt-form-edit-barang").reset();
                        $('#edt-edit-barang').hide();
                        $('#edt-btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Barang
    //Hapus Barang
        $('body').on('click','.hpsbarang',function(){
            $('#edt-btn-add-barang').hide();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();
            $('#edt-hapus-barang').show();
            var kode = $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#edt-hapus-kode-barang').val(kode);
                        $('#edt-hapus-nama-barang').html(response.data.nama);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#edt-btn-cancel-hapus').on('click',function(){
            $('#edt-hapus-barang').hide();$('#edt-btn-add-barang').show();
        });
        $('#edt-form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-hapus-kode-barang').val();
            var kas = $('#edt-kode').val();
            $.ajax({
                type    : 'delete',
                url     : '{!! url("data-detailkas/'+kode+'") !!}',
                data    : {user : "{{$user->kode_karyawan}}",_token :token,},
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#edt-hapus-barang').hide(); $('#edt-btn-add-barang').show();
                        tabeledit(kas);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan 
                        });
                    }
                },
            });
        });
    //Hapus Barang
  //EDIT DATA
  //HAPUS DATA
    $('body').on('click','.hapus',function(){
        var kode  = $(this).data('kode');
        $('#hps-kode').val(kode);
        $('#hps_kode').html(kode);
    });
    $('#hapus').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-hapus');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var kode = $('#hps-kode').val();
        $.ajax({
        type    : 'delete',
        url     : '{!! url("data-kas/'+kode+'") !!}',
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
            var table = $('#tabel-kas').DataTable(); 
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
  //HAPUS DATA
  //SELESAI
    $(document).on('click','.selesai',function(){
      var kode = $(this).data('kode');
      $('#selesai-kode').val(kode);
      $('#kode-selesai').html(kode);
      // console.log(kode);
    });
    $('#form-selesai').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#btn-selesai');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var token = "{!! csrf_token() !!}";
      var kode = $('#selesai-kode').val();
      $.ajax({
        type    : 'put',
        url     : '{!! url("data-kas-selesai/'+kode+'") !!}',
        data    : {
          _token  : token,
          user : "{{$user->kode_karyawan}}",
        },
        success:function(response) {
           console.log(response);
        //   var hasil = response.pesan;
        //   if(response.success == true){
        //     Toast.fire({
        //       icon: 'success',
        //       title: hasil
        //     })
        //     $('#modal-selesai').modal('hide');
        //     var table = $('#tabel-kas').DataTable(); 
        //     table.ajax.reload( null, false );
        //   } else {
        //     Toast.fire({
        //       icon: 'error',
        //       title: hasil
        //     })  
        //   }
        }
        });
    });
  //SELESAI
  
  //Reclass
        $(document).on('click','.re-belum',function(){
            var data = $(this).data('kode');
            $.ajax({
                type    : 'put',
                url     : '{!! url("reclass-kas/'+data+'") !!}',
                data    : {
                    status:"Belum Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-kas').DataTable(); 
                        table.ajax.reload( null, false );
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $(document).on('click','.re-sudah',function(){
            var data = $(this).data('kode');
            $.ajax({
                type    : 'put',
                url     : '{!! url("reclass-kas/'+data+'") !!}',
                data    : {
                    status:"Sudah Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-kas').DataTable(); 
                        table.ajax.reload( null, false );
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
      //Reclass
  
function tabeltambah(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        // console.log(response);
        $('#tbl_kas_tambah').empty();
        var datahandler = $('#tbl_kas_tambah');
        var n= 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
                var nomor = n+1;
            Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr>");
        row.html("<td colspan='6' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan ='5'></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function tabeldetail(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        // console.log(response);
        $('#tbl_kas_detail').empty();
        var datahandler = $('#tbl_kas_detail');
        var n= 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
                var nomor = n+1;
            Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr>")
        row.html("<td colspan='5' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan ='5'></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function tabeledit(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        // console.log(response);
        $('#tbl_kas_edit').empty();
        var datahandler = $('#tbl_kas_edit');
        var n= 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
                var nomor = n+1;
            Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hpsbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr>");
        row.html("<td colspan='6' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan ='5'></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
        { style: 'currency', currency: 'IDR' }
    ).format(money);
}
 
</script>
</body>
</html>
