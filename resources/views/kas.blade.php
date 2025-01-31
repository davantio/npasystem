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
<!-- CSS Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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

                </div>
                <br>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-kas" class="table table-striped table-bordered table-hover nowrap">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>M/K</th>
                    <th>Kode</th>
		            <th>Perusahaan</th>
                    <th>Ref</th>
                    <th>DPP</th>
                    <th>PPN</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
		            <th>Barang</th>
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
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="tmb-kode" class="form-control" type="text" value="" readonly required>
                                    <label>Jenis</label>
                                    <select id="tmb-jenis-kas" class="form-control" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="61">Purchase Order</option>
                                        <option value="42">Sales Order</option>
                                        <option value="43">Internal</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Bank</label>
                                    <select id="tmb-debit" class="form-control select2" required></select>
                                    <label>Keterangan</label>
                                    <textarea id="tmb-keterangan" class="form-control" rows="2" style="resize: none;" placeholder="Keterangan Kas Masuk"></textarea>
                                </div>
                            </div>
                            <!-- Conditional Fields -->
                            <div id="conditional-fields">
                                <div class="po d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Purchase Order</label>
                                            <select id="tmb-po-kas" class="form-control select2" required>
                                                <option value="">Pilih Purchase Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="tmb-supplier-po" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-po" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-po" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-po" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-po" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                {{-- SO --}}
                                <div class="so d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Sales Order</label>
                                            <select id="tmb-so-kas" class="form-control select2" required>
                                                <option value="">Pilih Kode Sales Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="tmb-konsumen-so" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-so" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-so" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-so" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-so" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Internal --}}
                                <div class="internal d-none">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {{-- <label>Atas Nama</label>
                                            <input id="tmb-atam-internal" type="text" class="form-control"> --}}

                                            <label>Perusahaan</label>
                                            <select class="form-control select2" id="tmb-atam-internal" required style="width:100%">
                                                <option value="" >Pilih Perusahaan</option>
                                                <option value="npa">CV. Nusa Pratama Anugrah</option>
                                                <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                                <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-internal" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-internal" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-internal" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-internal" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="edit-id" value="">
                        <form id="tmbkas">
                            <div class="modal-footer justify-content-between ">
                                <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/ Modal Tambah -->

<!-- MODAL Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title">Edit Transaksi Kas/Bank</h4>
                <button type="button" id="btn-x-edit-kas" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Kas</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="edit-tgl" class="form-control" type="date" required>
                                    <label>Kas Masuk/Keluar</label>
                                    <select id="edit-jenis" class="form-control">
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="edit-kode" class="form-control" type="text" value="" readonly required>
                                    <label>Jenis</label>
                                    <select id="edit-jenis-kas" class="form-control" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="61">Purchase Order</option>
                                        <option value="42">Sales Order</option>
                                        <option value="43">Internal</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Bank</label>
                                    <select id="edit-debit" class="form-control select2" required></select>
                                    <label>Keterangan</label>
                                    <textarea id="edit-keterangan" class="form-control" rows="2" style="resize: none;" placeholder="Keterangan Kas Masuk"></textarea>
                                </div>
                            </div>
                            <!-- Conditional Fields -->
                            <div id="conditional-fields-edit">
                                <div class="po d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Purchase Order</label>
                                            <select id="edit-po-kas" class="form-control select2" required>
                                                <option value="">Pilih Purchase Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="edit-supplier-po" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="edit-dpp-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="edit-ppn-po" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="edit-brg-po" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="edit-jumlah-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-edit-debet-akun-po" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-edit-kredit-akun-po" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add SO and Internal conditions as needed -->
                                <!-- SO Section -->
                                <div class="so d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Sales Order</label>
                                            <select id="edit-so-kas" class="form-control select2" required>
                                                <option value="">Pilih Sales Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="edit-konsumen-so" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="edit-dpp-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="edit-ppn-so" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="edit-brg-so" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="edit-jumlah-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-edit-debet-akun-so" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-edit-kredit-akun-so" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Internal Section -->
                                <div class="internal d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            {{-- <input id="edit-atam-internal" type="text" class="form-control"> --}}
                                            <select id="edit-atam-internal" class="form-control select2" required>
                                                <option value="">Pilih Perusahaan</option>
                                                <option value="npa">CV. Nusa Pratama Anugrah</option>
                                                <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                                <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="edit-dpp-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="edit-ppn-internal" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="edit-brg-internal" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="edit-jumlah-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-edit-debet-akun-internal" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-edit-kredit-akun-internal" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="edit-id" value="">
                        <form id="editkas">
                            <div class="modal-footer justify-content-between">
                                <button type="button" id="btn-close-edit-kas" class="col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="update-btn" class="col-sm-2 form-control btn btn-warning">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL Detail -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detail Transaksi Kas/Bank</h4>
                <button type="button" id="btn-x-detail-kas" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Kas</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="detail-tgl" class="form-control" type="date" required>
                                    <label>Kas Masuk/Keluar</label>
                                    <select id="detail-jenis" class="form-control">
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="detail-kode" class="form-control" type="text" value="" readonly required>
                                    <label>Jenis</label>
                                    <select id="detail-jenis-kas" class="form-control" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="61">Purchase Order</option>
                                        <option value="42">Sales Order</option>
                                        <option value="43">Internal</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Bank</label>
                                    <select id="detail-debit" class="form-control select2" required></select>
                                    <label>Keterangan</label>
                                    <textarea id="detail-keterangan" class="form-control" rows="2" style="resize: none;" placeholder="Keterangan Kas Masuk"></textarea>
                                </div>
                            </div>
                            <!-- Conditional Fields -->
                            <div id="conditional-fields-detail">
                                <div class="po d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Purchase Order</label>
                                            <select id="detail-po-kas" class="form-control select2" required>
                                                <option value="">Pilih Purchase Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="detail-supplier-po" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="detail-dpp-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="detail-ppn-po" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="detail-brg-po" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="detail-jumlah-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-detail-debet-akun-po" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-detail-kredit-akun-po" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add SO and Internal conditions as needed -->
                                <!-- SO Section -->
                                <div class="so d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Sales Order</label>
                                            <select id="detail-so-kas" class="form-control select2" required>
                                                <option value="">Pilih Sales Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="detail-konsumen-so" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="detail-dpp-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="detail-ppn-so" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="detail-brg-so" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="detail-jumlah-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-detail-debet-akun-so" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-detail-kredit-akun-so" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Internal Section -->
                                <div class="internal d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Perusahaan</label>
                                            <input id="detail-atam-internal" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="detail-dpp-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="detail-ppn-internal" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="detail-brg-internal" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="detail-jumlah-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-detail-debet-akun-internal" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-detail-kredit-akun-internal" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="detail-id" value="">
                        <form id="detailkas">
                            <div class="modal-footer justify-content-between">
                                <button type="button" id="btn-close-detail-kas" class="col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="confirm-btn" class="col-sm-2 form-control btn btn-info">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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
              <form id="selesai">
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
                                      {{-- <input id="selesai-kode" class="form-control" type="text" hidden > --}}
                                      <div class="row">
                                        <input id="selesai-kode" class="form-control" type="text" required hidden>
                                        <label class=" col-md-3">KODE </label>
                                        <label class="col-md-1">:</label>
                                        <label class="col-md-8" id="selesai_kode" > 	</label>
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
<!-- JS Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function() {
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
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'atas_nama', name: 'atas_nama',orderable:true},
            { data: 'kode_ref', name: 'kode_ref',orderable:false},
            {
                data: 'dpp',
                name: 'dpp',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'ppn',
                name: 'ppn',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'barang', name: 'barang',orderable:false},
            { data: 'status', name: 'status',orderable:false},
        ]
    });
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
          placeholder : 'Pilih Rekening Bank Terima',
          ajax  :{
            url : '{!! url("dropdown-bank") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.bank+" "+item.rekening+" "+item.atas_nama,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        $('#tmb-po-kas').select2({
          placeholder : 'Pilih Kode PO',
          ajax  :{
            url : '{!! url("dropdown-po-kas") !!}',
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
        $('#tmb-so-kas').select2({
          placeholder : 'Pilih Kode SO',
          ajax  :{
            url : '{!! url("dropdown-so-kas") !!}',
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


    });
    // PO
    $(document).on('change','#tmb-po-kas',function(){
        var po = $(this).val();
        $.ajax({
            url     :'{!! url("data-po-kas/'+po+'/edit") !!}',
            type    : 'get',
            success : function(data){
            // console.log(data);
            @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                $('#tmb-jumlah-po').val(data.po.total).prop('disabled',true);
            @else
                $('#tmb-jumlah-po').val(0).prop('disabled',true);
            @endif
            if(data.po.perusahaan == "-" || data.po.perusahaan == null){
                $('#tmb-perusahaan').val("null").prop('disabled',true);
            } else {
                $('#tmb-perusahaan').val(data.po.perusahaan).prop('disabled',true);
            }
            $('#tmb-dpp-po').val(data.po.dpp).prop('disabled',true);
            $('#tmb-supplier-po').val(data.po.perusahaan).prop('disabled',true);
            $('#tmb-ppn-kas-po').val(((data.po.vat / 100) * data.po.dpp)).prop('disabled',true);
            $('#tmb-brg-po').val(data.po.barang).prop('disabled',true);
            }
        });
    })
    // END PO

    // SO
    $(document).on('change','#tmb-so-kas',function(){
            var so = $(this).val();
            $.ajax({
              url     :'{!! url("data-so-kas/'+so+'/edit") !!}',
              type    : 'get',
              success : function(data){
                // console.log(data);
                @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                    $('#tmb-jumlah-so').val((data.so.total)).prop('disabled',true);
                @else
                    $('#tmb-jumlah-so').val((0)).prop('disabled',true);
                @endif
                if(data.so.perusahaan == "-" || data.so.perusahaan == null){
                    $('#tmb-perusahaan').val("npa");
                } else {
                    $('#tmb-perusahaan').val(data.so.perusahaan);
                }
                $('#tmb-dpp-so').val((data.so.dpp)).prop('disabled',true);
                $('#tmb-konsumen-so').val(data.so.perusahaan).prop('disabled',true);
                $('#tmb-ppn-kas-so').val(((data.so.vat / 100) * data.so.dpp)).prop('disabled',true);
                $('#tmb-brg-so').val(data.so.barang).prop('disabled',true);
              }
            });
        })

    // END SO

    $('#kode-kredit-akun-po, #kode-debet-akun-po, #kode-kredit-akun-so, #kode-debet-akun-so, #kode-kredit-akun-internal, #kode-debet-akun-internal').select2({
        ajax: {
            url: '{!! url("dropdown-akuntansi") !!}',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.kode + " - " + item.nama_perkiraan,
                            id: item.kode
                        };
                    })
                };
            },
            cache: true
        }
    });

    // Jenis Change
    document.addEventListener('DOMContentLoaded', function () {
        const jenisKasSelect = document.getElementById('tmb-jenis-kas');
        const poSection = document.querySelector('.po');
        const soSection = document.querySelector('.so');
        const internalSection = document.querySelector('.internal');
        const conditionalFields = document.getElementById('conditional-fields');

        // Hide conditional fields by default
        conditionalFields.style.display = 'none';

        jenisKasSelect.addEventListener('change', function () {
            const value = this.value;

            // Reset visibility
            poSection.classList.add('d-none');
            soSection.classList.add('d-none');
            internalSection.classList.add('d-none');

            // Show relevant section based on selected value
            if (value === '61') {
                poSection.classList.remove('d-none');
            } else if (value === '42') {
                soSection.classList.remove('d-none');
            } else if (value === '43') {
                internalSection.classList.remove('d-none');
            }

            // Show or hide conditional fields container
            conditionalFields.style.display = value ? 'block' : 'none';
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

    $('#tmbkas').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-tambah');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var tanggal = $('#tmb-tgl').val();
        var bank =  $('#tmb-debit').val();
        var dk = $('#tmb-jenis').val();
        var jenis = $('#tmb-jenis-kas').val();
        var atas_nama = $('#tmb-supplier-po:visible, #tmb-konsumen-so:visible, #tmb-atam-internal:visible').val();
        var jumlah = $('#tmb-jumlah-po:visible, #tmb-jumlah-so:visible, #tmb-jumlah-internal:visible').val();
        var debit = $('#kode-debet-akun-po:visible, #kode-debet-akun-so:visible, #kode-debet-akun-internal:visible').val();
        var kredit = $('#kode-kredit-akun-po:visible, #kode-kredit-akun-so:visible, #kode-kredit-akun-internal:visible').val();
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
            if(bank == null){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Bank Wajib Diisi',
                });
                return false  ;
            } else {}
            if(dk == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kas Masuk/Keluar Wajib Diisi',
                });
                return false  ;
            } else {}
            if(atas_nama == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Perusahaan Wajib Diisi',
                });
                return false  ;
            } else {}
            if(jenis == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Jenis Transaksi Wajib Diisi',
                });
                return false  ;
            } else {}
            if(jumlah == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Jumlah Wajib Diisi',
                });
                return false  ;
            } else {}
            if(debit == null){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Debit Wajib Diisi',
                });
                return false  ;
            } else {}
            if(kredit == null){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kredit Wajib Diisi',
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
            type: 'post',
            url: "{!! url('data-kas') !!}",
            data: {
                _token: token,
                kode: $('#tmb-kode').val(),
                keterangan: $('#tmb-keterangan').val(),
                tanggal: $('#tmb-tgl').val(),
                dk: $('#tmb-jenis').val(),
                jenis: $('#tmb-jenis-kas').val(),
                bank: $('#tmb-debit').val(), 
                kode_ref: $('#tmb-po-kas:visible, #tmb-so-kas:visible').val(),
                atas_nama: $('#tmb-supplier-po:visible, #tmb-konsumen-so:visible, #tmb-atam-internal:visible').val(),
                barang: $('#tmb-brg-po:visible, #tmb-brg-so:visible, #tmb-brg-internal:visible').val(),
                dpp: $('#tmb-dpp-po:visible, #tmb-dpp-so:visible, #tmb-dpp-internal:visible').val(),
                ppn: $('#tmb-ppn-kas-po:visible, #tmb-ppn-kas-so:visible, #tmb-ppn-kas-internal:visible').val(),
                jumlah: $('#tmb-jumlah-po:visible, #tmb-jumlah-so:visible, #tmb-jumlah-internal:visible').val(),
                debit: $('#kode-debet-akun-po:visible, #kode-debet-akun-so:visible, #kode-debet-akun-internal:visible').val(),
                kredit: $('#kode-kredit-akun-po:visible, #kode-kredit-akun-so:visible, #kode-kredit-akun-internal:visible').val(),

                user: "{{$user->kode_karyawan}}",
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: response.pesan,
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#tabel-kas').DataTable();
                    table.ajax.reload(null, false);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.pesan,
                    });
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                Toast.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan saat menyimpan data!',
                });
            }
        });

    });
  //TAMBAH DATA

  //EDIT DATA
 
    $(document).on('click', '.edit', function () {
        // Ambil kode dari atribut data
        let kode = $(this).data('kode');
        
        // Kosongkan form sebelumnya (opsional, jika perlu reset form setiap klik)
        $('#editkas')[0].reset();
        $('#conditional-fields-edit .po').addClass('d-none'); // Reset conditional fields
        $('#conditional-fields-edit .so').addClass('d-none');
        $('#conditional-fields-edit .internal').addClass('d-none');
        $('#edit-id').val(''); // Reset hidden ID field
        
        // Lakukan AJAX GET request untuk mengambil data
        $.ajax({
            url: `/kas/${kode}/edit`, // Endpoint backend untuk mengambil data
            type: 'GET',
            success: function (response) {
                if (response.success) {
                    // Isi data ke dalam modal
                    $('#edit-id').val(response.data.id); // Hidden ID
                    $('#edit-tgl').val(response.data.tanggal); // Tanggal
                    $('#edit-jenis').val(response.data.dk); // Masuk/Keluar
                    $('#edit-kode').val(response.data.kode); // Kode transaksi
                    $('#edit-jenis-kas').val(response.data.jenis).prop('disabled', true); // Jenis transaksi
                    $('#edit-debit')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.bank) //set value for option to post it
                            .text(response.data.bank_nama + " " + response.data.bank_rekening + " " + response.data.bank_atas_nama)) //set a text for show in select
                        .val(response.data.bank) //select option of select2
                        .trigger("change"); //apply to select2
                    $('#edit-debit').select2({
                    placeholder:"Pilih Rekening Bank Terima",
                        ajax  :{
                        url : '{!! url("dropdown-bank") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.bank+" "+item.rekening+" "+item.atas_nama,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                        }
                    });
                    //$('#edit-debit').val(response.data.kas_masuk).trigger('change'); // Debit kas
                    $('#edit-keterangan').val(response.data.keterangan); // Keterangan
                    
                    // Conditional field untuk PO
                    if (response.data.jenis === '61') {
                        $('#conditional-fields-edit .po').removeClass('d-none');

                        //$('#edit-po-kas').val(response.data.kode_ref); // Kode Purchase Order
                        $('#edit-po-kas')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kode_ref) //set value for option to post it
                            .text(response.data.kode_ref )) //set a text for show in sele
                        .val(response.data.kode_ref) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#edit-po-kas').prop('disabled', true); 
                        

                        $('#edit-supplier-po').val(response.data.atas_nama).prop('disabled', true); // Atas Nama
                        $('#edit-dpp-po').val(response.data.dpp).prop('disabled', true); // DPP
                        $('#edit-ppn-po').val(response.data.ppn).prop('disabled', true); // PPN
                        $('#edit-brg-po').val(response.data.barang).prop('disabled', true); // Barang
                        $('#edit-jumlah-po').val(response.data.jumlah).prop('disabled', true); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-edit-debet-akun-po')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit )) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-debet-akun-po').select2({
                        placeholder:"Pilih Kode Debit",
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

                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-edit-kredit-akun-po')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-kredit-akun-po').select2({
                        placeholder:"Pilih Kode Debit",
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
                    }
                    // Conditional field untuk SO
                    if (response.data.jenis === '42') {
                        $('#conditional-fields-edit .so').removeClass('d-none');

                        //$('#edit-po-kas').val(response.data.kode_ref); // Kode Purchase Order
                        $('#edit-so-kas')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kode_ref) //set value for option to post it
                            .text(response.data.kode_ref )) //set a text for show in sele
                        .val(response.data.kode_ref) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#edit-so-kas').prop('disabled', true); 
                        

                        $('#edit-konsumen-so').val(response.data.atas_nama).prop('disabled', true); // Atas Nama
                        $('#edit-dpp-so').val(response.data.dpp).prop('disabled', true); // DPP
                        $('#edit-ppn-so').val(response.data.ppn).prop('disabled', true); // PPN
                        $('#edit-brg-so').val(response.data.barang).prop('disabled', true); // Barang
                        $('#edit-jumlah-so').val(response.data.jumlah).prop('disabled', true); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-edit-debet-akun-so')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-debet-akun-so').select2({
                        placeholder:"Pilih Kode Debit",
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

                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-edit-kredit-akun-so')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-kredit-akun-so').select2({
                        placeholder:"Pilih Kode Debit",
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
                    }
                    //Conditional field untuk internal
                    if (response.data.jenis === '43') {
                        $('#conditional-fields-edit .internal').removeClass('d-none');
                        
                        $('#edit-atam-internal').val(response.data.atas_nama); // Atas Nama
                        $('#edit-dpp-internal').val(response.data.dpp); // DPP
                        $('#edit-ppn-internal').val(response.data.ppn); // PPN
                        $('#edit-brg-internal').val(response.data.barang); // Barang
                        $('#edit-jumlah-internal').val(response.data.jumlah); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-edit-debet-akun-internal')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-debet-akun-internal').select2({
                        placeholder:"Pilih Kode Debit",
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

                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-edit-kredit-akun-internal')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change"); //apply to select2

                        $('#kode-edit-kredit-akun-internal').select2({
                        placeholder:"Pilih Kode Debit",
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
                    }
                } else {
                    alert(response.pesan);
                }
            },
            error: function (xhr) {
                alert('Terjadi kesalahan saat mengambil data!');
            }
        });
    });

    $(document).on('click', '#update-btn', function (e) {
    e.preventDefault(); // prevent actual form submit
        var el = $('#update-btn');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
    // Ambil data dari form
    let kode = $('#edit-kode').val(); // Kode transaksi sebagai identifikasi utama
    let formData = {
        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
        tanggal: $('#edit-tgl').val(), // Tanggal
        bank: $('#edit-debit').val(),
        dk: $('#edit-jenis').val(), // Masuk/Keluar
        jenis: $('#edit-jenis-kas').val(), // Jenis transaksi
        keterangan: $('#edit-keterangan').val(), // Keterangan
        debit: $('#kode-edit-debet-akun-po').val() || $('#kode-edit-debet-akun-so').val() || $('#kode-edit-debet-akun-internal').val(), // Debit akun
        kredit: $('#kode-edit-kredit-akun-po').val() || $('#kode-edit-kredit-akun-so').val() || $('#kode-edit-kredit-akun-internal').val(), // Kredit akun
        atas_nama: $('#edit-supplier-po').val() || $('#edit-konsumen-so').val() || $('#edit-atam-internal').val(), // Atas nama
        dpp: $('#edit-dpp-po').val() || $('#edit-dpp-so').val() || $('#edit-dpp-internal').val(), // DPP
        ppn: $('#edit-ppn-po').val() || $('#edit-ppn-so').val() || $('#edit-ppn-internal').val(), // PPN
        barang: $('#edit-brg-po').val() || $('#edit-brg-so').val() || $('#edit-brg-internal').val(), // Barang
        jumlah: $('#edit-jumlah-po').val() || $('#edit-jumlah-so').val() || $('#edit-jumlah-internal').val(), // Jumlah
        kode_ref: $('#edit-po-kas').val() || $('#edit-so-kas').val(), // Kode referensi

        user : "{{$user->kode_karyawan}}",
    };

    // Lakukan AJAX POST request untuk mengupdate data
    $.ajax({
    url: `/kas/${kode}`, // Endpoint backend untuk update data
    type: 'PUT', // HTTP method PUT
    data: formData,
    success: function (response) {
        var hasil = response.pesan;
        if (response.success) {
            Toast.fire({
                icon: 'success',
                title: hasil
            })
            $('#modal-edit').modal('hide');
            var table = $('#tabel-kas').DataTable();
            table.ajax.reload(null, false);
        } else {
            Toast.fire({
                icon: 'error',
                title: hasil
            })
        }
    },
    error: function (xhr) {
        Toast.fire({
                icon: 'error',
                title: hasil
            })
    }
});

});
    

  //END EDIT DATA

  //Detail DATA
  $(document).on('click', '.detail', function () {
        // Ambil kode dari atribut data
        let kode = $(this).data('kode');
        
        // Kosongkan form sebelumnya (opsional, jika perlu reset form setiap klik)
        $('#conditional-fields-detail .po').addClass('d-none'); // Reset conditional fields
        $('#conditional-fields-detail .so').addClass('d-none');
        $('#conditional-fields-detail .internal').addClass('d-none');
        $('#detail-id').val(''); // Reset hidden ID field
        
        // Lakukan AJAX GET request untuk mengambil data
        $.ajax({
            url: `/kas/${kode}/edit`, // Endpoint backend untuk mengambil data
            type: 'GET',
            success: function (response) {
                if (response.success){
                    if (response.data.status === "Selesai" || response.data.status === "Sudah Diperiksa") {
                        $('#confirm-btn').prop('disabled', true);
                    } else {
                        $('#confirm-btn').prop('disabled', false);
                    }
                }
                if (response.success) {
                    // Isi data ke dalam modal
                    $('#detail-id').val(response.data.id); // Hidden ID
                    $('#detail-tgl').val(response.data.tanggal).prop('disabled', true); // Tanggal
                    $('#detail-jenis').val(response.data.dk).prop('disabled', true); // Masuk/Keluar
                    $('#detail-kode').val(response.data.kode); // Kode transaksi
                    $('#detail-jenis-kas').val(response.data.jenis).prop('disabled', true); // Jenis transaksi
                    $('#detail-debit')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.bank) //set value for option to post it
                            .text(response.data.bank_nama + " " + response.data.bank_rekening + " " + response.data.bank_atas_nama)) //set a text for show in select
                        .val(response.data.bank) //select option of select2
                        .trigger("change"); //apply to select2
                    $('#detail-debit').prop('disabled', true);

                    $('#detail-keterangan').val(response.data.keterangan).prop('disabled', true); // Keterangan
                    
                    // Conditional field untuk PO
                    if (response.data.jenis === '61') {
                        $('#conditional-fields-detail .po').removeClass('d-none');

                        //$('#edit-po-kas').val(response.data.kode_ref); // Kode Purchase Order
                        $('#detail-po-kas')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kode_ref) //set value for option to post it
                            .text(response.data.kode_ref )) //set a text for show in sele
                        .val(response.data.kode_ref) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#detail-po-kas').prop('disabled', true); 
                        

                        $('#detail-supplier-po').val(response.data.atas_nama_perusahaan).prop('disabled', true); // Atas Nama
                        $('#detail-dpp-po').val(response.data.dpp).prop('disabled', true); // DPP
                        $('#detail-ppn-po').val(response.data.ppn).prop('disabled', true); // PPN
                        $('#detail-brg-po').val(response.data.barang).prop('disabled', true); // Barang
                        $('#detail-jumlah-po').val(response.data.jumlah).prop('disabled', true); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-detail-debet-akun-po')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2

                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-detail-kredit-akun-po')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2

                    }
                    // Conditional field untuk SO
                    if (response.data.jenis === '42') {
                        $('#conditional-fields-detail .so').removeClass('d-none');

                        //$('#detail-po-kas').val(response.data.kode_ref); // Kode Purchase Order
                        $('#detail-so-kas')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kode_ref) //set value for option to post it
                            .text(response.data.kode_ref )) //set a text for show in sele
                        .val(response.data.kode_ref) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#detail-so-kas').prop('disabled', true); 
                        

                        $('#detail-konsumen-so').val(response.data.atas_nama_perusahaan).prop('disabled', true); // Atas Nama
                        $('#detail-dpp-so').val(response.data.dpp).prop('disabled', true); // DPP
                        $('#detail-ppn-so').val(response.data.ppn).prop('disabled', true); // PPN
                        $('#detail-brg-so').val(response.data.barang).prop('disabled', true); // Barang
                        $('#detail-jumlah-so').val(response.data.jumlah).prop('disabled', true); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-detail-debet-akun-so')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2

                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-detail-kredit-akun-so')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2
                    }
                    //Conditional field untuk internal
                    if (response.data.jenis === '43') {
                        $('#conditional-fields-detail .internal').removeClass('d-none');
                        
                        $('#detail-atam-internal').val(response.data.atas_nama_perusahaan).prop('disabled', true); // Atas Nama
                        $('#detail-dpp-internal').val(response.data.dpp).prop('disabled', true); // DPP
                        $('#detail-ppn-internal').val(response.data.ppn).prop('disabled', true); // PPN
                        $('#detail-brg-internal').val(response.data.barang).prop('disabled', true); // Barang
                        $('#detail-jumlah-internal').val(response.data.jumlah).prop('disabled', true); // Jumlah

                        //$('#kode-edit-debet-akun-po').val(response.data.debit); // Akun Debit
                        $('#kode-detail-debet-akun-internal')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2
                        //$('#kode-edit-kredit-akun-po').val(response.data.kredit); // Akun Kredit
                        $('#kode-detail-kredit-akun-internal')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change")
                        .prop('disabled', true); //apply to select2
                    }
                } else {
                    alert(response.pesan);
                }
            },
            error: function (xhr) {
                alert('Terjadi kesalahan saat mengambil data!');
            }
        });
    });

    //Update Status
    $(document).on('submit', '#detailkas', function (e) {
        e.preventDefault();

        //var el = $('#confirm-btn');
        let kode = $('#detail-kode').val();
        //const kode = $('#detail-kode').val(); // Ambil kode transaksi

        if (!kode) {
            alert('Kode transaksi tidak ditemukan!');
            return;
        }

        // Kirim data ke server untuk memperbarui status
        $.ajax({
            url: `/kas/update-status/${kode}`, // Endpoint backend
            type: 'PUT',
            data: {
                status: 'Sudah Diperiksa',
                user : "{{$user->kode_karyawan}}"
            },
            success: function (response) {
                var hasil = response.pesan;
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: "Berhasil Konfirmasi"
                    })
                    $('#modal-detail').modal('hide');
                    var table = $('#tabel-kas').DataTable();
                    table.ajax.reload(null, false);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: hasil
                    })
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status.');
            }
        });
    });


    //END DETAIL DATA

    //SELESAI

    $(document).ready(function () {
        // Ketika tombol "Selesai" di dropdown diklik
        $('body').on('click','.selesai',function(){
            var kode  = $(this).data('kode');
            $('#selesai-kode').val(kode);
            $('#selesai_kode').html(kode);
        });

        $('#selesai').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-selesai');
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var kode = $('#selesai-kode').val();
            $.ajax({
            type    : 'PUT',
            url     : `{{ url('data-kas-selesai') }}/${kode}`, // URL diperbaiki
            data    : {
                _token  : '{{ csrf_token() }}', // Pastikan CSRF token dikirim
                status: 'Selesai',
                user : "{{ auth()->user()->kode_karyawan }}",
            },
            success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success){
                Toast.fire({
                    icon: 'success',
                    title: hasil
                })
                $('#modal-selesai').modal('hide');
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
    });

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

function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
        { style: 'currency', currency: 'IDR' }
    ).format(money);
}

</script>
</body>
</html>
