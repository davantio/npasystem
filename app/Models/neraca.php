<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class neraca extends Model
{
    use HasFactory;
    public $table = "neraca";
    protected $fillable = [
        'kode',
        'akun',
        'perusahaan',
        'jumlah',
        'debit',
        'kredit',
        'status',
        'tanggal',
        'keterangan'
    ];
}
