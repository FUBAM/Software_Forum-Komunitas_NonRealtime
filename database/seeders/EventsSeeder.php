<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Events;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Events::factory()->count(20)->create();
        
        // Pastikan User ID 1 (Admin/Pengusul) dan Kategori ID 1 ada di database Anda
        // Jika tidak, ganti angkanya dengan ID yang valid.
        $pengusulId = 1; 

        $events = [
            // 1. Event yang SUDAH SELESAI (Status: Finished, Tanggal: Lampau)
            [
                'id' => 21, // ID kita kunci jadi 21
                'kategori_id' => 3,
                'diusulkan_oleh' => $pengusulId,
                'type' => 'lomba',
                'judul' => 'Turnamen Mobile Legends Season 1',
                'deskripsi' => 'Turnamen yang sudah selesai dilaksanakan bulan lalu.',
                'berbayar' => true,
                'harga' => 50000,
                'poster_url' => 'image/events/events-default.png',
                'status' => 'finished',
                'start_date' => Carbon::now()->subMonth(), // 1 Bulan yang lalu
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2. Event yang BELUM SELESAI (Status: Published, Tanggal: Masa Depan)
            [
                'id' => 22, // ID kita kunci jadi 22
                'kategori_id' => 8,
                'diusulkan_oleh' => $pengusulId,
                'type' => 'kegiatan',

                'judul' => 'Workshop Laravel 11 untuk Pemula',
                'deskripsi' => 'Workshop coding yang akan datang minggu depan.',
                'berbayar' => false,
                'harga' => 75000,
                'poster_url' => 'image/events/events-default.png',
                'status' => 'published',
                'start_date' => Carbon::now()->addWeek(), // 1 Minggu lagi
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 23,
                'kategori_id' => 1,
                'diusulkan_oleh' => $pengusulId,
                'type' => 'kegiatan',
                'judul' => 'Seminar Public Speaking (Menunggu Klaim)',
                'deskripsi' => 'Event ini sudah selesai, silakan tes upload bukti di sini.',
                'berbayar' => false,
                'harga' => 0,
                'poster_url' => 'image/events/events-default.png',
                'status' => 'finished', // Status Selesai
                'start_date' => Carbon::now()->subDays(3), // 3 Hari yang lalu
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Gunakan insertOrIgnore agar tidak error jika ID sudah ada
        DB::table('events')->insertOrIgnore($events);
    }
}
