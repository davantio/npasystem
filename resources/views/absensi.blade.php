<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Absensi</title>
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
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
        <div class="col-lg-3">
            <img src="{{asset('img')}}/logo.png"  class="brand-image" style="opacity: .8" width="100%">    
        </div>
        <div class="col-lg-9">
            <b> ABSENSI KARYAWAN</b>
            <br>
            <b>CV NUSA PRATAMA ANUGRAH</b>
            <br>
            <?php
                $ip = $_SERVER['REMOTE_ADDR'];
                echo "Alamat IP Anda: " . $ip;
            ?>
        </div>
        
    </div>
    <div class="card-body">
      <form id="form">
        <div class="input-group mb-3">
          <input autofocus type="text" class="form-control"  name="username" placeholder="username"  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-check"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password"  placeholder="Password"  >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <b id="id"></b>
          <!-- /.col -->
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary ">Absen</button>
        </div>
          <!-- /.col -->
      </form>
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
    document.getElementById("form").reset();
    getLocation();
    $.ajax({
         type   : 'get',
         url    : '{!! url("cek-lokasi") !!}',
         success : function(response) {
             console.log(response);
             if(response.success == true){
                 Toast.fire({
                     icon   :"success",
                     title  : response.data.geoplugin_latitude+","+response.data.geoplugin_longitude,
                 });
             } else {
                 Toast.fire({
                     icon   :"error",
                     title  : response.pesan,
                 });
             }
         }
     })
    
  }); 
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 10000
  });
  
  function getLocation() {
    //   console.log('Haii');
    //   console.log(navigator.geolocation.getCurrentPosition);
    //   Toast.fire({
    //       icon : "error",
    //       title : navigator.geolocation.getCurrentPosition,
    //   })
    if (navigator.geolocation) {
        
        console.log(navigator.geolocation);
        // showPosition(navigator.geolocation.getCurrentPosition);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
  }
  function showPosition(position) {
      console.log("masuk");
      var Latitude = position.coords.latitude;
      var Longitude = position.coords.longitude;
      console.log("Lat : "+Latitude);
      console.log("Long : "+Longtitude);
  }
  $('#form').submit(function(e){
     e.preventDefault(); // prevent actual form submit
     var el = $('.btn');
     el.prop('disabled', true);
     setTimeout(function(){el.prop('disabled', false); }, 4000);
     var token = "{!! csrf_token() !!}"; 
     var IP = "<?php echo $ip;?>";
     var device = navigator.userAgent;
     console.log(IP);
     $.ajax({
         type   : 'get',
         url    : '{!! url("proses-absensi") !!}',
         data   : {
             token : token,
             ip     : IP,
             device : device,
         },
         success : function(response) {
             console.log(response);
             Toast.fire({
                 icon   : 'info',
                 title  : response.data.user,
             })
             $("#id").html(response.data.user);
         }
     })
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
