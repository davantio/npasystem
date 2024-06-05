<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kode_akuntansi extends Model
{
    use HasFactory;
    public $table="kodeakuntansi";
    protected $fillable = [
        'kode','nama_perkiraan', 'jenis','no_group','no_urut_group','no_urut_laporan','jenis_laporan', 'nama_group','keterangan','created_at','updated_at'
      ];
}
