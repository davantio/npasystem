<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerkas extends Model
{
    use HasFactory;

    protected $table = 'detail_berkas';
    protected $primaryKey = 'id_berkas';
    protected $fillable = ['id_research', 'file'];

    public function research()
    {
        return $this->belongsTo(Research::class, 'id_research');
    }
}
