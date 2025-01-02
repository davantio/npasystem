<!DOCTYPE html>
<html lang="en">
@include('layout.head')
<head>
    <title>Research and Development</title>
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
                      <h1>Data Research and Development</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Research</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
              <section class="content">
                <div class="container-fluid">
                    <!-- Tambah Research  Button -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                            Tambah Research
                        </button>
                    </div>

                    <!-- Card Wrapper -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Responsive Table -->
                            <div class="table-responsive">
                                <table id="research-table" class="table table-bordered table-striped table-hover nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>#</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Kemasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- AJAX Data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        @include('layout.footer')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form-research" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                <input type="hidden" name="id_research" id="id_research">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-addLabel">Tambah Research</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_produk">Kode Produk</label>
                            <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Masukkan nama produk" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" required>
                        </div>
                        <div class="form-group">
                            <label for="bahan_baku">Bahan Baku</label>
                            <textarea class="form-control tinymce" id="bahan_baku" name="bahan_baku" placeholder="Masukkan bahan baku" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="proses_produksi">Proses Produksi</label>
                            <textarea class="form-control tinymce" id="proses_produksi" name="proses_produksi" placeholder="Masukkan proses produksi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="hpp">HPP</label>
                            <input type="text" class="form-control" id="hpp" name="hpp" required>
                        </div>
                        <div class="form-group">
                            <label for="kemasan">Kemasan</label>
                            <select class="form-control" id="kemasan" name="kemasan" required>
                                <option value="" disabled selected>Pilih Kemasan</option>
                                <option value="Jirigen">Jirigen</option>
                                <option value="Drum">Drum</option>
                                <option value="IBC">IBC</option>
                                <option value="Karung">Karung</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto_produk">Foto Produk</label>
                            <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="files">Upload Berkas</label>
                            <input type="file" class="form-control" id="files" name="files[]" accept=".pdf,.doc,.docx,.zip,.rar" multiple>
                            <small>Tekan CTRL untuk pilih file lebih dari satu</small>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form-edit-research" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="form-method-edit" value="PUT">
                <input type="hidden" name="id_research" id="edit_id_research">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-editLabel">Edit Research</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_kode_produk">Kode Produk</label>
                            <input type="text" class="form-control" id="edit_kode_produk" name="kode_produk" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_bahan_baku">Bahan Baku</label>
                            <textarea class="form-control tinymce" id="edit_bahan_baku" name="bahan_baku" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_proses_produksi">Proses Produksi</label>
                            <textarea class="form-control tinymce" id="edit_proses_produksi" name="proses_produksi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_hpp">HPP</label>
                            <input type="text" class="form-control" id="edit_hpp" name="hpp" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kemasan">Kemasan</label>
                            <select class="form-control" id="edit_kemasan" name="kemasan" required>
                                <option value="" disabled selected>Pilih Kemasan</option>
                                <option value="Jirigen">Jirigen</option>
                                <option value="Drum">Drum</option>
                                <option value="IBC">IBC</option>
                                <option value="Karung">Karung</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_foto_produk">Foto Produk</label>
                            <div id="current_foto_produk" class="mb-2"></div>
                            <input type="file" class="form-control" id="edit_foto_produk" name="foto_produk" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="edit_files">Upload Berkas</label>
                            <div id="current_files" class="mb-2"></div>
                            <input type="file" class="form-control" id="edit_files" name="files[]" accept=".pdf,.doc,.docx,.zip,.rar" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveEditBtn">Update</button>
                    </div>
                </div>
            </form>
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
$(document).ready(function() {
    tinymce.init({
    selector: 'textarea.tinymce',
    menubar: false,
    plugins: 'lists',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
    branding: false,
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});

function format(data) {
    let filesHtml = '';

    if (data.detail_berkas && data.detail_berkas.length > 0) {
        filesHtml = data.detail_berkas
            .map(
                (file, index) => `
                <div>
                    <a href="/storage/${file.file}" target="_blank" class="btn btn-link">
                        <i class="fas fa-file"></i> Berkas ${index + 1}
                    </a>
                </div>
            `
            )
            .join('');
    } else {
        filesHtml = '<span class="text-muted">Tidak ada berkas tersedia</span>';
    }

    const formatRupiah = (angka) =>
    isNaN(angka) ? angka : new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }).format(angka);

    return `
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    ${[
                        { label: "Foto Produk", value: `<img src="/storage/${data.foto_produk}" alt="Foto Produk" class="img-fluid img-thumbnail" style="max-width: 150px;">` },
                        { label: "Bahan Baku", value: data.bahan_baku },
                        { label: "Proses Produksi", value: data.proses_produksi },
                        { label: "HPP", value: formatRupiah(data.hpp) },
                    ]
                        .map(row => `<tr><td><strong>${row.label}:</strong></td><td>${row.value}</td></tr>`)
                        .join('')}
                </table>
            </div>
            <div class="col-md-6">
                <h5>Berkas</h5>
                ${filesHtml}
            </div>
        </div>
    `;

}


// Inisialisasi DataTable
var table = $('#research-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('research.data') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        {
            className: 'details-control',
            orderable: false,
            data: null,
            defaultContent: '<span class="btn btn-link">+</span>',
        },
        { data: 'kode_produk', name: 'kode_produk' },
        { data: 'nama_produk', name: 'nama_produk' },
        { data: 'kemasan', name: 'kemasan' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[1, 'asc']]
});

$('#research-table tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row(tr);

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
    } else {
        $.ajax({
            url: `/research/${row.data().id_research}/detail`,
            method: 'GET',
            success: function (response) {
                if (response.success) {
                    row.child(format(response.data)).show();
                    tr.addClass('shown');
                } else {
                    alert('Data tidak ditemukan');
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengambil detail data');
            }
        });
    }
});

$('#form-research').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var method = $('#form-method').val();
    var url = method === 'POST' ? "{{ route('research.store') }}" : "{{ route('research.update', '') }}/" + $('#id_research').val();
    formData.append('_method', method);

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#modal-add').modal('hide');
            table.ajax.reload();
        },
        error: function(xhr) {
            console.log('Error:', xhr);
        }
    });
});

$('#research-table').on('click', '.editResearch', function() {
    var id = $(this).data('id');
    $.ajax({
        url: `/research/${id}/edit`,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                var data = response.data;

                $('#edit_id_research').val(data.id_research);
                $('#edit_kode_produk').val(data.kode_produk);
                $('#edit_nama_produk').val(data.nama_produk);
                tinymce.get('edit_bahan_baku').setContent(data.bahan_baku);
                tinymce.get('edit_proses_produksi').setContent(data.proses_produksi);
                $('#edit_hpp').val(data.hpp);
                $('#edit_kemasan').val(data.kemasan);

                if (data.foto_produk) {
                    $('#current_foto_produk').html(
                        `<img src="/storage/${data.foto_produk}" class="img-thumbnail" style="max-width: 150px;">`
                    );
                } else {
                    $('#current_foto_produk').html('<span class="text-muted">Tidak ada foto produk</span>');
                }

                if (data.detail_berkas && data.detail_berkas.length > 0) {
                    var filesHtml = data.detail_berkas.map(function(file, index) {
                        return `
                            <a href="/storage/${file.file}" target="_blank" class="btn btn-link">
                                <i class="fas fa-file"></i> Berkas ${index + 1}
                            </a>`;
                    }).join('');
                    $('#current_files').html(filesHtml);
                } else {
                    $('#current_files').html('<span class="text-muted">Tidak ada berkas</span>');
                }

                $('#modal-edit').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr) {
            console.log('Error:', xhr);
        }
    });
});


// Submit edit form
$('#form-edit-research').submit(function(e) {
    e.preventDefault();

    tinymce.triggerSave();
    var id = $('#edit_id_research').val();
    var formData = new FormData(this);

    $.ajax({
        url: `/research/${id}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                $('#modal-edit').modal('hide');
                $('#research-table').DataTable().ajax.reload();
                Swal.fire('Success', 'Data berhasil diupdate.', 'success');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
            console.log('Error:', xhr);
        }
    });
});

$('#research-table').on('click', '.deleteResearch', function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/research/${id}/delete`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token di header
                },
                success: function() {
                    table.ajax.reload();
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        }
    });
});
});
</script>
</body>
</html>
