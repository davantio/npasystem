<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Barang Keluar</title>
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img/logo.png')}}" alt="AdminLTELogo" height="60" width="60">
        <h4><b> Nusa Pratama Anugerah </b></h4>
      </div>

      <!-- Navbar -->
      @include('layout/navbar')

      <!-- Sidebar -->
      @include('layout/sidebar')

      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Barang Keluar</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Barang Keluar</li>
                </ol>
              </div>
            </div>
          </div>
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
                        <button type="button" id="cek-filter" class="btn bg-gradient-success">Filter tanggal keluar</button>
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

                  <!-- Table -->
                  <div class="card-body table-responsive">
                    <table id="tabel-bk" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>No SO</th>
                          <th>Konsumen</th>
                          <th>Barang</th>
                          <th>Tanggal Kirim</th>
                          <th>Tanggal Terima</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Dynamic Content Will Be Populated Here -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
      @include('layout/footer')

    </div>

    <!-- JS Dependencies -->
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>

    <script>
      $(document).ready(function() {
        // Initialize DataTable
        var tabelMr = $('#tabel-bk').DataTable({
          paging: true,
          lengthChange: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          processing: true,
          serverSide: true,
          ajax: '{!! url("data-barang-keluar") !!}',
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode', name: 'kode' },
            { data: 'rekanan', name: 'rekanan' }, //Add nama rekanan
            { data: 'barang', name: 'barang' },
            { data: 'tgl_kirim', name: 'tgl_kirim' },
            { data: 'tgl_diterima', name: 'tgl_diterima' },
            { data: 'keterangan', name: 'keterangan' },
          ],

          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        // Show filter
        $('#cek-filter').on('click', function() {
          $('#filter').show();
          $('#cek-filter').hide();
          $('#cancel-filter').show();
        });

        // Hide filter
        $('#cancel-filter').on('click', function() {
          $('#filter').hide();
          tabelMr.ajax.url('{!! url("data-barang-keluar") !!}').load();
          $('#cek-filter').show();
          $('#cancel-filter').hide();
        });

        // Filter form submission
        $('#form-filter').submit(function(e) {
          e.preventDefault();
          var awal = $('#filter-awal').val();
          var akhir = $('#filter-akhir').val();
          tabelMr.ajax.url('{!! url("filter-barang-keluar") !!}?awal=' + awal + '&akhir=' + akhir).load();
        });
      });

      // Format Rupiah
      function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(money);
      }

      // Toast
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
    </script>

  </body>
</html>
