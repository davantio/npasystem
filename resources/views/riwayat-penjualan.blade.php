<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Riwayat Penjualan</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
    
    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div> 
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
            <h1 class="m-0">Riwayat Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Riwayat Penjualan</li>
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
                  <div id="search">
                      <form id="form-filter">
                        <div class="row form-group">
                            <div class="col-lg-3">
                              <label>Tanggal Awal</label>
                              <input type="date" id="filter-awal" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                              <label>Tanggal Akhir</label>
                              <input type="date" id="filter-akhir" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                              <label>Marketing</label>
                              <select id="filter-marketing" class="form-control select2" required></select>
                            </div>
                            <div class="col-lg-3">
                              <br>
                              <button id="submit-filter" type="submit" class="btn bg-gradient-success">Cari</button>
                            </div>
                            
                        </div>    
                      </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div id="table-filter" class="card-body table-responsive">
                    <table id="tabel-penjualan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>No.</th>
                              <th>SO</th>
                              <th>Invoice</th>
                              <th>Nama Barang</th>
                              <th>Marketing</th>
                              <th>Tanggal</th>
                              <th>Total Transaksi</th>
                              <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="body-penjualan">
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
    
<!--/ MODAL -->

<!-- /MODAL -->
  <!-- /.content-wrapper -->
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
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script>
    
    
    $(document).ready(function() {
        document.getElementById("form-filter").reset();
        // $('#tabel-penjualan').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url: '{!! url("data-riwayatpenjualan") !!}',
        //         type: 'POST',
        //         data: function (d) {
        //             d.awal = $('#filter-awal').val();
        //             d.akhir = $('#filter-akhir').val();
        //             d.marketing = $('#filter-marketing').val();
        //             d._token = "{{ csrf_token() }}";
        //         }
        //     },
        //     columns: [
        //         { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
        //         { data: 'so', name: 'so',orderable:false},
        //         { data: 'invoice', name: 'invoice',orderable:false},
        //         { data: 'barang', name: 'barang',orderable:false},
        //         { data: 'total', name: 'total',orderable:false},
        //         { data: 'marketing', name: 'marketing',orderable:false},
        //         { data: 'tanggal', name: 'tanggal',orderable:false},
        //         { data: 'status', name: 'status',orderable:false},
        //     ]
        // });
        
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
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
      }
    function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    } 
//Filter
    //Filter Marketing
      @if($user->level == 'marketing')
        var datahandler = $('#filter-marketing');
        var Nrow = $("<option value=''>Pilih Marketing</option>");
        datahandler.append(Nrow);
        var Nrow = $("<option value='{{$user->kode_karyawan}}'>{{$detail->nama}}</option>");
        datahandler.append(Nrow);
      @else
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#filter-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
            datahandler.append(Nrow);
            var Nrow = $("<option value='all'>ALL</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
      @endif
    //Filter Marketing
    
    $('#form-filter').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#submit-filter');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        // $('#tabel-penjualan').DataTable().draw();
        
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-riwayatpenjualan") !!}',
            data    : {
                awal    : $('#filter-awal').val(),
                akhir   : $('#filter-akhir').val(),
                marketing: $('#filter-marketing').val(),
            },
            success : function (response){
                if(response.success == true){
                    var datahandler = $('#body-penjualan');
                    datahandler.empty();
                    var n= 0;
                    $.each(response.data, function(key,val){
                        var Nrow = $("<tr>");
                          var nomor = n+1;
                        Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode_so']+"</td><td>"+response.data[n]['kode']+"</td><td>"+response.data[n]['barang']+"</td><td>"+response.data[n]['marketing']+"</td><td>"+response.data[n]['tanggal']+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['status']+"</td></tr>");
                        datahandler.append(Nrow);
                        n = n+1;
                    });
                    var Nrow = $("<tr>");
                    Nrow.html("<td colspan='6' style='text-align: center;color:red;'><b>Total</b></td><td><b>"+formatRupiah(response.total)+"</b></td><td></td></tr>");
                    datahandler.append(Nrow);
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
        });
    });
//Filter
</script>
</body>
</html>
