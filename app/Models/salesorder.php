<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesorder extends Model
{
    use HasFactory;
    public $table="salesorder";
    protected $fillable = [
        'kode','perusahaan','tanggal', 'jenis','konsumen', 'pembayaran','marketing','no_po','tgl_diterima','term_payment','vat','keterangan','status'
      ];
}
