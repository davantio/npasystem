<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_mr extends Model
{
    use HasFactory;
    public $table="detail_mr";
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode','kode_mr', 'kode_brg','kode_gdg','harga', 'dikirim', 'diakui','diterima','ongkir','dpp','vat','total','keterangan','kode_debit','kode_kredit'
      ];
}
