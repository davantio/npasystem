<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_sistem extends Model
{
    use HasFactory;
    public $table="log_system";
    protected $fillable = [
        'transaksi','user', 'keterangan'
      ];
}
