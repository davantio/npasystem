<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Kas Keluar</title>
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
            <h1>Kas Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Kas Keluar</li>
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
                <div class="row justify-content-between">
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Kas Keluar</button>
                    <a id="jurnal" href="jurnal-kas" rel="noopener" target="_blank" class="col-sm-2 form-control btn btn-danger"><i class="fas fa-file"></i> Jurnal</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-kas" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>D</th>
                    <th>K</th>
                    <th>Total</th>
                    <th>Keterangan</th>
                    <th>Status</th>
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
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Tambah Kas Keluar</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <b><span aria-hidden="true">&times;</span></b>
                      </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="tmb-tgl" class="form-control" type="date" required>
                                    <label> Keperluan</label>
                                    <select id="tmb-debit" class="form-control select2"></select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Kode Transaksi</label>
                                    <input id="tmb-kode" class="form-control" type="text" value=""readonly required>
                                    <label >Kode Material Receive</label>
                                    <select id="tmb-po" class="form-control select2"></select>
                                </div>
                                <div class="col-lg-4">
                                    <label> Kas</label>
                                    <select id="tmb-kredit" class="form-control select2" required></select>
                                    <label> Keterangan</label>
                                    <textarea  id="tmb-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Kas Masuk" ></textarea>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <label> VAT</label>
                                    <input id="tmb-vat" type="number" min="0" max="20" class="form-control" required>
                                </div>
                                <div class="col-lg-4 custom control custom-switch">
                                    <br>
                                    <input type="checkbox" class="custom-control-input form-control" id="kunci">
                                    <label class="custom-control-label" for="kunci" >Kunci </label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <div class="row">
                                        <button id="btn-add-barang" class="btn btn-primary">Tambah Barang</button>
                                        </div>
                                        <div class="row" id="tambah-barang">
                                            <form id="form-tambah-barang">
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <label>Nama Barang</label>
                                                    <select id="tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                                    <label>Invoice Pembelian</label>
                                                    <input id="tambah-invoice-barang" class="form-control" type="text" >
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>Harga</label>
                                                    <input id="tambah-harga-barang" class="form-control" type="number" min="1" required >
                                                    <label>Satuan</label>
                                                    <input id="tambah-satuan-barang" class="form-control" type="text" readonly>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>QTY</label>
                                                    <input id="tambah-qty-barang" class="form-control" type="number" min="1" required > 
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Keterangan</label>
                                                    <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <br>
                                                    <div class="row justify-content-between">
                                                    <button type="submit" id="btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row" id="edit-barang">
                                            <form id="form-edit-barang">
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <label>Nama Barang</label>
                                                    <input id="edit-kode-barang" class="form-control" type="text" hidden>
                                                    <select id="edit-nama-barang" class="form-control select2"></select>
                                                    <label>Invoice Pembelian</label>
                                                    <input id="edit-invoice-barang" class="form-control" type="text">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>Harga</label>
                                                    <input id="edit-harga-barang" class="form-control" type="number" min="1" required >
                                                    <label> Satuan</label>
                                                    <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>QTY</label>
                                                    <input id="edit-qty-barang" class="form-control" type="number" min="1" required >  
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <label>Keterangan</label>
                                                    <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                </div>
                                                <div class="col-lg-4">
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <br>
                                                    <div class="row justify-content-between">
                                                    <button type="button" id="btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                    <button type="submit" id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row" id="hapus-barang">
                                            <form id="form-hapus-barang">
                                                <input id="hapus-kode-barang" class="form-control" type="text" hidden>
                                                <div class="row justify-content-center ">
                                                <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                                </div>
                                                <div class="row justify-content-center" > 
                                                    <label class="col-lg-3">Nama Barang </label>
                                                    <label id ="hapus-nama-barang" class="col-lg-9"></label>
                                                </div>
                                                <br>
                                                <div class="row justify-content-between ">
                                                <button type="button"  id="btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                                <button type="submit"  id="btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table  class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Action</th>
                                            <th rowspan="2">No.</th>
                                            <th rowspan="2">Kode Transaksi</th>
                                            <th rowspan="2">Kode Barang</th>
                                            <th rowspan="2">Nama Barang</th>
                                            <th rowspan="2">Satuan</th>
                                            <th rowspan="2">Harga</th>
                                            <th rowspan="2">QTY</th>
                                            <th rowspan="2">VAT</th>
                                            <th rowspan="2">Total</th>
                                            <th rowspan="2">Keterangan</th>
                                            <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                            <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                        </tr>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Perkiraan</th>
                                            <th>Kode</th>
                                            <th>Nama Perkiraan</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbl_kas_tambah">
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                <form id="tmbkas">
                  <div class="modal-footer justify-content-between ">
                    <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  <!--/ Modal Tambah  -->
  <!-- Modal Detail  -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Kas Keluar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Kode Transaksi</label>
                            <input type="text" id="dtl-kode" class="form-control" readonly required>
                        </div>
                        <div class="col-lg-6">
                            <label> Kas/Bank</label>
                            <input type="text" class="form-control" id="dtl-kredit" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Tanggal</label>
                            <input type="date" id="dtl-tanggal" class="form-control" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label> Keperluan</label>
                            <input type="text" id="dtl-debit" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Harga (Rp.)</label>
                            <input type="text" id="dtl-harga" class="form-control" readonly>
                            <label>Jumlah</label>
                            <input type="text" id="dtl-jumlah" class="form-control" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label>Keterangan</label>
                            <textarea id="dtl-keterangan" class="form-control" rows="4" style="resize: none" readonly></textarea>
                        </div>
                    </div>
                </div>
              </div>
              <form id="detail">
                <input type="hidden" id="dtl-status" class="form-control">
              <div class="modal-footer justify-content-between ">
                    <button type="button" class="col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-detail" class=" col-sm-4 form-control btn btn-success ">Konfirmasi</button>
                
              </div>
            </form>
            </div>
        </div>
    </div>
  <!-- /Modal Detail  -->
  <!-- MODAL Edit  -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form id="edit">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Kas Keluar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Kode Transaksi</label>
                                    <input type="text" id="edt-kode" class="form-control" readonly required>
                                </div>
                                <div class="col-lg-6">
                                    <label> Kas / Bank</label>
                                    <input type="text" class="form-control" id="edt-kredit" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Tanggal</label>
                                    <input type="date" id="edt-tanggal" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">
                                    <label> Keperluan</label>
                                    <input type="text" class="form-control" id="edt-debit" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Harga (Rp.)</label>
                                    <input type="number" min="0" id="edt-harga" class="form-control" required>
                                    <label>Jumlah</label>
                                    <input type="number" min="0" id="edt-jumlah" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Keterangan</label>
                                    <textarea id="edt-keterangan" class="form-control" rows="4" style="resize: none" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                          
                        </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class=" col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-edit" class=" col-sm-4 form-control btn btn-warning">Edit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  <!--/ Modal Edit  -->
  <!-- MODAL Hapus  -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Kas Keluar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          Apakah Anda Yakin Akan Menghapus Data ini ?
                          <div class="row">
                              <input id="hps-kode" class="form-control" type="text" required hidden>
                              <label class=" col-md-3">KODE </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8" id="hps_kode" > 	</label>
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
  $(document).ready(function() {   
    $('#tabel-kas').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("DATA-kas/K") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama_debit', name: 'nama_debit',orderable:true},
            { data: 'nama_kredit', name: 'nama_kredit',orderable:true},
            { data: 'total', name: 'total',orderable:true},
            { data: 'keterangan', name: 'keterangan',orderable:false},
            { data: 'status', name: 'status',orderable:false},
            
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

  var token = "{!! csrf_token() !!}";
  //TAMBAH DATA
    $(document).on('click','#tambahdata',function(){
        $('#tmb-tgl').prop('disabled',false);$('#tmb-kredit').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);$('#tmb-po').prop('disabled',false);
        $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
        $('#tmb-debit').select2({
          placeholder : 'Pilih Keperluan',
          ajax  :{
            url : '{!! url("dropdown-akuntansi") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama_perkiraan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        $('#tmb-kredit').select2({
          placeholder : 'Pilih Sumber Dana',
          ajax  :{
            url : '{!! url("dropdown-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama_perkiraan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
    });
    $('#tmb-debit').on('change',function(){
        var data = $(this).val();
        if(data == 30) {
           $('#tmb-po').prop('disabled',false);$('#tmb-vat').prop('disabled',true);
           $('#tmb-po').select2({
            placeholder : 'Pilih PO',
            ajax  :{
                url : '{!! url("dropdown-po-mr") !!}',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.kode,
                                id: item.kode
                            }
                        })
                    };
                },
                cache: true
            }
           });
        } else {
            $('#tmb-po').val(null).trigger('change');
            $('#tmb-po').prop('disabled',true); $('#tmb-vat').prop('disabled',false);
            
        }
    });
    $('#tmb-tgl').on('change',function(){
        var tgl = $(this).val();
        var th = tgl.substr(2,2);
        var bln = tgl.substr(5,2);
        var dy = tgl.substr(8,2);
        var n = th+bln+dy;
        $.ajax({
            url     :'{!! url("lastkode-kas") !!}',
            type    : 'get',
            data    : {
                tanggal : n,
            },
            success : function(data){
                $('#tmb-kode').val(data);
            }
        });
    });
    $('#tmb-po').on('change',function(){
        var po  = $(this).val();
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-po/'+po+'/edit")!!}',
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    $('#tmb-vat').val(response.data.po.vat);
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
        });
    });
    $('#kunci').on('change',function(){
        var kode =  $('#tmb-kode').val();
        var tanggal = $('#tmb-tgl').val();
        var kas = $('#tmb-debit').val();
        var kredit = $('#tmb-kredit').val();
        var vat = $('#tmb-vat').val();
        var checkBox = document.getElementById("kunci");
        if( kode == null){
            Toast.fire({icon: 'error',title: 'Semua Field Wajib Diisi !!'}) 
            return false;
        } else if( tanggal == null){
            Toast.fire({icon: 'error',title: 'Tanggal Wajib Diisi !!'}) 
            return false;
        } else if (kas == null){
            Toast.fire({icon: 'error',title: 'Kas Wajib Diisi !!'}) 
            return false;
        } else if (kredit == null){
            Toast.fire({icon: 'error',title: 'Sumber Pemasukkan Wajib Diisi !!'}) 
            return false;
        } else if(vat == null) {
            Toast.fire({icon: 'error',title: 'VAT Wajib Diisi !!'}) 
            return false;
        } else {

        }
        if(checkBox.checked == true){
            $('#btn-add-barang').show();
            $('#tmb-tgl').prop('disabled',true);$('#tmb-kredit').prop('disabled',true);$('#tmb-keterangan').prop('disabled',true);$('#tmb-debit').prop('disabled',true);$('#tmb-inv').prop('disabled',true);$('#tmb-vat').prop('disabled',true);
        } else {
            $('#tmb-tgl').prop('disabled',false);$('#tmb-kredit').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);$('#tmb-inv').prop('disabled',false);$('#tmb-vat').prop('disabled',false);
            $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
           $.ajax({
            type    : 'delete',
            url     : '{!! url ("hapus-kas/'+kode+'")!!}',
            data    : {_token : token},
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan,
                    });
                    $('#tbl_kas_tambah').empty();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
           });
        }
    });
    //Tambah Barang
        $('#btn-add-barang').on('click',function(){
            document.getElementById("form-tambah-barang").reset();
            $('#tambah-namareq-barang').prop('disabled',false);$('#tambah-harga-barang').prop('disabled',false);$('#tambah-keterangan-barang').prop('disabled',false);$('#tambah-qty-barang').prop('disabled',false);
            var po = $('#tmb-inv').val();
            $('#tambah-nama-barang').val(null).trigger('change');
            $('#tambah-barang').show();$('#btn-add-barang').hide();
            var kebutuhan = $('#tmb-debit').val();
            if(kebutuhan == 30 ){
                $('#tambah-invoice-barang').prop('disabled',true);$('#tambah-harga-barang').prop('disabled',true);$('#tambah-keterangan-barang').prop('disabled',true);$('#tambah-qty-barang').prop('disabled',true);
                $('#tambah-nama-barang').select2({
                    placeholder:"Pilih Barang",
                    ajax: {
                        url: '{!! url("dropdown-barangpo/'+po+'") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode_brg+" - "+item.nama,
                                        id: item.kode_brg
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            } else {
                $('#tambah-invoice-barang').prop('disabled',false);$('#tambah-harga-barang').prop('disabled',false);$('#tambah-keterangan-barang').prop('disabled',false);$('#tambah-qty-barang').prop('disabled',false);
                $('#tambah-nama-barang').select2({
                    placeholder:"Pilih Barang",
                    ajax: {
                        url: '{!! url("dropdown-barang") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode+" - "+item.nama,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            }
            
        });
        $('#tambah-nama-barang').on('change',function(){
            var barang = $(this).val();
            
            var keperluan = $('#tmb-debit').val();
            if (keperluan == 30 ){
                var po = $('#tmb-po').val();
                $.ajax({
                url     : '{!! url("databarang-detailpo/'+po+'")!!}',
                type    : 'get',
                data    : {
                    barang  : barang,
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                    $('#tambah-invoice-barang').val(po);
                    $('#tambah-harga-barang').val(response.data.harga);
                    $('#tambah-satuan-barang').val(response.data.satuan);
                    $('#tambah-qty-barang').val(response.data.qty);
                    $('#tambah-keterangan-barang').val(response.data.keterangan);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : request.pesan
                        });
                    }
                }
                });
            } else {
                if(barang == 'all'){
                    Toast.fire({
                        icon    : 'error',
                        title   : 'Pilih Salah Satu Barang',
                    });
                    return false;
                } else {

                }
                $.ajax({
                    type    : 'get',
                    url     : '{!! url("data-barang/'+barang+'/edit") !!}',
                    success : function(response){
                        if(response.success == true){
                            $('#tambah-satuan-barang').val(response.result.satuan);
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan
                            });
                        }
                    }
                });
            }
        });
        $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kas = $('#tmb-kode').val();
            var debit = $('#tmb-kredit').val();
            if (debit == 40){
                $.ajax({
                    type : 'post',
                    url  : '{!! url("data-detailkas") !!}',
                    data : {
                        _token      :token,
                        kode_kas    : kas,
                        transaksi   : $('#tambah-invoice-barang').val(),
                        barang      : $('#tambah-nama-barang').val(),
                        vat         : $('#tmb-vat').val(),
                        harga       : $('#tambah-harga-barang').val(),
                        qty         : $('#tambah-qty-barang').val(),
                        keterangan  : $('#tambah-keterangan-barang').val(),
                        debit       : $('#tmb-debit').val(),
                        kredit      : $('#tmb-kredit').val(),
                    },
                    success : function(response){
                        // console.log(response);
                        if(response.success == true){
                            Toast.fire({
                                icon    : 'success',
                                title   : response.pesan,
                            });
                            $('#tambah-barang').hide();
                            $('#btn-add-barang').show();
                            tabeltambah(kas);
                        } else {
                            Toast.fire({
                                icon    : 'error',
                                title   : response.pesan,
                            });
                        }
                    }
                });
            } else {

            }
            
            
        });
    //Tambah Barang
    //Edit Barang
        $(document).on('click','.editbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#hapus-barang').hide();
            $('#edit-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#edit-kode-barang').val(response.data.kode);
                        $('#edit-harga-barang').val(response.data.harga);
                        $('#edit-satuan-barang').val(response.data.satuan);
                        $('#edit-qty-barang').val(response.data.qty);
                        $('#edit-invoice-barang').val(response.data.kode_transaksi);
                        $('#edit-keterangan-barang').val(response.data.keterangan);
                        
                        if(response.data.kredit == 40){
                            var inv = $('#tmb-inv').val()
                            $('#edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-baranginv/'+inv+'") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode_brg+" - "+item.nama,
                                                    id: item.kode_brg
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        } else {
                            $('#edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-barang") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode+" - "+item.nama_perkiraan,
                                                    id: item.kode
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        }
                        $('#edit-nama-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kode_brg) //set value for option to post it
                                .text(response.data.kode_brg+" "+response.data.nama )) //set a text for show in select
                            .val(response.data.kode_brg) //select option of select2
                            .trigger("change"); //apply to select2
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
            
        });
        $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            document.getElementById("form-edit-barang").reset();
            $('#btn-add-barang').show();
        });
        $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edit-kode-barang').val();
            var kas  = $('#tmb-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detailkas/'+kode+'")!!}',
                data    : {
                    _token  : token,
                    barang  : $('#edit-nama-barang').val(),
                    transaksi : $('#edit-invoice-barang').val(),
                    harga   : $('#edit-harga-barang').val(),
                    qty     : $('#edit-qty-barang').val(),
                    keterangan : $('#edit-keterangan-barang').val(),
                },
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("form-edit-barang").reset();
                        $('#edit-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Barang
    //Hapus Barang
        $('body').on('click','.hapusbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#edit-barang').hide();
            $('#hapus-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    // console.log(response);
                    if(response.success == true) {
                        $('#hapus-kode-barang').val(kode);
                        $('#hapus-nama-barang').html(response.data.nama);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
        $('#btn-cancel-hapus').on('click',function(){
            $('#hapus-barang').hide();
            $('#btn-add-barang').show();
        });
        $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#hapus-kode-barang').val();
            var kas = $('#tmb-kode').val();
            $.ajax({
                type : 'delete',
                url     : '{!! url("data-detailkas/'+kode+'") !!}',
                data    : {_token : token,},
                success : function(response){
                    // console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#hapus-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
    //Hapus Barang

    $('#tmbkas').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-tambah');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var vat = $('#tmb-vat').val();
        var tanggal = $('#tmb-tgl').val();
        var kas =  $('#tmb-debit').val();
        var kredit = $('#tmb-kredit').val();
        var ket     = $('#tmb-keterangan').val();
        var kode = $('#tmb-kode').val();
        //Validasi
            if(tanggal == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Tanggal Wajib Diisi',
                });
                return false ;
            } else {}
            if(kode == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kode Wajib Diisi',
                });
                return false ;
            } else {}
            if(kas == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kas Wajib Diisi',
                });
                return false  ;
            } else {}
            if(kredit == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Sumber Pemasukkan Wajib Diisi',
                });
                return false ;
            } else {}
            if(ket == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Keterangan Wajib Diisi',
                });
                return false ;
            } else {}
            if(vat == "" ){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Vat Harus Diisi',
                });
                return false;
            } else if( vat < 0 ){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Vat Tidak boleh dibawah 0',
                });
                return false;
            } else if (vat >= 100){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Vat Berlebihan',
                });
                return false;
            }
        //Validasi
        $.ajax({
            type    : 'post',
            url     : "{!! url('data-kas')!!}",
            data    : {
                _token :token,
                kode    : $('#tmb-kode').val(),
                keterangan  : $('#tmb-keterangan').val(),
                tanggal : $('#tmb-tgl').val(),
                dk      : "D",
            },
            success : function(response){
                // console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon :'success',
                        title: response.pesan,
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon :'error',
                        title: response.pesan,
                    });
                }
            }
        });
    });
  //TAMBAH DATA
  
 
</script>
</body>
</html>
