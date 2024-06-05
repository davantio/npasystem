<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class laporanpenjualan implements FromCollection
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    // public function headings(): array
    // {
    //     return [
    //         'tanggal_invoice',
    //         'invoice',
    //         'Customer',
    //         'Marketing',
    //         'Barang',
    //         'Qty',
    //         'Satuan',
    //         'Harga',
    //         'DPP',
    //         'PPN',
    //         'Penjualan',
    //         'Tgl Kirim',
    //         'Asal_Gudang',
    //         'Pembayaran 1',
    //         'Pembayaran 2',
    //         'Pembayaran 3',
    //         'Pembayaran 4',
    //         'Pembayaran 5',
    //         'VIA',
    //         'BANK',
    //         'Sisa_Piutang',
    //         'status',
    //         'Tgl Bayar 1',
    //         'Tgl Bayar 2',
    //         'Tgl Bayar 3',
    //         'Tgl Bayar 4',
    //         'Tgl Bayar 5',
    //         // ...
    //     ];
    // }
}