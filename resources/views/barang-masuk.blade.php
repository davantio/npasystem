<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Barang Masuk</title>
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
                <h1>Barang Masuk</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Barang Masuk</li>
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
                        <div>
                            <button type="button" id="cancel-filter" class="btn btn-default">Cancel</button>
                            <button type="button" id="cek-filter" class="btn bg-gradient-success">Filter tanggal masuk</button>
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
                                <br>
                                <button type="submit" class="btn btn-primary" id="btn-submit-filter">Cari</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.card-header -->
                  <!-- Table -->
                  <div class="card-body table-responsive">
                    <table id="tabel-mr" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th style="min-width:50px">No.</th>
                            <th>Perusahaan</th>
                            <th>No MR</th>
                            <th>No Transaksi</th>
                            <th style="min-width:100px">Tanggal</th>
                            <th style="min-width:200px">Rekanan</th>
                            <th style="min-width:300px">Barang</th>
                          </tr>
                      </thead>
                      <tbody>
                        <!-- Dynamic Content Will Be Populated Here -->
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
          // Initialize table without filter
          var tabelMr = $('#tabel-mr').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-barang-masuk") !!}',
            columnDefs: [
            {
                targets: 5, // Ganti dengan nomor indeks kolom yang ingin dibatasi
                render: function(data, type, row) {
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
            ajax: '{!! url("data-barang-masuk") !!}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'perusahaan', name: 'perusahaan',orderable:true},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'transaksi', name: 'transaksi',orderable:true},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'nama', name: 'nama',orderable:true},
                { data: 'barang', name: 'barang',orderable:false},
            ]
        });

          // Show filter form
          $('#cek-filter').on('click', function() {
            $('#filter').show();
            $('#cek-filter').hide();
            $('#cancel-filter').show();
          });

          // Hide filter form
          $('#cancel-filter').on('click', function() {
            $('#filter').hide();
            $('#tabel-mr').DataTable().clear().draw();
            $('#cek-filter').show();
            $('#cancel-filter').hide();
          });

          // Filter the data
          $('#form-filter').submit(function(e) {
            e.preventDefault();
            var awal = $('#filter-awal').val();
            var akhir = $('#filter-akhir').val();
            tabelMr.ajax.url('{!! url("filter-barang-masuk") !!}?awal=' + awal + '&akhir=' + akhir).load();
          });
        });

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
