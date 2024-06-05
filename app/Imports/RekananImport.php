<?php

namespace App\Imports;

use App\Models\rekanan;
use Maatwebsite\Excel\Concerns\ToModel;

class RekananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new rekanan([
            //
           'kode'     => $row[0],
           'nama'    => $row[1], 
           'wa'     => $row[2],
           'nama_perusahaan'    => $row[3], 
           'telp'     => $row[4],
           'bank'    => $row[5], 
           'email'     => $row[6],
           'alamat'      =>$row[7],
        ]);
    }
}
