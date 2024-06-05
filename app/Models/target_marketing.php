<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class target_marketing extends Model
{
    use HasFactory;
    public $table="target_marketing";
    protected $fillable = [
        'id','kd_perusahaan', 'kd_marketing','tanggal','barang',
        'qty','harga','total'
      ];
}