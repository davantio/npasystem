<!DOCTYPE html>
<html lang="en">
@include('grandroyal/head')
<head>
  <title>Dashboard {{$user->level}}</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
    
    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div> 
  @include('grandroyal/navbar')

  <!-- Main Sidebar Container -->
  @include('grandroyal/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0" > Hai {{$detail->nama}}</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="home">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if($user->level == 'admin'|| $user->level == 'admin-marketing')
        <div class="admin">
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">0</h3>

                  <p>SO menunggu Konfirmasi </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <aid="data-so" data-toggle="modal" data-target="#modal-so" class="small-box-footer">Cek Sales Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj">0</h3>

                  <p>Dalam Pengiriman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a id="data-sj" data-toggle="modal" data-target="#modal-sj" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-inv">0</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                
                <a id="data-inv" data-toggle="modal" data-target="#modal-inv" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>  
        </div>
        @elseif($user->level == 'superadmin'|| $user->level == "ceo")
        <div class="superadmin">
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">150</h3>

                  <p>Sales Order</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-so" id="data-so" class="small-box-footer">Cek Sales Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj"></h3>

                  <p>Dalam Pengiriman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-sj" id="data-sj" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-invoice">44</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                
                <a data-toggle="modal" data-target="#modal-inv" id="data-inv" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>  
        </div>
        @elseif($user->level == 'marketing')
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">0</h3>

                  <p>Sales Order</p>
                </div>
                <div class="icon">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <a id="data-so" data-toggle="modal" data-target="#modal-so" class="small-box-footer">Buat Sales Order<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj">0</h3>

                  <p>Kawal Pesanan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a id="data-sj" data-toggle="modal" data-target="#modal-sj" class="small-box-footer">Cek Status Pesanan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-inv">0</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                <a id="data-inv" data-toggle="modal" data-target="#modal-inv" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        @endif
        
        <!-- MODAL SO  -->
            <div class="modal fade" id="modal-so">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Data SO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <table  class="table table-responsive table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Customer</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-so">
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between ">
                            <button type="button" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Modal SO -->
        <!-- MODAL SJ  -->
            <div class="modal fade" id="modal-sj">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Data SJ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <table  class="table table-responsive table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Customer</th>
                                                    <th>Tgl Kirim</th>
                                                    <th>Nopol Pengiriman</th>
                                                    <th>Alamat</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-sj">
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between ">
                            <button type="button" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Modal SJ -->
        <!-- MODAL INV  -->
            <div class="modal fade" id="modal-inv">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Data INV</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-danger">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <table  class="table table-responsive table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Customer</th>
                                                    <th>Nilai</th>
                                                    <th>Pembayaran</th>
                                                    <th>Selisih</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl-inv">
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between ">
                            <button type="button" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Modal INV -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
  
  <!-- /.modal -->
  <!-- /.content-wrapper -->
  @include('layout/footer')
  
</div>
<!-- ./wrapper -->

@include('layout/script')
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
<script>
  $(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
  });
    var token = "{!! csrf_token() !!}";
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
      timer: 4000
    });
</script>
@if($user->level == 'admin')
  <script>
    $(document).ready(function() {   
      var awal = "2000-01-01 "+time;
      var akhir = time;
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
          console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //SO
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-so") !!}',
          data  : {
            status : "Belum Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-so').html(response.data.SO);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SO
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj") !!}',
          data  : {
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SJ
      //Invoice
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-invoice") !!}',
          data  : {
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-inv').html(response.data.INV);
            } else {
              alert(response.pesan);
            }
          }
        });
      //Invoice
    }); 
  </script>
@elseif($user->level == 'marketing')
  <script>
    $(document).ready(function() {   
      var awal = "2000-01-01 "+time;
      var akhir = time;
      var marketing = "{{$user->kode_karyawan}}";
      console.log(marketing);
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
        //   console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //SO
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-so") !!}',
          data  : {
            status : "Belum Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-so').html(response.data.SO);
            } else {
              Toast.fire({
                    icon    : 'error',
                    title   : response.pesan
                });
            }
          }
        });
      //SO
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj") !!}',
          data  : {
            status : "Sudah Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
              Toast.fire({
                    icon    : 'error',
                    title   : response.pesan
                });
            }
          }
        });
      //SJ
      //Invoice
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-inv") !!}',
          data  : {
            status : "Sudah Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-inv').html(response.data.INV);
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : response.pesan
                });
            }
          }
        });
      //Invoice
    //   function omset
      //Omset
         var today = new Date();
         var month = (today.getMonth()+1);
         var year = today.getFullYear();
         if(month<10){
             month = "0"+month;
         }
         var tanggal = year+"-"+month;
         var marketing = "{{$user->kode_karyawan}}";
         omset(tanggal,marketing);
        //  $.ajax({
        //     type    : 'get',
        //     url     : '{!! url("cek-omset-marketing") !!}',
        //     data    : { marketing : marketing, },
        //  });
      //Omset
    }); 
  </script>
@elseif($user->level == 'superadmin' || $user->level == "ceo" || $user->level == 'manager-marketing')
  <script>
    var token = "{!! csrf_token() !!}";
    var today = new Date();
    var tgl = today.getDate();
    if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
      tgl = '0'+tgl;
    }
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var awal = "2000-01-01 "+time;
    var time = date+' '+time;
    $(document).ready(function(){
      
      var akhir = time;
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
        //   console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //HPPNEW
      if(tgl == 1){

        $.ajax({
          type    : 'post',
          url     : '{!! url("data-hpp")!!}',
          data    : {
            _token    : token,
            tanggal   : date,
            created   : time,

          },
          success : function(response){
            console.log(response);
            if(response.success == true){
              Toast.fire({
                icon  : 'success',
                title : response.pesan
              });
            } else {
              Toast.fire({
                icon  : 'error',
                title : response.pesan
              });
            }
          }
        });
      } else {

      }
      
      //SO
      $.ajax({
        type  : 'get',
        url   : '{!! url("total-so")!!}',
        data  : {
          _token : token,
          status : "Belum Diperiksa",
        },
        success : function(response){
        //   console.log(response);
          var hasil = response.pesan;
          if(response.success == true ){
            $('#total-so').html(response.data.SO);
          } else {
              Toast,fire({
                    icon    : 'error',
                    title   : response.pesan
                })
            $('#total-so').html("0");
          }
        }
      });
        
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj")!!}',
          data  : {
            _token : token,
            time   : time,
            status : "Sudah Diperiksa",
          },
          success : function(response){
            // console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
                Toast,fire({
                    icon    : 'error',
                    title   : response.pesan
                })
              $('#total-sj').html("0");
            }
          }
        });
      //INVOICE
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-inv")!!}',
          data  : {
            _token : token,
            status : "Sudah Diperiksa",
          },
          success : function(response){
            // console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-invoice').html(response.data.INV);
            } else {
                Toast,fire({
                    icon    : 'error',
                    title   : response.pesan
                })
              $('#total-invoice').html("0");
            }
          }
        });
    });
  </script>
@endif



<script>
    $('#data-so').on('click',function(){
        $.ajax({
            url :'{!! url("cek-so") !!}',
            type : 'get',
            @if($user->level == "marketing")
                data    : {user : "{{$user->kode_karyawan}}",},
            @else
                
            @endif
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#tbl-so').empty();
                    var datahandler = $('#tbl-so');
                    var n= 0;
                    $.each(response.data, function(key,val){
                        var Nrow = $("<tr>");
                            var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode']+"</td><td>"+response.data[n]['nama']+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });    
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                        timer   : 7000
                        
                    })
                }
                
            
            }
        });
    });
    $('#data-sj').on('click',function(){
        $.ajax({
            url :'{!! url("cek-sj") !!}',
            type : 'get',
            @if($user->level == "marketing")
                data    : {user : "{{$user->kode_karyawan}}",},
            @else
                
            @endif
            success : function(response){
                console.log(response);
                if(response.success == true){
                    $('#tbl-sj').empty();
                    var datahandler = $('#tbl-sj');
                    var n= 0;
                    $.each(response.data, function(key,val){
                        var Nrow = $("<tr>");
                            var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['tgl_kirim']+"</td><td>"+response.data[n]['nopol']+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });    
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                        timer   : 7000
                        
                    })
                }
                
            
            }
        });
    });
    $('#data-inv').on('click',function(){
        $.ajax({
            url :'{!! url("cek-inv") !!}',
            type : 'get',
            @if($user->level == "marketing")
                data    : {user : "{{$user->kode_karyawan}}",},
            @else
                
            @endif
            success : function(response){
                console.log(response);
                if(response.success == true){
                    $('#tbl-inv').empty();
                    var datahandler = $('#tbl-inv');
                    var n= 0;
                    $.each(response.data, function(key,val){
                        var Nrow = $("<tr>");
                            var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode']+"</td><td>"+response.data[n]['konsumen']+"</td><td>"+formatRupiah(response.data[n]['nilai'])+"</td><td>"+formatRupiah(response.data[n]['pembayaran'])+"</td><td>"+formatRupiah(response.data[n]['selisih'])+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });    
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                        timer   : 7000
                        
                    })
                }
                
            
            }
        });
    });
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR' }
        ).format(money);
    }  
    function omset(tanggal,marketing){
        $.ajax({
            type    : 'get',
            url     : '{!! url("omset-marketing") !!}',
            data    :{
                tanggal    : tanggal,
                marketing : marketing,
            },
            success : function(response){
                console.log(response);
                if(response.success == true){
                    $('#omset').html("Omset Bulan ini "+formatRupiah(response.omset));
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan
                    });
                }
            }
        });
    }
</script>

</body>
</html>
