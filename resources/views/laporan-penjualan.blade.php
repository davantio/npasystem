<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Laporan Penjualan</title>
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
            <h1 class="m-0">Laporan Penjualan
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
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
                    <form id="laporan-penjualan">
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
                            <div class="col-lg-2">
                                <br>
                                <button type="button" id="btn-export" class="btn btn-success"><i class="fas fa-print"></i>Export Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="tabel-filter" class="table table-striped">
                      <thead>
                          <tr>
                              <th>Tanggal</th>
                              <th>Invoice</th>
                              <th>PO request</th>
                              <th>Customer</th>
                              <th>Marketing</th>
                              <th>Nama Barang</th>
                              <th>Qty</th>
                              <th>Satuan</th>
                              <th>Harga</th>
                              <th>Diskon</th>
                              <th>DPP</th>
                              <th>PPN</th>
                              <th>Total</th>
                              <th>Tgl Kirim</th>
                              <th>Gudang</th>
                              <th>Pembayaran</th>
                              <th>Via</th>
                              <th>Bank</th>
                              <th>Sisa Piutang</th>
                              <th>Status</th>
                              <th>Tgl Bayar</th>
                          </tr>
                      </thead>
                  </table>
                  <table id="table-laporan" class="table  table-striped">
                    <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Customer</th>
                      <th>Marketing</th>
                      <th>Total Penjualan</th>
                      <th>Status</th>
                      <th >Action</th>
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
                  <table id="table-filter" class="table table-striped table-bordered table-responsive">
                      <thead>
                          <th>Tgl Invoice</th>
                          <th>Invoice</th>
                          <th>PO Request</th>
                          <th>Customer</th>
                          <th>Marketing</th>
                          <th>Produk</th>
                          <th>Qty</th>
                          <th>Satuan</th>
                          <th>Harga</th>
                          <th>Diskon</th>
                          <th>DPP</th>
                          <th>PPN</th>
                          <th>Penjualan</th>
                          <th>Tgl Kirim</th>
                          <th>Asal Gudang</th>
                          <th>Via</th>
                          <th>Bank</th>
                          <th>Rekening</th>
                          <th>Pembayaran</th>
                          <th>Sisa</th>
                          <th>Status</th>
                          <th>Tgl Bayar</th>
                      </thead>
                  </table>
                  <hr> <hr>
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
    document.getElementById("laporan-penjualan").reset();
    $('#tabel-filter').hide();
    $('#btn-export').hide();
  }); 
  var token = "{!! csrf_token() !!}";
  $('.select2').select2();
  //Laporan
  $('#laporan-penjualan').on('submit',function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    $.ajax({
      type : 'get',
      url  : '{!! url("exp-penjualan")!!}',
      data : {
        _token : token,
        awal    : awal,
        akhir   : akhir,
      },
      success : function(response){
        console.log(response);
        $('#btn-export').show();
        $('#tabel-filter').show();
        $('#tabel-filter').DataTable().clear().destroy();
        $('#tabel-filter').DataTable({
            paging      : true,
            lengthChange: true,
            autoWidth   : true,
            search      : false,
            order       : false,
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
            dom: 'Blfrtip',
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              if (aData['status'] == "LUNAS") {
                $('td', nRow).css('background-color', '#00FF64');
              } else if(aData['status'] == "BELUM LUNAS"){
                $('td', nRow).css('background-color', '#FF6347 ');
              } else{
                $('td', nRow).css('background-color', '');
              } 
            },
          data : response.data.original.data,
          columns : [
            { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
            { data: 'invoice', name: 'invoice',orderable:false, searchable:false},
            { data: 'PO_request', name: 'PO_requesr',orderable:false, searchable:false},
            { data: 'kostumer', name: 'kostumer',orderable:false, searchable:false},
            { data: 'marketing', name: 'marketing',orderable:false, searchable:false},
            { data: 'barang', name: 'barang',orderable:false, searchable:false},
            { data: 'qty', name: 'qty',orderable:false, searchable:false},
            { data: 'satuan', name: 'satuan',orderable:false, searchable:false},
            { data: 'harga', name: 'harga',orderable:false, searchable:false},
            { data: 'diskon', name: 'diskon',orderable:false, searchable:false},
            { data: 'dpp', name: 'DPP',orderable:false, searchable:false},
            { data: 'ppn', name: 'ppn',orderable:false, searchable:false},
            { data: 'penjualan', name: 'penjualan',orderable:false, searchable:false},
            { data: 'tgl_kirim', name: 'tgl_kirim',orderable:false, searchable:false},
            { data: 'gudang', name: 'gudang',orderable:false, searchable:false},
            { data: 'pembayaran', name: 'pembayaran',orderable:false, searchable:false},
            { data: 'via', name: 'via',orderable:false, searchable:false},
            { data: 'bank', name: 'bank',orderable:false, searchable:false},
            { data: 'sisa', name: 'sisa',orderable:false, searchable:false},
            { data: 'status', name: 'status',orderable:false, searchable:false},
            { data: 'tgl_bayar', name: 'tgl_bayar',orderable:false, searchable:false},
          ],
        });
        $('#table-laporan').DataTable().clear().destroy();
        $('#table-laporan').DataTable({
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
    });
  });
  
  // Detail Data
  $('body').on('click','.detail',function(){
    var kode = $(this).data('kode');
    console.log(kode);
    $.ajax({
      type : 'get',
      url  : '{!! url("detail-penjualan/'+kode+'")!!}',
      success: function(response){
        console.log(response);
        if(response.success == true){
          $('#detail-tanggal').val(response.data.tanggal);
          $('#detail-so').val(kode);
          $('#detail-konsumen').val(response.data.rekanan);
          $('#detail-marketing').val(response.data.karyawan);
          $('#detail-po').val(response.data.no_po);
          $('#tabel-so').empty();
          var datahandler = $('#tabel-so');
          var n= 0;
          var sum = 0;
          $.each(response.data.detail, function(key,val){
              var Nrow = $("<tr>");
                var nomor = n+1;
              Nrow.html("<td>"+nomor+"</td><td>"+response.data.detail[n]['barang']+"</td><td>"+response.data.detail[n]['satuan']+"</td><td>"+response.data.detail[n]['qty']+"</td><td>"+formatRupiah(response.data.detail[n]['harga'])+"</td><td>"+formatRupiah(response.data.detail[n]['dpp'])+"</td><td>"+formatRupiah(response.data.detail[n]['PPn'])+"</td><td>"+formatRupiah(response.data.detail[n]['total'])+"</td></tr>");
              datahandler.append(Nrow);
              sum = sum+response.data.detail[n]['total'];
              n = n+1;
          });
          var totalSO = sum;
          var Nrow = $("<tr>");
          Nrow.html("<td colspan='7' style='text-align: right;color:red;'><b>Total</b></td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
          datahandler.append(Nrow);

          $('#tabel-invoice').empty();
          var datahandler = $('#tabel-invoice');
          var n= 0;
          var sum = 0;
          $.each(response.inv, function(key,val){
              var Nrow = $("<tr>");
                var nomor = n+1;
              Nrow.html("<td>"+nomor+"</td><td>"+response.inv[n]['tanggal']+"</td><td>"+response.inv[n]['kode']+"</td><td>"+response.inv[n]['kode_kas']+"</td><td>"+response.inv[n]['bank']+" - "+response.inv[n]['rekening']+"</td><td>"+formatRupiah(response.inv[n]['total'])+"</td><td>"+response.inv[n]['status']+"</td></tr>");
              datahandler.append(Nrow);
              sum = sum+response.inv[n]['total'];
              n = n+1;
          });
          var totalINV = sum;
          var Nrow = $("<tr>");
          Nrow.html("<td colspan='5' style='text-align: right;color:red;'><b>Total</b></td><td colspan='2'><b>"+formatRupiah(sum)+"</b></td></tr>");
          datahandler.append(Nrow);

          if(totalSO == totalINV){
            document.getElementById("detail-status").style.color = "green";
            $('#detail-status').html("LUNAS");
            $('#kekurangan').html("Rp. 0,00");
          } else {
            document.getElementById("detail-status").style.color = "red";
            var kekurangan = totalSO-totalINV;
            
            $('#detail-status').html("BELUM LUNAS");
            $('#kekurangan').html(kekurangan);
          }

        } else {
          Toast.fire({
            icon  : 'error',
            title : response.pesan,
          });
        }
      }
    });
  });

  // Detail Data
  
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
                url     : '{!! url("export-penjualan") !!}',
                data    :{
                    awal : awal,
                    akhir   : akhir
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
