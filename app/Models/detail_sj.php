<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_sj extends Model
{
    use HasFactory;
    public $table="detail_sj";
    protected $fillable = [
        'kode_sj','kode_gdg','kode_brg','nama_request','diakui','dikirim','diterima','ongkir','keterangan','debit','kredit'
      ];
}
