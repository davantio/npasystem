<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_so extends Model
{
    use HasFactory;
    public $table="detail_so";
    protected $fillable = [
        'kode_so','kode_brg','nama_request', 'harga','qty','dpp','hpp','vat','keterangan','total','debit','kredit'
      ];
}
