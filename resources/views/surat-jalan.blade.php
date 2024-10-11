<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Surat Jalan</title>
  </head>
  @include('layout/head')
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
                <h1>Surat Jalan</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Surat Jalan</li>
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
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah" data-backdrop="static" class="btn bg-gradient-primary">Tambah Surat Jalan</button>
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

                            </div>
                            <div class="col-lg-2">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" id="filter-akhir" required>
                            </div>
                            <div class="col-lg-2">
                                <label>Perusahaan</label>
                                <select class="form-control" id="filter-perusahaan" >
                                    <option value="">Pilih Perusahaan</option>
                                    <option value="npa">CV. Nusa Pratama Anugrah</option>
                                    <option value="herbivor"> PT. Herbivor Satu Nusa</option>
                                    <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                    <option value ="all">Semua</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Konsumen</label>
                                <select id="filter-konsumen" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-lg-2">
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
                                <th>SJ</th>
                                <th>Tanggal</th>
                                <th>SO</th>
                                <th>TGL KIRIM</th>
                                <th>TGL TERIMA</th>
                                <th>EKSPEDISI</th>
                                <th>NOPOL</th>
                                <th>NO RESI</th>
                                <th>Keterangan INV</th>
                                <th>Status</th>
                                <th>KD Barang</th>
                                <th>Barang</th>
                                <th>Satuan</th>
                                <th>Nama Request</th>
                                <th>KD Gudang</th>
                                <th>Gudang</th>
                                <th>QTY</th>
                                <th>Ongkir</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="tabel-sj" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Action</th>
                        <th>No SO</th>
                        <th>Konsumen</th>
                        <th>Barang</th>
                        <th>Tanggal Kirim</th>
                        <th>Tanggal Terima</th>
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
      @include('layout/footer')
      <!-- MODAL -->
      <!-- MODAL Tambah Surat Jalan -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                      <div class="modal-header bg-primary">
                          <h4 class="modal-title">Buat Surat Jalan</h4>
                          <button type="button" id="btn-x-sj" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="card">
                              <div class="card-header">
                                <h3 class="card-title"><b>Data Surat Jalan</b></h3>
                                <div class="card-tools">
                                  <!-- Collapse Button -->
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                              </div>
                              <div class="card-body ">
                                  <div class="row form-group">
                                      <div class="col-lg-2">
                                          <label>Kode SJ</label>
                                      </div>
                                      <div class="col-lg-4">
                                          <input id="tmb-kode-sj" class="form-control" type="text" value=""readonly required>
                                      </div>
                                      <div class="col-lg-2">
                                          <label>Perusahaan</label>
                                      </div>
                                      <div class="col-lg-4">
                                          <select class="form-control" id="tmb-perusahaan-sj" required>
                                              <option value="">Pilih Perusahaan</option>
                                              <option value="npa">CV. Nusa Pratama Anugrah</option>
                                              <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                              <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row form-group">
                                      <div class="col-lg-2">
                                          <label>Tanggal</label>
                                      </div>
                                      <div class="col-lg-4">
                                          <input id="tmb-tgl-sj" class="form-control" type="date" required>
                                      </div>
                                      <div class="col-lg-2">
                                            <label>Tipe </label>
                                      </div>
                                    <div class="col-lg-4">
                                      <select id="tmb-tipe-sj"  class="form-control"  required>
                                        <option value="">Pilih Jenis Surat Jalan</option>
                                        <option value="41">PENJUALAN</option>
                                        <option value="42">PEMAKAIAN</option>
                                        <option value="43">PRODUKSI</option>
                                        <option value="44">PEMINDAHAN</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-4">
                                      <div id="tmb-so">
                                        <label> Nomor Sales Order</label>
                                        <select id="tmb-so-sj"  class="form-control select2 " style="width:100% ;">
                                        </select>
                                        <label>Konsumen</label>
                                        <input type="text" id="tmb-konsumen-sj" hidden>
                                        <input type="text" id="tmb-namakonsumen-sj" class="form-control">
                                        <label>TGL Pengiriman</label>
                                        <input type="date" id="tmb-tglkirim-sj" class="form-control">
                                      </div>
                                      <div id="tmb-pakai">
                                        <label > Keterangan</label>
                                        <textarea  id="tmb-ketpakai-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                      </div>
                                      <div id="tmb-produksi">
                                        <label > Keterangan</label>
                                        <textarea  id="tmb-ketproduksi-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                      </div>
                                      <div id="tmb-pemindahan">
                                        <label > Keterangan</label>
                                        <textarea  id="tmb-ketpemindahan-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                      <div id="tmb-so1">
                                        <label> Kota Tujuan</label>
                                        <input type="text" id="tmb-kota-sj" class="form-control">
                                        <label >Nopol Kendaraan</label>
                                        <input type="text" id="tmb-nopol-sj" class="form-control">
                                        <label> Alamat Pengiriman</label>
                                        <textarea  id="tmb-alamat-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                      <div id="tmb-so2">
                                        <label>Ekspedisi</label>
                                        <input type="text" id="tmb-ekspedisi-sj" class="form-control">
                                        <label >no. Pengiriman</label>
                                        <input type="text" id="tmb-nokirim-sj" class="form-control">
                                        <label>Keterangan</label>
                                        <textarea  id="tmb-keterangan-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input form-control" id="kunci-sj">
                                        <label class="custom-control-label" for="kunci-sj" >Kunci SJ</label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>

                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Data Barang</b></h3>
                                    <div class="card-tools">
                                      <!-- Collapse Button -->
                                      <button id="btn-add-barang" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                    </div>
                                    <div class="row" id="tambah-barang">
                                        <form id="form-tambah-barang">
                                          <div class="row">
                                            <div class="col-lg-4">
                                                <label>Nama Barang</label>
                                                <select id="tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                                <label>Gudang</label>
                                                <select id="tambah-gudang-barang" class="form-control select2" style="width:100% ;" required></select>
                                                <div id="normal">
                                                  <label>Nama Request</label>
                                                  <input id="tambah-namareq-barang" class="form-control" type="text">
                                                </div>


                                            </div>
                                            <div class="col-lg-4">
                                              <div class="row">
                                                <div class="col-lg-6">
                                                  <label>Stock</label>
                                                  <input id="tambah-stock-barang" step=".001" class="form-control" type="number" min="1" required readonly>
                                                  <label> Satuan</label>
                                                  <input id="tambah-satuan-barang" class="form-control" type="text" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                  <label>QTY</label>
                                                  <input id="tambah-qty-barang" step=".001" class="form-control" type="number" min="1" required >
                                                  <label>HPP</label>
                                                  <input id="tambah-hpp-barang" class="form-control" type="text"  readonly >
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-lg-12" id="pemindahan">
                                                    <label>Gudang Tujuan</label>
                                                    <select id="tambah-gudang-tujuan-barang" class="form-control select2" style="width:100% ;"></select>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="col-lg-4">
                                              <label>Keterangan</label>
                                              <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-lg-4">
                                              <label>Kode Akun Debit</label>
                                              <select id="tambah-debit-barang"  class="form-control select2 " readonly style="width: 100%" >
                                              </select>
                                            </div>
                                            <div class="col-lg-4">

                                              <label>Kode Akun Kredit</label>
                                              <select id="tambah-kredit-barang"  class="form-control select2 " readonly  style="width: 100%" >
                                              </select>
                                            </div>
                                            <div class="col-lg-4">
                                              <br>
                                              <div class="row justify-content-between">
                                              <button type="submit" id="btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                    <div class="row" id="edit-barang">
                                        <form id="edit-tambah-barang">
                                          <div class="row">
                                            <div class="col-lg-4">
                                                <label>Gudang</label>
                                                <input type="text" id="edit-kode-barang" hidden>
                                                <input type="text"id="edit-gudang-barang" class="form-control" disabled>
                                                <label>Nama Barang</label>
                                                <input type="text"id="edit-nama-barang" class="form-control" disabled>
                                                <label>Nama Request</label>
                                                <input type="text" id="edit-namareq-barang" class="form-control">
                                            </div>
                                            <div class="col-lg-2">
                                              <label>Stock</label>
                                              <input id="edit-stock-barang" step=".001" class="form-control" type="number" min="1" required readonly>
                                              <label> Satuan</label>
                                              <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                            </div>
                                            <div class="col-lg-2">
                                              <label>QTY</label>
                                              <input id="edit-qty-barang" class="form-control" type="number" min="1" required >
                                              <label>HPP</label>
                                              <input id="edit-hpp-barang" class="form-control" type="text" readonly>
                                            </div>
                                            <div class="col-lg-4">
                                              <label>Keterangan</label>
                                              <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                              <div class="edit-pindahan">
                                                <label>Gudang Tujuan</label>
                                                <select id="edit-gudang-tujuan-barang" class="form-control select2" style="width:100% ;" required></select>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-lg-4">
                                              <label>Kode Akun Debit</label>
                                              <select id="edit-debit-barang"  class="form-control select2 " readonly  style="width: 100%" >
                                              </select>
                                            </div>
                                            <div class="col-lg-4">
                                              <label>Kode Akun Kredit</label>
                                              <select id="edit-kredit-barang"  class="form-control select2 " readonly style="width: 100%" >
                                              </select>
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
                                    <hr>
                                  <table  class="table table-responsive table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th rowspan="2">Action</th>
                                        <th rowspan="2">No.</th>
                                        <th colspan="2">Lokasi Gudang Keluar</th>
                                        <th colspan="4">Barang</th>
                                        <th rowspan="2">QTY</th>
                                        <th rowspan="2">Uraian</th>
                                        <th colspan="2">Kode Akun Debit</th>
                                        <th colspan="2">Kode Akun Kredit</th>
                                      </tr>
                                      <tr>
                                        <td>Kode</td>
                                        <td>Nama</td>
                                        <td>Kode</td>
                                        <td>Nama</td>
                                        <td>Nama Request</td>
                                        <td>Satuan</td>
                                        <td>Kode</td>
                                        <td>Nama Perkiraan</td>
                                        <td>Kode</td>
                                        <td>Nama Perkiraan</td>
                                      </tr>
                                    </thead>
                                    <tbody id="tbl_sj_tambah">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  <form id="tmbsj">
                      <input type="text" id="tmb-time-so" class="form-control" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="btn-close-sj" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-submit-sj"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Surat Jalan -->
      <!-- MODAL Edit Surat jalan -->
        <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header bg-warning">
                      <h4 class="modal-title">Edit Surat Jalan</h4>
                      <button type="button" id="btn-edit-x-sj" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body form-group">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Data Surat Jalan</b></h3>
                                <div class="card-tools">
                                  <!-- Collapse Button -->
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-9">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Kode SJ</label>
                                            <input id="edt-kode-sj" class="form-control" type="text" value=""readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Tipe </label>
                                            <input type="text" id="edt-tipe-sj" class="form-control" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <input type="text" id="edt-perusahaan-sj" class="form-control" disabled >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input type="date" id="edt-tgl-sj" class="form-control" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>TGL Pengiriman</label>
                                            <input type="date" id="edt-tglkirim-sj" class="form-control" >
                                        </div>
                                        <div class="col-lg-4">
                                            <label>TGL Diterima</label>
                                            <input type="date" id="edt-tglditerima-sj" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label class="edt-penjualan"> Nomor Sales Order</label>
                                            <input type="text" id="edt-so-sj" class="form-control edt-penjualan" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="edt-penjualan">Konsumen</label>
                                            <input type="text" id="edt-namakonsumen-sj" class="form-control edt-penjualan" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Ekspedisi</label>
                                            <input type="text" id="edt-ekspedisi-sj" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label >no. Pengiriman</label>
                                            <input type="text" id="edt-nokirim-sj" class="form-control" >
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Kota Tujuan</label>
                                            <input type="text" id="edt-kota-sj" class="form-control" >
                                        </div>
                                        <div class="col-lg-4">
                                            <label >Nopol Kendaraan</label>
                                            <input type="text" id="edt-nopol-sj" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea  id="edt-keterangan-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Alamat Pengiriman</label>
                                            <textarea  id="edt-alamat-sj" class="form-control" row="2" style="resize: none;" ></textarea>
                                        </div>
                                        <div class="col-lg-4">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8"></div>
                                        <div class="col-lg-4 text-right">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input form-control" id="edt-kunci-sj">
                                                <label class="custom-control-label" for="edt-kunci-sj" >Kunci SJ</label>
                                            </div>
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
                        </div>

                    <br>
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Barang</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button id="edt-btn-add-barang" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                            </div>
                            <div class="row" id="edt-tambah-barang">
                              <form id="edt-form-tambah-barang">
                                <div class="row">
                                  <div class="col-lg-4">
                                      <label>Gudang</label>
                                      <select id="edt-tambah-gudang-barang" class="form-control select2" style="width:100% ;" required></select>
                                      <label>Nama Barang</label>
                                      <select id="edt-tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                      <label>Nama Request</label>
                                      <input id="edt-tambah-namareq-barang" class="form-control" type="text">
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Stock</label>
                                    <input id="edt-tambah-stock-barang" step=".001" class="form-control" type="number" min="1" required readonly>
                                    <label> Satuan</label>
                                    <input id="edt-tambah-satuan-barang" class="form-control" type="text" readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>QTY</label>
                                    <input id="edt-tambah-qty-barang" step=".001" class="form-control" type="number" min="1" required >
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Keterangan</label>
                                    <textarea id="edt-tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>

                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Kode Akun Debit</label>
                                    <select id="edt-tambah-debit-barang" readonly class="form-control select2 "  style="width: 100%" >
                                    </select>
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Kode Akun Kredit</label>
                                    <select id="edt-tambah-kredit-barang"  class="form-control select2" readonly style="width: 100%" >
                                    </select>
                                  </div>
                                  <div class="col-lg-4">
                                    <br>
                                    <div class="row justify-content-between">
                                      <button type="submit" id="edt-btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="row" id="edt-edit-barang">
                              <form id="edt-edit-tambah-barang">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Gudang</label>
                                    <input type="text" id="edt-edit-kode-barang" hidden>
                                    <input type="text"id="edt-edit-gudang-barang" class="form-control" disabled>
                                    <label>Nama Barang</label>
                                    <input type="text"id="edt-edit-nama-barang" class="form-control" disabled>
                                    <label>Nama Request</label>
                                    <input id="edt-edit-namareq-barang" class="form-control" type="text">
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Stock</label>
                                    <input id="edt-edit-stock-barang" step=".001" class="form-control" type="number" min="1" required readonly>
                                    <label> Satuan</label>
                                    <input id="edt-edit-satuan-barang" class="form-control" type="text" readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>QTY</label>
                                    <input id="edt-edit-qty-barang" step=".001" class="form-control" type="number" min="1" required >
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Keterangan</label>
                                    <textarea id="edt-edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Kode Akun Debit</label>
                                    <select id="edt-edit-debit-barang"  class="form-control select2 " readonly style="width: 100%" >
                                    </select>
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Kode Akun Kredit</label>
                                    <select id="edt-edit-kredit-barang"  class="form-control select2 " readonly style="width: 100%" >
                                    </select>
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
                              <form id="edt-form-hapus-barang">
                                <input id="edt-hapus-kode-barang" class="form-control" type="text" hidden>
                                <div class="row justify-content-center ">
                                  <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                </div>
                                <div class="row justify-content-center" >
                                  <label class="col-lg-3">Nama Barang </label>
                                  <label id ="edt-hapus-nama-barang" class="col-lg-9"></label>
                                </div>
                                <br>
                                <div class="row justify-content-between ">
                                  <button type="button"  id="edt-btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                  <button type="submit"  id="edt-btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                </div>
                              </form>
                            </div>
                            <hr>
                            <table  class="table table-responsive table-bordered table-striped">
                          <thead>
                          <tr>
                            <th rowspan="2">No.</th>
                            <th colspan="2">Lokasi Gudang Keluar</th>
                            <th colspan="4">Barang</th>
                            <th rowspan="2">QTY</th>
                            <th rowspan="2">Uraian</th>
                            <th colspan="2">Kode Akun Debit</th>
                            <th colspan="2">Kode Akun Kredit</th>
                          </tr>
                          <tr>
                            <td>Kode</td>
                            <td>Nama</td>
                            <td>Kode</td>
                            <td>Nama</td>
                            <td>Nama Request</td>
                            <td>Satuan</td>
                            <td>Kode</td>
                            <td>Nama Perkiraan</td>
                            <td>Kode</td>
                            <td>Nama Perkiraan</td>
                          </tr>
                          </thead>
                          <tbody id="tbl_sj_edit">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <form id="edtsj">
                    <input type="text" id="edt-edit-time-sj" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="edt-btn-close-sj" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="edt-btn-submit-sj"class="col-sm-2 form-control btn btn-warning">Edit</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Edit Sales Order -->
      <!-- MODAL Detail Surat Jalan -->
        <div class="modal fade" id="modal-detail">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header bg-info">
                      <h4 class="modal-title">Detail Surat Jalan</h4>
                      <button type="button" id="btn-detail-x-sj" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Surat Jalan</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-lg-9">
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label>Kode SJ</label>
                                        <input id="detail-kode-sj" class="form-control" type="text" value=""readonly required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tipe </label>
                                        <input type="text" id="detail-tipe-sj" class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Perusahaan</label>
                                        <input type="text" class="form-control" id="detail-perusahaan-sj" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label>Tanggal</label>
                                        <input id="detail-tgl-sj" class="form-control" type="date" disabled required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="penjualan"> Nomor Sales Order</label>
                                        <input type="text" id="detail-so-sj" class="form-control penjualan" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="penjualan">Konsumen</label>
                                        <input type="text" id="detail-namakonsumen-sj" class="form-control penjualan" disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label>TGL Pengiriman</label>
                                        <input type="date" id="detail-tglkirim-sj" class="form-control penjualan" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Ekspedisi</label>
                                        <input type="text" id="detail-ekspedisi-sj" class="form-control penjualan" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label >no. Pengiriman</label>
                                        <input type="text" id="detail-nokirim-sj" class="form-control penjualan" disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label>TGL Diterima</label>
                                        <input type="date" id="detail-tglterima-sj" class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label> Kota Tujuan</label>
                                        <input type="text" id="detail-kota-sj" class="form-control penjualan" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label >Nopol Kendaraan</label>
                                        <input type="text" id="detail-nopol-sj" class="form-control penjualan" disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label>Keterangan</label>
                                        <textarea  id="detail-keterangan-sj" class="form-control" row="2" style="resize: none;" disabled></textarea>
                                    </div>
                                    <div class="col-lg-4">
                                        <label> Alamat Pengiriman</label>
                                        <textarea  id="detail-alamat-sj" class="form-control penjualan" row="2" style="resize: none;" disabled></textarea>
                                    </div>
                                    <div class="col-lg-4">

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
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Barang</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-danger" id="cetak-sj" rel="noopener" target="_blank"><i class="fas fa-print"></i> Print</button>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>

                        </div>
                          <div class="card-body ">
                          <table  class="table table-responsive table-bordered table-striped">
                              <thead>
                              <tr>
                                <th rowspan="2">No.</th>
                                <th colspan="2">Lokasi Gudang Keluar</th>
                                <th colspan="4">Barang</th>
                                <th rowspan="2">QTY</th>
                                <th rowspan="2">Uraian</th>
                                <th colspan="2">Kode Akun Debit</th>
                                <th colspan="2">Kode Akun Kredit</th>
                              </tr>
                              <tr>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Nama Request</td>
                                <td>Satuan</td>
                                <td>Kode</td>
                                <td>Nama Perkiraan</td>
                                <td>Kode</td>
                                <td>Nama Perkiraan</td>
                              </tr>
                              </thead>
                              <tbody id="tbl_sj_detail">
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
                  <form id="dtlsj">
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="btn-detail-close-sj" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-detail-submit-sj"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Detail Surat Jalan-->
      <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data Surat Jalan</h4>
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
      <!-- MODAL Hapus Surat Jalan -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-sj">
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
                                      <input id="hapus-kode-sj" class="form-control" type="text" hidden >
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
      <!--/ Modal Hapus Surat Jalan -->

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
        $('#tabel-sj').DataTable({
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
            ajax: '{!! url("data-sj") !!}',
            columns: [
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'nama',name: 'nama',orderable:true},
                { data: 'barang',name: 'barang',orderable:false},
                { data: 'tgl_kirim', name: 'tgl_kirim',orderable:true},
                { data: 'tgl_diterima', name: 'tgl_diterima',orderable:true},
                { data: 'keterangan', name: 'keterangan',orderable:true},
                { data: 'status', name: 'status',orderable:true},
            ]
        });

      });
      $('.select2').select2();

      $('#cancel-filter').on('click',function(){

          $('#filter').hide();
          $('#tabel-filter').DataTable().clear().destroy();
          $('#tabel-filter').hide();
          $('#tabel-sj').DataTable().clear().destroy();
          $('#tabel-sj').DataTable({
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
                ajax: '{!! url("data-sj") !!}',
                columns: [
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'kode', name: 'kode',orderable:true},
                    { data: 'nama',name: 'nama',orderable:true},
                    { data: 'tgl_kirim', name: 'tgl_kirim',orderable:true},
                    { data: 'tgl_diterima', name: 'tgl_diterima',orderable:true},
                    { data: 'keterangan', name: 'keterangan',orderable:true},
                    { data: 'status', name: 'status',orderable:true},
                ]
            });
            $('#cancel-filter').hide();
            $('#cek-filter').show();
          $('#tabel-sj').show();
      });
      $(document).on('click','#cek-filter',function(){
          $('#tabel-sj').DataTable().clear().destroy();
          document.getElementById("form-filter").reset();
          $('#cek-filter').hide();
          $('#filter-konsumen').empty();
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
            url  : '{!! url("filter-sj")!!}',
            data :{
                awal    :$('#filter-awal').val(),
                akhir   :$('#filter-akhir').val(),
                perusahaan : $('#filter-perusahaan').val(),
                konsumen   :$('#filter-konsumen').val(),
                status  : $('#filter-status').val(),
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#tabel-sj').DataTable().clear().destroy();
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
                        { data: 'SJ', name: 'SJ',orderable:false, searchable:false},
                        { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                        { data: 'so', name: 'so',orderable:false, searchable:false},
                        { data: 'tgl_kirim', name: 'tgl_kirim',orderable:false, searchable:false},
                        { data: 'tgl_terima', name: 'tgl_terima',orderable:false, searchable:false},
                        { data: 'ekspedisi', name: 'ekspedisi',orderable:false, searchable:false},
                        { data: 'nopol', name: 'nopol',orderable:false, searchable:false},
                        { data: 'no_resi', name: 'no_resi',orderable:false, searchable:false},
                        { data: 'KETERANGAN', name: 'KETERANGAN',orderable:false, searchable:false},
                        { data: 'status', name: 'status',orderable:false, searchable:false},
                        { data: 'kd_brg', name: 'kd_brg',orderable:false, searchable:false},
                        { data: 'barang', name: 'barang',orderable:false, searchable:false},
                        { data: 'satuan', name: 'satuan',orderable:false, searchable:false},
                        { data: 'request', name: 'request',orderable:false, searchable:false},
                        { data: 'kd_gdg', name: 'kd_gdg',orderable:false, searchable:false},
                        { data: 'gudang', name: 'gudang',orderable:false, searchable:false},
                        { data: 'qty', name: 'qty',orderable:false, searchable:false},
                        { data: 'ongkir', name: 'ongkir',orderable:false, searchable:false},
                        { data: 'keterangan', name: 'keterangan',orderable:false, searchable:false},
                      ],


                    });
                    $('#tabel-filter').show();
                    $('#tabel-sj').hide();
                } else {
                    Toast.fire({
                        icon    :'error',
                        title   : response.pesan
                    })
                }
            }
        })
      });

      // Tambah SJ
        $(document).on('click','#tambahdata',function(){
          $('#tmb-so').hide(); $('#tmb-so1').hide(); $('#tmb-so2').hide();
          $('#tmb-pakai').hide();$('#tmb-produksi').hide(); $('#tmb-pemindahan').hide();
          $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
          $('#alamatbaru').prop('hidden',false);
          $('#tmb-perusahaan-sj').val("");
          $('#tmb-tgl-sj').val(''); $('#tmb-tipe-sj').val(''); $('#tmb-konsumen-sj').val(''); $('#tmb-namakonsumen-sj').val(''); $('#tmb-nopol-sj').val(''); $('#tmb-ekspedisi-sj').val('');
          $('#tmb-kode-sj').val(''); $('#tmb-so-sj').val(''); $('#tmb-tglkirim-sj').val('');$('#tmb-kota-sj').val(''); $('#tmb-alamat-sj').val(''); $('#tmb-alamatbaru-sj').val('');
          $('#btn-x-sj').prop('disabled',false); $('#btn-close-sj').prop('disabled',false); $('#btn-submit-sj').prop('disabled',true);
          $('#tmb-so-sj').prop('disabled',false); $('#tmb-namakonsumen-sj').prop('disabled',true); $('#tmb-tglkirim-sj').prop('disabled',false); $('#tmb-kota-sj').prop('disabled',false); $('#tmb-ketpakai-sj').prop('disabled',false); $('#tmb-ketproduksi-sj').prop('disabled',false);
          $('#tmb-nopol-sj').prop('disabled',false); $('#tmb-ekspedisi-sj').prop('disabled',false); $('#tmb-nokirim-sj').prop('disabled',false); $('#tmb-keterangan-sj').prop('disabled',false);

        });
        $('#tmb-tipe-sj').on('change',function(){
          var tipe = $(this).val();
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          $('#tmb-tglkirim-sj').val(date);
          if(tipe == 41){
            $('#tmb-so').show(); $('#tmb-so1').show(); $('#tmb-so2').show();
            $('#tmb-pakai').hide();$('#tmb-produksi').hide(); $('#tmb-pemindahan').hide();
            $('#tmb-so-sj').select2({
              placeholder: 'Pilih Sales Order',
              ajax: {
                  url: '{!! url("dropdown-so-sj") !!}',
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

            var tgl = $('#tmb-tgl-sj').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-sj") !!}',
              type    : 'get',
              data    : {
                jenis   : tipe,
                tanggal : n
              },
              success : function(data){
                $('#tmb-kode-sj').val(data);
              }
            });
          } else if( tipe == 42){
            $('#tmb-so').hide(); $('#tmb-so1').hide(); $('#tmb-so2').hide();
            $('#tmb-pakai').show();$('#tmb-produksi').hide(); $('#tmb-pemindahan').hide();
            var tgl = $('#tmb-tgl-sj').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-sj") !!}',
              type    : 'get',
              data    : {
                jenis   : tipe,
                tanggal : n
              },
              success : function(data){
                $('#tmb-kode-sj').val(data);
              }
            });
          } else if(tipe == 43){
            $('#tmb-so').hide(); $('#tmb-so1').hide(); $('#tmb-so2').hide();
            $('#tmb-pakai').hide();$('#tmb-produksi').show(); $('#tmb-pemindahan').hide();
            var tgl = $('#tmb-tgl-sj').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-sj") !!}',
              type    : 'get',
              data    : {
                jenis   : tipe,
                tanggal : n
              },
              success : function(data){
                $('#tmb-kode-sj').val(data);
              }
            });
          } else if(tipe == 44){
            $('#tmb-so').hide(); $('#tmb-so1').hide(); $('#tmb-so2').hide();
            $('#tmb-pakai').hide();$('#tmb-produksi').hide();$('#tmb-pemindahan').show();
            var tgl = $('#tmb-tgl-sj').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-sj") !!}',
              type    : 'get',
              data    : {
                jenis   : tipe,
                tanggal : n
              },
              success : function(data){
                $('#tmb-kode-sj').val(data);
              }
            });
          } else {
            $('#tmb-so').hide(); $('#tmb-so1').hide(); $('#tmb-so2').hide();
            $('#tmb-pakai').hide();$('#tmb-produksi').hide();$('#tmb-pemindahan').hide();
            $('tmb-kode-sj').val('');
          }
        });
        $(document).on('change','#tmb-tgl-sj', function(){

          var tipe = $('#tmb-tipe-sj').val();
          var tgl = $('#tmb-tgl-sj').val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $.ajax({
            url     :'{!! url("lastkode-sj") !!}',
            type    : 'get',
            data    : {
              jenis   : tipe,
              tanggal : n
            },
            success : function(data){
              $('#tmb-kode-sj').val(data);
            }
          });
        });
        $(document).on('change','#tmb-so-sj', function(){
          var so = $(this).val();
          $.ajax({
            url     :'{!! url("data-so/'+so+'/edit") !!}',
            type    : 'get',
            success : function(data){
             // console.log(data);
             $('#tmb-namakonsumen-sj').val(data.so.rekanan);
             $('#tmb-konsumen-sj').val(data.so.konsumen);
             $('#tmb-alamat-sj').val(data.so.alamat);
            }
          });
        });

        $(document).on('change','#kunci-sj', function(){

          var checkBox = document.getElementById("kunci-sj");
          var token = "{!! csrf_token() !!}";
          var kode  = $('#tmb-kode-sj').val();
          var length = kode.length;
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          var tipe = $('#tmb-tipe-sj').val();
          var tgl = $('tmb-tgl-sj').val();
          if (kode == ''||tgl == ''|| length != 15){
            Toast.fire({
              icon: 'error',
              title: 'TANGGAL WAJIB DIISI !!'
            })
            return false;
          }
          if(tipe == 41){
            var so = $('#tmb-so-sj').val(); var konsumen = $('#tmb-namakonsumen-sj').val(); var tglkirim = $('#tmb-tglkirim-sj').val(); var kota = $('#tmb-kota-sj').val(); var per = $('#tmb-perusahaan-sj').val();
            var nopol = $('#tmb-nopol-sj').val(); var alamat = $('#tmb-alamat-sj').val(); var ekspedisi = $('#tmb-ekspedisi-sj').val(); var resi = $('#tmb-nokirim-sj').val(); var ket = $('#tmb-keterangan-sj').val();

            if (so == ''||konsumen ==''||tglkirim == ''||tglkirim == ''||kota == ''||ket == ''||alamat == ''|| per == '' ){
              Toast.fire({
                icon: 'error',
                title: 'SEMUA INPUTAN WAJIB DIISI !!'
              })
              return false;
            } else {
              if(checkBox.checked == true){
                //TURN ON
                $('#tmb-perusahaan-sj').prop('disabled',true);
                $('#btn-x-sj').prop('disabled',true); $('#btn-close-sj').prop('disabled',true); $('#btn-submit-sj').prop('disabled',false);
                $('#tmb-so-sj').prop('disabled',true); $('#tmb-namakonsumen-sj').prop('disabled',true); $('#tmb-tglkirim-sj').prop('disabled',true); $('#tmb-kota-sj').prop('disabled',true);
                $('#tmb-nopol-sj').prop('disabled',true); $('#tmb-alamat-sj').prop('disabled',true); $('#tmb-ekspedisi-sj').prop('disabled',true); $('#tmb-nokirim-sj').prop('disabled',true); $('#tmb-keterangan-sj').prop('disabled',true);
                $('#btn-add-barang').show();
                $('#tbl-sj-tambah').empty();
              } else {
                //TURN OFF
                $('#tmb-perusahaan-sj').prop('disabled',false);
                $('#btn-x-sj').prop('disabled',false); $('#btn-close-sj').prop('disabled',false); $('#btn-submit-sj').prop('disabled',true);
                $('#tmb-so-sj').prop('disabled',false); $('#tmb-namakonsumen-sj').prop('disabled',true); $('#tmb-tglkirim-sj').prop('disabled',false); $('#tmb-kota-sj').prop('disabled',false);
                $('#tmb-nopol-sj').prop('disabled',false); $('#tmb-alamat-sj').prop('disabled',true); $('#tmb-ekspedisi-sj').prop('disabled',false); $('#tmb-nokirim-sj').prop('disabled',false); $('#tmb-keterangan-sj').prop('disabled',false);
                $('#btn-add-barang').hide();
                $('#tambah-barang').hide();
                $('#edit-barang').hide();
                $('#hapus-barang').hide();
                $('#tbl-sj-tambah').empty();
                $.ajax({
                  type  :'delete',
                  url: '{!! url("hps-detail-sj/'+kode+'") !!}',
                  data :{
                    _token : token,
                    user : "{{$user->kode_karyawan}}",
                  },
                  success:function(response){
                    if (response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      tabelSJtambah(kode);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
              }
            }
          } else if (tipe == 42){
            var ket = $('#tmb-ketpakai-sj').val();
            if(ket ==''){
              Toast.fire({
                icon: 'error',
                title: 'KETERANGAN WAJIB DIISI !!'
              })
              return false;
            } else {
              if(checkBox.checked == true){
                //TURN ON
                $('#btn-x-sj').prop('disabled',true); $('#btn-close-sj').prop('disabled',true); $('#btn-submit-sj').prop('disabled',false);
                $('#tmb-tipe-sj').prop('disabled',true);$('#tmb-tgl-sj').prop('disabled',true);$('#tmb-ketpakai-sj').prop('disabled',true);
                $('#btn-add-barang').show();
                $('#tbl-sj-tambah').empty();
              } else {
                //TURN OFF
                $('#tmb-tipe-sj').prop('disabled',false);$('#tmb-tgl-sj').prop('disabled',false);$('#tmb-ketpakai-sj').prop('disabled',false);
                $('#btn-x-sj').prop('disabled',false);$('#btn-close-sj').prop('disabled',false);$('#btn-submit-sj').prop('disabled',true);
                $('#btn-add-barang').hide();
                $('#tambah-barang').hide();
                $('#edit-barang').hide();
                $('#hapus-barang').hide();
                $('#tbl-sj-tambah').empty();
                $.ajax({
                  type  :'delete',
                  url: '{!! url("hps-detail-sj/'+kode+'") !!}',
                  data :{
                    _token : token,
                    user : "{{$user->kode_karyawan}}",
                  },
                  success:function(response){
                    if (response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      tabelSJtambah(kode);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
              }
            }
          } else if (tipe == 43){
            var ket = $('#tmb-ketproduksi-sj').val();
            if(ket==''){
              Toast.fire({
                icon: 'error',
                title: 'KETERANGAN WAJIB DIISI !!'
              })
            } else {
              if(checkBox.checked == true){
                //TURN ON
                $('#tmb-tipe-sj').prop('disabled',true);$('#tmb-tgl-sj').prop('disabled',true);$('#tmb-ketprpduksi-sj').prop('disabled',true);
                $('#btn-x-sj').prop('disabled',true);$('#btn-close-sj').prop('disabled',true);$('#btn-submit-sj').prop('disabled',false);
                $('#btn-add-barang').show();
                $('#tbl-sj-tambah').empty();
              } else {
                //TURN OFF
                $('#tmb-tipe-sj').prop('disabled',false);$('#tmb-tgl-sj').prop('disabled',false);$('#tmb-ketproduksi-sj').prop('disabled',false);
                $('#btn-x-sj').prop('disabled',false);$('#btn-close-sj').prop('disabled',false);$('#btn-submit-sj').prop('disabled',true);
                $('#btn-add-barang').hide();
                $('#tambah-barang').hide();
                $('#edit-barang').hide();
                $('#hapus-barang').hide();
                $('#tbl-sj-tambah').empty();
                $.ajax({
                  type  :'delete',
                  url: '{!! url("hps-detail-sj/'+kode+'") !!}',
                  data :{
                    _token : token,
                    user : "{{$user->kode_karyawan}}",
                  },
                  success:function(response){
                    if (response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      tabelSJtambah(kode);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
              }
            }
          } else if (tipe == 44) {
            var ket = $('#tmb-ketpemindahan-sj').val();
            if(ket==''){
              Toast.fire({
                icon: 'error',
                title: 'KETERANGAN WAJIB DIISI !!'
              })
            } else {
              if(checkBox.checked == true){
                //TURN ON
                $('#tmb-tipe-sj').prop('disabled',true);$('#tmb-tgl-sj').prop('disabled',true);$('#tmb-ketpemindahan-sj').prop('disabled',true);
                $('#btn-x-sj').prop('disabled',true);$('#btn-close-sj').prop('disabled',true);$('#btn-submit-sj').prop('disabled',false);
                $('#btn-add-barang').show();
                $('#tbl-sj-tambah').empty();
              } else {
                //TURN OFF
                $('#tmb-tipe-sj').prop('disabled',false);$('#tmb-tgl-sj').prop('disabled',false);$('#tmb-ketpemindahan-sj').prop('disabled',false);
                $('#btn-x-sj').prop('disabled',false);$('#btn-close-sj').prop('disabled',false);$('#btn-submit-sj').prop('disabled',true);
                $('#btn-add-barang').hide();
                $('#tambah-barang').hide();
                $('#edit-barang').hide();
                $('#hapus-barang').hide();
                $('#tbl-sj-tambah').empty();
                $.ajax({
                  type  :'delete',
                  url: '{!! url("hps-detail-sj/'+kode+'") !!}',
                  data :{
                    _token : token,
                    user : "{{$user->kode_karyawan}}",
                  },
                  success:function(response){
                    if (response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      tabelSJtambah(kode);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
              }
            }
          } else {
            Toast.fire({
              icon: 'error',
              title: 'Pilih Tipe Surat Jalan !!'
            })
            checkBox.prop('checked',false);
            return false;
          }
        });
        //Tambah Barang
          $(document).on('click','#btn-add-barang', function(){
            @if($user->level == 'superadmin' || $user->level == 'ceo')
              $('#tambah-hpp-barang').show();
            @else
              $('#tambah-hpp-barang').hide();
            @endif
            $('#tambah-barang').show();
            $('#btn-add-barang').hide();
            $('#pemindahan').hide();
            document.getElementById("form-tambah-barang").reset();
            $('#tambah-gudang-barang').empty();
            $('#tambah-nama-barang').empty();
            var tipe = $('#tmb-tipe-sj').val();
            if (tipe == 41){
              var so = $('#tmb-so-sj').val();
              $('#pemindahan').hide();$('#normal').show();
              $('#tambah-nama-barang').select2({
                placeholder: 'Pilih Barang',
                ajax: {
                    url: '{!! url("dropdown-barangso/'+so+'") !!}',
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
            } else if (tipe == 42) {
                $('#pemindahan').hide(); $('#normal').show();
              $('#tambah-nama-barang').select2({
                placeholder: 'Pilih Barang',
                ajax: {
                    url: '{!! url("dropdown-barang") !!}',
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
                $('#tambah-debit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(640.2) //set value for option to post it
                        .text("640.2 Beban Sample, Seilih Timbang dan Barang Rusak")) //set a text for show in select
                    .val("640.2") //select option of select2
                    .trigger("change"); //apply to select2
            } else if(tipe == 43) {
                $('#pemindahan').hide(); $('#normal').show();
              $('#tambah-nama-barang').select2({
                placeholder: 'Pilih Barang',
                ajax: {
                    url: '{!! url("dropdown-barang") !!}',
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
                $('#tambah-debit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(640.3) //set value for option to post it
                        .text("640.3 Beban Produksi")) //set a text for show in select
                    .val("640.3") //select option of select2
                    .trigger("change"); //apply to select2
            } else if(tipe == 44){
              $('#normal').hide(); $('#pemindahan').show();
              $('#tambah-nama-barang').select2({
                placeholder: 'Pilih Barang',
                ajax: {
                    url: '{!! url("dropdown-barang") !!}',
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
              $('#tambah-gudang-tujuan-barang').select2({
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
            } else {

            }
          });

          $('#tambah-nama-barang').on('change', function (){
            var barang = $(this).val();
            $('#tambah-gudang-barang').empty();
            var so = $('#tmb-so-sj').val();
            var tipe = $('#tmb-tipe-sj').val();
            var barang = $(this).val();
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            $.ajax({
              type  : 'get',
              url   : '{!! url("hpp-barang/'+barang+'")!!}',
              data  : {
                tanggal : time,
              },
              success:function(response){
                // console.log(response)
                if(response.success == true) {
                  $('#tambah-hpp-barang').val(response.data);
                } else {
                  Toast.fire({
                    icon  :'error',
                    title : response.pesan,
                  });
                }
              }
            });
            if( tipe == 41){
                $('#tambah-qty-barang').prop('disabled',true);
              $.ajax({
                url :'{!! url("data-detailsobarang/'+so+'") !!}',
                type : 'get',
                data  :{
                  barang : barang,
                },
                success : function(data){
                   console.log(data);
                  if(data.success == true){
                    $('#tambah-namareq-barang').val(data.data.nama_request);
                    $('#tambah-satuan-barang').val(data.data.satuan);
                    $('#tambah-qty-barang').val(data.data.qty);
                    $('#tambah-keterangan-barang').val(data.data.keterangan);
                    $('#tambah-debit-barang').empty()
                      .append($("<option/>")
                        .val("410")
                        .text("410 Harga Pokok Penjualan"))
                      .val("410")
                      .trigger("change");
                    $.ajax({
                        url   :'{!! url("data-barang/'+barang+'/edit") !!}',
                        get   : 'get',
                        success : function(barang){
                            $('#tambah-kredit-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(barang.akuntansi.kode) //set value for option to post it
                                .text(barang.akuntansi.kode +" "+barang.akuntansi.nama_perkiraan )) //set a text for show in select
                            .val(barang.akuntansi.kode) //select option of select2
                            .trigger("change"); //apply to select2
                        }
                    })
                  } else {
                    Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                  }
                }
              });
            } else {
                $('#tambah-qty-barang').prop('disabled',false);
              $.ajax({
                url   :'{!! url("data-barang/'+barang+'/edit") !!}',
                get   : 'get',
                success : function(data){
                  // console.log(data);
                  $('#tambah-satuan-barang').val(data.result.satuan);
                  if(tipe == 42){
                      $('#tambah-debit-barang').empty()
                      .append($("<option/>"))
                        .val(401)
                        .text('Free Sample/Penjualan Free')
                      .val(401)
                      .trigger("change");
                  } else if (tipe == 43) {

                      $('#tambah-debit-barang').empty()
                      .append($("<option/>"))
                        .val(640.3)
                        .text('Beban Produksi')
                      .val(640.3)
                      .trigger("change");
                  }
                  $('#tambah-kredit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(data.akuntansi.kode) //set value for option to post it
                        .text(data.akuntansi.kode +" "+data.akuntansi.nama_perkiraan )) //set a text for show in select
                    .val(data.akuntansi.kode) //select option of select2
                    .trigger("change"); //apply to select2
                }
              });
            }
            //SATUAN

            //GUDANG
            $('#tambah-gudang-barang').select2({
              placeholder: 'Pilih Gudang',
              ajax: {
                  url: '{!! url("gudangbarang/'+barang+'") !!}',
                  dataType: 'json',
                  processResults: function (data) {
                      // console.log(data);
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nama_gdg,
                                  id: item.kode_gdg
                              }
                          })
                      };
                  },
                  cache: true
              }
            })

            //STOK

          });
          $('#tambah-qty-barang').keyup(function(){
            var QTY = $(this).val();
            var STOK = $('#tambah-stock-barang').val();
            if(QTY > STOK){
                Toast.fire({
                    icon    : 'error',
                    title   : " QTY barang melebihi Stok yang ada"
                });
            } else {
                Toast.fire({
                    icon    : 'success',
                    title   : " Sesuai"
                });
            }
          });
          $(document).on('change','#tambah-gudang-barang', function(){
            var gudang = $(this).val();
            // console.log(gudang);
            var barang = $('#tambah-nama-barang').val();

            $.ajax({
              url :'{!! url("stock-barang/'+gudang+'") !!}',
              type : 'get',
              data :{
                barang : $('#tambah-nama-barang').val(),
              },
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  $('#tambah-stock-barang').val(response.data);
                  if(gudang == 'BUFFER'){

                  } else {
                    $('#tambah-qty-barang').prop('max',response.data);
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


          $('#form-tambah-barang').submit(function(e){
            var qty = $('#tambah-qty-barang').val();
            var stock = $('#tambah-stock-barang').val();
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var sj = $('#tmb-kode-sj').val();
            var tipe = sj.substr(3,2);
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            if($('#tambah-qty-barang').val() > $('#tambah-stock-barang').val() ){
                Toast.fire({
                    icon    : "error",
                    title   : "QTY Melebihi Stock yang ada !!",
                });
                return false;
            } else {

            }
            if(tipe == 41){
              $.ajax({
                type  : 'post',
                url   : '{!! url("data-detailsj") !!}',
                data  : {
                  sj          : sj,
                  barang      : $('#tambah-nama-barang').val(),
                  nama        : $('#tambah-namareq-barang').val(),
                  _token      : "{{ csrf_token() }}",
                  perusahaan  : $('#tmb-perusahaan-sj').val(),
                  gudang      : $('#tambah-gudang-barang').val(),
                  stock       : stock,
                  so          : $('#tmb-so-sj').val(),
                  qty         : $('#tambah-qty-barang').val(),
                  keterangan  : $('#tambah-keterangan-barang').val(),
                  debit       : $('#tambah-debit-barang').val(),
                  kredit      : $('#tambah-kredit-barang').val(),
                  time        : time
                }, // serializes form input
                success:function(response) {
                  // console.log(response);
                  var hasil = response.pesan;
                  if(response.success == true){
                    Toast.fire({
                      icon: 'success',
                      title: hasil
                    })
                    tabelSJtambah(sj);
                    document.getElementById("form-tambah-barang").reset();
                    $('#tambah-barang').hide();
                    $('#btn-add-barang').show();
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: hasil
                    })
                  }

                }
              });
            } else {
              $.ajax({
                type    : 'post',
                url     : '{!! url("data-detailsj")!!}',
                data    : {
                  sj          : sj,
                  barang      : $('#tambah-nama-barang').val(),
                  nama        : $('#tambah-namareq-barang').val(),
                  _token      : token,
                  gudang      : $('#tambah-gudang-barang').val(),
                  stock       : stock,
                  perusahaan  : $('#tmb-perusahaan-sj').val(),
                  qty         : $('#tambah-qty-barang').val(),
                  hpp         : $('#tambah-hpp-barang').val(),
                  keterangan  : $('#tambah-keterangan-barang').val(),
                  debit       : $('#tambah-debit-barang').val(),
                  kredit      : $('#tambah-kredit-barang').val(),
                },
                success : function(response){
                  if(response.success == true){
                    Toast.fire({
                      icon  : 'success',
                      title : response.pesan
                    });
                    tabelSJtambah(sj);
                    document.getElementById("form-tambah-barang").reset();
                    $('#tambah-barang').hide();
                    $('#btn-add-barang').show();

                  } else {
                    Toast.fire({
                      icon  : 'error',
                      title : response.pesan,
                    });
                  }
                }

              });
            }

          });
        //Tambah Barang
        //Edit Barang
          $('body').on('click', '.editbarang', function () {
            @if($user->level == 'superadmin' || $user->level == 'ceo')
              $('#edit-hpp-barang').show();
            @else
              $('#edit-hpp-barang').hide();
            @endif
            $('#edit-barang').show();
            $('#tambah-barang').hide();
            $('#btn-add-barang').hide();
            $('#hapus-barang').hide();
            $('#edit-debit-barang').select2({
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
            $('#edit-kredit-barang').select2({
              placeholder:"Pilih Kode Kredit",
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
            var kode = $(this).data('kode');
            // console.log(kode);
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            $.ajax({
              url :'{!! url("data-detailsj/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  $('#edit-kode-barang').val(kode);
                  $('#edit-gudang-barang').val(response.data.gudang);
                  $('#edit-nama-barang').val(response.data.nama);
                  $('#edit-namareq-barang').val(response.data.nama_request);
                  $('#edit-qty-barang').val(response.data.qty);
                  $('#edit-stock-barang').val(response.data.stock);
                  $('#edit-satuan-barang').val(response.data.satuan);
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

                  $.ajax({
                    type  : 'get',
                    url   : '{!! url("hpp-barang/'+response.data.kode_brg+'")!!}',
                    data  : {
                      _token : token,
                      tanggal : time,
                    },
                    success:function(response){
                      // console.log(response)
                      if(response.success == true) {
                        $('#edit-hpp-barang').val(response.data);
                      } else {
                        Toast.fire({
                          icon  :'error',
                          title : response.pesan,
                        });
                      }
                    }
                  });
                  var tipe = $('tmb-tipe-sj').val();

                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }

              }
            });
          });
          $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            $('#btn-add-barang').show();
          });
          $('#edit-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edit-kode-barang').val();
            var sj = $('#tmb-kode-sj').val();

            $.ajax({
              type: 'put',
              url: '{!! url("data-detailsj/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                nama        : $('#edit-namareq-barang').val(),
                qty         : $('#edit-qty-barang').val(),
                hpp         : $('#edit-hpp-barang').val(),
                keterangan  : $('#edit-keterangan-barang').val(),
                debit       : $('#edit-debit-barang').val(),
                kredit      : $('#edit-kredit-barang').val(),
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
                  tabelSJtambah(sj);
                  document.getElementById("edit-tambah-barang").reset();
                  $('#edit-barang').hide();
                  $('#btn-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
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
            $('#btn-add-barang').hide();
            $('#hapus-barang').show();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailsj/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true) {
                  $('#hapus-kode-barang').val(kode);
                  $('#hapus-nama-barang').html(response.data.nama);
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }

              }
            });
          });
          $('#btn-cancel-hapus').on('click', function(){
            $('#hapus-barang').hide();
            $('#btn-add-barang').show();
          });
          $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#hapus-kode-barang').val();
            var sj = $('#tmb-kode-sj').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailsj/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
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
                  tabelSJtambah(sj);
                  $('#hapus-barang').hide();
                  $('#btn-add-barang').show();
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
        $('#tmbsj').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-submit-sj');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#tmb-kode-sj').val();
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          var tipe = kode.substr(3,2);

          $.ajax({
            type: 'post',
            url: '{!! url("data-sj") !!}',
            data : {
              tipe        : $('#tmb-tipe-sj').val(),
              kode        : kode,
              perusahaan  : $('#tmb-perusahaan-sj').val(),
              tanggal     : $('#tmb-tgl-sj').val(),
              _token      : token,
              so          : $('#tmb-so-sj').val(),
              alamat      : $('#tmb-alamat-sj').val(),
              tgl_kirim   : $('#tmb-tglkirim-sj').val(),
              konsumen    : $('#tmb-konsumen-sj').val(),
              kota        : $('#tmb-kota-sj').val(),
              nopol       : $('#tmb-nopol-sj').val(),
              ekspedisi   : $('#tmb-ekspedisi-sj').val(),
              resi        : $('#tmb-nokirim-so').val(),
              keterangan  : $('#tmb-keterangan-sj').val(),
              ketpakai    : $('#tmb-ketpakai-sj').val(),
              ketproduksi : $('#tmb-ketproduksi-sj').val(),
              ketpemindahan : $('#tmb-ketpemindahan-sj').val(),
              time        : time,
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
                var table = $('#tabel-sj').DataTable();
                table.ajax.reload( null, false );
              } else {
                var hasil = response;
                Toast.fire({
                  icon: 'error',
                  title: hasil
                })
              }
            }
          });
        });
      // Tambah SJ
      // Edit SJ
        $(document).on('click','.edit',function(){
          var kode = $(this).data('kode');
          $('#edt-kunci-sj').prop('checked',false);
          $('#edt-kode-sj').val(kode);
          $('#edt-btn-submit-sj').prop('disabled',true);
          $('#edt-tglkirim-sj').prop('disabled',false); $('#edt-kota-sj').prop('disabled',false); $('#edt-alamat-sj').prop('disabled',false); $('#edt-ekspedisi-sj').prop('disabled',false);
          $('#edt-tglditerima-sj').prop('disabled',false); $('#edt-nopol-sj').prop('disabled',false); $('#edt-alamat-sj').prop('disabled',false); $('#edt-nokirim,-sj').prop('disabled',false);$('#edt-keterangan-sj').prop('disabled',false);
          $('#edt-ketpakai-sj').prop('disabled',false);
          $('#edt-ketproduksi-sj').prop('disabled',false);
          $('#edt-btn-close-sj').prop('disabled',false);
          $('#edt-btn-submit-sj').prop('disabled',true);
          $('#btn-edit-x-sj').prop('disabled',false);
          $('#edt-btn-add-barang').hide();
          $('#edt-tambah-barang').hide();
          $('#edt-edit-barang').hide();
          $('#edt-hapus-barang').hide();
          $('#tbl_sj_edit').empty();
          $('#edt-so').hide();$('#edt-pakai').hide();$('#edt-produksi').hide();$('#edt-so1').hide();$('#edt-so2').hide();
          $.ajax({
            url :'{!! url("data-sj/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
               console.log(response);
              if(response.success == true){
                var tipe = kode.substr(3,2);
                $('#edt-perusahaan-sj').val(response.data.sj.namaperusahaan);
                var perusahaan = response.data.sj.perusahaan;
                $('#edt-tgl-sj').val(response.data.sj.tanggal);
                $('#edt-tglditerima-sj').val(response.data.sj.tgl_diterima);
                if(tipe == 41 ){
                  $('#edt-tipe-sj').val('PENJUALAN');
                  $('#edt-so-sj').val(response.data.sj.so);
                  $('#edt-namakonsumen-sj').val(response.data.sj.nama);
                  $('#edt-tglkirim-sj').val(response.data.sj.tgl_kirim);
                  $('#edt-tglditerima-sj').val(response.data.sj.tgl_diterima);
                  $('#edt-kota-sj').val(response.data.sj.kota);
                  $('#edt-nopol-sj').val(response.data.sj.nopol);
                  $('#edt-alamat-sj').val(response.data.sj.alamat);
                  $('#edt-ekspedisi-sj').val(response.data.sj.ekspedisi);
                  $('#edt-nokirim-sj').val(response.data.sj.resi);
                  $('#edt-keterangan-sj').val(response.data.sj.keterangan);
                  $('#edt-so').show();$('#edt-so1').show();$('#edt-so2').show();
                } else if(tipe == 42){
                  $('#edt-tipe-sj').val('PEMAKAIAN');
                  $('#edt-ketpakai-sj').val(response.data.sj.keterangan);
                  $('#edt-tglditerima-sj').val(response.data.sj.tgl_diterima);
                  $('#edt-pakai').show();
                } else if(tipe == 43){
                  $('#edt-tipe-sj').val('PRODUKSI');
                  $('#edt-ketproduksi-sj').val(response.data.sj.keterangan);
                  $('#edt-tglditerima-sj').val(response.data.sj.tgl_diterima);
                  $('#edt-produksi').show();
                } else {
                  $('#edt-tipe-sj').val('');
                }
                if(response.data.sj.status == 'Belum Diperiksa'){
                  $('#edit-nama-pembuat').html(response.data.author.creator.nama);
                  $('#edit-create-pembuat').html(response.data.author.created_at);
                  $('#edit-nama-pemeriksa').html("-");
                  $('#edit-create-pemeriksa').html("-");
                } else {
                  $('#edit-nama-pembuat').html(response.data.author.creator.nama);
                  $('#edit-create-pembuat').html(response.data.author.created_at);
                  $('#edit-nama-pemeriksa').html(response.data.author.pemeriksa.nama);
                  $('#edit-create-pemeriksa').html(response.data.author.diperiksa);
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
        $('#edt-kunci-sj').on('click',function(){
          var kode = $('#edt-kode-sj').val();
          var tipe = kode.substr(3,2);
          var checkBox = document.getElementById("edt-kunci-sj");
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          $('#edt-edit-time-sj').val(time);
          if(checkBox.checked == true){
            if (tipe == 41){
              $('#edt-tglkirim-sj').prop('disabled',true); $('#edt-kota-sj').prop('disabled',true); $('#edt-alamat-sj').prop('disabled',true); $('#edt-ekspedisi-sj').prop('disabled',true);
              $('#edt-tglditerima-sj').prop('disabled',true); $('#edt-nopol-sj').prop('disabled',true); $('#edt-alamat-sj').prop('disabled',true); $('#edt-nokirim,-sj').prop('disabled',true);$('#edt-keterangan-sj').prop('disabled',true);
            } else {
              $('#edt-ketpakai-sj').prop('disabled',true);
              $('#edt-ketproduksi-sj').prop('disabled',true);
              $('#edt-tglditerima-sj').prop('disabled',true);
            }
            $('#edt-btn-add-barang').show();
            $('#edt-btn-close-sj').prop('disabled',true);
            $('#edt-btn-submit-sj').prop('disabled',false);
            $('#btn-edit-x-sj').prop('disabled',true);
            tabelSJedit(kode);
          } else {
            if (tipe == 41){
              $('#edt-tglkirim-sj').prop('disabled',false); $('#edt-kota-sj').prop('disabled',false); $('#edt-alamat-sj').prop('disabled',false); $('#edt-ekspedisi-sj').prop('disabled',false);
              $('#edt-tglditerima-sj').prop('disabled',false); $('#edt-nopol-sj').prop('disabled',false); $('#edt-alamat-sj').prop('disabled',false); $('#edt-nokirim,-sj').prop('disabled',false);$('#edt-keterangan-sj').prop('disabled',false);
            } else {
              $('#edt-ketpakai-sj').prop('disabled',false);
              $('#edt-ketproduksi-sj').prop('disabled',false);
              $('#edt-tglditerima-sj').prop('disabled',false);
            }
            $('#edt-btn-add-barang').hide();
            $('#edt-tambah-barang').hide();
            $('#edt-edit-barang').hide();
            $('#edt-hapus-barang').hide();
            $('#edt-btn-close-sj').prop('disabled',false);
            $('#edt-btn-submit-sj').prop('disabled',true);
            $('#btn-edit-x-sj').prop('disabled',false);
            $('#tbl_sj_edit').empty();

            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            var token = "{!! csrf_token() !!}";
            $.ajax({
              type      : 'get',
              url       : '{!! url("hps-edt-detail-sj/'+kode+'") !!}',
              data      : {
                _token    : token,
                start     : $('#edt-edit-time-sj').val(),
                end     : time,
              },
              success:function(response){
                // console.log(response);
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: response.pesan
                  })
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
              }
            })
          }
        });
        //Tambah Barang
          $(document).on('click','#edt-btn-add-barang', function(){
            $('#edt-tambah-barang').show();
            $('#edt-btn-add-barang').hide();
            $('#edt-tambah-gudang-barang').empty();
            $('#edt-tambah-nama-barang').empty();
            $('#edt-tambah-gudang-barang').select2({
              placeholder: 'Pilih Gudang',
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
            var so = $('#edt-so-sj') .val();
            $('#edt-tambah-nama-barang').select2({
              placeholder: 'Pilih Barang',
              ajax: {
                  url: '{!! url("dropdown-barangso/'+so+'") !!}',
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
            $('#edt-tambah-debit-barang').select2({
              placeholder:"Pilih Kode Debit",
              ajax: {
                  url: '{!! url("dropdown-akundebit") !!}',
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
              placeholder:"Pilih Kode Kredit",
              ajax: {
                  url: '{!! url("dropdown-akunkredit") !!}',
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
          $(document).on('change','#edt-tambah-gudang-barang', function(){
            var gudang = $(this).val();
            $('#edt-tambah-nama-barang').empty();
            $('#edt-tambah-nama-barang').select2({
              placeholder: 'Pilih Barang',
              ajax: {
                  url: '{!! url("dropdown-barangmr/'+gudang+'") !!}',
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
          $('#edt-tambah-nama-barang').on('change', function (){
            var barang = $(this).val();
            //SATUAN
            $.ajax({
              url :'{!! url("data-barang/'+barang+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                $('#edt-tambah-satuan-barang').val(response.result.satuan);
              }
            });
            //STOK
            var gudang = $('#edt-tambah-gudang-barang').val();
            $.ajax({
              url :'{!! url("stock-barangmr/'+gudang+'") !!}',
              type : 'get',
              data :{
                barang : barang,
              },
              success : function(response){
                // console.log(response);
                if (response.success == true){
                  $('#edt-tambah-stock-barang').val(response.data);
                  $('#edt-tambah-qty-barang').prop('max',response.data);
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
              }
            });
          });
          $('#edt-form-tambah-barang').submit(function(e){
            var qty = $('#edt-tambah-qty-barang').val();
            var stock = $('#edt-tambah-stock-barang').val();
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var sj = $('#edt-kode-sj').val();
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            $.ajax({
              type: 'post',
              url: '{!! url("data-detailsj") !!}',
              data : {
                sj          : sj,
                barang      : $('#edt-tambah-nama-barang').val(),
                nama        : $('#edt-tambah-namareq-barang').val(),
                _token      : token,
                gudang      : $('#edt-tambah-gudang-barang').val(),
                perusahaan  : perusahaan,
                stock       : stock,
                so          : $('#edt-so-sj').val(),
                qty         : $('#edt-tambah-qty-barang').val(),
                keterangan  : $('#edt-tambah-keterangan-barang').val(),
                user        : "{{$user->kode_karyawan}}",
                debit       : $('#edt-tambah-debit-barang').val(),
                kredit      : $('#edt-tambah-kredit-barang').val(),
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                if(response.success == true){
                  var hasil = response.pesan;
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSJedit(sj);
                  document.getElementById("edt-form-tambah-barang").reset();
                  $('#edt-tambah-barang').hide();
                  $('#edt-btn-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
              }
            });
          });
        //Tambah Barang
        //Edit Barang
          $(document).on('click','.edtbarang',function(){
            $('#edt-edit-barang').show();
            $('#edt-tambah-barang').hide();
            $('#edt-hapus-barang').hide();
            $('#edt-btn-add-barang').hide();
            var kode = $(this).data('kode');
            // console.log(kode);
            $.ajax({
              url :'{!! url("data-detailsj/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  $('#edt-edit-kode-barang').val(kode);
                  $('#edt-edit-gudang-barang').val(response.data.gudang);
                  $('#edt-edit-nama-barang').val(response.data.nama);
                  $('#edt-edit-namareq-barang').val(response.data.nama_request),
                  $('#edt-edit-qty-barang').val(response.data.qty);
                  $('#edt-edit-stock-barang').val(response.data.stock);
                  $('#edt-edit-satuan-barang').val(response.data.satuan);
                  $('#edt-edit-keterangan-barang').val(response.data.keterangan);
                  $('#edt-edit-debit-barang')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.debit) //set value for option to post it
                            .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                        .val(response.data.debit) //select option of select2
                        .trigger("change"); //apply to select2
                  $('#edt-edit-debit-barang').select2({
                    placeholder:"Pilih Kode Debit",
                    ajax: {
                        url: '{!! url("dropdown-akundebit") !!}',
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
                  $('#edt-edit-kredit-barang')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.kredit) //set value for option to post it
                            .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                        .val(response.data.kredit) //select option of select2
                        .trigger("change"); //apply to select2
                  $('#edit-kredit-barang').select2({
                    placeholder:"Pilih Kode Kredit",
                    ajax: {
                        url: '{!! url("dropdown-akundebit") !!}',
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
                  icon: 'error',
                  title: response.pesan,
                })
                }

              }
            });
          });
          $('#edt-btn-cancel-edit-barang').on('click',function(){
            $('#edt-edit-barang').hide();
            $('#edt-btn-add-barang').show();
          });
          $('#edt-edit-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-edit-kode-barang').val();
            var sj = $('#edt-kode-sj').val();
            $.ajax({
              type: 'put',
              url: '{!! url("data-detailsj/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                nama        : $('#edt-edit-namareq-barang').val(),
                qty         : $('#edt-edit-qty-barang').val(),
                keterangan  : $('#edt-edit-keterangan-barang').val(),
                debit       : $('#edt-edit-debit-barang').val(),
                kredit      : $('#edt-edit-kredit-barang').val(),
                user        : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSJedit(sj);
                  document.getElementById("edt-edit-tambah-barang").reset();
                  $('#edt-edit-barang').hide();
                  $('#edt-btn-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
              }
            });
          });
        //Edit Barang
        //Hapus Barang
          $(document).on('click','.hpsbarang', function(){
            $('#edt-hapus-barang').show();
            $('#edt-edit-barang').hide();
            $('#edt-tambah-barang').hide();
            $('#edt-btn-add-barang').hide();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailsj/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                $('#edt-hapus-kode-barang').val(kode);
                $('#edt-hapus-nama-barang').html(response.data.nama);
              }
            });
          });
          $(document).on('click','#edt-btn-cancel-hapus',function(){
            $('#edt-hapus-barang').hide();
            $('#edt-btn-add-barang').show();
          });
          $('#edt-form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-hapus-kode-barang').val();
            var sj = $('#edt-kode-sj').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailsj/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                user        : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true) {
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSJedit(sj);
                  $('#edt-hapus-barang').hide();
                  $('#edt-btn-add-barang').show();
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
        $('#edtsj').submit(function(e){
          var kode  = $('#edt-kode-sj').val();
          e.preventDefault(); // prevent actual form submit
          var el = $('#edt-btn-submit-sj');
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
          $.ajax({
            type: 'put',
            url: '{!! url("data-sj/'+kode+'") !!}',
            data : {
              tipe        : $('#edt-tipe-sj').val(),
              kode        : kode,
              tanggal     : $('#edt-tgl-sj').val(),
              _token      : token,
              so          : $('#edt-so-sj').val(),
              tgl_kirim   : $('#edt-tglkirim-sj').val(),
              tgl_terima  : $('#edt-tglditerima-sj').val(),
              konsumen    : $('#edt-konsumen-sj').val(),
              alamat      : $('#edt-alamat-sj').val(),
              kota        : $('#edt-kota-sj').val(),
              nopol       : $('#edt-nopol-sj').val(),
              ekspedisi   : $('#edt-ekspedisi-sj').val(),
              resi        : $('#edt-nokirim-so').val(),
              keterangan  : $('#edt-keterangan-sj').val(),
              ketpakai    : $('#edt-ketpakai-sj').val(),
              ketproduksi : $('#edt-ketproduksi-sj').val(),
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
                $('#modal-edit').modal('hide');
                var table = $('#tabel-sj').DataTable();
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
      // Edit SJ
      // Detail SJ
        $(document).on('click','.detail',function(){
          $('#detail-so').hide();$('#detail-so1').hide();$('#detail-so2').hide();
          $('#detail-pakai').hide(); $('#detail-produksi').hide();
          var kode = $(this).data('kode');
          $('#detail-kode-sj').val(kode);
          $.ajax({
            url :'{!! url("data-sj/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              // console.log(response);
              $('#detail-tgl-sj').val(response.data.sj.tanggal);
              $('#detail-perusahaan-sj').val(response.data.sj.namaperusahaan);
              var tipe = kode.substr(3,2);
              if(response.data.tgl_diterima == ""){
                $('#btn-detail-submit-sj').prop('disabled',true);
              } else {
                $('#btn-detail-submit-sj').prop('disabled',false);
              }
              if(tipe == 41 ){
                $('#detail-tipe-sj').val('PENJUALAN');
                $('#detail-so-sj').val(response.data.sj.so);
                $('#detail-namakonsumen-sj').val(response.data.sj.nama);
                $('#detail-tglkirim-sj').val(response.data.sj.tgl_kirim);
                $('#detail-kota-sj').val(response.data.sj.kota);
                $('#detail-nopol-sj').val(response.data.sj.nopol);
                $('#detail-alamat-sj').val(response.data.sj.alamat);
                $('#detail-ekspedisi-sj').val(response.data.sj.ekspedisi);
                $('#detail-nokirim-sj').val(response.data.sj.resi);
                $('#detail-keterangan-sj').val(response.data.sj.keterangan);
                $('#detail-so').show();$('#detail-so1').show();$('#detail-so2').show();
              } else if(tipe == 42){
                $('#detail-tipe-sj').val('PEMAKAIAN');
                $('#detail-ketpakai-sj').val(response.data.sj.keterangan);
                $('#detail-pakai').show();
              } else if(tipe == 43){
                $('#detail-tipe-sj').val('PRODUKSI');
                $('#detail-ketproduksi-sj').val(response.data.sj.keterangan);
                $('#detail-produksi').show();
              } else {
                $('#detail-tipe-sj').val('PEMINDAHAN');
                $('#detail-ketpemindahan-sj').val(response.data.sj.keterangan);
                $('#detail-pemindahan').show();
              }
              if(response.data.sj.status == 'Belum Diperiksa'){
                $('#detail-nama-pembuat').html(response.data.author.creator.nama);
                $('#detail-create-pembuat').html(response.data.author.created_at);
                $('#detail-nama-pemeriksa').html("-");
                $('#detail-create-pemeriksa').html("-");
                $('#btn-detail-submit-sj').show();
              } else {
                $('#detail-nama-pembuat').html(response.data.author.creator.nama);
                $('#detail-create-pembuat').html(response.data.author.created_at);
                $('#detail-nama-pemeriksa').html(response.data.author.pemeriksa.nama);
                $('#detail-create-pemeriksa').html(response.data.author.diperiksa);
                $('#btn-detail-submit-sj').hide();
              }
              tabelSJdetail(kode);
            }
          });
        });
        $('#dtlsj').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-detail-submit-sj');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#detail-kode-sj').val();
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
              time        : time,
              type        : "sj",
            }, // serializes form input
            success:function(response) {
              // console.log(response);
              var hasil = response.pesan;
              if(response.success == true){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-detail').modal('hide');
                var table = $('#tabel-sj').DataTable();
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
        $('#cetak-sj').on('click',function(){
          var kode = $('#detail-kode-sj').val();
          var tipe = kode.substr(3,2);
          if(tipe == 41){
            $.ajax({
              type    : 'get',
              url     : '{!! url("cekinvoice-sj/'+kode+'") !!}',
              success : function(response){
                // console.log(response);
                if(response.success == true){
                  location.href = 'cetak-sj?kode='+kode;
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
              }
            });
          } else {
            location.href = 'cetak-sj?kode='+kode;
          }

        });
      // Detail SJ
      // SELESAI SJ
        $('body').on('click','.selesai',function(){
            document.getElementById("form-selesai").reset();
            var kode = $(this).data('kode');
            document.getElementById("kode-selesai").innerHTML = kode;
            $('#selesai-kode').val(kode);
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
              url     : '{!! url("data-sj-selesai/'+kode+'") !!}',
              data    : {
                _token  : token,
                user : "{{$user->kode_karyawan}}",
              },
              success:function(response) {
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  $('#modal-selesai').modal('hide');
                  var table = $('#tabel-sj').DataTable();
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
      // SELESAI SJ
      // Hapus SJ
        $(document).on('click','.hapus',function(){
          var kode = $(this).data('kode');
          $('#hapus-kode-sj').val(kode);
          $('#hapus-kode').html(kode);
        });
        $('#form-hapus-sj').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-kode-sj').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-sj/'+kode+'") !!}',
            data    : {
              _token  : token,
              user : "{{$user->kode_karyawan}}",
            },
            success:function(response) {
              // console.log(response);
              var hasil = response.success;
              Toast.fire({
                icon: 'success',
                title: hasil
              })
              $('#modal-hapus').modal('hide');
              var table = $('#tabel-sj').DataTable();
              table.ajax.reload( null, false );
            },
            error:function(response){

            }
          });
        });
      // Hapus SJ

    //Reclass
        $(document).on('click','.re-belum',function(){
            var data = $(this).data('kode');
            $.ajax({
                type    : 'put',
                url     : '{!! url("reclass-sj/'+data+'") !!}',
                data    : {
                    _token : "{!! csrf_token() !!}",
                    status:"Belum Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-sj').DataTable();
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
                url     : '{!! url("reclass-sj/'+data+'") !!}',
                data    : {
                    _token : "{!! csrf_token() !!}",
                    status:"Sudah Diperiksa",
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        var table = $('#tabel-sj').DataTable();
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

      function tabelSJtambah(kode){
        $.ajax({
          url :'{!! url("data-detailsj/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_sj_tambah').empty();
            var datahandler = $('#tbl_sj_tambah');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  const qty = response.data[n]['qty']*1;
                  const qq = qty.toLocaleString('id-ID');
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+qq+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });

          }
        });
      }
      function tabelSJedit(kode){
        $.ajax({
          url :'{!! url("data-detailsj/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_sj_edit').empty();
            var datahandler = $('#tbl_sj_edit');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  const qty = response.data[n]['qty']*1;
                  const qq = qty.toLocaleString('id-ID');
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hpsbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+qq+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });

          }
        });
      }
      function tabelSJdetail(kode){
        $.ajax({
          url :'{!! url("data-detailsj/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_sj_detail').empty();
            var datahandler = $('#tbl_sj_detail');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  const qty = response.data[n]['qty']*1;
                  const qq = qty.toLocaleString('id-ID');
                Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+qq+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });

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
