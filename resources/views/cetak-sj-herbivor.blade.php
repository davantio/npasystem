<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<style>
@page {
    size: A4 landscape;
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
<link rel="stylesheet" href="{{ asset('AdminLTE/dist') }}/css/paper.css">

<head>
    <title>Cetak Surat Jalan</title>
</head>
<body class="A5 landscape">
<div class="wrapper">
    <section class="invoice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="header-print">
                        <div class="row invoice-info" style="border-bottom: 3px solid #66ff33;">
                            <div class="col-sm-5 invoice-col">
                                <img src="{{ asset('img') }}/herbivor.png" class="img-fluid" style="max-width: 40%; height: auto;">
                            </div>
                            <div class="col-sm-2 invoice-col"></div>
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
                        <div class="row">
                            <table class="table">
                                <tr>
                                    <td width="10%">Customer<br>Alamat</td>
                                    <td width="1%">:<br>:</td>
                                    <td width="47%">
                                        <b>{{ $data['sj']->namakonsumen }}</b> <br>
                                        {{ $data['sj']->alamat }}
                                    </td>
                                    <td width="17%">
                                        No. PO <br>
                                        No. Peforma Invoice <br>
                                        Tgl Invoice <br>
                                        Tgl Pengiriman <br>
                                        Keterangan
                                    </td>
                                    <td width="1%">:<br>:<br>:<br>:<br>:</td>
                                    <td width="24%">
                                        {{ $data['inv']->po_req }} <br>
                                        <b>{{ $data['sj']->invoice }}</b> <br>
                                        {{ $data['inv']->tanggal }} <br>
                                        {{ $data['sj']->tgl_kirim }} <br>
                                        <b>{{ $data['sj']->keterangan }}</b>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-break table-bordered">
                                <thead style="background-color: #66ff33;">
                                    <tr>
                                        <th class="text-center bg-herbivor"><b>NO</b></th>
                                        <th class="bg-herbivor"><b>BARANG/JASA DAN SPESIFIKASI</b></th>
                                        <th class="text-center bg-herbivor"><b>QTY</b></th>
                                        <th class="text-center bg-herbivor"><b>SATUAN</b></th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-barang">
                                    @foreach ($data['detail'] as $index => $barang)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td class="text-center">{{ $barang->qty }}</td>
                                        <td class="text-center">{{ $barang->satuan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    </section>
</div>

<!-- Page specific script -->
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins') }}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE/plugins') }}/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>
