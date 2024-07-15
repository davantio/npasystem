<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Cetak Purchase Order</title>
    </head>
    <style>
        @media print{
            .table th.bg-herbivor {
                background-color: #66ff33 !important; /* Contoh: Mengubah warna latar menjadi hijau */
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
<body>
<div class="wrapper">
  <!-- Main content -->
    <section class="invoice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                  <div >
                      <div class="row invoice-info" style="border-bottom: 3px solid #66ff33;">
                        <div class="col-sm-5">
                          <img src="{{asset('img')}}/herbivor.png" width="40%">
                        </div>
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-5 invoice-col d-flex align-items-center justify-content-center">
                          <h1><b>Purchase Order</b></h1>
                        </div>
                      </div>
                      <div class="row invoice-info" style="border-bottom: 3px solid #66ff33;">
                        <div class="col-sm-12">
                          <label style="line-height: 0;">PT. HERBIVOR SATU NUSA</label>
                          <p style="line-height: 1.2;">Bumi Marina Emas Barat VII B-35 Keputih, Sukolilo - Surabaya  No. Telp +62 821 3483 2019</p>
                        </div>
                      </div>
                  </div>
                  <div >
                      <div class="row ">
                          <table class="table">
                              <tr >
                                  <td width="50%">
                                      <div class="row">
                                          <div class="col-sm-3">Supplier</div>
                                          <div class="col-sm-1">:</div>
                                          <div class="col-sm-8">{{$data['supplier']->nama}}</div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-3">Address</div>
                                          <div class="col-sm-1">:</div>
                                          <div class="col-sm-8">{{$data['supplier']->alamat}}</div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-3">NPWP</div>
                                          <div class="col-sm-1">:</div>
                                          <div class="col-sm-8">{{$data['supplier']->npwp}}</div>
                                      </div>
                                  </td>
                                  <td width="17%">
                                      No. PO <br>
                                      Date<br>
                                      Term of Delivery <br>
                                      Time Delivery<br>
                                      Term of Payment</td>
                                  <td width="1%">:<br>:<br>:<br>:<br>:</td>
                                  <td width="24%">
                                      <b>{{$data['po']->kode}}</b><br>
                                      {{$data['po']->tgl_po}}<br>
                                      {{$data['po']->term_delivery}}<br>
                                      {{$data['po']->time_delivery}}<br>
                                      {{$data['po']->term_payment}}<br>
                                  </td>
                              </tr>
                          </table>
                          <table class="table table-break table-bordered ">
                              <thead  style="background-color: #66ff33;">
                                  <tr>
                                      <th class="text-center bg-herbivor" width="5%"><b>No.</b></th>
                                      <th class="bg-herbivor" width="45%"><b>Item & Specification</b></th>
                                      <th class="text-center bg-herbivor" width="5%"><b>QTY</b></th>
                                      <th class="text-center bg-herbivor" width="5%"><b>Satuan</b></th>
                                      <th class="text-center bg-herbivor"><b>Price</b></th>
                                      <th class="text-center bg-herbivor" width="5%"><b>Disc(%)</b></th>
                                      <th class="text-center bg-herbivor"><b>Price</b></th>
                                  </tr>
                              </thead>
                              <tbody id="tabel-barang">
                              </tbody>
                              <tfoot>
                                    <tr>
                                        <td rowspan="3 "colspan="2" width="50%" id="total-terbilang" style="border:2px solid black;">Amount in Words</td>
                                        <td colspan="4" style="border:2px solid black;">Total</td>
                                        <td id="total" style="border:2px solid black;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" id="vat-po" style="border:2px solid black;">VAT {{$data['po']->vat}} %</td>
                                        <td id="vat" style="border:2px solid black;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="border:2px solid black;">TOTAL + VAT</td>
                                        <td id="total-po" style="border:2px solid black;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" id="remark" style="border:2px solid black;">
                                            <p><b>REMARK : </b>{{$data['po']->keterangan}}</p>
                                        </td>
                                    </tr>

                              </tfoot>
                          </table>
                      </div>
                  </div>

                  <div >
                      <div class="row">
                            <div class="col-sm-4">
                                <p id="penerima" class="text-center"><b>Penerima</b></p>
                            </div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" align="center"><b>Admin</b>
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4" align="center">
                              <img src="{{asset('img')}}/ttd_purchasing_herbivor.png" id="ttd_purchasing" width="80%">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-4">
                              <p class="text-center"><b>(..........................)</b></p>
                          </div>
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4">
                              <p class="text-center"><b>Seli Sofiatun Nisak</b></p>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                                <p style="font-size:12px">
                                    Pada saat penagihan PENJUAL wajib menyerahkan :
                                    <br>
                                    1. Surat Jalan Asli / Berita Acara yang ditandatangai dan distempel oleh pihak penjual
                                    <br>
                                    2. 1(satu) lembar kwitansi lengkap dengan materai
                                    <br>
                                    3. 1(satu) lembar PO yang telah ditandatangani dan distempel oleh pihak penjual
                                    <br>
                                    4. 1(satu) lembar Asli dan 1(satu) lembar copy Faktur Pajak tanpa cacat (tidak ada tipe-x)
                                </p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
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
    console.log("Data from Laravel:", <?php echo json_encode($data); ?>);
    var data = <?php echo json_encode($data['detail']); ?>;
    console.log(data);
    var tabel = "#tabel-barang";
    tabelbarang(tabel,data);
});
    function tabelbarang(tabel,data){
        $(tabel).empty();
        // console.log(data);
        var n = 1;
        var total = 0;
        var totalvat = 0;
        var VAT = "{{$data['po']->vat}}"*1;
        $.each(data, function(index,barang){
            var nomor = n;
            var Nrow = $("<tr>");
            var qty = barang['qty']*1;
            var harga = barang['harga']*1;
            var nama = barang['nama'];
            var sum = harga*qty;
            var XX = (harga*VAT)/100;
            var sumvat = XX*qty;
            total +=  sum;
            totalvat += sumvat;
            Nrow.html("<td class='text-center'>"+nomor+"</td><td>"+nama+"</td><td class='text-center'>"+barang['banyak']+"</td><td class='text-center'>"+barang['satuan']+"</td><td>"+formatRupiah(harga)+"</td><td class='text-center'>0</td> <td>"+formatRupiah(sum)+"</td></tr>")
            $(tabel).append(Nrow);
            n = n+1;
        });

        $('#total').html(formatRupiah(total));
        $('#vat').html(formatRupiah(totalvat));
        $('#total-po').html(formatRupiah(total+totalvat));
        $('#total-terbilang').html("Amount in Words<br><b> "+terbilang(total+totalvat)+"</b>");
        // document.getElementById("ttd_purchasing").src = "{{asset('img')}}/"+data.ttd;
        console.log("TOTAL = "+total);
        console.log("TOTAL VAT = "+totalvat);
    }
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
