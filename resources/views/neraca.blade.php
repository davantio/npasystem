<!DOCTYPE html>
<html lang="en">

@include('layout/head')
<head>
  <title>Laporan Neraca</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('AdminLTE/dist')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}
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
            <h1 class="m-0">Laporan Neraca
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Neraca</li>
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
                  <form id="neraca">
                    <div class="row">
                      <div class="col-lg-3 form-group">
                        <label> Tanggal Awal</label> <br>
                        <input type="date" class="form-control" id="awal" required>
                      </div>
                      <div class="col-lg-3 form-group">
                        <label> Tanggal Akhir</label> <br>
                        <input type="date" class="form-control" id="akhir" required>
                      </div>
                      <div class="col-lg-3 form-group">
                        <label>Perusahaan</label>
                        <select id="perusahaan" class="form-control select2" required>
                            <option value="">Pilih Perusahaan</option>
                            <option value="all">Semua</option>
                            <option value="npa">CV. Nusa Pratama Anugrah</option>
                            <option value="herbivor">PT. Herbivor Satu Nusa</option>
                            <option value="triputra">PT. Triputra Sinergi Indonesia</option>
                        </select>
                      </div>
                      <div class="col-lg-3 form-group">
                        <br>
                        <button type="submit" class="btn btn-primary" id="cari" >Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  {{-- Add block neraca --}}
                  <div class="alert alert-danger d-none" id="warning-neraca">
                    Neraca tidak seimbang! Mohon periksa kembali data Anda.
                  </div>
                  <table id="table-stock" class="table  table-striped">
                    <thead>
                    <tr>
                      <th style="width: 30%;">Nama Perkiraan</th>
                      <th>Group</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                      <th style="width: 13%;">Nett</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      {{-- <tr><td colspan="5" id="total_aktivalancar"><b>Total Aktiva Lancar:</b> ...</td></tr> --}}
                      {{-- <tr><td colspan="5" id="total_aktivatetap"><b>Total Aktiva Tetap:</b> ...</td></tr> --}}
                      <tr><td colspan="5" id="total_aset"><b>Total Aset:</b> 0</td></tr>
                      {{-- <tr><td colspan="5" id="total_passivalancar"><b>Total Passiva Lancar:</b> ...</td></tr> --}}
                      {{-- <tr><td colspan="5" id="total_ekuitas"><b>Total Ekuitas:</b> ...</td></tr> --}}
                      <tr><td colspan="5" id="total_kewajibanekuitas"><b>Total Kewajiban dan Ekuitas:</b> 0</td></tr>
                    </tfoot>
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
    <!-- MODAL Preview Laporan -->
      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog ">
          <div class="modal-content">
            <form id="form-detail">
              <div class="modal-header bg-info">
                <h4 class="modal-title">Laporan Marketing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <label> Nama Marketing</label>
                    <input type="text" class="form-control" id="dtl-marketing" value="{{$detail->nama}}" disabled>
                  </div>
                  <div class="col-lg-6">
                    <label> Tanggal</label>
                    <input type="date" class="form-control" id="dtl-tanggal" disabled>
                  </div>
                </div>
                <br>
                <textarea class="form-control" rows="3" placeholder="Enter ..." id="dtl-laporan" disabled="" style="height: 200px;"></textarea>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <!-- Modal Preview Laporan -->
  <!-- /MODAL -->
  <!-- /.content-wrapper -->
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
<script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });
  });

  $('.select2').select2();
  $('#neraca').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var perusahaan = $('#perusahaan').val(); // Ambil nilai perusahaan yang dipilih
    var token = "{!! csrf_token() !!}";
    $.ajax({
      url   : '{!! url("laporan-neraca") !!}',
      type  : 'get',
      data  :{
              _token : token,
              awal    : awal,
              akhir   : akhir,
              perusahaan: perusahaan // Kirim perusahaan ke controller
            },
      success   : function(response){
        console.log(response);
        $('#table-stock').DataTable().clear().destroy();
        $('#table-stock').DataTable({
          dom: 'Blrtip',
          buttons: [
            { 
              extend: 'copy', 
              footer: false,
              messageBottom: function() {
                return $('#total_aset').text() + '\n' +
                      $('#total_kewajibanekuitas').text();
              },
              exportOptions: {
                columns: ':visible',
                format: {
                    body: function (data, row, column, node) {
                        return removeRupiahFormat(data);
                    }
                }
              }
            },
            { 
              extend: 'csv', 
              footer: false,
              messageBottom: function() {
                return $('#total_aset').text() + ',' +
                      $('#total_kewajibanekuitas').text();
              },
              exportOptions: {
                columns: ':visible',
                format: {
                    body: function (data, row, column, node) {
                        return removeRupiahFormat(data);
                    }
                }
              }
            },
            { 
              extend: 'excel', 
              footer: false,
              messageBottom: function() {
                return $('#total_aset').text() + '                 ' +
                      $('#total_kewajibanekuitas').text();
              },
              exportOptions: {
                columns: ':visible',
                format: {
                    body: function (data, row, column, node) {
                        return removeRupiahFormat(data);
                    }
                }
              }
            },
            { 
              extend: 'pdf', 
              footer: false,
              messageBottom: function() {
                return $('#total_aset').text() + '\n' +
                      $('#total_kewajibanekuitas').text();
              },
              exportOptions: {
                columns: ':visible',
                format: {
                    body: function (data, row, column, node) {
                        return removeRupiahFormat(data);
                    }
                }
              }
            },
            {
              extend: 'print', 
              footer: false,
              exportOptions: {
                columns: ':visible',
                format: {
                    body: function (data, row, column, node) {
                        return removeRupiahFormat(data);
                    }
                }
              },
              customize: function(win) {
                // Add summary data to the print view
                $(win.document.body).append(
                  '<div style="text-align:left; margin-top:10px; border-top: 1px solid #ddd; padding-top: 10px;">' +
                  $('#total_aset').html() + '<br>' +
                  $('#total_kewajibanekuitas').html() +
                  '</div>'
                );
              }
            }
          ],
          data : response.data,
          columns : [
            { data: 'nama_perkiraan', name: 'nama_perkiraan'},
            { data: 'group_laporan', name: 'group_laporan'},
            { data: 'total_debit', name: 'total_debit'},
            { data: 'total_kredit', name: 'total_kredit'},
            { data: 'nett', name: 'nett'},
          ],
        });

          // Fungsi untuk menghapus format Rupiah sebelum ekspor
          function removeRupiahFormat(data) {
              if (typeof data === "string") {
                  return data.replace(/Rp\.|\./g, '').replace(',', '.').trim();
              }
              return data;
          }

            // var total_aktivalancar = response.data[0].total_aktivalancar;
            // var total_aktivatetap = response.data[0].total_aktivatetap;
            var total_aset = response.data[0].total_aset;
            // $('#total_aktivalancar').html('<b>Total Aktiva Lancar:</b> ' + total_aktivalancar);
            // $('#total_aktivatetap').html('<b>Total Aktiva Tetap: </b>' + total_aktivatetap);
            $('#total_aset').html('<b>Total Aset: </b> ' + total_aset);

            // var total_passivalancar = response.data[0].total_passivalancar;
            // var total_ekuitas = response.data[0].total_ekuitas;
            var total_kewajibanekuitas = response.data[0].total_kewajibanekuitas;
            // $('#total_passivalancar').html('<b>Total Passiva Lancar:</b> ' + total_passivalancar);
            // $('#total_ekuitas').html('<b>Total Ekuitas: </b>' + total_ekuitas);
            $('#total_kewajibanekuitas').html('<b>Total Kewajiban dan Ekuitas: </b> ' + total_kewajibanekuitas);

            // Validasi neraca seimbang
            if (!response.isBalanced) {
              $('#warning-neraca').removeClass('d-none');
              Swal.fire({
                icon: 'warning',
                title: 'Neraca Tidak Seimbang',
                text: 'Total Aset tidak sama dengan Total Kewajiban dan Ekuitas!',
              });
            } else {
              $('#warning-neraca').addClass('d-none');
            }
        }
    })
  });



  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
  });
</script>
</body>
</html>
