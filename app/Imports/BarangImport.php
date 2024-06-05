<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            //
           'kode'     => $row[0],
           'nama'    => $row[1], 
           'jenis'     => $row[2],
           'satuan'    => $row[3], 
           'packing'     => $row[4],
           'perusahaan'    => $row[5], 
           'kd_persediaan'     => $row[6],
           'kd_persediaan_hpp'    => $row[7], 
           'kd_pendapatan'      =>$row[8],
           'kd_persediaan_intransit'     => $row[9],
           'keterangan'    => $row[10], 
        ]);
    }
}
