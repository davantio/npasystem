<!DOCTYPE html>
<html lang="en">

@include('layout/head')

<head>
    <title>Laporan Penjualan Marketing</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layout/navbar')
        @include('layout/sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Laporan Penjualan Marketing</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Laporan Penjualan Marketing</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form id="penjualan">
                                        <div class="row">
                                            <div class="col-lg-3 form-group">
                                                <label>Tanggal Awal</label>
                                                <input type="date" class="form-control" id="awal" name="awal" required>
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Tanggal Akhir</label>
                                                <input type="date" class="form-control" id="akhir" name="akhir" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Marketing</label>
                                                <select class="form-control select2" id="marketing" name="marketing"></select>
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <button type="submit" class="btn btn-primary mt-4" id="cari">Cari</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-body table-responsive">
                                    <table id="table-stock" class="table table-striped" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nomor Invoice</th>
                                                <th>Nama Customer</th>
                                                <th>Marketing</th>
                                                <th>Nama Produk</th>
                                                <th>QTY</th>
                                                <th>Harga Satuan</th>
                                                <th>DPP</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <p id="note" style="display: none;">Note: <br>*Jika invoice sudah <b>selesai</b> maka status akan <b>Lunas</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @include('layout/footer')
    </div>

    <!-- jQuery -->
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '{!! url("dropdown-marketing") !!}',
                type: 'get',
                success: function(data) {
                    var datahandler = $('#marketing');
                    var Nrow = $("<option value=''>Pilih Marketing</option>");
                    datahandler.append(Nrow);
                    $.each(data, function(key, val) {
                        var Nrow = $("<option value='" + val.kode + "'>" + val.nama + "</option>");
                        datahandler.append(Nrow);
                    });
                }
            });

            $('.select2').select2();

            $('#penjualan').submit(function(e) {
                e.preventDefault(); // prevent actual form submit
                var el = $('#cari');
                el.prop('disabled', true);
                setTimeout(function() {
                    el.prop('disabled', false);
                }, 4000);
                var awal = $('#awal').val();
                var akhir = $('#akhir').val();
                var marketing = $('#marketing').val();
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: '{{ url("lpj-penjualan-marketing") }}',
                    type: 'get',
                    data: {
                        _token: token,
                        awal: awal,
                        akhir: akhir,
                        marketing: marketing,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#table-stock').DataTable().clear().destroy();
                        $('#table-stock').DataTable({
                            dom: 'Blrtip',
                            buttons: [
                                { extend: 'copy', footer: true },
                                { extend: 'csv', footer: true },
                                { extend: 'excel', footer: true },
                                { extend: 'pdf', footer: true },
                                { extend: 'print', footer: true }
                            ],
                            data: response.data,
                            columns: [
                                { data: 'tanggal', name: 'tanggal' },
                                { data: 'kode_invoice', name: 'kode_invoice' },
                                { data: 'nama_rekanan', name: 'nama_rekanan' },
                                { data: 'nama_marketing', name: 'nama_marketing' },
                                { data: 'nama_barang', name: 'nama_barang' },
                                { data: 'diakui', name: 'diakui' },
                                { data: 'harga_jual', name: 'harga_jual' },
                                { data: 'dpp', name: 'dpp' },
                                { data: 'status_pembayaran_keterangan', name: 'status_pembayaran_keterangan' },
                            ],
                        });
                        $('#note').show();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
        });
    </script>
</body>

</html>
