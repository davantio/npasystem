 <!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Data Vendor</title>
    </head>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
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
                    <h1>Data Vendor</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="main">Home</a></li>
                      <li class="breadcrumb-item active">Data Vendor</li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                          <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah" class="btn bg-gradient-primary">Tambah Vendor</button>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="tabel-vendor" class="table table-striped">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Produk</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Keterangan</th>
                          </tr>
                          </thead>
                          <tbody>
                          
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
          <!-- /.content-wrapper -->
        
        <!-- MODAL -->
          <!-- MODAL Tambah Vendor -->
            <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <form id="form-tambah">
                          <div class="modal-header bg-primary">
                              <h4 class="modal-title">Tambah Data Vendor</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <b><span aria-hidden="true">&times;</span></b>
                              </button>
                          </div>
                          <div class="modal-body">
                            <div class="row" id="data">
                                <div class="col-lg-6">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="tambah-nama" name="tambah-nama" required>
                                    <label>Produk</label>
                                    <input type="text" class="form-control" id="tambah-produk" name="tambah-produk" required>
                                    <label>Telepon</label>
                                    <input id="tambah-telepon" name="tambah-telepon" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Alamat</label>
                                    <textarea class="form-control" id="tambah-alamat" name="tambah-alamat" rows="3" placeholder="Alamat Lengkap"></textarea>
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="tambah-keterangan" name="tambah-keterangan" rows="3"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between ">
                              <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" id="btn-tambah" class=" col-sm-4 form-control btn btn-primary">Tambah</button>
                          </div>
                      </form>
                  </div>
              </div>
            </div>
          <!--/ Modal Tambah Vendor -->
          <!-- Modal Detail Vendor -->
            <div class="modal fade" id="modal-detail">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Detail Data Vendor</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <div class="row" >
                            <div class="col-lg-6">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="detail-nama" disabled>
                                <label>Produk</label>
                                <input type="text" class="form-control" id="detail-produk" disabled>
                                <label>Telepon</label>
                                <input type="text" class="form-control" id="detail-telepon" disabled>
                            </div>
                            <div class="col-lg-6">
                                <label>Alamat</label>
                                <textarea class="form-control" id="detail-alamat" rows="3" style="resize:none;" disabled></textarea>
                                <label>Keterangan</label>
                                <textarea class="form-control" id="detail-keterangan" rows="3" style="resize:none;" disabled></textarea>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>
          <!-- /Modal Detail Vendor -->
          <!-- MODAL Edit Vendor -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <form id="form-edit">
                            <div class="modal-header bg-warning">
                                <h4 class="modal-title">Edit Data Vendor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                            <div class="row" id="data">
                                <div class="col-lg-6">
                                    <input type="hidden" id="edit-kode">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="edit-nama" required>
                                    <label>Produk</label>
                                    <input type="text" class="form-control" id="edit-produk"  required>
                                    <label>Telepon</label>
                                    <input id="edit-telepon" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Alamat</label>
                                    <textarea class="form-control" id="edit-alamat" rows="3" style="resize:none;"></textarea>
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="edit-keterangan"  rows="3" style="resize:none;"></textarea>
                                </div>
                            </div>
                          </div>
                            <div class="modal-footer justify-content-between ">
                                <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-edit" class=" col-sm-4 form-control btn btn-warning">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!--/ Modal Edit Vendor -->
          <!-- MODAL Hapus Vendor -->
            <div class="modal fade" id="modal-hapus">
                <div class="modal-dialog modal-sm">
                    <form id="form-hapus">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h4 class="modal-title">Hapus Data Vendor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                  Apakah Anda Yakin Akan Menghapus Data ini ?
                                  <div class="row">
                                      <input id="hapus-kode" class="form-control" type="text" required hidden>
                                      <label class=" col-md-3">Nama </label> 
                                      <label class="col-md-1">:</label>
                                      <label class="col-md-8" id="hapus-nama" ></label>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between ">
                                <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          <!--/ Modal Hapus Vendor -->
        <!--/ MODAL -->
        
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
        <script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
        <script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- Page specific script -->
        <script>
            $('.select2').select2();
          $(document).ready(function() {   
            $('#tabel-vendor').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                ajax: '{!! url("data-vendor") !!}',
                columns: [         
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                    { data: 'action', name: 'action',orderable:false, searchable:false},
                    { data: 'nama', name: 'vendor',orderable:true},
                    { data: 'produk', name: 'produk',orderable:true},
                    { data: 'telepon', name: 'telepon',orderable:false},
                    { data: 'alamat', name: 'alamat',orderable:true},
                    { data: 'keterangan', name: 'keterangan',orderable:true},
                ]
            });
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
          //Tambah
              $(document).on('click','#tambahdata',function(){
                document.getElementById("form-tambah").reset();
                
                document.getElementById("tambah-nama").focus();
                
              });
              $('#form-tambah').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-tambah');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var token = "{!! csrf_token() !!}";
                $.ajax({
                  type: 'post',
                  url: '{!! url("data-vendor") !!}',
                  data : {
                    _token   : token,
                    nama     : $('#tambah-nama').val(),
                    produk   : $('#tambah-produk').val(),
                    telepon  : $('#tambah-telepon').val(),
                    alamat   : $('#tambah-alamat').val(),
                    keterangan : $('#tambah-keterangan').val(),
                  }, // serializes form input
                  success:function(response) {
                      // console.log(response);
                    if(response.success == true ){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-tambah').modal('hide');
                      var table = $('#tabel-vendor').DataTable(); 
                      $('#tambahdata').focus();
                      table.ajax.reload( null, false );
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  }
                });
              });
          //Tambah
          //Detail
            $('body').on('click', '.detail', function () {
              var kode = $(this).data('kode');
              $('.kendaraan').hide();
              $.ajax({
                url :'{!! url("data-vendor/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  // console.log(response);
                  if(response.success == true){
                    $('#detail-nama').val(response.data.nama);
                    $('#detail-produk').val(response.data.produk);
                    $('#detail-telepon').val(response.data.telepon);
                    $('#detail-alamat').val(response.data.alamat);
                    $('#detail-keterangan').val(response.data.keterangan);
                  } else {
                    Toast.fire({
                      icon: 'error',
                      title: response.pesan
                    })
                  }
                }
              });
          });
          //Detail
          //Edit
            $('body').on('click', '.edit', function () {
                var kode = $(this).data('kode');
                document.getElementById("form-edit").reset();
                
                $.ajax({
                    url :'{!! url("data-vendor/'+kode+'/edit") !!}',
                    type : 'get',
                    success : function(response){
                      // console.log(response);
                      if(response.success == true){
                        $('#edit-kode').val(kode);
                        $('#edit-nama').val(response.data.nama);
                        $('#edit-produk').val(response.data.produk);
                        $('#edit-telepon').val(response.data.telepon);
                        $('#edit-alamat').val(response.data.alamat);
                        $('#edit-keterangan').val(response.data.keterangan);
                      } else {
                        Toast.fire({
                          icon: 'error',
                          title: response.pesan
                        })
                      }
                    }
                });
            });
            $('#form-edit').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-edit');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var token = "{!! csrf_token() !!}";
                var kode = $('#edit-kode').val();
                $.ajax({
                  type: 'PUT',
                  url: '{!! url("data-vendor/'+kode+'") !!}',
                  data : {
                    nama     : $('#edit-nama').val(),
                    _token   : token,
                    produk   : $('#edit-produk').val(),
                    telepon  : $('#edit-telepon').val(),
                    alamat  : $('#edit-alamat').val(),
                    keterangan : $('#edit-keterangan').val(), 
                  }, // serializes form input
                  success:function(response) {
                    // console.log(response);
                    if(response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-edit').modal('hide');
                      var table = $('#tabel-vendor').DataTable(); 
                      table.ajax.reload( null, false );
                      $('#tambahdata').focus();
                    } else {
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                    
                  },
                });
              });
          //Edit
          //Hapus
            $('body').on('click', '.hapus', function () {
              document.getElementById("form-hapus").reset();
              var nama = $(this).data('nama');
              var kode = $(this).data('kode');
              // console.log(kode);
              document.getElementById("hapus-nama").innerHTML = nama ;
              $('#hapus-kode').val(kode);
            });
            $('#form-hapus').submit(function(e){
                e.preventDefault(); // prevent actual form submit
                var el = $('#btn-hapus');
                el.prop('readonly', true);
                setTimeout(function(){el.prop('readonly', false); }, 3000);
                var token = "{!! csrf_token() !!}";
                var kode = $('#hapus-kode').val();
                $.ajax({
                  type    : 'delete',
                  url     : '{!! url("data-vendor/'+kode+'") !!}',
                  data    : {
                    _token  : token,
                  },
                  success:function(response) {
                    // console.log(response);
                    if(response.success == true){
                      Toast.fire({
                        icon: 'success',
                        title: response.pesan
                      })
                      $('#modal-hapus').modal('hide');
                      var table = $('#tabel-vendor').DataTable(); 
                      table.ajax.reload( null, false );
                      $('#tambahdata').focus();
                    } else{
                      Toast.fire({
                        icon: 'error',
                        title: response.pesan
                      })
                    }
                  },
                });
            });
          //Hapus
          
          
          
          function angka(evt){
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (charCode > 31 && (charCode < 48 || charCode > 57))
        
                  return false;
              return true;
          }
          function formatRupiah(money) {
            return new Intl.NumberFormat('id-ID',
              { style: 'currency', currency: 'IDR' }
            ).format(money);
          }
        </script>
    </body>
</html>