<?php

namespace App\Imports;

use App\Models\db_marketing;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DBmarketingImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new db_marketing([
            //
           'kode'           => $row[0],
           'kategori'       => $row[1],
           'nama_perusahaan'=> $row[2],
           'alamat_kantor'  => $row[3], 
           'alamat_pabrik'  => $row[4],
           'telp_wa'        => $row[5], 
           'email'          => $row[6],
           'orang_dalam'    => $row[7], 
           'medsos'         => $row[8],
           'kebutuhuan'     => $row[9],
           'PIC'            => $row[10], 
           'keterangan'     => $row[11],
           'status'         => $row[12],
        ]);
    }
}
