<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Laporan Harian Marketing</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('AdminLTE/dist')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}
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
              @if($user->level == 'marketing')
                <h1 class="m-0">Laporan Harian {{$detail->nama}}</h1>
              @else
                <h1 class="m-0">Laporan Harian Marketing</h1>
              @endif
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Harian Marketing</li>
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
                      <button type="button" data-toggle="modal" data-backdrop="static" data-target="#modal-tambah" class="btn btn-primary bg-gradient-primary" id="btn-tambah">Buat Laporan</button>
                  </div>
                  <hr>
                  <form id="form-filter" method="POST">
                      <div class="row" id="filter">
                          <div class="col-lg-2">
                              <label>Tanggal Awal</label>
                              <input type="date" class="form-control" id="filter-tanggal-awal" required>
                          </div>
                          <div class="col-lg-2">
                              <label>Tanggal Akhir</label>
                              <input type="date" class="form-control" id="filter-tanggal-akhir" required>
                          </div>
                          <div class="col-lg-3">
                              <label>jenis Laporan</label>
                              <select id="filter-jenis" class="form-control select2" required>
                                  <option value="">Pilih Laporan</option>
                                  <option value="all">All</option>
                                  <option value="laporan">Laporan</option>
                                  <option value="call">Effectif Call</option>
                              </select>
                          </div>
                          <div class="col-lg-3">
                              <label>Marketing</label>
                              <select id="filter-marketing" class="form-control select2" required></select>
                          </div>
                          <div class="col-lg-2">
                              <br>
                              <button type="submit" class="btn bg-gradient-success" id="submit-filter">Cari</button>
                          </div>
                      </div>
                  </form>
                  
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive" id=data-filter>
                  <table id="table-filter" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>Action</th>
                      <th>Tanggal</th>
                      <th>Marketing</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                  
                </div>
                <div class="card-body table-responsive" id=default>
                  <table id="table-laporan" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>Action</th>
                      <th>Tanggal</th>
                      <th>Marketing</th>
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
    <!-- MODAL Detail Laporan -->
      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">
              <div class="modal-header bg-info">
                <h4 class="modal-title">Detail Laporan Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-4">
                      <input type="hidden" id="dtl-kode">
                    <label> Nama Marketing</label>
                    <input type="text" class="form-control" id="dtl-marketing" readonly>
                  </div>
                  <div class="col-lg-4">
                    <label> Tanggal </label>
                    <input type="date" class="form-control" id="dtl-tanggal" readonly >
                  </div>
                  <div class="col-lg-4">
                    <label> Status </label>
                    <input type="text" class="form-control" id="dtl-status" readonly >
                  </div>
                </div>
                <hr>
                <div class="row table-responsive">
                    <table class="table table-stripted table">
                        <thead>
                            <th>Jenis</th>
                            <th>Jam</th>
                            <th>Perusahaan</th>
                            <th>Rekanan</th>
                            <th>Laporan</th>
                        </thead>
                        <tbody id="tabel-detail">
                        </tbody>
                    </table>
                </div>
              </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="dtl-btn-periksa">Konfirmasi</button>
              </div>
          </div>
        </div>
      </div>
    <!-- Modal Detail Laporan -->
    <!-- MODAL Tambah Laporan -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Laporan Marketing</h4>
                <button type="button" id="btn-x" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-4">
                      <input type="hidden" id="kode-laporan">
                    <label> Nama Marketing</label>
                    <select id="tmb-marketing" class="form-control select2" required></select>
                    <!--<label>jenis Laporan</label>-->
                    <!--<select id="tmb-jenis" class="form-control select2" required>-->
                    <!--    <option value="">Pilih Laporan</option>-->
                    <!--    <option value="all">All</option>-->
                    <!--    <option value="laporan">Laporan</option>-->
                    <!--    <option value="call">Effectif Call</option>-->
                    <!--</select>-->
                  </div>
                  <div class="col-lg-4">
                    <label> Tanggal </label>
                    <input type="date" class="form-control" id="tmb-tanggal" readonly required>
                    <!--<label>Perusahaan</label>-->
                    <!--<select id="tmb-perusahaan" class="form-control select2" required>-->
                    <!--</select>-->
                    
                  </div>
                  <div class="col-lg-4">
                    <div class="custom-control custom-switch">
                      <br>
                      <input type="checkbox" class="custom-control-input form-control" id="kunci-tambah">
                      <label class="custom-control-label" for="kunci-tambah" >Lock </label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                    <button type="button" class="btn bg-gradient-primary" id="btn-tambah-data">Tambah Laporan</button>
                </div>
                <hr>
                <form id="tambah-data" method="POST">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>Jenis Laporan</label>
                            <select id="tambah-jenis" class="form-control select2" required>
                                <option value="">Pilih Laporan</option>
                                <option value="laporan">Laporan</option>
                                <option value="call">Effectif Call</option>
                            </select>
                            <label>Jam</label>
                            <input type="time" id="tambah-jam" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Perusahaan</label>
                            <select id="tambah-perusahaan" class="form-control select2" style="width:100%;" required>
                            </select>
                            <label>Rekanan</label>
                            <input type="text" class="form-control" id="tambah-rekanan">
                        </div>
                        <div class="col-lg-4">
                            <label> Laporan</label>
                            <textarea class="form-control" style="resize:none;" rows="3" placeholder="" id="tambah-laporan" required></textarea>
                        </div>
                        <div class="col-lg-2">
                            <br><button type="submit" class="btn bg-gradient-primary form-control" id="submit-tambah-data">Tambah</button>    
                        </div>
                    </div>
                </form>
                <form id="edit-data">
                    <div class="row">
                        <div class="col-lg-2">
                            <input type="hidden" id="edit-kode">
                            <label>Jenis Laporan</label>
                            <select id="edit-jenis" class="form-control select2" required>
                                <option value="">Pilih Laporan</option>
                                <option value="laporan">Laporan</option>
                                <option value="call">Effectif Call</option>
                            </select>
                            <label>Jam</label>
                            <input type="time" id="edit-jam" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Perusahaan</label>
                            <select id="edit-perusahaan" class="form-control select2" required>
                            </select>
                            <label>Rekanan</label>
                            <input type="text" class="form-control" id="edit-rekanan">
                        </div>
                        <div class="col-lg-4">
                            <label>Laporan</label>
                            <textarea class="form-control" style="resize:none;" rows="3" placeholder="" id="edit-laporan" required></textarea>
                        </div>
                        <div class="col-lg-3 justify-content-between">
                            <br>
                            <button type="button" class="btn btn-default" id="cancel-edit-data">Cancel</button>
                            <button type="submit" class="btn bg-gradient-warning" id="submit-edit-data">Edit</button>
                        </div>
                    </div>
                </form>
                <form id="hapus-data">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Apakah Anda yakin menghapus data ini ?</label>
                            <br>
                            <input type="hidden" class="form-control" id="hapus-kode-data">
                            <b id="hapus-perusahaan"></b>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 justify-content-between">
                            <br>
                            <button type="button" class="btn btn-default" id="cancel-hapus-data">Cancel</button>
                            <button type="submit" class="btn bg-gradient-danger" id="submit-hapus-data">Hapus</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row table-responsive">
                    <table class="table table-stripted table">
                        <thead>
                            <th>Action</th>
                            <th>Jenis</th>
                            <th>Jam</th>
                            <th>Perusahaan</th>
                            <th>Rekanan</th>
                            <th>Laporan</th>
                        </thead>
                        <tbody id="tabel-tambah">
                        </tbody>
                    </table>
                </div>
              </div>
            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="tmb-btn-cancel" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tmb-btn-submit" >Tambah</button>
              </div>
          </div>
        </div>
      </div>
    <!-- Modal Tambah Laporan -->
    <!-- MODAL Edit Laporan -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-warning">
                <h4 class="modal-title">Edit Laporan Marketing</h4>
                <button type="button" id="edt-btn-x" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-4">
                    <input type="hidden" id="edt-kode">
                    <label> Nama Marketing</label>
                    <input type="hidden" id="edt-marketing" class="form-control" readonly>
                    <input type="text" id="edt-nama-marketing" class="form-control" readonly>
                  </div>
                  <div class="col-lg-4">
                    <label> Tanggal </label>
                    <input type="date" class="form-control" id="edt-tanggal" readonly>
                  </div>
                  <div class="col-lg-4">
                    <div class="custom-control custom-switch">
                      <br>
                      <input type="checkbox" class="custom-control-input form-control" id="kunci-edit">
                      <label class="custom-control-label" for="kunci-edit" >Lock </label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                    <button type="button" class="btn bg-gradient-primary" id="edt-btn-tambah-data">Tambah Laporan</button>
                </div>
                <hr>
                <form id="edt-tambah-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Jenis Laporan</label>
                            <select id="edt-tambah-jenis" class="form-control select2" required>
                                <option value="">Pilih Laporan</option>
                                <option value="laporan">Laporan</option>
                                <option value="call">Effectif Call</option>
                            </select>
                            <label>Jam</label>
                            <input type="time" id="edt-tambah-jam" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Perusahaan</label>
                            <select id="edt-tambah-perusahaan" class="form-control select2" style="width:100%;" required>
                            </select>
                            <label>Rekanan</label>
                            <input type="text" class="form-control" id="edt-tambah-rekanan">
                        </div>
                        <div class="col-lg-4">
                            <label> Laporan</label>
                            <textarea class="form-control" style="resize:none;" rows="3" placeholder="" id="edt-tambah-laporan" required></textarea>
                        </div>
                        <div class="col-lg-2 justify-content-between">
                            <br>
                            <button type="button" id="edt-cancel-tambah-data" class="btn btn-default">Cancel</button>    
                            <button type="submit" id="edt-submit-tambah-data" class="btn bg-gradient-primary">Tambah</button>    
                        </div>
                    </div>
                </form>
                <form id="edt-edit-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="hidden" id="edt-edit-kode">
                            <label>Jenis Laporan</label>
                            <select id="edt-edit-jenis" class="form-control select2" required>
                                <option value="">Pilih Laporan</option>
                                <option value="laporan">Laporan</option>
                                <option value="call">Effectif Call</option>
                            </select>
                            <label>Jam</label>
                            <input type="time" id="edt-edit-jam" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Perusahaan</label>
                            <select id="edt-edit-perusahaan" class="form-control select2" required>
                            </select>
                            <label>Rekanan</label>
                            <input type="text" id="edt-edit-rekanan" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Laporan</label>
                            <textarea class="form-control" style="resize:none;" rows="3" placeholder="" id="edt-edit-laporan" required></textarea>
                        </div>
                        <div class="col-lg-2 justify-content-between">
                            <br>
                            <button type="button" id="edt-cancel-edit-data" class="btn btn-default">Cancel</button>    
                            <button type="submit" id="edt-submit-edit-data" class="btn bg-gradient-warning">Edit</button>
                        </div>
                    </div>
                </form>
                <form id="edt-hapus-data">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Apakah Anda yakin menghapus data ini ?</label>
                            <br>
                            <input type="hidden" class="form-control" id="edt-hapus-kode-data">
                            <b id="edt-hapus-perusahaan"></b>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 justify-content-between">
                            <br>
                            <button type="button" id="edt-cancel-hapus-data" class="btn btn-default">Cancel</button>
                            <button type="submit" id="edt-submit-hapus-data" class="btn bg-gradient-danger">Hapus</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row table-responsive">
                    <table class="table table-stripted table">
                        <thead>
                            <th>Action</th>
                            <th>Jenis</th>
                            <th>Jam</th>
                            <th>Perusahaan</th>
                            <th>Rekanan</th>
                            <th>Laporan</th>
                        </thead>
                        <tbody id="tabel-edit">
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="edt-btn-cancel" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="edt-btn-edit" >Edit</button>
              </div>
          </div>
        </div>
      </div>
    <!-- Modal Edit Laporan -->
    <!-- MODAL Hapus Laporan -->
      <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
          <form id="form-hapus">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h4 class="modal-title">Hapus Data Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      Apakah Anda Yakin Akan Menghapus Data ini ?
                      <input id="hapus-kode" class="form-control" type="text" hidden >
                      <br>
                      <b id="data-hapus"></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="hps-btn-submit" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    <!--/ Modal Hapus Laporan -->
  <!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

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
<script>
    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
  $(document).ready(function() { 
    $('#table-laporan').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-lapmarketing") !!}',
        columns: [   
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
        ]
    });
    
    
    
    //FILTER
    $('#data-filter').hide();
        //Filter Marketing
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
        //Filter Marketing
    //FILTER
    
  }); 
  $('.select2').select2();
  //Laporan
  //Tambah Laporan
    $(document).on('click','#btn-tambah',function(){
        
        $('#btn-tambah-data').hide();$('#tambah-data').hide(); $('#edit-data').hide(); $('#hapus-data').hide();$('tabel-tambah').empty();
        $('#kunci-tambah').prop('checked',false);$('#tmb-marketing').prop('disabled',false);$('#tabel-tambah').empty();
        document.getElementById('tmb-tanggal').valueAsDate = new Date();
        // Marketing
          @if($user->level == 'marketing')
            var datahandler = $('#tmb-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option><option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
            datahandler.append(Nrow);
          @else
            $.ajax({
              url :'{!! url("dropdown-marketing") !!}',
              type : 'get',
              success : function(data){
                var datahandler = $('#tmb-marketing');
                datahandler.empty();
                var Nrow = $("<option value=''>Pilih Marketing</option>");
                datahandler.append(Nrow);
               
                $.each(data, function(key,val){
                  var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                  datahandler.append(Nrow);
                });
                
              }
            });
          @endif
        
        // Marketing
        
    });
    $('#kunci-tambah').on('change',function(){
        var checkBox = document.getElementById("kunci-tambah");
        var marketing = $('#tmb-marketing').val();
        var tanggal = $('#tmb-tanggal').val();
        if(marketing == ''){
            Toast.fire({
                icon    : 'error',
                title   : 'Marketing Wajib Diisi !!'
            });
        } else {
            if(!tanggal){
               Toast.fire({
                    icon    : 'error',
                    title   : 'Tanggal Wajib Diisi !!'
                }); 
            } else {
                if(checkBox.checked == true){
                    $.ajax({
                        method  : 'post',
                        url     : '{!! url("data-lapmarketing")!!}',
                        data    : {
                            token   : token,
                            marketing : marketing,
                            tanggal : tanggal,
                            user    : "{{$user->kode_karyawan}}",
                            
                        },
                        success : function(response){
                            if(response.success == true){
                                $('#kode-laporan').val(response.kode);
                                $('#tmb-marketing').prop('disabled',true);$('#btn-x').prop('disabled',true);$('#tmb-btn-cancel').prop('disabled',true);
                                $('#btn-tambah-data').show();$('tabel-tambah').empty();
                            } else {
                                Toast.fire({
                                    icon    : 'error',
                                    title   : response.pesan
                                });
                                return false;
                            }
                        }
                    });
                   
                }else {
                    $.ajax({
                        type    : 'get',
                        url     : '{!! url("hapus-laporan")!!}',
                        data    :{
                            marketing : marketing,
                            tanggal : tanggal,
                        },
                        success : function(response){
                            if(response.success == true){
                                $('#tabel-tambah').empty();
                            } else {
                                Toast.fire({
                                    icon    : 'error',
                                    title   : response.pesan
                                });
                            }
                        }
                    });
                    $('#tambah-data').hide();$('#edit-data').hide();$('#hapus-data').hide(); $('#btn-tambah-data').hide();
                    $('tabel-tambah').empty(); $('#tmb-marketing').prop('disabled',false);$('#btn-x').prop('disabled',false);$('#tmb-btn-cancel').prop('disabled',false);
                }        
            }
            
        }
        
    });
    //Tambah Data
        $('#btn-tambah-data').on('click',function(){
            $('#tambah-data').show(); $('#btn-tambah-data').hide();
            document.getElementById('tambah-data').reset();
            var marketing = $('#tmb-marketing').val();
            $('#tambah-perusahaan').select2({
              placeholder : 'Pilih Perusahaan',
              ajax  :{
                url : '{!! url("dropdown-perusahaan/'+marketing+'") !!}',
                dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nama_perusahaan,
                                  id: item.kode
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
        });
        $('#tambah-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#submit-tambah-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#kode-laporan').val();
            $.ajax({
                type    :'post',
                url     : '{!! url("data-detail-laporan") !!}',
                data    : {
                    token   : token,
                    jenis   : $('#tambah-jenis').val(),
                    kode    : $('#kode-laporan').val(),
                    jam     : $('#tambah-jam').val(),
                    perusahaan : $('#tambah-perusahaan').val(),
                    rekanan : $('#tambah-rekanan').val(),
                    laporan : $('#tambah-laporan').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        document.getElementById('tambah-data').reset();
                        tabeltambah(kode);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Tambah Data
    //Edit Data
        $(document).on('click','.editdata',function(){
            var data = $(this).data('kode');
            
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detail-laporan/'+data+'/edit")!!}',
                success : function(response){
                    if(response.success == true){
                        var marketing = $('#tmb-marketing').val();
                        $('#edit-perusahaan')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.perusahaan) //set value for option to post it
                            .text(response.data.nama_perusahaan)) //set a text for show in select
                        .val(response.data.perusahaan) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#edit-perusahaan').select2({
                          placeholder : 'Pilih Perusahaan',
                          ajax  :{
                            url : '{!! url("dropdown-perusahaan/'+marketing+'") !!}',
                            dataType: 'json',
                              processResults: function (data) {
                                  return {
                                      results: $.map(data, function (item) {
                                          return {
                                              text: item.nama_perusahaan,
                                              id: item.kode
                                          }
                                      })
                                  };
                              },
                              cache: true
                          }
                        });
                        $('#edit-kode').val(data);
                        $('#edit-jenis').empty();
                        if(response.data.jenis == 'laporan'){
                            $('#edit-jenis').append("<option value='"+response.data.jenis+"'>Laporan</option><option value='call'>Effectif Call</option>");
                        } else {
                            $('#edit-jenis').append("<option value='"+response.data.jenis+"'>Effectif Call</option><option value='laporan'>Laporan</option>");
                        }
                        
                        $('#edit-jam').val(response.data.jam);
                        $('#edit-rekanan').val(response.data.rekanan);
                        $('#edit-laporan').val(response.data.laporan);
                        $('#btn-tambah-data').hide();$('#tambah-data').hide();$('#hapus-data').hide();$('#edit-data').show();
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        })
                    }
                }
            });
        });
        $('#cancel-edit-data').on('click',function(){
            $('#edit-data').hide();$('#btn-tambah-data').show();
        });
        $('#edit-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#submit-edit-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edit-kode').val();
            var data = $('#kode-laporan').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detail-laporan/'+kode+'") !!}',
                data    : {
                    token   : token,
                    jenis   : $('#edit-jenis').val(),
                    jam     : $('#edit-jam').val(),
                    perusahaan : $('#edit-perusahaan').val(),
                    rekanan : $('#edit-rekanan').val(),
                    laporan : $('#edit-laporan').val(),
                    kode    : data,
                    user    : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        $('#edit-data').hide();$('#btn-tambah-data').show();
                        tabeltambah(data);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                } 
            });
        });
    //Edit Data
    //Hapus Data
        $(document).on('click','.hapusdata',function(){
            var data = $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detail-laporan/'+data+'/edit") !!}',
                success : function(response){
                    if(response.success == true){
                        $('#hapus-kode-data').val(data);
                        $('#hapus-perusahaan').html(response.data.nama_perusahaan);
                        // var paragraph = document.getElementById("hapus-perusahaan");
                        // var text = document.createTextNode(response.data.nama_perusahaan);
                        // paragraph.appendChild(text);
                        $('#btn-tambah-data').hide();$('#tambah-data').hide();$('#edit-data').hide();$('#hapus-data').show();
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
                
            });
        });
        $('#cancel-hapus-data').on('click',function(){
            $('#hapus-data').hide();$('#btn-tambah-data').show();
        });
        $('#hapus-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#submit-hapus-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#hapus-kode-data').val();
            $.ajax({
                type    : 'delete',
                url     : '{!! url("data-detail-laporan/'+kode+'") !!}',
                data    : {
                    token   : token,
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        $('#hapus-data').hide();$('#btn-tambah-data').show();
                        var kode = $('#kode-laporan').val();
                        tabeltambah(kode);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                } 
            });
        });
    //Hapus Data
    $('#tmb-btn-submit').on('click',function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#tmb-btn-submit');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var kode = $('#kode-laporan').val();
        $.ajax({
            type    : 'post',
            url     : '{!! url("input-laporan") !!}',
            data    : {
                token   : token,
                kode    :kode,
                user    : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#table-laporan').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            } 
        });
    });
  // Tambah Laporan
  // Edit Laporan
    $(document).on('click','.edit',function(){
      var kode = $(this).data('kode');
      $('#edt-tambah-data').hide();$('#edt-edit-data').hide();$('#edt-hapus-data').hide();
      $('#edt-btn-tambah-data').hide(); $('#edt-btn-x').prop('disabled',false);$('#edt-btn-cancel').prop('disbaled',false);$('#kunci-edit').prop('checked',false);
      $.ajax({
        url     : '{!! url("data-lapmarketing/'+kode+'/edit") !!}',
        type    : 'get',
        success:function(response){
          $('#edt-kode').val(kode);
          $('#edt-nama-marketing').val(response.data.nama);
          $('#edt-marketing').val(response.data.marketing);
          $('#edt-tanggal').val(response.data.tanggal);
          $('#tabel-edit').empty();
        }
      });
    });
    $("#kunci-edit").on('change',function(){
        var checkBox = document.getElementById("kunci-edit");
        var kode = $('#edt-kode').val();
        if(checkBox.checked == true){
           $('#edt-btn-x').prop('disabled',true);$('#edt-btn-cancel').prop('disabled',true);
           $('#edt-btn-tambah-data').show();$('#edt-tambah-data').hide();$('#edt-edit-data').hide(); $('#edt-hapus-data').hide();
           tabeledit(kode);
        }else {
            $('#edt-tambah-data').hide();$('#edt-edit-data').hide();$('#edt-hapus-data').hide(); $('#edt-btn-tambah-data').hide();
            $('#edt-btn-x').prop('disabled',false);$('#edt-btn-cancel').prop('disabled',false);
            $('#tabel-edit').empty();
        }   
    });
    $('#edt-btn-edit').on('click',function(){
      $('#modal-edit').modal('hide');
      var table = $('#table-laporan').DataTable(); 
      table.ajax.reload( null, false );
    });
    
    // Tambah Data
        $('#edt-btn-tambah-data').on('click',function(){
            $('#edt-tambah-data').show(); $('#edt-btn-tambah-data').hide();
            document.getElementById('edt-tambah-data').reset();
            var marketing = $('#edt-marketing').val();
            $('#edt-tambah-perusahaan').select2({
              placeholder : 'Pilih Perusahaan',
              ajax  :{
                url : '{!! url("dropdown-perusahaan/'+marketing+'") !!}',
                dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nama_perusahaan,
                                  id: item.kode
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
        });
        $('#edt-cancel-tambah-data').on('click',function(){
            $('#edt-tambah-data').hide();$('#edt-btn-tambah-data').show();
        });
        $('#edt-tambah-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-submit-tambah-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            $.ajax({
                type    : 'post',
                url     : '{!! url("data-detail-laporan") !!}',
                data    : {
                    token   : token,
                    jenis   : $('#edt-tambah-jenis').val(),
                    kode    : $('#edt-kode').val(),
                    jam     : $('#edt-tambah-jam').val(),
                    perusahaan : $('#edt-tambah-perusahaan').val(),
                    rekanan : $('#edt-tambah-rekanan').val(),
                    laporan : $('#edt-tambah-laporan').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        })
                        var kode = $('#edt-kode').val();
                        document.getElementById('edt-tambah-data').reset();
                        $('#edt-tambah-kode').hide(); $('#edt-btn-tambah-data').show();
                        tabeledit(kode);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        })
                    }
                }
            });
        })
    // Tambah Data
    
    // Edit Data
        $(document).on('click','.editdata',function(){
            $('#edt-tambah-data').hide(); $('#edt-hapus-data').hide(); $('#edt-btn-tambah-data').hide();
            var data = $(this).data('kode'); 
            
            $('#edt-edit-data').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detail-laporan/'+data+'/edit") !!}',
                success : function(response){
                    if(response.success == true){
                        $('#edt-edit-kode').val(data);
                        var marketing = $('#edt-marketing').val();
                        $('#edt-edit-perusahaan')
                        .empty() //empty select
                        .append($("<option/>") //add option tag in select
                            .val(response.data.perusahaan) //set value for option to post it
                            .text(response.data.nama_perusahaan)) //set a text for show in select
                        .val(response.data.perusahaan) //select option of select2
                        .trigger("change"); //apply to select2
                        $('#edt-edit-perusahaan').select2({
                          placeholder : 'Pilih Perusahaan',
                          ajax  :{
                            url : '{!! url("dropdown-perusahaan/'+marketing+'") !!}',
                            dataType: 'json',
                              processResults: function (data) {
                                  return {
                                      results: $.map(data, function (item) {
                                          return {
                                              text: item.nama_perusahaan,
                                              id: item.kode
                                          }
                                      })
                                  };
                              },
                              cache: true
                          }
                        });
                        $('#edt-edit-jenis').empty();
                        if(response.data.jenis == 'laporan'){
                            $('#edt-edit-jenis').append("<option value='"+response.data.jenis+"'>Laporan</option><option value='call'>Effectif Call</option>");
                        } else {
                            $('#edt-edit-jenis').append("<option value='"+response.data.jenis+"'>Effectif Call</option><option value='laporan'>Laporan</option>");
                        }
                        
                        $('#edt-edit-jam').val(response.data.jam);
                        $('#edt-edit-rekanan').val(response.data.rekanan);
                        $('#edt-edit-laporan').val(response.data.laporan);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan
                        })
                    }
                }
            });
        })
        $('#edt-edit-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-submit-edit-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-edit-kode').val();
            var data = $('#edt-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detail-laporan/'+kode+'")!!}',
                data    : {
                    token   : token,
                    jenis   : $('#edt-edit-jenis').val(),
                    perusahaan : $('#edt-edit-perusahaan').val(),
                    jam     : $('#edt-edit-jam').val(),
                    rekanan : $('#edt-edit-rekanan').val(),
                    laporan : $('#edt-edit-laporan').val(),
                    kode    : data,
                    user    : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        })
                        $('#edt-edit-data').hide(); $('#edt-btn-tambah-data');
                        tabeledit(data);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        })
                    }
                }
            })
        })
        $('#edt-cancel-edit-data').on('click',function(){
            $('#edt-tambah-data').show(); $('#edt-edit-data').hide(); $('#edt-btn-tambah-data').show(); 
        });
    // Edit Data
    
    // Hapus Data
        $(document).on('click','.hapusdata',function(){
            $('#edt-tambah-data').hide();$('#edt-edit-data').hide();$('#edt-btn-tambah-data').hide();$('#edt-hapus-data').show();
            var data = $(this).data('kode');  
            $.ajax({
                type    :'get',
                url     : '{!! url("data-detail-laporan/'+data+'/edit") !!}',
                success : function(response){
                    if(response.success == true){
                        $('#edt-hapus-kode-data').val(data);
                        var a  = $('#edt-hapus-kode-data').val();
                        $('#edt-hapus-perusahaan').html(response.data.nama_perusahaan);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan
                        })
                    }
                }
            });  
            
        });
        $('#edt-cancel-hapus-data').on('click',function(){
            $('#edt-hapus-data').hide();$('#edt-btn-tambah-data').show();
        })
        $('#edt-hapus-data').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-submit-hapus-data');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-hapus-kode-data').val();
            $.ajax({
                type    : 'delete',
                url     : '{!! url("data-detail-laporan/'+kode+'") !!}',
                data    : {
                    token   : token,
                    user    : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan
                        });
                        $('#edt-hapus-data').hide();$('#edt-btn-tambah-data').show();
                        var kode = $('#edt-kode').val();
                        tabeledit(kode);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                } 
            });
        });
    // Hapus Data
    
  // Edit Laporan
  // Detail Laporan
    $(document).on('click','.detail',function(){
      var kode = $(this).data('kode');
      $.ajax({
        url     : '{!! url("data-lapmarketing/'+kode+'/edit") !!}',
        type    : 'get',
        success:function(data){
          $('#dtl-marketing').val(data.data.nama);
          $('#dtl-tanggal').val(data.data.tanggal);
          $('#dtl-kode').val(kode);
          $('#dtl-status').val(data.data.status);
          if(data.data.status == "Belum Diperiksa"){
              @if($user->level == 'marketing')
                $('#dtl-btn-periksa').hide();
              @else
                $('#dtl-btn-periksa').show();
              @endif
          } else {
              $('#dtl-btn-periksa').hide();
          }
          tabeldetail(data.data.kode);
        }
      });
    });
    $('#dtl-btn-periksa').on('click',function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#dtl-btn-periksa');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var kode = $('#dtl-kode').val();
        $.ajax({
            type    : 'put',
            url     : '{!! url("konfirmasi-laporan/'+kode+'") !!}',
            data    : {
                token   : token,
                user    : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan
                    });
                    $('#modal-detail').modal('hide');
                    var table = $('#table-laporan').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            } 
        });
    });
  // Detail Laporan
  // Hapus Laporan
    $(document).on('click','.hapus', function(){
      var kode = $(this).data('kode');
      $('#hapus-kode').val(kode);
      $.ajax({
          type  : 'get',
          url   : '{!! url("data-lapmarketing/'+kode+'/edit")!!}',
          success: function(response){
             if(response.success == true){
                $('#data-hapus').html(response.data.tanggal+" - "+response.data.nama );
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : response.pesan,
                });
            } 
          }
      })
    });
    $('#form-hapus').submit(function(e){
      var kode = $('#hapus-kode').val();
      e.preventDefault(); // prevent actual form submit
      var el = $('#hps-btn-submit');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      $.ajax({
        type    :'delete',
        url     :'{!! url("data-lapmarketing/'+kode+'") !!}',
        data    :{ 
            token :token,
            user : "{{$user->kode_karyawan}}",
        },
        success:function(response){
            if(response.success == true){
                Toast.fire({
                    icon: 'success',
                    title: response.pesan
                })
                $('#modal-hapus').modal('hide');
                var table = $('#table-laporan').DataTable(); 
                table.ajax.reload( null, false );      
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : response.pesan
                })
            }
          
        }
      });
    });
  // Hapus Laporan
  
  
  //Re-class
    $(document).on('click','.re-belum',function(){
        var kode = $(this).data('kode');
        $.ajax({
            type    : 'put',
            url     : '{!! url("reclass-laporanmarketing/'+kode+'") !!}',
            data    : {
                token :token,
                user : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan,
                    })
                    var table = $('#table-laporan').DataTable(); 
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
  //Re-class

    function tabeltambah(kode){
        $.ajax({
          url :'{!! url("data-detail-laporan/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tabel-tambah').empty();
            var datahandler = $('#tabel-tambah');
            var n = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editdata' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusdata' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+response.data[n]['jenis']+"</td><td>"+response.data[n]['jam']+"</td><td>"+response.data[n]['nama_perusahaan']+"</td><td>"+response.data[n]['rekanan']+"</td><td>"+response.data[n]['laporan']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
    }
    function tabeledit(kode){
        $.ajax({
          url :'{!! url("data-detail-laporan/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tabel-edit').empty();
            var datahandler = $('#tabel-edit');
            var n = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editdata' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusdata' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+response.data[n]['jenis']+"</td><td>"+response.data[n]['jam']+"</td><td>"+response.data[n]['nama_perusahaan']+"</td><td>"+response.data[n]['rekanan']+"</td><td>"+response.data[n]['laporan']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
    }
    function tabeldetail(kode){
        $.ajax({
          url :'{!! url("data-detail-laporan/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tabel-detail').empty();
            var n = 0;
            var datahandler = $('#tabel-detail');
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                Nrow.html("<td>"+response.data[n]['jenis']+"</td><td>"+response.data[n]['jam']+"</td><td>"+response.data[n]['nama_perusahaan']+"</td><td>"+response.data[n]['rekanan']+"</td><td>"+response.data[n]['laporan']+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          }
        });
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

