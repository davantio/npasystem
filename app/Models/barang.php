<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    public $table="barang";
    protected $fillable = [
        'kode','nama', 'jenis','satuan','packing','perusahaan','kd_persediaan','kd_persediaan_hpp','kd_pendapatan','kd_persediaan_intransit','keterangan'
      ];
}
