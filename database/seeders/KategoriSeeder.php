<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $daftar = ['Makanan', 'Minuman', 'Kerajinan', 'Fashion', 'Pertanian'];

        foreach ($daftar as $nama) {
            Kategori::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}