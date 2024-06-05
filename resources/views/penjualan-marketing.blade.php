
<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Penjualan Marketing</title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/uplot/uPlot.min.css">
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
            <h1>Penjualan Marketing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Penjualan Marketing</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                     <div class="row">
                         <div class="col-md-3">
                            <div class="text-center">
                              <img class="img-fluid img-square"
                                    style="width:50%;"
                                    id="foto-marketing"
                                   src="https://img.freepik.com/free-icon/user_318-804790.jpg"
                                   alt="Profil Marketing">
                              <h3 class="profile-username text-center" id="nama-marketing"></h3>
                              <p class="text-muted text-center" id="divisi-marketing"></p>
                            </div>         
                         </div>
                         <div class="col-md-9 ">
                             <label>Chart Penjualan Bulanan</label>
                             <form id="filter-data">
                                 <div class="row">
                                     <div class="col-lg-2">
                                         <label>Perusahaan</label>
                                     </div>
                                     <div class="col-lg-4">
                                         <select class="form-control" id="filter-perusahaan" >
                                             <option value="">Pilih Perusahaan</option>
                                             <option value="NPA">CV. Nusa Pratama Anugrah</option>
                                             <option value="HERBIVOR">PT. Herbivor Satu Nusa</option>
                                             <option value="TRIPUTRA">PT. Triputra Sinergi Indonesia</option>
                                             <option value="ALL">ALL</option>
                                         </select>
                                     </div>
                                     <div class="col-lg-2">
                                         <label>Marketing</label>
                                     </div>
                                     <div class="col-lg-4">
                                         <select style="width:100%;" class="form-control select2" id="filter-marketing"></select>
                                     </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                     <div class="col-lg-2">
                                         <label>Tanggal Awal</label>
                                     </div>
                                     <div class="col-lg-4">
                                         <input type="month" class="form-control" id="filter-awal" required>
                                     </div>
                                     <div class="col-lg-2">
                                         <label>Tanggal Akhir</label>
                                     </div>
                                     <div class="col-lg-4">
                                         <input type="month" class="form-control" id="filter-akhir" required>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-lg-9"></div>
                                     <div class="col-lg-3">
                                         <button type="submit" id="submit-filter" class="btn btn-primary btn-block">Cek</button>
                                     </div>
                                 </div>
                            </form>
                            <hr>
                            <label>Chart Penjualan Dalam 1 Bulan</label>
                            <form id="grafik-perbulan">
                                <div class="row">
                                     <div class="col-lg-4 form-group">
                                        <label>Markerting</label> 
                                        <input type="text" class="form-control" id="marketing" readonly>
                                     </div>
                                     <div class="col-lg-4 form-group">
                                        <label>Bulan</label>
                                        <input type="month" class="form-control" id="Bulan" required>
                                     </div>
                                     <div class="col-lg-4 form-group">
                                        <br>
                                        <button type="submit" id="submit-grafik" class="btn btn-primary btn-block">Cek</button>         
                                     </div>
                                 </div>
                            </form>
                         </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Grafik</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart" id="grafik">
                            <div>
                              <canvas id="myChart"></canvas>
                              <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="tabel-penjualan" class="table table-bordered table-striped" style="width:100%;">
                                <thead>
                                    <tr>
                                      <th>SO</th>
                                      <th>Tanggal</th>
                                      <th>Konsumen</th>
                                      <th>Barang</th>
                                      <th>Penjualan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                  </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
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
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/uplot/uPlot.iife.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>



<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $('.select2').select2();
    $(document).ready(function(){
        $('#tabel-penjualan').hide();
        $('#myChart').hide();
        $('#myChart2').hide();
        
    });
    $('#filter-marketing').on('change',function(){
        var kode = $(this).val();
        if(kode == "ALL"){
            $('#nama-marketing').html(kode);
            $('#divisi-marketing').html(kode);
            $('#marketing').val(kode);
            document.getElementById('foto-marketing').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
        } else {
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-karyawan/'+kode+'/edit")!!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        $('#nama-marketing').html(response.result.nama);
                        $('#divisi-marketing').html(response.result.divisi);
                        $('#marketing').val(response.result.nama);
                        if(response.result.foto == "/img/karyawan/" || kode == "ALL"){
                            document.getElementById('foto-marketing').src = "https://img.freepik.com/free-icon/user_318-804790.jpg";    
                        } else {
                            var baseUrl = window.location.origin;
                            var fotoUrl = baseUrl + response.result.foto;
                            document.getElementById('foto-marketing').src = fotoUrl;    
                        }
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        })
                    }
                }
            })
        }
        
    });
    
    $('#filter-perusahaan').on('change',function(){
        var data = $(this).val();
        try{
            $('#filter-marketing').select2({
                placeholder: 'Pilih Marketing',
                  ajax: {
                      url: '{!! url("dropdown-sales/'+data+'") !!}',
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
        } catch(error){
            Toast.fire({
                icon    : 'error',
                title   : error
            })
        }
        
    })
    
    
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
    
    var ctx = document.getElementById("myChart").getContext('2d');
    var cty = document.getElementById("myChart2").getContext('2d');
    var chart;
    $('#filter-data').submit(function (e) {
        e.preventDefault();
        var token = "{!! csrf_token() !!}";
        $.ajax({
            type    : 'GET',
            url     : '{!! url("grafik")!!}',
            data    : {
                _token : token,
                perusahaan : $('#filter-perusahaan').val(),
                marketing : $('#filter-marketing').val(),
                awal    : $('#filter-awal').val(),
                akhir   : $('#filter-akhir').val(),
            },
            success: function (response) {
                console.log(response);
                if(response.success == true){
                    $('#tabel-penjualan').DataTable().clear().destroy();
                    $('#tabel-penjualan').hide();
                    if (chart) {
                        chart.destroy();
                    }
                    $('#myChart').show(); $('#myChart2').hide();
                    const data = {
                      labels: response.label,
                      datasets: [
                        {
                            label: "Jumlah Penjualan Rp ",
                            data: response.value,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                        },
                      ]
                    };
                    
                    chart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                              legend: {
                                position: 'top',
                              },
                              title: {
                                display: true,
                                text: response.title
                              }
                            }
                          },
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                }
                
            },
            error:function(response){
                console.log(response);
                Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
            }
        });
    });
    $('#grafik-perbulan').submit(function (e) {
        e.preventDefault();
        var token = "{!! csrf_token() !!}";
        var select = document.getElementById("filter-marketing");
        var namasales = select.options[select.selectedIndex].text;
        var perusahaan = document.getElementById("filter-perusahaan");
        var namaperusahaan = perusahaan.options[perusahaan.selectedIndex].text;
        $.ajax({
            type    : 'GET',
            url     : '{!! url("grafik-bulanan")!!}',
            data    : {
                _token : token,
                marketing : $('#filter-marketing').val(),
                bulanan    : $('#Bulan').val(),
            },
            success: function (response) {
                console.log(response);
                if(chart){
                    chart.destroy();
                }
                
                var marketing = $('#filter-marketing').val();
                if(marketing == "ALL"){
                   $('#myChart').hide(); $('#myChart2').show();  $('#tabel-penjualan').DataTable().clear().destroy(); $('#tabel-penjualan').hide();
                    chart = new Chart(cty, {
                        type: 'pie',
                        data: {
                            labels: response.marketing,
                            datasets: [{
                                data: response.penjualan,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                              legend: {
                                position: 'top',
                                color : '#000000',
                              },
                              title: {
                                display: true,
                                text: 'Grafik Penjualan '+namaperusahaan+' Bulan '+response.bln,
                                color : '#000000',
                                font : {
                                    weight : 'bold',
                                    size : 24,
                                }
                              },
                              subtitle: {
                                  display : true,
                                  text    : "Total Penjualan : "+response.jumlah,
                                  font : {
                                    weight : 'bold',
                                    size : 14,
                                  },
                                  color : '#000000',
                              },
                              tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var value = context.parsed;
                                        return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                                    }
                                }
                              }
                              
                            }
                        }
                    });
                } else {
                    $('#myChart').show(); $('#myChart2').hide();
                    // PIE
                    const data = {
                      labels: response.label,
                      datasets: [
                        {
                            label: "Jumlah Penjualan Rp ",
                            data: response.value,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1,
                        },
                      ]
                    };
                    
                    chart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                              legend: {
                                position: 'top',
                              },
                              title: {
                                display: true,
                                text: 'Grafik Penjualan '+namasales+' Bulan '+response.bln,
                                color : '#000000',
                                font : {
                                    weight : 'bold',
                                    size : 24,
                                }
                              },
                              subtitle : {
                                  display : true,
                                  text : 'Total Penjualan : '+response.all,
                                  color : '#000000',
                                  font : {
                                    weight : 'bold',
                                    size : 14,
                                  }
                              }
                            }
                          },
                    });
                    $('#tabel-penjualan').DataTable().clear().destroy();
                    $('#tabel-penjualan').DataTable({
                        paging      : true,
                        lengthChange: true,
                        autoWidth   : true,
                        search      : false,
                          buttons: [
                              'copy', 'csv', 'excel', 'pdf', 'print'
                          ],
                        dom: 'Blfrtip',
                      data : response.data,
                      columns : [
                        { data: 'kode', name: 'kode',orderable:false, searchable:false},
                        { data: 'tanggal', name: 'tanggal',orderable:false, searchable:false},
                        { data: 'rekanan', name: 'rekanan',orderable:false, searchable:false},
                        { data: 'barang', name: 'barang',orderable:false, searchable:false},
                        { data: 'penjualan', name: 'penjualan',orderable:false, searchable:false},
                      ],
                      
                    });
                    $('#tabel-penjualan').show();
                }
            }
        });
        
    });
   
</script>


</body>
</html>