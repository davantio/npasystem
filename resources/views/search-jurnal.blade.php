<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Data Jurnal</title>
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
            <h1 class="m-0">Data Jurnal
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Data Jurnal</li>
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
                    <form id="data-jurnal">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Kode Transaksi</label>
                                <input type="text" id="transaksi" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">                    
                            <div class="col-lg-4">
                                Tanggal Awal <br>
                                <input type="date" class="form-control" id="awal">
                            </div>
                            <div class="col-lg-4">
                                Tanggal Akhir <br>
                                <input type="date" class="form-control" id="akhir">
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <button type="submit" class="col-sm-3 form-control btn btn-primary" id="cari" >Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="table-jurnal" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Keterangan</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                    </tr>
                    </thead>
                    <tbody id="isi-tabel">
                      
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
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">
            <form id="form-detail">
              <div class="modal-header bg-info">
                <h4 class="modal-title">Laporan Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-3">
                    <label for=""><strong>Tanggal</strong></label>
                    <input type="text" id="detail-tanggal" class="form-control" disabled>
                  </div>
                  <div class="col-lg-3">
                    <label for=""><strong> Kode SO</strong></label>
                    <input type="text" id="detail-so" class="form-control" disabled>
                  </div>
                  <div class="col-lg-3">
                    <label for=""><strong>Konsumen</strong></label>
                    <input type="text" id="detail-konsumen" class="form-control" disabled>
                  </div>
                  <div class="col-lg-3">
                    <label for=""><strong>Marketing</strong></label>
                    <input type="text" id="detail-marketing" class="form-control" disabled>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <label for="">Kode PO request</label>
                    <input type="text" id="detail-po" class="form-control" disabled>
                  </div>
                  <div class="col-lg-6"></div>
                  <div class="col-lg-3">
                    <label for="">Status</label>
                   <h4><strong id="detail-status"></strong></h4>
                  </div>
                </div>
                <br>
                <strong>Detail SO</strong>
                <br>
                <div class="row table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Satuan</th>
                      <th>QTY</th>
                      <th>Harga</th>
                      <th>DPP</th>
                      <th>PPn</th>
                      <th>Jumlah</th>
                    </thead>
                    <tbody id="tabel-so"></tbody>
                  </table>
                </div>
                <hr>
                <strong>Invoice Pembayaran</strong>
                <br>
                <div class="row table-responsive">
                  <table  class="table table-striped table-bordered table-responsive">
                    <thead>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Invoice</th>
                      <th>Kode BBM</th>
                      <th>Bank Pembayaran</th>
                      <th>Total Pembayaran</th>
                      <th>Status</th>
                    </thead>
                    <tbody id="tabel-invoice"></tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-lg-9"style="text-align: right"><label for="" style="color: red;">Kekurangan</label></div>
                  <div class="col-lg-3"><strong><h5 id="kekurangan"></h5></strong></div>
                </div>
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
    document.getElementById("data-jurnal").reset();
    
  }); 
  var token = "{!! csrf_token() !!}";
  $('.select2').select2();
  //Laporan
  $('#data-jurnal').on('submit',function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var transaksi = $('#transaksi').val();
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    $.ajax({
      type : 'get',
      url  : '{!! url("rekap-jurnal")!!}',
      data : {
        _token : token,
        transaksi: transaksi,
        awal    : awal,
        akhir   : akhir,
      },
      success : function(response){
        console.log(response);
        $('#table-jurnal').DataTable().clear().destroy();
        $('#table-jurnal').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          data : response.data,
          columns : [
            { data: 'transaksi', name: 'transaksi',orderable:false},
            { data: 'keterangan', name: 'keterangan',orderable:false},
            { data: 'debit', name: 'debit',orderable:false},
            { data: 'kredit', name: 'kredit',orderable:false},
          ],
        });
      }
    });
  });
  
 
  
  function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
      { style: 'currency', currency: 'IDR' }
    ).format(money);
  }
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
</script>
</body>
</html>
