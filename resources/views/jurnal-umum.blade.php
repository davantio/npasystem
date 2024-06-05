    <!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Jurnal Umum</title>
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
            <h1>Jurnal Umum</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Jurnal Umum</li>
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
                <form id="filter">
                    <div class="row">
                        <div class="col-lg-3">
                            <label> Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl-awal">
                        </div>
                        <div class="col-lg-3">
                            <label> Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl-akhir">
                        </div>
                        <div class="col-lg-2">
                            <label for=""></label> <br>
                            <button type="submit" id="btn-submit" class="btn form-control btn-primary">Cari</button> 
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-jurnal" class="table table-striped">
                  <thead>
                    <tr>
                      <th rowspan="2" align="center">Tanggal</th>
                      <td colspan="2" align="center"><b>Perkiraan</b></td>
                      <th rowspan="2" align="center">DEBIT</th>
                      <th rowspan="2" align="center">KREDIT</th>
                      <th rowspan="2" align="center">Status</th>
                    </tr>
                    <tr>
                      <th align="center"></th>
                      <th align="center"></th>
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
<script src="{{asset('AdminLTE/plugins')}}/jszip/jszip.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {
     $('#tabel-jurnal').DataTable({
            paging      : true,
            lengthChange: true,
            info        : true,
            autoWidth   : true,
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
            dom: 'Blfrtip',
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var debit = aData.jumlah_debit;
                $('td:eq(3)', nRow).html('Rp. ' + debit);
                var kredit = aData.jumlah_kredit;
                $('td:eq(4)', nRow).html('Rp. ' + kredit);
            },
            processing: true,
            serverSide: true,
            ajax: '{!! url("jurnal") !!}',
            columns: [
                { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                { data: 'perkiraanD', name: 'perkiraanD',orderable:false, searchable:false},
                { data: 'perkiraanK', name: 'perkiraanK',orderable:false, searchable:false},
                { data: 'jumlah_debit', name: 'jumlah_debit',orderable:false, searchable:false},
                { data: 'jumlah_kredit', name: 'jumlah_kredit',orderable:false, searchable:false},
                { data: 'status', name: 'status',orderable:false, searchable:false},
            ]
        });
    
  }); 
  $('#filter').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-submit');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000); 
    $.ajax({
        type: 'GET',
        url: '{!! url("filter-jurnal") !!}',
        data : {
            awal      : $('#tgl-awal').val(),
            akhir     : $('#tgl-akhir').val()
        },
        success : function(response){
            console.log(response);
            $('#tabel-jurnal').DataTable().clear().destroy();
            $('#tabel-jurnal').DataTable({
                paging      : true,
                lengthChange: true,
                info        : true,
                autoWidth   : true,
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ],
                dom: 'Blfrtip',
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var debit = aData.jumlah_debit;
                    $('td:eq(3)', nRow).html('Rp. ' + debit);
                    var kredit = aData.jumlah_kredit;
                    $('td:eq(4)', nRow).html('Rp. ' + kredit);
                },
              data : response.data,
              columns : [
                { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                { data: 'perkiraanD', name: 'perkiraanD',orderable:false, searchable:false},
                { data: 'perkiraanK', name: 'perkiraanK',orderable:false, searchable:false},
                { data: 'jumlah_debit', name: 'jumlah_debit',orderable:false, searchable:false},
                { data: 'jumlah_kredit', name: 'jumlah_kredit',orderable:false, searchable:false},
                { data: 'status', name: 'status',orderable:false, searchable:false},
              ],
            });   
        }
    })
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

  var token = "{!! csrf_token() !!}";
 
  
 
</script>
</body>
</html>
