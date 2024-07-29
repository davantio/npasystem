<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstansiTender extends Model
{
    use HasFactory;
    public $table = "instansi_tender";
    protected $primaryKey = 'id_instansi';
    protected $fillable = [
        'nama_instansi', 'warna'
    ];
}
