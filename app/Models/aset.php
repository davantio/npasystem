<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aset extends Model
{
    use HasFactory;
    public $table="aset";
    protected $fillable = [
        'id','tipe', 'nama','tgl_pembelian','foto', 'harga_beli', 'jumlah', 'lokasi', 'kondisi', 'no_mesin', 'no_rangka', 'plat_nomor', 'keterangan'
      ];
}