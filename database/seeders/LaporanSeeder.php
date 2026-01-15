<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 50 data laporan dummy
        // Pastikan tabel users, events, dan pesan_grup sudah di-seed sebelumnya
        // agar factory tidak membuat data baru secara berlebihan.
        Laporan::factory()->count(50)->create();
    }
}