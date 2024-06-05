<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Material Receive</title>
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
                <h1>Material Receive</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Material Receive</li>
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
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tmb-mr" data-backdrop="static" class="btn bg-gradient-primary">Tambah Material Receive</button>      
                        <div>
                            <button type="button" id="cancel-filter" class="btn btn-default">Cancel</button>
                            <button type="button" id="cek-filter" class="btn bg-gradient-success">Filter MR</button>
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
                                    <option value="">Pilih Jenis</option>
                                    <option value="61">Purchase Order</option>
                                    <option value="42">Produksi</option>
                                    <option value="43">Pemakaian</option>
                                    <option value="44">Pemindahan</option>
                                    <option value="all">All</option>
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
                            <div class="col-lg-2">
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
                                <th >MR</th>
                                <th>Tanggal</th>
                                <th>Transaksi</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>KD Gudang</th>
                                <th>Gudang</th>
                                <th>KD Barang</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Dikirim</th>
                                <th>Diakui</th>
                                <th>Diterima</th>
                                <th>Ongkir</th>
                                <th>DPP</th>
                                <th>VAT</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                 
                            </tr>
                        </thead>
                    </table>
                    <table id="tabel-mr" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style="min-width:120px">Action</th>
                        <th>Perusahaan</th>
                        <th>No MR</th>
                        <th>No Transaksi</th>
                        <th style="min-width:100px">Tanggal</th>
                        <th style="min-width:200px">Rekanan</th>
                        <th style="min-width:300px">Barang</th>
                        <th>Pembayaran</th>
                        <th style="min-width:120px">Status</th>
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
      <!-- MODAL Tambah Material Receive -->
        <div class="modal fade" id="modal-tmb-mr">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Buat Material Recieve</h4>
                    <button type="button" id="btn-x-mr" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Material Receive</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form="form-tambah">
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label>Kode MR</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input id="tmb-kode-mr" class="form-control" type="text" value=""readonly required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Perusahaan</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="tmb-perusahaan" class="form-control" required disabled>
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
                                        <input id="tmb-tgl-mr" class="form-control" type="date" required>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Jenis</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="tmb-jenis-mr" class="form-control" required>
                                            <option value="">Pilih Jenis Material Recieve</option>
                                            <option value="61">Purchase Order</option>
                                            <option value="42">Pemakaian</option>
                                            <option value="43">Produksi</option>
                                            <option value="44">Pemindahan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="po">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label> Kode Purchase Order </label>
                                            <select id="tmb-po-mr"  class="form-control select2 " style="width: 100%;" required>
                                                <option value="">Pilih Purchase Order</option>
                                            </select>
                                        </div>
                                        <div class = "col-lg-4">
                                            <label>Tanggal PO</label>
                                            <input id="tmb-tglpo-mr" class="form-control" type="date" required readonly>
                                        </div>
                                        <div class= "col-lg-4">
                                            <label> Surat Jalan </label>
                                            <input id="tmb-sj-mr" class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-po" class="form-control" style="resize:none;" rows="3" disabled ></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Pembayaran</label>
                                            <input id="tmb-bayar-mr" class="form-control" type="text" readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label >Keterangan</label>
                                            <textarea id="tmb-keteranganpo-mr" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-po" type="text" class="form-control" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>VAT (%)</label>
                                            <input id="tmb-vat-mr" class="form-control" type="number" min="0" max="100" strp="2" readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mr">
                                    <div class="col-lg-4">
                                        <div class="pemakaian">
                                            <label>Pemakaian</label>
                                            <select id="tmb-pemakaian-mr"  class="form-control select2 " style="width: 100%;" required>
                                              <option value="">Pilih Pemakaian</option>
                                            </select>
                                        </div>
                                        <div class="produksi">
                                            <label>Produksi</label>
                                            <select id="tmb-produksi-mr"  class="form-control select2 " style="width: 100%;" required>
                                              <option value="">Pilih Produksi</option>
                                            </select>
                                        </div>
                                        <div class="pemindahan">
                                            <label>Pemindahan</label>
                                            <select id="tmb-pemindahan-mr"  class="form-control select2 " style="width: 100%;" required>
                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Keterangan</label>
                                        <textarea id="tmb-keterangan-mr" class="form-control" style="resize:none;" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-4">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-switch" style="text-align:right;">
                                            <br>
                                            <input type="checkbox" class="custom-control-input form-control" id="kunci">
                                            <label class="custom-control-label" for="kunci" >Kunci MR</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
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
                              <button type="button" id="add-barang" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang</button>
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
                                    <select id="tambah-nama-barang" class="form-control select2" style="width:100%;" required></select>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Harga (Rp)</label>
                                    <input type="number" step=".001" id="tambah-harga-barang" class="form-control">
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Qty</label>
                                    <input type="number" step=".001" id="tambah-qty-barang" class="form-control">
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Diterima</label>
                                    <input type="number" step=".001" id="tambah-diterima-barang" class="form-control">
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Diakui</label>
                                    <input type="number" step=".001" id="tambah-diakui-barang" class="form-control">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label for="">Gudang Penerima</label> 
                                    <select id="tambah-gudang-barang" class="form-control select2"style="width:100%;"></select>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Satuan</label>
                                    <input type="text" id="tambah-satuan-barang" class="form-control" readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>DPP</label>
                                    <input type="number" step=".001" id="tambah-dpp-barang" class="form-control" readonly>
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Keterangan</label>
                                    <textarea id="tambah-keterangan-barang" class="form-control" style="resize:none;" rows="3"></textarea>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label for="">Debit</label>
                                    <select style="width:100%;" id="tambah-debit-barang" class="form-control select2"></select>
                                  </div>
                                  <div class="col-lg-4">
                                    <label for="">Kredit</label>
                                    <select style="width:100%;" id="tambah-kredit-barang" class="form-control select2"></select>
                                  </div>
                                  <div class="col-lg-4">
                                    <br>
                                    <div class="row justify-content-between">
                                      <button type="button"  id="btn-cancel-tambah-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                      <button type="submit"  id="btn-tambah-barang" class="col-sm-5 form-control btn btn-primary ">Add Barang</button>
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
                                      <input id="edit-kode-barang" class="form-control" type="text" hidden>
                                      <input id="edit-nama-barang" class="form-control" type="text" required readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label> QTY</label>
                                    <input id="edit-qty-barang" step=".001" class="form-control" type="number"  min="1"  required readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label> Harga (Rp.)</label>
                                    <input id="edit-harga-barang" step=".001" class="form-control" type="number" min="1" required readonly>  
                                  </div>
                                  <div class="col-lg-2">
                                      <label> Satuan</label>
                                      <input id="edit-satuan-barang" class="form-control" type="text" required readonly>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Diakui</label>
                                    <input id="edit-diakui-barang" step=".001" class="form-control" type="number" min="1" required > 
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label> Gudang Penerima </label>
                                    <select id="edit-gudang-barang"  class="form-control select2 " style="width: 100%;" required>
                                    </select>
                                  </div>
                                  <div class="col-lg-2">
                                    <label>Diterima</label>
                                    <input id="edit-diterima-barang" step=".001" class="form-control" type="number" min="1" required >
                                  </div>
                                  <div class="col-lg-2">
                                    <label>DPP (Rp.)</label> 
                                    <input id="edit-dpp-barang" step=".001" class="form-control" type="number" min="1" required readonly > 
                                  </div>
                                  <div class="col-lg-4">
                                    <label> Keterangan</label>
                                    <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Kode Akun Debit</label>
                                    <select id="edit-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                    </select>
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Kode Akun Kredit</label>
                                    <select id="edit-kredit-barang"  class="form-control select2 "  style="width: 100%" >
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
                                  <div class="col-lg-12">
                                    <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                  </div>
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
                                <th rowspan="2" >Action</th>
                                <th rowspan="2">No.</th>
                                <td colspan="3" align="center"><b>Referensi</b></td>
                                <td colspan="2"><b>Lokasi Gudang Masuk</b></td>
                                <th rowspan="2">Kode Barang</th>
                                <th rowspan="2">Nama Barang</th>
                                <td colspan="3" align="center"><b>QTY</b></td>
                                <th rowspan="2">Satuan</th>
                                <th rowspan="2">@ Harga Beli</th>
                                <th rowspan="2">DPP</th>
                                <th colspan="2">VAT</th>
                                <th rowspan="2">Grand Total</th>
                                <th rowspan="2">Uraian</th>
                                <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                <th rowspan="2">Kode PPN dimuka</th>
                                <th rowspan="2">Kode Hutang PPN</th>
                              </tr>
                              <tr>
                                <th>Kode MR</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Diakui</th>
                                <th>Diterima</th>
                                <th>Dikirim</th>
                                <th>%</th>
                                <th>VAT</th>
                                <th>Kode</th>
                                <th>Nama Perkiraan</th>
                                <th>Kode</th>
                                <th>Nama Perkiraan</th>
                              </tr>
                              </thead>
                              <tbody id="tbl_mr_tambah">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <form id="tmbmr">
                    <input type="text" id="tmb-time-mr" hidden>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-close-mr" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-mr"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Material Receive -->
      <!-- MODAL Edit Material Receive -->
        <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Material Recieve</h4>
                    <button type="button" id="btn-edit-x-mr" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Material Receive</b></h3>
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
                                      <label>Tanggal</label>
                                      <input id="edt-tgl-mr" class="form-control" type="date" required readonly>
                                    </div>
                                    <div class="col-lg-4">
                                      <label>Kode MR</label>
                                      <input id="edt-kode-mr" class="form-control" type="text" value="" readonly required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label> Perusahaan</label>
                                        <select class="form-control" id="edt-perusahaan" >
                                            <option value="npa">CV. Nusa Pratama Anugrah</option>
                                            <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                            <option value="triputra">PT. Triputra Satu Nusa</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4">
                                          <label class="edt-po"> Kode Transaksi </label>
                                          <input id="edt-transaksi-mr" class="form-control edt-po" type="text" value="" readonly required>
                                          <label>VAT (%)</label>
                                          <input id="edt-vat-mr" class="form-control edt-po"strp="2" type="number" min="0" max="100" readonly required>
                                      </div>
                                      <div class="col-lg-4">
                                          <label class="edt-po">Tanggal PO</label>
                                          <input id="edt-tglpo-mr" class="form-control edt-po" type="date" required readonly>
                                          <label class="edt-po"> Surat Jalan </label>
                                          <input id="edt-sj-mr" class="form-control edt-po" type="text" value="" >
                                      </div>
                                      <div class="col-lg-4">
                                          <label class="edt-po">Pembayaran</label>
                                          <input id="edt-bayar-mr" class="form-control edt-po" type="text" readonly required>
                                          <label >Keterangan</label>
                                          <textarea  id="edt-keterangan-mr" class="form-control" style="resize:none;" rows="4"></textarea>
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
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                          <div class="row" id="edt-edit-barang">
                          <form id="form-edt-edit-barang">
                            <div class="row">
                              <div class="col-lg-4">
                                  <label>Nama Barang</label>
                                  <input id="edt-kode-barang" class="form-control" type="text" hidden>
                                  <input id="edt-nama-barang" class="form-control" type="text" required readonly>
                              </div>
                              <div class="col-lg-2">
                                <label> QTY</label>
                                <input id="edt-qty-barang" step=".001" class="form-control" type="number" min="1"  required>
                              </div>
                              <div class="col-lg-2">
                                <label> Harga (Rp.)</label>
                                <input id="edt-harga-barang" step=".001" class="form-control" type="number" min="1" required readonly>  
                              </div>
                              <div class="col-lg-2">
                                  <label> Satuan</label>
                                  <input id="edt-satuan-barang"  class="form-control" type="text" required readonly>
                              </div>
                              <div class="col-lg-2">
                                <label>Diakui</label>
                                <input id="edt-diakui-barang" step=".001" class="form-control" type="number" min="1" required > 
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4">
                                <label> Gudang Penerima </label>
                                <select id="edt-gudang-barang"  class="form-control select2 " style="width: 100%;" required>
                                </select>
                              </div>
                              <div class="col-lg-2">
                                <label>Diterima</label>
                                <input id="edt-diterima-barang" step=".001" class="form-control" type="number" min="1" required >
                              </div>
                              <div class="col-lg-2">
                                <label>DPP (Rp.)</label> 
                                <input id="edt-dpp-barang" step=".001" class="form-control" type="number" min="1" required readonly > 
                              </div>
                              <div class="col-lg-4">
                                <label> Keterangan</label>
                                <textarea id="edt-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4">
                                <label>Kode Akun Debit</label>
                                <select id="edt-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                </select>
                              </div>
                              <div class="col-lg-4">
                                <label>Kode Akun Kredit</label>
                                <select id="edt-kredit-barang"  class="form-control select2 "  style="width: 100%" >
                                </select>
                              </div>
                              <div class="col-lg-4">
                                <br>
                                <div class="row justify-content-between">
                                  <button type="button"  id="btn-cancel-edt-barang" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                  <button type="submit"  id="btn-edt-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <hr>
                        <table  class="table table-responsive table-bordered table-striped">
                          <thead>
                          <tr>
                            <th rowspan="2">Action</th>
                            <th rowspan="2">No.</th>
                            <td colspan="3" align="center"><b>Referensi</b></td>
                            <td colspan="2"><b>Lokasi Gudang Masuk</b></td>
                            <th rowspan="2">Kode Barang</th>
                            <th rowspan="2">Nama Barang</th>
                            <td colspan="3" align="center"><b>QTY</b></td>
                            <th rowspan="2">Satuan</th>
                            <th rowspan="2">@ Harga Beli</th>
                            <th rowspan="2">DPP</th>
                            <th colspan="2">VAT</th>
                            <th rowspan="2">Grand Total</th>
                            <th rowspan="2">Uraian</th>
                            <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                            <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                            <th rowspan="2">Kode PPN dimuka</th>
                            <th rowspan="2">Kode Hutang PPN</th>
                          </tr>
                          <tr>
                            <th>Kode MR</th>
                            <th>Kode PO</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diakui</th>
                            <th>Diterima</th>
                            <th>Dikirim</th>
                            <th>%</th>
                            <th>VAT</th>
                            <th>Kode</th>
                            <th>Nama Perkiraan</th>
                            <th>Kode</th>
                            <th>Nama Perkiraan</th>
                          </tr>
                          </thead>
                          <tbody id="tbl_mr_edit">
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
                <input type="text" id="edt-time-mr" class="form-control"hidden>
                <div class="modal-footer justify-content-between ">
                    <button type="button" id="btn-edit-close-mr" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-edit-submit-mr"class="col-sm-2 form-control btn btn-warning">Edit</button>
                </div>
              </div>
          </div>
        </div>
      <!--/ Modal Edit Material Receive -->
      <!-- MODAL Detail Material Receive -->
        <div class="modal fade" id="modal-detail">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Detail Material Recieve</h4>
                    <button type="button" id="btn-detail-x-mr" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Material Receive</b></h3>
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
                                      <label>Tanggal</label>
                                      <input id="dtl-tgl-mr" class="form-control" type="date" required readonly>
                                    </div>
                                    <div class="col-lg-4">
                                      <label>Kode MR</label>
                                      <input id="dtl-kode-mr" class="form-control" type="text" value="" readonly required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Perusahaan</label>
                                        <input type="text" id="dtl-perusahaan" class="form-control" readonly>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-4">
                                        <label> Kode Transaksi </label>
                                        <input id="dtl-transaksi-mr" class="form-control" type="text" value="" readonly required>
                                        <label class="dtl-po">VAT (%)</label>
                                        <input id="dtl-vat-mr" class="form-control dtl-po" strp="2" type="number" min="0" max="100" readonly required>
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="dtl-po">Tanggal PO</label>
                                        <input id="dtl-tglpo-mr" class="form-control dtl-po" type="date" required readonly>
                                        
                                        <label class="dtl-po"> Surat Jalan </label>
                                        <input id="dtl-sj-mr" class="form-control dtl-po" type="text" value="" readonly >
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="dtl-po">Pembayaran</label>
                                        <input id="dtl-bayar-mr" class="form-control dtl-po" type="text" readonly required>
                                        <label>Keterangan</label>
                                        <textarea id="dtl-keterangan-mr" class="form-control" style="resize:none;"  rows="4" readonly></textarea>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                <label>AUTHORISASI </label>
                                <br>
                                <label >Dibuat Oleh :</label>
                                <h6 id="dtl-nama-pembuat"></h6>
                                <h6 id="dtl-create-pembuat"></h6>
                                <label> Diperiksa Oleh :</label>
                                <h6 id="dtl-nama-pemeriksa"></h6>
                                <h6 id="dtl-create-pemeriksa"></h6>
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
                          <a id="cetak-mr" class="btn btn-danger" rel="noopener noreferrer" target="_blank"><i class="fas fa-print"></i> Print</a>
                          <!--<button type="button" class="btn btn-danger" id="cetak-mr"><i class="fas fa-print"  rel="noopener" target="_blank"></i> Print</button>-->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        
                      </div>
                      <div class="card-body">
                        <table  class="table table-responsive table-bordered table-striped">
                          <thead>
                          <tr>
                            <th rowspan="2">No.</th>
                            <td colspan="3" align="center"><b>Referensi</b></td>
                            <td colspan="2"><b>Lokasi Gudang Masuk</b></td>
                            <th rowspan="2">Kode Barang</th>
                            <th rowspan="2">Nama Barang</th>
                            <td colspan="3" align="center"><b>QTY</b></td>
                            <th rowspan="2">Satuan</th>
                            <th rowspan="2">@ Harga Beli</th>
                            <th rowspan="2">DPP</th>
                            <th colspan="2">VAT</th>
                            <th rowspan="2">Grand Total</th>
                            <th rowspan="2">Uraian</th>
                            <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                            <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                            <th rowspan="2">Kode PPN dimuka</th>
                            <th rowspan="2">Kode Hutang PPN</th>
                          </tr>
                          <tr>
                            <th>Kode MR</th>
                            <th>Kode PO</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diakui</th>
                            <th>Diterima</th>
                            <th>Dikirim</th>
                            <th>%</th>
                            <th>VAT</th>
                            <th>Kode</th>
                            <th>Nama Perkiraan</th>
                            <th>Kode</th>
                            <th>Nama Perkiraan</th>
                          </tr>
                          </thead>
                          <tbody id="tbl_mr_detail">
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
                <form id="dtlmr">
                    <input type="text" id="dtl-time-mr" hidden>
                    <input type="text" id="dtl-diperiksa-mr" hidden>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-detail-close-mr" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-detail-submit-mr"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      <!--/ Modal Detail Material Receive -->
      <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data MR</h4>
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
      <!-- MODAL Hapus Material Receive -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-mr">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data MR</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-kode-mr" class="form-control" type="text" hidden >
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
      <!--/ Modal Hapus Material Receive -->
      
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
        $('#tabel-mr').DataTable({
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
          columnDefs: [
            {
                targets: 5, // Ganti dengan nomor indeks kolom yang ingin dibatasi
                render: function(data, type, row) {
                    // Batasi teks menjadi 70 karakter
                    var maxLength = 100;
                    var truncated = data.length > maxLength ? data.substr(0, maxLength - 3) + "..." : data;
                    return truncated;
                }
            },
            {
                targets: 6, // Sesuaikan dengan indeks kolom yang sesuai
                render: function(data, type, row) {
                    if (type === 'display' && typeof data === 'string') {
                        var dataArray = JSON.parse(data);
                        var result = '';
                        dataArray.forEach(function(item) {
                            result += "<li> " +item.barang + "</li><br>";
                        });
                        return result;
                    }
                    return "<ul> " + data + "</ul>"; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                }
            }
          ],
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-mr") !!}',
            columns: [   
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'perusahaan', name: 'perusahaan',orderable:true},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'transaksi', name: 'transaksi',orderable:true},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'nama', name: 'nama',orderable:true},
                { data: 'barang', name: 'barang',orderable:false},
                { data: 'pembayaran', name: 'pembayaran',orderable:true},
                { data: 'status', name: 'status',orderable:true},
            ]
        });
        
      }); 
      $('.select2').select2();
        document.getElementById('tmb-jenis-mr').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue === '61') {
                document.querySelector('.po').style.display = 'block';
                document.querySelector('.mr').style.display = 'none';
                document.querySelector('.pemakaian').style.display = 'none';
                document.querySelector('.produksi').style.display = 'none';
                document.querySelector('.pemindahan').style.display = 'none';
            } else if (selectedValue === '42') {
                document.querySelector('.po').style.display = 'none';
                document.querySelector('.mr').style.display = 'block';
                document.querySelector('.pemakaian').style.display = 'block';
                document.querySelector('.produksi').style.display = 'none';
                document.querySelector('.pemindahan').style.display = 'none';
            } else if (selectedValue === '43'){
                document.querySelector('.po').style.display = 'none';
                document.querySelector('.mr').style.display = 'block';
                document.querySelector('.pemakaian').style.display = 'none';
                document.querySelector('.produksi').style.display = 'block';
                document.querySelector('.pemindahan').style.display = 'none';
            } else if (selectedValue === '44'){
                document.querySelector('.po').style.display = 'none';
                document.querySelector('.mr').style.display = 'block';
                document.querySelector('.pemakaian').style.display = 'none';
                document.querySelector('.produksi').style.display = 'none';
                document.querySelector('.pemindahan').style.display = 'block';
            } else {
                document.querySelector('.po').style.display = 'none';
                document.querySelector('.mr').style.display = 'none';
                document.querySelector('.pemakaian').style.display = 'none';
                document.querySelector('.produksi').style.display = 'none';
                document.querySelector('.pemindahan').style.display = 'none';
            }
        });
      $('#cancel-filter').on('click',function(){
          $('#filter').hide();
          $('#tabel-filter').DataTable().clear().destroy();
          $('#tabel-filter').hide();
          $('#tabel-mr').DataTable().clear().destroy();
          $('#tabel-mr').DataTable({
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
                ajax: '{!! url("data-mr") !!}',
                columns: [         
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'kode', name: 'kode',orderable:true},
                    { data: 'transaksi', name: 'transaksi',orderable:true},
                    { data: 'tanggal', name: 'tanggal',orderable:true},
                    { data: 'nama', name: 'nama',orderable:true},
                    { data: 'pembayaran', name: 'pembayaran',orderable:true},
                    { data: 'status', name: 'status',orderable:true},
                ]
            });
            $('#cancel-filter').hide();
            $('#cek-filter').show();
          $('#tabel-mr').show();
      });
      $(document).on('click','#cek-filter',function(){
          $('#filter').show();
          $('#cek-filter').hide();
          $('#cancel-filter').show();
          document.getElementById("form-filter").reset();
      });
      $('#form-filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-submit-filter');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        $.ajax({
            type : 'get',
            url  : '{!! url("filter-mr")!!}',
            data :{
                awal    :$('#filter-awal').val(),
                akhir   :$('#filter-akhir').val(),
                jenis   :$('#filter-jenis').val(),
                status  : $('#filter-status').val(),
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#tabel-mr').DataTable().clear().destroy();
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
                        { data: 'MR', name: 'MR',orderable:false, searchable:false},
                        { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                        { data: 'transaksi', name: 'transaksi',orderable:false, searchable:false},
                        { data: 'jenis', name: 'jenis',orderable:false, searchable:false},
                        { data: 'KETERANGAN', name: 'KETERANGAN',orderable:false, searchable:false},
                        { data: 'status', name: 'status',orderable:false, searchable:false},
                        { data: 'kd_gdg', name: 'kd_gdg',orderable:false, searchable:false},
                        { data: 'gudang', name: 'gudang',orderable:false, searchable:false},
                        { data: 'kd_brg', name: 'kd_brg',orderable:false, searchable:false},
                        { data: 'barang', name: 'barang',orderable:false, searchable:false},
                        { data: 'harga', name: 'harga',orderable:false, searchable:false},
                        { data: 'dikirim', name: 'dikirim',orderable:false, searchable:false},
                        { data: 'diakui', name: 'diakui',orderable:false, searchable:false},
                        { data: 'diterima', name: 'diterima',orderable:false, searchable:false},
                        { data: 'ongkir', name: 'ongkir',orderable:false, searchable:false},
                        { data: 'dpp', name: 'dpp',orderable:false, searchable:false},
                        { data: 'vat', name: 'vat',orderable:false, searchable:false},
                        { data: 'total', name: 'total',orderable:false, searchable:false},
                        { data: 'keterangan', name: 'keterangan',orderable:false, searchable:false},
                      ],
                      
                    });
                    $('#tabel-filter').show();
                    $('#tabel-mr').hide();
                } else {
                    Toast.fire({
                        icon    :'error',
                        title   : response.pesan
                    })
                }
            }
        })
      });
      
      // Tambah MR
        $(document).on('click','#tambahdata',function(){
            document.querySelector('.po').style.display = 'none';
            document.querySelector('.mr').style.display = 'none';
            document.querySelector('.pemakaian').style.display = 'none';
            document.querySelector('.produksi').style.display = 'none';
            document.querySelector('.pemindahan').style.display = 'none';
          document.getElementById("tmbmr").reset();
          $('#tmb-tgl-mr').val("");
          $('#tmb-kode-mr').val("");
          $('#tmb-jenis-mr').val("");
          $('#tambah-barang').hide();$('#add-barang').hide();$("#edit-barang").hide();$('#hapus-barang').hide(); $('#po1').hide(); $('#po2').hide(); $('#po3').hide(); $('#pemakaian').hide(); $('#produksi').hide();$('#pemindahan').hide();$('#keterangan').hide();
          $('#tmb-tgl-mr').prop('disabled',false);
          $('#tmb-jenis-mr').prop('disabled',false);
          $('#tmb-po-mr').prop('disabled',false);
          $('#btn-submit-mr').prop('disabled',true);
          $('#tbl_mr_tambah').empty();
          
          $(document).on('change','#tmb-jenis-mr',function(){
            var jenis = $(this).val();
            var tgl = $('#tmb-tgl-mr').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-mr") !!}',
              type    : 'get',
              data    : {
                jenis   : jenis,
                tanggal : n
              },
              success : function(data){
                // console.log(data);
                $('#tmb-kode-mr').val(data);
              }
            });
            $('#tmb-perusahaan').val("");
            if(jenis == 61){
              $('#po1').show(); $('#po2').show(); $('#po3').show(); $('.pemakaian').hide(); $('.produksi').hide();$('.pemindahan').hide();$('#keterangan').hide();
              $('#tmb-po-mr').select2({
                placeholder: 'Pilih Purchase Order',
                ajax: {
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
            } else if (jenis == 42){
              $('#po1').hide(); $('#po2').hide(); $('#po3').hide(); $('.pemakaian').show();$('#keterangan').show(); $('.produksi').hide();$('.pemindahan').hide();
              $('#tmb-pemakaian-mr').select2({
                placeholder: 'Pilih Pemakaian',
                ajax: {
                    url: '{!! url("dropdown-sj/'+jenis+'") !!}',
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
            } else if(jenis == 43) {
              $('#po1').hide(); $('#po2').hide(); $('#po3').hide(); $('.pemakaian').hide(); $('.produksi').show();$('#keterangan').show(); $('.pemindahan').hide();
              $('#tmb-produksi-mr').select2({
                placeholder: 'Pilih Produksi',
                ajax: {
                    url: '{!! url("dropdown-sj/'+jenis+'") !!}',
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
            } else if(jenis == 44) {
              $('#po1').hide(); $('#po2').hide(); $('#po3').hide(); $('.pemakaian').hide(); $('.produksi').hide();$('.pemindahan').show();$('#keterangan').show();
              $('#tmb-pemindahan-mr').select2({
                placeholder: 'Pilih SJ Pemindahan',
                ajax: {
                    url: '{!! url("dropdown-sj/'+jenis+'") !!}',
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
            } else {
              $('#po1').hide(); $('#po2').hide(); $('#po3').hide(); $('.pemakaian').hide(); $('.produksi').hide();$('.pemindahan').hide();
            }
            });
          });
          $(document).on('change','#tmb-po-mr',function(){
            var po = $(this).val();
            $.ajax({
              url     :'{!! url("data-po/'+po+'/edit") !!}',
              type    : 'get',
              success : function(data){
                // console.log(data);
                $('#tmb-tglpo-mr').val(data.po.tanggal);
                @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                    $('#tmb-jumlah-po').val(formatRupiah(data.po.total));         
                @else
                    $('#tmb-jumlah-po').val(formatRupiah(0));
                @endif
                if(data.po.perusahaan == "-" || data.po.perusahaan == null){
                    $('#tmb-perusahaan').val("npa");
                } else {
                    $('#tmb-perusahaan').val(data.po.perusahaan);
                }
                
                $('#tmb-bayar-mr').val(data.po.pembayaran);
                $('#tmb-vat-mr').val(data.po.vat);
                $('#tmb-keteranganpo-mr').val(data.po.keterangan);
                $('#tmb-brg-po').val(data.po.barang);
                

                var handler = $('#tambah-kode-barang');
                handler.empty();
                var row = $('<option val="">Pilih Barang</option>');
                handler.append(row);
                $.each(data.detail, function(key,val){
                  var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                  handler.append(Nrow);
                });
              }
            });
            
          })
          $(document).on('change','#tmb-tgl-mr', function(){
            var po = $('#tmb-po-mr').val();
            var jns = po.substr(3,2);
            var tgl = $('#tmb-tgl-mr').val();
            var th = tgl.substr(2,2);
            var bln = tgl.substr(5,2);
            var n = th+bln;
            $.ajax({
              url     :'{!! url("lastkode-mr") !!}',
              type    : 'get',
              data    : {
                jenis   : jns,
                tanggal : n
              },
              success : function(data){
                // console.log(data);
                $('#tmb-kode-mr').val(data);
              }
            });
          });
          $(document).on('change','#tmb-pemindahan-mr',function(){
            var data = $(this).val();
            $.ajax({
              type : 'get',
              url  : '{!! url("data-sj/'+data+'/edit")!!}',
              success: function(response){
                // console.log(response);
                if(response.success == true){
                  $('#tmb-keterangan-mr').val(response.data.sj.keterangan);
                  if(response.data.po.perusahaan == "-" || response.data.po.perusahaan == null){
                    $('#tmb-perusahaan').val("npa");
                  } else {
                    $('#tmb-perusahaan').val(data.po.perusahaan);
                  }
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : "Data Tidak Ditemukan",
                  });
                }
              }
            });
          });
          $(document).on('change','#tmb-produksi-mr',function(){
            var data = $(this).val();
            $.ajax({
              type : 'get',
              url  : '{!! url("data-sj/'+data+'/edit")!!}',
              success: function(response){
                // console.log(response);
                if(response.success == true){
                  $('#tmb-keterangan-mr').val(response.data.sj.keterangan);
                  if(response.data.po.perusahaan == "-" || response.data.po.perusahaan == null){
                    $('#tmb-perusahaan').val("npa");
                  } else {
                    $('#tmb-perusahaan').val(data.po.perusahaan);
                  }
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : "Data Tidak Ditemukan",
                  });
                }
              }
            });
          });

          $(document).on('change','#kunci', function(){
            var checkBox = document.getElementById("kunci");
            var token = "{!! csrf_token() !!}";
            var kode  = $('#tmb-kode-mr').val();
            var length = kode.length;
            var tgl = $('tmb-tgl-mr').val();
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            if(kode == ''|| length != 15 || tgl == '') {
              alert('Semua Field wajib diisi');
              checkBox.check = false;
            } else {
              var jenis = $('#tmb-jenis-mr').val();
              
              if (checkBox.checked == true){
                $('#tmb-tgl-mr').prop('disabled',true);
                $('#tmb-perusahaan').prop('disabled',true);
                $('#tmb-jenis-mr').prop('disabled',true);
                $('#btn-x-mr').prop('disabled',true);
                $('#btn-close-mr').prop('disabled',true);
                $('#btn-submit-mr').prop('disabled',false);
                if(jenis == 61){
                  var transaksi = $('#tmb-po-mr').val();
                  var vat = $('#tmb-vat-mr').val();
                  $('#tmb-po-mr').prop('disabled',true);
                  $('#tmb-sj-mr').prop('disabled',true);
                  $('#tmb-keteranganpo-mr').prop('disabled',true);
                  var type = 'po';
                } else if (jenis == 42){
                  var transaksi = $('#tmb-pemakaian-mr').val();
                  var vat = 0;
                  $('#tmb-pemakaian-mr').prop('disabled',true);
                  $('#tmb-keterangan-mr').prop('disabled',true);
                  var type = 'sj';
                } else if (jenis == 43){
                  var transaksi = $('#tmb-produksi-mr').val();
                  var vat = 0;
                  $('#tmb-produksi-mr').prop('disabled',true);
                  $('#tmb-keterangan-mr').prop('disabled',true);
                  var type = 'sj';
                  $('#add-barang').show();
                  return false;
                } else if(jenis == 44){
                  var transaksi = $('#tmb-pemindahan-mr').val();
                  var vat = 0;
                  $('#tmb-keterangan-mr').prop('disabled',true);
                  $('#tmb-pemindahan-mr').prop('disabled',true);
                  var type = 'sj';
                }
                
                $('#tmb-time-mr').val(time);
                
                $.ajax({
                  type    : 'post',
                  url     : '{!! url("data-detailmr") !!}',
                  data    : {
                    _token  : token,
                    type    : type,
                    transaksi: transaksi,
                    perusahaan : $('#tmb-perusahaan').val(),
                    tanggal  : $('#tmb-tgl-mr').val(),
                    mr      : kode,
                    user : "{{$user->kode_karyawan}}",
                  },
                  success : function(response){
                    // console.log(response);
                    var hasil  = response.pesan;
                    if(response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: hasil
                      })
                      tabelMRtambah(kode);
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: hasil
                      })
                    }
                  }
                });
              } else {
                var start = time;
                var today = new Date();
                var tgl = today.getDate();
                if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
                  tgl = '0'+tgl;
                }
                var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                var endtime = date+' '+time;

                $('#tmb-tgl-mr').prop('disabled',false);
                $('#tmb-keterangan-mr').prop('disabled',false);
                $('#tmb-keteranganpo-mr').prop('disabled',false);
                $('#tmb-jenis-mr').prop('disabled',false);
                $('#tmb-po-mr').prop('disabled',false);
                $('#tmb-pemindahan-mr').prop('disabled',false);
                $('#tmb-produksi-mr').prop('disabled',false);
                $('#btn-x-mr').prop('disabled',false);
                $('#btn-close-mr').prop('disabled',false);
                $('#btn-submit-mr').prop('disabled',true);
                $('#add-barang').hide();
                $('#tambah-barang').hide();
                $('#edit-barang').hide();
                $('#tbl_mr_tambah').empty();
                $.ajax({
                  type: 'delete',
                  url: '{!! url("hps-detail-mr/'+kode+'") !!}',
                  data : {
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
                      
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: hasil
                      })
                    }
                    
                  }
                });
                
              }
            }
          });
          
          //Tambah Barang
            $('#add-barang').on('click',function(){
              document.getElementById("form-tambah-barang").reset();
              $('#tambah-nama-barang').empty();$('#tambah-gudang-barang').empty();$('#tambah-debit-barang').empty();$('#tambah-kredit-barang').empty();
              
              $('#tambah-barang').show();
              $('#add-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
              var sj = $('#tmb-produksi-mr').val();
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
              $('#tambah-debit-barang').select2({
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
              $('#tambah-kredit-barang').select2({
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
            });
            $('#tambah-nama-barang').on('change',function(){
              var barang = $(this).val();
              $.ajax({
                type  : 'get',
                url   : '{!! url("data-barang/'+barang+'/edit")!!}',
                success : function(response){
                  // console.log(response);
                  if(response.success == true){
                    $('#tambah-satuan-barang').val(response.result.satuan);
                  } else {
                    Toast.fire({
                      icon  : 'error',
                      title : response.pesan,
                    });
                  }
                }
              });
            });
            $('#tambah-qty-barang').keyup(function(){
              var qty = $(this).val();
              if(qty == null){
                return false;
              } else {
                var harga = $('#tambah-harga-barang').val();
                $('#tambah-dpp-barang').val(qty*harga);
              }
            });
            $('#tambah-harga-barang').keyup(function(){
              var harga = $(this).val();
              if(harga == null){
                return false;
              } else {
                var qty = $('#tambah-qty-barang').val();
                $('#tambah-dpp-barang').val(qty*harga);
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
              var transaksi = $('#tmb-produksi-mr').val();
              var kode = $('#tmb-kode-mr').val();
              $.ajax({
                type  : 'post',
                url   : '{!! url("data-detailmr")!!}',
                data  : {
                  _token  : token,
                  type    : "sj",
                  transaksi: transaksi,
                  mr      : kode,
                  perusahaan : $('#tmb-perusahaan').val(),
                  barang  : $('#tambah-nama-barang').val(),
                  gudang  : $('#tambah-gudang-barang').val(),
                  harga   : $('#tambah-harga-barang').val(),
                  qty     : $('#tambah-qty-barang').val(),
                  diterima: $('#tambah-diterima-barang').val(),
                  dpp     : $('#tambah-dpp-barang').val(),
                  diakui  : $('#tambah-diakui-barang').val(),
                  keterangan : $('#tambah-keterangan-barang').val(),
                  debit   : $('#tambah-debit-barang').val(),
                  kredit  : $('#tambah-kredit-barang').val(),
                  user : "{{$user->kode_karyawan}}",
                },
                success:function(response){
                  // console.log(response);
                  if(response.success == true){
                    Toast.fire({
                      icon  : 'success',
                      title : response.pesan,
                    });
                    tabelMRtambah(kode);
                    $('#tambah-barang').hide();
                    $('#add-barang').show();
                  } else {
                    Toast.fire({
                      icon  : 'error',
                      title : response.pesan,
                    });
                  }
                }
              });
              
            });
          // /Tambah Barang
          //Edit Barang
            $('body').on('click', '.editbarang', function () {
              $('#edit-barang').show();
              document.getElementById("form-edit-barang").reset();
              $('#edit-gudang-barang').empty();$('#edit-debit-barang').empty();$('#edit-kredit-barang').empty();
              $('#tambah-barang').hide();$('#add-barang').hide();$('#hapus-barang').hide();
               @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                    $('#edit-harga-barang').show(); $('#edit-dpp-barang').show();
               @else
                    $('#edit-harga-barang').hide(); $('#edit-dpp-barang').hide();
                    $('#edit-diakui-barang').prop('readonly',true);
                    $('#edit-debit-barang').prop('disabled',true);
                    $('#edit-kredit-barang').prop('disabled',true);
               @endif
              var kode = $(this).data('kode');
              
              // console.log(kode);
              $.ajax({
                url :'{!! url("data-detailmr/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  // console.log(response);
                  $('#edit-kode-barang').val(kode);
                  $('#edit-nama-barang').val(response.data.barang);
                  $('#edit-qty-barang').val(response.data.dikirim*1);
                  $('#edit-harga-barang').val(response.data.harga*1);
                  $('#edit-satuan-barang').val(response.data.satuan);
                  $('#edit-diakui-barang').val(response.data.diakui*1);
                  $('#edit-diterima-barang').val(response.data.diterima*1);
                  $('#edit-dpp-barang').val(response.data.dpp*1);
                  $('#edit-keterangan-barang').val(response.data.keterangan);
                  $('#edit-gudang-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kode_gdg) //set value for option to post it
                          .text(response.data.gudang)) //set a text for show in select
                      .val(response.data.kode_gdg) //select option of select2
                      .trigger("change"); //apply to select2
                  $('#edit-gudang-barang').select2({
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
                  $('#edit-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kode_debit) //set value for option to post it
                          .text(response.data.kode_debit+" - "+response.data.nama_debit)) //set a text for show in select
                      .val(response.data.kode_debit) //select option of select2
                      .trigger("change"); //apply to select2
                  $('#edit-debit-barang').select2({
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
                  $('#edit-kredit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kode_kredit) //set value for option to post it
                          .text(response.data.kode_kredit+" - "+response.data.nama_kredit)) //set a text for show in select
                      .val(response.data.kode_kredit) //select option of select2
                      .trigger("change"); //apply to select2
                  $('#edit-kredit-barang').select2({
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
                 
                }
              });
            });
            $("#edit-diakui-barang").keyup(function(){
              var n = $(this).val();
              var harga = $('#edit-harga-barang').val();
              var dpp = n*harga;
              $('#edit-dpp-barang').val(dpp);
            });
            $('#btn-cancel-edit-barang').on('click',function(){
              $('#edit-barang').hide();$('#add-barang').show();
            });
            $('#edit-diterima-barang').keyup(function(){
                var diterima = $(this).val();
                var diakui = $('#edit-diakui-barang').val();
                if(diterima > diakui){
                    var n = diterima-diakui;
                    Toast.fire({
                        icon    : 'warning',
                        title   : "barang diterima lebih banyak dari barang yang datang"
                    });
                } else if(diterima<diakui) {
                    var n = diakui-diterima;
                    Toast.fire({
                        icon    : 'error',
                        title   : "barang diterima lebih sedikit dari barang yang datang"
                    });
                } else {
                    Toast.fire({
                        icon    : 'success',
                        title   : "barang diterima sesuai dari barang yang datang"
                    });
                }
            });
            $('#form-edit-barang').submit(function(e){
              e.preventDefault(); // prevent actual form submit
              var el = $('#btn-edit-barang');
              el.prop('disabled', true);
              setTimeout(function(){el.prop('disabled', false); }, 4000);
              var token = "{!! csrf_token() !!}";
              var kode = $('#edit-kode-barang').val();
              var mr = $('#tmb-kode-mr').val();
              $.ajax({
                type: 'put',
                url: '{!! url("data-detailmr/'+kode+'") !!}',
                data : {
                  kode        : kode,
                  gudang      : $('#edit-gudang-barang').val(),
                  _token      : token,
                  diakui      : $('#edit-diakui-barang').val(),
                  diterima    : $('#edit-diterima-barang').val(),
                  dpp         : $('#edit-dpp-barang').val(),
                  keterangan  : $('#edit-keterangan-barang').val(),
                  debit       : $('#edit-debit-barang').val(),
                  kredit      : $('#edit-kredit-barang').val(),
                  po          : $('#tmb-po-mr').val(),
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
                    document.getElementById("form-edit-barang").reset();
                    tabelMRtambah(mr);
                    
                    $('#edit-barang').hide();
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
          //Hapus Barang
            $(document).on('click','.hapusbarang',function(){
              $('#hapus-barang').show();
              document.getElementById("form-hapus-barang").reset();
              $('#tambah-barang').hide();$('#add-barang').hide();$('#edit-barang').hide();
              var kode = $(this).data('kode');
              
              $.ajax({
                type  : 'get',
                url   : '{!!url("data-detailmr/'+kode+'/edit")!!}',
                success: function(response){
                  // console.log(response);
                  if(response.success == true){
                    $('#hapus-kode-barang').val(kode);
                    $('#hapus-nama-barang').html(response.data.barang);
                  } else {
                    Toast.fire({
                      icon  : 'error',
                      title : response.pesan
                    });
                  }
                }
              });
            });
            $('#btn-cancel-hapus').on('click',function(){
              $('#hapus-barang').hide();
              $('#add-barang').show();
            });
            $('#form-hapus-barang').submit(function(e){
              e.preventDefault(); // prevent actual form submit
              var el = $('#btn-hapus-barang');
              el.prop('disabled', true);
              setTimeout(function(){el.prop('disabled', false); }, 4000);
              var mr = $('#tmb-kode-mr').val();
              var kode = $('#hapus-kode-barang').val();
              var token = "{!! csrf_token() !!}";
              $.ajax({
                type  : 'delete',
                url   : '{!!url("data-detailmr/'+kode+'")!!}',
                data  : {
                  _token : token,
                  user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                  if(response.success == true){
                    Toast.fire({
                      icon    : 'success',
                      title   : response.pesan,
                    });
                    tabelMRtambah(mr);
                    $('#hapus-barang').hide();
                    $('#add-barang').show();
                  } else {
                    Toast.fire({
                      icon  : 'error',
                      title : response.pesan,
                    });
                  }
                }
              });
            });
          // /Hapus Barang
          $('#tmbmr').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-submit-mr');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#tmb-kode-mr').val();
            var jenis = $('#tmb-jenis-mr').val();
            var jns =$('#tmb-jenis-mr').val();
            if(jns == 61){
              var transaksi =$('#tmb-po-mr').val();
              var keterangan = $('#tmb-keteranganpo-mr').val();
            } else if ( jns == 42){
              var transaksi = $('#tmb-pemakaian-mr').val();
              var keterangan = $('#tmb-keterangan-mr').val();
            } else if (jns == 43){
              var transaksi = $('#tmb-produksi-mr').val();
              var keterangan = $('#tmb-keterangan-mr').val();
            } else if(jns == 44){
              var transaksi = $('#tmb-pemindahan-mr').val();
              var keterangan = $('#tmb-keterangan-mr').val();
            }
            $.ajax({
              type: 'post',
              url: '{!! url("data-mr") !!}',
              data : {
                kode        : kode,
                perusahaan  : $('#tmb-perusahaan').val(),
                jenis       : jenis,
                tanggal     : $('#tmb-tgl-mr').val(),
                _token      : token,
                transaksi   : transaksi,
                sj          : $('#tmb-sj-mr').val(),
                time        : $('#tmb-time-mr').val(),
                keterangan  : keterangan,
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
                  $('#modal-tmb-mr').modal('hide');
                  var table = $('#tabel-mr').DataTable(); 
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
      // Tambah MR
      // Edit MR
        $(document).on('click','.edit',function(){
          var kode = $(this).data('kode');
          var jenis = kode.substr(3,2);
          // Memilih semua elemen dengan class "edt-po"
          var elements = document.querySelectorAll('.edt-po');
            
          // Menyembunyikan setiap elemen
          elements.forEach(function(element) {
              element.style.display = 'none';
          });
          
          $('#edt-edit-barang').hide();
          $.ajax({
            url :'{!! url("data-mr/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              // console.log(response.mr);
              $('#edt-tgl-mr').val(response.mr.tanggal);
              $('#edt-perusahaan').val(response.mr.perusahaan);
              $('#edt-kode-mr').val(kode);
              $('#edt-transaksi-mr').val(response.mr.transaksi);
              $('#edt-keterangan-mr').val(response.mr.keterangan);
              if(jenis == 61){
                $('#edt-tglpo-mr').val(response.mr.tanggalpo);
                $('#edt-bayar-mr').val(response.mr.pembayaran);
                $('#edt-vat-mr').val(response.mr.vat);
                $('#edt-sj-mr').val(response.mr.surat_jalan);
                elements.forEach(function(element) {
                    element.style.display = 'block';
                });
              } else {
                elements.forEach(function(element) {
                    element.style.display = 'none';
                });
              }
              // console.log(response.author);
              if(response.mr.status == 'Belum Diperiksa'){
                $('#edit-nama-pembuat').html(response.author.creator.nama);
                $('#edit-create-pembuat').html(response.author.created_at);
                $('#edit-nama-pemeriksa').html("-");
                $('#edit-create-pemeriksa').html("-");
              } else {
                $('#edit-nama-pembuat').html(response.author.creator.nama);
                $('#edit-create-pembuat').html(response.author.created_at);
                $('#edit-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#edit-create-pemeriksa').html(response.author.diperiksa);
              } 
              tabelMRedit(kode);
            }
          });
        });
        $(document).on('click','.edtbarang',function(){
          $('#edt-edit-barang').show();
            var kode = $(this).data('kode');
            // console.log(kode);
            $.ajax({
              url :'{!! url("data-detailmr/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                // console.log(response);
                $('#edt-debit-barang').prop('readonly',true);$('#edt-kredit-barang').prop('readonly',true);
                $('#edt-harga-barang').prop('readonly',true);$('#edt-dikirim-barang').prop('readonly',true);
                $('#edt-kode-barang').val(kode);
                $('#edt-nama-barang').val(response.data.barang);
                $('#edt-qty-barang').val(response.data.dikirim);
                @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                    $('#edt-harga-barang').show(); $('#edt-dpp-barang').show();
               @else
                    $('#edt-harga-barang').hide(); $('#edt-dpp-barang').hide();
                    $('#edt-diakui-barang').prop('readonly',true);
                    $('#edt-debit-barang').prop('disabled',true);
                    $('#edt-kredit-barang').prop('disabled',true);
               @endif
                $('#edt-harga-barang').val(response.data.harga);
                $('#edt-satuan-barang').val(response.data.satuan);
                $('#edt-diakui-barang').val(response.data.diakui);
                $('#edt-diterima-barang').val(response.data.diterima);
                $('#edt-dpp-barang').val(response.data.dpp);
                $('#edt-keterangan-barang').val(response.data.keterangan);
                $('#edt-gudang-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kode_gdg) //set value for option to post it
                        .text(response.data.gudang)) //set a text for show in select
                    .val(response.data.kode_gdg) //select option of select2
                    .trigger("change"); //apply to select2
                $('#edt-gudang-barang').select2({
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
                $('#edt-debit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kode_debit) //set value for option to post it
                        .text(response.data.kode_debit+" - "+response.data.nama_debit)) //set a text for show in select
                    .val(response.data.kode_debit) //select option of select2
                    .trigger("change"); //apply to select2
                $('#edt-debit-barang').select2({
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
                $('#edt-kredit-barang')
                    .empty() //empty select
                    .append($("<option/>") //add option tag in select
                        .val(response.data.kode_kredit) //set value for option to post it
                        .text(response.data.kode_kredit+" - "+response.data.nama_kredit)) //set a text for show in select
                    .val(response.data.kode_kredit) //select option of select2
                    .trigger("change"); //apply to select2
                $('#edt-kredit-barang').select2({
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
              }
            });
        });
        $("#edt-diakui-barang").keyup(function(){
            var n = $(this).val();
            var harga = $('#edt-harga-barang').val();
            var dpp = n*harga;
            $('#edt-diterima-barang').val(n);
            $('#edt-dpp-barang').val(dpp);
          });
        $('#btn-cancel-edt-barang').on('click',function(){
          $('#edt-edit-barang').hide();
        });
        $('#form-edt-edit-barang').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-edt-barang');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#edt-kode-barang').val();
          var mr = $('#edt-kode-mr').val();
          $.ajax({
            type: 'put',
            url: '{!! url("data-detailmr/'+kode+'") !!}',
            data : {
              kode        : kode,
              gudang      : $('#edt-gudang-barang').val(),
              _token      : token,
              diakui      : $('#edt-diakui-barang').val(),
              diterima    : $('#edt-diterima-barang').val(),
              dpp         : $('#edt-dpp-barang').val(),
              debit       : $('#edt-debit-barang').val(),
              kredit      : $('#edt-kredit-barang').val(),
              keterangan  : $('#edt-keterangan-barang').val(),
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
                tabelMRedit(mr);
                document.getElementById("form-edt-edit-barang").reset();
                $('#edt-edit-barang').hide();
                $('#btn-edit-x-mr').prop('disabled',true);
                $('#btn-close-edit-mr').prop('disabled',true);
              } else {
                Toast.fire({
                  icon: 'error',
                  title: hasil
                })  
              }
              
            }
          });
        });
        $('#btn-edit-submit-mr').on('click',function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $(this);
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          var sj = $('#edt-sj-mr').val();
          var mr = $('#edt-kode-mr').val();
          var token = "{!! csrf_token() !!}";
          if(sj == null|| sj==''){
            return false;  
          } else {
            $.ajax({
              type  : 'put',
              url   : '{!! url("data-mr/'+mr+'") !!}',
              data  :{ sj : sj,_token: token,perusahaan : $('#edt-perusahaan').val()},
              success:function(response){
                // console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  $('#modal-edit').modal('hide');
                  var table = $('#tabel-mr').DataTable(); 
                  table.ajax.reload( null, false );
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
              }
            });
          }
          
        });
      // Edit MR
      // Detail MR
        $(document).on('click','.detail',function(){
          var kode = $(this).data('kode');
          // console.log(kode);
          var jenis = kode.substr(3,2);
          $('#cetak-mr').prop('href','cetak-mr?kode='+kode);
          $.ajax({
            url :'{!! url("data-mr/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
               console.log(response);
              $('#dtl-perusahaan').val(response.mr.namaperusahaan);
              if(response.success == true){
                  if(jenis == 61){
                    $('#dtl-tglpo-mr').val(response.mr.tanggalpo);
                    $('#dtl-bayar-mr').val(response.mr.pembayaran);
                    $('#dtl-vat-mr').val(response.mr.vat);
                    $('#dtl-sj-mr').val(response.mr.surat_jalan);
                    $('#dtl-po').show();
                  } else {
                    $('#dtl-po').hide();
                  }
                  $('#dtl-tgl-mr').val(response.mr.tanggal);
                  $('#dtl-kode-mr').val(kode);
                  $('#dtl-transaksi-mr').val(response.mr.transaksi);
                  $('#dtl-keterangan-mr').val(response.mr.keterangan);
                  // console.log(response.author);
                  if(response.mr.status == 'Belum Diperiksa'){
                    $('#dtl-nama-pembuat').html(response.author.creator.nama);
                    $('#dtl-create-pembuat').html(response.author.created_at);
                    $('#dtl-nama-pemeriksa').html("-");
                    $('#dtl-create-pemeriksa').html("-");
                    $('#btn-detail-submit-mr').show();
                  } else {
                    $('#dtl-nama-pembuat').html(response.author.creator.nama);
                    $('#dtl-create-pembuat').html(response.author.created_at);
                    $('#dtl-nama-pemeriksa').html(response.author.pemeriksa.nama);
                    $('#dtl-create-pemeriksa').html(response.author.diperiksa);
                    $('#btn-detail-submit-mr').hide();
                  } 
                  tabelMRdetail(kode);
              } else {
                  Toast.fire({
                      icon  : "error",
                      title : response.pesan,
                  });
              }
              
            }
          });
        });
        $('#dtlmr').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-detail-submit-mr');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#dtl-kode-mr').val();
          $.ajax({
            type: 'put',
            url: '{!! url("data-author/'+kode+'") !!}',
            data : {
              kode        : kode,
              _token      : token,
              konfirmator   : "{{$user->kode_karyawan}}",
              time        : $('#tmb-time-mr').val(),
              type       : "mr",
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
                var table = $('#tabel-mr').DataTable(); 
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
        // $('#cetak-mr').on('click',function(){
        //   var kode = $('#dtl-kode-mr').val();
        //   location.href = 'cetak-mr?kode='+kode;
        // });
      // Detail MR
      
      
      // SELESAI PO
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
            url     : '{!! url("data-mr-selesai/'+kode+'") !!}',
            data    : {
              _token  : token,
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
                var table = $('#tabel-mr').DataTable(); 
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
      // SELESAI PO

      // Hapus MR
        $(document).on('click','.hapus',function(){
          var kode = $(this).data('kode');
          $('#hapus-kode-mr').val(kode);
          $('#hapus-kode').html(kode);
        });
        $('#form-hapus-mr').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-kode-mr').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-mr/'+kode+'") !!}',
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
              var table = $('#tabel-mr').DataTable(); 
              table.ajax.reload( null, false );
            },
            error:function(response){

            }
          });
        });
      // Hapus MR
      function tabelMRtambah(kode){
        $.ajax({
          url :'{!! url("data-detailmr/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_mr_tambah').empty();
            var datahandler = $('#tbl_mr_tambah');
            var n= 0;
            var jns =$('#tmb-jenis-mr').val();
            if(jns == 61){
              var transaksi = $('#tmb-po-mr').val();
            } else if ( jns == 42){
              var transaksi = $('#tmb-pemakaian-mr').val();
            } else if (jns == 43){
              var transaksi = $('#tmb-produksi-mr').val();
            } else if( jns == 44){
              var transaksi = $('#tmb-pemindahan-mr').val();
            }
            var tgl = $('#tmb-tgl-mr').val();
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>"); 
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = response.data[n]['vat'];
                  var VAT = (dpp*vat)/100;
                  Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+kode+"</td><td>"+transaksi+"</td><td>"+tgl+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+response.data[n]['diakui']+"</td><td>"+response.data[n]['diterima']+"</td><td>"+response.data[n]['dikirim']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+response.data[n]['vat']+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td>><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['kode_debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kode_kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td><td></td><td></td></tr>");
                
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
      }
      function tabelMRedit(kode){
        $.ajax({
          url :'{!! url("data-detailmr/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_mr_edit').empty();
            var datahandler = $('#tbl_mr_edit');
            var n= 0;
            var transaksi = $('#edt-transaksi-mr').val();
            var tgl = $('#edt-tgl-mr').val();
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = response.data[n]['vat'];
                  var VAT = (dpp*vat)/100;
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a></div></td><td>"+nomor+"</td><td>"+kode+"</td><td>"+transaksi+"</td><td>"+tgl+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+response.data[n]['diakui']+"</td><td>"+response.data[n]['diterima']+"</td><td>"+response.data[n]['dikirim']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+response.data[n]['vat']+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td>><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['kode_debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kode_kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td><td></td><td></td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
      }
      function tabelMRdetail(kode){
        $.ajax({
          url :'{!! url("data-detailmr/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            // console.log(response);
            $('#tbl_mr_detail').empty();
            var datahandler = $('#tbl_mr_detail');
            var n= 0;
            var transaksi = $('#dtl-transaksi-mr').val();
            var tgl = $('#dtl-tgl-mr').val();
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = response.data[n]['vat'];
                  var VAT = (dpp*vat)/100;
                Nrow.html("<td>"+nomor+"</td><td>"+kode+"</td><td>"+transaksi+"</td><td>"+tgl+"</td><td>"+response.data[n]['kode_gdg']+"</td><td>"+response.data[n]['gudang']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['barang']+"</td><td>"+response.data[n]['diakui']+"</td><td>"+response.data[n]['diterima']+"</td><td>"+response.data[n]['dikirim']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+response.data[n]['vat']+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td>><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['kode_debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kode_kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td><td></td><td></td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
      }

      //Reclass
        $(document).on('click','.re-belum',function(){
            var data = $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("reclass-mr/'+data+'") !!}',
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
                        var table = $('#tabel-mr').DataTable(); 
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
                type    : 'get',
                url     : '{!! url("reclass-mr/'+data+'") !!}',
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
                        var table = $('#tabel-mr').DataTable(); 
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
