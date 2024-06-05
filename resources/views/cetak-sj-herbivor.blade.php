<!DOCTYPE html>
<html lang="en">
  <!-- Load paper.css for happy printing -->
  

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  
    @include('layout/head')
    <style>
    @page {
        size: A5 landscape;
        margin-top: 8px;
        margin-bottom: 10px;
        margin-left: 20px;
        text-size : 10px;
    }
    @media print {
        .header-print {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
          }
          .data-print {
            margin-top: 100px; /* Mengatur margin atas agar kontainer data-print berada di bawah header-print */
            margin-bottom : 300px;
          }
        
          table {
            page-break-inside: auto; /* Mengatur agar tabel dapat bercetak di halaman baru jika melebihi ukuran halaman */
            width: 100%; /* Menyesuaikan lebar tabel dengan lebar halaman */
            border-collapse: collapse; /* Menggabungkan batas sel */
          }
        /* Pengaturan untuk footer halaman cetak */
        .header-invoice, .footer-invoice {
          display: block;
          position: fixed;
          width: 100%;
          padding: 10px;
          background-color: #ccc;
          z-index: 999; /* Pastikan header dan footer muncul di atas konten */
        }
        .header-invoice {
          top: 0;
        }
        .footer-invoice {
          bottom: 0;
        }
        
        
        
        .table th.bg-herbivor {
            background-color: #66ff33 !important; /* Contoh: Mengubah warna latar menjadi hijau */
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        
    }
    </style>
   <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">
   
<head>
  <title>Cetak Surat Jalan</title>
</head>
<body class="A5 landscape">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="header-print">
                      <div class="row invoice-info" style="border-bottom: 3px solid #66ff33;">
                        <div class="col-sm-5 invoice-col">
                          <img src="{{asset('img')}}/herbivor.png" width="40%">
                        </div>
                        <div class="col-sm-2 invoice-col">
                          
                        </div>
                        <div class="col-sm-5 invoice-col d-flex align-items-center justify-content-center">
                          <h1><b>Surat Jalan</b></h1>
                        </div>
                      </div>
                      <div class="row invoice-info" style="border-bottom: 3px solid #66ff33;">
                        <div class="col-sm-12 invoice-col">
                          <label style="line-height: 0;">PT. HERBIVOR SATU NUSA</label>
                          <p style="line-height: 1.2;">Bumi Marina Emas Barat VII B-35 Keputih, Sukolilo - Surabaya  No. HP +62 821 3483 2019</p>
                        </div>
                      </div>
                  </div>
                  <div class="data-print">
                      <div class="row ">
                          <table class="table">
                              <tr >
                                  <td width="10%">Customer<br>Alamat</td>
                                  <td width="1%">:<br>:</td>
                                  <td width="47%">
                                      <b>{{$data['sj']->namakonsumen}}</b> <br>
                                      {{$data['sj']->alamat}}</td>
                                  <td width="17%">
                                      No. PO <br>
                                      No. Peforma Invoice <br>
                                      Tgl Invoice <br>
                                      Tgl Pengiriman <br>
                                      Keterangan</td>
                                  <td width="1%">:<br>:<br>:<br>:<br>:</td>
                                  <td width="24%">
                                      {{$data['inv']->po_req}} <br>
                                      <b >{{$data['sj']->invoice}}</b> <br>
                                      {{$data['inv']->tanggal}} <br>
                                      {{$data['sj']->tgl_kirim}} <br>
                                      <b>{{$data['sj']->keterangan}}</b>
                                  </td>
                              </tr>
                          </table>
                          <table class="table table-break table-bordered">
                              <thead  style="background-color: #66ff33;">
                                  <tr>
                                      <th class="text-center bg-herbivor"><b>NO</b></th>
                                      <th class="bg-herbivor"><b>BARANG/JASA DAN SPESIFIKASI</b></th>
                                      <th class="text-center bg-herbivor"><b>QTY</b></th>
                                      <th class="text-center bg-herbivor"><b>SATUAN</b></th>
                                  </tr>
                              </thead>
                              <tbody id="tabel-barang">
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr><tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                                  <tr>
                                      <td>1.</td>
                                      <td>Buku</td>
                                      <td>123</td>
                                      <td>Dus</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="content-invoice">
                      
                      <!--<div class="row ">-->
                      <!--    <table class="table">-->
                      <!--        <tr >-->
                      <!--            <td width="10%">Customer<br>Alamat</td>-->
                      <!--            <td width="1%">:<br>:</td>-->
                      <!--            <td width="47%">-->
                      <!--                <b>{{$data['sj']->namakonsumen}}</b> <br>-->
                      <!--                {{$data['sj']->alamat}}</td>-->
                      <!--            <td width="17%">-->
                      <!--                No. PO <br>-->
                      <!--                No. Peforma Invoice <br>-->
                      <!--                Tgl Invoice <br>-->
                      <!--                Tgl Pengiriman <br>-->
                      <!--                Keterangan</td>-->
                      <!--            <td width="1%">:<br>:<br>:<br>:<br>:</td>-->
                      <!--            <td width="24%">-->
                      <!--                {{$data['inv']->po_req}} <br>-->
                      <!--                <b >{{$data['sj']->invoice}}</b> <br>-->
                      <!--                {{$data['inv']->tanggal}} <br>-->
                      <!--                {{$data['sj']->tgl_kirim}} <br>-->
                      <!--                <b>{{$data['sj']->keterangan}}</b>-->
                      <!--            </td>-->
                      <!--        </tr>-->
                      <!--    </table>-->
                      <!--    <table class="table table-break table-bordered">-->
                      <!--        <thead  style="background-color: #66ff33;">-->
                      <!--            <tr>-->
                      <!--                <th class="text-center bg-herbivor"><b>NO</b></th>-->
                      <!--                <th class="bg-herbivor"><b>BARANG/JASA DAN SPESIFIKASI</b></th>-->
                      <!--                <th class="text-center bg-herbivor"><b>QTY</b></th>-->
                      <!--                <th class="text-center bg-herbivor"><b>SATUAN</b></th>-->
                      <!--            </tr>-->
                      <!--        </thead>-->
                      <!--        <tbody id="tabel-barang">-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr><tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--            <tr>-->
                      <!--                <td>1.</td>-->
                      <!--                <td>Buku</td>-->
                      <!--                <td>123</td>-->
                      <!--                <td>Dus</td>-->
                      <!--            </tr>-->
                      <!--        </tbody>-->
                      <!--    </table>-->
                      <!--</div>-->
                  </div>
                  <div class="footer-invoice">
                      <div class="row">
                            <div class="col-sm-4 invoice-col">
                                <p id="penerima" class="text-center"><b>Penerima</b><br><br><br><br>(...........)</p>
                            </div>
                            <div class="col-sm-4 invoice-col"></div>
                            <div class="col-sm-4 invoice-col">
                                <p id="admin" class="text-center"><b>Admin</b><br><br><br><br>(...........)</p>
                            </div>  
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
      
      
      <!--<div class="row">-->
      <!--    <div class="col-sm-4 invoice-col ">-->
      <!--        <p class="text-center" id="penerima"><b>Penerima</b><br><br><br><br>(...........)</p>-->
      <!--    </div>-->
      <!--    <div class="col-sm-4 invoice-col"></div>-->
      <!--    <div class="col-sm-4 invoice-col ">-->
      <!--        <p class="text-center" id="admin"><b>Penerima</b><br><br><br><br>(...........)</p>-->
      <!--    </div>-->
      <!--</div>-->
    
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
    var tabel = "#tabel-barang";
    var data = <?php echo json_encode($data['detail']); ?>;
    // console.log(data);
    // tabelbarang(tabel,data);
    });
    function tabelbarang(tabel,data){
        $(tabel).empty();
        // console.log(data);
        var n = 1;
        $.each(data, function(index,barang){
            var nomor = n;
            var Nrow = $("<tr>");
            var qty = barang['qty'];
            if(barang['nama_request'] == null){
                var nama = barang['nama'];
            } else {
                var nama = barang['nama_request'];
            }
            
            Nrow.html("<td class='text-center'>"+nomor+"</td><td>"+nama+"</td><td class='text-center'>"+qty+"</td><td class='text-center'>"+barang['satuan']+"</td></tr>")    
            $(tabel).append(Nrow); 
            n = n+1;
        });
        
    }
    

    
</script>
</body>
</html>
