<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class dbrekanan extends Model
{
    use HasFactory;
    public $table="dbrekanan";
    protected $fillable = [
        'id','nama', 'perusahaan','telp_wa'
      ];
}
