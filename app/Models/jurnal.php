<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurnal extends Model
{
    use HasFactory;
    public $table="jurnal";
    protected $fillable = [
        'kode_transaksi','perusahaan','akun_debit','akun_kredit','kode_brg','kode_gdg','kode_marketing','kode_rekanan','ongkir','qty_debit','harga_debit','jumlah_debit','hpp_debit','qty_kredit','harga_kredit','jumlah_kredit','hpp_kredit','vat','status'
      ];
}
