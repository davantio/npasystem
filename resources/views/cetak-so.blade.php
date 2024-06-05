<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Cetak Sales Order</title>
    </head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    {{-- <!-- title row -->
    <div class="row">
      <div class="col-2">
        <h2 class="page-header">
            <img src="{{asset('img')}}/logo.png"  class="brand-image"  width="30%">
        </h2>
      </div>
      <div class="col-lg-9">
        <label> CV Nusa Pratama Anugerah
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <!--<div class="row invoice-info">-->
    <!--  <div class="col-sm-4 invoice-col">-->
    <!--    From-->
    <!--    <address>-->
    <!--      <strong>Admin, Inc.</strong><br>-->
    <!--      795 Folsom Ave, Suite 600<br>-->
    <!--      San Francisco, CA 94107<br>-->
    <!--      Phone: (804) 123-5432<br>-->
    <!--      Email: info@almasaeedstudio.com-->
    <!--    </address>-->
    <!--  </div>-->
      <!-- /.col -->
    <!--  <div class="col-sm-4 invoice-col">-->
    <!--    To-->
    <!--    <address>-->
    <!--      <strong>John Doe</strong><br>-->
    <!--      795 Folsom Ave, Suite 600<br>-->
    <!--      San Francisco, CA 94107<br>-->
    <!--      Phone: (555) 539-1037<br>-->
    <!--      Email: john.doe@example.com-->
    <!--    </address>-->
    <!--  </div>-->
      <!-- /.col -->
    <!--  <div class="col-sm-4 invoice-col">-->
    <!--    <b>Invoice #007612</b><br>-->
    <!--    <br>-->
    <!--    <b>Order ID:</b> 4F3S8J<br>-->
    <!--    <b>Payment Due:</b> 2/22/2014<br>-->
    <!--    <b>Account:</b> 968-34567-->
    <!--  </div>-->
      <!-- /.col -->
    <!--</div>-->
    <!-- /.row -->

    <!-- Table row -->
    
    <!-- /.row -->

    <!--<div class="row">-->
      <!-- accepted payments column -->
    <!--  <div class="col-6">-->
    <!--    <p class="lead">Payment Methods:</p>-->
    <!--    <img src="../../dist/img/credit/visa.png" alt="Visa">-->
    <!--    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">-->
    <!--    <img src="../../dist/img/credit/american-express.png" alt="American Express">-->
    <!--    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">-->

    <!--    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">-->
    <!--      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr-->
    <!--      jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.-->
    <!--    </p>-->
    <!--  </div>-->
      <!-- /.col -->
    <!--  <div class="col-6">-->
    <!--    <p class="lead">Amount Due 2/22/2014</p>-->

    <!--    <div class="table-responsive">-->
    <!--      <table class="table">-->
    <!--        <tr>-->
    <!--          <th style="width:50%">Subtotal:</th>-->
    <!--          <td>$250.30</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--          <th>Tax (9.3%)</th>-->
    <!--          <td>$10.34</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--          <th>Shipping:</th>-->
    <!--          <td>$5.80</td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--          <th>Total:</th>-->
    <!--          <td>$265.24</td>-->
    <!--        </tr>-->
    <!--      </table>-->
    <!--    </div>-->
    <!--  </div>-->
      <!-- /.col -->
    <!--</div>-->
    <!-- /.row --> --}}
    <table cellpadding="5" >
        <tr class="justify-content-left">
            <td  width="10%" style="border-left:2px solid black;border-top:2px solid black;">
                <img src="{{asset('img')}}/logo.png"  class="brand-image"  width="100%">
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
    <table  cellpadding="5" style="border-color:black;">
        <thead>
            
        </thead>
        <!--<tr class="justify-content-left">-->
        <!--    <td  width="10%" style="border-left:2px solid black;border-top:2px solid black;border-bottom:2px solid black">-->
        <!--        <img src="{{asset('img')}}/logo.png"  class="brand-image"  width="100%">-->
        <!--    </td>-->
        <!--    <td colspan="8" style="border-right:2px solid black;border-top:2px solid black;border-bottom:2px solid black">-->
        <!--        <p>-->
        <!--            <b style="font-size: 150%">CV. Nusa Pratama Anugerah</b>-->
        <!--            <br>-->
        <!--            Chemical Cleaning, Industy and Argo-->
        <!--            <br>-->
        <!--            Taman Pondok Jati Blok AR-2 RT.025 RW.005 Geluran, Kec.Taman, Kab. Sidoarjo - Jawa Timur 61257-->
        <!--            <br>-->
                    
        <!--        </p>-->
        <!--    </td>-->
        <!--</tr>-->
        
        <tr>
            <td colspan="3" align="center" style="border:2px solid black;">
                <h3><b>SALES ORDER</b></h3>
            </td>
            <td colspan="3" style="border:2px solid black;">
                PO No.
                <br>
                <label id="po"><?php echo $_GET['kode'];?></label>
            </td>
            <td colspan="3" style="border:2px solid black;">
                Date
                <br>
                <label id="tgl"></label>
            </td>
        </tr>
        <tr style="vertical-align: top;">
            <td colspan="3" rowspan="4" id="data-konsumen" style="border:2px solid black;"></td>
            <td colspan="6" id="kode-po"  style="border:2px solid black; font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6" id="pembayaran"  style="border:2px solid black; font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6"id="term-payment" style="border:2px solid black; font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6" id="estimated-delivery" style="border:2px solid black; font-size:14px"></td>
        </tr>
        <tr align="center" >
            <td width="5%" style="border:2px solid black;">No.</td>
            <td colspan="2" style="border:2px solid black;">Item & Specification</td>
            <td width="5" style="border:2px solid black;">QTY</td>
            <td width="5" style="border:2px solid black;">Satuan</td>
            <td style="border:2px solid black;">Harga</td>
            <td width="5%" style="border:2px solid black;">Disc(%)</td>
            <td style="border:2px solid black;">Amount</td>
        </tr>
        
    <tbody id="detail-so">
    </tbody>
        <tr>
            <td rowspan="3 "colspan="3" width="50%" id="total-terbilang" style="border:2px solid black;">Amount in Words</td>
            <td colspan="4" style="border:2px solid black;">Total</td>
            <td id="total" style="border:2px solid black;">Rp.</td>
        </tr>
        <tr>
            <td colspan="4" id="vat-po" style="border:2px solid black;">VAT </td>
            <td id="vat" style="border:2px solid black;">Rp.</td>
        </tr>
        <tr>
            <td colspan="4" style="border:2px solid black;">TOTAL + VAT</td>
            <td id="total-po" style="border:2px solid black;">Rp.</td>
        </tr>
        <tr>
            <td colspan="8" id="remark" style="border:2px solid black;"> 
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border:2px solid black;">Accept and confirmed by Customer
                <br><br><br><br><br><br>By
            </td>
            <td colspan="5" align="" style="border:2px solid black;" >Approved
                <br>
                <div align="center">
                    <br><br><br><br><br><br>
                    <!-- <img src="{{asset('img')}}/ttd_purchasing.png" id="ttd_purchasing" width="40%"> -->
                    <p class="text-center"><b id="marketing"></b></p>    
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
        url     :'{!! url("cetak-dataso/'+kode+'") !!}',
        type    : 'get',
        success : function(data){
            console.log(data);
            $('#marketing').html(data.so.MRKT);
            $('#tgl').html(data.so.date);
            if(data.so.no_po == null) {
                $('#kode-po').html("Kode PO <br><b> - <b>");    
            } else {
                $('#kode-po').html("Kode PO <br><b>"+data.so.no_po+"<b>");
            }
            
            $('#pembayaran').html("Pembayaran <br><b>"+data.so.pembayaran+"<b>");
            $('#term-payment').html("Term of Payment <br><b>"+data.so.term_payment+"<b>");
            $('#estimated-delivery').html("Estimated Delivery <br><b>"+data.so.estimasi+"<b>");
            $('#data-konsumen').html("Customer Name & Address <br><b>"+data.konsumen.nama+"</b><br><b>"+data.konsumen.nama_perusahaan+"</b><br>"+data.konsumen.alamat);
            var datahandler = $('#detail-so');
            var n= 0;
            var total = 0;
            var vat = data.so.vat;
            var sumVAT = 0;
            var S = 0
            console.log(data.detail);
            var DPP = 0;
            $.each(data.detail, function(key,val){
                var Nrow = $("<tr>");
                var nomor = n+1;
                var qty = data.detail[n]['qty']*1;
                qty = qty.toFixed(2);
                var dpp = data.detail[n]['dpp']*1;
                DPP = DPP+dpp;
                var harga = data.detail[n]['harga']*1;
                harga = harga.toFixed(2);
                //VAT
                var varr = (harga*vat)/100;
                varr = varr*qty;
                sumVAT = sumVAT+varr;
                console.log(sumVAT);
                
                
                if(data.detail[n]['nama_request'] == null){var nama = data.detail[n]['barang']; } else { var nama = data.detail[n]['nama_request']; }
                 Nrow.html("<td width='5%' align='center' style='border:2px solid black;'>"+nomor+".</td><td colspan='2' style='border:2px solid black;'>"+nama+"</td><td width='5%' style='border:2px solid black;'>"+qty+"</td><td style='border:2px solid black;'>"+data.detail[n]['satuan']+"</td><td style='border:2px solid black;'>"+formatRupiah(data.detail[n]['harga'])+"</td><td width='5%' style='border:2px solid black;' align='right'>"+0+"</td><td style='border:2px solid black;'>"+formatRupiah(data.detail[n]['dpp'])+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
            total = DPP+sumVAT;
            DPP = formatRupiah(DPP);
            total = total*1;
            // $.each(detail, function(key,val){
            //     var Nrow = $("<tr >");
            //     var nomor = n+1;
            
            //     // var x = detail[n]['qty']*detail[n]['harga'];
            //     // var ongkir = detail[n]['ongkir'];
            //     // if(ongkir == 0){ongkir = 0;} else {ongkir = ongkir*1;}
            //     // x = x+ongkir;
            //     // // console.log(x);
            //     // S = S+x;
            //     // var VAT = (vat*detail[n]['harga'])/100;
            //     // // console.log(VAT);
            //     // VAT = VAT.toFixed(3)*detail[n]['qty'];
            //     // VAT = VAT.toFixed(3);
            //     // console.log(detail[n]['nama']+" -> "+VAT);
            //     // sumVAT = sumVAT+VAT;
            //     // sumVAT = sumVAT*1;
            //     // console.log("SUM VAT = "+sumVAT);
                
            //     Nrow.html("<td width='5%' align='center' style='border:2px solid black;'>"+nomor+".</td><td colspan='2' style='border:2px solid black;'>"+barang+"</td><td width='5%' style='border:2px solid black;'>"+detail[n]['banyak']+"</td><td style='border:2px solid black;'>"+detail[n]['satuan']+"</td><td style='border:2px solid black;'>"+formatRupiah(detail[n]['harga'])+"</td><td width='5%' style='border:2px solid black;' align='right'>"+0+"</td><td style='border:2px solid black;'>"+formatRupiah(x)+"</td></tr>");
            //     datahandler.append(Nrow);
                
            //     var jumlah = detail[n]['jumlah']*1;
            //     total = total+jumlah;
            //     total = total*1;
            //     // console.log(total);
            //     n = n+1;
            // });
            $('#vat').html(formatRupiah(sumVAT));
            $('#total').html('<b>'+DPP+'</b>');
            $('#total-po').html('<b>'+formatRupiah(total)+'</b>');
            $('#total-terbilang').html('Amount in Words <br><br><b>"'+terbilang(total)+' Rupiah</b>"');
            // document.getElementById("ttd_purchasing").src = "{{asset('img')}}/"+data.ttd;
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
