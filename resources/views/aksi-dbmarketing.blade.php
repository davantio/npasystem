<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Aksi Database Marketing</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
    
    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div> 
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
            <h1 class="m-0">Aksi Database Marketing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Aksi Database Marketing</li>
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
                    <form id="filter">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" id="awal" required>
                            </div>
                            <div class="col-lg-3">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" id="akhir" required>
                            </div>
                            <div class="col-lg-3">
                                <label>Marketing</label>
                                <select class="form-control select2" id="marketing"></select>
                            </div>
                            <div class="col-lg-3">
                                <br>
                                <button type="submit" id="btn-submit" class="form-control btn btn-primary">Filter</button>
                            </div>
                        </div>    
                    </form>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <br>
                  <table id="tabel-aksi" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Marketing</th>
                      <th>Perusahaan</th>
                      <th>Kategori</th>
                      <th>laporan</th>
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
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>

<script>
    
    
    $(document).ready(function() {   
        $('#tabel-aksi').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-aksidbmarketing") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'tanggal', name: 'tanggal',orderable:true, searchable:true},
                { data: 'marketing', name: 'marketing',orderable:true, searchable:true},
                { data: 'perusahaan', name: 'perusahaan',orderable:false, searchable:true},
                { data: 'kategori', name: 'kategori',orderable:false, searchable:true},
                { data: 'laporan', name: 'laporan',orderable:false, searchable:false},
            ]
        });
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
    }); 
    $('#filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-submit');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        var marketing = $('#marketing').val(); 
        $.ajax({
          type : 'get',
          url  : '{!! url("filter-aksi-dbmarketing")!!}',
          data : {
            _token : token,
            awal     : $('#awal').val(),
            akhir    : $('#akhir').val(),
            marketing   : marketing,
          },
          success : function(response){
            $('#tabel-aksi').DataTable().clear().destroy();
            $('#tabel-aksi').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              data : response.data.original.data,
              columns : [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'tanggal', name: 'tanggal',orderable:true, searchable:true},
                { data: 'marketing', name: 'marketing',orderable:true, searchable:true},
                { data: 'perusahaan', name: 'perusahaan',orderable:false, searchable:true},
                { data: 'kategori', name: 'kategori',orderable:false, searchable:true},
                { data: 'laporan', name: 'laporan',orderable:false, searchable:false},
              ],
            });
          }
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

  function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    } 


</script>
</body>
</html>
