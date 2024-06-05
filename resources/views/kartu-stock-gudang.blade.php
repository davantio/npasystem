<!DOCTYPE html>
<html lang="en">
  
@include('layout/head')
<head>
  <title>Kartu Stock gudang</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('AdminLTE/dist')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}
  @include('layout/navbar')

  <!-- Main Sidebar Container -->
  @include('layout/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kartu Stock Gudang
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Kartu Stock Gudang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <form id="stock-gudang">
                    <div class="row">
                      <div class="col-lg-4 form-group">
                        <label>Nama Gudang</label> <br>
                        <select id="gudang" class="form-control select2" style="width: 100%" required>
                        </select>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label>Nama Barang</label> <br>
                        <select id="barang" class="form-control select2" style="width: 100%" required>
                        </select>
                      </div>
                    </div>
                    <div class="row">                    
                      <div class="col-lg-4 form-group">
                        <label> Tanggal Awal</label> <br>
                        <input type="date" class="form-control" id="awal" required>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label> Tanggal Akhir</label> <br>
                        <input type="date" class="form-control" id="akhir" requirefd>
                      </div>
                      <div class="col-lg-4 form-group">
                        <br>
                        <button type="submit" class="btn btn-primary" id="cari" >Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <div class="row" style="justify-content: center">
                    <label >CV NUSA PRATAMA ANUGRAH</label>
                  </div>
                  <div class="row" style="justify-content: center">
                    <label id="title-gudang"></label>
                  </div>
                  <div class="row" style="justify-content: center">
                    <label id="title-tgl"></label>
                  </div>
                  <div class="row">
                    <div class="col-lg-2">
                      <label>Nama barang</label>
                      <br>
                      <label>Satuan</label>
                    </div>
                    <div class="col-lg-10">
                      <label id="title-barang"></label>
                      <br>
                      <label id="title-satuan"></label>
                    </div>
                  </div>
                  <table id="table-stock" class="table  table-striped">
                    <thead>
                    <tr align="center">
                      <th>Tanggal</th>
                      <th>Kode Transaksi</th>
                      <th style="width:40%;" >Uraian</th>
                      <th>Masuk</th>
                      <th>Keluar</th>
                      <th>Saldo</th>
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
  <!-- MODAL -->
    <!-- MODAL Preview Laporan -->
      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog ">
          <div class="modal-content">
            <form id="form-detail">
              <div class="modal-header bg-info">
                <h4 class="modal-title">Laporan Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <label> Nama Marketing</label>
                    <input type="text" class="form-control" id="dtl-marketing" value="{{$detail->nama}}" disabled>
                  </div>
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="dtl-tanggal" disabled>
                  </div>
                </div>
                <br>
                <textarea class="form-control" rows="3" placeholder="Enter ..." id="dtl-laporan" disabled="" style="height: 200px;"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Modal Preview Laporan -->
  <!-- /MODAL -->
  <!-- /.content-wrapper -->
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
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });
  });
  $(document).ready(function() {
    
    $('#gudang').select2({
      placeholder: 'Pilih Gudang',
      ajax: {
          url: '{!! url("dropdown-gudang") !!}',
          dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.nama,
                          id: item.kode
                      }
                  })
              };
          },
          cache: true
      }
    });
    
    $('#barang').select2({
      placeholder: 'Pilih Barang',
      ajax: {
          url: '{!! url("dropdown-barang") !!}',
          dataType: 'json',
          processResults: function (data) {
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.kode+" - "+item.nama,
                          id: item.kode
                      }
                  })
              };
          },
          cache: true
      }
    });
   
  }); 
  $('.select2').select2();


  // $('barang').on('change',function(e){
  //   var barang = this.val();
  //   var handler = $('#kartu-stock');
  //   var Nrow = $("<div class='row' style='align:center;'>");
  //   var Nrow.html("<label>Kartu Stock "++"</label></div");
  //   handler.append(Nrow);
  // });

  $('#stock-gudang').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var gudang = $('#gudang').val();
    var barang = $('#barang').val();
    if(gudang == "ALL"){
      Toast.fire({
        icon :'error',
        title:'Pilih Salah Satu Gudang',
      });
      return false;
    } else {
    }
    if(barang == 'all'){
      Toast.fire({
        icon :'error',
        title:'Pilih Salah Satu Barang',
      });
      return false;
    } else {
    }
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var token = "{!! csrf_token() !!}";
    
    $.ajax({
      url   : '{!! url("data-kartu-stock-gudang") !!}',
      type  : 'get',
      data  :{
              _token : token,
              gudang  : gudang,
              barang : barang,
              awal    : awal,
              akhir   : akhir ,
            },
      success   : function(response){
        // console.log(response);
        $('#title-gudang').html("KARTU STOCK GUDANG "+response.title.gudang);
        $('#title-tgl').html(awal+" - "+akhir);
        $('#title-barang').html(": "+response.title.barang);
        $('#title-satuan').html(": "+response.title.satuan);
        $('#table-stock').DataTable().clear().destroy();
        $('#table-stock').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          data : response.data,
          columns : [
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'kode_transaksi', name: 'kode_transaksi',orderable:true},
            { data: 'keterangan', name: 'keterangan',orderable:true},
            { data: 'masuk', name: 'masuk',orderable:false},
            { data: 'keluar', name: 'keluar',orderable:false},
            { data: 'saldo', name: 'saldo',orderable:false},
          ],
        });
      }
    })
    
  });
  
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
</script>
</body>
</html>
