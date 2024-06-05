<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekanan extends Model
{
    use HasFactory;
    public $table='rekanan';
    protected $fillable = [
        'kode','nama', 'mitra','telp', 'alamat','wa','nama_perusahaan','email','fax','marketing','bank1','bank2','nib','npwp'
      ];
}
