<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kota;
use App\Models\Kategori;
use App\Models\Badge;
use App\Models\User;
use App\Models\Berita;
use App\Models\Komunitas;
use App\Models\Events;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ISI DATA KOTA
        // $daftar_kota = ['Sleman', 'Bantul', 'Yogyakarta', 'Kulon Progo', 'Gunung Kidul'];
        // foreach ($daftar_kota as $k) {
        //     kota::create(['nama' => $k]);
        // }

        // // 3. ISI DATA BADGE (LENCANA)
        // badge::create([
        //     'nama' => 'Warga Teladan',
        //     'deskripsi' => 'Diberikan untuk user dengan skor kepercayaan tinggi',
        //     'xp_bonus' => 500,
        //     'image_url' => 'badges/teladan.png'
        // ]);

        // badge::create([
        //     'nama' => 'Pioneer',
        //     'deskripsi' => 'Diberikan untuk pembuat komunitas pertama',
        //     'xp_bonus' => 1000,
        //     'image_url' => 'badges/pioneer.png'
        // ]);

        // // 4. ISI DATA USER (ADMIN & MEMBER CONTOH)
        // // Dibuat agar kamu bisa langsung login untuk ngetes
        // $admin = User::create([
        //     'nama' => 'Admin Pusat',
        //     'email' => 'admin@mail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'admin',
        //     'xp_terkini' => 0,
        //     'level_terkini' => 1,
        //     'skor_kepercayaan' => 100,
        //     'terpercaya' => true,
        // ]);

        // User::factory(10)->create();
        Berita::factory()->count(20)->create();  
        // Komunitas::factory()->count(20)->create();
        // Events::factory()->count(20)->create();

        // $kategori = [
        //     [
        //         'nama' => 'Literasi & Penulisan',
        //         'icon_url' => 'image/icon/literasi.png', // Sesuaikan path icon Anda
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Seni & Desain',
        //         'icon_url' => 'image/icon/seni.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Teknologi & Coding',
        //         'icon_url' => 'image/icon/teknologi.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Gaming & E-Sports',
        //         'icon_url' => 'image/icon/gaming.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Kesehatan Mental',
        //         'icon_url' => 'image/icon/kesehatan.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Gaya Hidup Solo',
        //         'icon_url' => 'image/icon/solo.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Akademik & Sains',
        //         'icon_url' => 'image/icon/akademik.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Pop Culture',
        //         'icon_url' => 'image/icon/popculture.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // DB::table('kategori')->insert($kategori);

        // $kota = [
        //     [
        //         'nama' => 'Kota Yogyakarta',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Kabupaten Sleman',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Kabupaten Bantul',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Kabupaten Kulon Progo',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Kabupaten Gunungkidul',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // DB::table('kota')->insert($kota);

    }
}