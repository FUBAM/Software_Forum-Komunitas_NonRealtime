<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua ID dari tabel komunitas
        // Pastikan Anda sudah melakukan seeding untuk tabel komunitas sebelumnya
        $komunitasIds = DB::table('komunitas')->pluck('id');

        if ($komunitasIds->isEmpty()) {
            $this->command->warn('Tidak ada data Komunitas. Harap seed tabel komunitas terlebih dahulu.');
            return;
        }

        $dataGrup = [];

        foreach ($komunitasIds as $id) {
            // A. Grup Obrolan Umum (Tipe Chat, Semua member bisa kirim pesan)
            $dataGrup[] = [
                'komunitas_id' => $id,
                'nama'         => 'Obrolan Umum',
                'type'         => 'chat',
                'is_read_only' => false, // Member bisa chat
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            // B. Grup Info Event (Tipe Events, Hanya Admin/ReadOnly)
            $dataGrup[] = [
                'komunitas_id' => $id,
                'nama'         => 'Info Event & Lomba',
                'type'         => 'events',
                'is_read_only' => true, // Hanya admin yang bisa post (biasanya)
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        // Masukkan data ke database
        DB::table('grup')->insert($dataGrup);
    }
}