<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah extends Model
{
    use HasFactory;
    public $table="wilayah_indonesia";
    protected $fillable = [
        'id','provinsi', 'kota','tipe','kecamatan','kodepos','created_at','updated_at'
      ];
}
