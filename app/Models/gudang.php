<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudang extends Model
{
    use HasFactory;
    public $table="gudang";
    protected $fillable = [
        'kode','nama', 'alamat'
      ];
}
