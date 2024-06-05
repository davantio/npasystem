<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratjalan extends Model
{
    use HasFactory;
    public $table="suratjalan";
    protected $fillable = [
        'kode','perusahaan','jenis', 'tanggal','tipe', 'so','tgl_kirim','kota','alamat','tgl_diterima','nopol','ekspedisi','no_resi','status','keterangan',
      ];
}
