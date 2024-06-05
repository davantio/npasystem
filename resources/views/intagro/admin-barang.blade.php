<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Data Barang Intagro Plt Lte</title>
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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    
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
                    <a href="admin" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="barang" class="nav-link active" >
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
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin">Home</a></li>
              <li class="breadcrumb-item">Data barang</li>
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
            <div class="card col-lg-12">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-list-alt mr-1"></i>
                      Kategori Produk
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <button type="button" id="tambahkategori" data-toggle="modal" data-target="#modal-tambah-kategori" data-backdrop="static" class="btn bg-gradient-primary">Tambah Kategori</button>
                    </div>
                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="card col-lg-12">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-shopping-cart mr-1"></i>
                      List Produk
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <button type="button" id="tambahproduk" data-toggle="modal" data-target="#modal-tambah-produk" data-backdrop="static" class="btn bg-gradient-primary">Tambah Produk</button>
                    </div>
                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Kandungan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
    <div class="modal-fade" id="modal-tambah-kategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="tambah-kategori" method="POST" enctype="multipart/form-data">
                    <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Upload Foto</label>
                                <br>
                                <img class="profile-user-img img-fluid img-square" style="width:100%;"
                                    id="tambah-preview"
                                    alt="Foto Kategori">
                                <input type="file" class="form-control" id="tambah-img-kategori" name="tambah-img-kategori" >
                            </div>
                            <div class="col-lg-6">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control" id="tambah-nama-kategori" name="tambah-nama-kategori">
                                <label>Deskripsi Kategori</label>
                                <textarea id="tambah-deskripsi-kategori" name="tambah-deskripsi-kategori" class="form-control"  rows="5"  required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer form-group justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-tambah" class="btn btn-save btn-primary">Simpan</button>
                    </div>
                </form>
                
                
            </div>
        </div>
        
    </div>
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
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
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
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.js"></script>
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
