<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchasing extends Model
{
    use HasFactory;
    public $table="purchasing";
    protected $fillable = [
        'db_marketing','nama', 'nomor','sosial_media','alamat','hobby','makanan'
      ];
}
