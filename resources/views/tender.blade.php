<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Tender</title>
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
                    <h1>Instansi Tender</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="main">Home</a></li>
                      <li class="breadcrumb-item active">Instansi Tender</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row" id="menu"></div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                                Tambah instansi
                            </button>
                        </div>
                    </div>
                    <div class="row" id="instansi-tender-box">
                        @foreach($instansiTenders as $instansiTender)
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-{{ $instansiTender->warna }}">
                                <div class="inner">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4><strong>{{ $instansiTender->nama_instansi }}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-school"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('instansi', [$instansiTender->id_instansi, 'subinstansi']) }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->



          @include('layout/footer')


        </div>
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Instansi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-add">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_instansi">Nama Instansi</label>
                                <input type="text" class="form-control" id="nama_instansi" name="nama_instansi">
                            </div>
                            <div class="form-group">
                                <label for="warna">Warna</label>
                                <select class="form-control" id="warna" name="warna">
                                    <option value="primary">Biru</option>
                                    <option value="success">Hijau</option>
                                    <option value="info">Biru Muda</option>
                                    <option value="warning">Kuning</option>
                                    <option value="danger">Merah</option>
                                    <option value="secondary">Abu-abu</option>
                                    <option value="lightblue">Biru Muda</option>
                                    <option value="purple">Ungu</option>
                                    <option value="fuchsia">Fuchsia</option>
                                    <option value="pink">Merah Muda </option>
                                    <option value="maroon">Maroon</option>
                                    <option value="orange">Oranye</option>
                                    <option value="lime">Lime</option>
                                    <option value="teal">Teal</option>
                                    <option value="olive">Olive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
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
        <script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- Page specific script -->
        <script>
            $(document).ready(function() {
                $('#form-add').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '{{ route("instansi-tender.store") }}',
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    alert(value);
                                });
                            } else {
                                $('#modal-add').modal('hide');
                                alert(response.success);
                                location.reload();
                            }
                        }
                    });
                });
            });
            </script>
    </body>
</html>
