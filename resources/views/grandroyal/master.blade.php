<!DOCTYPE html>
<html lang="en">
    @include('grandroyal/head')
    <head>
      <title>Grand Royal Hall Harmoni - Data Bank</title>
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
    <img class="animation__shake" src="https://image.pngaaa.com/108/5561108-middle.png" height="60" width="60">
    
    <h4><b>Grand Royal Hall Harmoni </b></h4>
  </div> 
  <!-- /.navbar -->
  @include('grandroyal/navbar')

  <!-- Main Sidebar Container -->
  @include('grandroyal/sidebar')
  

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
              <li class="breadcrumb-item"><a href="main">Home</a></li>
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
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tmb"class="btn bg-gradient-primary">Tambah Barang</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-barang" class="table  table-striped">
                  <thead>
                  <tr>
                    <th class="col-lg-2">Action</th>
                    <th class="col-lg-1">Jenis</th>
                    <th class="col-lg-2">Nama Barang</th>
                    <th class="col-lg-5">Qty</th>
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
  <!-- MODAL Tambah Bank -->
    <div class="modal fade" id="modal-tmb">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <form id="tambah">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Data </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <b><span aria-hidden="true">&times;</span></b>
                      </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                          <label>Jenis</label>
                          <select id="tmb-jenis" class="form-control" required>
                              <option value="">Pilih Jenis Barang</option>
                              <option value="persewaan">Persewaan</option>
                              <option value="fnb">Makanan / Minuman</option>
                              <option value="lain-lain">Lain - Lain</option>
                          </select>
                          <label>Nama Barang </label>
                          <input id="tmb-nama" class="form-control" type="text" required>
                          <label>Satuan </label>
                          <input id="tmb-satuan" class="form-control" type="text" required>
                          <label>Keterangna</label>
                          <textarea id="tmb-keterangan" class="form-control" style="resize:none;" rows="3"></textarea>
                        </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-tambah" class=" col-sm-4 form-control btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Tambah Bank -->
  <!-- Modal Detail Bank -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Data Bank</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                    <div class="form-group">
                        <label>Bank</label>
                        <input id="dtl-bank" class="form-control" type="text" readonly>
                        <label>No. Rekening </label>
                        <input id="dtl-rekening" class="form-control" onkeypress="return angka('evt')" maxlength="16" type="text" readonly>
                        <label>Atas Nama</label>
                        <input id="dtl-AN" type="text" class="form-control" required readonly>
                        <label>Tanggal Dibuat</label>
                        <input type="date" id="dtl-created" class="form-control"  disabled>
                    </div>
              </div>
              <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>
  <!-- /Modal Detail Bank -->
  <!-- MODAL Edit Bank -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="edtbank">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Data Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group">
                            <input id="edt-kode" type="text" hidden>
                            <label>Bank</label>
                            <input id="edt-bank" class="form-control" type="text" required readonly>
                            <label>No. Rekening </label>
                            <input id="edt-rekening" class="form-control" type="text" onkeypress="return angka('evt')" required>
                            <label>Atas Nama</label>
                            <input id="edt-AN" type="text" class="form-control" required >
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
  <!--/ Modal Edit Bank -->
  <!-- MODAL Hapus Bank -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hpsbank">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Data Bank</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          Apakah Anda Yakin Akan Menghapus Data ini ?
                          <div class="row">
                              <input id="hps-kode" class="form-control" type="text" required hidden>
                              <label class=" col-md-3">Rekening </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8" id="hps-bank" > 	</label>
                          </div>
                          <div class="row">
                              <label class=" col-md-3">Nama </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8"id="hps-AN" ></label>
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
  <!--/ Modal Hapus Bank -->
<!--/ MODAL -->

  @include('grandroyal/footer')

 
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
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {   
    $('#tabel-bank').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-bank") !!}',
        columns: [         
            
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'bank', name: 'bank',orderable:true},
            { data: 'rekening', name: 'rekening',orderable:true},
            { data: 'atas_nama', name: 'atas_nama',orderable:true},
            
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
    document.getElementById("tambah").reset();
  });
  $('#tambah').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var jenis = $('#tmb-jenis').val();
    var nama = $('#tmb-nama').val();
    var satuan = $('#tmb-satuan').val();
    var keterangan = $('#tmb-keterangan').val();
    console.log(jenis);
    // $.ajax({
    //   type: 'post',
    //   url: '{!! url("data-bank") !!}',
    //   data : {
    //     bank     : $('#tmb-bank').val(),
    //     _token   : token,
    //     rekening : $('#tmb-rekening').val(),
    //     an       : $('#tmb-AN').val(),
    //     user     : "{{$user->kode_karyawan}}", 

    //   }, // serializes form input
    //   success:function(response) {
    //     if(response.success == true ){
    //       Toast.fire({
    //         icon: 'success',
    //         title: response.pesan
    //       })
    //       $('#modal-tmb-bank').modal('hide');
    //       var table = $('#tabel-bank').DataTable(); 
    //       table.ajax.reload( null, false );
    //     } else {
    //       Toast.fire({
    //         icon: 'error',
    //         title: response.pesan
    //       })
    //     }
    //   }
    // });
  });
  $('#edtbank').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edt-kode').val();
    var today = new Date();
    var tgl = today.getDate();
    if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
        tgl = '0'+tgl;
    }
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var time = date+' '+time;
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-bank/'+kode+'") !!}',
      data : {
        bank     : $('#edt-bank').val(),
        _token   : token,
        rekening : $('#edt-rekening').val(),
        an       : $('#edt-AN').val(),
        user     : "{{$user->kode_karyawan}}", 
      }, // serializes form input
      success:function(response) {
        console.log(response);
        if(response.success = true){
          Toast.fire({
            icon: 'success',
            title: response.pesan
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-bank').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: response.pesan
          })
        }
        
      },
    });
  });
  $('#hpsbank').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#hps-kode').val();
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-bank/'+kode+'") !!}',
      data    : {
        _token  : token,
        user     : "{{$user->kode_karyawan}}", 
      },
      success:function(response) {
        console.log(response);
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: response.pesan
          })
          $('#modal-hapus').modal('hide');
          var table = $('#tabel-bank').DataTable(); 
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
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-bank/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          console.log(response);
          if(response.success == true){
            $('#dtl-bank').val(response.data.bank);
            $('#dtl-rekening').val(response.data.rekening);
            $('#dtl-AN').val(response.data.atas_nama);
            var tgl = response.data.created_at;
            tgl = tgl.substr(0,10);
            $('#dtl-created').val(tgl);
          } else {
            Toast.fire({
              icon: 'error',
              title: response.pesan
            })
          }
        }
      });
  });
  $('body').on('click', '.edit', function () {
    var kode = $(this).data('kode');
    document.getElementById("edtbank").reset();
    $.ajax({
      url :'{!! url("data-bank/'+kode+'/edit") !!}',
      type : 'get',
      success : function(response){
        if(response.success == true){
          $('#edt-bank').val(response.data.bank);
          $('#edt-rekening').val(response.data.rekening);
          $('#edt-AN').val(response.data.atas_nama);
          $('#edt-kode').val(kode);
        } else {
          Toast.fire({
              icon: 'error',
              title: response.pesan
            })
        }
        
      }
    });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("hpsbank").reset();
      var rekening = $(this).data('rekening');
      var bank = $(this).data('bank');
      var AN = $(this).data('nama');
      var kode = $(this).data('kode');
      console.log(kode);
      document.getElementById("hps-bank").innerHTML = bank+" "+rekening;
      document.getElementById("hps-AN").innerHTML = AN ;
      $('#hps-kode').val(kode);
  });
  function angka(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
      return true;
  } 
</script>
</body>
</html>
