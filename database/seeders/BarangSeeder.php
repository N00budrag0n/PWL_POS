<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_kode' => 'B001',
                'barang_nama' => 'Aqua 250ml',
                'kategori_id' => 1,
                'harga_beli' => 1500,
                'harga_jual' => 3500,
            ],
            [
                'barang_kode' => 'B002',
                'barang_nama' => 'Chitato 80g',
                'kategori_id' => 1,
                'harga_beli' => 6000,
                'harga_jual' => 10000,
            ],
            [
                'barang_kode' => 'B003',
                'barang_nama' => 'Wardah',
                'kategori_id' => 2,
                'harga_beli' => 8000,
                'harga_jual' => 12000,
            ],
            [
                'barang_kode' => 'B004',
                'barang_nama' => 'Nivea Deodorant',
                'kategori_id' => 2,
                'harga_beli' => 4000,
                'harga_jual' => 7000,
            ],
            [
                'barang_kode' => 'B005',
                'barang_nama' => 'Wipol 250ml',
                'kategori_id' => 3,
                'harga_beli' => 7000,
                'harga_jual' => 8000,
            ],
            [
                'barang_kode' => 'B006',
                'barang_nama' => 'So Klin Bubuk 500g',
                'kategori_id' => 3,
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_kode' => 'B007',
                'barang_nama' => 'Mamy Poko Small',
                'kategori_id' => 4,
                'harga_beli' => 8000,
                'harga_jual' => 12000,
            ],
            [
                'barang_kode' => 'B008',
                'barang_nama' => 'Mamy Poko Large',
                'kategori_id' => 4,
                'harga_beli' => 12000,
                'harga_jual' => 16000,
            ],
            [
                'barang_kode' => 'B009',
                'barang_nama' => 'Wiskas Original 100g',
                'kategori_id' => 5,
                'harga_beli' => 20000,
                'harga_jual' => 25000,
            ],
            [
                'barang_kode' => 'B010',
                'barang_nama' => 'Wiskas Original 200g',
                'kategori_id' => 5,
                'harga_beli' => 25000,
                'harga_jual' => 30000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
