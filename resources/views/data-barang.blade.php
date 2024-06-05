<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Barang</title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini" >
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
            <h1>Data Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Barang</li>
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
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Barang</button>
                  <button type="button" id="btn-import" data-toggle="modal" data-target="#modal-import" class="btn bg-gradient-info">Import Data</button>
                </div>
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-barang" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jenis</th>
                    <th>Satuan</th>
                    <th>Packing</th>
                    <th>Keterangan</th>
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
  <!-- MODAL Tambah Barang -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
          <div class="modal-content">
              <form id="tmbbrg">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Data Barang</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                          <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label>Kode Barang </label>
                                  <input id="tmb_kode_brg"  class="form-control" type="text" readonly >
                                  <label>Nama Barang </label>
                                  <input id="tmb_nama_brg"  class="form-control" type="text" required>
                                  <label> Jenis</label>
                                  <select id="tmb_jenis_brg" class="form-control select2 " required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="PADAT">Padat</option>
                                    <option value="CAIR">Cair</option>
                                    <option value="JASA">Jasa</option>
                                    <option value="LAINLAIN">Lain-Lain</option>
                                  </select> 
                                  <label> Satuan</label>
                                  <select id="tmb_satuan_brg"  class="form-control select2 " required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="-">-</option>
                                    <option value="GRAM">Gram</option>
                                    <option value="KG">Kg</option>
                                    <option value="ML">Ml</option>
                                    <option value="LITER">Liter</option>
                                    <option value="PCS">Pcs</option>
                                    <option value="KIRIM">Kirim</option>
                                  </select>
                                  
                                  
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <label>Perusahaan</label>
                                <input id="tmb_perusahaan_brg" class="form-control" type="text" required>
                                <label>Packing</label>
                                <select id="tmb_packing_brg" class="form-control packing " >
                                  <option value="">Pilih Packing</option>
                                  <option value="-">-</option>
                                  <option value="bag">Bag</option>
                                  <option value="botol">Botol</option>
                                  <option value="botol_pocket">Botol Pocket</option>
                                  <option value="botol_pump">Botol Pump</option>
                                  <option value="botol_spray">Botol Spray</option>
                                  <option value="box">Box</option>
                                  <option value="drum">Drum</option>
                                  <option value="iron_drum">Iron Drum</option>
                                  <option value="jerigen">Jerigen</option>
                                  <option value="kayu">Kayu</option>
                                  <option value="pail">Pail</option>
                                  <option value="pcs">Pcs</option>
                                  <option value="sak">Sak</option>
                                  <option value="baru">Baru</option>
                                </select> 
                                <input id="tmb_packingnew_brg"  class="form-control npacking" type="text" hidden>
                                <label>Keterangan</label>
                                <textarea id="tmb_keterangan_brg" class="form-control"  rows="4" placeholder="Keterangan""></textarea>
                              </div>
                          </div>
                          </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-tambah"class="col-sm-4 form-control btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Tambah Barang -->
  <!-- Modal Detail Barang -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Detail Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label>Kode Barang</label>
                        <input id="dtl_kode_brg "class="form-control" type="text" readonly>
                        <label>Nama Barang </label>
                        <input id="dtl_nama_brg"  class="form-control" type="text" readonly>
                        <label> Jenis</label>
                        <input id="dtl_jenis_brg" class="form-control" type="text" readonly>
                        <label> Satuan</label>
                        <input id="dtl_satuan_brg" class="form-control" type="text" readonly>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label>Perusahaan</label>
                          <input id="dtl_perusahaan_brg"  class="form-control" type="text" readonly>
                          <label>Packing</label>
                          <input id="dtl_packing_brg" class="form-control" type="text" readonly>
                          <label>Keterangan</label>
                          <textarea id="dtl_keterangan_brg" class="form-control"  rows="4" placeholder="Keterangan"" readonly></textarea>
                      </div>
                  </div>
              </div>
              </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                  </div>
            </div>
        </div>
    </div>
  <!-- /Modal Detail Barang -->
  <!-- MODAL Edit Barang -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form id="edtbrg">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Data Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label>Kode Barang</label>
                              <input id="edt_kode_brg" class="form-control" type="text" readonly required >
                              <label>Nama Barang </label>
                              <input id="edt_nama_brg"  class="form-control" type="text" required>
                              <label> Jenis</label>
                              <select id="edt_jenis_brg" class="form-control " required>
                                <option value="">Pilih Jenis</option>
                                <option value="PADAT">Padat</option>
                                <option value="CAIR">Cair</option>
                                <option value="JASA">Jasa</option>
                                <option value="LAINLAIN">Lain-Lain</option>
                              </select> 
                              <label> Satuan</label>
                              <select id="edt_satuan_brg" class="form-control " required>
                                <option value="">Pilih Satuan</option>
                                <option value="-">-</option>
                                <option value="GRAM">Gram</option>
                                <option value="KG">Kg</option>
                                <option value="ML">Ml</option>
                                <option value="LITER">Liter</option>
                                <option value="PCS">Pcs</option>
                                <option value="KIRIM">Kirim</option>
                              </select> 
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group">
                              <label>Perusahaan</label>
                              <input id="edt_perusahaan_brg" class="form-control" type="text" required>
                              <label>Packing</label>
                                <select id="edt_packing_brg"  class="form-control select2 " >
                                  <option value="">Pilih Packing</option>
                                  <option value="-">-</option>
                                  <option value="bag">Bag</option>
                                  <option value="botol">Botol</option>
                                  <option value="botol_pocket">Botol Pocket</option>
                                  <option value="botol_pump">Botol Pump</option>
                                  <option value="botol_spray">Botol Spray</option>
                                  <option value="box">Box</option>
                                  <option value="drum">Drum</option>
                                  <option value="iron_drum">Iron Drum</option>
                                  <option value="jerigen">Jerigen</option>
                                  <option value="kayu">Kayu</option>
                                  <option value="pail">Pail</option>
                                  <option value="pcs">Pcs</option>
                                  <option value="sak">Sak</option>
                                  <option value="baru">Baru</option>
                                </select> 
                                <input id="edt_packingnew_brg"  class="form-control " type="text" hidden>
                                <label>Keterangan</label>
                                <textarea id="edt_keterangan_brg" class="form-control" rows="4" placeholder="Keterangan"></textarea>
                          </div>
                      </div>
                      
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-edit" class=" col-sm-4 form-control btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <!--/ Modal Edit Barang -->
  <!-- MODAL Hapus Barang -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hpsbrg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Data Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    Apakah Anda Yakin Akan Menghps Data ini ?
                                    <input id="hps_kode_brg"  class="form-control" type="text" required hidden>
                                    <div class="row">
                                        <label class=" col-md-3">KODE </label> 
                                        <label class=" col-md-1">: </label> 
                                        <label class="col-md-8" id="hps_kode"></label>
                                    </div>
                                    <div class="row">
                                        <label class=" col-md-3">Nama </label> 
                                        <label class=" col-md-1">: </label> 
                                        <h6 class="col-md-6" id="hps_nama_brg"></h6>
                                    </div>
                                </div>
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
  <!--/ Modal Hapus Barang -->
  <!-- Modal Import -->
    <div class="modal fade" id="modal-import">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Import Data Barang</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <form id="upload-data" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="Pilih File">Pilih File Excel</label>
                      <input type="file" id="upload-file" name="upload-file" class="form-control" accept=".xls,.xlsx">
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3">
                      <br>
                      <button type="submit" id="submit-file" class="btn btn-info">Input Data</button>
                    </div>
                  </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table id="tabel-preview" class="table table-bordered ">
                          <thead>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Packing</th>
                            <th>Perusahaan</th>
                            <th>KD Persediaan</th>
                            <th>KD Persediaan HPP</th>
                            <th>KD Pendapatan</th>
                            <th>KD Persediaan Intransit</th>
                            <th>Keterangan</th>
                          </thead>
                          <tbody id="body-tabel-preview"></tbody>
                        </table>
                    </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between ">
                <input type="file" id="import-file" name="import-file" class="form-control" hidden>
                <button type="button"  id="edt-btn-cancel-edit-barang" data-dismiss="modal" class="col-sm-4 form-control btn btn-default">Cancel</button>
                <button type="button"  id="submit-import" class="col-sm-4 form-control btn btn-info ">Upload Barang</button>
              </div>
          </div>
        </div>
    </div>
  <!--/ Modal Import -->
<!--/ MODAL -->

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

<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->

<script>
  $(document).ready(function() {   
    $('#tabel-barang').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-barang") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'jenis', name: 'jenis',orderable:true},
            { data: 'satuan', name: 'satuan',orderable:true},
            { data: 'packing', name: 'packing',orderable:true},
            { data: 'keterangan', name: 'keterangan',orderable:true},
        ]
    });
  }); 
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
  $(document).on('click','#tambahdata',function(){
    document.getElementById("tmbbrg").reset();
    $.ajax({
      url :'{!! url("lastkode-barang") !!}',
      type : 'get',
      success : function(response){
        $('#tmb_kode_brg').val(response);
        
      }
    });
  });
  $('#tmbbrg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-barang") !!}',
      data : {
        nama : $('#tmb_nama_brg').val(),
        _token : token,
        jenis : $('#tmb_jenis_brg').val(),
        satuan : $('#tmb_satuan_brg').val(),
        perusahaan : $('#tmb_perusahaan_brg').val(),
        packing : $('#tmb_packing_brg').val(),
        packingnew : $('#tmb_packingnew_brg').val(),
        keterangan : $('#tmb_keterangan_brg').val(),
        user      : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        if(response.success == true){
          var hasil = response.pesan;
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel-barang').DataTable(); 
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
  $('#edtbrg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edt_kode_brg').val();
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-barang/'+kode+'") !!}',
      data : {
        kode : kode,
        nama : $('#edt_nama_brg').val(),
        _token : token,
        jenis : $('#edt_jenis_brg').val(),
        satuan : $('#edt_satuan_brg').val(),
        perusahaan : $('#edt_perusahaan_brg').val(),
        packing : $('#edt_packing_brg').val(),
        packingnew : $('#edt_packingnew_brg').val(),
        keterangan : $('#edt_keterangan_brg').val(),
        user  : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        // // console.log(response);
        if(response.success == true){
          var hasil = response.pesan;
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-barang').DataTable(); 
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
  $('#hpsbrg').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#hps_kode_brg').val();
    // console.log(kode);
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-barang/'+kode+'") !!}',
      data    : {
        _token  : token,
        user  : "{{$user->kode_karyawan}}",
      },
      success:function(response) {
        // console.log(response);
        if(response.success == true){
          var hasil = response.pesan;
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hapus').modal('hide');
          var table = $('#tabel-barang').DataTable(); 
          table.ajax.reload( null, false );
        }else {
          Toast.fire({
            icon: 'success',
            title: response.pesan
          })
        }
        
      }
    });
  });
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-barang/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          // console.log(response);
          $('#dtl_kode_brg').val(response.result.kode);
          $('#dtl_nama_brg').val(response.result.nama);
          $('#dtl_jenis_brg').val(response.result.jenis);
          $('#dtl_satuan_brg').val(response.result.satuan);
          $('#dtl_perusahaan_brg').val(response.result.perusahaan);
          $('#dtl_packing_brg').val(response.result.packing);
          $('#dtl_keterangan_brg').val(response.result.keterangan);
        }
      });
  });
  $('body').on('click', '.edit', function () {
    var kode = $(this).data('kode');
    document.getElementById("edtbrg").reset();
    $.ajax({
      url :'{!! url("data-barang/'+kode+'/edit") !!}',
      type : 'get',
      success : function(response){
        $('#edt_kode_brg').val(response.result.kode);
        $('#edt_nama_brg').val(response.result.nama);
        $('#edt_perusahaan_brg').val(response.result.perusahaan);
        $('#edt_jenis_brg').append('<option value="'+response.result.jenis+'" selected>'+response.result.jenis+'</option>');
        $('#edt_satuan_brg').append('<option value="'+response.result.satuan+'"selected>'+response.result.satuan+'</option>');
        $('#edt_packing_brg').append('<option value="'+response.result.packing+'"selected>'+response.result.packing+'</option>');
        $('#edt_keterangan_brg').val(response.result.keterangan);
      }
    });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("hpsbrg").reset();
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      document.getElementById("hps_kode").innerHTML = kode;
      document.getElementById("hps_nama_brg").innerHTML = nama;
      $('#hps_kode_brg').val(kode);

  });
  $('#tmb_packing_brg').on('change',function(){
      var pack = $(this).val();
      if (pack == "baru"){
        document.getElementById("tmb_packingnew_brg").hidden=false;
        
      } else {
        document.getElementById("tmb_packingnew_brg").hidden=true;
        
      }
  });
  $('#edt_packing_brg').on('change',function(){
      var pack = $(this).val();
      if (pack == "baru"){
        document.getElementById("edt_packingnew_brg").hidden=false;
        
      } else {
        document.getElementById("edt_packingnew_brg").hidden=true;
        
      }
  });
  //Import Data
    $('#btn-import').on('click',function(){
      document.getElementById("upload-data").reset();
      $('#upload-file').prop('disabled',false);
      $('#body-table-preview').empty();
    });
    $('#upload-data').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#submit-file');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '{!! url("upload-barang") !!}',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if(data.success == true){
            // Toast.fire({
            //   icon  : 'success',
            //   title : data.pesan,
            // });
            $('#upload-file').prop('disabled',true);
            $('#body-tabel-preview').empty();
            var datahandler = $('#body-tabel-preview');
            // console.log(data.data);
            var n= 0;
            $.each(data.data[0], function(key,val){
                var nomor = n+1;
                var Nrow = $("<tr>");
                Nrow.html("<td>"+nomor+"</td><td>"+data.data[0][n][0]+"</td><td>"+data.data[0][n][1]+"</td><td>"+data.data[0][n][2]+"</td><td>"+data.data[0][n][3]+"</td><td>"+data.data[0][n][4]+"</td><td>"+data.data[0][n][5]+"</td><td>"+data.data[0][n][6]+"</td><td>"+data.data[0][n][7]+"</td><td>"+data.data[0][n][8]+"</td><td>"+data.data[0][n][9]+"</td><td>"+data.data[0][n][10]+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          } else {
            Toast.fire({
              icon  : 'error',
              title  : data.pesan
            });
          }
          // console.log(data);
        }
      });
    });
    $('#submit-import').on('click',function(e){
      var el = $('#submit-import');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData('#upload-data');
      // console.log(formData);
    });
    // $('#import-data').submit(function(e){
    //   var el = $('#submit-import');
    //   el.prop('disabled', true);
    //   setTimeout(function(){el.prop('disabled', false); }, 4000);
    //   var formData = new FormData('#upload-data');
    //   // console.log(formData);
    //   $.ajax({
    //     type: 'POST',
    //     url: '{!! url("import-barang") !!}',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function(response) {
    //       // console.log(response);
    //       if(response.success == true){
    //         Toast.fire({
    //           icon  : "success",
    //           title : response.pesan
    //         });
            
    //       } else {
    //         Toast.fire({
    //           icon  : 'error',
    //           title  : response.pesan
    //         });
    //       }
          
    //     }
    //   });
    // });
  //Import Data
</script>
</body>
</html>
