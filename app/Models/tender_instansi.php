<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender_instansi extends Model
{
    use HasFactory;
    public $table="tender_instansi";
    protected $fillable = [
        'id','nama','sub_instansi', 'link','email', 'username','password'
      ];
}
