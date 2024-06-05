<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Login</title>
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
        <img src="{{asset('img')}}/logo.png"  class="brand-image" style="opacity: .8" width="20%">
        <H4><b > CV. NUSA PRATAMA ANUGRAH</b></H4>
    </div>
    <div class="card-body">
      <form id="login" action="{{url ('login/proses')}}" method="post">
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
      <div class="row">
        <div class="col-lg-8">
            <a href="absensi">Absen Harian</a>
        </div>
        <div class="col-lg-4">
            <a href="https://api.whatsapp.com/send?phone=+6285693853225&text=Saya%20mengalami%20kendala%20lupa%20password%20saat%20login%">Lupa password</a>
        </div>
    </div>
        
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
