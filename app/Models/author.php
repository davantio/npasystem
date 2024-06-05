<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    use HasFactory;
    public $table="author";
    protected $fillable = [
        'kode','kode_pembuat', 'kode_pemeriksa','transaksi','diperiksa'
      ];
}
