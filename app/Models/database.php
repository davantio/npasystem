

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class database extends Model
{
    use HasFactory;
    public $table="database_marketing";
    protected $fillable = [
        'kode','kategori', 'nama_perusahaan','alamat_kantor','alamat_pabrik','wilayah',
        'telp_wa','email','orang_dalam','medsos','kebutuhan','PIC','keterangan','status'
      ];
}
