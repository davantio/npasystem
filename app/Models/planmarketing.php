<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planmarketing extends Model
{
    use HasFactory;
    public $table="planmarketing";
    protected $fillable = [
        'kode','marketing', 'plan','awal','akhir','status', 'created_at'
      ];
}
