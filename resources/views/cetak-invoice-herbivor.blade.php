<!DOCTYPE html>
<html lang="en">
  <!-- Load paper.css for happy printing -->


  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->

    @include('layout/head')
    <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">
    <head>
        <title>Cetak Invoice</title>
    </head>

    <style>@page {
        size: A4 portrait;
        margin-top: 10px;

    }
    .invoice-header img {
    width: 100%;
    height: auto;
    max-width: 150px; /* Set a max-width to prevent excessive scaling */
}

    </style>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="invoice p-3 mb-3">
                <!-- title row -->

                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-5 invoice-col invoice-header">
                    <img src="{{asset('img')}}/herbivor.png" alt="Logo">
                </div>
                <div class="col-sm-2 invoice-col"></div>
                <div class="col-sm-5 invoice-col d-flex align-items-center justify-content-center">
                    <h1>INVOICE</h1>
                </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-5 invoice-col d-flex align-items-center " style="background-color: #66ff33;">
                    <h4><b>CUSTOMER</b></h4><br>

                  </div>
                  <!-- /.col -->
                  <div class="col-sm-2 invoice-col">

                  </div>
                  <!-- /.col -->
                  <div class="col-sm-5 invoice-col d-flex align-items-center " style="background-color: #66ff33;">
                    <h4><b>INFORMASI PESANAN</b></h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row invoice-info">
                  <div class="col-sm-5 invoice-col ">
                    <label><b>{{$data['inv']['rekanan']}}</b></label><br>
                    <address>
                        <p>{{$data['inv']['alamat']}}
                          </p>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-2 invoice-col">

                  </div>
                  <!-- /.col -->
                  <div class="col-sm-5 invoice-col " >
                    <div class="row">
                        <div class="col-sm-5">
                            <label><b>No. Invoice</b></label>
                        </div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <a id="invoice">{{$data['inv']['kode']}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label><b>No. PO</b></label>
                        </div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <a>{{$data['inv']['po_req']}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label><b>Tanggal </b></label>
                        </div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <a>{{$data['inv']['tanggal']}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label><b>Term of Payment</b></label>
                        </div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-5">
                            <a>{{$data['inv']['keterangan']}}</a>
                        </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-12 invoice-col">
                        <p><em>Barang yang telah diterima dalam keadaan baik dan cukup.</em></p>
                    </div>
                </div>
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 ">
                    <table class="table table-striped">
                      <thead>
                          <tr>
                            <th>NO</th>
                            <th>BARANG DAN SPESIFIKASI</th>
                            <th>QTY</th>
                            <th>UNIT</th>
                            <th>HARGA</th>
                            <th>SUB TOTAL</th>
                          </tr>
                      </thead>
                      <tbody id="tabel-barang">

                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row invoice-info">
                  <!-- accepted payments column -->
                  <div class="col-sm-5 background-opacity" >
                      <div class="content">
                          <div class="row d-flex align-items-center " style="background-color: #66ff33;">
                            <h4><b>CATATAN :</b></h4>
                        </div>
                        <div class="row" >
                          <p class="text-muted well well-sm shadow-none" >
                              Pembayaran dengan Bilyet Giro/ melalui T. Transfer<br>
                              harap diatas namakan / ditunjukan ke :
                          </p>
                        </div>
                        <div class="row">
                          <p>
                              <b id="nama-bank"></b><br>
                              <b id="nama-rekening"></b><br>
                              <a id="no-rekening"></a>
                          </p>
                        </div>
                      </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5  text-center">
                    <p>Hormat Kami</p>
                    <br><br><br><br>
                    <label><b id="admin-name">(Denistia)</b></label>

                  </div>
                  <!-- /.col -->
                </div>

                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">

                </div>
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
<!-- ./wrapper -->
<!-- Page specific script -->
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function() {
    console.log("Data from Laravel:", <?php echo json_encode($data); ?>);
    var admin = "{{$data['pembuat']}}";
    var barang = <?php echo json_encode($data['inv']['detail']); ?>;
    console.log(barang);
    $('#nama-bank').html("{{$data['inv']['bank']}}");
    $('#nama-rekening').html("{{$data['inv']['atas_nama']}}");
    $('#no-rekening').html("{{$data['inv']['rekening']}}");
    $('#admin-name').html("("+admin+")");
    var tabel = '#tabel-barang';
    tabelbarang(tabel,<?php echo json_encode($data['detail']); ?>);
  });
  function tabelbarang(tabel,data){
    $(tabel).empty();
    console.log(data);
    var n = 1;
    var total = 0; const pajak = parseInt({{$data['inv']['vat']}});
    var sumtax = 0;
    $.each(data, function(index,barang){
        var nomor = n;
        var Nrow = $("<tr>");
        var taxbarang = (barang['harga_jual']*pajak)/100;
        taxbarang = barang['diakui']*taxbarang;
        var jumlahNumerik = parseFloat(barang['jumlah']);
        if (!isNaN(jumlahNumerik)) { // Cek jika konversi ke numerik berhasil
            total += jumlahNumerik; // Gunakan nilai numerik untuk penjumlahan
        }
        sumtax += taxbarang;
        Nrow.html("<td>"+nomor+"</td><td>"+barang['barang']+"</td><td>"+barang['diakui']+"</td><td>"+barang['satuan']+"</td><td>"+formatRupiah(barang['harga_jual'])+"</td><td>"+formatRupiah(barang['dpp'])+"</td></tr>")
        $(tabel).append(Nrow);
        n = n+1;
    });
    console.log(total);
    var row = $("<tr>");
    row.html("<td colspan='2'>TERBILANG<br>#<b>"+terbilang(total)+" Rupiah</b>#</td><td colspan='3'>HARGA JUAL<br>PPN "+pajak+" %<br><b>TOTAL</b></td><td>"+formatRupiah(total)+"<br>"+formatRupiah(sumtax)+"<br><b>"+formatRupiah(total + sumtax)+"</b></td></tr>");
    $(tabel).append(row);
    row = $("<tr><td colspan='6'></td></tr>");
    $(tabel).append(row);

}








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
  function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
      { style: 'currency', currency: 'IDR' }
    ).format(money);
  }
  function angka(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
      return true;
  }
  function terbilang(angka){
        var bilne=["","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas"];
        if(angka < 12){

            return bilne[angka];

        }else if(angka < 20){

            return terbilang(angka-10)+" belas";

        }else if(angka < 100){

            return terbilang(Math.floor(parseInt(angka)/10))+" Puluh "+terbilang(parseInt(angka)%10);

        }else if(angka < 200){

            return "Seratus "+terbilang(parseInt(angka)-100);

        }else if(angka < 1000){

            return terbilang(Math.floor(parseInt(angka)/100))+" Ratus "+terbilang(parseInt(angka)%100);

        }else if(angka < 2000){

            return "Seribu "+terbilang(parseInt(angka)-1000);

        }else if(angka < 1000000){

            return terbilang(Math.floor(parseInt(angka)/1000))+" Ribu "+terbilang(parseInt(angka)%1000);

        }else if(angka < 1000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000))+" Juta "+terbilang(parseInt(angka)%1000000);

        }else if(angka < 1000000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000000))+" Milyar "+terbilang(parseInt(angka)%1000000000);

        }else if(angka < 1000000000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000000000))+" Trilyun "+terbilang(parseInt(angka)%1000000000000);

        }

    }
</script>
</body>
</html>
