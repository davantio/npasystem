<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class image extends Model
{
    use HasFactory;
    public $table="library_image";
    protected $fillable = [
        'nama', 'url'
      ];
}
