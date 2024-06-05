<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Sales Order</title>
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
                <h1>Sales Order</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Sales Order</li>
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
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah" data-backdrop="static" class="btn bg-gradient-primary">Tambah Sales Order</button>      
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
                                <select id="filter-marketing" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                                <label>Konsumen</label>
                                <select id="filter-konsumen" class="form-control select2" required>
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
                                <th>SO</th>
                                <th>Tanggal</th>
                                <th>Konsumen</th>
                                <th>Marketing</th>
                                <th>Pembayaran</th>
                                <th>VAT</th>
                                <th>Term Payment</th>
                                <th>Keterangan SO</th>
                                <th>Status</th>
                                <th>KD Barang</th>
                                <th>Barang</th>
                                <th>Nama Request</th>
                                <th>Harga </th>
                                <th>Qty</th>
                                <th>DPP</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                    </table>
                    <table id="tabel-so" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Action</th>
                        <th>No SO</th>
                        <th>Konsumen</th>
                        <th>Barang</th>
                        <th>Total Penjualan</th>
                        <th>Tanggal</th>
                        <th>Marketing</th>
                        <th>Pembayaran</th>
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
      <!-- MODAL Tambah Sales Order -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Buat Sales Order</h4>
                      <button type="button" id="btn-x-so" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body form-group">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Sales Order</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form-tambah">
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label><b>Perusahaan<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="tambah-perusahaan" class="form-control select2" style="width:100%;"required>
                                            <option value="">Pilih Perusahaan</option>
                                            <option value="npa">CV. Nusa Pratama Anugrah</option>
                                            <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                            <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                        </select>
                                    </div>
                                    <div class='col-lg-2'>
                                        <label><b>Tanggal<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="date" id="tambah-tanggal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label><b>Jenis<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        @if($user->level != 'marketing')
                                          <select id="tambah-jenis"  class="form-control " style="width:100%;" required>
                                            <option value="">Pilih Jenis SO</option>
                                            <option value="51">Asset</option>
                                            <option value="31">Bahan Baku</option>
                                            <option value="21">Jasa</option>
                                            <option value="61">Barang Jadi</option>
                                          </select>
                                        @else
                                          <select id="tambah-jenis"  class="form-control " style="width:100%;" required>
                                            <option value="">Pilih Jenis SO</option>
                                            <option value="61">Barang Jadi</option>
                                          </select>
                                        @endif
                                    </div>
                                    <div class='col-lg-2'>
                                        <label><b>No PO</b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" id="tambah-po" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label><b>Marketing<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        @if($user->level == 'marketing')
                                          <select id="tambah-marketing"  class="form-control " style="width:100%;" required >
                                            <option value="">Pilih Nama Marketing</option>
                                            <option value="{{$user->kode_karyawan}}">{{$detail->nama}}</option>
                                          </select>
                                        @else
                                          <select id="tambah-marketing"  class="form-control select2 " style="width:100%;" required>
                                          </select>
                                        @endif
                                    </div>
                                    <div class='col-lg-2'>
                                        <label><b>Konsumen<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="tambah-konsumen" class="form-control select2"  style="width:100%;" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label><b>Pembayaran<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select id="tambah-bayar"  class="form-control " style="width:100%;" required>
                                            <option value="">Pilih Jenis Pembayaran</option>
                                            <option value="TUNAI">TUNAI</option>
                                            <option value="TEMPO">TEMPO</option>
                                        </select>
                                    </div>
                                    <div class='col-lg-2'>
                                        <label><b>Term Payment</b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" id="tambah-term" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <label><b>VAT<sup class="text-danger">*</sup></b></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="number" id="tambah-vat" class="form-control" >
                                    </div>
                                    <div class='col-lg-2'>
                                        <label>Keterangan</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <textarea  id="tambah-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Sales Order" ></textarea>
                                    </div>
                                </div>    
                            </form>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Barang</b></h3>
                            <div class="card-tools">
                              <!-- Collapse Button -->
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <button id="btn-add-barang" class="btn btn-primary">Tambah Barang</button>
                            </div>
                            <div id="add-barang">
                                <form id="form-add-barang">
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Nama Barang<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="tambah-nama-barang" class="form-control select2" style="width:100%;"required>
                                            </select>
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Nama Request</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" id="tambah-request-barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Harga<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="tambah-harga-barang" step=".01" class="form-control" type="number" min="1" required >
                                        </div>
                                        @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin')
                                            <div class="col-lg-2">
                                                <label><b>HPP</b></label>    
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="tambah-hpp" readonly>
                                                <input type="hidden" class="form-control" id="tambah-hpp-barang">    
                                            </div>
                                        @else
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-4"></div>
                                        @endif
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>QTY<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="tambah-qty-barang" step=".01" class="form-control" type="number" min="1" required >
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Satuan</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="tambah-satuan-barang" type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Kode Debit<sup class="text-danger">*</sup></b></label>
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="tambah-debit-barang"  class="form-control select2 "  style="width: 100%" ></select>
                                            
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Kode Kredit<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="tambah-kredit-barang"  class="form-control select2 "  style="width: 100%" ></select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Keterangan</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class='col-lg-2'>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row justify-content-between">
                                                <button type="button" id="btn-cancel-tambah-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                <button type="submit" id="btn-tambah-barang" class="col-sm-5 form-control btn btn-primary ">Tambah</button>
                                              </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            <div id="edit-barang">
                                <form id="form-edit-barang">
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Nama Barang<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="hidden" id="edit-id-barang">
                                            <input id="edit-nama-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Nama Request</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" id="edit-request-barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Harga<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="edit-harga-barang" step=".01" class="form-control" type="number" min="1" required >
                                        </div>
                                        @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin')
                                            <div class="col-lg-2">
                                                <label><b>HPP</b></label>    
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="edit-hpp" readonly>
                                                <input type="hidden" class="form-control" id="edit-hpp-barang">    
                                            </div>
                                        @else
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-4"></div>
                                        @endif
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>QTY<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="edit-qty-barang" step=".01" class="form-control" type="number" min="1" required >
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Satuan</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input id="edit-satuan-barang" type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                            <label><b>Kode Debit<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="edit-debit-barang"  class="form-control select2 "  style="width: 100%" ></select>
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Kode Kredit<sup class="text-danger">*</sup></b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <select id="edit-kredit-barang"  class="form-control select2 "  style="width: 100%" ></select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class='col-lg-2'>
                                            <label><b>Keterangan</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class='col-lg-2'>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row justify-content-between">
                                                <button type="button" id="btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                <button type="submit" id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit</button>
                                              </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            <hr>
                            <div class="row table-responsive">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                          <th rowspan="2">Action</th>
                                          <th rowspan="2">No.</th>
                                          <th rowspan="2">Kode Barang</th>
                                          <th rowspan="2">Nama Barang</th>
                                          <th rowspan="2">Nama Request</th>
                                          <th rowspan="2">Satuan</th>
                                          <th rowspan="2">Harga Jual</th>
                                          <th rowspan="2">QTY</th>
                                          <th rowspan="2">DPP</th>
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
                                    <tbody id="tabel-tambah">
                                    </tbody>
                                  </table>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" id="btn-close-so" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-submit-so"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                  </div>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Sales Order -->
      <!-- MODAL Edit Sales Order -->
        
      <!--/ Modal Edit Sales Order -->
      <!-- MODAL Detail Sales Order -->
        
      <!--/ Modal Detail Sales Order -->

      <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data PO</h4>
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

      <!-- MODAL Hapus Sales Order -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-so">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data SO</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-kode-so" class="form-control" type="text" hidden >
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
      <!--/ Modal Hapus Sales Order -->
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
        var barang = [];
        var token = "{!! csrf_token() !!}";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
          });
        function tabelbarang(tabel, data) {
            // Mengosongkan tabel sebelum memasukkan data baru
            $(tabel).empty();
            var total = 0;
            console.log(data);
            // Iterasi melalui setiap barang dalam data
            $.each(data, function(index, barang) {
                
                if(barang['status']=="hapus"){
                    
                } else {
                    if (tabel === '#tabel-tambah') {
                        var action = "<button type='button' class='btn btn-danger hapusbarang' data-kode='" + barang['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                    } else if (tabel === '#tabel-detail') {
                        var action = "-";
                    } else if (tabel === '#tabel-edit') {
                        var action = "<button type='button' class='btn btn-warning editbarang' data-kode='" + barang['id'] + "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger edthapusbarang' data-kode='" + barang['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                    } else {
                        
                    }
                    
                    var Nrow = $("<tr>");
                    var nomor = n+1;
                    var dpp = barang['dpp'];
                    var vat = $('#tambah-vat').val();
                    var VAT = (barang['harga']*vat)/100;
                    VAT = VAT.toFixed(2);
                    VAT = VAT*barang['qty'];
                    VAT = VAT.toFixed(2);
                    const qty = barang['qty']*1;
                    const qq = qty.toLocaleString('id-ID');
                    Nrow.html("<td>"+action+"</td><td>"+nomor+"</td><td>"+barang['kode_brg']+"</td><td>"+barang['nama']+"</td><td>"+barang['nama_request']+"</td><td>"+barang['satuan']+"</td><td>"+formatRupiah(barang['harga'])+"</td><td>"+qq+"</td><td>"+formatRupiah(barang['dpp'])+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(barang['total'])+"</td><td>"+barang['keterangan']+"</td><td>"+barang['debit']+"</td><td>"+barang['nama_debit']+"</td><td>"+barang['kredit']+"</td><td>"+barang['nama_kredit']+"</td></tr>");
                    $(tabel).append(Nrow);
                    n = n+1;
                }
                
            });
            //var Nrow = $("<tr>");
            //Nrow.html("<td colspan='10' style='text-align: center;color:red;'><b>Total</b></td><td><b>"+formatRupiah(response.total)+"</b></td><td colspan='5'></td></tr>");
            //$(tabel).append(Nrow);
            // Mengatur nilai total pada input dengan id 'tambah_total'
            
        }
        
        function generateUniqueId() {
            return '_' + Math.random().toString(36).substr(2, 9);
        }
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
      $(document).ready(function() {  
          
        $('#tabel-filter').hide();
        $('#cancel-filter').hide();
         @if($user->level == 'marketing')
            $('#cek-filter').hide();
          @else
            $('#cek-filter').show();
          @endif
        $('#filter').hide();
        $('#tabel-so').DataTable({
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
            ajax: '{!! url("data-so") !!}',
            columns: [   
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'rekanan', name: 'rekanan',orderable:true},
                { data: 'barang', name: 'barang',orderable:false},
                { data: 'total', name: 'total',orderable:false},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'karyawan', name: 'karyawan',orderable:true},
                { data: 'pembayaran', name: 'pembayaran',orderable:true},
                { data: 'status', name: 'status',orderable:true},
            ]
        });
        
      }); 
      $('.select2').select2();
      
      $('#cancel-filter').on('click',function(){
          $('#cek-filter').show();
          $('#filter').hide();
          $('#tabel-filter').DataTable().clear().destroy();
          $('#tabel-filter').hide();
          $('#tabel-so').DataTable().clear().destroy();
          $('#tabel-so').DataTable({
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
                ajax: '{!! url("data-so") !!}',
                columns: [         
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'kode', name: 'kode',orderable:true},
                    { data: 'rekanan', name: 'rekanan',orderable:true},
                    { data: 'tanggal', name: 'tanggal',orderable:true},
                    { data: 'karyawan', name: 'karyawan',orderable:true},
                    { data: 'pembayaran', name: 'pembayaran',orderable:true},
                    { data: 'status', name: 'status',orderable:true},
                ]
            });
            $('#cancel-filter').hide();
          $('#tabel-so').show();
      });
      $(document).on('click','#cek-filter',function(){
          $('#tabel-so').DataTable().clear().destroy();
          document.getElementById("form-filter").reset();
          $('#cek-filter').hide();
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
                    // console.log(data);
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
            url  : '{!! url("filter-so")!!}',
            data :{
                awal    :$('#filter-awal').val(),
                akhir   :$('#filter-akhir').val(),
                marketing : $('#filter-marketing').val(),
                konsumen   :$('#filter-konsumen').val(),
                status  : $('#filter-status').val(),
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#tabel-so').DataTable().clear().destroy();
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
                        { data: 'SO', name: 'SO',orderable:false, searchable:false},
                        { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                        { data: 'konsumen', name: 'konsumen',orderable:false, searchable:false},
                        { data: 'marketing', name: 'marketing',orderable:false, searchable:false},
                        { data: 'pembayaran', name: 'pembayaran',orderable:false, searchable:false},
                        { data: 'vat', name: 'vat',orderable:false, searchable:false},
                        { data: 'term_payment', name: 'term_payment',orderable:false, searchable:false},
                        { data: 'KETERANGAN', name: 'KETERANGAN',orderable:false, searchable:false},
                        { data: 'status', name: 'status',orderable:false, searchable:false},
                        { data: 'kd_brg', name: 'kd_brg',orderable:false, searchable:false},
                        { data: 'barang', name: 'barang',orderable:false, searchable:false},
                        { data: 'request', name: 'request',orderable:false, searchable:false},
                        { data: 'harga', name: 'harga',orderable:false, searchable:false},
                        { data: 'qty', name: 'qty',orderable:false, searchable:false},
                        { data: 'dpp', name: 'dpp',orderable:false, searchable:false},
                        { data: 'total', name: 'total',orderable:false, searchable:false},
                        { data: 'keterangan', name: 'keterangan',orderable:false, searchable:false},
                      ],
                      
                    });
                    $('#tabel-filter').show();
                    $('#tabel-so').hide();
                } else {
                    Toast.fire({
                        icon    :'error',
                        title   : response.pesan
                    })
                }
            }
        })
      });
      
      
      var today = new Date();
      var tgl = today.getDate();
      if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
        tgl = '0'+tgl;
      }
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var time = date+' '+time;
      var token = "{!! csrf_token() !!}";
      // Tambah SO
        $(document).on('click','#tambahdata',function(){
            document.getElementById("form-tambah").reset();
            $('#add-barang').hide(); $('#edit-barang').hide();
            $('#tabel-tambah').empty();
            barang.length = 0;
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
            $('#tambah-konsumen').select2({
                placeholder: 'Pilih Konsumen',
                ajax: {
                    url: '{!! url("dropdown-konsumen") !!}',
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
        
        //Tambah Barang
        $('#btn-add-barang').on('click',function(){
            $('#add-barang').show(); $(this).hide();
            document.getElementById("form-add-barang").reset();
            
            $('#tambah-nama-barang').empty();
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
            $('#tambah-nama-barang').on('change', function (){
                var barang = $(this).val();
                $.ajax({
                  url :'{!! url("data-barang/'+barang+'/edit") !!}',
                  type : 'get',
                  success : function(response){
                    // console.log(response);
                    $('#tambah-satuan-barang').val(response.result.satuan);
                  }
                });
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
                      $('#tambah-hpp-barang').val(response.data);
                      $('#tambah-hpp').val(response.data);
                    //   $('#edt-tambah-harga-barang').prop('min',response.data);
                    } else {
                      Toast.fire({
                        icon  :'error',
                        title : response.pesan,
                      });
                    }
                  }
                });
              });
            $('#tambah-harga-barang').on('change',function (){
                  var harga = $(this).val();
                  var hpp = $('#tambah-hpp-barang').val();
                  if (harga < hpp){
                      Toast.fire({
                          icon  : "error",
                          title : "Harga Terlalu rendah, Pastikan anda menginput dengan benar",
                      });
                  } else {
                      
                  }
            });
        })
        $('#btn-cancel-tambah-barang').on('click',function(){
            $('#add-barang').hide(); $('#btn-add-barang').show();
        })
        $('#btn-tambah-barang').on('click',function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $(this);
            el.prop('readonly', true);
            setTimeout(function(){el.prop('readonly', false); }, 3000);
            var id = generateUniqueId(); // Membuat ID unik
            var brg = document.getElementById('tambah-nama-barang');
            var barang = brg.options[brg.selectedIndex].value;    
            var dbt = document.getElementById('tambah-debit-barang');
            var debit = dbt.options[dbt.selectedIndex].value;  
            var krdt = document.getElementById('tambah-kredit-barang');
            var kredit = krdt.options[krdt.selectedIndex].value;  
            
            var data = {
                id      : id,
                kd_barang : $('#tambah-nama-barang').val(),
                barang    : barang,
                request : $('#tambah-request-barang').val(),
                harga   : $('#tambah-harga-barang').val(),
                hpp     : $('#tambah-hpp-barang').val(),
                qty     : $('#tambah-qty-barang').val(),
                satuan  : $('#tambah-satuan-barang').val(),
                keterangan : $('#tambah-keterangan-barang').val(),
                kd_debit   : $('#tambah-debit-barang').val(),
                debit       : debit,
                kd_kredit  : $('#tambah-kredit-barang').val(),
                kredit      : kredit,
                status  : "tambah"
                
            };
            try{
                barang.push(data);
                $('#add-barang').hide();
                $('#btn-tambah-barang').show();
                var handler = '#tabel-tambah';
                tabelbarang(handler,barang);
                Toast.fire({
                    icon: 'success',
                    title: "Data Berhasil Ditambahkan"
                  })
            } catch(error){
                Toast.fire({
                    icon: 'error',
                    title: error
                  })
            }
        })
        //Tambah Barang
        //Edit Barang
        //Edit Barang
        //Hapus Barang
      // Tambah SO
      
    </script>
  </body>
</html>

