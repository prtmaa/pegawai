<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            'nip' => 'N000001',
            'nama'    => STR::RANDOM(20),
            'jabatan'    => 'Back end',
            'tgl_lahir' => '01-01-2000',
            'umur' => 24,
            'alamat' => 'Jawa Tengah',
            'foto' => 'default.png'
        ]);
    }
}
