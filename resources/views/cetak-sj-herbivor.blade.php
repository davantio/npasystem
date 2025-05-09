<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Jalan</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 10mm 10mm 10mm;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, sans-serif;
            color: #2D3748;
            line-height: 1.5;
            background-color: #fff;
        }
        
        .page-container {
            position: relative;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Section */
        .header-section {
            display: flex;
            align-items: center;
            padding-bottom: 12px;
            border-bottom: 2px solid #66ff33;
            margin-bottom: 15px;
        }
        
        .logo-container {
            width: 120px;
            margin-right: 30px;
        }
        
        .logo {
            max-width: 100%;
            height: auto;
        }
        
        .header-content {
            flex: 1;
        }
        
        .company-name {
            font-size: 13px;
            font-weight: 700;
            color: #1A202C;
            margin-bottom: 3px;
        }
        
        .company-address {
            font-size: 11px;
            color: #4A5568;
            line-height: 1.4;
        }
        
        .document-title {
            margin-left: auto;
            text-align: right;
        }
        
        .title-box {
            background-color: #66ff33;
            color: #222;
            font-size: 22px;
            font-weight: bold;
            padding: 8px 25px;
            border-radius: 4px;
            letter-spacing: 1px;
            display: inline-block;
            position: relative;
        }
        
        .title-box::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 10%;
            right: 10%;
            height: 3px;
            background-color: #33cc00;
            border-radius: 2px;
        }
        
        /* Document Info Section */
        .document-info {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-block {
            flex: 1;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        
        .info-header {
            background-color: #66ff33;
            color: #222;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 8px 15px;
            letter-spacing: 0.5px;
        }
        
        .info-content {
            padding: 12px 15px;
            background-color: #f8fafc;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 110px 1fr;
            row-gap: 8px;
        }
        
        .info-label {
            font-size: 11px;
            color: #718096;
            font-weight: 500;
        }
        
        .info-value {
            font-size: 12px;
            color: #2D3748;
            margin-left: 10px;
        }
        
        .bold {
            font-weight: 600;
        }
        
        /* Items Table */
        .items-table-container {
            margin-bottom: 20px;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .items-table thead {
            background: linear-gradient(90deg, #66ff33, #99ff66);
        }
        
        .items-table th {
            color: #222;
            font-weight: 600;
            text-align: left;
            padding: 10px 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .items-table th.center {
            text-align: center;
        }
        
        .items-table tbody tr:nth-child(odd) {
            background-color: #f8fafc;
        }
        
        .items-table tbody tr:nth-child(even) {
            background-color: #edf2f7;
        }
        
        .items-table tbody tr:hover {
            background-color: rgba(102, 255, 51, 0.15);
        }
        
        .items-table td {
            padding: 8px 12px;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
        }
        
        .items-table td.center {
            text-align: center;
        }
        
        /* Notes Section */
        .notes-section {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .notes-box {
            flex: 1;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        
        .notes-header {
            background-color: #66ff33;
            color: #222;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 8px 15px;
            letter-spacing: 0.5px;
        }
        
        .notes-content {
            padding: 12px 15px;
            font-size: 11px;
            color: #4A5568;
            min-height: 60px;
            background-color: #f8fafc;
        }
        
        .notes-list {
            margin: 0;
            padding-left: 18px;
        }
        
        .notes-list li {
            margin-bottom: 3px;
        }
        
        /* Confirmation Section */
        .confirmation {
            margin: 15px 0;
            font-size: 11px;
            font-style: italic;
            color: #4A5568;
        }
        
        /* Signature Section */
        .signatures {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-top: 15px;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        
        .signature-box {
            text-align: center;
            border-radius: 4px;
            background-color: #f8fafc;
            padding: 10px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .signature-title {
            font-weight: 600;
            margin-bottom: 40px;
            font-size: 11px;
            color: #2D3748;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .signature-line {
            border-bottom: 1px solid #718096;
            width: 85%;
            margin: 0 auto;
        }
        
        /* Print-specific styles */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            
            .page-container {
                width: 100%;
            }
            
            .document-info, .notes-section, .signatures {
                page-break-inside: avoid;
            }
            
            .items-table-container {
                page-break-inside: auto;
            }
            
            .items-table tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        <div class="header-section">
            <div class="logo-container">
                <img src="{{ asset('img') }}/herbivor.png" class="logo" alt="Herbivor Logo">
            </div>
            <div class="header-content">
                <p class="company-name">PT. HERBIVOR SATU NUSA</p>
                <p class="company-address">Bumi Marina Emas Barat VII B-35 Keputih, Sukolilo - Surabaya</p>
            </div>
            <div class="document-title">
                <div class="title-box">SURAT JALAN</div>
            </div>
        </div>
        
        <div class="document-info">
            <div class="info-block">
                <div class="info-header">INFORMASI PELANGGAN</div>
                <div class="info-content">
                    <div class="info-grid">
                        <div class="info-label">Customer:</div>
                        <div class="info-value bold">{{ $data['sj']->namakonsumen }}</div>
                        
                        <div class="info-label">Alamat:</div>
                        <div class="info-value">{{ $data['sj']->alamat }}</div>
                    </div>
                </div>
            </div>
            
            <div class="info-block">
                <div class="info-header">INFORMASI DOKUMEN</div>
                <div class="info-content">
                    <div class="info-grid">
                        <div class="info-label">No. PO:</div>
                        <div class="info-value">{{ $data['inv']->po_req }}</div>
                        
                        <div class="info-label">No. Performa Invoice:</div>
                        <div class="info-value bold">{{ $data['sj']->invoice }}</div>
                        
                        <div class="info-label">Tgl Invoice:</div>
                        <div class="info-value">{{ $data['inv']->tanggal }}</div>
                        
                        <div class="info-label">Tgl Pengiriman:</div>
                        <div class="info-value">{{ $data['sj']->tgl_kirim }}</div>
                        
                        <div class="info-label">Keterangan:</div>
                        <div class="info-value bold">{{ $data['sj']->keterangan }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="items-table-container">
            <table class="items-table">
                <thead>
                    <tr>
                        <th class="center" style="width: 5%;">NO</th>
                        <th>BARANG/JASA DAN SPESIFIKASI</th>
                        <th class="center" style="width: 8%;">QTY</th>
                        <th class="center" style="width: 10%;">SATUAN</th>
                        <th style="width: 18%;">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['detail'] as $index => $barang)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td class="center">{{ $barang->qty }}</td>
                        <td class="center">{{ $barang->satuan }}</td>
                        <td>{{ $barang->keterangan ?? ' ' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="notes-section">
            <div class="notes-box">
                <div class="notes-header">CATATAN</div>
                <div class="notes-content">
                    <!-- Catatan kosong seperti di template asli -->
                </div>
            </div>
            
            <div class="notes-box">
                <div class="notes-header">PERHATIAN</div>
                <div class="notes-content">
                    <ul class="notes-list">
                        <li>Surat Jalan ini merupakan bukti resmi penerimaan barang</li>
                        <li>Surat Jalan ini bukan bukti penjualan</li>
                        <li>Surat Jalan ini akan dilengkapi Invoice sebagai bukti penjualan</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="confirmation">
            <strong>BARANG SUDAH DITERIMA DALAM KEADAAN CUKUP DAN BAIK oleh:</strong>
            <br>
            (tanda tangan dan cap (stempel) perusahaan)
        </div>
        
        <div class="signatures">
            <div class="signature-box">
                <p class="signature-title">Penerima</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-box">
                <p class="signature-title">Sopir</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-box">
                <p class="signature-title">Admin</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-box">
                <p class="signature-title">Warehouse</p>
                <div class="signature-line"></div>
            </div>
            <div class="signature-box">
                <p class="signature-title">Satpam</p>
                <div class="signature-line"></div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins') }}/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins') }}/jquery-ui/jquery-ui.min.js"></script>
</body>
</html>