<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
    use HasFactory;
    public $table="pengiriman";
    protected $fillable = [
        'id','nama', 'jenis','asal','tujuan','prov_tujuan','kg','l','ton','pickup','cdd','fuso','tronton','created_at','updated_at'
      ];
}
