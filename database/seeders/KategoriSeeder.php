<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
              'kategori_kode' => 'MM',
              'kategori_nama' => 'Makanan dan Minuman',
              'created_at' => now(),
            ],
            [
              'kategori_kode' => 'KK',
              'kategori_nama' => 'Kesehatan dan Kecantikan',
              'created_at' => now(),
            ],
            [
              'kategori_kode' => 'RTK',
              'kategori_nama' => 'Rumah Tangga dan Kebersihan',
              'created_at' => now(),
            ],
            [
              'kategori_kode' => 'BA',
              'kategori_nama' => 'Bayi dan Anak-anak',
              'created_at' => now(),
            ],
            [
              'kategori_kode' => 'HP',
              'kategori_nama' => 'Hewan Peliharaan',
              'created_at' => now(),
            ],
          ];
  
          DB::table('m_kategori')->insert($data);
    }
}
