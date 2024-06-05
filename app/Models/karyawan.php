<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class karyawan extends Model
{
    use HasFactory;
    public $table="karyawan";
    protected $fillable = [
        'kode','nama', 'ttl','telp','username','role', 'alamat','divisi','lokasi','password','status'
      ];
}
