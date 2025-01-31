<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Cetak Purchase Order</title>
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
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Serial #</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Call of Duty</td>
            <td>455-981-221</td>
            <td>El snort testosterone trophy driving gloves handsome</td>
            <td>$64.50</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Need for Speed IV</td>
            <td>247-925-726</td>
            <td>Wes Anderson umami biodiesel</td>
            <td>$50.00</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Monsters DVD</td>
            <td>735-845-642</td>
            <td>Terry Richardson helvetica tousled street art master</td>
            <td>$10.70</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Grown Ups Blue Ray</td>
            <td>422-568-642</td>
            <td>Tousled lomo letterpress</td>
            <td>$25.99</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
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
                <h3><b>PURCHASE ORDER</b></h3>
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
        <tr>
            <td colspan="3" rowspan="4" id="data-supplier" style="border:2px solid black;"></td>
            <td colspan="6" id="seller-reff"  style="border:2px solid black; font-size:15px"> Seller Ref. No.</td>
        </tr>
        <tr>
            <td colspan="6" id="term-delivery"  style="border:2px solid black; font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6"id="time-delivery" style="border:2px solid black; font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6" id="pembayaran" style="border:2px solid black; font-size:14px"></td>
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

    <tbody id="detail-po">
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
            <td colspan="3" style="border:2px solid black;">Accept and confirmed by Seller
                <br><br><br><br><br><br>By
            </td>
            <td colspan="5" align="" style="border:2px solid black;" >Approved
                <br>
                <div align="center">
                    <img id="ttd_purchasing" width="40%">
                    <!-- <img src="{{asset('img')}}/ttd_purchasing.png" id="ttd_purchasing" width="40%"> -->
                    <p class="text-center"><b>Seli Sofiatun Nisak</b></p>
                </div>




            </td>
        </tr>
        <tr>
            <td colspan="3" style="border:2px solid black;">
                <p style="font-size:12px">
                    Pada saat penagihan PENJUAL wajib menyerahkan :
                    <br>
                    1. Surat Jalan Asli / Berita Acara yang ditandatangai dan distempel
                    <br>
                    2. 1(satu) lembar kwitansi lengkap dengan materai yang cukup
                    <br>
                    3. 1(satu) lembar PO yang telah ditandatangani dan distempel
                    <br>
                    PENJUAL
                    <br>
                    4. 1(satu) lembar Asli dan 1(satu) lembar copy Faktur Pajak tanpa cacat (tidak ada tipe-x)
                </p>
            </td>
            <td colspan="5" style="border:2px solid black;"></td>
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

//Kode Lama

// $(document).ready(function() {
//     var kode = "<?php echo $_GET['kode'];?>";

//     $.ajax({
//         url     :'{!! url("cetakpodetail/'+kode+'") !!}',
//         type    : 'get',
//         success : function(data){
//             // console.log(data);
//             detail = data.detail;
//             var vat = data.po.vat;
//             $('#vat-po').html('VAT '+vat+'%');
//             if(data.supplier.email == null){ var email = "-";} else { var email = data.supplier.email;}
//             if(data.supplier.npwp == null){ var npwp = "-"; } else { var npwp = data.supplier.npwp;}
//             if(data.po.keterangan == null){ var ket = "-"; } else { var ket = data.po.keterangan;}
//             if(data.supplier.nama_perusahaan == null){ var perusahaan = "-";} else { var perusahaan = data.supplier.nama_perusahaan;};
//             if(data.supplier.nama == null){ var nama = "-";} else { var nama = data.supplier.nama;};
//             $('#data-supplier').html('<p style="font-size:17px">Seller Name & Address :<br><b>'+perusahaan+'</b><br><b>'+nama+'</b><br>'+data.supplier.alamat+'<br>Email : '+email+'<br>NPWP : '+npwp+'</p>');
//             $('#term-delivery').html('Term Of Delivery :<b>'+data.po.term_delivery+'</b>');
//             $('#time-delivery').html('Time Of Delivery :<b>'+data.po.time_delivery+'</b>');
//             $('#pembayaran').html('Term Of Payment :<b> '+data.po.pembayaran+'</b>');
//             $('#remark').html('<b>REMARK : </b>'+ket)
//             $('#tgl').html(data.po.tgl);
//             var datahandler = $('#detail-po');
//             var n= 0;
//             var total = 0;

//             var sumVAT = 0;
//             var S = 0
//             $.each(detail, function(key,val){
//                 var Nrow = $("<tr >");
//                 var nomor = n+1;
//                 var x = detail[n]['qty']*detail[n]['harga'];
//                 var ongkir = detail[n]['ongkir'];
//                 if(ongkir == 0){ongkir = 0;} else {ongkir = ongkir*1;}
//                 x = x+ongkir;
//                 // console.log(x);
//                 S = S+x;
//                 var VAT = (vat*detail[n]['harga'])/100;
//                 // console.log(VAT);
//                 VAT = VAT.toFixed(3)*detail[n]['qty'];
//                 VAT = VAT.toFixed(3);
//                 console.log(detail[n]['nama']+" -> "+VAT);
//                 sumVAT = sumVAT+VAT;
//                 sumVAT = sumVAT*1;
//                 console.log("SUM VAT = "+sumVAT);

//                 Nrow.html("<td width='5%' align='center' style='border:2px solid black;'>"+nomor+".</td><td colspan='2' style='border:2px solid black;'>"+detail[n]['nama']+"</td><td width='5%' style='border:2px solid black;'>"+detail[n]['banyak']+"</td><td style='border:2px solid black;'>"+detail[n]['satuan']+"</td><td style='border:2px solid black;'>"+formatRupiah(detail[n]['harga'])+"</td><td width='5%' style='border:2px solid black;' align='right'>"+0+"</td><td style='border:2px solid black;'>"+formatRupiah(x)+"</td></tr>");
//                 datahandler.append(Nrow);

//                 var jumlah = detail[n]['jumlah']*1;
//                 total = total+jumlah;
//                 total = total*1;
//                 // console.log(total);
//                 n = n+1;
//             });
//             $('#vat').html(formatRupiah(sumVAT));
//             $('#total').html('<b>'+formatRupiah(S)+'</b>');
//             $('#total-po').html('<b>'+formatRupiah(total)+'</b>');
//             $('#total-terbilang').html('Amount in Words <br><br><b>"'+terbilang(total)+' Rupiah</b>"');
//             document.getElementById("ttd_purchasing").src = "{{asset('img')}}/"+data.ttd;
//             window.print();
//         }
//     })

// });

//END KODE LAMA

//KODE BARU

$(document).ready(function() {
    var kode = "<?php echo $_GET['kode'];?>";

    $.ajax({
        url: '{!! url("cetakpodetail/'+kode+'") !!}',
        type: 'get',
        success: function(data) {
            detail = data.detail;
            var vat = parseFloat(data.po.vat) || 0; // Pastikan VAT adalah angka
            $('#vat-po').html('VAT ' + vat + '%');

            // Tampilkan informasi supplier
            $('#data-supplier').html(`
                <p style="font-size:17px">
                    Seller Name & Address :<br>
                    <b>${data.supplier.nama_perusahaan || '-'}</b><br>
                    <b>${data.supplier.nama || '-'}</b><br>
                    ${data.supplier.alamat}<br>
                    Email : ${data.supplier.email || '-'}<br>
                    NPWP : ${data.supplier.npwp || '-'}
                </p>`);

            // Tampilkan informasi PO
            $('#term-delivery').html('Term Of Delivery :<b>' + data.po.term_delivery + '</b>');
            $('#time-delivery').html('Time Of Delivery :<b>' + data.po.time_delivery + '</b>');
            $('#pembayaran').html('Term Of Payment :<b> ' + data.po.pembayaran + '</b>');
            $('#remark').html('<b>REMARK : </b>' + (data.po.keterangan || '-'));
            $('#tgl').html(data.po.tgl);

            var datahandler = $('#detail-po');
            var totalAmount = 0; // Total harga barang
            var totalVAT = 0; // Total VAT

            // Iterasi setiap detail barang
            detail.forEach((item, index) => {
                var qty = parseFloat(item.qty) || 0; // Pastikan qty adalah angka
                var price = parseFloat(item.harga) || 0; // Pastikan harga adalah angka
                var shipping = parseFloat(item.ongkir) || 0; // Pastikan ongkir adalah angka

                // Hitung total per barang
                var itemTotal = (qty * price) + shipping;

                // Hitung VAT per barang
                var vatValue = ((price * vat) / 100) * qty;

                // Tambahkan ke total keseluruhan
                totalAmount += itemTotal;
                totalVAT += vatValue;

                // Tambahkan baris ke tabel
                var Nrow = $("<tr>");
                Nrow.html(`
                    <td width='5%' align='center' style='border:2px solid black;'>${index + 1}.</td>
                    <td colspan='2' style='border:2px solid black;'>${item.nama}</td>
                    <td width='5%' style='border:2px solid black;'>${item.banyak}</td>
                    <td style='border:2px solid black;'>${item.satuan}</td>
                    <td style='border:2px solid black;'>${formatRupiah(price)}</td>
                    <td width='5%' style='border:2px solid black;' align='right'></td> <!-- Kosongkan kolom DISC -->
                    <td style='border:2px solid black;'>${formatRupiah(itemTotal)}</td>
                `);
                datahandler.append(Nrow);
            });

            // Hitung total akhir (Total + VAT)
            var grandTotal = totalAmount + totalVAT;

            // Tampilkan total
            $('#vat').html(formatRupiah(totalVAT));
            $('#total').html('<b>' + formatRupiah(totalAmount) + '</b>');
            $('#total-po').html('<b>' + formatRupiah(grandTotal) + '</b>');
            $('#total-terbilang').html('Amount in Words <br><br><b>"' + terbilang(grandTotal) + ' Rupiah</b>"');

            // Tampilkan tanda tangan
            document.getElementById("ttd_purchasing").src = "{{asset('img')}}/" + data.ttd;

            // Cetak halaman
            window.print();
        }
    });
});

//END KODE BARU

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
