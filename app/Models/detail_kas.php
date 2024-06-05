<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_kas extends Model
{
    use HasFactory;
    public $table="detail_kas";
    protected $fillable = [
        'kode_kas','kode_transaksi','kode_brg', 'harga','vat','qty','total','keterangan', 'debit','kredit'
      ];
}
