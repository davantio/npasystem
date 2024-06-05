<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_po extends Model
{
    use HasFactory;
    public $table="detail_po";
    protected $fillable = [
        'kode_po','kode_brg', 'ongkir','harga','qty','keterangan','jumlah','rate', 
      ];
}
