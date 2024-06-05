<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class coba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'username'=>'Andreass',
                'level'=>'admin',
                'password'=> bcrypt('Nusapratama1'),
                'kode_karyawan'=> 'NPA.0003',
            ],
            [
                'username'=>'Hendry',
                'level'=>'marketing',
                'password'=> bcrypt('Nusapratama1'),
                'kode_karyawan'=> 'NPA.0002',
            ],
            [
                'username'=>'Vania',
                'level'=>'operasional',
                'password'=> bcrypt('Nusapratama1'),
                'kode_karyawan'=> 'NPA.0005',
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
