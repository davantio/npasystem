<!DOCTYPE html>
<html lang="en">
@include('layout.head')
<head>
    <title>Subinstansi Tender</title>
</head>
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<body class="hold-transition sidebar-mini">
    @include('layout.navbar')
    @include('layout.sidebar')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>{{ $instansi->nama_instansi }}</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('tender') }}">Instansi Tender</a></li>
                        <li class="breadcrumb-item active">{{ $instansi->nama_instansi }}</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
              <section class="content">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">Tambah Subinstansi</button>
                    <div class="table-responsive">
                        <table id="subinstansi-table" class="table table-bordered table-striped table-hover nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Subinstansi</th>
                                    <th>Pengadaan</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Tgl Deadline</th>
                                    <th>Tgl Pengumuman</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        @include('layout.footer')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form-subinstansi" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_instansi" value="{{ $instansi->id_instansi }}">
                <input type="hidden" name="_method" id="form-method" value="POST">
                <input type="hidden" name="id_subinstansi" id="id_subinstansi">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-addLabel">Tambah Subinstansi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_instansi">Nama Instansi</label>
                                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="{{ $instansi->nama_instansi }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_subinstansi">Nama Subinstansi</label>
                                    <input type="text" class="form-control" id="nama_subinstansi" name="nama_subinstansi" placeholder="Masukkan Nama Subinstansi" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="perusahaan">Perusahaan</label>
                            <select class="form-control" id="perusahaan" name="perusahaan" required>
                                <option value="">Pilih Perusahaan</option>
                                <option value="herbivor">PT HERBIVOR SATU NUSA</option>
                                <option value="npa">CV NUSA PRATAMA ANUGRAH</option>
                                <option value="triputra">PT TRIPUTRA SINERGI INDONESIA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukkan lokasi" required >
                        </div>
                        <div class="form-group">
                            <label for="link_tender">Link Tender</label>
                            <input type="text" class="form-control" id="link_tender" name="link_tender" placeholder="Masukkan link tender" required >
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pic_tender">PIC Tender</label>
                                    <input type="text" class="form-control" id="pic_tender" name="pic_tender" placeholder="Masukkan pic tender" required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Masukkan nomor pic" required >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pengadaan">Nama Pengadaan </label>
                            <input type="text" class="form-control" id="pengadaan" name="pengadaan" placeholder="Masukkan nama pengadaan barang" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_tender">Jenis Tender</label>
                            <select class="form-control" id="jenis_tender" name="jenis_tender" required >
                                <option value="">Pilih Jenis</option>
                                <option value="terbuka">Terbuka</option>
                                <option value="tertutup">Tertutup</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="skala">Skala</label>
                            <select class="form-control" id="skala" name="skala" required >
                                <option value="">Pilih skala</option>
                                <option value="kecil">Kecil</option>
                                <option value="menengah">Menengah</option>
                                <option value="besar">Besar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="total_hps">Total HPS</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button">Rp.</button>
                                </div>
                                <input type="text" class="form-control" id="total_hps" name="total_hps" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Masukkan quantity dan satuannya" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" required >
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_deadline">Tanggal Deadline</label>
                                <input type="date" class="form-control" id="tanggal_deadline" name="tanggal_deadline" required >
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_pengumuman">Tanggal Pengumuman</label>
                                <input type="date" class="form-control" id="tanggal_pengumuman" name="tanggal_pengumuman" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required >
                                <option value="">Pilih status</option>
                                <option value="diproses">Diproses</option>
                                <option value="kalah">Kalah</option>
                                <option value="menang">Menang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="informasi_lawan">Informasi Lawan</label>
                            <textarea class="form-control tinymce" id="informasi_lawan" name="informasi_lawan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="kendala">Kendala</label>
                            <textarea class="form-control tinymce" id="kendala" name="kendala"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="informasi_kualifikasi">Informasi Kualifikasi</label>
                            <textarea class="form-control tinymce" id="informasi_kualifikasi" name="informasi_kualifikasi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<!-- Detail Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-detailLabel">Detail Subinstansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="detail_id_subinstansi">

                <!-- Nama Subinstansi -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama Subinstansi</strong></div>
                    <div class="col-md-8" id="detail_nama_subinstansi"></div>
                </div>

                <!-- Perusahaan -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Perusahaan</strong></div>
                    <div class="col-md-8" id="detail_perusahaan"></div>
                </div>

                <!-- Lokasi -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Lokasi</strong></div>
                    <div class="col-md-8" id="detail_lokasi"></div>
                </div>

                <!-- Link Tender -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Link Tender</strong></div>
                    <div class="col-md-8" id="detail_link_tender"></div>
                </div>

                <!-- PIC Tender -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>PIC Tender</strong></div>
                    <div class="col-md-8" id="detail_pic_tender"></div>
                </div>

                <!-- Contact Person -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Contact Person</strong></div>
                    <div class="col-md-8" id="detail_contact_person"></div>
                </div>

                <!-- Nama Pengadaan -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Nama Pengadaan</strong></div>
                    <div class="col-md-8" id="detail_pengadaan"></div>
                </div>

                <!-- Jenis Tender -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Jenis Tender</strong></div>
                    <div class="col-md-8" id="detail_jenis_tender"></div>
                </div>

                <!-- Skala -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Skala</strong></div>
                    <div class="col-md-8" id="detail_skala"></div>
                </div>

                <!-- Total HPS -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Total HPS</strong></div>
                    <div class="col-md-8" id="detail_total_hps"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4"><strong>Quantity</strong></div>
                    <div class="col-md-8" id="detail_quantity"></div>
                </div>

                <!-- Tanggal Pengajuan -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Tanggal Pengajuan</strong></div>
                    <div class="col-md-8" id="detail_tanggal_pengajuan"></div>
                </div>

                <!-- Tanggal Deadline -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Tanggal Deadline</strong></div>
                    <div class="col-md-8" id="detail_tanggal_deadline"></div>
                </div>

                <!-- Tanggal Pengumuman -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Tanggal Pengumuman</strong></div>
                    <div class="col-md-8" id="detail_tanggal_pengumuman"></div>
                </div>

                <!-- Status -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Status</strong></div>
                    <div class="col-md-8" id="detail_status"></div>
                </div>

                <!-- Informasi Lawan -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Informasi Lawan</strong></div>
                    <div class="col-md-8" id="detail_informasi_lawan"></div>
                </div>

                <!-- Kendala -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Kendala</strong></div>
                    <div class="col-md-8" id="detail_kendala"></div>
                </div>

                <!-- Informasi Kualifikasi -->
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Informasi Kualifikasi</strong></div>
                    <div class="col-md-8" id="detail_informasi_kualifikasi"></div>
                </div>
            </div>
        </div>
    </div>
</div>



    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>

    <script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/sojq529cpidrluzo7od0i8znfraiwhbur8096jr0b3qpni4i/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script type="text/javascript">
        // Initialize TinyMCE for textareas
        tinymce.init({
            selector: 'textarea.tinymce',
            menubar: false,
            plugins: 'lists',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | numlist bullist',
            branding: false,
            setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
        });

        // Format Total HPS to Rupiah
        document.getElementById('total_hps').addEventListener('input', function (e) {
            var value = this.value.replace(/[^,\d]/g, '');
            var split = value.split(',');
            var rupiah = split[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            this.value = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#subinstansi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subinstansi.data', $instansi) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nama_subinstansi', name: 'nama_subinstansi' },
            { data: 'pengadaan', name: 'pengadaan' },
            { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan' },
            { data: 'tanggal_deadline', name: 'tanggal_deadline' },
            { data: 'tanggal_pengumuman', name: 'tanggal_pengumuman' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 }
        ]
    });


    $('#subinstansi-table').on('click', '.detailSubinstansi', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/subinstansi/' + id,
                method: 'GET',
                success: function(data) {

                    var perusahaanText = "";
                    if (data.perusahaan === "herbivor") {
                        perusahaanText = "PT HERBIVOR SATU NUSA";
                    } else if (data.perusahaan === "npa") {
                        perusahaanText = "CV NUSA PRATAMA ANUGRAH";
                    } else if (data.perusahaan === "triputra") {
                        perusahaanText = "PT TRIPUTRA SINERGI INDONESIA";
                    }
                    $('#detail_perusahaan').text(perusahaanText);
                    $('#detail_nama_instansi').text(data.nama_instansi);
                    $('#detail_nama_subinstansi').text(data.nama_subinstansi);
                    $('#detail_lokasi').text(data.lokasi);
                    $('#detail_link_tender').text(data.link_tender);
                    $('#detail_pic_tender').text(data.pic_tender);
                    $('#detail_contact_person').text(data.contact_person);
                    $('#detail_pengadaan').text(data.pengadaan);
                    $('#detail_jenis_tender').text(data.jenis_tender);
                    $('#detail_skala').text(data.skala);
                    $('#detail_total_hps').text('Rp. ' + data.total_hps);
                    $('#detail_quantity').text(data.quantity);
                    $('#detail_tanggal_pengajuan').text(data.tanggal_pengajuan);
                    $('#detail_tanggal_deadline').text(data.tanggal_deadline);
                    $('#detail_tanggal_pengumuman').text(data.tanggal_pengumuman);
                    $('#detail_status').text(data.status);
                    // Set innerHTML for HTML content
                    $('#detail_informasi_lawan').html(data.informasi_lawan);
                    $('#detail_kendala').html(data.kendala);
                    $('#detail_informasi_kualifikasi').html(data.informasi_kualifikasi);
                    $('#modal-detail').modal('show');
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

    // Handler untuk tombol ubah status
    $('#subinstansi-table').on('click', '.statusKalah, .statusMenang, .statusDiproses', function() {
        var button = $(this);
        var id = button.data('id');
        var status = button.hasClass('statusKalah') ? 'kalah' :
                    button.hasClass('statusMenang') ? 'menang' : 'diproses';
        var statusText = button.hasClass('statusKalah') ? 'Kalah' :
                        button.hasClass('statusMenang') ? 'Menang' : 'Diproses';

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: `Ingin mengubah status menjadi ${statusText}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Ya, Ubah ke ${statusText}!`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/subinstansi/${id}`,
                    method: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'PUT',
                        status: status
                    },
                    success: function(data) {
                        table.ajax.reload();
                        Swal.fire(
                            'Berhasil!',
                            `Status berhasil diubah menjadi ${statusText}.`,
                            'success'
                        );
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengubah status.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Handler untuk menampilkan modal dan mengisi data
    $('#subinstansi-table').on('click', '.editSubinstansi', function () {
        var button = $(this);
        var id = button.data('id');

        // Reset form
        $('#form-subinstansi').trigger("reset");
        $('#id_subinstansi').val('');
        tinymce.get('informasi_lawan').setContent('');
        tinymce.get('kendala').setContent('');
        tinymce.get('informasi_kualifikasi').setContent('');

        // Set method dan label modal
        $('#form-method').val('PUT');
        $('#modal-addLabel').text('Edit Subinstansi');

        $.ajax({
            url: '/subinstansi/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#id_subinstansi').val(data.id_subinstansi);
                $('#nama_subinstansi').val(data.nama_subinstansi);
                $('#perusahaan').val(data.perusahaan);
                $('#lokasi').val(data.lokasi);
                $('#link_tender').val(data.link_tender);
                $('#pic_tender').val(data.pic_tender);
                $('#contact_person').val(data.contact_person);
                $('#pengadaan').val(data.pengadaan);
                $('#jenis_tender').val(data.jenis_tender);
                $('#skala').val(data.skala);
                $('#tanggal_pengajuan').val(data.tanggal_pengajuan);
                $('#tanggal_deadline').val(data.tanggal_deadline);
                $('#tanggal_pengumuman').val(data.tanggal_pengumuman);
                $('#status').val(data.status);
                tinymce.get('informasi_lawan').setContent(data.informasi_lawan);
                tinymce.get('kendala').setContent(data.kendala);
                tinymce.get('informasi_kualifikasi').setContent(data.informasi_kualifikasi);
                $('#total_hps').val(data.total_hps);
                $('#quantity').val(data.quantity);

                // Tampilkan modal
                $('#modal-add').modal('show');
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Handle form submission
    $('#form-subinstansi').submit(function(e) {
        e.preventDefault();
        var method = $('#form-method').val();
        var url = method === 'POST' ? "{{ route('subinstansi.store') }}" : "{{ route('subinstansi.update', '') }}/" + $('#id_subinstansi').val();

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(data) {
                $('#modal-add').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });

    // Handle delete action
    $('body').on('click', '.deleteSubinstansi', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Ingin menghapus data berikut?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('subinstansi.destroy', '') }}" + '/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        table.draw();
                        Swal.fire(
                            'Terhapus!',
                            'Data telah dihapus.',
                            'success'
                        )
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
});
</script>
</body>
</html>
