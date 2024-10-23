<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subinstansi extends Model
{
    use HasFactory;
    public $table = "subinstansi";
    protected $primaryKey = 'id_subinstansi';
    protected $fillable = [
        'nama_subinstansi',
        'id_instansi',
        'warna',
        'status_priority'
    ];

    public function instansi()
    {
        return $this->belongsTo(InstansiTender::class, 'id_instansi');
    }
}
