<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Invoice</title>
  </head>
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
        </div>
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">

        <h4><b> Nusa Pratama Anugerah </b></h4>
      </div>
      <!-- Navbar -->
      @include('layout/navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('layout/sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Invoice</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Invoice</li>
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
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah" data-backdrop="static" class="btn bg-gradient-primary">Tambah Invoice</button>
                        <div>
                            <button type="button" id="cancel-filter" class="btn btn-default">Cancel</button>
                            <button type="button" id="cek-filter" class="btn bg-gradient-success">Filter</button>
                        </div>
                      </div>
                      <br>
                      <form id="form-filter">
                        <div id="filter" class="row">
                            <div class="col-lg-2">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" id="filter-awal" required>
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" id="filter-akhir" required>
                            </div>
                            <div class="col-lg-3">
                                <label>Marketing</label>
                                <select id="filter-marketing" class="form-control" required></select>
                            </div>
                            <div class="col-lg-3">
                                <label>Konsumen</label>
                                <select id="filter-konsumen" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Status</label>
                                <select id="filter-status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Diperiksa">Belum Diperiksa</option>
                                    <option value="Sudah Diperiksa">Sudah Diperiksa</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="all">All</option>
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
                                <th>INV</th>
                                <th>Tanggal</th>
                                <th>SO</th>
                                <th>SJ</th>
                                <th>BANK</th>
                                <th>VAT</th>
                                <th>TEMPO</th>
                                <th>DP</th>
                                <th>Keterangan INV</th>
                                <th>Status</th>
                                <th>KD Barang</th>
                                <th>Barang</th>
                                <th>Nama Request</th>
                                <th>Harga Jual</th>
                                <th>HPP</th>
                                <th>diakui</th>
                                <th>dikirim</th>
                                <th>diterima</th>
                                <th>DPP</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="tabel-inv" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th width="12%" align="center">Action</th>
                        <th>Perusahaan</th>
                        <th>Invoice</th>
                        <th>Sales Order</th>
                        <th>Surat Jalan</th>
                        <th>Customer</th>
                        <th>Barang</th>
                        <th>Penjualan</th>
                        <th>Jatuh Tempo</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Kekurangan Bayar</th>
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
      @include('layout/footer')
      <!-- MODAL -->
      <!-- MODAL Tambah Invoice -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Buat Invoice</h4>
                    <button type="button" id="btn-x-inv" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Invoice</h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="tmb-kode-inv" class="form-control" type="text" value=""readonly required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="tmb-tgl-inv" class="form-control" type="date" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Sales Order</label>
                                    <select id="tmb-so-inv"  class="form-control select2 " style="width:100% ;">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Bank Transfer</label>
                                    <select id="tmb-bank-inv" class="form-control select2" style="width:100%;" required></select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Pembayaran</label>
                                    <input type="text" id="tmb-pembayaran-inv" class="form-control" required readonly>
                                </div>
                                <div class="col-lg-4">
                                    <label> Tgl Jatuh Tempo</label>
                                    <input type="date" id="tmb-tempo-inv" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Perusahaan</label>
                                    <input type="text" id="tmb-perusahaan" class="form-control" hidden>
                                    <input type="text" id="tmb-namaperusahaan" class="form-control" required readonly>
                                    <label>Marketing</label>
                                    <input type="text" id="tmb-marketing-inv" class="form-control" hidden>
                                    <input type="text" id="tmb-namamarketing-inv" class="form-control" required readonly>
                                    <label>Rekanan</label>
                                    <input type="text" id="tmb-rekanan-inv" class="form-control" hidden>
                                    <input type="text" id="tmb-namarekanan-inv" class="form-control" required readonly>
                                    <label>Surat Jalan</label>
                                    <input type="text" id="tmb-sj-inv" class="form-control" readonly required>
                                </div>
                                <div class="col-lg-4">
                                    <label>VAT</label>
                                    <input type="number" id="tmb-vat-inv" class="form-control" required readonly>
                                    <label>PO request</label>
                                    <input type="text" id="tmb-po-inv" class="form-control" readonly>
                                    <label>Barang</label>
                                    <textarea id="tmb-barang-inv" class="form-control"rows="3" style="resize: none;" disabled></textarea>
                                </div>
                                <div class="col-lg-4">
                                    <label >Uang Muka (Rp.)</label>
                                    <input type="number" id="tmb-dp-inv" class="form-control" min="0">
                                    <label>Keterangan</label>
                                    <textarea  id="tmb-keterangan-inv" class="form-control" row="" style="resize: none;" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                              <div class="col-lg-8"></div>
                              <div class="col-lg-4">
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input form-control" id="kunci-invoice">
                                  <label class="custom-control-label" for="kunci-invoice" >Kunci Invoice</label>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Barang</h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <button type="button" id="add-barang" class=" btn btn-primary" >Tambah Barang</button>
                            </div>
                            <div class="row" id="tambah-barang">
                                <form id="form-tambah-barang">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <select id="tambah-nama-barang" class="form-control select2" style="width:100%;" required></select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" id="tambah-hargabarang" readonly>
                                            <input type="number" step=".001" class="form-control" id="tambah-harga-barang" required hidden>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" id="tambah-satuan-barang" required readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input type="text" id="tambah-jumlah-barang" class="form-control" required>
                                        </div>
                                    </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                      <label>Nama Request</label>
                                      <input type="text" id="tambah-namareq-barang" class="form-control">
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <label>Diakui</label>
                                        <input id="tambah-diakui-barang" step=".001" class="form-control" type="number" min="0" required>
                                      </div>
                                      <div class="col-lg-6">
                                        <label>Dikirim</label>
                                        <input id="tambah-dikirim-barang" step=".001" class="form-control" type="number" min="0" required >
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                        <label >Diterima</label>
                                        <input id="tambah-diterima-barang" step=".001" class="form-control" type="number" min="0" >
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Gudang</label>
                                                <select class="form-control select2" id="tambah-gudang-barang" style="width: 100%;" required></select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Stock</label>
                                                <input type="text" class="form-control" id="tambah-stock-barang" readonly>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>HPP</label>
                                                <input type="text" class="form-control" id="tambah-hppbarang" readonly>
                                                <input type="text" step=".001" class="form-control" id="tambah-hpp-barang" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label> Debit</label>
                                                <select id="tambah-debit-barang" class="form-control select2"  required></select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Kredit</label>
                                                <select id="tambah-kredit-barang" class="form-control select2"  required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Keterangan</label>
                                        <textarea id="tambah-keterangan-barang" class="form-control" style="resize: none;" rows="4"></textarea>
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
                                      <button type="button"  id="btn-cancel-tambah-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                      <button type="submit"  id="btn-tambah-barang" class="col-sm-5 form-control btn btn-primary ">Tambah Barang</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="row" id="edit-barang">
                              <form id="form-edit-barang">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Nama Barang</label>
                                        <input type="text" id="edit-kode" hidden>
                                        <input type="text" id="edit-kodesj" hidden>
                                        <input type="text" id="edit-kode_brg" hidden>
                                        <input type="text"id="edit-nama-barang" class="form-control" disabled readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Harga</label>
                                        <input type="text" id="edit-hargabarang" class="form-control" readonly>
                                        <input id="edit-harga-barang" step=".001" class="form-control" type="number" min="0" hidden>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Satuan</label>
                                        <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Jumlah</label>
                                        <input id="edit-jumlah-barang" class="form-control" type="text" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Nama Request</label>
                                        <input type="text" id="edit-namareq-barang" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Diakui</label>
                                        <input id="edit-diakui-barang" step=".001" class="form-control" type="number" min="0" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Dikirim</label>
                                        <input id="edit-dikirim-barang" step=".001" class="form-control" type="number" min="0" required >
                                    </div>
                                    <div class="col-lg-4">
                                        <label >Diterima</label>
                                        <input id="edit-diterima-barang" step=".001" class="form-control" type="number" min="0" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Gudang</label>
                                                <select id="edit-gudang-barang" class="form-control select2" width="100%">
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Stock</label>
                                                <input type="number" step=".001" class="form-control" id="edit-stock-barang" readonly>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>HPP</label>
                                                <input type="text" class="form-control" id="edit-hppbarang" readonly>
                                                <input type="number" step=".001" class="form-control" id="edit-hpp-barang" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Debit</label>
                                                <select id="edit-debit-barang" class="form-control select2" style="width:100%;"></select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Kredit</label>
                                                <select id="edit-kredit-barang" class="form-control select2" style="width:100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" id="edit-keterangan-barang" style="resize:none;" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-8">

                                  </div>
                                  <div class="col-lg-4">
                                    <br>
                                    <div class="row justify-content-between">
                                      <button type="button"  id="btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                      <button type="submit"  id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="row" id="hapus-barang">
                              <form id="form-hapus-barang">
                                <input id="hapus-kode-barang" class="form-control" type="text" hidden>
                                <input id="hapus-kodesj" class="form-control" type="text" hidden>
                                <div class="row justify-content-center ">
                                  <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                </div>
                                <div class="row justify-content-center" >
                                      <label class="col-lg-3">Nama Barang </label>
                                      <label id ="hapus-nama-barang" class="col-lg-9"></label>
                                </div>
                                <br>
                                <div class="row justify-content-between ">
                                  <button type="button"  id="btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                  <button type="submit"  id="btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                </div>
                              </form>
                            </div>
                            <br>
                            <div class="row">
                                <table  class="table table-responsive table-bordered table-striped">
                                  <thead>
                                  <tr align="center">
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">No.</th>
                                    <th colspan="3" align="center">Surat Jalan</th>
                                    <th rowspan="2">Sales Order</th>
                                    <th colspan="2" align="center">Lokasi Gudang Keluar</th>
                                    <th rowspan="2">Kode Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th colspan="3" align="center">QTY</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Nama Barang (request)</th>
                                    <th rowspan="2">@Harga Jual</th>
                                    <th colspan="2" align="center">VAT</th>
                                    <th rowspan="2">DPP</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Uraian</th>
                                    <th colspan="2">Kode Akun Debit</th>
                                    <th colspan="2">Kode Akun Kredit</th>
                                  </tr>
                                  <tr align="center">
                                    <td>Kode</td>
                                    <td>Tgl Kirim</td>
                                    <td>Tgl Terima</td>
                                    <td>Kode</td>
                                    <td>Nama</td>
                                    <td>Diakui</td>
                                    <td>Dikirim</td>
                                    <td>Selisih</td>
                                    <td>%</td>
                                    <td>Rp.</td>
                                    <td>Kode</td>
                                    <td>Nama Perkiraan</td>
                                    <td>Kode</td>
                                    <td>Nama Perkiraan</td>
                                  </tr>
                                  </thead>
                                  <tbody id="tbl_inv_tambah">
                                  </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <form id="tmbinv">
                  <input type="text" id="tmb-time-inv" class="form-control" hidden>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" id="btn-close-inv" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-submit-inv"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Invoice -->
      <!-- MODAL Edit Invoice -->
        <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header bg-warning">
                      <h4 class="modal-title">Edit Invoice</h4>
                      <button type="button" id="btn-edit-x-inv" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Invoice</h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Kode Transaksi</label>
                                            <input id="edt-kode-inv" class="form-control" type="text" value=""readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Sales Order</label>
                                            <input type="text" id="edt-so-inv" class="form-control" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <input type="text" class="form-control" id="edt-perusahan" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input id="edt-tgl-inv" class="form-control" type="date" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Bank Transfer</label>
                                            <select id="edt-bank-inv" class="form-control select2" style="width:100%;" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Tgl Jatuh Tempo</label>
                                            <input type="date" id="edt-tempo-inv" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Pembayaran</label>
                                            <input type="text" id="edt-pembayaran-inv" class="form-control" required readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>VAT</label>
                                            <input type="number" id="edt-vat-inv" class="form-control" required readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label >Uang Muka (Rp.)</label>
                                            <input type="number" id="edt-dp-inv" class="form-control" min="0">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Marketing</label>
                                                    <input type="text" id="edt-namamarketing-inv" class="form-control" required readonly>

                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Rekanan</label>
                                                    <input type="text" id="edt-namarekanan-inv" class="form-control" required readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Surat Jalan</label>
                                                    <input type="text" id="edt-sj-inv" class="form-control" disabled>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>PO request</label>
                                                    <input type="text" id="edt-po-inv" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea  id="edt-keterangan-inv" class="form-control" rows"4" style="resize: none;" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>AUTHORISASI </label>
                                    <br>
                                    <label >Dibuat Oleh :</label>
                                    <h6 id="edit-nama-pembuat"></h6>
                                    <h6 id="edit-create-pembuat"></h6>
                                    <label> Diperiksa Oleh :</label>
                                    <h6 id="edit-nama-pemeriksa"></h6>
                                    <h6 id="edit-create-pemeriksa"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                              <div class="col-lg-8"></div>
                              <div class="col-lg-4">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input form-control" id="kunci-edt-invoice">
                                  <label class="custom-control-label" for="kunci-edt-invoice" >Kunci Invoice</label>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Data Invoice</h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>

                        </div>
                        <div class="card-body">
                            <button type="button" id="edt-add-barang" class=" btn btn-primary">Tambah Barang</button>
                            <div class="row" id="edt-tambah-barang">
                              <form id="form-edt-tambah-barang">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label> Nama Barang</label>
                                        <select id="edt-tambah-nama-barang" class="form-control select2" required style="width:100%;"></select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Harga</label>
                                        <input type="text" class="form-control" id="edt-tambah-hargabarang" readonly>
                                        <input type="number" step=".001" class="form-control" id="edt-tambah-harga-barang" hidden>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" id="edt-tambah-satuan-barang" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Jumlah</label>
                                        <input type="text" id="edt-tambah-jumlah-barang" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label> Nama Request</label>
                                        <input type="text" class="form-control" id="edt-tambah-namareq-barang">
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Diakui</label>
                                        <input type="number" step=".001" id="edt-tambah-diakui-barang" class="form-control" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label> Dikirim</label>
                                        <input type="number" step=".001" id="edt-tambah-dikirim-barang" class="form-control" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label >Diterima</label>
                                        <input id="edt-tambah-diterima-barang" step=".001" class="form-control" type="number" min="0" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Gudang</label>
                                                <select class="form-control select2" id="edt-tambah-gudang-barang" style="width: 100%;" required></select>

                                            </div>
                                            <div class="col-lg-3">
                                                <label>Stock</label>
                                                <input type="text" class="form-control" id="edt-tambah-stock-barang" readonly>

                                            </div>
                                            <div class="col-lg-3">
                                                <label>HPP</label>
                                                <input type="text" class="form-control" id="edt-tambah-hppbarang" readonly>
                                                <input type="number" step=".001" class="form-control" id="edt-tambah-hpp-barang" hidden>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Debit</label>
                                                <select id="edt-tambah-debit-barang" class="form-control select2" style="width:100%;" required></select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Kredit</label>
                                                <select id="edt-tambah-kredit-barang" class="form-control select2" style="width:100%;" required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" id="edt-tambah-keterangan-barang" style="resize:none;" rows="4"></textarea>
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
                                      <button type="button"  id="edt-btn-cancel-tambah-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                      <button type="submit"  id="edt-btn-tambah-barang" class="col-sm-5 form-control btn btn-primary ">Tambah Barang</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="row" id="edt-edit-barang">
                                <form id="form-edt-edit-barang">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <input type="text" id="edt-edit-kode" hidden>
                                            <input type="text" id="edt-edit-kodesj" hidden>
                                            <input type="text" id="edt-edit-kode_brg" hidden>
                                            <input type="text"id="edt-edit-nama-barang" class="form-control" disabled>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input type="text" class="form-control" id="edt-edit-hargabarang" readonly>
                                            <input type="number" step=".001"  class="form-control" id="edt-edit-harga-barang" hidden>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" id="edt-edit-satuan-barang" readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input type="text" class="form-control" id="edt-edit-jumlah-barang" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Request</label>
                                            <input type="text" id="edt-edit-namareq-barang" class="form-control">

                                        </div>
                                        <div class="col-lg-2">
                                            <label>Diakui</label>
                                            <input id="edt-edit-diakui-barang" step=".001" class="form-control" type="number" min="0" required>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Dikirim</label>
                                            <input id="edt-edit-dikirim-barang" step=".001" class="form-control" type="number" min="0" required >
                                        </div>
                                        <div class="col-lg-4">
                                            <label >Diterima</label>
                                            <input id="edt-edit-diterima-barang" step=".001" class="form-control" type="number" min="0" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Gudang</label>
                                                    <select class="form-control select2" id="edt-edit-gudang-barang"></select>

                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Stock</label>
                                                    <input id="edt-edit-stock-barang" step=".001" class="form-control" type="number" min="0" required>

                                                </div>
                                                <div class="col-lg-3">
                                                    <label>HPP</label>
                                                    <input type="text" class="form-control" id="edt-edit-hppbarang" readonly>
                                                    <input id="edt-edit-hpp-barang" class="form-control"  type="number"  hidden>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Debit</label>
                                                    <select id="edt-edit-debit-barang" class="form-control select2" style="width:100%;" ></select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Kredit</label>
                                                    <select id="edt-edit-kredit-barang" class="form-control select2" style="width:100%;" ></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="edt-edit-keterangan-barang" style="resize:none;" class="form-control" rows="4"></textarea>
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
                                          <button type="button"  id="edt-btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                          <button type="submit"  id="edt-btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                        </div>
                                      </div>
                                    </div>
                              </form>
                            </div>
                            <div class="row" id="edt-hapus-barang">
                              <form id="form-edt-hapus-barang">
                                <input id="edt-hapus-kode-barang" class="form-control" type="text" hidden>
                                <input id="edt-hapus-kodesj" class="form-control" type="text" hidden>
                                <div class="row justify-content-center ">
                                  <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                </div>
                                <div class="row justify-content-center" >
                                      <label class="col-lg-3">Nama Barang </label>
                                      <label id ="edt-hapus-nama-barang" class="col-lg-9"></label>
                                </div>
                                <br>
                                <div class="row justify-content-between ">
                                  <button type="button"  id="btn-edt-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                  <button type="submit"  id="btn-edt-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                </div>
                              </form>
                            </div>
                            <br>
                            <table  class="table table-responsive table-bordered table-striped">
                              <thead>
                              <tr align="center">
                                <th rowspan="2">Action</th>
                                <th rowspan="2">No.</th>
                                <th colspan="3" align="center">Surat Jalan</th>
                                <th rowspan="2">Sales Order</th>
                                <th colspan="2" align="center">Lokasi Gudang Keluar</th>
                                <th rowspan="2">Kode Barang</th>
                                <th rowspan="2">Nama Barang</th>
                                <th colspan="3" align="center">QTY</th>
                                <th rowspan="2">Satuan</th>
                                <th rowspan="2">Nama Barang (request)</th>
                                <th rowspan="2">@Harga Jual</th>
                                <th colspan="2" align="center">VAT</th>
                                <th rowspan="2">DPP</th>
                                <th rowspan="2">Jumlah</th>
                                <th rowspan="2">Uraian</th>
                                <th colspan="2">Kode Akun Debit</th>
                                <th colspan="2">Kode Akun Kredit</th>
                              </tr>
                              <tr align="center">
                                <td>Kode</td>
                                <td>Tgl Kirim</td>
                                <td>Tgl Terima</td>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Diakui</td>
                                <td>Dikirim</td>
                                <td>Selisih</td>
                                <td>%</td>
                                <td>Rp.</td>
                                <td>Kode</td>
                                <td>Nama Perkiraan</td>
                                <td>Kode</td>
                                <td>Nama Perkiraan</td>
                              </tr>
                              </thead>
                              <tbody id="tbl_inv_edit">
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
                  <form id="edtinv">
                    <input type="text" id="edt-edit-time-inv" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="edt-btn-close-inv" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="edt-btn-submit-inv"class="col-sm-2 form-control btn btn-warning">Edit</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Edit Invoice -->
      <!-- MODAL Detail Invoice -->
        <div class="modal fade" id="modal-detail">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Invoice</h4>
                  <button type="button" id="dtl-btn-x-inv" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body form-group">
                  <div class="card">
                      <div class="card-header">
                            <h3 class="card-title">Data Invoice</h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                      </div>
                      <div class="card-body">
                          <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Kode Transaksi</label>
                                            <input id="dtl-kode-inv" class="form-control" type="text" value=""readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Sales Order</label>
                                            <input type="text" id="dtl-so-inv" class="form-control" disabled>

                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <input type="hidden" id="dtl-perusahaan">
                                            <input type="text" id="dtl-namaperusahaan" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input id="dtl-tgl-inv" class="form-control" type="date" required disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Bank Transfer</label>
                                            <input type="text" id="dtl-bank-inv" class="form-control" disabled>

                                        </div>
                                        <div class="col-lg-4">
                                            <label> Tgl Jatuh Tempo</label>
                                            <input type="date" id="dtl-tempo-inv" class="form-control" disabled>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Pembayaran</label>
                                            <input type="text" id="dtl-pembayaran-inv" class="form-control" required readonly>

                                        </div>
                                        <div class="col-lg-4">
                                            <label>VAT</label>
                                            <input type="number" id="dtl-vat-inv" class="form-control" required readonly>

                                        </div>
                                        <div class="col-lg-4">
                                            <label >Uang Muka (Rp.)</label>
                                            <input type="number" id="dtl-dp-inv" class="form-control" min="0" disabled>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Marketing</label>
                                                    <input type="text" id="dtl-marketing-inv" class="form-control" required readonly>

                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Rekanan</label>
                                                    <input type="text" id="dtl-rekanan-inv" class="form-control" required readonly>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Surat Jalan</label>
                                                    <input type="text" id="dtl-sj-inv" class="form-control" readonly>

                                                </div>
                                                <div class="col-lg-6">
                                                    <label>PO request</label>
                                                    <input type="text" id="dtl-po-inv" class="form-control" readonly>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea  id="dtl-keterangan-inv" class="form-control" rows="4" style="resize: none;" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>AUTHORISASI </label>
                                    <br>
                                    <label >Dibuat Oleh :</label>
                                    <h6 id="detail-nama-pembuat"></h6>
                                    <h6 id="detail-create-pembuat"></h6>
                                    <label> Diperiksa Oleh :</label>
                                    <h6 id="detail-nama-pemeriksa"></h6>
                                    <h6 id="detail-create-pemeriksa"></h6>
                                </div>
                          </div>
                      </div>
                  </div>
                <br>
                <div class="card card-outline card-info">
                  <div class="card-header">
                        <h3 class="card-title"><b>Data Barang</b></h3>
                        <div class="card-tools">
                          <!-- Collapse Button -->
                          <a id="cetak-inv" class="btn btn-danger" rel="noopener noreferrer" target="_blank"><i class="fas fa-print"></i> Print</a>
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                  </div>
                  <div class="card-body">
                    <table  class="table table-responsive table-bordered table-striped">
                      <thead>
                      <tr align="center">
                        <th rowspan="2">No.</th>
                        <th colspan="3" align="center">Surat Jalan</th>
                        <th rowspan="2">Sales Order</th>
                        <th colspan="2" align="center">Lokasi Gudang Keluar</th>
                        <th rowspan="2">Kode Barang</th>
                        <th rowspan="2">Nama Barang</th>
                        <th colspan="3" align="center">QTY</th>
                        <th rowspan="2">Satuan</th>
                        <th rowspan="2">Nama Barang (request)</th>
                        <th rowspan="2">@Harga Jual</th>
                        <th colspan="2" align="center">VAT</th>
                        <th rowspan="2">DPP</th>
                        <th rowspan="2">Jumlah</th>
                        <th rowspan="2">Uraian</th>
                        <th colspan="2">Kode Akun Debit</th>
                        <th colspan="2">Kode Akun Kredit</th>
                      </tr>
                      <tr align="center">
                        <td>Kode</td>
                        <td>Tgl Kirim</td>
                        <td>Tgl Terima</td>
                        <td>Kode</td>
                        <td>Nama</td>
                        <td>Diakui</td>
                        <td>Dikirim</td>
                        <td>Selisih</td>
                        <td>%</td>
                        <td>Rp.</td>
                        <td>Kode</td>
                        <td>Nama Perkiraan</td>
                        <td>Kode</td>
                        <td>Nama Perkiraan</td>
                      </tr>
                      </thead>
                      <tbody id="tbl_inv_detail">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <form id="dtlinv">
                <input type="text" id="dtl-time-inv" class="form-control" hidden>
                <div class="modal-footer justify-content-between ">
                    <button type="button" id="dtl-btn-close-inv" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="dtl-btn-submit-inv"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                </div>
              </form>
              </div>
          </div>
        </div>
      <!--/ Modal Detail Invoice -->
      <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data Invoice</h4>
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
      <!-- MODAL Hapus Invoice -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-inv">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data SJ</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-kode-inv" class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class="col-md-3">Kode </label>
                                          <h6 class="col-md-6" id="hapus-kode"></h6>
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
      <!--/ Modal Hapus Invoice -->

    <!--/ MODAL -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
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
    <script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
      $(document).ready(function() {
        $('#tabel-filter').hide();
        $('#cancel-filter').hide();
        $('#filter').hide();
        $('#tabel-inv').DataTable({
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
            ajax: '{!! url("data-inv") !!}',
            columns: [
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'perusahaan', name:'perusahaan',orderable:true},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'kode_so',name: 'kode_so',orderable:true},
                { data: 'kode_sj', name: 'kode_sj',orderable:true},
                { data: 'rekanan', name: 'rekanan',orderable:true},
                { data: 'barang', name: 'barang',orderable:false},
                { data: 'total', name: 'total',orderable:false},
                { data: 'tempo', name: 'tempo',orderable:false},
                { data: 'keterangan', name: 'keterangan',orderable:false},
                { data: 'status', name: 'status',orderable:true},
                { data: 'kekurangan', name: 'kekurangan',orderable:false,searchable:false},
            ]
        });

      });
      $('#cancel-filter').on('click',function(){

          $('#filter').hide();
          $('#tabel-filter').DataTable().clear().destroy();
          $('#tabel-filter').hide();
          $('#tabel-inv').DataTable().clear().destroy();
          $('#tabel-inv').DataTable({
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
                ajax: '{!! url("data-inv") !!}',
                columns: [
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'kode', name: 'kode',orderable:true},
                    { data: 'kode_so',name: 'kode_so',orderable:true},
                    { data: 'kode_sj', name: 'kode_sj',orderable:true},
                    { data: 'rekanan', name: 'rekanan',orderable:true},
                    { data: 'tempo', name: 'tempo',orderable:false},
                    { data: 'keterangan', name: 'keterangan',orderable:false},
                    { data: 'status', name: 'status',orderable:true},
                ]
            });
            $('#cancel-filter').hide();
            $('#cek-filter').show();
          $('#tabel-inv').show();
      });
      $(document).on('click','#cek-filter',function(){
          $('#tabel-inv').DataTable().clear().destroy();
          document.getElementById("form-filter").reset();
          $('#cek-filter').hide();
          $('#filter-marketing').empty();
          $('#filter-konsumen').empty();
          @if($user->level == 'marketing')
            var datahandler = $('#filter-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
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
                var Nrow = $("<option value='all'>ALL</option>");
                datahandler.append(Nrow);
                $.each(data, function(key,val){
                  var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                  datahandler.append(Nrow);
                });

              }
            });
          @endif
          $('#filter').show();
          $('#cancel-filter').show();
          //Konsumen
            $.ajax({
                url     : '{!! url("dropdown-konsumen") !!}',
                type    : 'get',
                success : function(data){
                    var datahandler = $('#filter-konsumen');
                    var Nrow = $("<option value=''>Pilih Konsumen</option>");
                    datahandler.append(Nrow);
                    var Nrow = $("<option value='all'>ALL</option>");
                    datahandler.append(Nrow);
                    $.each(data, function(key,val){
                      var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                      datahandler.append(Nrow);
                    });
                }
            })
          //Konsumen
      });
      $('#form-filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-submit-filter');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        $.ajax({
            type : 'get',
            url  : '{!! url("filter-inv")!!}',
            data :{
                awal    :$('#filter-awal').val(),
                akhir   :$('#filter-akhir').val(),
                marketing : $('#filter-marketing').val(),
                konsumen   :$('#filter-konsumen').val(),
                status  : $('#filter-status').val(),
            },
            success : function(response){
                // // console.log(response);
                if(response.success == true){
                    $('#tabel-inv').DataTable().clear().destroy();
                    $('#tabel-filter').DataTable().clear().destroy();
                    $('#tabel-filter').DataTable({
                        paging      : true,
                        lengthChange: true,
                        autoWidth   : true,
                        search      : false,
                          buttons: [
                              'copy', 'csv', 'excel', 'pdf', 'print'
                          ],
                        dom: 'Blfrtip',
                      data : response.data.original.data,
                      columns : [
                        { data: 'INV', name: 'INV',orderable:false, searchable:false},
                        { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                        { data: 'so', name: 'so',orderable:false, searchable:false},
                        { data: 'sj', name: 'sj',orderable:false, searchable:false},
                        { data: 'bank', name: 'bank',orderable:false, searchable:false},
                        { data: 'vat', name: 'vat',orderable:false, searchable:false},
                        { data: 'tempo', name: 'tempo',orderable:false, searchable:false},
                        { data: 'dp', name: 'dp',orderable:false, searchable:false},
                        { data: 'KETERANGAN', name: 'KETERANGAN',orderable:false, searchable:false},
                        { data: 'status', name: 'status',orderable:false, searchable:false},
                        { data: 'kd_brg', name: 'kd_brg',orderable:false, searchable:false},
                        { data: 'barang', name: 'barang',orderable:false, searchable:false},
                        { data: 'request', name: 'request',orderable:false, searchable:false},
                        { data: 'harga', name: 'harga',orderable:false, searchable:false},
                        { data: 'hpp', name: 'hpp',orderable:false, searchable:false},
                        { data: 'diakui', name: 'diakui',orderable:false, searchable:false},
                        { data: 'dikirim', name: 'dikirim',orderable:false, searchable:false},
                        { data: 'diterima', name: 'diterima',orderable:false, searchable:false},
                        { data: 'dpp', name: 'dpp',orderable:false, searchable:false},
                        { data: 'jumlah', name: 'jumlah',orderable:false, searchable:false},
                        { data: 'keterangan', name: 'keterangan',orderable:false, searchable:false},
                      ],
                    });
                    $('#tabel-filter').show();
                    $('#tabel-inv').hide();
                } else {
                    Toast.fire({
                        icon    :'error',
                        title   : response.pesan
                    })
                }
            }
        })
      });

      $('.select2').select2();
      var token = "{!! csrf_token() !!}";
      var today = new Date();
      var tgl = today.getDate();
      if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
        tgl = '0'+tgl;
      }
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var time = date+' '+time;
      // Tambah Invoice
        $(document).on('click','#tambahdata',function(){
          $('#add-barang').hide();$('#tambah-barang').hide(); $('#edit-barang').hide(); $('#hapus-barang').hide(); $('#add-barang').hide();
          $('#tmb-tgl-inv').prop('disabled',false); $('#tmb-bank-inv').prop('disabled',false); $('#tmb-so-inv').prop('disabled',false);
          $('#tmb-tempo-inv').prop('disabled',false); $('#tmb-dp-inv').prop('disabled',false); $('#tmb-keterangan-inv').prop('disabled',false);
          $('#btn-submit-inv').prop('disabled',true);
          $('#kunci-invoice').prop('checked',false);
          $('#tmb-tgl-inv').val(''); $('#tmb-kode-inv').val(''); $('#tmb-so-inv').empty(); $('#tmb-bank-inv').empty(); $('#tmb-pembayaran-inv').val('');$('#tmb-namaperusahaan').val('');
          $('#tmb-namamarketing-inv').val('');$('#tmb-namarekanan-inv').val(''); $('#tmb-sj-inv').val(''); $('#tmb-vat-inv').val(''); $('#tmb-po-inv').val('');
          $('#tmb-tempo-inv').val(''); $('#tmb-dp-inv').val(''); $('#tmb-keterangan-inv').val('');
        });
        $('#tmb-bank-inv').select2({
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
        $('#tmb-so-inv').select2({
          placeholder: 'Pilih Sales Order',
          ajax: {
              url: '{!! url("dropdown-so-inv") !!}',
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

        $('#tmb-so-inv').on('change',function(){
          var kode  = $(this).val();
          var tgl = $('#tmb-tgl-inv').val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $.ajax({
            url     :'{!! url("lastkode-sj") !!}',
            type    : 'get',
            data    : {
              jenis   : '41',
              tanggal : n
            },
            success : function(data){
              $('#tmb-sj-inv').val(data);
            }
          });
          $.ajax({
            url   :'{!! url("data-so/'+kode+'/edit") !!}',
            method  : 'get',
            success:function(data){
                console.log(data);
              if(data.success == true){
                  $('#tmb-perusahaan').val(data.so.perusahaan);
                  $('#tmb-namaperusahaan').val(data.so.namaperusahaan);
                $('#tmb-marketing-inv').val(data.so.marketing);
                $('#tmb-namamarketing-inv').val(data.so.karyawan);
                $('#tmb-rekanan-inv').val(data.so.konsumen);
                $('#tmb-namarekanan-inv').val(data.so.rekanan);
                $('#tmb-pembayaran-inv').val(data.so.pembayaran);
                $('#tmb-vat-inv').val(data.so.vat);
                $('#tmb-po-inv').val(data.so.no_po);
                $('#tmb-barang-inv').val(data.so.barang);

              } else {
                Toast.fire({
                  icon: 'error',
                  title: data.pesan
                })
              }

            }
          });
        });

        //Last Kode
        $('#tmb-tgl-inv').on('change',function(){
          var tgl = $(this).val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $.ajax({
            url   : '{!! url("lastkode-inv") !!}',
            method  : 'get',
            data  : {
              tgl : n,
            },
            success : function(data){
              // // console.log(data);
              $('#tmb-kode-inv').val(data);
            }
          });
          var jenis = $('#tmb-so-inv').val();
          if(jenis == null){

          } else {
              jenis = "41";
          }
          $.ajax({
              url   :'{!! url("lastkode-sj") !!}',
              type  : 'get',
              data  : {
                  tanggal : n,
                  jenis   : jenis,
              },
              success:function(response){
                  // // console.log(response);
                  $('#tmb-sj-inv').val(response);
              }
          })
        });

        $(document).on('change','#kunci-invoice', function(){

          var checkBox = document.getElementById("kunci-invoice");
          var token = "{!! csrf_token() !!}";
          var kode  = $('#tmb-kode-inv').val();
          var length = kode.length;
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          $('#tmb-time-inv').val(time);
          var tgl = $('#tmb-tgl-inv').val(); var bank = $('#tmb-bank-inv').val(); var so = $('#tmb-so-inv').val();
          var tempo = $('#tmb-tempo-inv').val(); var dp = $('#tmb-dp-inv').val(); var ket = $('#tmb-keterangan-inv').val();
          //SCREENING
          if (tgl == ''){Toast.fire({icon: 'error',title: 'TANGGAL WAJIB DIISI !!'})
            return false;
          }
          if (bank == ''){Toast.fire({icon: 'error',title: 'BANK WAJIB DIISI !!'})
            return false;
          }
          if (so == ''){Toast.fire({icon: 'error',title: 'SALES ORDER WAJIB DIISI !!'})
            return false;
          }
          if (tempo == ''){Toast.fire({icon: 'error',title: 'TEMPO WAJIB DIISI !!'})
            return false;
          }
          if (dp == ''){Toast.fire({icon: 'error',title: 'DP WAJIB DIISI ("0" jika tanpa DP)!!'})
            return false;
          }
          if (ket == ''){Toast.fire({icon: 'error',title: 'KETERANGAN WAJIB DIISI !!'})
            return false;
          }

          if(checkBox.checked == true){
            // // console.log("ON");
            $('#add-barang').show();
            $('#tmb-tgl-inv').prop('disabled',true); $('#tmb-bank-inv').prop('disabled',true); $('#tmb-so-inv').prop('disabled',true);
            $('#tmb-tempo-inv').prop('disabled',true); $('#tmb-dp-inv').prop('disabled',true); $('#tmb-keterangan-inv').prop('disabled',true);
            $('#btn-close-inv').prop('disabled',true); $('#btn-x-inv').prop('disabled',true); $('#btn-submit-inv').prop('disabled',false);
            $('#tbl_inv_tambah').empty();
            $.ajax({
              method : 'post',
              url    : '{!! url("data-sj")!!}',
              data   : {
                _token : token,
                tanggal : $('#tmb-tgl-inv').val(),
                perusahaan : $('#tmb-perusahaan').val(),
                tipe    : "41",
                kode    : $('#tmb-sj-inv').val(),
                so      : $('#tmb-so-inv').val(),
                konsumen: $('#tmb-rekanan-inv').val(),
                keterangan : $('#tmb-keterangan-inv').val(),
                author    : '{{$user->kode_karyawan}}',
              },
              success: function(response){
                // // console.log(response);
                if(response.success == true){
                  Toast.fire({
                    icon  : 'success',
                    title : response.pesan,
                  });
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : response.pesan,
                  });
                }
              }
            });
          } else {
            // // console.log("OFF");
            $('#add-barang').hide();
            $('#tambah-barang').hide(); $('#edit-barang').hide(); $('#hapus-barang').hide(); $('#add-barang').hide();
            $('#tmb-tgl-inv').prop('disabled',false); $('#tmb-bank-inv').prop('disabled',false); $('#tmb-so-inv').prop('disabled',false);
            $('#tmb-tempo-inv').prop('disabled',false); $('#tmb-dp-inv').prop('disabled',false); $('#tmb-keterangan-inv').prop('disabled',false);
            $('#btn-close-inv').prop('disabled',false); $('#btn-x-inv').prop('disabled',false); $('#btn-submit-inv').prop('disabled',true);
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            var sj = $('#tmb-sj-inv').val();
            $.ajax({
              url   : '{!! url("data-sj/'+sj+'") !!}',
              method : 'delete',
              data  : { _token : token,user : "{{$user->kode_karyawan}}",},
              success : function(response){
                // // console.log(response);
                if(response.success == true){
                  Toast.fire({
                    icon  : 'success',
                    title : response.pesan,
                  });
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : response.pesan,
                  });
                }
              }
            });
            $.ajax({
              url    : '{!! url("hps-detail-inv/'+kode+'") !!}',
              method : 'delete',
              data    : {
                _token : token,
                user : "{{$user->kode_karyawan}}",
                sj      : $('#tmb-sj-inv').val(),
              },
              success:function(response){
                // // console.log(response);
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: response.pesan
                  })
                  $('#tbl_inv_tambah').empty();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }

              }
            });
          }
        });
        //Tambah Barang
          $('#add-barang').on('click',function(){
            @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin')
              $('#tambah-hppbarang').show();
            @else
              $('#tambah-hppbarang').hide();
            @endif
            $('#tambah-barang').show();
            document.getElementById("form-tambah-barang").reset();
            var so = $('#tmb-so-inv').val();
            $('#tambah-nama-barang').val(null).trigger('change');
            $('#tambah-debit-barang').val(null).trigger('change');
            $('#tambah-kredit-barang').val(null).trigger('change');
            $('#tambah-nama-barang').select2({
              placeholder:"Pilih Barang",
                ajax: {
                    url: '{!! url("dropdown-barangso/'+so+'") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#tambah-gudang-barang').select2({
              placeholder:"Pilih Gudang",
                ajax: {
                    url: '{!! url("dropdown-gudang") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#tambah-debit-barang').select2({
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
            $('#tambah-kredit-barang').select2({
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

            $('#add-barang').hide();

          });
          $('#tambah-gudang-barang').on('change',function(){
            var gudang = $(this).val();
            if (gudang == "BUFFER") {
              $('#tambah-stock-barang').val(99999);
            } else {
              $.ajax({
                url :'{!! url("stock-barang/'+gudang+'") !!}',
                type : 'get',
                data :{
                  barang : $('#tambah-nama-barang').val(),
                },
                success : function(response){
                  // // console.log(response);
                  if(response.success == true){
                    $('#tambah-stock-barang').val(response.data);
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: response.pesan
                    })
                  }
                }
              });
            }


          });
          $('#tambah-nama-barang').on('change',function(){
            var barang = $(this).val();
            var transaksi = $('#tmb-so-inv').val();
            $.ajax({
              url     : '{!! url("data-detailsobarang/'+transaksi+'")!!}',
              type    : 'get',
              data    : {
                barang  : barang,
              },
              success : function(response){
                // // console.log(response);
                if(response.success == true) {
                  $('#tambah-namareq-barang').val(response.data.nama_request);
                  $('#tambah-hargabarang').val(formatRupiah(response.data.harga));
                  $('#tambah-harga-barang').val(response.data.harga);
                  $('#tambah-satuan-barang').val(response.data.satuan);
                  $('#tambah-diakui-barang').val(response.data.qty);
                  $('#tambah-dikirim-barang').val(response.data.qty);
                  $('#tambah-diterima-barang').val(response.data.qty);
                  $('#tambah-jumlah-barang').val(formatRupiah(response.data.total));
                  $('#tambah-hpp-barang').val(response.data.hpp);
                  $('#tambah-hppbarang').val(formatRupiah(response.data.hpp));
                  $('#tambah-keterangan-barang').val(response.data.keterangan);
                  var pembayaran = $('#tmb-pembayaran-inv').val();
                  if(pembayaran == 'TUNAI'){
                    $('#tambah-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.debit) //set value for option to post it
                          .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                      .val(response.data.debit) //select option of select2
                      .trigger("change"); //apply to select2
                  } else {
                    $('#tambah-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val("12") //set value for option to post it
                          .text("12 Piutang Usaha")) //set a text for show in select
                      .val("12") //select option of select2
                      .trigger("change"); //apply to select2
                  }

                  $('#tambah-kredit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kredit) //set value for option to post it
                          .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                      .val(response.data.kredit) //select option of select2
                      .trigger("change"); //apply to select2

                } else {
                  Toast.fire({
                    icon   : 'error',
                    title  : "Data Tidak Ditemukan",
                  });
                }
              }
            });

          });
          $('#tambah-diakui-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null){
              return false;
            } else {
              var harga = $('#tambah-harga-barang').val();
              $('#tambah-jumlah-barang').val(formatRupiah(qty*harga));
            }
          });
          $('#btn-cancel-tambah-barang').on('click',function(){
            $('#tambah-barang').hide();
            $('#add-barang').show();
          });
          $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var inv = $('#tmb-kode-inv').val();
            //Detail Invoice
            $.ajax({
              type  : 'post',
              url: '{!! url("data-detailinv") !!}',
                data : {
                  inv         : $('#tmb-kode-inv').val(),
                  _token      : token,
                  barang      : $('#tambah-nama-barang').val(),
                  nama_req    : $('#tambah-namareq-barang').val(),
                  harga       : $('#tambah-harga-barang').val(),
                  hpp         : $('#tambah-hpp-barang').val(),
                  tanggal     : $('#tmb-tgl-inv').val(),
                  satuan      : $('#tambah-satuan-barang').val(),
                  diakui      : $('#tambah-diakui-barang').val(),
                  dikirim     : $('#tambah-dikirim-barang').val(),
                  diterima    : $('#tambah-diterima-barang').val(),
                  vat         : $('#tmb-vat-inv').val(),
                  so          : $('#tmb-so-inv').val(),
                  gudang      : $('#tambah-gudang-barang').val(),
                  sj          : $('#tmb-sj-inv').val(),
                  debit       : $('#tambah-debit-barang').val(),
                  kredit      : $('#tambah-kredit-barang').val(),
                  keterangan  : $('#tambah-keterangan-barang').val(),
                  user : "{{$user->kode_karyawan}}",
                }, // serializes form input
                success:function(response) {
                  // console.log(response);
                  var hasil = response.pesan;
                  if(response.success == true ){
                    Toast.fire({
                      icon: 'success',
                      title: hasil
                    })
                    tabelINVtambah(inv);
                    document.getElementById("form-tambah-barang").reset();
                    $('#tambah-barang').hide();
                    $('#add-barang').show();
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title : hasil
                    });
                  }

                }
            });

          });
        //Tambah Barang
        //Edit Barang
          $('body').on('click', '.editbarang', function () {
            @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin')
              $('#edit-hppbarang').show();
            @else
              $('#edit-hppbarang').hide();
            @endif
            $('#edit-barang').show();
            $('#add-barang').hide();
            $('#hapus-barang').hide();
            var kode = $(this).data('kode');
            // console.log(kode);
            $('#edit-gudang-barang').select2({
              placeholder:"Pilih Gudang",
                ajax: {
                    url: '{!! url("dropdown-gudang") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#edit-kredit-barang').select2({
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
            $('#edit-debit-barang').select2({
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
            $.ajax({
              url :'{!! url("data-detailinv/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);

                $('#edit-kode').val(response.data.kode);
                $('#edit-nama-barang').val(response.data.nama);
                $('#edit-kode_brg').val(response.data.kode_brg);
                $('#edit-namareq-barang').val(response.data.nama_request);
                $('#edit-dikirim-barang').val(response.data.dikirim);
                $('#edit-diakui-barang').val(response.data.diakui);
                $('#edit-hppbarang').val(formatRupiah(response.data.hpp));
                $('#edit-diterima-barang').val(response.data.diterima);
                $('#edit-hargabarang').val(formatRupiah(response.data.harga_jual));
                $('#edit-harga-barang').val(response.data.harga_jual);
                $('#edit-satuan-barang').val(response.data.satuan);
                $('#edit-jumlah-barang').val(formatRupiah(response.data.jumlah));
                $('#edit-keterangan-barang').val(response.data.keterangan);
                $('#edit-debit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.debit) //set value for option to post it
                        .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                    .val(response.data.debit) //select option of select2
                    .trigger("change"); //apply to select2

                $('#edit-kredit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kredit) //set value for option to post it
                        .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                    .val(response.data.kredit) //select option of select2
                    .trigger("change"); //apply to select2


                $('#edit-gudang-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kode_gdg) //set value for option to post it
                        .text(response.data.kode_gdg+" "+response.data.gudang )) //set a text for show in select
                    .val(response.data.kode_gdg) //select option of select2
                    .trigger("change"); //apply to select2

                var barang = response.data.kode_brg;

                var gudang = response.data.kode_gdg;
                var qty   = response.data.dikirim;
                //STOK
                $.ajax({
                  url :'{!! url("stock-barang/'+gudang+'") !!}',
                  type : 'get',
                  data :{
                    barang : $('#edit-kode_brg').val(),
                  },
                  success : function(response){
                    // console.log(response);
                    if(response.success == true){
                      $('#edit-stock-barang').val(response.data);
                      $('#edit-diakui-barang').prop('max',response.data);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
                // Kode Detail SJ
                $.ajax({
                  type  : 'get',
                  url   : '{!! url("kode-detail-sj") !!}',
                  data  : {
                    sj    : $('#tmb-sj-inv').val(),
                    barang : $('#edit-kode_brg').val(),
                    gudang : gudang,
                    qty     : qty,
                  },
                  success : function(hasil){
                    // console.log(hasil);
                    if(hasil.success == true){
                      $('#edit-kodesj').val(hasil.data);
                    } else {
                      Toast.fire({
                        icon  : 'error',
                        title : hasil.pesan,
                      });
                    }
                  }
                });
              }
            });
          });
          $('#edit-gudang-barang').on('change',function(){
            var gudang = $(this).val();
            if(gudang == 'BUFFER'){
              $('#edit-stock-barang').val(99999);
            } else {
              $.ajax({
                url :'{!! url("stock-barang/'+gudang+'") !!}',
                type : 'get',
                data :{
                  barang : $('#edit-kode_brg').val(),
                },
                success : function(response){
                  // console.log(response);
                  if(response.success == true){
                    $('#edit-stock-barang').val(response.data);
                    $('#edit-diakui-barang').prop('max',response.data);
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: response.pesan
                    })
                  }
                }
              });
            }

          });
          $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            $('#add-barang').show();
          });
          $('#edit-diakui-barang').keyup(function(){
            var qty = $(this).val();
            if(qty == null){
              return false;
            } else {
              var harga = $('#edit-harga-barang').val();
              $('#edit-jumlah-barang').val(formatRupiah(qty*harga));
            }
          });
          $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edit-kode').val();
            var inv = $('#tmb-kode-inv').val();
            $.ajax({
              type: 'put',
              url: '{!! url("data-detailinv/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                nama_req    : $('#edit-namareq-barang').val(),
                diakui      : $('#edit-diakui-barang').val(),
                dikirim     : $('#edit-dikirim-barang').val(),
                diterima    : $('#edit-diterima-barang').val(),
                vat         : $('#tmb-vat-inv').val(),
                kodesj      : $('#edit-kodesj').val(),
                jumlah      : $('#edit-jumlah-barang').val(),
                debit       : $('#edit-debit-barang').val(),
                kredit      : $('#edit-kredit-barang').val(),
                keterangan  : $('#edit-keterangan-barang').val(),
                user : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true ) {
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelINVtambah(inv);
                  document.getElementById("form-tambah-barang").reset();
                  $('#edit-barang').hide();
                  $('#add-barang').show();
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : hasil,
                  })
                }

              }
            });

          });
        // /Edit Barang
        // Hapus Barang
          $('body').on('click','.hapusbarang',function(){
            $('#edit-barang').hide();
            $('#tambah-barang').hide();
            $('#add-barang').hide();
            $('#hapus-barang').show();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailinv/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  $('#hapus-kode-barang').val(kode);
                  $('#hapus-nama-barang').html(response.data.nama);
                  var barang = response.data.kode_brg;
                  var gudang = response.data.kode_gdg;
                  var qty = response.data.dikirim;
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : response.pesan
                  })
                }

              }
            });

            // Kode Detail SJ
            $.ajax({
              type  : 'get',
              url   : '{!! url("kode-detail-sj") !!}',
              data  : {
                sj    : $('#tmb-sj-inv').val(),
                barang : barang,
                gudang : gudang,
                qty   : qty,
              },
              success : function(hasil){
                // console.log(hasil);
                if(hasil.success == true){
                  $('#hapus-kodesj').val(hasil.data);
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : hasil.pesan,
                  });
                }
              }
            });
          });
          $('#btn-cancel-hapus').on('click', function(){
            $('#hapus-barang').hide();
            $('#add-barang').show();
          });
          $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#hapus-kode-barang').val();
            var inv = $('#tmb-kode-inv').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailinv/'+kode+'") !!}',
              data : {
                kode        : kode,
                kodesj      : $('#hapus-kodesj').val(),
                user        : "{{$user->kode_karyawan}}",
                _token      : token,
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true) {
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelINVtambah(inv);
                  $('#hapus-barang').hide();
                  $('#add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
              }
            });
          });
        // /Hapus Barang
        $('#tmbinv').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-submit-inv');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);

          var kode = $('#tmb-kode-inv').val();
          $.ajax({
            type: 'post',
            url: '{!! url("data-inv") !!}',
            data : {
              kode        : kode,
              tanggal     : $('#tmb-tgl-inv').val(),
              _token      : token,
              so          : $('#tmb-so-inv').val(),
              perusahaan  : $('#tmb-perusahaan').val(),
              bank        : $('#tmb-bank-inv').val(),
              sj          : $('#tmb-sj-inv').val(),
              tempo       : $('#tmb-tempo-inv').val(),
              vat         : $('#tmb-vat-inv').val(),
              po          : $('#tmb-po-inv').val(),
              dp          : $('#tmb-dp-inv').val(),
              keterangan  : $('#tmb-keterangan-inv').val(),

              author      : "{{$user->kode_karyawan}}",
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
                var table = $('#tabel-inv').DataTable();
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
      // Tambah Invoice
      // Edit Invoice
        $(document).on('click','.edit',function(){
          var kode = $(this).data('kode');
          $('#edt-bank-inv').prop('disabled',false); $('#edt-tgl-inv').prop('disabled',false); $('#edt-tempo-inv').prop('disabled',false); $('#edt-dp-inv').prop('disabled',false); $('#edt-keterangan-inv').prop('disabled',false);
          $('#btn-edit-x-inv').prop('disabled',false); $('#edt-btn-close-inv').prop('disabled',false); $('#edt-btn-submit-inv').prop('disabled',true); $('kunci-edt-invoice').prop('checked',false);
          $('#edt-add-barang').hide();
          $('#edt-tambah-barang').hide();
          $('#edt-edit-barang').hide();
          $('#edt-hapus-barang').hide();
          $('#edt-kode-inv').val(kode);

          $.ajax({
            url :'{!! url("data-inv/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
               console.log(response);
              if(response.success == true){
                  $('#edt-perusahan').val(response.data.inv.namaperusahaan);
                $('#edt-tgl-inv').val(response.data.inv.tanggal);
                $('#edt-so-inv').val(response.data.inv.kode_so);
                $('#edt-bank-inv')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.inv.kode_bank) //set value for option to post it
                        .text(response.data.inv.bank+" "+response.data.inv.rekening+" "+ response.data.inv.atas_nama )) //set a text for show in select
                    .val(response.data.inv.kode_bank) //select option of select2
                    .trigger("change"); //apply to select2
                $('#edt-bank-inv').select2({
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
                $('#edt-vat-inv').val(response.data.inv.vat);
                $('#edt-sj-inv').val(response.data.inv.kode_sj);
                $('#edt-tempo-inv').val(response.data.inv.tgl_tempo);
                $('#edt-dp-inv').val(response.data.inv.DP);
                $('#edt-po-inv').val(response.data.inv.po_req);
                $('#edt-namamarketing-inv').val(response.data.inv.marketing);
                $('#edt-namarekanan-inv').val(response.data.inv.rekanan);
                $('#edt-keterangan-inv').val(response.data.inv.keterangan);
                $('#edt-pembayaran-inv').val(response.data.inv.pembayaran);
                console.log(response.data.author);
                if(response.data.inv.status == 'Belum Diperiksa'){
                  $('#edit-nama-pembuat').html(""+response.data.author.creator.nama);
                  $('#edit-create-pembuat').html(response.data.author.created_at);
                  $('#edit-nama-pemeriksa').html("-");
                  $('#edit-create-pemeriksa').html("-");
                } else if(response.data.inv.status =='Sudah Diperiksa'){
                  $('#edit-nama-pembuat').html(response.data.author.creator.nama);
                  $('#edit-create-pembuat').html(response.data.author.created_at);
                  $('#edit-nama-pemeriksa').html(response.data.author.pemeriksa.nama);
                  $('#edit-create-pemeriksa').html(response.data.author.diperiksa);
                }
              } else {
                Toast.fire({
                  icon : 'error',
                  title : response.pesan
                });
              }

            }
          });
        });
        $('#kunci-edt-invoice').on('click',function(){
          var kode = $('#edt-kode-inv').val();
          var checkBox = document.getElementById("kunci-edt-invoice");
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          $('#edt-edit-time-inv').val(time);
          if(checkBox.checked == true){ $('#edt-bank-inv').prop('disabled',true); $('#edt-tempo-inv').prop('disabled',true); $('#edt-dp-inv').prop('disabled',true); $('#edt-keterangan-inv').prop('disabled',true);
            $('#btn-edit-x-inv').prop('disabled',true); $('#edt-btn-close-inv').prop('disabled',true); $('#edt-btn-submit-inv').prop('disabled',false);
            $('#edt-add-barang').show();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();$('#edt-tgl-inv').prop('disabled',true);
            tabelINVedit(kode);
          } else { $('#edt-bank-inv').prop('disabled',false); $('#edt-tempo-inv').prop('disabled',false); $('#edt-dp-inv').prop('disabled',false); $('#edt-keterangan-inv').prop('disabled',false);
            $('#btn-edit-x-inv').prop('disabled',false); $('#edt-btn-close-inv').prop('disabled',false); $('#edt-btn-submit-inv').prop('disabled',true); $('#edt-tgl-inv').prop('disabled',false);
            $('#edt-add-barang').hide();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();
            $('#tbl_inv_edit').empty();
          }
        });
        //Tambah Barang
          $(document).on('click','#edt-add-barang', function(){
            @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin')
              $('#edt-tambah-hppbarang').show();
            @else
              $('#edt-tambah-hppbarang').hide();
            @endif
            $('#edt-tambah-barang').show();
            document.getElementById("form-edt-tambah-barang").reset();
            var sj = $('#edt-sj-inv').val();
            $('#edt-nama-barang').val(null).trigger('change');
            $('#edt-debit-barang').val(null).trigger('change');
            $('#edt-kredit-barang').val(null).trigger('change');
            $('#edt-tambah-nama-barang').empty();
            $('#edt-tambah-nama-barang').select2({
              placeholder:"Pilih Barang",
                ajax: {
                    url: '{!! url("dropdown-barangsj/'+sj+'") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode_brg+" - "+item.barang,
                                    id: item.kode_brg
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#edt-tambah-gudang-barang').select2({
              placeholder:"Pilih Gudang",
                ajax: {
                    url: '{!! url("dropdown-gudang") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#edt-tambah-debit-barang').select2({
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
            $('#edt-tambah-kredit-barang').select2({
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
            $('#edt-add-barang').hide();
          });
          $('#edt-tambah-gudang-barang').on('change',function(){
            var gudang = $(this).val();
            if(gudang == "BUFFER"){
              $('#edt-tambah-nama-barang').val(99999);
            } else {
              $.ajax({
                url :'{!! url("stock-barang/'+gudang+'") !!}',
                type : 'get',
                data :{
                  barang : $('#edt-tambah-nama-barang').val(),
                },
                success : function(response){
                  // console.log(response);
                  if(response.success == true){
                    $('#edt-tambah-stock-barang').val(response.data);
                    // $('#edt-tambah-diakui-barang').prop('max',response.data);
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: response.pesan
                    })
                  }
                }
              });
            }

          });
          $('#edt-btn-cancel-tambah-barang').on('click',function(e){
            $('#edt-tambah-barang').hide();
            $('#edt-add-barang').show();
          });
          $('#edt-tambah-diakui-barang').keyup(function(){
            var qty = $(this).val();
            var jumlah = $('#edt-tambah-jumlah-barang').val();
            var stock = $('#edt-tambah-stock-barang').val();
            if(qty == null){
              $('#edt-tambah-jumlah-barang').val(formatRupiah(jumlah));
              return false;
            } else {
                if(qty>stock){
                    Toast.fire({
                        icon : "warning",
                        title : "QTY Permintaan melebihi STOCK yang ada",
                    });
                } else {

                }
              var harga = $('#edt-tambah-harga-barang').val();
              $('#edt-tambah-jumlah-barang').val(formatRupiah(qty*harga));
            }
          });
          $('#edt-tambah-nama-barang').on('change',function(e){
            var barang = $(this).val();
            //HPP
            $.ajax({
              type  : 'get',
              url   : '{!! url("hpp-barang/'+barang+'")!!}',
              data  : {
                _token : token,
                tanggal : time,
              },
              success:function(response){
                // console.log(response)
                if(response.success == true) {
                  $('#edt-tambah-hppbarang').val(formatRupiah(response.data));
                  $('#edt-tambah-hpp-barang').val(response.data);
                } else {
                  Toast.fire({
                    icon  :'error',
                    title : response.pesan,
                  });
                }
              }
            });
            //DATA
            var transaksi = $('#edt-so-inv').val();
            $.ajax({
              url     : '{!! url("data-detailsobarang/'+transaksi+'")!!}',
              type    : 'get',
              data    : {
                barang  : barang,
              },
              success : function(response){
                // console.log(response);
                if(response.success == true) {
                  $('#edt-tambah-namareq-barang').val(response.data.nama_request);
                  $('#edt-tambah-hargabarang').val(formatRupiah(response.data.harga));
                  $('#edt-tambah-harga-barang').val(response.data.harga);
                  $('#edt-tambah-satuan-barang').val(response.data.satuan);
                  $('#edt-tambah-diakui-barang').val(response.data.qty);
                  $('#edt-tambah-dikirim-barang').val(response.data.qty);
                  $('#edt-tambah-diterima-barang').val(response.data.qty);
                  $('#edt-tambah-jumlah-barang').val(formatRupiah(response.data.total));
                  $('#edt-tambah-keterangan-barang').val(response.data.keterangan);
                  $('#edt-tambah-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.debit) //set value for option to post it
                          .text(response.data.debit+" - "+response.data.nama_debit )) //set a text for show in select
                      .val(response.data.debit) //select option of select2
                      .trigger("change"); //apply to select2

                  $('#edt-tambah-kredit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kredit) //set value for option to post it
                          .text(response.data.kredit+" - "+response.data.nama_kredit )) //set a text for show in select
                      .val(response.data.kredit) //select option of select2
                      .trigger("change"); //apply to select2

                } else {

                }
              }
            });
          });
          $('#form-edt-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var inv = $('#edt-kode-inv').val();
            $.ajax({
              type  : 'post',
              url: '{!! url("data-detailinv") !!}',
                data : {
                  inv         : $('#edt-kode-inv').val(),
                  _token      : token,
                  barang      : $('#edt-tambah-nama-barang').val(),
                  nama_req    : $('#edt-tambah-namareq-barang').val(),
                  harga       : $('#edt-tambah-harga-barang').val(),
                  hpp         : $('#edt-tambah-hpp-barang').val(),
                  tanggal     : $('#edt-tgl-inv').val(),
                  satuan      : $('#edt-tambah-satuan-barang').val(),
                  diakui      : $('#edt-tambah-diakui-barang').val(),
                  dikirim     : $('#edt-tambah-dikirim-barang').val(),
                  diterima    : $('#edt-tambah-diterima-barang').val(),
                  vat         : $('#edt-tambah-vat-inv').val(),
                  so          : $('#edt-so-inv').val(),
                  gudang      : $('#edt-tambah-gudang-barang').val(),
                  sj          : $('#edt-sj-inv').val(),
                  debit       : $('#edt-tambah-debit-barang').val(),
                  kredit      : $('#edt-tambah-kredit-barang').val(),
                  keterangan  : $('#edt-tambah-keterangan-barang').val(),
                  user : "{{$user->kode_karyawan}}",
                }, // serializes form input
                success:function(response) {
                  // console.log(response);
                  var hasil = response.pesan;
                  if(response.success == true ){
                    Toast.fire({
                      icon: 'success',
                      title: hasil
                    })
                    tabelINVedit(inv);
                    document.getElementById("form-edt-tambah-barang").reset();
                    $('#edt-tambah-barang').hide();
                    $('#edt-add-barang').show();
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title : hasil
                    });
                  }

                }
            });
          });
        //Tambah Barang
        //Edit Barang
          $('body').on('click', '.edtbarang', function () {
            @if($user->level =='superadmin' ||$user->level == 'ceo' || $user->level == 'manager-admin')
              $('#edt-edit-hppbarang').show();
            @else
              $('#edt-edit-hppbarang').hide();
            @endif
            $('#edt-add-barang').hide();
            $('#edt-hapus-barang').hide();
            $('#edt-edit-barang').show();
            var kode = $(this).data('kode');
            // console.log(kode);
            $('#edt-edit-gudang-barang').select2({
              placeholder:"Pilih Gudang",
                ajax: {
                    url: '{!! url("dropdown-gudang") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#edt-edit-kredit-barang').select2({
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
            $('#edt-edit-debit-barang').select2({
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
            $.ajax({
              url :'{!! url("data-detailinv/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true)
                $('#edt-edit-kode').val(kode);
                $('#edt-edit-kode_brg').val(response.data.kode_brg);
                $('#edt-edit-nama-barang').val(response.data.nama);
                $('#edt-edit-namareq-barang').val(response.data.nama_request);
                $('#edt-edit-dikirim-barang').val(response.data.dikirim);
                $('#edt-edit-diakui-barang').val(response.data.diakui);
                $('#edt-edit-diterima-barang').val(response.data.diterima);
                $('#edt-edit-hargabarang').val(formatRupiah(response.data.harga_jual));
                $('#edt-edit-harga-barang').val(response.data.harga_jual);
                $('#edt-edit-satuan-barang').val(response.data.satuan);
                $('#edt-edit-jumlah-barang').val(formatRupiah(response.data.jumlah));
                $('#edt-edit-keterangan-barang').val(response.data.keterangan);
                $('#edt-edit-gudang-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kode_gdg) //set value for option to post it
                        .text(response.data.kode_gdg+" - "+response.data.gudang )) //set a text for show in select
                    .val(response.data.kode_gdg) //select option of select2
                    .trigger("change"); //apply to select2
                $('#edt-edit-debit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.debit) //set value for option to post it
                        .text(response.data.debit+" - "+response.data.nama_debit )) //set a text for show in select
                    .val(response.data.debit) //select option of select2
                    .trigger("change"); //apply to select2

                $('#edt-edit-kredit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kredit) //set value for option to post it
                        .text(response.data.kredit+" - "+response.data.nama_kredit )) //set a text for show in select
                    .val(response.data.kredit) //select option of select2
                    .trigger("change"); //apply to select2

                var barang = response.data.kode_brg;
                $.ajax({
                  type  : 'get',
                  url   : '{!! url("hpp-barang/'+barang+'")!!}',
                  data  : {
                    _token : token,
                    tanggal : time,
                  },
                  success:function(response){
                    // console.log(response)
                    if(response.success == true) {
                        var hpp = response.data;
                        hpp = hpp.toFixed(3);
                        $('#edt-edit-hppbarang').val(formatRupiah(hpp));
                        $('#edt-edit-hpp-barang').val(hpp);
                        // console.log(hpp);
                    } else {
                      Toast.fire({
                        icon  :'error',
                        title : response.pesan,
                      });
                    }
                  }
                });
                var gudang = response.data.kode_gdg;
                //STOK
                $.ajax({
                  url :'{!! url("stock-barang/'+gudang+'") !!}',
                  type : 'get',
                  data :{
                    barang : $('#edt-edit-kode_brg').val(),
                  },
                  success : function(response){
                    // console.log(response);
                    if(response.success == true){
                      $('#edt-edit-stock-barang').val(response.data);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
                // Kode Detail SJ
                $.ajax({
                  type  : 'get',
                  url   : '{!! url("kode-detail-sj") !!}',
                  data  : {
                    sj    : $('#edt-sj-inv').val(),
                    barang : $('#edt-edit-kode_brg').val(),
                    gudang : gudang,
                    qty   : $('#edt-edit-dikirim-barang').val(),
                  },
                  success : function(hasil){
                    // console.log(hasil);
                    if(hasil.success == true){
                      $('#edt-edit-kodesj').val(hasil.data);
                    } else {
                      Toast.fire({
                        icon  : 'error',
                        title : hasil.pesan,
                      });
                    }
                  }
                });
              }
            });
          });
          $('#edt-edit-gudang-barang').on('change',function(){
            var gudang = $(this).val();
            $.ajax({
              url :'{!! url("stock-barang/'+gudang+'") !!}',
              type : 'get',
              data :{
                barang : $('#edt-edit-kode_brg').val(),
              },
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  $('#edt-edit-stock-barang').val(response.data);
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
              }
            });
          });
          $('#edt-edit-diakui-barang').keyup(function(){
            var qty = $(this).val();
            var jumlah = $('#edt-edit-jumlah-barang').val();
            if(qty == null){
              $('#edt-edit-jumlah-barang').val(formatRupiah(jumlah));
              return false;
            } else {
              var harga = $('#edt-edit-harga-barang').val();
              $('#edt-edit-jumlah-barang').val(formatRupiah(qty*harga));
            }
          });
          $('#edt-btn-cancel-edit-barang').on('click',function(){
            $('#edt-edit-barang').hide();
            $('#edt-add-barang').show();
          });
          $('#form-edt-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-edit-kode').val();
            var inv = $('#edt-kode-inv').val();
            $.ajax({
              type: 'put',
              url: '{!! url("data-detailinv/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                nama_req    : $('#edt-edit-namareq-barang').val(),
                diakui      : $('#edt-edit-diakui-barang').val(),
                dikirim     : $('#edt-edit-dikirim-barang').val(),
                diterima    : $('#edt-edit-diterima-barang').val(),
                vat         : $('#edt-vat-inv').val(),
                kodesj      : $('#edt-edit-kodesj').val(),
                hpp         : $('#edt-edit-hpp-barang').val(),
                debit       : $('#edt-edit-debit-barang').val(),
                kredit      : $('#edt-edit-kredit-barang').val(),
                keterangan  : $('#edt-edit-keterangan-barang').val(),
                user : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelINVedit(inv);
                  document.getElementById("form-edt-edit-barang").reset();
                  $('#edt-edit-barang').hide();
                  $('#edt-add-barang').show();
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : hasil
                  });
                }

              }
            });
          });
        //Edit Barang
        //Hapus Barang
          $(document).on('click','.hpsbarang', function(){
            $('#edt-hapus-barang').show();
            $('#edt-add-barang').hide();
            $('#edt-edit-barang').hide();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailinv/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true ){
                  $('#edt-hapus-kode-barang').val(kode);
                  $('#edt-hapus-nama-barang').html(response.data.nama);
                  var barang = response.data.kode_brg;
                  var gudang = response.data.kode_gdg;
                  var qty = response.data.dikirim;
                  // Kode Detail SJ
                  $.ajax({
                    type  : 'get',
                    url   : '{!! url("kode-detail-sj") !!}',
                    data  : {
                      sj    : $('#edt-sj-inv').val(),
                      barang : barang,
                      gudang : gudang,
                      qty   : qty,
                    },
                    success : function(hasil){
                      // console.log(hasil);
                      if(hasil.success == true){
                        $('#edt-hapus-kodesj').val(hasil.data);
                      } else {
                        Toast.fire({
                          icon  : 'error',
                          title : hasil.pesan,
                        });
                      }
                    }
                  });
                } else {
                  Toast.fire({
                    icon    : 'error',
                    title   : response.pesan,
                  });
                }

              }
            });

          });
          $(document).on('click','#edt-btn-cancel-hapus',function(){
            $('#edt-hapus-barang').hide();
            $('#edt-add-barang').show();
          });
          $('#form-edt-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-hapus-kode-barang').val();
            var inv = $('#edt-kode-inv').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailinv/'+kode+'") !!}',
              data : {
                kode        : kode,
                user : "{{$user->kode_karyawan}}",
                kodesj      : $('#edt-hapus-kodesj').val(),
                _token      : token,
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelINVedit(inv);
                  $('#edt-hapus-barang').hide();
                  $('#edt-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }

              }
            });
          });
        //Hapus Barang
        $('#edtinv').submit(function(e){
          var kode  = $('#edt-kode-inv').val();
          e.preventDefault(); // prevent actual form submit
          var el = $('#edt-btn-submit-inv');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          var tempo = $('#edt-tempo-inv').val(); var dp = $('#edt-dp-inv').val(); var keterangan = $('#edt-keterangan-inv').val(); var bank = $('#edt-bank-inv').val();


          if (bank == ''){Toast.fire({icon: 'error',title: 'BANK WAJIB DIISI !!'})
            return false;
          }
          if (tempo == ''){Toast.fire({icon: 'error',title: 'TEMPO WAJIB DIISI !!'})
            return false;
          }
          if (dp == ''){Toast.fire({icon: 'error',title: 'DP WAJIB DIISI ("0" jika tanpa DP)!!'})
            return false;
          }
          if (keterangan == ''){Toast.fire({icon: 'error',title: 'KETERANGAN WAJIB DIISI !!'})
            return false;
          }
          $.ajax({
            type: 'put',
            url: '{!! url("data-inv/'+kode+'") !!}',
            data : {
              kode        : kode,
              tanggal     : $('#edt-tgl-inv').val(),
              _token      : token,
              bank        : $('#edt-bank-inv').val(),
              tempo       : $('#edt-tempo-inv').val(),
              DP          : $('#edt-dp-inv').val(),
              keterangan  : $('#edt-keterangan-inv').val(),
              user : "{{$user->kode_karyawan}}",
            }, // serializes form input
            success:function(response) {
              // console.log(response);
              var hasil = response.pesan;
              if(response.success == true ){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-edit').modal('hide');
                var table = $('#tabel-inv').DataTable();
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
      // Edit Invoice
      // Detail Invoice
        $(document).on('click','.detail',function(){
          var kode = $(this).data('kode');
          $('#dtl-kode-inv').val(kode);
          $('#cetak-inv').attr('href', 'cetak-invoice?kode=' + kode);
          $.ajax({
            url :'{!! url("data-inv/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if(response.success == true) {
                  $('#dtl-perusahaan').val(response.data.inv.perusahaan);
                  $('#dtl-namaperusahaan').val(response.data.inv.namaperusahaan);
                $('#dtl-tgl-inv').val(response.data.inv.tanggal);
                $('#dtl-so-inv').val(response.data.inv.kode_so);
                $('#dtl-bank-inv').val(response.data.inv.bank+" "+response.data.inv.rekening+" "+response.data.inv.atas_nama);
                $('#dtl-vat-inv').val(response.data.inv.vat);
                $('#dtl-sj-inv').val(response.data.inv.kode_sj);
                $('#dtl-tempo-inv').val(response.data.inv.tgl_tempo);
                $('#dtl-dp-inv').val(response.data.inv.DP);
                $('#dtl-po-inv').val(response.data.inv.po_req);
                $('#dtl-marketing-inv').val(response.data.inv.marketing);
                $('#dtl-rekanan-inv').val(response.data.inv.rekanan);
                $('#dtl-keterangan-inv').val(response.data.inv.keterangan);
                $('#dtl-pembayaran-inv').val(response.data.inv.pembayaran);
                if(response.data.inv.status == 'Belum Diperiksa'){
                  $('#detail-nama-pembuat').html(response.data.author.creator.nama);
                  $('#detail-create-pembuat').html(response.data.author.created_at);
                  $('#detail-nama-pemeriksa').html("-");
                  $('#detail-create-pemeriksa').html("-");
                  $('#dtl-btn-submit-inv').show();
                } else if(response.data.inv.status =='Sudah Diperiksa'){
                  $('#detail-nama-pembuat').html(response.data.author.creator.nama);
                  $('#detail-create-pembuat').html(response.data.author.created_at);
                  $('#detail-nama-pemeriksa').html(response.data.author.pemeriksa.nama);
                  $('#detail-create-pemeriksa').html(response.data.author.diperiksa);
                  $('#dtl-btn-submit-inv').hide();
                }
                tabelINVdetail(kode);
              } else {
                Toast.fire({
                  icon  : 'error',
                  title : response.pesan
                })
              }

            }
          });
        });
        $('#dtlinv').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#dtl-btn-submit-inv');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#dtl-kode-inv').val();
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          $.ajax({
            type: 'put',
            url: '{!! url("data-author/'+kode+'") !!}',
            data : {
              kode        : kode,
              _token      : token,
              konfirmator : "{{$user->kode_karyawan}}",
              type        : "inv",
            }, // serializes form input
            success:function(response) {
              // console.log(response);
              var hasil = response.pesan;
              if(response.success == true) {
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-detail').modal('hide');
                var table = $('#tabel-inv').DataTable();
                table.ajax.reload( null, false );
              } else {
                Toast.fire({
                  icon  : 'error',
                  title : hasil
                });
              }
            }
          });
        });
        // $('#cetak-inv').on('click',function(){
        //   var kode = $('#dtl-kode-inv').val();
        //   window.href = 'cetak-invoice?kode='+kode;
        // });
        $('#cetak-inv-hsn').on('click',function(){
          var kode = $('#dtl-kode-inv').val();
          window.href = 'inv-herbivor/'+kode;
        });
      // Detail Invoice
      // Selesai Invoice
        $(document).on('click','.selesai',function(){
          var kode = $(this).data('kode');
          $('#selesai-kode').val(kode);
          $('#kode-selesai').html(kode);
          // console.log(kode);
        });
        $('#form-selesai').submit(function(e){
          e.preventDefault();
          var el = $('#btn-selesai');
          el.prop('disabled',true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#selesai-kode').val();
          $.ajax({
            type  : 'put',
            url   : '{!! url("data-inv-selesai/'+kode+'") !!}',
            data  : {
              _token  : token,
              user : "{{$user->kode_karyawan}}",
            },
            success :function(response){
              // console.log(response)
              var hasil = response.pesan;
              if(response.success == true ){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-selesai').modal('hide');
                var table = $('#tabel-inv').DataTable();
                table.ajax.reload( null, false );
              } else {
                Toast.fire({
                  icon  :'error',
                  title : hasil
                })
              }
            }
          });
        });
      // Selesai Invoice
      // Hapus Invoice
        $(document).on('click','.hapus',function(){
          var kode = $(this).data('kode');
          $('#hapus-kode-inv').val(kode);
          $('#hapus-kode').html(kode);

        });
        $('#form-hapus-inv').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-kode-inv').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-inv/'+kode+'") !!}',
            data    : {
              _token  : token,
              user : "{{$user->kode_karyawan}}",
            },
            success:function(response) {
              // console.log(response);
              var hasil = response.pesan;
              if(response.success == true ){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-hapus').modal('hide');
                var table = $('#tabel-inv').DataTable();
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
      // Hapus Invoice

    //Reclass
        $(document).on('click','.re-belum',function(){
            var data = $(this).data('kode');
            // console.log(data);
            $.ajax({
                type    : 'put',
                url     : '{!! url("reclass-inv/'+data+'") !!}',
                data    : {
                    _token : "{!! csrf_token() !!}",
                    status:"Belum Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-inv').DataTable();
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
            // console.log(data);
            $.ajax({
                type    : 'put',
                url     : '{!! url("reclass-inv/'+data+'") !!}',
                data    : {
                    _token : "{!! csrf_token() !!}",
                    status:"Sudah Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-inv').DataTable();
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

      function tabelINVtambah(kode){
        $.ajax({
          url :'{!! url("data-detailinv/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_inv_tambah').empty();
            var datahandler = $('#tbl_inv_tambah');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                var SJ = $('#tmb-sj-inv').val();
                var SO = $('#tmb-so-inv').val();
                var vat = $('#tmb-vat-inv').val();
                var VAT = (response.data[n]['dpp']*vat)/100;
                sum = sum+response.data[n]['jumlah']
                  var nomor = n+1;
                  var selisih = response.data[n]['dikirim'] - response.data[n]['diakui'] ;
                  const dikirim = response.data[n]['dikirim']*1;
                // dikirim = dikirim.toLocaleString('id-ID');
                const diakui = response.data[n]['diakui']*1;
                // diakui = diakui.toLocaleString('id-ID');
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+SJ+"</td><td>"+response.data[n]['tgl_kirim']+"</td><td>"+response.data[n]['tgl_terima']+"</td><td>"+SO+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+diakui+"</td><td>"+dikirim+"</td><td>"+selisih+"</td><td>"+response.data[n]['satuan']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+formatRupiah(response.data[n]['harga_jual'])+"</td><td>"+vat+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
            var row = $("<tr>");
            row.html("<td colspan='19' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan='5'></td></tr>");
            datahandler.append(row);

          }
        });
      }
      function tabelINVedit(kode){
        $.ajax({
          url :'{!! url("data-detailinv/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_inv_edit').empty();
            var datahandler = $('#tbl_inv_edit');
            var n= 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                var SJ = $('#edt-sj-inv').val();
                var SO = $('#edt-so-inv').val();
                var vat = $('#edt-vat-inv').val();
                var VAT = (response.data[n]['dpp']*vat)/100;
                  var nomor = n+1;
                  var selisih = response.data[n]['dikirim'] - response.data[n]['diakui'] ;
                  const dikirim = response.data[n]['dikirim']*1;
                // dikirim = dikirim.toLocaleString('id-ID');
                const diakui = response.data[n]['diakui']*1;
                // diakui = diakui.toLocaleString('id-ID');
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hpsbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+SJ+"</td><td>"+response.data[n]['tgl_kirim']+"</td><td>"+response.data[n]['tgl_terima']+"</td><td>"+SO+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+diakui+"</td><td>"+dikirim+"</td><td>"+selisih+"</td><td>"+response.data[n]['satuan']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+formatRupiah(response.data[n]['harga_jual'])+"</td><td>"+vat+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
            var row = $("<tr>");
            row.html("<td colspan='19' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan='5'></td></tr>");
            datahandler.append(row);

          }
        });
      }
      function tabelINVdetail(kode){
        $.ajax({
          url :'{!! url("data-detailinv/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_inv_detail').empty();
            var datahandler = $('#tbl_inv_detail');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                var SJ = $('#dtl-sj-inv').val();
                var SO = $('#dtl-so-inv').val();
                var vat = $('#dtl-vat-inv').val();
                var VAT = (response.data[n]['dpp']*vat)/100;
                sum = sum+response.data[n]['jumlah']
                  var nomor = n+1;
                  var selisih = response.data[n]['dikirim'] - response.data[n]['diakui'] ;
                  const dikirim = response.data[n]['dikirim']*1;
                // dikirim = dikirim.toLocaleString('id-ID');
                const diakui = response.data[n]['diakui']*1;
                // const diakui = diakui.toLocaleString('id-ID');
                Nrow.html("<td>"+nomor+"</td><td>"+SJ+"</td><td>"+response.data[n]['tgl_kirim']+"</td><td>"+response.data[n]['tgl_terima']+"</td><td>"+SO+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+diakui+"</td><td>"+dikirim+"</td><td>"+selisih+"</td><td>"+response.data[n]['satuan']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+formatRupiah(response.data[n]['harga_jual'])+"</td><td>"+vat+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
            var row = $("<tr>");
            row.html("<td colspan='18' align='center'>Total</td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan='5'></td></tr>");
            datahandler.append(row);

          }
        });
      }

      function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
      }
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });



    </script>
  </body>
</html>

