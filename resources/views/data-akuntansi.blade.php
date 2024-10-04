<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Akuntansi</title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1>Data Kode Akuntansi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Kode Akuntansi</li>
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
                <div class="col-md-2">
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn btn-block bg-gradient-primary">Tambah Kode </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th rowspan="2">Action</th>
                      <th rowspan="2">Kode</th>
                      <th rowspan="2" >Nama Perkiraan</th>
                      <th rowspan="2">D/K</th>
                      <th colspan="3" style="text-align: center;">Group</th>
                      <th colspan="3" style="text-align: center;">Laporan</th>
                      <th rowspan="2">Keterangan</th>
                    </tr>
                    <tr>
                      <th>Nama</th>
                      <th>Nomor</th>
                      <th>Nomor Urut</th>
                      <th>Nomor Urut</th>
                      <th>Jenis</th>
                      <th>Group</th>
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
  <!-- MODAL Tambah -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
          <div class="modal-content">
              <form id="tambah">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Kode Akuntansi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-2">
                          <label>Kode</label>
                          <input type="number" class="form-control"  id="tambah-kode" name="tambah-kode" step=".01" pattern="^\d*(\.\d{0,2})?$">
                      </div>
                      <div class="col-lg-10">
                        <label>Nama Perkiraan</label>
                        <input type="text" class="form-control" id="tambah-perkiraan" name="tambah-perkiraan" required >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Jenis</label>
                        <select id="tambah-jenis" class="form-control" name="tambah-jenis" required>
                          <option value="">Pilih Jenis</option>
                          <option value="D">Debit</option>
                          <option value="K">Kredit</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label> Group</label>
                        <select id="tambah-group" class="form-control" name="tambah-group" required>
                          <option value="">Pilih Group</option>
                          <option value="1">Kas</option>
                          <option value="2">Bank</option>
                          <option value="3">Deposito</option>
                          <option value="4">Piutang Usaha</option>
                          <option value="5">Piutang lainlain</option>
                          <option value="6">Uang Muka Pembelian</option>
                          <option value="7">uang Muka Pembelian</option>
                          <option value="8">Pajak Dibayar Dimuka</option>
                          <option value="9">Persediaan</option>
                          <option value="10">Aktiva Tetap</option>
                          <option value="11">Aktiva Tetap</option>
                          <option value="12">Akumulasi Penyusutan</option>
                          <option value="13">Hutang Usaha</option>
                          <option value="14">Hutang Usaha</option>
                          <option value="141">Hutang Lain-Lain</option>
                          <option value="15">Hutang Biaya</option>
                          <option value="16">Hutang Lainnya</option>
                          <option value="17">Hutang Pajak</option>
                          <option value="18">Laba Ditahan</option>
                          <option value="19">Uang Muka Penjualan</option>
                          <option value="20">Modal</option>
                          <option value="21">Penjualan</option>
                          <option value="22">Penjualan</option>
                          <option value="23">Biaya Karyawan</option>
                          <option value="24">Biaya General / Operasional</option>
                          <option value="25">Biaya Pembelian/ Perolehan</option>
                          <option value="26">Biaya Penjualan</option>
                          <option value="27">Pendapatan Lain-Lain</option>
                          <option value="28">Beban Lain-Lain</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label>Nomor</label>
                        <input type="text" onkeypress="return angka('evt')" id="tambah-nomor" class="form-control" required>
                      </div>
                      <div class="col-lg-2">
                        <label>Urutan</label>
                        <input type="text" onkeypress="return angka('evt')" id="tambah-urutan-group" class="form-control" name="tambah-urutan-group" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Urutan Laporan</label>
                        <input type="text" onkeypress="return angka('evt')" id="tambah-urutan-laporan" class="form-control" name="tambah-urutan-laporan" required>
                      </div>
                      <div class="col-lg-4">
                        <label> Jenis Laporan</label>
                        <select  id="tambah-jenis-laporan" class="form-control" name="tambah-jenis-laporan" required>
                          <option value="">Pilih Laporan</option>
                          <option value="neraca">Neraca</option>
                          <option value="laba/rugi">Laba / Rugi</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label> Group Laporan</label>
                        <select  id="tambah-group-laporan" class="form-control" name="tambah-group-laporan">
                          <option value="">Pilih Laporan</option>
                          <option value="aktiva lancar">Aktiva Lancar</option>
                          <option value="aktiva tetap">Aktiva Tetap</option>
                          <option value="pasiva lancar">Pasiva Lancar</option>
                          <option value="pasiva tetap">Pasiva Tetap</option>
                          <option value="modal">Modal</option>
                          <option value="laba ditahan">Laba Ditahan</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-5">
                        <label>Keterangan</label>
                        <textarea class="form-control" id="tambah-keterangan" name="tambah-keterangan"  rows="3" placeholder="Keterangan""></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit-tambah" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Tambah -->
  <!-- MODAL Detail -->
   <div class="modal fade" id="modal-detail">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detail Kode Akuntansi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-2">
                    <label>Kode</label>
                    <input type="text" class="form-control" id="detail-kode" disabled>
                </div>
                <div class="col-lg-10">
                  <label>Nama Perkiraan</label>
                  <input type="text" class="form-control" id="detail-perkiraan" disabled >
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <label>Jenis</label>
                  <input type="text" id="detail-jenis" class="form-control" disabled>
                </div>
                <div class="col-lg-4">
                  <label> Group</label>
                  <input type="text" id="detail-group" class="form-control" disabled>
                </div>
                <div class="col-lg-2">
                  <label>Nomor</label>
                  <input type="text" id="detail-nomor" class="form-control" onkeypress="return angka('evt')" disabled>
                </div>
                <div class="col-lg-2">
                  <label>Urutan</label>
                  <input type="text" id="detail-urutan-group" class="form-control" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <label>Urutan Laporan</label>
                  <input type="text" id="detail-urutan-laporan" class="form-control" disabled>
                </div>
                <div class="col-lg-4">
                  <label> Jenis Laporan</label>
                  <input type="text" id="detail-jenis-laporan" class="form-control" disabled>
                </div>
                <div class="col-lg-4">
                  <label> Group Laporan</label>
                  <input type="text" id="detail-group-laporan" class="form-control" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-5">
                  <label>Keterangan</label>
                  <textarea class="form-control" id="detail-keterangan"  rows="3" placeholder="Keterangan" style="resize: none;" disabled></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
    </div>
  <!--/ Modal Detail -->
  <!-- MODAL Edit -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
          <div class="modal-content">
              <form id="edit">
                  <div class="modal-header bg-warning">
                      <h4 class="modal-title">Edit Kode Akuntansi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-2">
                          <label>Kode</label>
                          <input type="text" class="form-control" id="edit-kode" required>
                      </div>
                      <div class="col-lg-10">
                        <label>Nama Perkiraan</label>
                        <input type="text" class="form-control" id="edit-perkiraan" required >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Jenis</label>
                        <select id="edit-jenis" class="form-control" required>
                        <option value="">Pilih Jenis</option>
                          <option value="D">Debit</option>
                          <option value="K">Kredit</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label> Group</label>
                        <select id="edit-group" class="form-control" required>
                        <option value="">Pilih Group</option>
                          <option value="1">Kas</option>
                          <option value="2">Bank</option>
                          <option value="3">Deposito</option>
                          <option value="4">Piutang Usaha</option>
                          <option value="5">Piutang lainlain</option>
                          <option value="6">Uang Muka Pembelian</option>
                          <option value="7">uang Muka Pembelian</option>
                          <option value="8">Pajak Dibayar Dimuka</option>
                          <option value="9">Persediaan</option>
                          <option value="10">Aktiva Tetap</option>
                          <option value="11">Aktiva Tetap</option>
                          <option value="12">Akumulasi Penyusutan</option>
                          <option value="13">Hutang Usaha</option>
                          <option value="14">Hutang Usaha</option>
                          <option value="141">Hutang Lain-Lain</option>
                          <option value="15">Hutang Biaya</option>
                          <option value="16">Hutang Lainnya</option>
                          <option value="17">Hutang Pajak</option>
                          <option value="18">Laba Ditahan</option>
                          <option value="19">Uang Muka Penjualan</option>
                          <option value="20">Modal</option>
                          <option value="21">Penjualan</option>
                          <option value="22">Penjualan</option>
                          <option value="23">Biaya Karyawan</option>
                          <option value="24">Biaya General / Operasional</option>
                          <option value="25">Biaya Pembelian/ Perolehan</option>
                          <option value="26">Biaya Penjualan</option>
                          <option value="27">Pendapatan Lain-Lain</option>
                          <option value="28">Beban Lain-Lain</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <label> Nomor</label>
                        <input type="text" id="edit-nomor" class="form-control" onkeypress="return angka('evt')">
                      </div>
                      <div class="col-lg-2">
                        <label>Urutan</label>
                        <input type="text" id="edit-urutan-group" class="form-control" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <label>Urutan Laporan</label>
                        <input type="text" id="edit-urutan-laporan" class="form-control" required>
                      </div>
                      <div class="col-lg-4">
                        <label> Jenis Laporan</label>
                        <select  id="edit-jenis-laporan" class="form-control" required>
                          <option value="neraca">Neraca</option>
                          <option value="laba/rugi">Laba / Rugi</option>
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label> Group Laporan</label>
                        <select  id="edit-group-laporan" class="form-control">
                          <option value="aktiva lancar">Aktiva Lancar</option>
                          <option value="aktiva tetap">Aktiva Tetap</option>
                          <option value="pasiva lancar">Pasiva Lancar</option>
                          <option value="pasiva tetap">Pasiva Tetap</option>
                          <option value="modal">Modal</option>
                          <option value="laba ditahan">Laba Ditahan</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-5">
                        <label>Keterangan</label>
                        <textarea class="form-control" id="edit-keterangan"  rows="3" placeholder="Keterangan""></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit-edit" class="col-sm-2 form-control btn btn-warning">Edit</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Edit -->
  <!-- MODAL Hapus -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    Apakah Anda Yakin Akan Menghapus Data ini ?
                                    <input id="hapus-kode"class="form-control" type="text" hidden >
                                    <div class="row">
                                        <label class=" col-md-3">KODE </label>
                                        <h6 class="col-md-6" id="kode-hapus"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  <!--/ Modal Hapus  -->
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
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {
    $('#tabel').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-akuntansi") !!}',
        columns: [
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama_perkiraan', name: 'nama_perkiraan',orderable:true},
            { data: 'jenis', name: 'jenis',orderable:true},
            { data: 'group', name: 'group',orderable:false},
            { data: 'no_group', name: 'no_group',orderable:true},
            { data: 'no_urut_group', name: 'no_urut_group',orderable:true},
            { data: 'no_urut_laporan', name: 'no_urut_laporan',orderable:true},
            { data: 'jenis_laporan', name: 'jenis_laporan',orderable:true},
            { data: 'group_laporan', name: 'group_laporan',orderable:true},
            { data: 'keterangan', name: 'keterangan',orderable:true},
        ]
    });
  });
  $('#tambahdata').on('click',function(){
    document.getElementById("tambah").reset();
    $('#tambah-kode').focus();
  });
  $('#tambah').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-submit-tambah');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-akuntansi") !!}',
      data : {
        _token : token,
        kode    : $('#tambah-kode').val(),
        nama    : $('#tambah-perkiraan').val(),
        jenis   : $('#tambah-jenis').val(),
        group   : $('#tambah-group').val(),
        nomor   : $('#tambah-nomor').val(),
        urutan1 : $('#tambah-urutan-group').val(),
        urutan2 : $('#tambah-urutan-laporan').val(),
        laporan : $('#tambah-jenis-laporan').val(),
        glaporan: $('#tambah-group-laporan').val(),
        keterangan :$('#tambah-keterangan').val(),
        user    : "{{$user->kode_karyawan}}",


      }, // serializes form input
      success:function(response) {

        if(response.success == true) {
          Toast.fire({
            icon: 'success',
            title: response.pesan
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel').DataTable();
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
  // Edit Data
    $(document).on('click','.edit',function(){
      document.getElementById("edit").reset();
      var kode = $(this).data('kode');
      $.ajax({
        url   :'{!! url("data-akuntansi/'+kode+'/edit") !!}',
        type  : 'get',
        success:function(response){
        //   console.log(response);
          if(response.success == true){
            $('#edit-kode').val(response.data.kode);
            $('#edit-perkiraan').val(response.data.nama_perkiraan);
            $('#edit-jenis').val(response.data.jenis);
            $('#edit-group').val(response.data.no_group);
            $('#edit-nomor').val(response.data.nomor);
            $('#edit-urutan-group').val(response.data.no_urut_group);
            $('#edit-urutan-laporan').val(response.data.no_urut_laporan);
            $('#edit-jenis-laporan').val(response.data.jenis_laporan);
            $('#edit-group-laporan').val(response.data.group_laporan);
            $('#edit-keterangan').val(response.data.keterangan);
          }else {
            Toast.fire({
              icon: 'error',
              title: response.pesan
            })
          }
        }
      });
    });
    $('#edit').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#btn-submit-edit');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var token = "{!! csrf_token() !!}";
      var kode = $('#edit-kode').val();
      $.ajax({
        url   : '{!! url("data-akuntansi/'+kode+'") !!}',
        type  : 'put',
        data  : {
          _token  : token,
          kode    : kode,
          nama    : $('#edit-perkiraan').val(),
          jenis   : $('#edit-jenis').val(),
          group   : $('#edit-group').val(),
          nomor   : $('#edit-nomor').val(),
          urutan1 : $('#edit-urutan-group').val(),
          urutan2 : $('#edit-urutan-laporan').val(),
          laporan : $('#edit-jenis-laporan').val(),
          glaporan: $('#edit-group-laporan').val(),
          keterangan :$('#edit-keterangan').val(),
          user    : "{{$user->kode_karyawan}}",
        },
        success:function(response){
        //   console.log(response);
          if(response.success == true){
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
            $('#modal-edit').modal('hide');
            var table = $('#tabel').DataTable();
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
  // Edit Data
  //Detail Data
    $(document).on('click','.detail',function(){
      var kode = $(this).data('kode');
      $.ajax({
        url   :'{!! url("data-akuntansi/'+kode+'/edit") !!}',
        type  : 'get',
        success:function(response){
        //   console.log(response);
          if(response.success == true){
            $('#detail-kode').val(response.data.kode);
            $('#detail-perkiraan').val(response.data.nama_perkiraan);
            $('#detail-jenis').val(response.data.jenis);
            $('#detail-group').val(response.data.group);
            $('#detail-nomor').val(response.data.nomor);
            $('#detail-urutan-group').val(response.data.no_urut_group);
            $('#detail-urutan-laporan').val(response.data.no_urut_laporan);
            $('#detail-jenis-laporan').val(response.data.jenis_laporan);
            $('#detail-group-laporan').val(response.data.group_laporan);
            $('#detail-keterangan').val(response.data.keterangan);
          }else {
            Toast.fire({
              icon: 'error',
              title: response.pesan
            })
          }
        }
      });
    });
  //Detail Data
  //Hapus Data
    $(document).on('click','.hapus',function(){
      var kode = $(this).data('kode');
      $('#hapus-kode').val(kode);
      $('#kode-hapus').html(kode);
    });
    $('#hapus').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#btn-submit-hapus');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var token = "{!! csrf_token() !!}";
      var kode = $('#hapus-kode').val();
      $.ajax({
        url   : '{!! url("data-akuntansi/'+kode+'") !!}',
        type  : 'delete',
        data  : {
          _token  : token,
          user    : "{{$user->kode_karyawan}}",
        },
        success:function(response){
        //   console.log(response);
          if(response.success == true){
            Toast.fire({
              icon: 'success',
              title: response.pesan
            })
            $('#modal-hapus').modal('hide');
            var table = $('#tabel').DataTable();
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
  //Hapus Data

  function angka(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
      return true;
  }
  $(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal);
    }
  }, 1);
});
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });
</script>
</body>
</html>
