<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Laporan Pembelian</title>
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
            <h1 class="m-0">Laporan Pembelian
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pembelian</li>
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
                    <form id="laporan-pembelian">
                        <div class="row">                    
                            <div class="col-lg-4">
                                Tanggal Awal <br>
                                <input type="date" class="form-control" id="awal">
                            </div>
                            <div class="col-lg-4">
                                Tanggal Akhir <br>
                                <input type="date" class="form-control" id="akhir">
                            </div>
                            <div class="col-lg-2">
                                <br>
                                <button type="submit" class="form-control btn btn-primary" id="cari" >Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table  class="table table-striped table-bordered table-responsive" id="tabel-pembelian">
                    <thead>
                      <th>No</th>
                      <th>Tanggal Pesan</th>
                      <th>No PO</th>
                      <th>Rekanan</th>
                      <th>Barang</th>
                      <th>Satuan</th>
                      <th>QTY</th>
                      <th>Harga</th>
                      <th>DPP</th>
                      <th>PPN</th>
                      <th>Total</th>
                      <th>Pembayaran</th>
                      <th>Via</th>
                      <th>Bank</th>
                      <th>Sisa Piutang</th>
                      <th>Tgl Terima</th>
                      <th>Gudang</th>
                      <th>Qty pengiriman</th>
                      <th>Status</th>
                    </thead>
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
    document.getElementById("laporan-pembelian").reset();
    // $('#tabel-pembelian').DataTable({
    //         paging      : true,
    //         lengthChange: true,
    //         autoWidth   : true,
    //         search      : false,
    //         order       : false,
    //           buttons: [
    //               'copy', 'csv', 'excel', 'pdf', 'print'
    //           ],
    //         dom: 'Blfrtip'
    //     });
    $('#btn-export').hide();
    

  }); 
  var token = "{!! csrf_token() !!}";
  $('.select2').select2();
  //Laporan
  $('#laporan-pembelian').on('submit',function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    $.ajax({
      type : 'get',
      url  : '{!! url("exp-pembelian")!!}',
      data : {
        _token : token,
        awal    : awal,
        akhir   : akhir,
      },
      success : function(response){
        console.log(response);
        if (DataTable) {
        // dataTable sudah dideklarasikan
            $('#tabel-pembelian').DataTable().clear().destroy();
            $('#tabel-pembelian').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              data : response.data,
              columns : [
                { data: 'kode', name: 'kode',orderable:false},
                { data: 'rekanan', name: 'rekanan',orderable:false},
                { data: 'karyawan', name: 'karyawan',orderable:false},
                { data: 'penjualan', name: 'penjualan',orderable:false},
                { data: 'status', name: 'status',orderable:false},
                { data: 'action', name: 'action',orderable:false},
              ],
            });
        } else {
            // dataTable belum dideklarasikan
            $('#tabel-pembelian').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              data : response.data,
              columns : [
                { data: 'kode', name: 'kode',orderable:false},
                { data: 'rekanan', name: 'rekanan',orderable:false},
                { data: 'karyawan', name: 'karyawan',orderable:false},
                { data: 'penjualan', name: 'penjualan',orderable:false},
                { data: 'status', name: 'status',orderable:false},
                { data: 'action', name: 'action',orderable:false},
              ],
            });
        }
        
        
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
