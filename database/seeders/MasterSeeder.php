<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kota;
use App\Models\kategori;
use App\Models\badge;
use App\Models\User;
use App\Models\komunitas;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ISI DATA KOTA
        $daftar_kota = ['Sleman', 'Bantul', 'Yogyakarta', 'Kulon Progo', 'Gunung Kidul'];
        foreach ($daftar_kota as $k) {
            kota::create(['nama' => $k]);
        }

        // 2. ISI DATA KATEGORI
        $daftar_kategori = [
            ['nama' => 'Teknologi', 'icon_url' => 'icons/tech.png'],
            ['nama' => 'Lingkungan', 'icon_url' => 'icons/nature.png'],
            ['nama' => 'Olahraga', 'icon_url' => 'icons/sport.png'],
            ['nama' => 'Seni & Budaya', 'icon_url' => 'icons/art.png'],
        ];
        foreach ($daftar_kategori as $kat) {
            kategori::create($kat);
        }

        // 3. ISI DATA BADGE (LENCANA)
        badge::create([
            'nama' => 'Warga Teladan',
            'deskripsi' => 'Diberikan untuk user dengan skor kepercayaan tinggi',
            'xp_bonus' => 500,
            'image_url' => 'badges/teladan.png'
        ]);

        badge::create([
            'nama' => 'Pioneer',
            'deskripsi' => 'Diberikan untuk pembuat komunitas pertama',
            'xp_bonus' => 1000,
            'image_url' => 'badges/pioneer.png'
        ]);

        // 4. ISI DATA USER (ADMIN & MEMBER CONTOH)
        // Dibuat agar kamu bisa langsung login untuk ngetes
        $admin = User::create([
            'nama' => 'Admin Pusat',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'xp_terkini' => 0,
            'level_terkini' => 1,
            'skor_kepercayaan' => 100,
            'terpercaya' => true,
        ]);

        $member = User::create([
            'nama' => 'User Pengetes',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'xp_terkini' => 100,
            'level_terkini' => 1,
            'skor_kepercayaan' => 50,
            'terpercaya' => false,
        ]);

        // 5. ISI DATA KOMUNITAS CONTOH
        // Menyambungkan ke kota_id 1 (Sleman) dan kategori_id 1 (Teknologi)
        komunitas::create([
            'kota_id' => 1,
            'kategori_id' => 1,
            'pembuat_id' => $admin->id,
            'nama' => 'Komunitas IT Sleman',
            'deskripsi' => 'Wadah berbagi ilmu teknologi di area Sleman.',
            'icon_url' => 'communities/it-sleman.png'
        ]);
    }
}