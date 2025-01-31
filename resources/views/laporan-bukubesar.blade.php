<!DOCTYPE html>
<html lang="en">
  
@include('layout/head')
<head>
  <title>Laporan Buku Besar</title>
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
            <h1 class="m-0">Laporan Buku Besar
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Laporan Buku Besar</li>
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
                  <form id="bukubesar">
                    <div class="row">                    
                      <div class="col-lg-4 form-group">
                        <label> Tanggal Awal</label> <br>
                        <input type="date" class="form-control" id="awal" required>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label> Tanggal Akhir</label> <br>
                        <input type="date" class="form-control" id="akhir" requirefd>
                      </div>
                      <div class="col-lg-4 form-group">
                        <br>
                        <button type="submit" class="btn btn-primary" id="cari" >Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="table-stock" class="table  table-striped">
                    <thead>
                    <tr>
                      <th rowspan="2" style="text-align: center">Tanggal</th>
                      <th rowspan="2" style="text-align: center">Kode Perkiraan</th>
                      {{-- <td colspan="2" style="text-align: center"><strong>AWAL</strong></td> --}}
                      <td colspan="2" style="text-align: center" ><strong>MASUK</strong></td>
                      {{-- <td colspan="2" style="text-align: center" ><strong>AKHIR</strong></td> --}}
                      <th rowspan="2" style="text-align: center">Saldo Akhir</th>
                    </tr>
                    <tr>
                      {{-- <th style="text-align: center">DEBIT</th>
                      <th style="text-align: center">KREDIT</th> --}}
                      <th style="text-align: center">DEBIT</th>
                      <th style="text-align: center">KREDIT</th>
                      {{-- <th style="text-align: center">DEBIT</th>
                      <th style="text-align: center">KREDIT</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      {{-- Footer Total Debit dan Kredit --}}
                      <tr>
                        <th colspan="2" style="text-align: right"><strong>Total:</strong></th>
                        <th id="total-debit" style="text-align: center">Rp. 0,00</th>
                        <th id="total-kredit" style="text-align: center">Rp. 0,00</th>
                        <th></th>
                      </tr>
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
  // Fungsi untuk memformat tanggal
function formatTanggal(tanggal) {
    if (!tanggal) return null; // Jika tanggal kosong, kembalikan null

    const months = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const dateObj = new Date(tanggal);
    const day = dateObj.getDate();
    const month = months[dateObj.getMonth()];
    const year = dateObj.getFullYear();

    return `${day} ${month} ${year}`;
}
</script>
<script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });
  });
 
  $('.select2').select2();
  $('#bukubesar').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#cari');
    el.prop('disabled', true);
    setTimeout(function(){el.prop('disabled', false); }, 4000);

    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var token = "{!! csrf_token() !!}";

    $.ajax({
      url   : '{!! url("data-lap-bukubesar") !!}',
      type  : 'get',
      data  :{
              _token : token,
              awal    : awal,
              akhir   : akhir ,
            },
      success   : function(response){
        console.log(response);

        // Reset total debit and kredit
        let totalDebit = 0;
        let totalKredit = 0;

        // Calculate totals
        response.data.forEach(item => {
          let debit = parseFloat(item.debit_masuk.replace(/[^0-9,-]/g, '').replace(',', '.')) || 0;
          let kredit = parseFloat(item.kredit_masuk.replace(/[^0-9,-]/g, '').replace(',', '.')) || 0;
          totalDebit += debit;
          totalKredit += kredit;
        });

        // Update footer
        $('#total-debit').text('Rp. ' + totalDebit.toLocaleString('id-ID', {minimumFractionDigits: 2}));
        $('#total-kredit').text('Rp. ' + totalKredit.toLocaleString('id-ID', {minimumFractionDigits: 2}));

        // Initialize DataTable
        $('#table-stock').DataTable().clear().destroy();
        $('#table-stock').DataTable({
          dom: 'Blrtip',
          buttons: [
            {
              extend: 'copy',
              footer: true, // Sertakan footer
              filename: function() {
                let awal = formatTanggal($('#awal').val()) || 'Tanggal-Awal'; // Format tanggal awal
                let akhir = formatTanggal($('#akhir').val()) || 'Tanggal-Akhir'; // Format tanggal akhir
                return `Laporan_Buku_Besar_${awal}_to_${akhir}`; // Format nama file
              }
            },
            {
              extend: 'csv',
              footer: true, // Sertakan footer
              filename: function() {
                let awal = formatTanggal($('#awal').val()) || 'Tanggal-Awal';
                let akhir = formatTanggal($('#akhir').val()) || 'Tanggal-Akhir';
                return `Laporan_Buku_Besar_${awal}_to_${akhir}`;
              }
            },
            {
              extend: 'excel',
              footer: true, // Sertakan footer
              filename: function() {
                let awal = formatTanggal($('#awal').val()) || 'Tanggal-Awal';
                let akhir = formatTanggal($('#akhir').val()) || 'Tanggal-Akhir';
                return `Laporan_Buku_Besar_${awal}_to_${akhir}`;
              },
              customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // Hapus teks "Total" di sel A5
                $('row c[r^="A"]', sheet).each(function () {
                  if ($(this).text() === 'Total:') {
                    $(this).text(''); // Kosongkan kolom Total di kolom "Kode Perkiraan"
                  }
                });

              },
            },
            {
              extend: 'pdf',
              footer: true, // Sertakan footer
              filename: function() {
                let awal = formatTanggal($('#awal').val()) || 'Tanggal-Awal';
                let akhir = formatTanggal($('#akhir').val()) || 'Tanggal-Akhir';
                return `Laporan_Buku_Besar_${awal}_to_${akhir}`;
              },
                customize: function (doc) {
                var rows = doc.content[1].table.body;
                rows[rows.length - 1][0].text = ''; // Hapus teks "Total" di kolom Tanggal
                rows[rows.length - 1][1].text = ''; // Hapus teks "Total" di kolom Kode Perkiraan
              },
            },
            {
              extend: 'print',
              footer: true, // Sertakan footer
              title: function() {
                let awal = formatTanggal($('#awal').val()) || 'Tanggal Awal';
                let akhir = formatTanggal($('#akhir').val()) || 'Tanggal Akhir';
                return `Laporan Buku Besar (${awal} - ${akhir})`; // Judul cetakan
              },
              customize: function (win) {
                // Hapus teks "Total" dari kolom yang tidak relevan
                $(win.document.body)
                  .find('tfoot th:nth-child(2)')
                  .text(''); // Kosongkan kolom Kode Perkiraan
              },
            },
          ],
          data : response.data,
          columns : [
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'perkiraan', name: 'perkiraan',orderable:true},
            { data: 'debit_masuk', name: 'debit_masuk',orderable:false},
            { data: 'kredit_masuk', name: 'kredit_masuk',orderable:false},
            { data: 'saldo_akhir', name: 'saldo_akhir',orderable:false},
          ],
          footerCallback: function(row, data, start, end, display) {
          // Optional: Update footer dynamically (if required)
        }
        });
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
