<!DOCTYPE html>
<html lang="en">
  <!-- Load paper.css for happy printing -->


  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->

    @include('layout/head')

   <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">
   <style>@page {
        size: A5 landscape;
        margin-top: 8px;
        margin-bottom: 10px;
        margin-left: 20px;
        text-size : 10px;
    }
    </style>
<head>
  <title>Cetak Surat Jalan</title>
</head>
<body class="A5 landscape">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <table cellpadding="5" width="100%" >
        <tr class="justify-content-left">
            <td  width="10%" style="border-left:2px solid black;border-top:2px solid black;">
                <img src="{{asset('img')}}/logo.png"   width="100%">
            </td>
            <td style="border-right:2px solid black;border-top:2px solid black;">
                <p>
                    <b style="font-size: 150%">CV. Nusa Pratama Anugerah</b>
                    <br>
                    Chemical Cleaning, Industy and Argo
                    <br>
                    Taman Pondok Jati Blok AR-2 RT.025 RW.005 Geluran, Kec.Taman, Kab. Sidoarjo - Jawa Timur 61257
                    <br>

                </p>
            </td>
        </tr>
    </table>
    <table cellpadding="5" width="100%"style="border-color:black;" >
      <tr>
        <td colspan="2" align="center" width="50%" height style="border:2px solid black;;">
          <h3><b>SURAT JALAN</b></h3>
        </td>
        <td width="25%" style="border:2px solid black;">
          <b>Nomor Invoice</b>
          <br>
          <b id="no-nota">-</b>
        </td>
        <td width="25%" style="border:2px solid black;">
          <b>Tanggal</b>
          <br>
          <b id="tgl">
            <script type='text/javascript'>

              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

              var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

              var date = new Date();

              var day = date.getDate();

              var month = date.getMonth();

              var thisDay = date.getDay(),

                  thisDay = myDays[thisDay];

              var yy = date.getYear();

              var year = (yy < 1000) ? yy + 1900 : yy;

              document.write(day + ' ' + months[month] + ' ' + year);
            </script>
          </b>
        </td>
      </tr>
      <tr style="vertical-align: top;">
        <td rowspan="3" colspan="2" style="border:2px solid black;" id="data-customer">
            <b>Customer</b>
            <br>
            <b>&emsp;&emsp;</b><b id="customer"></b>
            <br>
            <b>Alamat :</b>
            <b>&emsp;&emsp;</b><b id="alamat"></b>
        </td>
        <td style="border:2px solid black;">
          <b>No. Telp</b>
          <br>
          <b id="telp-customer">-</b>
        </td>
        <td style="border:2px solid black;">
          <b> Tgl Pengiriman</b>
          <br>
          <b id="tgl-pengiriman"></b>
        </td>
      </tr>
      <tr>
        <td style="border:2px solid black;">
          <b>Kode PO</b>
          <br>
          <b id="kode"></b>
        </td>
        <td style="border:2px solid black;">
          <b>Plat Nomor</b>
          <br>
          <b id="nopol"></b>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="border:2px solid black;">
          <b>KETERANGAN</b>
          <br>
          <b id="keterangan"></b>
        </td>
      </tr>
      <tr>
        <td colspan="4" style="border-top:2px solid black;border-left:2px solid black;border-right:2px solid black;">
          <b>Barang/jasa dan spesifikasinya adalah sebagai berikut :</b>
        </td>
      </tr>
    </table>
    <table cellpadding="5" style="border:2px solid black;" width="100%" >
      <thead align="center" >
        <td width="5%" style="border:2px solid black;"><b>No.</b></td>
        <td width="45%" style="border:2px solid black;"><b>Barang/Jasa dan Spesifikasi</b></td>
        <td style="border:2px solid black;"><b>QTY</b></td>
        <td style="border:2px solid black;"><b>SATUAN</b></td>
      </thead>
      <tbody id="detail-sj">

      </tbody>
      <tr>
        <td colspan="4" width="40" style="border:2px solid black;">
          <!--<div class="row justify-content-around">-->
          <!--    <div class="col-lg-6" style="text-align:center;">-->
          <!--      <b>Penerima</b>-->
          <!--      <br><br><br>-->
          <!--      <b>_______________</b>-->
          <!--    </div>-->
          <!--    <div class="col-lg-6" style="text-align:center;">-->
          <!--      <b>Admin</b>-->
          <!--      <br><br><br>-->
          <!--      <b>_______________</b>-->
          <!--    </div>-->

          <!--</div>-->
          <div class="row justify-content-around">
              <b>Penerima</b>
              <b>Supir</b>
              <b>Admin</b>
          </div>
          <br><br><br>
          <div class="row justify-content-around">
              <b style="margin-left: 20px;">_______________</b>
              <b>_______________</b>
              <b>_______________</b>
          </div>
        </td>

      </tr>
    </table>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<script>


    $(document).ready(function() {
    var kode = "<?php echo $_GET['kode'];?>";

    $.ajax({
        url     :'{!! url("cetaksjdetail/'+kode+'") !!}',
        type    : 'get',
        success : function(data) {
            // console.log(data);
            var tipe = kode.substr(3,2);
            if(tipe == 41){
              $('#customer').html(data.konsumen.nama_perusahaan+" "+data.konsumen.nama);
              if(data.konsumen.alamat == null || data.konsumen.alamat == "-"){
                $('#alamat').html("<br>"+data.sj.alamat);
              } else {
                $('#alamat').html("<br>"+data.konsumen.alamat);
              }
              $('#telp-customer').html(data.konsumen.telp);
              function formatTanggalIndonesia(tanggal) {
                const namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                const date = new Date(tanggal);
                return `${date.getDate()} ${namaBulan[date.getMonth()]} ${date.getFullYear()}`;
            }
                $('#tgl-pengiriman').html(formatTanggalIndonesia(data.sj.tgl_kirim));
              $('#no-nota').html(data.invoice.kode);
              $('#kode').html(data.so.no_po);
              $('#nopol').html(data.sj.nopol ?? "-"); // Added line to show license plate number
            } else {
              $('#data-customer').html("-");
            }
            $('#keterangan').html(data.sj.keterangan);
            detail = data.detail;

            var datahandler = $('#detail-sj');
            var n= 0;
            $.each(detail, function(key,val){
                var Nrow = $("<tr>");
                var nomor = n+1;
                if (detail[n]['nama_request'] == null) {
                  Nrow.html("<td align='center'>"+nomor+".</td><td>"+detail[n]['nama']+"</td><td align='center'>"+detail[n]['qty']*1+"</td><td align='center'>"+detail[n]['satuan']+"</td></tr>");
                } else {
                  Nrow.html("<td  align='center'>"+nomor+".</td><td>"+detail[n]['nama_request']+"</td><td align='center'>"+detail[n]['qty']*1+"</td><td align='center'>"+detail[n]['satuan']+"</td></tr>");
                }

                datahandler.append(Nrow);
                n = n+1;
            });
            window.print();
        }
    })

    });
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR' }
        ).format(money);
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