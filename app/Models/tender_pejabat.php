<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender_pejabat extends Model
{
    use HasFactory;
    public $table="tender_pejabat";
    protected $fillable = [
        'id','instansi','nama', 'jabatan','telp', 'alamat','hobby','sosmed','keterangan','foto'
      ];
}
