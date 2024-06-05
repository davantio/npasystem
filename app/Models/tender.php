<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender extends Model
{
    use HasFactory;
    public $table="tender";
    protected $fillable = [
        'instansi','perusahaan','jenis','nama','skala','lokasi','link','pic','pendaftaran','status'
      ];
}
