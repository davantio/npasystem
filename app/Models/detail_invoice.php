<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_invoice extends Model
{
    use HasFactory;
    public $table="detail_invoice";
    protected $fillable = [
        'kode','kode_inv', 'kode_brg','kode_gdg','tgl_kirim','tgl_diterima','harga_jual', 'dikirim', 'diakui','nama_request','dpp'.'hpp','jumlah','keterangan','debit','kredit',
      ];
}
