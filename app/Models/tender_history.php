<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender_history extends Model
{
    use HasFactory;
    public $table="tender_history";
    protected $fillable = [
        'tender_id', 'perusahaan','harga', 'tender','keterangan','menang'
      ];
}
