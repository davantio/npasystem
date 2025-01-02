<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'research';
    protected $primaryKey = 'id_research';
    protected $fillable = ['kode_produk', 'nama_produk', 'bahan_baku', 'proses_produksi', 'hpp', 'foto_produk', 'kemasan'];

    public function detailBerkas()
    {
        return $this->hasMany(DetailBerkas::class, 'id_research');
    }
}
