<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;
    public $table="bank";
    protected $fillable = [
        'kode','bank', 'rekening','atas_nama'
      ];
}
