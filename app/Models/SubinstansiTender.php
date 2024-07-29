<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubinstansiTender extends Model
{

    use HasFactory;

    protected $table = 'subinstansi_tenders';
    protected $primaryKey = 'id_subinstansi';

    protected $fillable = [
        'id_instansi',
        'nama_subinstansi',
        'perusahaan',
        'lokasi',
        'link_tender',
        'pic_tender',
        'contact_person',
        'jenis_tender',
        'skala',
        'tanggal_pengajuan',
        'tanggal_deadline',
        'tanggal_pengumuman',
        'status',
        'informasi_lawan',
        'kendala',
        'total_hps',
        'informasi_kualifikasi',
        'pengadaan',
        'created_at',
        'updated_at'
    ];

    public function instansi()
    {
        return $this->belongsTo(InstansiTender::class, 'id_instansi');
    }
}
