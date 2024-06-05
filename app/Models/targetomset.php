<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targetomset extends Model
{
    use HasFactory;
    public $table="omset";
    protected $fillable = [
        'id','kd_karyawan', 'bulan','target','purchasing','plan_penjualan','omset','purchasing_baru',
      ];
}