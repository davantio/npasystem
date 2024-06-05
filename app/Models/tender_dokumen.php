<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender_dokumen extends Model
{
    use HasFactory;
    public $table="tender_dokumen";
    protected $fillable = [
        'tender_id', 'nama','keterangan','siap'
      ];
}
