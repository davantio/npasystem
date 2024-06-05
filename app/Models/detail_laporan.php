<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_laporan extends Model
{
    use HasFactory;
    public $table="detail_laporan";
    protected $fillable = [
        'kode','kode_laporan','jenis','jam','rekanan','perusahaan','laporan'
      ];
}

