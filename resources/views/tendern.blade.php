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
                    <h1>Tender {{$instansi['nama']}} - {{$instansi['sub_instansi']}}</h1>

                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="main">Home</a></li>
                      <li class="breadcrumb-item"><a href="../tender">Tender</a></li>
                      <li class="breadcrumb-item active">Tender {{$instansi['nama']}} - {{$instansi['sub_instansi']}}</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row" id="menu">

                    </div>
                    <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                          <div class="row justify-content-between">
                            <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Tender</button>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="tabel-tender" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>No</th>
                            <th style="min-width:100px">Action</th>
                            <th style="min-width:150px">Tender</th>
                            <th>Skala</th>
                            <th style="min-width:200px">Barang</th>
                            <th style="min-width:130px">Detail Barang</th>
                            <th style="min-width:120px">Qty</th>
                            <th>HPS</th>
                            <th>Harga Penawaran</th></th>
                            <th>Ongkir</th>
                            <th style="min-width:120px;">Total</th>
                            <th style="min-width:120px">Deadline</th>
                            <th>Detail</th>
                            <th style="min-width:400px">Kompetitor</th>
                            <th style="min-width:200px">Dokumen</th>
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
        <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
        <script>
            $('.select2').select2();
            var dokumen = [];
            var barang = [];
            var pesaing = [];
            var instansi = "{{$instansi['id']}}";
            $('#target-marketing').hide();$('#plan-marketing').hide();$('#omset-marketing').hide();
            $(document).ready(function(){

                console.log("Data from Laravel:", <?php echo json_encode($instansi); ?>);
                var table = $('#tabel-tender').DataTable({
                  'paging'      : true,
                  'lengthChange': true,
                  'searching'   : true,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : false,
                  "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    if (aData['status'] == "Mengikuti") {
                        $('td', nRow).css('background-color', 'Yellow');
                    } else if(aData['status'] == "Gugur" || aData['status'] == "Tidak Ikut" ){
                        $('td', nRow).css('background-color', ' #FE3D3D');
                    } else if(aData['status'] == 'Berhasil'){
                        $('td', nRow).css('background-color', 'Green');
                    } else {
                        $('td', nRow).css('background-color', '');
                    }
                   },
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url("data-tender/'+instansi+'") !!}',
                    "columnDefs": [
                    {
                        targets: 4, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    result += "<li> " +item.nama + "</li><br>";
                                });
                                return result;
                            }
                            return "<ul> " + data + "</ul>"; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        "targets": [5], // Sesuaikan dengan indeks kolom 'detail'
                        "render": function (data, type, row, meta) {
                            // Di sini, kita mengembalikan HTML untuk tombol
                            return "<button type='button' class='btn btn-info btn-detail-barang'>Detail Barang</button>";
                        }
                    },
                    {
                        targets: 6, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    result += "<li> " +item.qty + " "+item.satuan+"</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        targets: 7, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    result += "<li> " +formatRupiah(item.hps) + "</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        targets: 8, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    result += "<li>" +formatRupiah(item.harga) + "</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        targets: 9, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    result += "<li> " +formatRupiah(item.ongkir) + "</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        "targets": [12], // Sesuaikan dengan indeks kolom 'detail'
                        "render": function (data, type, row, meta) {
                            // Di sini, kita mengembalikan HTML untuk tombol
                            return "<button type='button' class='btn btn-default btn-detail'>Detail</button>";
                        }
                    },
                    {
                        targets: 13, // Sesuaikan dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    var icon = (item.menang === 'yes') ? "<i class='fas fa-trophy' style='color:gold;'></i>" :
                                        "<i class='fas fa-times-circle' style='color:red;'></i>";
                                    result += "<li>" + item.perusahaan + " - " + formatRupiah(item.harga) +" - " + icon + "</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        targets: 14, // Ganti 'x' dengan indeks kolom yang sesuai
                        render: function(data, type, row) {
                            if (type === 'display' && typeof data === 'string') {
                                var dataArray = JSON.parse(data);
                                var result = '';
                                dataArray.forEach(function(item) {
                                    var icon = (item.siap === 'ya') ? "<i class='fas fa-check-circle' style='color:green;'></i>" :
                                        "<i class='fas fa-times-circle' style='color:red;'></i>";
                                    result += "<li>" + item.nama + " - " + icon + "</li><br>";
                                });
                                return "<ul>"+result+"</ul>";
                            }
                            return data; // Kembalikan data asli jika bukan untuk display atau bukan array JSON
                        }
                    },
                    {
                        "targets": [6,7,8,9,13,14], // Sesuaikan dengan indeks kolom 'kompetitor' dan 'kompetitor_harga'
                        "visible": false // Awalnya sembunyikan kolom-kolom ini
                    }
                ],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                        { data: 'action',name: 'action',orderable:false,searchable:false},
                        { data: 'nama', name: 'nama',orderable:true},
                        { data: 'skala', name: 'skala',orderable:true},
                        { data: 'barang', name: 'barang',orderable:true},
                        { data: 'd_barang', name: 'd_barang', orderable:false, searchable:false},
                        { data: 'qty', name: 'qty',orderable:true},
                        { data: 'hps', name: 'hps',orderable:true},
                        { data: 'harga', name: 'harga',orderable:true},
                        { data: 'ongkir', name: 'ongkir',orderable:true},
                        { data: 'total', name: 'total',orderable:true},

                        { data: 'pendaftaran', name: 'pendaftaran',orderable:true},
                        { data: 'detail', name: 'detail',orderable:false, searchable:false},
                        { data: 'kompetitor', name: 'kompetitor',orderable:true},
                        { data: 'dokumen', name: 'dokumen',orderable:true},
                    ]
                });
                $('#tabel-tender tbody').on('click', 'button.btn-detail-barang', function() {
                if ($(this).text() === 'Detail Barang') {
                    $(this).text('Hide Barang'); // Ubah teks menjadi 'Hide'
                } else {
                    $(this).text('Detail Barang'); // Ubah kembali teks menjadi 'Detail'
                }
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                // Logika untuk toggle (menampilkan dan menyembunyikan) kolom
                // Cek apakah kolom sudah ditampilkan atau tidak
                var colqty = table.column(6).visible();
                var colhps = table.column(7).visible();
                var colharga = table.column(8).visible();
                var colongkir = table.column(9).visible();

                // Toggle visibilitas berdasarkan status saat ini
                table.column(6).visible(!colqty);
                table.column(7).visible(!colhps);
                table.column(8).visible(!colharga);
                table.column(9).visible(!colongkir);
            });
            $('#tabel-tender tbody').on('click', 'button.btn-detail', function() {
                if ($(this).text() === 'Detail') {
                    $(this).text('Hide'); // Ubah teks menjadi 'Hide'
                } else {
                    $(this).text('Detail'); // Ubah kembali teks menjadi 'Detail'
                }
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                // Logika untuk toggle (menampilkan dan menyembunyikan) kolom
                // Cek apakah kolom sudah ditampilkan atau tidak
                var colKompetitorVisible = table.column(13).visible();
                var colKompetitorHargaVisible = table.column(14).visible();

                // Toggle visibilitas berdasarkan status saat ini
                table.column(13).visible(!colKompetitorVisible);
                table.column(14).visible(!colKompetitorHargaVisible);
            });
            })
            function tabelbarang(namatabel, data ,namafooter) {
                // Mengosongkan tabel sebelum memasukkan data baru
                $(namatabel).empty();
                $(namafooter).empty();
                var total = 0;
                var total1 = 0;
                console.log(data);
                // Iterasi melalui setiap barang dalam data
                $.each(data, function(index, barang) {

                    if(barang['status']=="hapus"){

                    } else {
                        var hps = parseInt(barang['hps']);
                        var sum = barang['qty'] * hps;
                        var ongkir = (barang['ongkir'] === null) ? 0 : barang['ongkir'];
                        var hargakita = barang['harga']*1 + ongkir*1;
                        console.log(hargakita);
                        hargakita = hargakita*barang['qty'];
                        total1 += hargakita;
                        total += sum;
                        if (namatabel === '#tabel-tambah-barang') {
                            var action = "<button type='button' class='btn btn-danger hapusbarang' data-kode='" + barang['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else if (namatabel === '#tabel-detail-barang') {
                            var action = "-";
                        } else if (namatabel === '#tabel-edit-barang') {
                            var action = "<button type='button' class='btn btn-warning editbarang' data-kode='" + barang['id'] + "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger edthapusbarang' data-kode='" + barang['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else {

                        }
                        var Nrow = $("<tr>");
                        Nrow.html("<td>"+action+"</td><td>" + barang['nama'] + "</td><td>" + barang['qty'] + "</td><td>" + barang['satuan'] + "</td><td>" + formatRupiah(barang['hps']) + "</td><td>" + formatRupiah(barang['harga']) + "</td><td>"+formatRupiah(barang['ongkir'])+"</td><td>" + formatRupiah(sum) + "</td><td>" + formatRupiah(hargakita) + "</td><td>" + barang['kegunaan'] + "</td><td style='min-length:200px'>" + barang['spec'] + "</td></tr>");
                        $(namatabel).append(Nrow);
                    }

                });
                //FOOTER

                    var Frow = $("<tr>");
                    var selisih = total-total1;
                    console.log(total);
                    console.log(total1);
                    Frow.html("<td class='text-right' colspan='8'>Selisih</td><td colspan='3' class='bg-success'>"+formatRupiah(selisih)+"</td></tr>");

                    $(namafooter).append(Frow);
                //FOOTER
                if (namatabel === '#tabel-tambah-barang') {
                    $('#tambah_total').val(formatRupiah(total));
                } else if (namatabel === '#tabel-detail-barang') {
                    $('#detail_total').val(formatRupiah(total));
                } else if (namatabel === '#tabel-edit-barang') {
                    $('#edit_total').val(formatRupiah(total));
                } else {

                }
                // Mengatur nilai total pada input dengan id 'tambah_total'

              }
              function tabeldokumen(tabel,data){
                    $(tabel).empty();
                    console.log(data);
                    $.each(data, function(index,dokumen){
                        var Nrow = $("<tr>");
                        if(dokumen['siap'] == "ya"){
                            var siap =  "<span><i class='fas fa-check-circle ' style='color:green;'></i> Ada</span>";
                        } else {
                            var siap =  "<span><i class='fas fa-times-circle ' style='color:red;'></i> Tidak Ada</span>";
                        }
                        if (tabel === '#tabel-tambah-dokumen') {
                            var action = "<button type='button' class='btn btn-danger hapusdokumen' data-kode='" + dokumen['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else if (tabel === '#tabel-detail-dokumen') {
                            var action = "-";
                        } else if (tabel === '#tabel-edit-dokumen') {
                            var action = "<button type='button' class='btn btn-warning editdokumen' data-kode='" + dokumen['id'] + "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger edthapusdokumen' data-kode='" + dokumen['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else {

                        }
                        if(dokumen['status']=="hapus"){

                        } else {
                            Nrow.html("<td>"+action+"</td><td>"+dokumen['nama']+"</td><td>"+dokumen['keterangan']+"</td><td>"+siap+"</td></tr>")
                            $(tabel).append(Nrow);
                        }

                    });
                }
              function tabelhistory(tabel,data){
                $(tabel).empty();
                console.log(data);
                $.each(data, function(index,pesaing){
                    if(pesaing['status']=="hapus"){

                    } else {
                        if(pesaing['menang'] == "yes"){
                            var menang =  "<span><i class='fas fa-trophy' style='color:gold;'></i> "+pesaing['menang']+"</span>";
                        } else {
                            var menang =  "<span><i class='fas fa-times-circle' style='color:red;'></i>"+pesaing['menang']+"</span>";
                        }
                        var Nrow = $("<tr>");
                        if (tabel === '#tabel-tambah-history') {
                            var action = "<button type='button' class='btn btn-danger hapushistory' data-kode='" + pesaing['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else if (tabel === '#tabel-detail-history') {
                            var action = "-";
                        } else if (tabel === '#tabel-edit-history') {
                            var action = "<button type='button' class='btn btn-warning edithistory' data-kode='" + pesaing['id'] + "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger edthapushistory' data-kode='" + pesaing['id'] + "'><i class='fas fa-trash-alt'></i></button>";
                        } else {

                        }
                        Nrow.html("<td>"+action+"</td><td>"+pesaing['tender']+"</td><td>"+pesaing['perusahaan']+"</td><td>"+formatRupiah(pesaing['harga'])+"</td><td>"+menang+"</td><td>"+pesaing['keterangan']+"</td></tr>")
                        $(tabel).append(Nrow);
                    }

                });
              }
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
            //MODAL INSTANSI
            $(document).on('click','#tambahinstansi',function(e){
                $('#add-instansi').hide(); $('#edit-instansi').hide(); $('#hapus-instansi').hide();
                $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide(); $('#detail-pejabat').hide()

                if ($.fn.DataTable.isDataTable('#tabel-pejabat')) {
                    $('#tabel-pejabat').DataTable().destroy();
                }

                // Inisialisasi DataTable baru
                $('#tabel-pejabat').DataTable({
                    'paging'      : true,
                    'lengthChange': true,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url("data-pejabattender/'+instansi+'") !!}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
                        { data: 'action', name: 'action', orderable:false, searchable:false},
                        { data: 'instansi', name: 'instansi', orderable:true},
                        { data: 'nama', name: 'nama', orderable:true},
                        { data: 'jabatan', name: 'jabatan', orderable:false},
                        { data: 'telp', name: 'telp', orderable:false},
                        { data: 'alamat', name: 'alamat', orderable:false},
                        { data: 'sosmed', name: 'sosmed', orderable:false},
                        { data: 'hobby', name: 'hobby', orderable:false}
                    ]
                });
                $('#tambah-instansi').show();
                $('#tambah-pejabat').show();

            });

              //Pejabat
                //Tambah Pejabat
                    $('#tambah-pejabat').on('click',function(){
                        $('#tambah-pejabat').hide(); $('#add-pejabat').show(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide(); $('#detail-pejabat').hide();
                        document.getElementById("form-add-pejabat").reset();
                        $('#tambah_foto_pejabat').val('');
                          document.getElementById("preview_tambah").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";

                    });
                    $('#tambah_foto_pejabat').change(function() {
                      var size = this.files[0].size;
                      var preview = document.querySelector('#preview_tambah');
                      if(size > 5000000) {
                          Toast.fire({
                                icon: 'error',
                                title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
                            })
                          $('#tambah_foto_pejabat').val('');
                          document.getElementById("preview_tambah").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                      } else {
                          var preview = document.querySelector('#preview_tambah');
                          var file    = document.querySelector('#tambah_foto_pejabat').files[0];
                          var reader  = new FileReader();

                          reader.onloadend = function () {
                            preview.src = reader.result;
                          }

                          if (file) {
                            reader.readAsDataURL(file);
                          } else {
                            preview.src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                          }
                      }
                    });
                    $('#btn-close-pejabat').on('click',function(){
                        $('#tambah-pejabat').show(); $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide();
                    });
                    $('#form-add-pejabat').submit(function(e){
                        event.preventDefault();
                        var el = $('#btn-tambah-pejabat');
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var data = new FormData(this);
                        var tambah_instansi_pejabat = "{{$instansi['id']}}";
                        data.append('tambah_instansi_pejabat', tambah_instansi_pejabat);

                        try{
                            $.ajax({
                                url: '{!! url("data-pejabattender") !!}',
                                type: "POST",
                                data: data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if(response.success == true){
                                        Toast.fire({
                                            icon: 'success',
                                            title: response.pesan
                                        })
                                        $('#add-pejabat').hide(); $('#tambah-pejabat').show();
                                        var table = $('#tabel-pejabat').DataTable();
                                        table.ajax.reload( null, false );
                                    } else {
                                        Toast.fire({
                                            icon: 'error',
                                            title: response.pesan
                                        })
                                    }

                                    // Proses response setelah submit form berhasil
                                },
                                error: function(response) {
                                    console.log(response);
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.pesan
                                    })
                                    // Proses response setelah submit form gagal
                                }
                            });
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }


                    });
                //Tambah Pejabat
                //Detail Pejabat
                    $(document).on('click','.detailpejabat',function(){
                        $('#tambah-pejabat').hide(); $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide();$('#detail-pejabat').show();
                        document.getElementById("form-detail-pejabat").reset();
                        var id = $(this).data('kode');
                        $.ajax({
                          url :'{!! url("data-pejabattender/'+id+'/edit") !!}',
                          type : 'get',
                          success : function(response){
                            console.log(response);

                            $('#detail_nama_pejabat').val(response.data.nama);
                            $('#detail_jabatan_pejabat').val(response.data.pejabat);
                            $('#detail_telp_pejabat').val(response.data.telp);
                            $('#detail_alamat_pejabat').val(response.data.alamat);
                            $('#detail_sosmed_pejabat').val(response.data.sosmed);
                            $('#detail_hobby_pejabat').val(response.data.hobby);
                            $('#detail_keterangan_pejabat').val(response.data.keterangan);
                            if(response.data.foto == null){
                                  document.getElementById('preview_detail').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                              } else {
                                  var baseUrl = window.location.origin;
                                  var fotoUrl = baseUrl +"/img/tender/"+ response.data.foto;
                                  document.getElementById('preview_detail').src = fotoUrl;
                              }
                          }
                        });
                    })
                    $('#btn-detail-close-pejabat').click(function(){
                       $('#detail-pejabat').hide();$('#tambah-pejabat').show();
                    });
                //Detail Pejabat
                // Edit Pejabat
                    $(document).on('click','.editpejabat',function(){
                        $('#tambah-pejabat').hide(); $('#add-pejabat').hide(); $('#edit-pejabat').show(); $('#hapus-pejabat').hide();$('#detail-pejabat').hide();
                        document.getElementById("form-edit-pejabat").reset();
                        var id = $(this).data('kode');

                        $('#edit_id_pejabat').val(id);
                       $.ajax({
                          url :'{!! url("data-pejabattender/'+id+'/edit") !!}',
                          type : 'get',
                          success : function(response){
                            console.log(response);
                            $('#edit_nama_pejabat').val(response.data.nama);
                            $('#edit_jabatan_pejabat').val(response.data.pejabat);
                            $('#edit_telp_pejabat').val(response.data.telp);
                            $('#edit_alamat_pejabat').val(response.data.alamat);
                            $('#edit_sosmed_pejabat').val(response.data.sosmed);
                            $('#edit_hobby_pejabat').val(response.data.hobby);
                            $('#edit_keterangan_pejabat').val(response.data.keterangan);
                            if(response.data.foto == null){
                                  document.getElementById('preview_edit').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                              } else {
                                  var baseUrl = window.location.origin;
                                  var fotoUrl = baseUrl +"/img/tender/"+ response.data.foto;
                                  document.getElementById('preview_edit').src = fotoUrl;
                              }
                          }
                        });
                    });

                    $('#edit_foto_pejabat').change(function() {
                      var size = this.files[0].size;
                      var preview = document.querySelector('#preview_edit');
                      if(size > 5000000) {
                          Toast.fire({
                                icon: 'error',
                                title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
                            })
                          $('#tambah_edit_pejabat').val('');
                          document.getElementById("preview_edit").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                      } else {
                          var preview = document.querySelector('#preview_edit');
                          var file    = document.querySelector('#edit_foto_pejabat').files[0];
                          var reader  = new FileReader();

                          reader.onloadend = function () {
                            preview.src = reader.result;
                          }

                          if (file) {
                            reader.readAsDataURL(file);
                          } else {
                            preview.src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
                          }
                      }
                    });

                    $('#btn-edit-close-pejabat').on('click',function(){
                        $('#tambah-pejabat').show(); $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide();
                    });
                    $('#form-edit-pejabat').submit(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $('#btn-edit-pejabat');
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $('#edit_id_pejabat').val(); // Membuat ID unik
                        var edit_instansi_pejabat = "{{$instansi['id']}}"; // Pastikan Anda mendapatkan nilai yang benar dari variabel ini
                        var data = new FormData(this);

                        try{
                            $.ajax({
                                url: '{!! url("data-pejabattender/'+id+'") !!}',
                                type: "PUT",
                                data: data,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if(response.success == true){
                                        Toast.fire({
                                            icon: 'success',
                                            title: response.pesan
                                        })
                                        $('#edit-pejabat').hide(); $('#tambah-pejabat').show();
                                        var table = $('#tabel-pejabat').DataTable();
                                        table.ajax.reload( null, false );
                                    } else {
                                        Toast.fire({
                                            icon: 'error',
                                            title: response.pesan
                                        })
                                    }

                                    // Proses response setelah submit form berhasil
                                },
                                error: function(response) {
                                    console.log(response);
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.pesan
                                    })
                                    // Proses response setelah submit form gagal
                                }
                            });

                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }
                    });
                // Edit Pejabat
                // Hapus Pejabat
                    var hapuspejabat = [];
                    $(document).on('click','.hapuspejabat',function(){
                        $('#tambah-pejabat').hide(); $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').show(); $('#detail-pejabat').hide();
                        var id = $(this).data('kode');
                        var nama = $(this).data('nama');
                        $('#hapus_id_pejabat').val(id);
                        $('#hapus_nama_pejabat').html(nama);
                    });
                    $('#btn-hapus-close-pejabat').on('click',function(){
                         $('#tambah-pejabat').show(); $('#add-pejabat').hide(); $('#edit-pejabat').hide(); $('#hapus-pejabat').hide();
                    });
                    $('#form-hapus-pejabat').submit(function(e){
                         e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $('#hapus_id_pejabat').val();
                        var token = "{!! csrf_token() !!}";
                        try{
                            $.ajax({
                              type    : 'delete',
                              url     : '{!! url("data-pejabattender/'+id+'") !!}',
                              data    : {
                                _token  : token,
                              },
                              success:function(response) {
                                // // console.log(response);
                                var hasil = response.pesan;
                                if(response.success){
                                  Toast.fire({
                                    icon: 'success',
                                    title: hasil
                                  })
                                  $('#hapus-pejabat').hide(); $('#tambah-pejabat').show();
                                  var table = $('#tabel-pejabat').DataTable();
                                  table.ajax.reload( null, false );
                                } else {
                                  Toast.fire({
                                    icon: 'error',
                                    title: hasil
                                  })
                                }

                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                var errorMessage = "Terjadi kesalahan: " + jqXHR.responseJSON.message;
                                Toast.fire({
                                    icon: 'error',
                                    title: errorMessage
                                });
                              }
                            });
                        } catch(error) {
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        }
                    });
                // Hapus Pejabat
              //Pejabat
          // Modal Instansi
            // Tambah Tender
                $(document).on('click','#tambahdata',function(){
                    document.getElementById("form-tambah").reset();
                    $('#add-barang').hide(); $('#add-doc').hide(); $('#add-history').hide();
                    $('#tabel-data-barang').empty(); $('#tabel-data-dokumen').empty(); $('#tabel-data-history').empty();
                    dokumen.length = 0; barang.length = 0; pesaing.length = 0;
                    $('#tambah_instansi').val("{{$instansi['nama']}}");
                    $('#tambah_subinstansi').val("{{$instansi['sub_instansi']}}");
                    $('#tambah_link').val("{{$instansi['link']}}");
                    $('#tambah_pic').select2({
                      placeholder : 'Pilih Pejabat',
                      ajax  :{
                        url : '{!! url("dropdown-pejabattender/'+instansi+'") !!}',
                        dataType: 'json',
                          processResults: function (data) {
                              console.log(data);
                              return {
                                  results: $.map(data, function (item) {
                                      return {
                                          text: item.nama,
                                          id: item.id
                                      }
                                  })
                              };
                          },
                          cache: true
                      }
                    });
                    $("#tambah_pic").on('change',function(){
                        var id = $(this).val();
                        $.ajax({
                            url :'{!! url("data-pejabattender/'+id+'/edit") !!}',
                            type : 'get',
                            success : function(response){
                                console.log(response);
                                $('#tambah_cp').val(response.data.telp);
                            }
                        })
                    })
                  });
                //Tambah Barang
                  $('#tambah-barang').on('click',function(){
                      $('#add-barang').show();
                      $('#tambah_barang').val('');$('#tambah_qty').val('');$('#tambah_satuan');$('#tambah_hps').val();$('#tambah_harga').val();$('#tambah_ongkir').val();$('#tambah_kegunaan').val('');$('#tambah_spec').val('');
                      $(this).hide();
                  });
                  $('#btn-close-barang').on('click',function(e){
                     $('#add-barang').hide();
                     $('#tambah-barang').show();
                  });
                  $('#btn-tambah-barang').on('click',function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var nama = $('#tambah_barang').val();
                        var qty = $('#tambah_qty').val();
                        var satuan = $('#tambah_satuan').val();
                        var hps = $('#tambah_hps').val();
                        var harga = $('#tambah_harga').val();
                        var ongkir = $('#tambah_ongkir').val();
                        var keg = $('#tambah_kegunaan').val();
                        var spec = $('#tambah_spec').val();
                        var id = generateUniqueId(); // Membuat ID unik

                        var data = {
                            id : id,
                            nama : nama,
                            qty : qty,
                            satuan : satuan,
                            hps : hps,
                            harga : harga,
                            ongkir : ongkir,
                            kegunaan : keg,
                            spec : spec

                        };
                        console.log(data);
                        try{
                            barang.push(data);

                            $('#add-barang').hide();
                            $('#tambah-barang').show();
                            var handler = '#tabel-tambah-barang';
                            var footer = '#footer-tambah-barang';
                            tabelbarang(handler,barang,footer);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }


                  });
                //Tambah Barang

                //Hapus Barang
                  function hapusBarangById(id) {
                    barang = barang.filter(function(item) {
                        return item.id !== id;
                    });
                  }
                  $('body').on('click','.hapusbarang',function(e){
                      var id = $(this).data('kode');
                      try{
                          hapusBarangById(id);
                          var handler = '#tabel-tambah-barang';
                          var footer = '#footer-tambah-barang';
                          tabelbarang(handler,barang,footer);
                          Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Dihapus"
                              })
                      } catch(error) {
                          Toast.fire({
                                icon: 'error',
                                title: error
                              })
                      }
                  });
                //Hapus Barang

                //Tambah Dokumen
                  $('#tambah-dokumen').on('click',function(){
                      $('#add-doc').show();
                      $('#tambah_dokumen').val('');$('#tambah_keterangan').val('');
                      document.querySelectorAll('input[name="tambah_siap"]').forEach(function(radio) {
                        radio.checked = false;
                      });
                      $(this).hide();
                      console.log(dokumen);
                  });
                  $('#btn-close-dokumen').on('click',function(e){
                     $('#add-doc').hide();
                     $('#tambah-dokumen').show();
                  });
                  $('#btn-tambah-dokumen').on('click',function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var nama = $('#tambah_dokumen').val();
                        var ket = $('#tambah_keterangan').val();
                        var siap = document.querySelector('input[name="tambah_siap"]:checked').value;
                        var id = generateUniqueId(); // Membuat ID unik
                        var doc = {
                            id : id,
                            nama : nama,
                            keterangan : ket,
                            siap : siap
                        };

                        try{
                            dokumen.push(doc);
                            console.log(dokumen);
                            $('#add-doc').hide();
                            $('#tambah-dokumen').show();
                            var tabel = '#tabel-tambah-dokumen';
                            tabeldokumen(tabel,dokumen);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }


                  });
                //Tambah Dokumen

                //Hapus Dokumen
                  function hapusDokumenById(id) {
                    dokumen = dokumen.filter(function(item) {
                        return item.id !== id;
                    });
                  }
                  $('body').on('click','.hapusdokumen',function(e){
                      var id = $(this).data('kode');
                      try{
                          hapusDokumenById(id);
                          var tabel = '#tabel-tambah-dokumen';
                          tabeldokumen(tabel,dokumen);
                          Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Dihapus"
                              })
                      } catch(error) {
                          Toast.fire({
                                icon: 'error',
                                title: error
                              })
                      }
                  });
                //Hapus Dokumen


                //Tambah History
                  $('#tambah-history').on('click',function(){
                      $('#add-history').show();
                      var tender = $('#tambah_tender').val();
                      $('#tambah_history_tender').val(tender);$('#tambah_history_perusahaan').val(''); $('#tambah_history_harga').val('');$('#tambah_history_keterangan').val('');
                      var radioButtons = document.getElementsByName("tambah_history_pemenang");

                        // Loop melalui setiap elemen input radio dan set properti "checked" menjadi false
                        for (var i = 0; i < radioButtons.length; i++) {
                            radioButtons[i].checked = false;
                        }
                      $(this).hide();
                      console.log(pesaing);
                  });
                  $('#btn-close-history').on('click',function(e){
                     $('#add-history').hide();
                     $('#tambah-history').show();
                  });
                  $('#btn-tambah-history').on('click',function(e){
                         e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var tender = $('#tambah_history_tender').val();
                        var perusahaan = $('#tambah_history_perusahaan').val();
                        var harga = $('#tambah_history_harga').val();
                        var keterangan = $('#tambah_history_keterangan').val();
                        // Ambil elemen-elemen input radio dengan name "gender"
                        var radios = document.getElementsByName('tambah_history_pemenang');

                        // Loop melalui semua elemen input radio
                        for (var i = 0; i < radios.length; i++) {
                            // Periksa jika input radio ini sedang dipilih
                            if (radios[i].checked) {
                                // Jika dipilih, ambil nilainya dan cetak ke konsol
                                var pemenang = radios[i].value;
                            }
                        }
                        var id = generateUniqueId(); // Membuat ID unik
                        var data = {
                            id : id,
                            tender : tender,
                            perusahaan : perusahaan,
                            harga : harga,
                            menang : pemenang,
                            keterangan : keterangan
                        };
                        console.log(data);
                        try{
                            pesaing.push(data);
                            console.log(pesaing);
                            $('#add-history').hide();
                            $('#tambah-history').show();
                            var tabel = '#tabel-tambah-history';
                            tabelhistory(tabel,pesaing);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }


                  });
                  //Tambah History

                //Hapus History
                  function hapusHistoryById(id) {
                    pesaing = pesaing.filter(function(item) {
                        return item.id !== id;
                    });
                  }
                  $('body').on('click','.hapushistory',function(e){
                      var id = $(this).data('kode');
                      try{
                          hapusHistoryById(id);
                          var tabel = '#tabel-tambah-history';
                          tabelhistory(tabel,pesaing);
                          Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Dihapus"
                              })
                      } catch(error) {
                          Toast.fire({
                                icon: 'error',
                                title: error
                              })
                      }
                  });
                //Hapus History

                $('#form-tambah').submit(function(e){
                    e.preventDefault(); // prevent actual form submit
                    var el = $('#btn-tambah');
                    el.prop('readonly', true);
                    setTimeout(function(){el.prop('readonly', false); }, 3000);
                    var token = "{!! csrf_token() !!}";

                    $.ajax({
                      type: 'post',
                      url: '{!! url("data-tender") !!}',

                      data : {
                        perusahaan : $('#tambah_perusahaan').val(),
                        jenis    : $('#tambah_jenis').val(),
                        instansi : $('#tambah_sub_instansi').val(),
                        _token   : token,
                        tender   : $('#tambah_tender').val(),
                        lokasi   : $('#tambah_lokasi').val(),
                        skala    : $('#tambah_skala').val(),
                        link     : $('#tambah_link').val(),
                        deadline : $('#tambah_deadline').val(),
                        pic      : $('#tambah_pic').val(),
                        email    : $('#tambah_email').val(),
                        cp       : $('#tambah_cp').val(),
                        barang   : barang,
                        dokumen  : dokumen,
                        pesaing  : pesaing,

                      }, // serializes form input
                      success:function(response) {
                        console.log(response);
                        if(response.success == true ){
                          Toast.fire({
                            icon: 'success',
                            title: response.pesan
                          })
                          $('#modal-tambah').modal('hide');
                          var table = $('#tabel-tender').DataTable();

                          table.ajax.reload( null, false );
                        } else {
                          Toast.fire({
                            icon: 'error',
                            title: response.pesan
                          })
                        }
                      }
                    });
                  });
            // Tambah Tender
            // Detail Tender
                $('body').on('click', '.detail', function () {
                  dokumen.length = 0; barang.length = 0; pesaing.length = 0;
                  var kode = $(this).data('kode');
                  $.ajax({
                    url :'{!! url("data-tender/'+kode+'/edit") !!}',
                    type : 'get',
                    success : function(response){
                      console.log(response);
                      if(response.success == true){
                          if(response.tender.perusahaan == "npa"){
                              $('#detail_perusahaan').val("CV. Nusa Pratama Anugrah");
                          } else if (response.tender.perusahaan == "herbivor"){
                              $('#detail_perusahaan').val("PT. Herbivor Satu Nusa");
                          } else {
                              $('#detail_perusahaan').val("PT. Triputra Sinergi Indonesia");
                          }
                          $('#detail_jenis').val(response.tender.jenis);
                        $('#detail_instansi').val(response.tender.namainstansi);
                        $('#detail_sub_instansi').val(response.tender.subinstansi);
                        $('#detail_tender').val(response.tender.nama);
                        $('#detail_lokasi').val(response.tender.lokasi);
                        $('#detail_skala').val(response.tender.skala);
                        $('#detail_link').val(response.tender.link);
                        $('#detail_deadline').val(response.tender.pendaftaran);
                        $('#detail_pic').val(response.tender.namapic);
                        $('#detail_email').val(response.tender.email);
                        $('#detail_cp').val(response.tender.cp);
                        barang = response.barang;
                        dokumen = response.dokumen;
                        pesaing = response.pesaing;
                        console.log(barang);
                        var b = '#tabel-detail-barang';
                        var footer = '#footer-detail-barang';
                        tabelbarang(b,barang,footer);
                        var d = '#tabel-detail-dokumen';
                        tabeldokumen(d,dokumen);
                        var h = '#tabel-detail-history';
                        tabelhistory(h,pesaing);

                      } else {
                        Toast.fire({
                          icon: 'error',
                          title: response.pesan
                        })
                      }
                    }
                  });
              });
            // Detail Tender
            // Edit Tender
                $("#edit_pic").on('change',function(){
                    var id = $(this).val();
                    if(id === ''){

                    } else {
                        $.ajax({
                            url :'{!! url("data-pejabattender/'+id+'/edit") !!}',
                            type : 'get',
                            success : function(response){
                                console.log(response);
                                $('#edit_cp').val(response.data.telp);
                            }
                        })
                    }

                })
                $('body').on('click', '.edit', function () {
                    var kode = $(this).data('kode');
                    $('#edit_id').val(kode);
                    document.getElementById("form-edit").reset();
                    $('#edt-add-barang').hide(); $('#edt-add-doc').hide(); $('#edt-add-history').hide();
                    $('#edt-edit-barang').hide(); $('#edt-edit-doc').hide(); $('#edt-edit-history').hide();
                    $('#tabel-data-barang').empty(); $('#tabel-data-dokumen').empty(); $('#tabel-data-history').empty();
                    $('#edit-tambah-barang').show(); $('#edit-tambah-dokumen').show();$('#edit-tambah-history').show();

                    dokumen.length = 0; barang.length = 0; pesaing.length = 0;

                    $.ajax({
                        url :'{!! url("data-tender/'+kode+'/edit") !!}',
                        type : 'get',
                        success : function(response){
                          console.log(response);
                          if(response.success == true){
                            $('#edit_perusahaan').val(response.tender.perusahaan);
                            $('#edit_jenis').val(response.tender.jenis);
                            $('#edit_tender').val(response.tender.nama);
                            $('#edit_lokasi').val(response.tender.lokasi);
                            $('#edit_skala').val(response.tender.skala);
                            $('#edit_link').val(response.tender.link);
                            $('#edit_deadline').val(response.tender.pendaftaran);
                            $('#edit_email').val(response.tender.email);
                            $('#edit_cp').val(response.tender.cp);
                            $('#edit_instansi').val("{{$instansi['nama']}}");
                            $('#edit_subinstansi').val("{{$instansi['sub_instansi']}}");
                            $('#edit_pic').empty()
                                .append($("<option/>")
                                    .val(response.tender.pic)
                                    .text(response.tender.namapic))
                                .val(response.tender.pic).trigger("change");
                            $('#edit_pic').select2({
                              placeholder:"Pilih Pejabat",
                              ajax  :{
                                url : '{!! url("dropdown-pejabattender") !!}',
                                dataType: 'json',
                                  processResults: function (data) {
                                      console.log(data);
                                      return {
                                          results: $.map(data, function (item) {
                                              return {
                                                  text: item.nama,
                                                  id: item.id
                                              }
                                          })
                                      };
                                  },
                                  cache: true
                              }
                            });
                            barang = response.barang;
                            dokumen = response.dokumen;
                            pesaing = response.pesaing;
                            console.log(barang);
                            var b = '#tabel-edit-barang';
                            tabelbarang(b,barang);
                            var d = '#tabel-edit-dokumen';
                            tabeldokumen(d,dokumen);
                            var h = '#tabel-edit-history';
                            tabelhistory(h,pesaing);


                            // $('#edit_instansi')
                            //     .val(response.tender.instansi) //select option of select2
                            //     .trigger("change"); //apply to select2

                            // $('#edit_pic')
                            //     .val(response.tender.pic) //select option of select2
                            //     .trigger("change"); //apply to select2
                          } else {
                            Toast.fire({
                              icon: 'error',
                              title: response.pesan
                            })
                          }
                        }
                    });
                });
                $('#form-edit').submit(function(e){
                    e.preventDefault(); // prevent actual form submit
                    var el = $('#btn-edit');
                    el.prop('readonly', true);
                    setTimeout(function(){el.prop('readonly', false); }, 3000);
                    var token = "{!! csrf_token() !!}";
                    var kode = $('#edit-kode').val();
                    $.ajax({
                      type: 'PUT',
                      url: '{!! url("data-aset/'+kode+'") !!}',
                      data : {
                        perusahaan: $('#edit_perusahaan').val(),
                        jenis    : $('#edit_jenis').val(),
                        tipe     : $('#edit-tipe').val(),
                        nama     : $('#edit-nama').val(),
                        _token   : token,
                        qty      : $('#edit-qty').val(),
                        harga    : $('#edit-harga').val(),
                        tgl_pembelian : $('#edit-pembelian').val(),
                        lokasi   : $('#edit-lokasi').val(),
                        kondisi  : $('#edit-kondisi').val(),
                        keterangan : $('#edit-keterangan').val(),
                        mesin    : $('#edit-nomesin').val(),
                        rangka   : $('#edit-norangka').val(),
                        plat     : $('#edit-plat').val(),
                      }, // serializes form input
                      success:function(response) {

                        if(response.success = true){
                          Toast.fire({
                            icon: 'success',
                            title: response.pesan
                          })
                          $('#modal-edit').modal('hide');
                          var table = $('#tabel-aset').DataTable();
                          table.ajax.reload( null, false );
                          $('#tambahdata').focus();
                        } else {
                          Toast.fire({
                            icon: 'error',
                            title: response.pesan
                          })
                        }

                      },
                    });
                  });

                //Tambah Barang
                    $('#edit-tambah-barang').click(function(e){
                        $('#edt-add-barang').show(); $(this).hide();
                        $('#edit_tambah_barang').val(""); $('#edit_tambah_qty').val(""); $('#edit_tambah_satuan').val(""); $('#edit_tambah_hps').val("");
                        $('#edit_tambah_harga').val(""); $('#edit_tambah_kegunaan').val(""); $('#edit_tambah_spec').val(""); $('#edit_tambah_ongkir').val();
                    });
                    $('#btn-edit-close-barang').click(function(){
                       $('#edit-tambah-barang').show(); $('#edt-add-barang').hide();
                    });
                    $('#btn-edit-tambah-barang').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var nama = $('#edit_tambah_barang').val();
                        var qty = $('#edit_tambah_qty').val();
                        var satuan = $('#edit_tambah_satuan').val();
                        var hps = $('#edit_tambah_hps').val();
                        var harga = $('#edit_tambah_harga').val();
                        var ongkir = $('#edit_tambah_ongkir').val();
                        var keg = $('#edit_tambah_kegunaan').val();
                        var spec = $('#edit_tambah_spec').val();
                        var id = generateUniqueId(); // Membuat ID unik

                        var data = {
                            id : id,
                            nama : nama,
                            qty : qty,
                            satuan : satuan,
                            hps : hps,
                            harga : harga,
                            ongkir : ongkir,
                            kegunaan : keg,
                            spec : spec,
                            status : "tambah"

                        };
                        console.log(data);
                        try{
                            barang.push(data);

                            $('#edt-add-barang').hide();
                            $('#edit-tambah-barang').show();
                            var handler = '#tabel-edit-barang';
                            var footer = '#footer-edit-barang';
                            tabelbarang(handler,barang,footer);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                              })
                        }
                    })
                //Tambah Barang
                // Edit Barang
                    $('body').on('click','.editbarang',function(e){
                        $('#edt-edit-barang').show(); $('#edit-tambah-barang').hide();
                        $('#edit_edit_barang').val(""); $('#edit_edit_qty').val("0"); $('#edit_edit_satuan').val(""); $('#edit_edit_hps').val("0");
                        $('#edit_edit_harga').val("0"); $('#edit_edit_kegunaan').val(""); $('#edit_edit_spec').val("");
                        var id = $(this).data("kode");
                        $('#edit_id_barang').val(id);
                        var d = barang.find(p => p.id === id);
                        // Memeriksa apakah produk ditemukan
                        if (d) {
                            // Menampilkan data produk ke dalam input box
                            $('#edit_edit_barang').val(d.nama);
                            $('#edit_edit_qty').val(d.qty);
                            $('#edit_edit_satuan').val(d.satuan);
                            $('#edit_edit_hps').val(d.hps);
                            $('#edit_edit_harga').val(d.harga);
                            $('#edit_edit_ongkir').val(d.ongkir);
                            $('#edit_edit_kegunaan').val(d.kegunaan);
                            $('#edit_edit_spec').val(d.spec);
                        } else {
                            // Jika produk tidak ditemukan, bersihkan input box
                            Toast.fire({
                                icon    :'error',
                                title   : "Data Tidak Ditemukan"
                            });
                        }
                    });
                    $('#btn-edit-edit-close-barang').click(function(e){
                        $('#edit-tambah-barang').show(); $('#edt-edit-barang').hide();
                    });
                    $('#btn-edit-edit-barang').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $('#edit_id_barang').val();

                        var nama = $('#edit_edit_barang').val();
                        let qty = $('#edit_edit_qty').val();
                        var satuan = $('#edit_edit_satuan').val();
                        let hps = $('#edit_edit_hps').val();
                        let harga = $('#edit_edit_harga').val();
                        let ongkir = $('#edit_edit_ongkir').val();
                        var kegunaan = $('#edit_edit_kegunaan').val();
                        var spec = $('#edit_edit_spec').val();
                        var status = "edit";

                        for (var i = 0; i < barang.length; i++) {
                          if (barang[i].id === id) {
                            try{
                                // Memperbarui data objek
                                barang[i].nama = nama ;
                                barang[i].qty = qty ;
                                barang[i].satuan = satuan ;
                                barang[i].hps = hps ;
                                barang[i].harga = harga ;
                                barang[i].ongkir = ongkir ;
                                barang[i].kegunaan = kegunaan ;
                                barang[i].spec = spec ;
                                barang[i].status = status ;

                                $('#edt-edit-barang').hide();
                                $('#edit-tambah-barang').show();
                                var handler = '#tabel-edit-barang';
                                var footer = '#footer-edit-barang';
                                tabelbarang(handler,barang,footer);

                                Toast.fire({
                                    icon    : 'success',
                                    title  : "Data Berhasil Diubah"
                                });
                            } catch(error){
                                Toast.fire({
                                    icon    : 'error',
                                    title  : error
                                });
                            }
                            break;
                          }
                        }

                    });
                // Edit Barang
                // Hapus Barang
                    $('body').on('click','.edthapusbarang',function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $(this).data("kode");
                        var index = barang.findIndex(p => p.id === id);
                        var status = "hapus";
                        if(index !== -1) {
                            try{
                                barang[index].status = status ;
                                $('#edt-hapus-barang').hide();
                                $('#edit-tambah-barang').show();
                                var handler = '#tabel-edit-barang';
                                var footer = '#footer-edit-barang';
                                tabelbarang(handler,barang,footer);
                                Toast.fire({
                                    icon    : 'success',
                                    title  : "Data Berhasil Dihapus"
                                });
                            } catch(error){
                                Toast.fire({
                                    icon    : 'error',
                                    title  : error
                                });
                            }
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title  : "Data Tidak Ditemukan"
                            });
                        }
                    })
                // Hapus Barang
                // Tambah Dokumen
                    $('#edit-tambah-dokumen').click(function(){
                       $('#edt-add-doc').show(); $(this).hide();
                       $('#edit_tambah_dokumen').val(""); $('#edit_tambah_keterangan').val("");
                       document.querySelectorAll('input[name="edit_tambah_siap"]').forEach(function(radio) {
                            radio.checked = false;
                       });
                      $(this).hide();
                    });
                    $('#btn-edit-close-dokumen').click(function(){
                        $('#edt-add-doc').hide();$('#edit-tambah-dokumen').show();
                    })
                    $('#btn-edit-tambah-dokumen').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var nama = $('#edit_tambah_dokumen').val();
                        var ket = $('#edit_tambah_keterangan').val();
                        var siap = document.querySelector('input[name="edit_tambah_siap"]:checked').value;
                        var id = generateUniqueId(); // Membuat ID unik
                        var doc = {
                            id : id,
                            nama : nama,
                            keterangan : ket,
                            siap : siap,
                            status : "tambah",
                        };
                        try{
                            dokumen.push(doc);
                            $('#edt-add-doc').hide();
                            $('#edit-tambah-dokumen').show();
                            var tabel = '#tabel-edit-dokumen';
                            tabeldokumen(tabel,dokumen);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        }
                    });
                // Tambah Dokumen
                // Edit Dokumen
                    $('body').on('click', '.editdokumen', function () {
                        $('#edt-edit-doc').show();
                        $('#edit-tambah-dokumen').hide();
                        $('#edit_edit_dokumen').val('');
                        $('#edit_edit_keterangan').val('');
                        $('input[name="edit_edit_siap"]').prop('checked', false);
                        var id = $(this).data("kode");
                        $('#edit_id_dokumen').val(id);
                        var d = dokumen.find(p => p.id === id);
                        if (d) {
                            // Menampilkan data produk ke dalam input box
                            $('#edit_edit_dokumen').val(d.nama);
                            $('#edit_edit_keterangan').val(d.keterangan);
                            if (d.siap === "ya") {
                                $('#ya').prop('checked', true);
                            } else {
                                $('#tidak').prop('checked', true);
                            }
                        } else {
                            // Jika produk tidak ditemukan, bersihkan input box
                            Toast.fire({
                                icon: 'error',
                                title: "Data Tidak Ditemukan"
                            });
                        }
                    });
                    $('#btn-edit-edit-close-dokumen').click(function(){
                        $('#edt-edit-doc').hide();$('#edit-tambah-dokumen').show();
                    })
                    $('#btn-edit-edit-dokumen').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $('#edit_id_dokumen').val();
                        console.log(id);

                        var nama = $('#edit_edit_dokumen').val();
                        var keterangan = $('#edit_edit_keterangan').val();
                        var siap = document.querySelector('input[name="edit_edit_siap"]:checked').value;
                        console.log(siap);
                        var status = "edit";
                          // Memeriksa apakah objek ditemukan
                        for (var i = 0; i < dokumen.length; i++) {
                          if (dokumen[i].id == id) {
                            try{
                                // Memperbarui data objek
                                dokumen[i].nama = nama ;
                                dokumen[i].siap = siap ;
                                dokumen[i].keterangan = keterangan;
                                dokumen[i].status = status ;

                                $('#edt-edit-doc').hide();
                                $('#edit-tambah-dokumen').show();
                                var handler = '#tabel-edit-dokumen';
                                tabeldokumen(handler,dokumen);

                                Toast.fire({
                                    icon    : 'success',
                                    title  : "Data Berhasil Diubah"
                                });
                            } catch(error){
                                Toast.fire({
                                    icon    : 'error',
                                    title  : error
                                });
                            }
                            break;
                          }
                        }
                    })

                // Edit Dokumen
                // Hapus Dokumen
                    $('body').on('click','.edthapusdokumen',function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $(this).data("kode");
                        var index = dokumen.findIndex(p => p.id === id);
                        var status = "hapus";
                        if(index !== -1) {
                            try{
                                dokumen[index].status = status ;
                                $('#edit-tambah-dokumen').show();
                                var handler = '#tabel-edit-dokumen';
                                tabeldokumen(handler,dokumen);
                                Toast.fire({
                                    icon    : 'success',
                                    title  : "Data Berhasil Dihapus"
                                });
                            } catch(error){
                                Toast.fire({
                                    icon    : 'error',
                                    title  : error
                                });
                            }
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title  : "Data Tidak Ditemukan"
                            });
                        }
                    });
                // Hapus Dokumen
                // Tambah History
                    $('#edit-tambah-history').click(function(){
                       $('#edt-add-history').show(); $(this).hide();
                       var tender = $('#edit_tender').val();
                       $('#edit_tambah_history_tender').val(tender); $('#edit_tambah_history_perusahaan').val("");
                       $('#edit_tambah_history_harga').val(""); $('#edit_tambah_history_keterangan').val("");
                       document.querySelectorAll('input[name="edit_tambah_history_pemenang"]').forEach(function(radio) {
                            radio.checked = false;
                       });
                      $(this).hide();
                    });
                    $('#btn-edit-close-history').click(function(){
                        $('#edt-add-history').hide();$('#edit-tambah-history').show();
                    })
                    $('#btn-edit-tambah-history').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);

                        var perusahaan  = $('#edit_tambah_history_perusahaan').val();
                        let harga       = $('#edit_tambah_history_harga').val();
                        var tender      = $('#edit_tambah_history_tender').val();
                        var keterangan  = $('#edit_tambah_history_keterangan').val();
                        var pemenang    = document.querySelector('input[name="edit_tambah_history_pemenang"]:checked').value;
                        var id = generateUniqueId(); // Membuat ID unik
                        var da = {
                            id : id,
                            tender : tender,
                            perusahaan : perusahaan,
                            harga : harga,
                            menang : pemenang,
                            keterangan : keterangan,
                            status : "tambah"
                        };
                        console.log(da);
                        console.log(pesaing);
                        try{
                            pesaing.push(da);
                            $('#edt-add-history').hide();
                            $('#edit-tambah-history').show();
                            var tabel = '#tabel-edit-history';
                            tabelhistory(tabel,pesaing);
                            Toast.fire({
                                icon: 'success',
                                title: "Data Berhasil Ditambahkan"
                              })
                        } catch(error){
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        }
                    });
                // Tambah History
                // Edit History
                    $('body').on('click','.edithistory',function(){
                        $('#edit-tambah-history').hide();$('#edt-edit-history').show();$('#edt-add-history').hide();
                        var tender = $('#edit_tender').val();
                        $('#edit_edit_history_tender').val(tender); $('#edit_edit_history_perusahaan').val("");
                        $('#edit_edit_history_keterangan').val("");$('#edit_edit_history_keterangan').val("");
                        var id = $(this).data('kode');
                        $('#edit_id_history').val(id);
                        var d = pesaing.find(p => p.id === id);
                        if (d) {
                            $('#edit_edit_history_tender').val(d.tender);
                            $('#edit_edit_history_perusahaan').val(d.perusahaan);
                            $('#edit_edit_history_harga').val(d.harga);
                            $('#edit_edit_history_keterangan').val(d.keterangan);
                            if (d.menang === "yes") {
                                $('#yes').prop('checked',true);
                            } else {
                                $('#no').prop('checked',true);
                            }
                        } else {
                            // Jika produk tidak ditemukan, bersihkan input box
                            Toast.fire({
                                icon: 'error',
                                title: "Data Tidak Ditemukan"
                            });
                        }
                    });
                    $('#btn-edit-edit-close-history').click(function(){
                        $('#edt-edit-history').hide();$('#edit-tambah-history').show();
                    });
                    $('#btn-edit-edit-history').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $('#edit_id_history').val();
                        var tender = $('#edit_edit_history_tender').val();
                        var perusahaan = $('#edit_edit_history_perusahaan').val();
                        var harga = $('#edit_edit_history_harga').val();
                        var keterangan = $('#edit_edit_history_keterangan').val();
                        var menang = document.querySelector('input[name="edit_edit_history_pemenang"]:checked').value;
                        var status = "edit";
                        console.log(id);
                        for (var i = 0; i < pesaing.length; i++) {

                            if (pesaing[i].id == id) {

                                try{
                                    // Memperbarui data objek
                                    pesaing[i].tender = tender ;
                                    pesaing[i].perusahaan = perusahaan ;
                                    pesaing[i].harga = harga;
                                    pesaing[i].keterangan = keterangan;
                                    pesaing[i].menang = menang;
                                    pesaing[i].status = status ;

                                    $('#edt-edit-history').hide();
                                    $('#edit-tambah-history').show();
                                    var handler = '#tabel-edit-history';
                                    tabelhistory(handler,pesaing);

                                    Toast.fire({
                                        icon    : 'success',
                                        title  : "Data Berhasil Diubah"
                                    });
                                } catch(error){
                                    Toast.fire({
                                        icon    : 'error',
                                        title  : error
                                    });
                                }
                            }
                        }


                    });
                // Edit History
                // Hapus History
                    $('body').on('click','.edthapushistory',function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                        var id = $(this).data("kode");
                        var index = pesaing.findIndex(p => p.id === id);
                        var status = "hapus";
                        if(index !== -1) {
                            try{
                                pesaing[index].status = status ;
                                $('#edit-tambah-dokumen').show();
                                var handler = '#tabel-edit-history';
                                tabelhistory(handler,pesaing);
                                Toast.fire({
                                    icon    : 'success',
                                    title  : "Data Berhasil Dihapus"
                                });
                            } catch(error){
                                Toast.fire({
                                    icon    : 'error',
                                    title  : error
                                });
                            }
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title  : "Data Tidak Ditemukan"
                            });
                        }
                    });
                // Hapus History

                // Submit Edit
                    $('#btn-edit').click(function(e){
                        e.preventDefault(); // prevent actual form submit
                        var el = $(this);
                        el.prop('readonly', true);
                        setTimeout(function(){el.prop('readonly', false); }, 3000);
                       var id       = $('#edit_id').val();
                       var instansi = $('#edit_instansi').val();
                       var lokasi   = $('#edit_lokasi').val();
                       var link     = $('#edit_link').val();
                       var pic      = $('#edit_pic').val();
                       var cp       = $('#edit_cp').val();
                       var tender   = $('#edit_tender').val();
                       var skala    = $('#edit_skala').val();
                       var deadline = $('#edit_deadline').val();
                       var email    = $('#edit_email').val();
                       $.ajax({
                          url     : '{!! url("data-tender/'+id+'") !!}',
                          method : "put",
                          data  :{
                              _token : token,
                              instansi : instansi,
                              lokasi    : lokasi,
                              link      : link,
                              pic       : pic,
                              cp        : cp,
                              tender    : tender,
                              skala     : skala,
                              deadline  : deadline,
                              barang    : barang,
                              dokumen   : dokumen,
                              history   : pesaing,
                          },
                          success:function(response){
                              console.log(response);
                              if(response.success == true){
                                  $('#modal-edit').modal('hide');
                                  var table = $('#tabel-tender').DataTable();
                                  table.ajax.reload( null, false );
                                  Toast.fire({
                                      icon  : "success",
                                      title : response.pesan
                                  })
                              } else {
                                  Toast.fire({
                                      icon  : "error",
                                      title : response.pesan,
                                  })
                              }
                          },
                          error: function(jqXHR, textStatus, errorThrown) {
                            var errorMessage = "Terjadi kesalahan: " + jqXHR.responseJSON.message;
                            Toast.fire({
                                icon: 'error',
                                title: errorMessage
                            });
                          }
                       });

                    });
                // Submit Edit

            // Edit Tender
            // Hapus Tender
                $('body').on('click', '.hapus', function () {
                  document.getElementById("form-hapus").reset();
                  var nama = $(this).data('nama');
                  var kode = $(this).data('kode');

                  document.getElementById("hapus-nama").innerHTML = nama ;
                  $('#hapus-kode').val(kode);
                });
                $('#form-hapus').submit(function(e){
                    e.preventDefault(); // prevent actual form submit
                    var el = $('#btn-hapus');
                    el.prop('readonly', true);
                    setTimeout(function(){el.prop('readonly', false); }, 3000);
                    var token = "{!! csrf_token() !!}";
                    var kode = $('#hapus-kode').val();
                    $.ajax({
                      type    : 'delete',
                      url     : '{!! url("data-tender/'+kode+'") !!}',
                      data    : {
                        _token  : token,
                      },
                      success:function(response) {

                        if(response.success == true){
                          Toast.fire({
                            icon: 'success',
                            title: response.pesan
                          })
                          $('#modal-hapus').modal('hide');
                          var table = $('#tabel-tender').DataTable();
                          table.ajax.reload( null, false );
                        } else{
                          Toast.fire({
                            icon: 'error',
                            title: response.pesan
                          })
                        }
                      },
                    });
                });
            // Hapus Tender
            // Status Tender
                $('body').on('click', '.status', function () {
                  document.getElementById("form-status").reset();
                  var nama = $(this).data('nama');
                  var kode = $(this).data('kode');
                  var awal = $(this).data('awal');
                  var status = $(this).data('status');
                  var warna = $(this).data('warna');

                  $('#modal-status .modal-header').removeClass().addClass('modal-header');
                  $('#modal-status .modal-header').addClass(warna);
                  $('#btn-status').removeClass().addClass('col-sm-4 form-control btn');
                  $('#btn-status').addClass(warna);

                  document.getElementById("status-nama").innerHTML = nama ;
                  document.getElementById("status-awal").innerHTML = awal ;
                  document.getElementById("status-ubah").innerHTML = status ;
                  $('#status-id').val(kode);
                });
                $('#form-hapus').submit(function(e){
                    e.preventDefault(); // prevent actual form submit
                    var el = $('#btn-hapus');
                    el.prop('readonly', true);
                    setTimeout(function(){el.prop('readonly', false); }, 3000);
                    var token = "{!! csrf_token() !!}";
                    var kode = $('#hapus-kode').val();
                    $.ajax({
                      type    : 'delete',
                      url     : '{!! url("data-tender/'+kode+'") !!}',
                      data    : {
                        _token  : token,
                      },
                      success:function(response) {

                        if(response.success == true){
                          Toast.fire({
                            icon: 'success',
                            title: response.pesan
                          })
                          $('#modal-hapus').modal('hide');
                          var table = $('#tabel-tender').DataTable();
                          table.ajax.reload( null, false );
                        } else{
                          Toast.fire({
                            icon: 'error',
                            title: response.pesan
                          })
                        }
                      },
                    });
                });
            // Status Tender

            function generateUniqueId() {
                return '_' + Math.random().toString(36).substr(2, 9);
              }
              function angka(evt){
                  var charCode = (evt.which) ? evt.which : event.keyCode
                  if (charCode > 31 && (charCode < 48 || charCode > 57))

                      return false;
                  return true;
              }
              function formatRupiah(money) {
                return new Intl.NumberFormat('id-ID',
                  { style: 'currency', currency: 'IDR' }
                ).format(money);
              }
        </script>
