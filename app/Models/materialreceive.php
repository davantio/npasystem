<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialreceive extends Model
{
    use HasFactory;
    public $table="materialreceive";
    protected $fillable = [
        'kode','transaksi','perusahaan', 'tanggal','surat_jalan','keterangan', 'status'
      ];
}
