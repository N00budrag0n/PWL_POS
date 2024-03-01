<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 11,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 15,
            ],
            [
                'barang_id' => 12,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 10,
            ],
            [
                'barang_id' => 13,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 18,
            ],
            [
                'barang_id' => 14,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 8,
            ],
            [
                'barang_id' => 15,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 21,
            ],
            [
                'barang_id' => 16,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 19,
            ],
            [
                'barang_id' => 17,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 25,
            ],
            [
                'barang_id' => 18,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 36,
            ],
            [
                'barang_id' => 19,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 14,
            ],
            [
                'barang_id' => 20,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 7,
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}
