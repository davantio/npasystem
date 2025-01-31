<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kas extends Model
{
    use HasFactory;
    public $table = "kas";
    protected $fillable = [
        'kode',
        'tanggal',
        'bank',
        'dk',
        'keterangan',
        'status',
        'jenis',
        'kode_ref',
        'barang',
        'atas_nama',
        'dpp',
        'ppn',
        'jumlah',
        'debit',
        'kredit'
    ];
}
