<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseorder extends Model
{
    use HasFactory;
    public $table="purchaseorder";
    protected $fillable = [
        'kode','perusahaan','tanggal', 'jenis','supplier', 'pembayaran','spk','time_delivery','term_payment','vat','status','keterangan'
      ];
}
