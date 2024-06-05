<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Pengiriman </title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini" >
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
            <h1>Data Pengiriman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Pengiriman</li>
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
                <div class="row ">
                    <div class="col-lg-8 justify-content-between">
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah </button>    
                        <button type="button" id="btn-filter" class="btn btn-success">Filter</button>
                        <form id="filter">
                            
                            <div class="row form-group" id="form-filter">
                                <div class="col-lg-4">
                                    <label>Pengiriman Dari</label>
                                    <select id="filter-asal" class="form-control select2" required></select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Tujuan Pengiriman</label>
                                    <select id="filter-tujuan" class="form-control select2" required></select>
                                </div>
                                <div class="col-lg-4 justify-content-between">
                                    <br>
                                    <button type="button" id="cancel-filter" class="btn-default btn">Cancel</button>
                                    <button type="submit" id="submit-filter" class="btn-success btn">Filter</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <div class="col-lg-4">
                        <a><b id="last-update"></b></a>
                    </div>
                  
                  
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-pengiriman" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>KG</th>
                    <th>L</th>
                    <th>Ton</th>
                    <th>Pickup</th>
                    <th>CDD</th>
                    <th>Fuso</th>
                    <th>Tronton</th>
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
  <!-- MODAL Tambah -->
     <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form id="tambah">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data Pengiriman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="row form-group">
                            <div class="col-lg-6">
                                <label> Jenis</label>
                                <select id="tmb-jenis" class="form-control select2 " required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="ekspedisi">Ekspedisi</option>
                                    <option value="balen">Balen</option>
                                </select>
                                <label>Nama </label>
                                <select id="tmb-nama" class="form-control select2">
                                </select>
                                <input id="tmb-newnama"  class="form-control" type="text">
                            </div>
                            <div class="col-lg-6">
                                <label>Asal</label>
                                <select id="tmb-awal" class="form-control select2" required></select>
                                <label>Provinsi Tujuan</label>
                                <select id="tmb-prov-tujuan" class="form-control select2" required></select>
                                <label>Kota Tujuan</label>
                                <select id="tmb-kota-tujuan" class="form-control select2" required></select>
                            </div>
                        </div>
                        <hr>
                        <H4><b><u>Harga Pengiriman</u></b></H4>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Per-KG</label>
                                <input id="tmb-kg" class="form-control" type="number" min="0" placeholder="0">
                                <label>Per-L</label>
                                <input id="tmb-l" class="form-control" type="number" min="0" placeholder="0">
                                <label>Per-TON</label>
                                <input id="tmb-ton" class="form-control" type="number" min="0" placeholder="0">
                            </div>
                            <div class="col-lg-6">
                                <label>Pickup</label>
                                <input id="tmb-pickup" class="form-control" type="number" min="0" placeholder="0">
                                <label>CDD (5-8) Ton</label>
                                <input id="tmb-cdd" class="form-control" type="number" min="0" placeholder="0">
                                <label>Fuso</label>
                                <input id="tmb-fuso" class="form-control" type="number" min="0" placeholder="0">
                                <label>Tronton</label>
                                <input id="tmb-tronton" class="form-control" type="number" min="0" placeholder="0">
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-tambah" class=" col-sm-4 form-control btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <!-- /Modal Tambah-->
  <!-- Modal Detail -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Detail Data Pengiriman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row form-group">
                        <div class="col-lg-6">
                            <label> Jenis</label>
                            <input type="text" id="dtl-jenis" class="form-control" disabled>
                            <label>Nama </label>
                            <input id="dtl-nama"  class="form-control" type="text" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Asal</label>
                            <input id="dtl-awal"  class="form-control" type="text" disabled>
                            <label>Provinsi Tujuan</label>
                            <input id="dtl-prov-tujuan"  class="form-control" type="text" disabled>
                            <label>Kota Tujuan</label>
                            <input id="dtl-kota-tujuan"  class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <hr>
                    <H4><b><u>Harga Pengiriman</u></b></H4>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label>Per-KG</label>
                            <input id="dtl-kg" class="form-control" type="text" disabled>
                            <label>Per-L</label>
                            <input id="dtl-l" class="form-control" type="text" disabled>
                            <label>Per-TON</label>
                            <input id="dtl-ton" class="form-control" type="text" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Pickup</label>
                            <input id="dtl-pickup" class="form-control" type="text" disabled>
                            <label>CDD (5-8) Ton</label>
                            <input id="dtl-cdd" class="form-control" type="text" disabled>
                            <label>Fuso</label>
                            <input id="dtl-fuso" class="form-control" type="text" disabled>
                            <label>Tronton</label>
                            <input id="dtl-tronton" class="form-control" type="text" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  <!-- /Modal Detail  -->
  <!-- MODAL Edit  -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form id="edit">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Data </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="row form-group">
                            <div class="col-lg-6">
                                <label> Jenis</label>
                                <input type="hidden" id="edt-id">
                                <select id="edt-jenis" class="form-control select2 " required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="Ekspedisi">Ekspedisi</option>
                                    <option value="Balen">Balen</option>
                                </select>
                                <label>Nama </label>
                                <select id="edt-nama" class="form-control select2">
                                </select>
                                <input id="edt-newnama"  class="form-control" type="text">
                            </div>
                            <div class="col-lg-6">
                                <label>Asal</label>
                                <select id="edt-awal" class="form-control select2" required></select>
                                <label>Provinsi Tujuan</label>
                                <select id="edt-prov-tujuan" class="form-control select2" required></select>
                                <label>Kota Tujuan</label>
                                <select id="edt-kota-tujuan" class="form-control select2" required></select>
                            </div>
                        </div>
                        <hr>
                        <H4><b><u>Harga Pengiriman</u></b></H4>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Per-KG</label>
                                <input id="edt-kg" class="form-control" type="number" min="0" placeholder="0">
                                <label>Per-L</label>
                                <input id="edt-l" class="form-control" type="number" min="0" placeholder="0">
                                <label>Per-TON</label>
                                <input id="edt-ton" class="form-control" type="number" min="0" placeholder="0">
                            </div>
                            <div class="col-lg-6">
                                <label>Pickup</label>
                                <input id="edt-pickup" class="form-control" type="number" min="0" placeholder="0">
                                <label>CDD (5-8) Ton</label>
                                <input id="edt-cdd" class="form-control" type="number" min="0" placeholder="0">
                                <label>Fuso</label>
                                <input id="edt-fuso" class="form-control" type="number" min="0" placeholder="0">
                                <label>Tronton</label>
                                <input id="edt-tronton" class="form-control" type="number" min="0" placeholder="0">
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
  <!--/ Modal Edit  -->
  <!-- MODAL Hapus  -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Data Pengiriman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    Apakah Anda Yakin Akan Menghapus Data ini ?
                                    <input id="hps-id"  class="form-control" type="text" required hidden>
                                    <div class="row">
                                        <label class=" col-md-3">JENIS </label> 
                                        <label class=" col-md-1">: </label> 
                                        <label class="col-md-8" id="hps-jenis"></label>
                                    </div>
                                    <div class="row">
                                        <label class=" col-md-3">NAMA </label> 
                                        <label class=" col-md-1">: </label> 
                                        <label class="col-md-6" id="hps-nama"></label>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class=" col-md-5" id="hps-asal"></label> 
                                        <h6 class=" col-md-2" style="align:center;">TO </h6> 
                                        <label class=" col-md-5" id="hps-tujuan"></label>
                                    </div>
                                </div>
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
  <!-- Modal Import -->
    
  <!--/ Modal Import -->
<!--/ MODAL -->

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
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->

<script>
  $(document).ready(function() {
      @if($user->level == 'marketing')
          $('#tambahdata').hide();
      @else 
          $('#tambahdata').show();
      @endif
      $('#form-filter').hide();
    $('#tabel-pengiriman').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-pengiriman") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'nama', name: 'nama',orderable:true, searchable:true},
            { data: 'asal', name: 'asal',orderable:true, searchable:true},
            { data: 'tujuan', name: 'tujuan',orderable:true, searchable:true
                
            },
            { data: 'kg', name: 'kg',orderable:false, searchable:false},
            { data: 'l', name: 'l',orderable:false, searchable:false},
            { data: 'ton', name: 'ton',orderable:false, searchable:false},
            { data: 'pickup', name: 'pickup',orderable:false, searchable:false},
            { data: 'cdd', name: 'cdd',orderable:false, searchable:false},
            { data: 'fuso', name: 'fuso',orderable:false, searchable:false},
            { data: 'tronton', name: 'tronton',orderable:false, searchable:false},
        ]
    });
    
    $.ajax({
        type : 'get',
        url  : '{!! url("last-update-pengiriman") !!}',
        success:function(data){
          if(data.success == true){
              $('#last-update').html(data.data);
          } else {
              Toast.fire({
                  icon  : 'error',
                  title : data.pesan
              });
          }
        },
    });
  }); 
  $('.select2').select2();
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
  
  //Filter
    $('#btn-filter').on('click', function(){
        document.getElementById("filter").reset();
       
        $('#tambahdata').hide();
        $('#filter-asal').empty();
        $('#filter-tujuan').empty();
        $('#form-filter').show();
        $(this).hide();
        $('#filter-asal').select2({
            placeholder: 'Pilih Kota',
            ajax: {
              url: '{!! url("dropdown-kota") !!}',
              dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          if(item.kota == "Karawang"){
                            return {
                              text: item.kota+" (Cikampek)",
                              id: item.kota
                            }  
                          } else {
                            return {
                              text: item.kota,
                              id: item.kota
                            }   
                          }
                      })
                  };
              },
              cache: true
            }
        });
        $('#filter-tujuan').select2({
            placeholder: 'Pilih Kota',
            ajax: {
              url: '{!! url("dropdown-kota") !!}',
              dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          if(item.kota == "Karawang"){
                            return {
                              text: item.kota+" (Cikampek)",
                              id: item.kota
                            }  
                          } else {
                            return {
                              text: item.kota,
                              id: item.kota
                            }   
                          }
                      })
                  };
              },
              cache: true
            }
        });
    });
    $('#cancel-filter').on('click',function(){
        $('#form-filter').hide();
        var table = $('#tabel-pengiriman').DataTable();
        table.clear().destroy();
        $('#filter-asal').empty();
        $('#filter-tujuan').empty();
        @if($user->level == 'marketing')
        @else 
          $('#tambahdata').show();
        @endif
        $('#btn-filter').show();
        $('#tabel-pengiriman').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-pengiriman") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'nama', name: 'nama',orderable:true, searchable:true},
                { data: 'asal', name: 'asal',orderable:true, searchable:true},
                { data: 'tujuan', name: 'tujuan',orderable:true, searchable:true
                    
                },
                { data: 'kg', name: 'kg',orderable:false, searchable:false},
                { data: 'l', name: 'l',orderable:false, searchable:false},
                { data: 'ton', name: 'ton',orderable:false, searchable:false},
                { data: 'pickup', name: 'pickup',orderable:false, searchable:false},
                { data: 'cdd', name: 'cdd',orderable:false, searchable:false},
                { data: 'fuso', name: 'fuso',orderable:false, searchable:false},
                { data: 'tronton', name: 'tronton',orderable:false, searchable:false},
            ]
        });
    });
    $('#filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#submit-filter');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var filterAsal = $('#filter-asal').val();
        var filterTujuan = $('#filter-tujuan').val();
        $.ajax({
          url: '{!! url("filter-data-pengiriman") !!}',
          type: 'GET',
          data: {
              asal: filterAsal,
              tujuan: filterTujuan
          },
          success:function(response) {
              // console.log(response);
            if(response.success == true){
              var table = $('#tabel-pengiriman').DataTable();
              table.clear().destroy();
              $('#tabel-pengiriman').DataTable({
                  'paging'      : true,
                  'lengthChange': true,
                  'searching'   : true,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : false,
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    processing: true,
                    data : response.data.original.data,
                    columns: [         
                        { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                        { data: 'action', name: 'action',orderable:false, searchable:false},
                        { data: 'nama', name: 'nama',orderable:true, searchable:true},
                        { data: 'asal', name: 'asal',orderable:true, searchable:true},
                        { data: 'tujuan', name: 'tujuan',orderable:true, searchable:true
                            
                        },
                        { data: 'kg', name: 'kg',orderable:false, searchable:false},
                        { data: 'l', name: 'l',orderable:false, searchable:false},
                        { data: 'ton', name: 'ton',orderable:false, searchable:false},
                        { data: 'pickup', name: 'pickup',orderable:false, searchable:false},
                        { data: 'cdd', name: 'cdd',orderable:false, searchable:false},
                        { data: 'fuso', name: 'fuso',orderable:false, searchable:false},
                        { data: 'tronton', name: 'tronton',orderable:false, searchable:false},
                    ]
              });
            } else {
              Toast.fire({
                icon: 'error',
                title: response.pesan
              })
            }
          }
        });
        // Ambil nilai dari input filter
        
    
        // Hancurkan (destroy) DataTable sebelumnya
        
    
        // Inisialisasi DataTable kembali dengan URL baru berdasarkan filter
        
    });
  //Filter
  
  
  //Data Baru
  $(document).on('click','#tambahdata',function(){
    document.getElementById("tambah").reset();
    $('#tmb-nama').select2({
      placeholder: 'Pilih Nama',
      ajax: {
          url: '{!! url("dropdown-namapengiriman") !!}',
          dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.nama,
                          id: item.nama
                      }
                  })
              };
          },
          cache: true
      }
    });
    $('#tmb-awal').select2({
      placeholder: 'Pilih Kota',
      ajax: {
          url: '{!! url("dropdown-kota") !!}',
          dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      if(item.kota == "Karawang"){
                        return {
                          text: item.kota+" (Cikampek)",
                          id: item.kota
                        }  
                      } else {
                        return {
                          text: item.kota,
                          id: item.kota
                        }   
                      }
                  })
              };
          },
          cache: true
      }
    });
    $('#tmb-prov-tujuan').select2({
      placeholder: 'Pilih Provinsi',
      ajax: {
          url: '{!! url("dropdown-provinsi") !!}',
          dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.provinsi,
                          id: item.provinsi
                      }
                  })
              };
          },
          cache: true
      }
    });
    $('#tmb-prov-tujuan').on('change',function(){
        var prov = $(this).val();
        $('#tmb-kota-tujuan').select2({
            placeholder: 'Pilih Kota',
            ajax: {
                url: '{!! url("dropdown-kota/'+prov+'") !!}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                      results: $.map(data, function (item) {
                          if(item.kota == "Karawang"){
                            return {
                                text: item.kota+" (Cikampek)",
                                id: item.kota
                            }    
                          } else {
                            return {
                                text: item.kota,
                                id: item.kota
                            }   
                          }
                          
                      })
                    };
                },
                cache: true
            }
        });
    });
  });
  $('#tambah').submit(function(e){
    var form = $(this);
    
    // var data = new FormData(form[0]);
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-pengiriman") !!}',
      data : {
          _token    : token,
          jenis     : $('#tmb-jenis').val(),
          nama      : $('#tmb-nama').val(),
          newnama   : $('#tmb-newnama').val(),
          asal      : $('#tmb-awal').val(),
          prov      : $('#tmb-prov-tujuan').val(),
          tujuan    : $('#tmb-kota-tujuan').val(),
          kg        : $('#tmb-kg').val(),
          l         : $('#tmb-l').val(),
          ton       : $('#tmb-ton').val(),
          pickup    : $('#tmb-pickup').val(),
          cdd       : $('#tmb-cdd').val(),
          fuso      : $('#tmb-fuso').val(),
          troton    : $('#tmb-tronton').val(),
          user  : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        if(response.success == true){
          var hasil = response.pesan;
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel-pengiriman').DataTable();
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
  //Data Baru
//   
//   $('#hapus').submit(function(e){
//     e.preventDefault(); // prevent actual form submit
//     var el = $('#btn-hapus');
//     el.prop('readonly', true);
//     setTimeout(function(){el.prop('readonly', false); }, 3000);
//     var token = "{!! csrf_token() !!}";
//     var kode = $('#hps_kode_brg').val();
//     // console.log(kode);
//     $.ajax({
//       type    : 'delete',
//       url     : '{!! url("data-/'+kode+'") !!}',
//       data    : {
//         _token  : token,
//         user  : "{{$user->kode_karyawan}}",
//       },
//       success:function(response) {
//         // console.log(response);
//         if(response.success == true){
//           var hasil = response.pesan;
//           Toast.fire({
//             icon: 'success',
//             title: hasil
//           })
//           $('#modal-hapus').modal('hide');
//           var table = $('#tabel-').DataTable(); 
//           table.ajax.reload( null, false );
//         }else {
//           Toast.fire({
//             icon: 'success',
//             title: response.pesan
//           })
//         }
        
//       }
//     });
//   });
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-pengiriman/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          if(response.success == true){
            $('#dtl-jenis').val(response.result.jenis);
            $('#dtl-nama').val(response.result.nama);
            $('#dtl-awal').val(response.result.asal);
            $('#dtl-prov-tujuan').val(response.result.prov_tujuan);
            $('#dtl-kota-tujuan').val(response.result.tujuan);
            $('#dtl-kg').val(formatRupiah(response.result.kg));
            $('#dtl-l').val(formatRupiah(response.result.l));
            $('#dtl-ton').val(formatRupiah(response.result.ton));
            $('#dtl-pickup').val(formatRupiah(response.result.pickup));
            $('#dtl-cdd').val(formatRupiah(response.result.cdd));
            $('#dtl-fuso').val(formatRupiah(response.result.fuso));
            $('#dtl-tronton').val(formatRupiah(response.result.tronton));
          } else {
              Toast.fire({
                  icon  : "error",
                  title : response.pesan
              })
          }
          
        }
      });
  });
  //EDIT
  $('body').on('click','.edit',function () {
      var kode = $(this).data('kode');
      document.getElementById("edit").reset();
      $.ajax({
        url :'{!! url("data-pengiriman/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          // console.log(response);
          if(response.success == true){
            $('#edt-id').val(kode);
            $('#edt-jenis')
              .append($("<option/>")
                  .val(response.result.jenis) 
                  .text(response.result.jenis ))
              .val(response.result.jenis) 
              .trigger("change"); 
            $('#edt-nama').empty();
            $('#edt-nama').select2({
              placeholder: 'Pilih Nama',
              ajax: {
                  url: '{!! url("dropdown-namapengiriman") !!}',
                  dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nama,
                                  id: item.nama
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
            $('#edt-nama')
              .empty()
              .append($("<option/>")
                  .val(response.result.nama) 
                  .text(response.result.nama ))
              .val(response.result.nama) 
              .trigger("change"); 
            $('#edt-awal').select2({
              placeholder: 'Pilih Kota',
              ajax: {
                  url: '{!! url("dropdown-kota") !!}',
                  dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.kota,
                                  id: item.kota
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
            $('#edt-awal')
              .empty()
              .append($("<option/>")
                  .val(response.result.asal) 
                  .text(response.result.asal ))
              .val(response.result.asal) 
              .trigger("change"); 
            $('#edt-prov-tujuan').select2({
              placeholder: 'Pilih Provinsi',
              ajax: {
                  url: '{!! url("dropdown-provinsi") !!}',
                  dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.provinsi,
                                  id: item.provinsi
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
            $('#edt-prov-tujuan')
              .empty()
              .append($("<option/>")
                  .val(response.result.prov_tujuan) 
                  .text(response.result.prov_tujuan ))
              .val(response.result.prov_tujuan) 
              .trigger("change"); 
            $('#edt-prov-tujuan').on('change',function(){
                var prov = $(this).val();
                $('#edt-kota-tujuan').select2({
                    placeholder: 'Pilih Kota',
                    ajax: {
                        url: '{!! url("dropdown-kota/'+prov+'") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                              results: $.map(data, function (item) {
                                  return {
                                      text: item.kota,
                                      id: item.kota
                                  }
                              })
                            };
                        },
                        cache: true
                    }
                });
            });
            $('#edt-kota-tujuan').select2({
              placeholder: 'Pilih Kota Tujuan',
              ajax: {
                  url: '{!! url("dropdown-kota/'+response.result.prov_tujuan+'") !!}',
                  dataType: 'json',
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.kota,
                                  id: item.kota
                              }
                          })
                      };
                  },
                  cache: true
              }
            });
            $('#edt-kota-tujuan')
              .empty()
              .append($("<option/>")
                  .val(response.result.tujuan) 
                  .text(response.result.tujuan ))
              .val(response.result.tujuan) 
              .trigger("change"); 
            $('#edt-kg').val(response.result.kg);
            $('#edt-l').val(response.result.l);
            $('#edt-ton').val(response.result.ton);
            $('#edt-pickup').val(response.result.pickup);
            $('#edt-cdd').val(response.result.cdd);
            $('#edt-fuso').val(response.result.fuso);
            $('#edt-tronton').val(response.result.tronton);
          } else {
              Toast.fire({
                  icon  : "error",
                  title : response.pesan
              })
          }
          
        }
      });
  });
  
  //EDIT SUBMIT
  $('#edit').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edt-id').val();
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-pengiriman/'+kode+'") !!}',
      data : {
        nama : $('#edt-nama').val(),
        newnama : $('#edt-newnama').val(),
        _token : token,
        jenis : $('#edt-jenis').val(),
        asal : $('#edt-awal').val(),
        prov : $('#edt-prov-tujuan').val(),
        tujuan : $('#edt-kota-tujuan').val(),
        kg : $('#edt-kg').val(),
        l : $('#edt-l').val(),
        ton : $('#edt-ton').val(),
        pickup : $('#edt-pickup').val(),
        cdd : $('#edt-cdd').val(),
        fuso : $('#edt-fuso').val(),
        tronton : $('#edt-tronton').val(),
        user  : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        // console.log(response);
        if(response.success == true){
          var hasil = response.pesan;
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-pengiriman').DataTable(); 
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
  // EDIT SUBMIT
  // HAPUS
    $('body').on('click', '.hapus', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-pengiriman/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            // console.log(response);
          if(response.success == true){
            $('#hps-id').val(kode);
            $('#hps-jenis').html(response.result.jenis);
            $('#hps-nama').html(response.result.nama);
            $('#hps-asal').html(response.result.asal);
            $('#hps-tujuan').html(response.result.tujuan);
          } else {
              Toast.fire({
                  icon  : "error",
                  title : response.pesan
              })
          }
        }
      });
    });
    
    //SUBMIT HAPUS
    $('#hapus').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-hapus');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        var kode = $('#hps-id').val();
        $.ajax({
          type: 'delete',
          url: '{!! url("data-pengiriman/'+kode+'") !!}',
          data : {
            _token  : token,
            user : "{{$user->kode_karyawan}}",
          }, // serializes form input
          success:function(response) {
            // console.log(response);
            if(response.success == true){
              var hasil = response.pesan;
              Toast.fire({
                icon: 'success',
                title: hasil
              })
              $('#modal-hapus').modal('hide');
              var table = $('#tabel-pengiriman').DataTable(); 
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
  // HAPUS
  
  function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
  }
  
  function resettable(){
      var table = $('#tabel-pengiriman');
      table.DataTable().clear().destroy();
      table.DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! url("filter-data-pengiriman") !!}',
                type: 'post',
                data: {
                    _token : "{{ csrf_token() }}",
                    asal   : $('#filter-asal').val(),
                    tujuan : $('#filter-tujuan').val(),
                },
                success : function (a){
                    // console.log(a);
                }
            },
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'nama', name: 'nama',orderable:true, searchable:true},
                { data: 'asal', name: 'asal',orderable:true, searchable:true},
                { data: 'tujuan', name: 'tujuan',orderable:true, searchable:true},
                { data: 'kg', name: 'kg',orderable:false, searchable:false},
                { data: 'l', name: 'l',orderable:false, searchable:false},
                { data: 'ton', name: 'ton',orderable:false, searchable:false},
                { data: 'pickup', name: 'pickup',orderable:false, searchable:false},
                { data: 'cdd', name: 'cdd',orderable:false, searchable:false},
                { data: 'fuso', name: 'fuso',orderable:false, searchable:false},
                { data: 'tronton', name: 'tronton',orderable:false, searchable:false},
            ]
        });
  }
  
  
</script>
</body>
</html>
