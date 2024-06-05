<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Cetak Material Receive</title>
    </head>
    <style>
    @page {
        size: A5 landscape;
        margin-top: 8px;
        margin-bottom: 10px;
        margin-left: 10px;
    }
    .footer-cetak{
        position: fixed;
        bottom: 0;
        width: 100%;
    }
        @media print{
            .table th.bg-herbivor {
                background-color: #66ff33 !important; /* Contoh: Mengubah warna latar menjadi hijau */
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            .
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
                        <div class="col-sm-5 invoice-col">
                          <img src="{{asset('img')}}/herbivor.png" width="40%">
                        </div>
                        <div class="col-sm-2 invoice-col">
                          
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
                                          <div class="col-sm-3 invoice-col">Supplier</div>
                                          <div class="col-sm-1 invoice-col">:</div>
                                          <div class="col-sm-8 invoice-col" id="nama-supplier"></div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-3 invoice-col">Address</div>
                                          <div class="col-sm-1 invoice-col">:</div>
                                          <div class="col-sm-8 invoice-col" id="alamat-supplier"></div>
                                      </div>
                                  </td>
                                  <td width="17%">
                                      No. MR <br>
                                      Date<br>
                                      Time Delivery<br>
                                      Surat Jalan <br>
                                      Keterangan</td>
                                  <td width="1%">:<br>:<br>:<br>:<br>:</td>
                                  <td width="24%">
                                      <p id="data-mr"></p>
                                  </td>
                              </tr>
                          </table>
                          <table class="table table-break table-bordered ">
                              <thead  style="background-color: #66ff33;">
                                  <tr>
                                      <th class="text-center bg-herbivor" width="5%"><b>No.</b></th>
                                      <th class="bg-herbivor" width="45%"><b>Item & Specification</b></th>
                                      <th class="text-center bg-herbivor"><b>Dikirim</b></th>
                                      <th class="text-center bg-herbivor"><b>Diterima</b></th>
                                      <th class="text-center bg-herbivor"><b>Diakui</b></th>
                                      <th class="text-center bg-herbivor"><b>Packing</b></th>
                                      <th class="text-center bg-herbivor"><b>Satuan</b></th>
                                  </tr>
                              </thead>
                              <tbody id="tabel-barang">
                              </tbody>
                              
                          </table>
                      </div>
                  </div>
                  
                  <div class="footer-cetak">
                      <div class="row invoice-info" style="margin-bottom:30px">
                            <div class="col-sm-4 invoice-col">
                                <p class="text-center"><b>Penerima</b></p>
                            </div>
                            <div class="col-sm-4 invoice-col"></div>
                            <div class="col-sm-4 invoice-col" align="center"><b>Admin</b>
                            </div>  
                      </div>
                      
                      <div class="row invoice-info">
                          <div class="col-sm-4 invoice-col">
                              <p class="text-center"><b>(..........................)</b></p> 
                          </div>
                          <div class="col-sm-4 invoice-col"></div>
                          <div class="col-sm-4 invoice-col">
                              <p class="text-center"><b>(..........................)</b></p>    
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
    $.ajax({
        url     :'{!! url("cetakmr/'+kode+'") !!}',
        type    : 'get',
        success : function(data) {
            console.log(data);
            $('#data-mr').html(kode+"<br>"+data.mr.tanggal+"<br>"+data.mr.tanggal+"<br>"+data.mr.surat_jalan+"<br>"+data.mr.keterangan);
            if(data.mr.nama === null){
                var nama = "";
            } else {
                var nama = data.mr.nama;
            }
            if(data.mr.nama_perusahaan === null){
                var perusahaan = "";
            } else {
                var perusahaan = data.mr.nama_perusahaan;
            }
            $('#nama-supplier').html(nama+" - "+perusahaan);
            $('#alamat-supplier').html(data.mr.alamat);
            var tabel = "#tabel-barang";
            tabelbarang(tabel,data.detail);
            // var tipe = kode.substr(3,2);
            // if(tipe == 61){
            //   $('#no-nota').html(kode);
            //   $('#supplier').html(data.mr.nama+" "+data.mr.nama_perusahaan);
            //   $('#alamat').html(data.mr.alamat);
            //   $('#telp-supplier').html(data.mr.telp);
            //   $('#tgl-penerimaan').html(Tanggal(data.mr.tanggal));
            //   $('#surat-jalan').html(data.mr.surat_jalan);
            // } else {
            //   $('#no-nota').html(kode);
            //   $('#supplier').html("-");
            //   $('#alamat').html("-");
            //   $('#tgl-penerimaan').html(Tanggal(data.mr.tanggal));  
            //   $('#surat-jalan').html("-");
            // }
            
            // var detail = data.detail;
            // var datahandler = $('#detail-mr');
            // var n= 0;
            // $('#keterangan').html("Gudang : "+detail[n]['gudang']+"<br> Alamat   : "+detail[n]['alamat']);
            // $.each(detail, function(key,val){
            //     var Nrow = $("<tr>");
            //     var nomor = n+1;
            //     Nrow.html("<td align='center'>"+nomor+".</td><td>"+detail[n]['barang']+" "+detail[n]['keterangan']+"</td><td align='center'>"+detail[n]['dikirim']+"</td><td align='center'>"+detail[n]['diterima']+"</td><td align='center'>"+detail[n]['diakui']+"</td><td align='center'>"+detail[n]['packing']+"</td><td align='center'>"+detail[n]['satuan']+"</td></tr>");  
               
            //     datahandler.append(Nrow);
            //     n = n+1;
            // });
            // window.print();
        }
    })
    // console.log(data);
    
});
    function tabelbarang(tabel,data){
        $(tabel).empty();
        // console.log(data);
        var n = 1;
        
        $.each(data, function(index,barang){
            var nomor = n;
            var Nrow = $("<tr>");
            var dikirim = barang['dikirim'];
            var diterima = barang['diterima'];
            var diakui = barang['diakui'];
            
            Nrow.html("<td class='text-center'>"+nomor+"</td><td>"+barang['barang']+" - "+barang['keterangan']+"</td><td class='text-center'>"+dikirim+"</td><td class='text-center'>"+diterima+"</td><td>"+diakui+"</td><td class='text-center'>"+barang['packing']+"</td> <td>"+barang['satuan']+"</td></tr>")    
            $(tabel).append(Nrow); 
            n = n+1;
        });
        
        
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
