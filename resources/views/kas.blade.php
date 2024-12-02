<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Transaksi Kas</title>
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
            <h1>Transaksi Kas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
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

                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Transaksi Kas/Bank</button>

                </div>
                <br>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-kas" class="table table-striped table-bordered table-hover nowrap">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>M/K</th>
                    <th>Kode</th>
		            <th>Atas Nama</th>
                    <th>Ref</th>
                    <th>DPP</th>
                    <th>PPN</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
		            <th>Barang</th>
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
                <h4 class="modal-title">Buat Transaksi Kas/Bank</h4>
                <button type="button" id="btn-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-group">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Kas</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="tmb-tgl" class="form-control" type="date" required>
                                    <label>Kas Masuk/Keluar</label>
                                    <select id="tmb-jenis" class="form-control">
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="tmb-kode" class="form-control" type="text" value="" readonly required>
                                    <label>Jenis</label>
                                    <select id="tmb-jenis-kas" class="form-control" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="61">Purchase Order</option>
                                        <option value="42">Sales Order</option>
                                        <option value="43">Internal</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kas</label>
                                    <select id="tmb-debit" class="form-control select2" required></select>
                                    <label>Keterangan</label>
                                    <textarea id="tmb-keterangan" class="form-control" rows="2" style="resize: none;" placeholder="Keterangan Kas Masuk"></textarea>
                                </div>
                            </div>
                            <!-- Conditional Fields -->
                            <div id="conditional-fields">
                                <div class="po d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Purchase Order</label>
                                            <select id="tmb-po-kas" class="form-control select2" required>
                                                <option value="">Pilih Purchase Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Atas Nama</label>
                                            <input id="tmb-supplier-po" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-po" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-po" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-po" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-po" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-po" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                {{-- SO --}}
                                <div class="so d-none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode Sales Order</label>
                                            <select id="tmb-so-kas" class="form-control select2" required>
                                                <option value="">Pilih Kode Sales Order</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Atas Nama</label>
                                            <input id="tmb-konsumen-so" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-so" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-so" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-so" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-so" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-so" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Internal --}}
                                <div class="internal d-none">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Atas Nama</label>
                                            <input id="tmb-atam-internal" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>DPP</label>
                                            <input id="tmb-dpp-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>PPN</label>
                                            <input id="tmb-ppn-kas-internal" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Barang</label>
                                            <textarea id="tmb-brg-internal" class="form-control" style="resize:none;" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Jumlah</label>
                                            <input id="tmb-jumlah-internal" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Debit</label>
                                            <select id="kode-debet-akun-internal" class="form-control select2" required></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Akun Kredit</label>
                                            <select id="kode-kredit-akun-internal" class="form-control select2" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="edit-id" value="">
                        <form id="tmbkas">
                            <div class="modal-footer justify-content-between ">
                                <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/ Modal Tambah -->

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
                              <label class="col-md-8" id="hps_kode" > 	</label>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  <!--/ Modal Hapus  -->
  <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
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
                                      <input id="selesai-kode" class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class="col-md-3">Kode </label>
                                          <h6 class="col-md-6" id="kode-selesai"></h6>
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
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {
    $('#tabel-kas').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
          if (aData['status'] == "Sudah Diperiksa") {
            $('td', nRow).css('background-color', 'Yellow');
          } else if(aData['status'] == "Selesai"){
            $('td', nRow).css('background-color', ' #00FF64');
          } else{
            $('td', nRow).css('background-color', '');
          }
        },
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-kas") !!}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'dk', name: 'dk',orderable:true},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'atas_nama', name: 'atas_nama',orderable:true},
            { data: 'kode_ref', name: 'kode_ref',orderable:false},
            {
                data: 'dpp',
                name: 'dpp',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'ppn',
                name: 'ppn',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                orderable: false,
                render: function(data, type, row) {
                    return formatRupiah(data);
                }
            },
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'barang', name: 'barang',orderable:false},
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
  if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
    tgl = '0'+tgl;
    }
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var time = date+' '+time;

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  var token = "{!! csrf_token() !!}";
  //TAMBAH DATA
    $(document).on('click','#tambahdata',function(){
        $('#tmb-tgl').val('');$('#tmb-kode').val('');$('#tmb-debit').val('');$('#tmb-rekanan').val('');$('#tmb-keterangan').val('');$('#kunci').prop('checked',false);
        $('#tmb-tgl').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
        $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
        $('#tmb-debit').select2({
          placeholder : 'Pilih Kas Terima',
          ajax  :{
            url : '{!! url("dropdown-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama_perkiraan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        $('#tmb-po-kas').select2({
          placeholder : 'Pilih Kode PO',
          ajax  :{
            url : '{!! url("dropdown-po-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                                text: item.kode,
                                id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        $('#tmb-so-kas').select2({
          placeholder : 'Pilih Kode SO',
          ajax  :{
            url : '{!! url("dropdown-so-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });


    });
    // PO
    $(document).on('change','#tmb-po-kas',function(){
        var po = $(this).val();
        $.ajax({
            url     :'{!! url("data-po-kas/'+po+'/edit") !!}',
            type    : 'get',
            success : function(data){
            // console.log(data);
            @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                $('#tmb-jumlah-po').val(data.po.total);
            @else
                $('#tmb-jumlah-po').val(0);
            @endif
            if(data.po.perusahaan == "-" || data.po.perusahaan == null){
                $('#tmb-perusahaan').val("npa");
            } else {
                $('#tmb-perusahaan').val(data.po.perusahaan);
            }
            $('#tmb-dpp-po').val(data.po.dpp);
            $('#tmb-supplier-po').val(data.po.nama);
            $('#tmb-ppn-kas-po').val(((data.po.vat / 100) * data.po.dpp));
            $('#tmb-brg-po').val(data.po.barang);
            }
        });
    })
    // END PO

    // SO
    $(document).on('change','#tmb-so-kas',function(){
            var so = $(this).val();
            $.ajax({
              url     :'{!! url("data-so-kas/'+so+'/edit") !!}',
              type    : 'get',
              success : function(data){
                // console.log(data);
                @if($user->level == 'superadmin' || $user->level == 'ceo' ||$user->level == 'purchasing' || $user->level == 'manager-admin')
                    $('#tmb-jumlah-so').val((data.so.total));
                @else
                    $('#tmb-jumlah-so').val((0));
                @endif
                if(data.so.perusahaan == "-" || data.so.perusahaan == null){
                    $('#tmb-perusahaan').val("npa");
                } else {
                    $('#tmb-perusahaan').val(data.so.perusahaan);
                }
                $('#tmb-dpp-so').val((data.so.dpp));
                $('#tmb-konsumen-so').val(data.so.nama);
                $('#tmb-ppn-kas-so').val(((data.so.vat / 100) * data.so.dpp));
                $('#tmb-brg-so').val(data.so.barang);
              }
            });
        })

    // END SO

    $('#kode-kredit-akun-po, #kode-debet-akun-po, #kode-kredit-akun-so, #kode-debet-akun-so, #kode-kredit-akun-internal, #kode-debet-akun-internal').select2({
        ajax: {
            url: '{!! url("dropdown-akuntansi") !!}',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
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

    // Jenis Change
    document.addEventListener('DOMContentLoaded', function () {
        const jenisKasSelect = document.getElementById('tmb-jenis-kas');
        const poSection = document.querySelector('.po');
        const soSection = document.querySelector('.so');
        const internalSection = document.querySelector('.internal');
        const conditionalFields = document.getElementById('conditional-fields');

        // Hide conditional fields by default
        conditionalFields.style.display = 'none';

        jenisKasSelect.addEventListener('change', function () {
            const value = this.value;

            // Reset visibility
            poSection.classList.add('d-none');
            soSection.classList.add('d-none');
            internalSection.classList.add('d-none');

            // Show relevant section based on selected value
            if (value === '61') {
                poSection.classList.remove('d-none');
            } else if (value === '42') {
                soSection.classList.remove('d-none');
            } else if (value === '43') {
                internalSection.classList.remove('d-none');
            }

            // Show or hide conditional fields container
            conditionalFields.style.display = value ? 'block' : 'none';
        });
    });

    $('#tmb-tgl').on('change',function(){
        var tgl = $(this).val();
        var th = tgl.substr(2,2);
        var bln = tgl.substr(5,2);
        var n = th+bln;
        $.ajax({
            url     :'{!! url("lastkode-kas") !!}',
            type    : 'get',
            data    : {
                tanggal : n,
            },
            success : function(data){
                $('#tmb-kode').val(data);
            }
        });
    });
    $('#kunci').on('change',function(){
        var kode =  $('#tmb-kode').val();
        var tanggal = $('#tmb-tgl').val();
        var kas = $('#tmb-debit').val();var jenis = $('#tmb-jenis').val();
        var checkBox = document.getElementById("kunci");
        if( kode == null){
            Toast.fire({icon: 'error',title: 'Semua Field Wajib Diisi !!'})
            return false;
        } else if( tanggal == null){
            Toast.fire({icon: 'error',title: 'Tanggal Wajib Diisi !!'})
            return false;
        } else if (kas == null){
            Toast.fire({icon: 'error',title: 'Kas Wajib Diisi !!'})
            return false;
        }  else if (jenis == null){
            Toast.fire({icon: 'error',title: 'Jenis Wajib Diisi !!'})
            return false;
        } else {

        }
        if(checkBox.checked == true){
            $('#btn-add-barang').show();
            $('#tmb-tgl').prop('disabled',true);$('#tmb-jenis').prop('disabled',true);$('#tmb-keterangan').prop('disabled',true);$('#tmb-debit').prop('disabled',true);
        } else {
            $('#tmb-tgl').prop('disabled',false);$('#tmb-jenis').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
            $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
           $.ajax({
            type    : 'delete',
            url     : '{!! url ("hapus-kas/'+kode+'")!!}',
            data    : {_token : token,user : "{{$user->kode_karyawan}}"},
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan,
                    });
                    $('#tbl_kas_tambah').empty();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
           });
        }
    });

    $('#tmbkas').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-tambah');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var tanggal = $('#tmb-tgl').val();
        var kas =  $('#tmb-debit').val();
        var ket     = $('#tmb-keterangan').val();
        var kode = $('#tmb-kode').val();
        //Validasi
            if(tanggal == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Tanggal Wajib Diisi',
                });
                return false ;
            } else {}
            if(kode == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kode Wajib Diisi',
                });
                return false ;
            } else {}
            if(kas == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kas Wajib Diisi',
                });
                return false  ;
            } else {}
            if(ket == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Keterangan Wajib Diisi',
                });
                return false ;
            } else {}
        //Validasi
        $.ajax({
            type: 'post',
            url: "{!! url('data-kas') !!}",
            data: {
                _token: token,
                kode: $('#tmb-kode').val(),
                keterangan: $('#tmb-keterangan').val(),
                tanggal: $('#tmb-tgl').val(),
                dk: $('#tmb-jenis').val(),
                jenis: $('#tmb-jenis-kas').val(),

                kode_ref: $('#tmb-po-kas:visible, #tmb-so-kas:visible').val(),
                atas_nama: $('#tmb-supplier-po:visible, #tmb-konsumen-so:visible, #tmb-atam-internal:visible').val(),
                barang: $('#tmb-brg-po:visible, #tmb-brg-so:visible, #tmb-brg-internal:visible').val(),
                dpp: $('#tmb-dpp-po:visible, #tmb-dpp-so:visible, #tmb-dpp-internal:visible').val(),
                ppn: $('#tmb-ppn-kas-po:visible, #tmb-ppn-kas-so:visible, #tmb-ppn-kas-internal:visible').val(),
                jumlah: $('#tmb-jumlah-po:visible, #tmb-jumlah-so:visible, #tmb-jumlah-internal:visible').val(),
                debit: $('#kode-debet-akun-po:visible, #kode-debet-akun-so:visible, #kode-debet-akun-internal:visible').val(),
                kredit: $('#kode-kredit-akun-po:visible, #kode-kredit-akun-so:visible, #kode-kredit-akun-internal:visible').val(),

                user: "{{$user->kode_karyawan}}",
            },
            success: function (response) {
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: response.pesan,
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#tabel-kas').DataTable();
                    table.ajax.reload(null, false);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.pesan,
                    });
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                Toast.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan saat menyimpan data!',
                });
            }
        });

    });
  //TAMBAH DATA
  //HAPUS DATA
    $('body').on('click','.hapus',function(){
        var kode  = $(this).data('kode');
        $('#hps-kode').val(kode);
        $('#hps_kode').html(kode);
    });
    $('#hapus').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-hapus');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var kode = $('#hps-kode').val();
        $.ajax({
        type    : 'delete',
        url     : '{!! url("data-kas/'+kode+'") !!}',
        data    : {
            _token  : token,
            user : "{{$user->kode_karyawan}}",
        },
        success:function(response) {
            // console.log(response);
            var hasil = response.pesan;
            if(response.success){
            Toast.fire({
                icon: 'success',
                title: hasil
            })
            $('#modal-hapus').modal('hide');
            var table = $('#tabel-kas').DataTable();
            table.ajax.reload( null, false );
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
    return new Intl.NumberFormat('id-ID',
        { style: 'currency', currency: 'IDR' }
    ).format(money);
}

</script>
</body>
</html>
