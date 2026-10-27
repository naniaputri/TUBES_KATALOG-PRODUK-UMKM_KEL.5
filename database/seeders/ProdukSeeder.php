<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Makanan',   'Keripik Pisang Kepok 200g', 'Dapur Bu Ratna',        18000, 45, 'Keripik pisang kepok tipis, renyah dan gurih.', 'tersedia'],
            ['Minuman',   'Kopi Robusta Bubuk 250g',   'Kopi Rakyat Sejahtera', 42000, 28, 'Kopi robusta sangrai sedang, digiling halus.',  'tersedia'],
            ['Makanan',   'Sambal Roa Botol',          'Sambal Mak Nah',        35000,  0, 'Sambal ikan roa pedas khas Manado.',            'habis'],
            ['Kerajinan', 'Tas Anyaman Pandan',        'Kriya Pandan Lestari',  85000, 12, 'Tas anyaman pandan buatan tangan.',             'tersedia'],
            ['Fashion',   'Kemeja Batik Tulis',        'Batik Sekar Wangi',    275000,  6, 'Kemeja batik tulis motif parang.',              'tersedia'],
            ['Pertanian', 'Madu Hutan Murni 500ml',    'Madu Rimba Nusantara',  95000,  0, 'Madu hutan asli tanpa campuran gula.',          'habis'],
            ['Makanan',   'Dodol Durian',              'Dapur Bu Ratna',        30000, 33, 'Dodol durian legit dari durian lokal.',          'tersedia'],
            ['Minuman',   'Teh Jahe Merah Instan',     'Warung Herbal Pak Dedi',22000, 60, 'Teh jahe merah instan, hangat di badan.',       'tersedia'],
        ];

        foreach ($data as [$kategori, $nama, $umkm, $harga, $stok, $deskripsi, $status]) {
            Produk::create([
                'kategori_id' => Kategori::where('nama_kategori', $kategori)->first()->id,
                'nama_produk' => $nama,
                'nama_umkm'   => $umkm,
                'harga'       => $harga,
                'stok'        => $stok,
                'deskripsi'   => $deskripsi,
                'status'      => $status,
            ]);
        }
    }
}