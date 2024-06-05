<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class vendor extends Model
{
    use HasFactory;
    public $table="vendor";
    protected $fillable = [
        'nama', 'produk','telepon','alamat','keterangan'
      ];
}
