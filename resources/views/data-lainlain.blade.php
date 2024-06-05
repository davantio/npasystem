

  <!DOCTYPE html>
  <html lang="en">
      @include('layout/head')
      <head>
        <title>Data Lain - Lain</title>
      </head>
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    
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
              <h1>Data Barang</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Data Barang</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-five-normal-tab1" data-toggle="pill" href="#custom-tabs-five-normal1" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="true">TAB 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-five-normal-tab2" data-toggle="pill" href="#custom-tabs-five-normal2" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">TAB 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-five-normal-tab3" data-toggle="pill" href="#custom-tabs-five-normal3" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false">TAB 3</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-five-tabContent">
                        <div class="tab-pane show active" id="custom-tabs-five-normal1" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
                            <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-header">
                                      <div class="col-md-2">
                                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah-barang"class="btn btn-block bg-gradient-primary">Tambah Barang</button>
                                      </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Kode</th>
                                          <th>Nama Barang</th>
                                          <th>Satuan</th>
                                          <th>QTY</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                          <td>1.</td>
                                          <td>000000195</td>
                                          <td>ALKOHOL TEKNIS 70%  -  25 LITER</td>
                                          <td>LITER</td>
                                          <td>40</td>
                                          <td>
                                            <div class="row">
                                              <button type="button" data-toggle="modal" data-target="#modal-detail-barang"class="btn  bg-gradient-info">Detail</button>
                                              <button type="button" data-toggle="modal" data-target="#modal-edit-barang"class="btn  bg-gradient-warning">Edit</button>
                                              <button type="button" data-toggle="modal" data-target="#modal-hapus-barang"class="btn  bg-gradient-danger">Hapus</button>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>2.</td>
                                          <td>000000194</td>
                                          <td>TOYA Karbol  -  25 LITER</td>
                                          <td>PCS</td>
                                          <td>100</td>
                                          <td>
                                            <div class="row">
                                              <button type="button" data-toggle="modal" data-target="#modal-detail-barang"class="btn  bg-gradient-info">Detail</button>
                                              <button type="button" data-toggle="modal" data-target="#modal-edit-barang"class="btn  bg-gradient-warning">Edit</button>
                                              <button type="button" data-toggle="modal" data-target="#modal-hapus-barang"class="btn  bg-gradient-danger">Hapus</button>
                                            </div>
                                          </td>
                                        </tr>
                                        
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-five-normal2" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
                            TAB 2 GO
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-five-normal3" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
                            TAB 3 GO
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
          
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  
  <!-- MODAL -->
    <!-- MODAL Tambah Barang -->
      <div class="modal fade" id="modal-tambah-barang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="tambahbarang">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input id="tambah_id_barang "name="tambah_id_barang"class="form-control" type="text" disabled="" >
                                    <label>Nama Barang </label>
                                    <input id="tambah_nama_barang" name="tambah_nama_barang" class="form-control" type="text" required>
                                    <label> Jenis</label>
                                    <select id="tambah_jenis_barang" name="tambah_jenis_barang" class="form-control select2 " required>
                                      <option value="">Pilih Jenis</option>
                                      <option value="padat">Padat</option>
                                      <option value="cair">Cair</option>
                                      <option value="jasa">Jasa</option>
                                      <option value="lainlain">Lain-Lain</option>
                                    </select> 
                                    <label> Satuan</label>
                                    <select id="tambah_satuan_barang" name="tambah_satuan_barang" class="form-control select2 " required>
                                      <option value="">Pilih Satuan</option>
                                      <option value="-">-</option>
                                      <option value="gram">Gram</option>
                                      <option value="kg">Kg</option>
                                      <option value="ml">Ml</option>
                                      <option value="liter">Liter</option>
                                      <option value="pcs">Pcs</option>
                                      <option value="kirim">Kirim</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select id="tambah_tipe_barang" name="tambah_tipe_barang" class="form-control select2 " required>
                                      <option value="">Pilih Tipe</option>
                                      <option value="agro-chemical">Agro Chemical</option>
                                      <option value="chemical-industri">Chemical Industri</option>
                                      <option value="chemical-cleaning">Chemical Cleaning</option>
                                      <option value="lain-lain">Lain - Lain</option>
                                    </select> 
                                    <label>Kuantitas</label>
                                    <input id="tambah_kuantitas_barang" name="tambah_kuantitas_barang" class="form-control" type="number" >
                                    <label>HPP (Rp.)</label>
                                    <input id="tambah_hpp_barang" name="tambah_hpp_barang" class="form-control" type="number" >
                                    <label>Lokasi</label>
                                    <select id="tambah_lokasi_barang" name="tambah_lokasi_barang" class="form-control select2 " required>
                                      <option value="">Pilih Lokasi</option>
                                      <option value="G-BB">Gudang Balongbendo</option>
                                      <option value="G-TPJ">Gudang Taman Pondok jati</option>
                                      <option value="G-KPTH">Gudang Keputih</option>
                                      <option value="BUFFER">Buffer</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{-- <label>Group [A-H]</label>
                                    <input id="tambah_grup_barang" name="tanggal_grup_barang" class="form-control" type="text" pattern="[A-H]"> --}}
                                    <label>Keterangan</label>
                                    <textarea id="tambah_keterangan_barang" class="form-control" name="tambah_keterangan_barang" rows="5" placeholder="Keterangan""></textarea>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    <!--/ Modal Tambah Barang -->
    <!-- Modal Detail Barang -->
      <div class="modal fade" id="modal-detail-barang">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Detail Data Barang</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label>ID Barang</label>
                                      <input id="detail_id_barang "name="detail_id_barang"class="form-control" type="text" disabled="" >
                                      <label>Nama Barang </label>
                                      <input id="detail_nama_barang" name="detail_nama_barang" class="form-control" type="text" disabled>
                                      <label>Nomor Barang (WA)</label>
                                      <input id="detail_cp_barang" name="detail_cp_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" disabled>
                                      <label> Marketing</label>
                                      <input id="detail_marketing_barang" name="detail_marketing_barang" class="form-control" type="text" disabled>
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label>Nama Perusahaan</label>
                                      <input id="detail_perusahaan_barang" name="detail_perusahaan_barang" class="form-control" type="text" disabled>
                                      <label>Telpon Kantor</label>
                                      <input id="detail_telp_barang" name="detail_telp_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" disabled>
                                      <label>Email</label>
                                      <input id="detail_email_barang" name="detail_email_barang" class="form-control" type="email" disabled>
                                      <label>Fax</label>
                                      <input id="detail_fax_barang" name="detail_fax_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" disabled>
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      {{-- <label>Group [A-H]</label>
                                      <input id="detail_grup_barang" name="tanggal_grup_barang" class="form-control" type="text" pattern="[A-H]" disabled> --}}
                                      <label>Alamat</label>
                                      <textarea id="detail_alamat_barang" class="form-control" name="detail_alamat_barang" rows="5" placeholder="Alamat Lengkap"" disabled></textarea>
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
    <!-- /Modal Detail Barang -->
    <!-- MODAL Edit Barang -->
      <div class="modal fade" id="modal-edit-barang">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <form id="editbarang">
                      <div class="modal-header bg-warning">
                          <h4 class="modal-title">Edit Data Barang</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                              <div class="row">
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label>ID Barang</label>
                                      <input id="edit_id_barang "name="edit_id_barang"class="form-control" type="text" disabled="" >
                                      <label>Nama Barang </label>
                                      <input id="edit_nama_barang" name="edit_nama_barang" class="form-control" type="text" required>
                                      <label>Nomor Barang (WA)</label>
                                      <input id="edit_cp_barang" name="edit_cp_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                                      <label> Marketing</label>
                                      <select id="edit_marketing_barang" name="edit_marketing_barang" class="form-control select2 " required>
                                      <option value="">Pilih Marketing</option>
                                      <option value="">Andy</option>
                                      <option value="">Bily</option>
                                      </select> 
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label>Nama Perusahaan</label>
                                      <input id="edit_perusahaan_barang" name="edit_perusahaan_barang" class="form-control" type="text">
                                      <label>Telpon Kantor</label>
                                      <input id="edit_telp_barang" name="edit_telp_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                      <label>Email</label>
                                      <input id="edit_email_barang" name="edit_email_barang" class="form-control" type="email" >
                                      <label>Fax</label>
                                      <input id="edit_fax_barang" name="edit_fax_barang" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" >
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      {{-- <label>Group [A-H]</label>
                                      <input id="edit_grup_barang" name="tanggal_grup_barang" class="form-control" type="text" pattern="[A-H]"> --}}
                                      <label>Alamat</label>
                                      <textarea id="edit_alamat_barang" class="form-control" name="edit_alamat_barang" rows="5" placeholder="Alamat Lengkap""></textarea>
                                  </div>
                              </div>
                              </div>
                      </div>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class=" col-sm-2 form-control btn btn-warning">Edit</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    <!--/ Modal Edit Barang -->
    <!-- MODAL Hapus Barang -->
      <div class="modal fade" id="modal-hapus-barang">
          <div class="modal-dialog modal-sm">
              <form id="hapusbarang">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data Barang</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus_id_barang "name="hapus_id_barang"class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class=" col-md-3">ID </label> 
                                          <h6 class="col-md-6"> 	NP-C-00000357</h6>
                                      </div>
                                      <div class="row">
                                          <label class=" col-md-3">Nama </label> 
                                          <h6 class="col-md-6">ABDUL ROHMAN AL ABDI</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    <!--/ Modal Hapus Barang -->
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
  <!-- AdminLTE App -->
  <script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  </body>
  </html>
  