<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard Admin Intagro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    
    <link rel="icon" type="image/x-icon" href="{{asset('image/')}}/logo intagro.jpeg" />  
  
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/fontawesome-free/css/all.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/summernote/summernote-bs4.min.css">
    <!-- Sweet Alert-->
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('image')}}/logo intagro.jpeg" width="30%" >
  </div> 
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
        <a class="nav-link">
          <script type='text/javascript'>

            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
            
            var date = new Date();
            
            var day = date.getDate();
            
            var month = date.getMonth();
            
            var thisDay = date.getDay(),
            
                thisDay = myDays[thisDay];
            
            var yy = date.getYear();
            
            var year = (yy < 1000) ? yy + 1900 : yy;
            
            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
            
           </script>
          
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!--{{-- <li class="nav-item">-->
      <!--  <a class="nav-link" data-widget="navbar-search" href="#" role="button">-->
      <!--    <i class="fas fa-search"></i>-->
      <!--  </a>-->
      <!--  <div class="navbar-search-block">-->
      <!--    <form class="form-inline">-->
      <!--      <div class="input-group input-group-sm">-->
      <!--        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
      <!--        <div class="input-group-append">-->
      <!--          <button class="btn btn-navbar" type="submit">-->
      <!--            <i class="fas fa-search"></i>-->
      <!--          </button>-->
      <!--          <button class="btn btn-navbar" type="button" data-widget="navbar-search">-->
      <!--            <i class="fas fa-times"></i>-->
      <!--          </button>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--    </form>-->
      <!--  </div>-->
      <!--</li>-->

      <!-- Messages Dropdown Menu -->
      <!--<li class="nav-item dropdown">-->
      <!--  <a class="nav-link" data-toggle="dropdown" href="#">-->
      <!--    <i class="far fa-comments"></i>-->
      <!--    <span class="badge badge-danger navbar-badge">3</span>-->
      <!--  </a>-->
      <!--  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
      <!--    <a href="#" class="dropdown-item">-->
            <!-- Message Start -->
      <!--      <div class="media">-->
      <!--        <img src="{{asset('AdminLTE/dist')}}/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">-->
      <!--        <div class="media-body">-->
      <!--          <h3 class="dropdown-item-title">-->
      <!--            Brad Diesel-->
      <!--            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>-->
      <!--          </h3>-->
      <!--          <p class="text-sm">Call me whenever you can...</p>-->
      <!--          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>-->
      <!--        </div>-->
      <!--      </div>-->
            <!-- Message End -->
      <!--    </a>-->
      <!--    <div class="dropdown-divider"></div>-->
      <!--    <a href="#" class="dropdown-item">-->
            <!-- Message Start -->
      <!--      <div class="media">-->
      <!--        <img src="{{asset('AdminLTE/dist')}}/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">-->
      <!--        <div class="media-body">-->
      <!--          <h3 class="dropdown-item-title">-->
      <!--            John Pierce-->
      <!--            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>-->
      <!--          </h3>-->
      <!--          <p class="text-sm">I got your message bro</p>-->
      <!--          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>-->
      <!--        </div>-->
      <!--      </div>-->
            <!-- Message End -->
      <!--    </a>-->
      <!--    <div class="dropdown-divider"></div>-->
      <!--    <a href="#" class="dropdown-item">-->
            <!-- Message Start -->
      <!--      <div class="media">-->
      <!--        <img src="{{asset('AdminLTE/dist')}}/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">-->
      <!--        <div class="media-body">-->
      <!--          <h3 class="dropdown-item-title">-->
      <!--            Nora Silvester-->
      <!--            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>-->
      <!--          </h3>-->
      <!--          <p class="text-sm">The subject goes here</p>-->
      <!--          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>-->
      <!--        </div>-->
      <!--      </div>-->
            <!-- Message End -->
      <!--    </a>-->
      <!--    <div class="dropdown-divider"></div>-->
      <!--    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>-->
      <!--  </div>-->
      <!--</li> --}}-->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="material-icons">settings</i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Pengaturan</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url ('logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>

  
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>

  <!-- Main Sidebar Container -->
  <!-- MAIN content sidebar -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin" class="brand-link">
        <img src="{{asset('image')}}/logo intagro.jpeg"  class="brand-image" style="opacity: .8">
        <span class=""><h6> Intagro Plt Lte</h6></span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
            <a href="#" class="d-block"><b>ADMIN</b></a>
        </div>
        </div>
    
        <!-- SidebarSearch Form -->
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <div class="SMIN">
                
                <li class="nav-item ">
                    <a href="admin" class="nav-link active" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="barang" class="nav-link " >
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Data Barang </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="admin-aboutus" class="nav-link " >
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>About Us </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="profile" class="nav-link " >
                        <i class="nav-icon fa fa-user"></i>
                        <p>Profil Perusahaan </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Selamat Datang Andreass</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="dashboard">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Purchase Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a data-toggle="modal" data-target="#modal-po" class="small-box-footer">Cek Purchase Order <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Dalam Pengiriman</p>
              </div>
              <div class="icon">
                <i class="fa fa-truck"></i>
              </div>
              <a data-toggle="modal" data-target="#modal-sj" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>44</h3>

                <p>Invoice Belum Lunas</p>
              </div>
              <div class="icon">
                <i class="fa fa-fax"></i>
              </div>
              
              <a data-toggle="modal" data-target="#modal-invoice" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Penjualan 6 bulan kebelakang
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <section class="col-lg-6 connectedSortable">
            
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- Calendar -->
           
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
  
  <!-- /.modal -->
  
  <!-- /.modal -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://nusasystem.com/intagro/">Intagro Plt Lte</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
  <!-- Sparkline -->
<script src="{{asset('AdminLTE/plugins')}}/sparklines/sparkline.js"></script>
<!-- JQVMap -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Ajax-->

<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE/plugins')}}/chart.js/Chart.min.js"></script>
{{-- <!-- Sparkline -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js"></script> --}}
<!-- JQVMap -->
<script src="{{asset('AdminLTE/plugins')}}/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE/plugins')}}/moment/moment.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins')}}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('AdminLTE/plugins')}}/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE/plugins')}}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('AdminLTE/dist')}}/js/pages/dashboard.js"></script>
<script>
  // var Toast = Swal.mixin({
  //   toast: true,
  //   position: 'top-center',
  //   showConfirmButton: false,
  //   timer: 3000
  // });
</script>
<script>
  console.log( 
    
  );
</script>
</body>
</html>
