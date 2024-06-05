<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Data Target Penjualan Marketing</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
            <h1 class="m-0">Data Target Penjualan Marketing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Target Penjualan Marketing</li>
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
                    @if($user->level == 'superadmin'||$user->level == 'admin-marketing')
                        <div class="row">
                            <button type="button" id="btn-omset" data-toggle="modal" data-backdrop="static" data-target="#modal-target" class="btn bg-gradient-primary">Data Omset Marketing</button>
                        </div>
                        <br>
                    @else 
                    @endif
                    
                    <form id="filter">
                        <div class="row">
                            <h5>Filter Data</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Bulan</label>
                                <input type="month" class="form-control" id="bulan" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Marketing</label>
                                <select class="form-control select2" id="marketing"></select>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <button type="submit" id="btn-submit" class="form-control btn btn-primary">Filter</button>
                            </div>
                        </div>    
                    </form>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div class="row" id="data-marketing">
                        <div class="col-lg-2">
                            <label>Marketing</label>
                            <br>
                            <label>Target Omset</label>
                            <br>
                            <label>Plan Penjualan</label>
                            <br>
                            <label>Omset </label>
                        </div>
                        <div class="col-lg-1">
                            <label>:</label>
                            <br>
                            <label>:</label>
                            <br>
                            <label>:</label>
                            <br>
                            <label>:</label>
                        </div>
                        <div class="col-lg-4">
                            <label id="nama-marketing"></label>
                            <br>
                            <label id="target-marketing2"></label>
                            <br>
                            <label id="plan-penjualan"></label>
                            <br>
                            <label id="omset-marketing2"></label>
                        </div>
                    </div>
                  <br>
                  <table id="tabel-aksi" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Marketing</th>
                      <th>Perusahaan</th>
                      <th>Barang</th>
                      <th>Harga</th>
                      <th>QTY</th>
                      <th>Total</th>
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
  <!-- MODAL -->
  <div class="modal fade" id="modal-target">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Target Database Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-between">
                    <button type="button" class="btn btn-primary" id="btn-tambah-target">Tambah Target KPI Marketing</button>
                    <button type="button" class="btn btn-success" id="btn-update-target">Update Data Omset & Purchasing Bulan ini</button>
                </div>
                <div id="tambah-omset">
                    <form id="form-tambah-omset">
                        <div class="row">
                          <label>Tambah Data Omset</label>
                        </div>
                        <div class="row">
                          <div class="col-lg-3">
                              <label>Bulan</label>
                              <input type="month" class="form-control" id="tambah-bulan" required>
                          </div>
                          <div class="col-lg-3">
                              <label>Marketing</label>
                              <select class="form-control select2" id="tambah-marketing" required ></select>
                          </div>
                          <div class="col-lg-3">
                              <label>Target Omset Marketing</label>
                              <input type="number" min="0" class="form-control" id="tambah-omset-marketing" required>
                          </div>
                          <div class="col-lg-3">
                              <label>Target Purchasing Baru</label>
                              <input type="number" min="0" class="form-control" id="tambah-purchasing" required>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-2">
                                <button type="button" class=" btn btn-default form-control" id="cancel-tambah-target">cancel</button>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class=" btn btn-primary form-control" id="tambah-target">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="edit-omset">
                      <form id="form-edit-omset">
                          <div class="row">
                              <div class="col-lg-3">
                                  <label>Bulan</label>
                                  <input type="hidden" class="form-control" id="edit-id">
                                  <input type="month" class="form-control" id="edit-bulan" required readonly>
                              </div>
                              <div class="col-lg-3">
                                  <label>Marketing</label>
                                  <input type="text" class="form-control" id="edit-marketing" readonly>
                              </div>
                              <div class="col-lg-3">
                                  <label>Target Omset Marketing</label>
                                  <input type="number" min="0" class="form-control" id="edit-target-omset" required>
                                  <label>Omset Marketing</label>
                                  <input type="number" min="0" class="form-control" id="edit-omset-marketing" >
                              </div>
                              <div class="col-lg-3">
                                  <label>Target Purchasing Baru</label>
                                  <input type="number" min="0" class="form-control" id="edit-purchasing" required>
                                  <label>Data Purchasing Baru</label>
                                  <input type="number" min="0" class="form-control" id="edit-purchasing-marketing" >
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-8"></div>
                              <div class="col-lg-2">
                                  <button type="button" class=" btn btn-default form-control" id="cancel-edit-target">cancel</button>
                              </div>
                              <div class="col-lg-2">
                                  <button type="submit" class=" btn btn-warning form-control" id="edit-target">Edit</button>
                              </div>
                          </div>
                      </form>
                  </div>
                <div id="hapus-omset">
                      <form id="form-hapus-omset">
                          <div class="row">
                            <label>Apakah Anda Yakin akan Menghapus Data ini ?</label>
                            <br>
                            
                            <input type="hidden" class="form-control" id="hapus-id">
                          </div>
                          <div class="row">
                             <p id="hapus-data"></p>
                          </div>
                          <div class="row">
                              <div class="col-lg-8">
                                  
                              </div>
                              <div class="col-lg-2">
                                  <button type="button" class=" btn btn-default form-control " id="cancel-hapus-target">cancel</button>
                              </div>
                              <div class="col-lg-2 justify-content-between">
                                  <button type="submit" class=" btn btn-danger form-control" id="hapus-target">Hapus</button>
                              </div>
                          </div>
                      </form>
                  </div>
                <hr>
                <div class="row table-responsive">
                    <table id="tabel-target" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th >No.</th>
                              <th >KPI</th>
                              <th >Action</th>
                              <th >Tanggal</th>
                              <th >Marketing</th>
                              <th >Target</th>
                              <th>Plan Penjualan</th>
                              <th >Omset</th>
                              <th >Target Purchasing</th>
                              <th >Purchasing Baru</th>
                            </tr>
                        </thead>
                     </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div> 
  <!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

</div>
<!-- ./wrapper -->

!-- jQuery -->

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
<!-- AdminLTE for demo purposes -->
<script>
    
  $(document).ready(function() {   
      $('#tabel-filter').hide();
      $('#data-marketing').hide();
    $('#tabel-aksi').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-target-marketing") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'marketing', name: 'marketing',orderable:true},
            { data: 'perusahaan', name: 'perusahaan',orderable:true},
            { data: 'barang', name: 'barang',orderable:true},           
            { data: 'harga', name: 'harga',orderable:true, searchable:false},
            { data: 'qty', name: 'qty',orderable:true, searchable:false},
            { data: 'total', name: 'total',orderable:true, searchable:false},
            
        ]
    });
    $.ajax({
      url :'{!! url("dropdown-marketing") !!}',
      type : 'get',
      success : function(data){
        var datahandler = $('#marketing');
        var Nrow = $("<option value=''>Pilih Marketing</option>");
        datahandler.append(Nrow);
        $.each(data, function(key,val){
          var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
          datahandler.append(Nrow);
        });
        
      }
    });
  });  
  
  //TARGET OMSET
    $('#btn-omset').on('click',function(){
        
        $('#tambah-omset').hide();$('#edit-omset').hide();$('#hapus-omset').hide();$('#btn-tambah-target').show();$('#btn-update-target').show();
        
        
        $('#tabel-target').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true,
        //   dom: 'Blrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
            processing: true,
            serverSide: true,
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              if (aData['KPI'] == "A") {
                $('td', nRow).css('background-color', '#00FF64');
              }else if(aData['KPI'] == "C"){
                $('td', nRow).css('background-color', '#FE3D3D');
              } else {
                $('td', nRow).css('background-color', '');
              }
            },
            ajax: '{!! url("data-target-omset") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:true, searchable:false},
                { data: 'KPI', name: 'KPI',orderable:false},
                { data: 'action', name: 'action',orderable:false},
                { data: 'bulan', name: 'bulan',orderable:true},
                { data: 'marketing', name: 'marketing',orderable:true},
                { data: 'target', name: 'target',orderable:false},
                { data: 'plan_penjualan', name: 'plan_penjualan',orderable:false}, 
                { data: 'omset', name: 'omset',orderable:true, searchable:false},
                { data: 'purchasing', name: 'purchasing',orderable:false, searchable:false},
                { data: 'purchasing_baru', name: 'purchasing_baru',orderable:false, searchable:false},
                
            ]
        });
    });
    //TAMBAH OMSET
    $('#btn-tambah-target').on('click',function(){
        document.getElementById("form-tambah-omset").reset();
        $('#tambah-omset').show();$('#edit-omset').hide();$('#hapus-omset').hide();$('#btn-tambah-target').hide();$('#btn-update-target').hide();
        //Filter Marketing
        $('#tambah-marketing').empty();
        $.ajax({
          url :'{!! url("dropdown-marketing") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#tambah-marketing');
            var Nrow = $("<option value=''>Pilih Marketing</option>");
            datahandler.append(Nrow);
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
    });
    $('#cancel-tambah-target').on('click',function(){
         $('#tambah-omset').hide();$('#edit-omset').hide();$('#hapus-omset').hide();$('#btn-tambah-target').show();$('#btn-update-target').show();
    });
    $('#form-tambah-omset').submit(function(e){
        e.preventDefault();
        var el = $('#tambah-target');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        $.ajax({
            type    : 'post',
            url     : '{!! url("data-target-omset")!!}',
            data    : {
                _token : token,
                bulan    : $('#tambah-bulan').val(),
                marketing   : $('#tambah-marketing').val(),
                omset   : $('#tambah-omset-marketing').val(),
                purchasing   : $('#tambah-purchasing').val(),
                user        : "{{$user->kode_karyawan}}",
            },
            success:function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                       icon     : "success",
                       title    : response.pesan,
                    });
                    $('#tambah-omset').hide();
                    $('#btn-tambah-target').show();
                    $('#btn-update-target').show();
                    var table = $('#tabel-target').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                       icon     : "error",
                       title    : response.pesan,
                    });
                }
            }
        });
    });
    // END OF TAMBAH OMSET
    // START OF UPDATE OMSET
    $('#btn-update-target').click(function(e){
        e.preventDefault();
        var el = $(this);
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        $.ajax({
            type    : 'get',
            url     : '{!! url("update-data-target-omset")!!}',
            data    : {
                _token      : token,
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                       icon     : "success",
                       title    : response.pesan,
                    });
                    var table = $('#tabel-target').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                       icon     : "error",
                       title    : response.pesan,
                    });
                }
            }
        });
    });
    // END OF UPDATE OMSET
    // START OF EDIT OMSET
    $(document).on('click','.edit',function(){
        var kode = $(this).data('kode');
        document.getElementById("form-edit-omset").reset();
        $('#tambah-omset').hide(); $('#edit-omset').show(); $('#hapus-omset').hide(); $('#btn-tambah-target').hide(); $('#btn-update-target').hide();
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-target-omset/'+kode+'/edit")!!}',
            success:function(response){
                // console.log(response);
                if(response.success == true){
                    $('#edit-id').val(response.data.id);
                    var bulan = response.data.bulan;
                    var tanggal = bulan.slice(0, -3);
                    $('#edit-bulan').val(tanggal);
                    $('#edit-marketing').val(response.data.marketing);
                    $('#edit-target-omset').val(response.data.target);
                    $('#edit-omset-marketing').val(response.data.omset);
                    $('#edit-purchasing').val(response.data.purchasing);
                    $('#edit-purchasing-marketing').val(response.data.purchasing_baru);
                } else {
                    Toast.fire({
                       icon     : "error",
                       title    : response.pesan,
                    });
                }
            }
        });
    });
    $('#cancel-edit-target').on('click',function(){
         $('#tambah-omset').hide();
         $('#edit-omset').hide();
         $('#hapus-omset').hide();
         $('#btn-tambah-target').show();
         $('#btn-update-target').show();
    });
    $('#form-edit-omset').submit(function(e){
        e.preventDefault();
        var el = $('#edit-target');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 3000);
        var token = "{!! csrf_token() !!}";
        var kode = $('#edit-id').val();
        
        $.ajax({
            url     : '{!! url("data-target-omset/'+kode+'")!!}',
            type    : 'put',
            data    : {
                _token  : token, 
                target  : $('#edit-target-omset').val(),
                omset   : $('#edit-omset-marketing').val(),
                purchasing  : $('#edit-purchasing').val(),
                baru    : $('#edit-purchasing-marketing').val(),
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon : "success",
                        title : response.pesan,
                    });
                    $('#edit-omset').hide();
                    $('#btn-tambah-target').show();
                    $('#btn-update-target').show();
                    var table = $('#tabel-target').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon : "error",
                        title : response.pesan,
                    });
                }
            }
        });
    });
    // END OF EDIT OMSET
    // START OF DELETE OMSET
    
    $(document).on('click','.hapus',function(){
        var kode = $(this).data('kode');
        document.getElementById("form-hapus-omset").reset();
        $('#tambah-omset').hide(); $('#edit-omset').hide(); $('#hapus-omset').show(); $('#btn-tambah-target').hide(); $('#btn-update-target').hide();
        var marketing = $(this).data('nama');
        var bulan = $(this).data('bulan');
        $('#hapus-data').val('');
        $('#hapus-data').html("Marketing    : "+marketing+"<br> Bulan   : "+bulan);
        $('#hapus-id').val(kode);
    });
    $('#cancel-hapus-target').on('click',function(){
         $('#tambah-omset').hide();
         $('#edit-omset').hide();
         $('#hapus-omset').hide();
         $('#btn-tambah-target').show();
         $('#btn-update-target').show();
    });
    $('#form-hapus-omset').submit(function(e){
        e.preventDefault();
        var el = $('#hapus-target');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 3000);
        var kode = $('#hapus-id').val();
        var token = "{!! csrf_token() !!}";
        $.ajax({
            type    : 'delete',
            url     : '{!! url("data-target-omset/'+kode+'")!!}',
            data    : {
                _token  : token,
            },
            success:function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                       icon     : "success",
                       title    : response.pesan,
                    });
                    $('#hapus-omset').hide();
                    $('#btn-tambah-target').show();
                    $('#btn-update-target').show();
                    var table = $('#tabel-target').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                       icon     : "error",
                       title    : response.pesan,
                    });
                }
            }
        });
    });
    // END OF DELETE OMSET
    
    
  // END OF TARGET OMSET
  
  $('#filter').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-submit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var marketing = $('#marketing').val(); 
    $.ajax({
      type : 'get',
      url  : '{!! url("filter-data-target-marketing")!!}',
      data : {
        _token : token,
        bulan    : $('#bulan').val(),
        marketing   : marketing,
      },
      success : function(response){
          // console.log(response);
          if(response.success == true){
            $('#nama-marketing').html(response.marketing);
            $('#target-marketing2').html(formatRupiah(response.target));
            $('#plan-penjualan').html(formatRupiah(response.plan));
            $('#omset-marketing2').html(formatRupiah(response.omset));
            $('#data-marketing').show();
            $('#tabel-aksi').DataTable().clear().destroy();
            $('#tabel-aksi').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              data : response.data.original.data,
              columns : [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'marketing', name: 'marketing',orderable:true},
                { data: 'perusahaan', name: 'perusahaan',orderable:true},
                { data: 'barang', name: 'barang',orderable:true},           
                { data: 'harga', name: 'harga',orderable:true, searchable:false},
                { data: 'qty', name: 'qty',orderable:true, searchable:false},
                { data: 'total', name: 'total',orderable:true, searchable:false},
              ],
            });      
          } else {
              $('#tabel-aksi').DataTable().clear().destroy();
              $('#data-marketing').hide();
              Toast.fire({
                  icon  : 'error',
                  title : response.pesan,
              })
          }
        
      }
    });
    
  });
  
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });
  

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
