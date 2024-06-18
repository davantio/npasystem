<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link">
                @include('layout/tanggal')
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" id="target-marketing"></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" id="plan-marketing"></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" id="omset-marketing"></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="material-icons">settings</i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Pengaturan</span>
                <div class="dropdown-divider"></div>
                <a data-toggle="modal" id="ubah-password" data-target="#modal-ubah-password" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout') }}" class="dropdown-item">
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

<!-- Modal Ubah Password -->
<div class="modal fade" id="modal-ubah-password">
    <div class="modal-dialog modal-xl">
        <form id="form-password">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old_password">Tuliskan Password Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Buat Password Baru</label>
                        <input type="password" name="new_password" id="new_password" minlength="8" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Tulis Ulang Password Baru</label>
                        <input type="password" name="confirm_password" id="confirm_password" minlength="8" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Ubah Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Include Bootstrap CSS and JS -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });
  });

  $('#form-password').submit(function(event){
    event.preventDefault();

    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    var token = "{!! csrf_token() !!}";

    $.ajax({
      type: 'POST',
      url: '{!! url("ubah-password") !!}',
      data: {
        _token: token,
        old_password: old_password,
        new_password: new_password,
        confirm_password: confirm_password
      },
      success: function (data) {
          Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Password berhasil diubah',
              showConfirmButton: false,
              timer: 3000
          });
      },
      error: function (xhr) {
          Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: xhr.responseJSON.message,
              showConfirmButton: false,
              timer: 3000
          });
      }
    });
  });

  function omset(marketing){
    $.ajax({
      type: 'GET',
      url: '{!! url("omset-marketing") !!}',
      data: {
        marketing: marketing,
      },
      success: function(response){
        console.log(response);
        if(response.success == true){
          $('#omset-marketing').html("Omset Bulan ini " + formatRupiah(response.omset));
          $('#target-marketing').html("Target Penjualan " + formatRupiah(response.target));
          $('#plan-marketing').html("Plan Penjualan " + formatRupiah(response.plan));
          if(response.omset >= response.target){
            document.getElementById("omset-marketing").style.color = "green";
          } else {
            document.getElementById("omset-marketing").style.color = "red";
          }
        } else {
          Toast.fire({
            icon: 'error',
            title: response.pesan
          });
        }
      }
    });
  }

  function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(money);
  }
</script>

@if($user->level == "marketing")
<script>
  var marketing = "{{$user->kode_karyawan}}";
  omset(marketing);
</script>
@elseif($user->level == "superadmin" || $user->level == "ceo" || $user->level == "manager-marketing" || $user->level == "admin-marketing")
<script>
  var marketing = "ALL";
  omset(marketing);
</script>
@endif
