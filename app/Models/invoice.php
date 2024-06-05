<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    public $table="invoice";
    protected $fillable = [
        'kode','perusahaan','tanggal', 'kode_so','kode_bank','kode_sj','po_req','vat','tgl_tempo','DP','keterangan','status'
      ];
}
