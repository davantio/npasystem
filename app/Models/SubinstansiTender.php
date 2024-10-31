<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubinstansiTender extends Model
{

    use HasFactory;

    protected $table = 'subinstansi_tenders';
    protected $primaryKey = 'id_pengadaan';

    protected $fillable = [
        'id_subinstansi',
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
        'quantity',
        'informasi_kualifikasi',
        'pengadaan',
        'file_upload',
        'created_at',
        'updated_at'
    ];

    public function subinstansi()
    {
        return $this->belongsTo(Subinstansi::class, 'id_subinstansi');
    }
}
