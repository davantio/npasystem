<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender_barang extends Model
{
    use HasFactory;
    public $table="tender_barang";
    protected $fillable = [
        'tender_id', 'nama','qty','satuan','hps','harga','ongkir','kegunaan','spec'
      ];
}
