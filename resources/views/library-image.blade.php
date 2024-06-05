<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Library Image </title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini" >
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
            <h1>Library Image</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Library Image</li>
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
                <div class="row ">
                    <div class="col-lg-8 justify-content-between">
                        <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah </button>  
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-image" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Nama</th>
                    <th>Image</th>
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
  <!-- MODAL Tambah -->
     <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog ">
            <form id="tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Upload Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="col-lg-12 text-center">Preview Foto</label>
                        <div class="row">
                            <img class="profile-user-img img-fluid img-square" style="width:70%;"
                            id="preview"
                            alt="Foto Image">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Nama Gambar</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama File" required>    
                            </div>
                            <div class="col-lg-6">
                                <label>File Gambar</label>
                                <input type="file" id="image" name="image" class="form-control" required>
                                <p class="text-danger">Pastikan foto berukuran sesuai ukuran yang dibutuhkan</p>    
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-cancelupload" class="btn btn-default">Cancel</button>
                        <button type="submit" id="btn-upload" class="btn btn-save btn-primary">Upload</button>
                    </div>   
                  
                  
                </div>
            </form>
        </div>
    </div>
  <!-- /Modal Tambah-->
  <!-- Modal Detail -->
    
  <!-- /Modal Detail  -->
  <!-- MODAL Edit  -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog ">
            <form id="edit" method="PUT" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Upload Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="edit-id" name="edit-id" class="form-control">
                            <img class="profile-user-img img-fluid img-square" style="width:100%;"
                            id="edit-preview"
                            alt="Foto Image">
                            <br>
                            <label>Preview Foto</label>
                            <br>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="edit-nama" name="edit-nama" required>
                            <br>
                            <input type="file" id="edit-image" name="edit-image" class="form-control" >
                            <p class="text-danger">Pastikan foto berukuran sesuai ukuran yang dibutuhkan</p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-edit-cancelupload" class="btn btn-default">Cancel</button>
                        <button type="submit" id="btn-edit" class="btn btn-save btn-warning">Edit</button>
                    </div>   
                  
                  
                </div>
            </form>
        </div>
    </div>
  <!--/ Modal Edit  -->
  <!-- MODAL Hapus  -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Library Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    Apakah Anda Yakin Akan Menghapus Data ini ?
                                    <input id="hps-id"  class="form-control" type="text" required hidden>
                                    <div class="row">
                                        <label class=" col-md-3">nama </label> 
                                        <label class=" col-md-1">: </label> 
                                        <label class="col-md-8" id="hps-nama"></label>
                                    </div>
                                </div>
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
  <!--/ Modal Hapus  -->
  <!-- Modal Import -->
    
  <!--/ Modal Import -->
<!--/ MODAL -->

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
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->

<script>
  $(document).ready(function() {
      
    $('#tabel-image').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-library-image") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'nama', name: 'nama',orderable:true, searchable:true},
            { 
                data: 'url',
                name: 'url',
                orderable:false,
                searchable:true,
                render: function (data, type, full, meta) {
                    return '<img src="{{asset('img')}}/' + data + '" alt="Gambar" width="150">';
                }
            }
        ]
    });
  }); 
  $('.select2').select2();
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
  
  //Filter
    
  //Filter
  
  
  //Data Baru
  $(document).on('click','#tambahdata',function(){
    document.getElementById("tambah").reset();
    document.getElementById("preview").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
  });
  $('#image').change(function() {
       var size = this.files[0].size;
       var preview = document.querySelector('#preview');
       if(size > 5000000) {
           Toast.fire({
                icon: 'error',
                title: "Ukuran file Foto terlalu besar. Maksimum 500KB"
            })
           $('#image').val('');
           document.getElementById("preview").src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
       } else {
          var preview = document.querySelector('#preview');
          var file    = document.querySelector('#image').files[0];
          var reader  = new FileReader();
        
          reader.onloadend = function () {
            preview.src = reader.result;
          }
        
          if (file) {
            reader.readAsDataURL(file);
          } else {
            preview.src = "https://img.freepik.com/free-icon/user_318-804790.jpg";
          }
       }
    });
  $('#tambah').submit(function(event)   {
    event.preventDefault();
    var el = $('#btn-upload');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    if(document.getElementById('preview').src == "https://img.freepik.com/free-icon/user_318-804790.jpg"){
        Toast.fire({
            icon : 'error',
            title : 'Image Tidak Boleh Kosong !!',
        });
        return false;
    }
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var data = new FormData(form[0]);

    $.ajax({
        url: '{!! url("data-library-image") !!}',
        type: method,
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            // console.log(response);
            if(response.success == true){
                Toast.fire({
                    icon: 'success',
                    title: response.pesan
                })
                $('#modal-tambah').modal('hide');
                var table = $('#tabel-image').DataTable(); 
                table.ajax.reload( null, false );
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.pesan
                })    
            }
            
            // Proses response setelah submit form berhasil
        },
        error: function(response) {
            // console.log(response);
            Toast.fire({
                icon: 'error',
                title: response
            })
            // Proses response setelah submit form gagal
        }
    });
  });

  //Data Baru
//   
//   $('#hapus').submit(function(e){
//     e.preventDefault(); // prevent actual form submit
//     var el = $('#btn-hapus');
//     el.prop('readonly', true);
//     setTimeout(function(){el.prop('readonly', false); }, 3000);
//     var token = "{!! csrf_token() !!}";
//     var kode = $('#hps_kode_brg').val();
//     // console.log(kode);
//     $.ajax({
//       type    : 'delete',
//       url     : '{!! url("data-/'+kode+'") !!}',
//       data    : {
//         _token  : token,
//         user  : "{{$user->kode_karyawan}}",
//       },
//       success:function(response) {
//         // console.log(response);
//         if(response.success == true){
//           var hasil = response.pesan;
//           Toast.fire({
//             icon: 'success',
//             title: hasil
//           })
//           $('#modal-hapus').modal('hide');
//           var table = $('#tabel-').DataTable(); 
//           table.ajax.reload( null, false );
//         }else {
//           Toast.fire({
//             icon: 'success',
//             title: response.pesan
//           })
//         }
        
//       }
//     });
//   });
  
  //EDIT
  $('body').on('click','.edit',function () {
      var kode = $(this).data('kode');
      document.getElementById("edit").reset();
      $.ajax({
        url :'{!! url("data-library-image/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          // console.log(response);
          if(response.success == true){
            $('#edit-id').val(kode);
            $('#edit-nama').val(response.data.nama);
            document.getElementById("edit-preview").src = "{{asset('img')}}/"+response.data.url;
            
          } else {
              Toast.fire({
                  icon  : "error",
                  title : response.pesan
              })
          }
          
        }
      });
  });
  
  //EDIT SUBMIT
  $('#edit').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var form = $(this);
    var method = form.attr('method');
    var data = new FormData(form[0]);
    var kode = $('#edit-id').val();
    // console.log(kode);
    $.ajax({
      method: method,
      url: '{!! url("data-library-image/'+kode+'") !!}',
      data: data,
      processData: false,
      contentType: false, // serializes form input
      success:function(response) {
        // console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-image').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: hasil
          })
        }
        
      }
    });
  });
  // EDIT SUBMIT
  // HAPUS
    $('body').on('click', '.hapus', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-library-image/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            // console.log(response);
          if(response.success == true){
            $('#hps-id').val(kode);
            $('#hps-nama').html(response.data.nama);
          } else {
              Toast.fire({
                  icon  : "error",
                  title : response.pesan
              })
          }
        }
      });
    });
    
    //SUBMIT HAPUS
    $('#hapus').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-hapus');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        var kode = $('#hps-id').val();
        $.ajax({
          type: 'delete',
          url: '{!! url("data-library-image/'+kode+'") !!}',
          data : {
            _token  : token,
          }, // serializes form input
          success:function(response) {
            // console.log(response);
            if(response.success == true){
              var hasil = response.pesan;
              Toast.fire({
                icon: 'success',
                title: hasil
              })
              $('#modal-hapus').modal('hide');
              var table = $('#tabel-image').DataTable(); 
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
  // HAPUS
  
  function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
  }
  
//   function resettable(){
//       var table = $('#tabel-pengiriman');
//       table.DataTable().clear().destroy();
//       table.DataTable({
//           'paging'      : true,
//           'lengthChange': true,
//           'searching'   : true,
//           'ordering'    : true,
//           'info'        : true,
//           'autoWidth'   : false,
//           "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
//             processing: true,
//             serverSide: true,
//             ajax: {
//                 url: '{!! url("filter-data-pengiriman") !!}',
//                 type: 'post',
//                 data: {
//                     _token : "{{ csrf_token() }}",
//                     asal   : $('#filter-asal').val(),
//                     tujuan : $('#filter-tujuan').val(),
//                 },
//                 success : function (a){
//                     // console.log(a);
//                 }
//             },
//             columns: [         
//                 { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
//                 { data: 'action', name: 'action',orderable:false, searchable:false},
//                 { data: 'nama', name: 'nama',orderable:true, searchable:true},
//                 { data: 'asal', name: 'asal',orderable:true, searchable:true},
//                 { data: 'tujuan', name: 'tujuan',orderable:true, searchable:true},
//                 { data: 'kg', name: 'kg',orderable:false, searchable:false},
//                 { data: 'l', name: 'l',orderable:false, searchable:false},
//                 { data: 'ton', name: 'ton',orderable:false, searchable:false},
//                 { data: 'pickup', name: 'pickup',orderable:false, searchable:false},
//                 { data: 'cdd', name: 'cdd',orderable:false, searchable:false},
//                 { data: 'fuso', name: 'fuso',orderable:false, searchable:false},
//                 { data: 'tronton', name: 'tronton',orderable:false, searchable:false},
//             ]
//         });
//   }
  
  
</script>
</body>
</html>
