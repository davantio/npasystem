<!DOCTYPE html>
<html lang="en">
@include('layout/head')

<head>
    <title>Input Neraca</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins') }}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img') }}/logo.png" alt="AdminLTELogo" height="60"
                width="60">

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
                            <h1>Input Neraca</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Input Neraca</li>
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

                                        <button type="button" id="tambahdata" data-toggle="modal"
                                            data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah
                                            Neraca</button>

                                    </div>
                                    <br>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="tabel-neraca"
                                        class="table table-striped table-bordered table-hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Bank</th>
                                                <th>Perusahaan</th>
                                                <th>Jumlah</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Action</th>
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
        <!-- MODAL Tambah  -->
        <div class="modal fade" id="modal-tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Buat Transaksi Neraca</h4>
                        <button type="button" id="btn-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Data Neraca</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input id="tmb-tgl" class="form-control" type="date" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Kode Transaksi</label>
                                            <input id="tmb-kode" class="form-control" type="text" value=""
                                                readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Bank</label>
                                            <select id="tmb-debit" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <select id="tmb-perusahaan" class="form-control select2" required>
                                                <option value="">Pilih Perusahaan</option>
                                                <option value="npa">CV. Nusa Pratama Anugrah</option>
                                                <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                                <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="tmb-kode-debet-akun" class="form-control select2"
                                                required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="tmb-kode-kredit-akun" class="form-control select2"
                                                required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="tmb-keterangan" class="form-control" rows="2" style="resize: none;"
                                                placeholder="Keterangan Neraca"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="edit-id" value="">
                                <form id="tmbneraca">
                                    <div class="modal-footer justify-content-between ">
                                        <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit"
                                            id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--/ Modal Tambah -->

        <!-- MODAL Detail -->
        <div class="modal fade" id="modal-detail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Detail Transaksi Neraca</h4>
                        <button type="button" id="btn-x-detail" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Detail Data Neraca</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input id="detail-tgl" class="form-control" type="date" readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Kode Transaksi</label>
                                            <input id="detail-kode" class="form-control" type="text"
                                                value="" readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Bank</label>
                                            <span id="detail-debit" class="form-control" readonly></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <input id="detail-perusahaan" type="text" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="detail-jumlah" type="text" class="form-control" readonly>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <span id="detail-kode-debet-akun" class="form-control" readonly></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <span id="detail-kode-kredit-akun" class="form-control" readonly></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="detail-keterangan" class="form-control" rows="2" style="resize: none;" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="detail-id" value="">
                                <form id="detailneraca">
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" id="btn-close-detail-kas"
                                            class="col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="confirm-btn"
                                            class="col-sm-2 form-control btn btn-info">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL Detail -->


        <!-- MODAL Edit -->
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Transaksi Neraca</h4>
                        <button type="button" id="btn-x-edit" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Edit Data Neraca</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Tanggal</label>
                                            <input id="edt-tgl" class="form-control" type="date" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Kode Transaksi</label>
                                            <input id="edt-kode" class="form-control" type="text" value=""
                                                readonly required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Bank</label>
                                            <select id="edt-debit" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Perusahaan</label>
                                            <select id="edt-perusahaan" class="form-control select2" required>
                                                <option value="">Pilih Perusahaan</option>
                                                <option value="npa">CV. Nusa Pratama Anugrah</option>
                                                <option value="herbivor">PT. Herbivor Satu Nusa</option>
                                                <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="edt-jumlah" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="edt-kode-debet-akun" class="form-control select2"
                                                required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="edt-kode-kredit-akun" class="form-control select2"
                                                required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="edt-keterangan" class="form-control" rows="2" style="resize: none;"
                                                placeholder="Keterangan Neraca"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <form id="edtneraca">
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" id="btn-close-edit" class="col-sm-2 btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" id="btn-submit-edit"
                                            class="col-sm-2 form-control btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL Edit -->


        <!-- MODAL Hapus  -->
        <div class="modal fade" id="modal-hapus">
            <div class="modal-dialog modal-sm">
                <form id="hapus">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Hapus Transaksi Kas/Bank</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                Apakah Anda Yakin Akan Menghapus Data ini ?
                                <div class="row">
                                    <input id="hps-kode" class="form-control" type="text" required hidden>
                                    <label class=" col-md-3">KODE </label>
                                    <label class="col-md-1">:</label>
                                    <label class="col-md-8" id="hps_kode"> </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between ">
                            <button type="button" class="col-sm-4 btn btn-default"
                                data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-hapus"
                                class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--/ Modal Hapus  -->
        <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
            <div class="modal-dialog modal-sm">
                <form id="selesai">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Data Kas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        Apakah Anda Yakin Akan Mengupdate Status Data ini ?
                                        <div class="row">
                                          <input id="selesai-kode" class="form-control" type="text" required hidden>
                                          <label class=" col-md-3">KODE </label>
                                          <label class="col-md-1">:</label>
                                          <label class="col-md-8" id="selesai_kode" > 	</label>
                                        </div>
  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between ">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="btn-selesai" class=" col-sm-4 form-control btn btn-success">Selesai</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        <!--/ Modal Selesai -->
        <!--/ MODAL -->

        @include('layout/footer')


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins') }}/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('AdminLTE/plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/jszip/jszip.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('AdminLTE/plugins') }}/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist') }}/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $('#tabel-neraca').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    if (aData['status'] == "Sudah Diperiksa") {
                        $('td', nRow).css('background-color', 'Yellow');
                    } else if (aData['status'] == "Selesai") {
                        $('td', nRow).css('background-color', ' #00FF64');
                    } else {
                        $('td', nRow).css('background-color', '');
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                ajax: '{!! url('data-neraca') !!}',
                columns: [{
                        data: 'kode_transaksi',
                        name: 'kode_transaksi',
                        orderable: true
                    },
                    {
                        data: 'nama_bank',
                        name: 'nama_bank',
                        orderable: true
                    },
                    {
                        data: 'perusahaan',
                        name: 'perusahaan',
                        orderable: true
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',
                        orderable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: 'nama_perkiraan_debit',
                        name: 'nama_perkiraan_debit',
                        orderable: true
                    },
                    {
                        data: 'nama_perkiraan_kredit',
                        name: 'nama_perkiraan_kredit',
                        orderable: true
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var today = new Date();
        var tgl = today.getDate();
        if (tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9) {
            tgl = '0' + tgl;
        }
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + tgl;
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var time = date + ' ' + time;

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        var token = "{!! csrf_token() !!}";
        //TAMBAH DATA
        $(document).on('click', '#tambahdata', function() {
            $('#tmb-tgl').val('');
            $('#tmb-kode').val('');
            $('#tmb-debit').val('');
            $('#tmb-keterangan').val('');
            $('#kunci').prop('checked', false);
            $('#tmb-tgl').prop('disabled', false);
            $('#tmb-keterangan').prop('disabled', false);
            $('#tmb-debit').prop('disabled', false);
            $('#tmb-debit').select2({
                placeholder: 'Pilih Rekening Bank Terima',
                ajax: {
                    url: '{!! url('dropdown-bank') !!}',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.bank + " " + item.rekening + " " + item
                                        .atas_nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
        $('#tmb-kode-kredit-akun, #tmb-kode-debet-akun').select2({
            ajax: {
                url: '{!! url('dropdown-akuntansi') !!}',
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.kode + " - " + item.nama_perkiraan,
                                id: item.kode
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('#tmb-tgl').on('change', function() {
            var tgl = $(this).val();
            var th = tgl.substr(2, 2);
            var bln = tgl.substr(5, 2);
            var n = th + bln;
            $.ajax({
                url: '{!! url('lastkode-neraca') !!}',
                type: 'get',
                data: {
                    tanggal: n,
                },
                success: function(data) {
                    $('#tmb-kode').val(data);
                }
            });
        });

        $('#tmbneraca').submit(function(e) {
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah');
            el.prop('disabled', true);
            setTimeout(function() {
                el.prop('disabled', false);
            }, 4000);
            var tanggal = $('#tmb-tgl').val();
            var akun = $('#tmb-debit').val();
            var perusahaan = $('#tmb-perusahaan').val();
            var keterangan = $('#tmb-keterangan').val();
            var kode = $('#tmb-kode').val();
            var jumlah = $('#tmb-jumlah:visible').val();
            var debit = $('#tmb-kode-debet-akun').val();
            var kredit = $('#tmb-kode-kredit-akun').val();
            //Validasi
            if (tanggal == "") {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tanggal Wajib Diisi',
                });
                return false;
            } else {}
            if (perusahaan == "") {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Perusahaan Wajib Diisi',
                });
                return false;
            } else {}
            if (akun == null) {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Nama Bank Wajib Diisi',
                });
                return false;
            } else {}
            if (jumlah == "") {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Jumlah Wajib Diisi',
                });
                return false;
            } else {}
            if (keterangan == "") {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Keterangan Wajib Diisi',
                });
                return false;
            } else {}
            if (debit == null) {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debit Wajib Diisi',
                });
                return false;
            } else {}
            if (kredit == null) {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Kredit Wajib Diisi',
                });
                return false;
            } else {}
            //Validasi
            $.ajax({
                type: 'post',
                url: "{!! url('data-neraca') !!}",
                data: {
                    _token: token,
                    kode: $('#tmb-kode').val(),
                    tanggal: $('#tmb-tgl').val(),
                    akun: $('#tmb-debit').val(),
                    jumlah: $('#tmb-jumlah:visible').val(),
                    perusahaan: $('#tmb-perusahaan').val(),
                    debit: $('#tmb-kode-debet-akun:visible').val(),
                    kredit: $('#tmb-kode-kredit-akun:visible').val(),
                    keterangan: $('#tmb-keterangan').val(),

                    user: "{{ $user->kode_karyawan }}",
                },
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.pesan,
                        });
                        $('#modal-tambah').modal('hide');
                        var table = $('#tabel-neraca').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.pesan,
                        });
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan saat menyimpan data!',
                    });
                }
            });

        });
        //TAMBAH DATA

        //DETAIL DATA
        $(document).on('click', '.detail', function() {
            // Ambil kode dari atribut data
            let kode = $(this).data('kode');

            // Kosongkan form sebelumnya (opsional, jika perlu reset form setiap klik)
            $('#detailneraca')[0].reset();
            //$('#dlt-id').val(''); // Reset hidden ID field

            // Lakukan AJAX GET request untuk mengambil data
            $.ajax({
                url: `/input-neraca/${kode}/edit`, // Endpoint backend untuk mengambil data
                type: 'GET',
                success: function(response) {
                    if (response.success){
                        if (response.data.status === "Selesai" || response.data.status === "Sudah Diperiksa") {
                            $('#confirm-btn').prop('disabled', true);
                        } else {
                            $('#confirm-btn').prop('disabled', false);
                        }
                    }
                    if (response.success) {
                        // Isi data ke dalam modal
                        //$('#dlt-id').val(response.data.id); // Hidden ID
                        $('#detail-tgl').val(response.data.tanggal); // Tanggal
                        $('#detail-kode').val(response.data.kode); // Kode transaksi
                        $('#detail-debit')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.akun) //set value for option to post it
                                .text(response.data.bank_nama + " " + response.data.bank_rekening + " " + response.data.bank_atas_nama)) //set a text for show in select
                            .val(response.data.akun) //select option of select2
                            .trigger("change"); //apply to select2
                        //$('#edit-debit').val(response.data.kas_masuk).trigger('change'); // Debit kas
                        $('#detail-perusahaan').val(response.data.nama_perusahaan);
                        $('#detail-jumlah').val(response.data.jumlah);
                        $('#detail-keterangan').val(response.data.keterangan); // Keterangan

                        $('#detail-kode-debet-akun')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.debit) //set value for option to post it
                                .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                            .val(response.data.debit) //select option of select2
                            .trigger("change"); //apply to select2

                        $('#detail-kode-kredit-akun')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kredit) //set value for option to post it
                                .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                            .val(response.data.kredit) //select option of select2
                            .trigger("change"); //apply to select2
                    } else {
                        alert(response.pesan);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengambil data!');
                }
            });
        });

        //UPDATE STATUS
        $(document).on('submit', '#detailneraca', function(e) {
            e.preventDefault();

            //var el = $('#confirm-btn');
            let kode = $('#detail-kode').val();
            //const kode = $('#detail-kode').val(); // Ambil kode transaksi

            if (!kode) {
                alert('Kode transaksi tidak ditemukan!');
                return;
            }

            // Kirim data ke server untuk memperbarui status
            $.ajax({
                url: `/input-neraca/update-status/${kode}`, // Endpoint backend
                type: 'PUT',
                data: {
                    status: 'Sudah Diperiksa',
                    user: "{{ $user->kode_karyawan }}"
                },
                success: function(response) {
                    var hasil = response.pesan;
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: "Berhasil Konfirmasi"
                        })
                        $('#modal-detail').modal('hide');
                        var table = $('#tabel-neraca').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: hasil
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status.');
                }
            });
        });

        //END DETAIL DATA

        //EDIT DATA

        $(document).on('click', '.edit', function() {
            // Ambil kode dari atribut data
            let kode = $(this).data('kode');

            // Kosongkan form sebelumnya (opsional, jika perlu reset form setiap klik)
            $('#edtneraca')[0].reset();
            $('#edit-id').val(''); // Reset hidden ID field

            // Lakukan AJAX GET request untuk mengambil data
            $.ajax({
                url: `/input-neraca/${kode}/edit`, // Endpoint backend untuk mengambil data
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Isi data ke dalam modal
                        $('#edit-id').val(response.data.id); // Hidden ID
                        $('#edt-tgl').val(response.data.tanggal); // Tanggal
                        $('#edt-kode').val(response.data.kode); // Kode transaksi
                        $('#edt-debit')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.akun) //set value for option to post it
                                .text(response.data.bank_nama + " " + response.data.bank_rekening + " " + response.data.bank_atas_nama)) //set a text for show in select
                            .val(response.data.akun) //select option of select2
                            .trigger("change"); //apply to select2
                        $('#edt-debit').select2({
                            placeholder: "Pilih Rekening Bank Terima",
                            ajax: {
                                url: '{!! url('dropdown-bank') !!}',
                                dataType: 'json',
                                processResults: function(data) {
                                    return {
                                        results: $.map(data, function(item) {
                                            return {
                                                text: item.bank + " " + item
                                                    .rekening + " " + item
                                                    .atas_nama,
                                                id: item.kode
                                            }
                                        })
                                    };
                                },
                                cache: true
                            }
                        });
                        //$('#edit-debit').val(response.data.kas_masuk).trigger('change'); // Debit kas
                        $('#edt-perusahaan').val(response.data.perusahaan);
                        $('#edt-jumlah').val(response.data.jumlah);
                        $('#edt-keterangan').val(response.data.keterangan); // Keterangan

                        $('#edt-kode-debet-akun')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.debit) //set value for option to post it
                                .text(response.data.debit + " - " + response.data.nama_perkiraan_debit)) //set a text for show in select
                            .val(response.data.debit) //select option of select2
                            .trigger("change"); //apply to select2

                        $('#edt-kode-debet-akun').select2({
                            placeholder: "Pilih Kode Debit",
                            ajax: {
                                url: '{!! url('dropdown-akuntansi') !!}',
                                dataType: 'json',
                                processResults: function(data) {
                                    return {
                                        results: $.map(data, function(item) {
                                            return {
                                                text: item.kode + " - " + item
                                                    .nama_perkiraan,
                                                id: item.kode
                                            }
                                        })
                                    };
                                },
                                cache: true
                            }
                        });

                        $('#edt-kode-kredit-akun')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kredit) //set value for option to post it
                                .text(response.data.kredit + " - " + response.data.nama_perkiraan_kredit)) //set a text for show in select
                            .val(response.data.kredit) //select option of select2
                            .trigger("change"); //apply to select2

                        $('#edt-kode-kredit-akun').select2({
                            placeholder: "Pilih Kode Kredit",
                            ajax: {
                                url: '{!! url('dropdown-akuntansi') !!}',
                                dataType: 'json',
                                processResults: function(data) {
                                    return {
                                        results: $.map(data, function(item) {
                                            return {
                                                text: item.kode + " - " + item
                                                    .nama_perkiraan,
                                                id: item.kode
                                            }
                                        })
                                    };
                                },
                                cache: true
                            }
                        });
                    } else {
                        alert(response.pesan);
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengambil data!');
                }
            });
        });

        $(document).on('click', '#btn-submit-edit', function(e) {
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-submit-edit');
            el.prop('disabled', true);
            setTimeout(function() {
                el.prop('disabled', false);
            }, 4000);
            // Ambil data dari form
            let kode = $('#edt-kode').val(); // Kode transaksi sebagai identifikasi utama
            let formData = {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                tanggal: $('#edt-tgl').val(), // Tanggal
                akun: $('#edt-debit').val(),
                keterangan: $('#edt-keterangan').val(), // Keterangan
                debit: $('#edt-kode-debet-akun').val(),
                kredit: $('#edt-kode-kredit-akun').val(), // Kredit akun
                perusahaan: $('#edt-perusahaan').val(), // Atas nama
                jumlah: $('#edt-jumlah').val(), // Jumlah

                user: "{{ $user->kode_karyawan }}",
            };
            

            // Lakukan AJAX POST request untuk mengupdate data
            $.ajax({
                url: `/input-neraca/${kode}`, // Endpoint backend untuk update data
                type: 'PUT', // HTTP method PUT
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.pesan,
                        });
                        $('#modal-edit').modal('hide');
                        var table = $('#tabel-neraca').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.pesan,
                        });
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan saat menyimpan data!',
                    });
                }
            });

        });

        //SELESAI
        $(document).ready(function() {
            // Ketika tombol "Selesai" di dropdown diklik
            $('body').on('click', '.selesai', function() {
                var kode = $(this).data('kode');
                $('#selesai-kode').val(kode);
                $('#selesai_kode').html(kode);
            });

            $('#selesai').submit(function(e) {
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-selesai');
                el.prop('readonly', true);
                setTimeout(function() {
                    el.prop('readonly', false);
                }, 3000);
                var kode = $('#selesai-kode').val();
                $.ajax({
                    type: 'PUT',
                    url: `{{ url('data-neraca-selesai') }}/${kode}`, // URL diperbaiki
                    data: {
                        _token: '{{ csrf_token() }}', // Pastikan CSRF token dikirim
                        status: 'Selesai',
                        user: "{{ auth()->user()->kode_karyawan }}",
                    },
                    success: function(response) {
                        // console.log(response);
                        var hasil = response.pesan;
                        if (response.success) {
                            Toast.fire({
                                icon: 'success',
                                title: hasil
                            })
                            $('#modal-selesai').modal('hide');
                            var table = $('#tabel-neraca').DataTable();
                            table.ajax.reload(null, false);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: hasil
                            })
                        }

                    }
                });
            });
        });
        //END SELESAI


        //HAPUS DATA
        $('body').on('click', '.hapus', function() {
            var kode = $(this).data('kode');
            $('#hps-kode').val(kode);
            $('#hps_kode').html(kode);
        });
        $('#hapus').submit(function(e) {
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus');
            el.prop('readonly', true);
            setTimeout(function() {
                el.prop('readonly', false);
            }, 3000);
            var kode = $('#hps-kode').val();
            $.ajax({
                type: 'delete',
                url: '{!! url("data-neraca/'+kode+'") !!}',
                data: {
                    _token: token,
                    user: "{{ $user->kode_karyawan }}",
                },
                success: function(response) {
                    // console.log(response);
                    var hasil = response.pesan;
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: hasil
                        })
                        $('#modal-hapus').modal('hide');
                        var table = $('#tabel-neraca').DataTable();
                        table.ajax.reload(null, false);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: hasil
                        })
                    }

                }
            });
        });
        //HAPUS DATA

        function formatRupiah(money) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(money);
        }
    </script>
</body>

</html>
