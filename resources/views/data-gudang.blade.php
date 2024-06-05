<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Gudang</title>
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
            <h1>Data Gudang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Gudang</li>
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
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tmb-gdg"class="btn bg-gradient-primary">Tambah Gudang</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-gudang" class="table  table-striped">
                  <thead>
                  <tr>
                    <th class="col-lg-1">No</th>
                    <th class="col-lg-2">Action</th>
                    <th class="col-lg-1">Kode</th>
                    <th class="col-lg-2">Nama Gudang</th>
                    <th class="col-lg-5">Alamat</th>
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
  <!-- MODAL Tambah Gudang -->
    <div class="modal fade" id="modal-tmb-gdg">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <form id="tmbgdg">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Data Gudang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <b><span aria-hidden="true">&times;</span></b>
                      </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                          <label>Kode Gudang</label>
                          <input id="tmb_kode_gdg" class="form-control" type="text" required>
                          <label>Nama Gudang </label>
                          <input id="tmb_nama_gdg" class="form-control" type="text" required>
                          <label>Alamat</label>
                          <textarea id="tmb_alamat_gdg" class="form-control" rows="4" required placeholder="Alamat Gudang""></textarea>
                        </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-tambah" class=" col-sm-4 form-control btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Tambah Gudang -->
  <!-- Modal Detail Gudang -->
    <div class="modal fade" id="modal-dtl-gdg">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Data Gudang</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Gudang</label>
                        <input id="dtl_kode_gdg" class="form-control" type="text" readonly>
                        <label>Nama Gudang </label>
                        <input id="dtl_nama_gdg" class="form-control" type="text" readonly>
                        <label>Alamat</label>
                        <textarea id="dtl_alamat_gdg" class="form-control" rows="4" placeholder="Alamat"" readonly></textarea>
                    </div>
              </div>
              <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>
  <!-- /Modal Detail Gudang -->
  <!-- MODAL Edit Gudang -->
    <div class="modal fade" id="modal-edt-gdg">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="edtgdg">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Data Gudang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group">
                              <label>Kode Gudang</label>
                              <input id="edt_kode_gdg" class="form-control" type="text" required readonly>
                              <label>Nama Gudang </label>
                              <input id="edt_nama_gdg" class="form-control" type="text" required>
                              <label>Alamat</label>
                              <textarea id="edt_alamat_gdg" class="form-control"  rows="4" placeholder="Alamat" required></textarea>
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
  <!--/ Modal Edit Gudang -->
  <!-- MODAL Hapus Gudang -->
    <div class="modal fade" id="modal-hps-gdg">
        <div class="modal-dialog modal-sm">
            <form id="hpsgdg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Data Gudang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          Apakah Anda Yakin Akan Menghapus Data ini ?
                          <div class="row">
                              <input id="hps_kode_gdg" class="form-control" type="text" required hidden>
                              <label class=" col-md-3">KODE </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8" id="hps_kode" > 	</label>
                          </div>
                          <div class="row">
                              <label class=" col-md-3">Nama </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8"id="hps_nama_gdg" ></label>
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
  <!--/ Modal Hapus Gudang -->
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
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {   
    $('#tabel-gudang').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-gudang") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'alamat', name: 'alamat',orderable:true},
            
        ]
    });
  }); 
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
  $(document).on('click','#tambahdata',function(){
    document.getElementById("tmbgdg").reset();
  });
  $('#tmbgdg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-gudang") !!}',
      data : {
        nama : $('#tmb_nama_gdg').val(),
        _token : token,
        kode : $('#tmb_kode_gdg').val(),
        alamat : $('#tmb_alamat_gdg').val(),
        user    : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tmb-gdg').modal('hide');
          var table = $('#tabel-gudang').DataTable(); 
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
  $('#edtgdg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edt_kode_gdg').val();
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-gudang/'+kode+'") !!}',
      data : {
        nama    : $('#edt_nama_gdg').val(),
        kode    : kode,
        _token  : token,
        alamat  : $('#edt_alamat_gdg').val(),
        user    : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        // // console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edt-gdg').modal('hide');
          var table = $('#tabel-gudang').DataTable(); 
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
  $('#hpsgdg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#hps_kode_gdg').val();
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-gudang/'+kode+'") !!}',
      data    : {
        _token  : token,
        user    : "{{$user->kode_karyawan}}",
      },
      success:function(response) {
        // // console.log(response);
        var hasil = response.pesan;
        if(response.success){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hps-gdg').modal('hide');
          var table = $('#tabel-gudang').DataTable(); 
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
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-gudang/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          $('#dtl_kode_gdg').val(response.result.kode);
          $('#dtl_nama_gdg').val(response.result.nama);
          $('#dtl_alamat_gdg').val(response.result.alamat);   
        }
      });
  });
  $('body').on('click', '.edit', function () {
    var kode = $(this).data('kode');
    document.getElementById("edtgdg").reset();
    $.ajax({
      url :'{!! url("data-gudang/'+kode+'/edit") !!}',
      type : 'get',
      success : function(response){
        $('#edt_kode_gdg').val(response.result.kode);
        $('#edt_nama_gdg').val(response.result.nama);
        $('#edt_alamat_gdg').val(response.result.alamat);
      }
    });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("hpsgdg").reset();
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      document.getElementById("hps_kode").innerHTML = kode;
      document.getElementById("hps_nama_gdg").innerHTML = nama;
      $('#hps_kode_gdg').val(kode);
  });
</script>
</body>
</html>
