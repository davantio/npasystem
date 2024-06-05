<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Laporan Piutang</title>
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
            <h1 class="m-0">Laporan Piutang
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Piutang</li>
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
                    <form id="laporan-piutang">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Customer</label>
                                <br>
                                <select id="customer" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                                <label>Tanggal Awal</label>
                                <br>
                                <input type="date" class="form-control" id="awal" required>
                            </div>
                            <div class="col-lg-3">
                                <label>Tanggal Akhir</label>
                                <br>
                                <input type="date" class="form-control" id="akhir" required>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="form-control btn btn-primary" id="cari" >Cari</button>
                                <br>
                                <button type="button" id="btn-export" class="btn btn-success"><i class="fas fa-print"></i>Export Excel</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div class="row" id="data">
                        <div class="col-lg-2">
                            <label>Nama Customer</label>
                        </div>
                        <div class="col-lg-1">
                            <label>:</label>
                        </div>
                        <div class="col-lg-8" id="customer"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
                            <label>Tanggal</label>
                        </div>
                        <div class="col-lg-1">
                            <label>:</label>
                        </div>
                        <div class="col-lg-8" id="tanggal"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
                            <label>DP/Kelebihan</label>
                        </div>
                        <div class="col-lg-1">
                            <label>:</label>
                        </div>
                        <div class="col-lg-8" id="selisih"></div>
                    </div>
                    <br>
                  <table id="table-laporan" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>D</th>
                      <th>K</th>
                      <th>Transaksi</th>
                      <th>Nominal</th>
                      <th>Total</th>
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
    document.getElementById("laporan-piutang").reset();
    $('#btn-export').hide();
    $('#data').hide();
    $('#customer').select2({
        placeholder: 'Pilih Customer',
        ajax: {
            url: '{!! url("dropdown-konsumen") !!}',
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
    
  }); 
  var token = "{!! csrf_token() !!}";
  $('.select2').select2();
  //Laporan
  $('#laporan-piutang').on('submit',function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    $.ajax({
      type : 'get',
      url  : '{!! url("jurnal-laporan-piutang")!!}',
      data : {
        _token : token,
        awal    : awal,
        akhir   : akhir,
        customer : $('#customer').val(),
      },
      success : function(response){
        console.log(response);
        $('#btn-export').show();
        $('#tanggal').html(response.keterangan.tanggal);
        $('#selisih').html(response.keterangan.selisih);
        $('#table-laporan').DataTable().clear().destroy();
        $('#table-laporan').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          data : response.data.original.data,
          columns : [
            { data: 'd', name: 'd',orderable:false, searchable:false},
            { data: 'k', name: 'k',orderable:false , searchable:false},
            { data: 'transaksi', name: 'transaksi',orderable:false},
            { data: 'nominal', name: 'nominal',orderable:false, searchable:false},
            { data: 'total', name: 'total',orderable:false, searchable:false},
          ],
        });
      }
    });
  });
  
  
  //Export
  $('#btn-export').on('click',function(){
      var awal = $('#awal').val();
      var akhir = $('#akhir').val();
        if(awal == null || akhir == null || akhir == '' || awal == '' ){
            Toast.fire({
                icon    : 'error',
                title   : "Data Wajib Diisi !!",
            })
        } else {
            $.ajax({
                type    : 'get',
                url     : '{!! url("export-piutang") !!}',
                data    :{
                    awal : awal,
                    akhir   : akhir,
                    customer : $('#customer').val()
                },
                success :function(response){
                    console.log(response);
                    if(response.success == false){
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        })
                    } else {
                       window.location.href = response.downloadUrl;
                    }
                }
            })
        }
  })
    // $('#btn-Export').on('click',function(){
    //   var awal = $('#awal').val();
    //   var akhir = $('#akhir').val();
    //     if(awal == null || akhir == null || akhir == '' || awal == '' ){
    //         Toast.fire({
    //             icon    : 'error',
    //             title   : "Data Wajib Diisi !!",
    //         })
    //     } else {
    //         $.ajax({
    //             type    : 'get',
    //             url     : '{!! url("export-penjualan") !!}',
    //             data    :{
    //                 awal : awal,
    //                 akhir   : akhir
    //             },
    //             success :function(response){
    //                 console.log(response);
    //                 if(response.success == true){
    //                     Toast.fire({
    //                         icon    : 'success',
    //                         title   : response.pesan,
    //                     })
    //                 } else {
    //                     Toast.fire({
    //                         icon    : 'error',
    //                         title   : response.pesan,
    //                     })          
    //                 }
    //             }
    //         })
    //     }
    // });
  //Export
  
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
