<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Planning Mingguan Marketing</title>
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
            <h1 class="m-0">Planning Mingguan Marketing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Planning Mingguan Marketing</li>
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
                        @if($user->level == 'marketing')
                            <button type="button" data-toggle="modal" data-backdrop="static" data-target="#modal-tambah" class="btn btn-primary bg-gradient-primary" id="btn-tambah">Buat Planning</button>
                        @else
                            <button type="button" data-toggle="modal" data-backdrop="static" data-target="#modal-tambah" class="btn btn-primary bg-gradient-primary" id="btn-tambah">Buat Laporan</button>
                            <a href="laporan-marketing" class="btn btn-danger " id="laporan-marketing">Laporan Personal</a>
                        @endif
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive" >
                  <table id="table-planning" class="table  table-striped">
                    <thead>
                    <tr style="text-align:center;">
                      <th>Action</th>
                      <th>Marketing</th>
                      <th>Tanggal</th>
                      <th style="width: 40%;">Planning</th>
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
  <!-- MODAL -->
    <!-- MODAL Preview Laporan -->
      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog ">
          <div class="modal-content">
            <form id="form-detail">
              <div class="modal-header bg-info">
                <h4 class="modal-title">Planning Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <label> Nama Marketing</label>
                    <input type="text" id="dtl-kode" hidden>
                    <input type="text" class="form-control" id="dtl-marketing" disabled>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="dtl-tanggal-awal" disabled>
                  </div>
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="dtl-tanggal-akhir" disabled>
                  </div>
                </div>
                <br>
                <textarea class="form-control" rows="3" placeholder="Enter ..." id="dtl-plan" disabled="" style="height: 200px;"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn  btn-success" id="dtl-btn-submit">Konfirmasi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Modal Preview Laporan -->
    <!-- MODAL Tambah Laporan -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog ">
          <div class="modal-content">
            <form id="form-tambah">
              <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Planning Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <label> Nama Marketing</label>
                    <select class="form-control" id="tmb-marketing" required></select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label>Tanggal Awal</label>
                    <input type="date" id="tmb-tanggal-awal" class="form-control" required>
                  </div>
                  <div class="col-lg-6">
                    <label> Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tmb-tanggal-akhir" required>
                  </div>
                </div>
                <label> Laporan</label>
                <textarea class="form-control" rows="3" placeholder="" id="tmb-laporan" style="height: 200px;" required></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="tmb-btn-cancel" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="tmb-btn-submit" >Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Modal Tambah Laporan -->
    <!-- MODAL Edit Laporan -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog ">
          <div class="modal-content">
            <form id="form-edit">
              <div class="modal-header bg-warning">
                <h4 class="modal-title">Edit Planning Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <input type="text" id="edt-kode" hidden>
                    <label> Nama Marketing</label>
                    <input type="text" id="edt-marketing" class="form-control" disabled>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="edt-tanggal-awal" >
                  </div>
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="edt-tanggal-akhir" >
                  </div>
                </div>
                <br>
                <textarea class="form-control" rows="3" placeholder="" id="edt-plan" style="height: 200px;"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="edt-btn-cancel" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" id="edt-btn-submit" >Edit</button>
              </div>
            </form>
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
                <h4 class="modal-title">Hapus Data Planning</h4>
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
  $(document).ready(function() {   
    $('#table-planning').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-planmarketing") !!}',
        columns: [   
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'tanggal',name: 'tanggal',orderable:false},
            { data: 'plan', name: 'plan',orderable:true},
            { data: 'status', name: 'status',orderable:true},
        ]
    });
    
  }); 
  $('.select2').select2();
  //Laporan
  $('#btn-cek').on('click',function(e){

    var awal = $('#tanggal-awal').val();
    var akhir = $('#tanggal-akhir').val();

    if(awal == '' || akhir == '' ){
      alert('ISI tanggal yang akan dlihat');
      return false;
    } else {
      e.preventDefault(); // prevent actual form submit\
      var hasil = awal+akhir;
      var el = $(this);
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      $('#table-laporan').DataTable().clear().destroy();
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
        ajax: '{!! url("lap-marketing/'+hasil+'") !!}',
        columns: [   
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'laporan', name: 'laporan',orderable:true},
            { data: 'status', name: 'status',orderable:true},
        ]
      });
    }
    
  });
  //Tambah Data
    $(document).on('click','#btn-tambah',function(){
        document.getElementById('form-tambah').reset();
        $('#tmb-marketing').empty();
        @if($user->level == "marketing")
            $('#tmb-marketing').empty();
            var datahandler = $('#tmb-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option><option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
            datahandler.append(Nrow);
        @else
            $('#tmb-marketing').empty();
            $.ajax({
              url :'{!! url("dropdown-marketing") !!}',
              type : 'get',
              success : function(data){
                var datahandler = $('#tmb-marketing');
                var Nrow = $("<option value=''>Pilih Marketing</option>");
                datahandler.append(Nrow);
                var Nrow = $("<option value='-'>-</option>");
                datahandler.append(Nrow);
                $.each(data, function(key,val){
                  var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
                  datahandler.append(Nrow);
                });
                
              }
            });
        @endif

    });
    $('#form-tambah').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#tmb-btn-submit');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var token = "{!! csrf_token() !!}";
      var marketing = $('#tmb-marketing').val();
      var awal = $('#tmb-tanggal-awal').val();
      var akhir = $('#tmb-tanggal-akhir').val();
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
        url: '{!! url("data-planmarketing") !!}',
        data : {
          marketing   : marketing,
          awal        : awal,
          akhir        : akhir,
          time        : time,
          plan     : $('#tmb-laporan').val(),
          _token      : token,
          
        }, // serializes form input
        success:function(response) {
          // console.log(response);
          if(response.success == true){
            var hasil = response.pesan;
            Toast.fire({
              icon: 'success',
              title: hasil
            })
            $('#modal-tambah').modal('hide');
            var table = $('#table-planning').DataTable(); 
            table.ajax.reload( null, false );
          } else {
            var hasil = response.pesan;
            Toast.fire({
              icon: 'error',
              title: hasil
            })
          }
          
        }
      });
    });
  // Tambah Data
  // Edit Data
    $(document).on('click','.edit',function(){
      var kode = $(this).data('kode');
      $.ajax({
        url     : '{!! url("data-planmarketing/'+kode+'/edit") !!}',
        type    : 'get',
        success:function(data){
          // console.log(data);
          if(data.success == true){
            $('#edt-kode').val(kode);
            $('#edt-marketing').val(data.data.nama);
            $('#edt-tanggal-awal').val(data.data.awal);
            $('#edt-tanggal-akhir').val(data.data.akhir);
            $('#edt-plan').val(data.data.plan);
          } else {
            Toast.fire({
              icon: 'error',
              title: data.pesan
            })
          }
        }
      });
    });
    $('#form-edit').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#edt-btn-submit');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var token = "{!! csrf_token() !!}";
      var kode = $('#edt-kode').val();
      var tanggal = $('#edt-tanggal').val();
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
        url: '{!! url("data-planmarketing/'+kode+'") !!}',
        data : {
          awal        : $('#edt-tanggal-awal').val(),
          akhir       : $('#edt-tanggal-akhir').val(),
          time        : time,
          plan        : $('#edt-plan').val(),
          _token      : token,
          
        }, // serializes form input
        success:function(response) {
          // console.log(response);
          if(response.success == true){
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
            $('#modal-edit').modal('hide');
            var table = $('#table-planning').DataTable(); 
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
  // Edit Data
</script>
    @if($user->level == 'marketing')
  <!-- Detail Data-->
  <script>
    $(document).on('click','.detail',function(){
      var kode = $(this).data('kode');
      $('#dtl-btn-submit').hide();
      $.ajax({
        url     : '{!! url("data-planmarketing/'+kode+'/edit") !!}',
        type    : 'get',
        success:function(data){
          // console.log(data);
          if(data.success == true){
            $('#dtl-kode').val(kode);
            $('#dtl-marketing').val(data.data.nama);
            $('#dtl-tanggal-awal').val(data.data.awal);
            $('#dtl-tanggal-akhir').val(data.data.akhir);
            $('#dtl-plan').val(data.data.plan);
            
          } else {
            Toast.fire({
              icon: 'error',
              title: data.pesan
            })
          }
          
        }
      });
    });
  </script>
  <!-- Detail Data-->
    @else
    <!-- Detail Data-->
  <script>
    $(document).on('click','.detail',function(){
      var kode = $(this).data('kode');
      $('#dtl-btn-submit').hide();
      $.ajax({
        url     : '{!! url("data-planmarketing/'+kode+'/edit") !!}',
        type    : 'get',
        success:function(data){
          // console.log(data);
          if(data.success == true){
            $('#dtl-kode').val(kode);
            $('#dtl-marketing').val(data.data.nama);
            $('#dtl-tanggal-awal').val(data.data.awal);
            $('#dtl-tanggal-akhir').val(data.data.akhir);
            $('#dtl-plan').val(data.data.plan);
            if(data.data.status == 'Belum Diperiksa'){
              $('#dtl-btn-submit').show();
            }else if(data.data.status == 'Sudah Diperiksa'){
              $('#dtl-btn-submit').hide();
            }else{
              $('#dtl-btn-submit').hide();
            }
          } else {
            Toast.fire({
              icon: 'error',
              title: data.pesan
            })
          }
          
        }
      });
    });
    $('#form-detail').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#dtl-btn-submit');
      el.prop('disabled', true);
      var kode =$('#dtl-kode').val();
      $.ajax({
        url   :'{!! url("data-planmarketing/'+kode+'") !!}',
        type  : 'put',
        data  : {
          _token  : "{!! csrf_token() !!}",
          status : 'Sudah Diperiksa',
        },
        success:function(response){
          // console.log(response);
          if(response.success == true){
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
            $('#modal-detail').modal('hide');
            var table = $('#table-planning').DataTable(); 
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
  </script>
  <!-- Detail Data-->
    @endif

<script>
  // Hapus Data
    $(document).on('click','.hapus', function(){
      var kode = $(this).data('kode');
      $('#hapus-kode').val(kode);
    });
    $('#form-hapus').submit(function(e){
      var kode = $('#hapus-kode').val();
      e.preventDefault(); // prevent actual form submit
      var el = $('#hps-btn-submit');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      $.ajax({
        type    :'delete',
        url     :'{!! url("data-planmarketing/'+kode+'") !!}',
        data    :{ _token :'{!! csrf_token() !!}', },
        success:function(response){
          if(response.success == true){
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
            $('#modal-hapus').modal('hide');
            var table = $('#table-planning').DataTable(); 
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
  // Hapus Data


  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
</script>
</body>
</html>
