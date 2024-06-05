<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aksi_dbmarketing extends Model
{
    use HasFactory;
    public $table="aksi_dbmarketing";
    protected $fillable = [
        'id','kd_perusahaan', 'kd_marketing','tanggal','jam',
        'laporan','status'
      ];
}
