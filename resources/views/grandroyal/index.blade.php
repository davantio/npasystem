<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://image.pngaaa.com/108/5561108-middle.png" />  
  
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
<head>
  <title>Grand Royal Hall Harmoni</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
</script>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header justify-content-around row">
        <img src="https://image.pngaaa.com/108/5561108-middle.png"  class="brand-image" style="opacity: .8" width="20%">
        <H4><b >Grand Royal Hall Harmoni</b></H4>
    </div>
    <div class="card-body">
      <form id="login" action="{{url ('grandroyal/login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input autofocus type="text" class="form-control
          @error('username')
            is-invalid
          @enderror
          "  name="username" placeholder="username" required >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-check"></span>
            </div>
          </div>

          @error('username')
          <script>
            Toast.fire({
              icon: 'error',
              title: 'Username / Password Salah',
            })
          </script>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control
          @error('password')
            is-invalid
          @enderror
          " name="password"  placeholder="Password"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
          <script>
            Toast.fire({
              icon: 'error',
              title: 'Username / Password Salah',
            })
          </script>
          @enderror
        </div>
          <!-- /.col -->
        <div class="row justify-content-center">
           
                <button type="submit" class="btn btn-primary ">Sign In</button>
        </div>
          
          <!-- /.col -->
        </div>
      </form>
        
      </div>
      </div>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
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
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<script>
  $(document).ready(function() {   


  }); 
  // $('#login').submit(function(e){
  //   e.preventDefault(); // prevent actual form submit
  //   var el = $('.btn');
  //   el.prop('disabled', true);
  //   setTimeout(function(){el.prop('disabled', false); }, 4000);
  //   var token = "{!! csrf_token() !!}";
  //   var data  = $('#login').serialize();
  //   $.ajaxSetup({
  //     header :{ 'X-CSRF-TOKEN' : $('meta[name="csrf-token').attr('content')}
  //   });
  //   $.ajax({
  //       type: 'post',
  //       url: '{!! url("proses_login") !!}',
  //       data : data, // serializes form input
  //       success:function(response) {
  //         console.log(response);
  //         // var hasil = response.pesan;
  //         // if(hasil == "Login Berhasil"){
  //         //   Toast.fire({
  //         //       icon: 'success',
  //         //       title: hasil
  //         //   })
  //         //   window.location.replace(response.link);
  //         // } else {
  //         //   Toast.fire({
  //         //       icon: 'error',
  //         //       title: hasil
  //         //   })
  //         // }
          
  //       }
  //   });
  // });



  
</script>
</body>
</html>
