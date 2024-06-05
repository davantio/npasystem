<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hpp extends Model
{
    use HasFactory;
    public $table="hpp";
    protected $fillable = [
        'tanggal','barang','qty','ongkir','total','hpp'
      ];
}
