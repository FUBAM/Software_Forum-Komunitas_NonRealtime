<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kota;
use App\Models\Kategori;
use App\Models\Badge;
use App\Models\User;
use App\Models\Berita;
use App\Models\Komunitas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ISI DATA KOTA
        // $daftar_kota = ['Sleman', 'Bantul', 'Yogyakarta', 'Kulon Progo', 'Gunung Kidul'];
        // foreach ($daftar_kota as $k) {
        //     kota::create(['nama' => $k]);
        // }

        // // 2. ISI DATA KATEGORI
        // $daftar_kategori = [
        //     ['nama' => 'Teknologi', 'icon_url' => 'icons/tech.png'],
        //     ['nama' => 'Lingkungan', 'icon_url' => 'icons/nature.png'],
        //     ['nama' => 'Olahraga', 'icon_url' => 'icons/sport.png'],
        //     ['nama' => 'Seni & Budaya', 'icon_url' => 'icons/art.png'],
        // ];
        // foreach ($daftar_kategori as $kat) {
        //     kategori::create($kat);
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

        // User::factory(50)->create();
        
        // 5. ISI DATA KOMUNITAS CONTOH
        // Menyambungkan ke kota_id 1 (Sleman) dan kategori_id 1 (Teknologi)
        // komunitas::create([
        //     'kota_id' => 1,
        //     'kategori_id' => 1,
        //     'pembuat_id' => $admin->id,
        //     'nama' => 'Komunitas IT Sleman',
        //     'deskripsi' => 'Wadah berbagi ilmu teknologi di area Sleman.',
        //     'icon_url' => 'communities/it-sleman.png'
        // ]);


        $data = [
            [
                'judul' => 'Festival Budaya Sleman 2026: Merajut Tradisi di Era Digital',
                'konten' => 'Kabupaten Sleman kembali menggelar festival budaya tahunan yang kali ini mengusung tema digitalisasi tradisi untuk menarik minat kaum muda introvert agar tetap berpartisipasi dalam pelestarian budaya.',
                'gambar_url' => 'image/img (1).jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Workshop Coding Jogja: Membangun Karir Backend dari Rumah',
                'konten' => 'Komunitas IT Yogyakarta menyelenggarakan workshop khusus bagi para pengembang backend. Acara ini dirancang nyaman bagi introvert dengan metode komunikasi berbasis teks selama sesi berlangsung.',
                'gambar_url' => 'image/img (2).jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Turnamen E-sports Bantul: Ruang Kompetisi Aman Tanpa Tekanan Sosial',
                'konten' => 'ZHIB Community menghadirkan kompetisi e-sports regional Bantul. Fokus utama adalah memberikan ruang bagi gamer yang ingin berkompetisi tanpa harus merasa tertekan oleh interaksi sosial yang berlebihan.',
                'gambar_url' => 'image/img (3).jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Tips Menemukan Komunitas yang Tepat bagi Introvert di Yogyakarta',
                'konten' => 'Menjadi introvert bukan berarti tidak bisa berkomunitas. Simak panduan mencari lingkaran pertemanan yang sesuai dengan kapasitas energi sosial Anda melalui fitur ZHIB.',
                'gambar_url' => 'image/img (4).jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Pameran Seni Kulon Progo: Keindahan dalam Kesunyian',
                'konten' => 'Pameran seni rupa di Kulon Progo ini menawarkan konsep galeri yang tenang, sangat cocok bagi Anda yang ingin menikmati karya seni tanpa hiruk-pikuk keramaian.',
                'gambar_url' => 'image/img (5).jpg',
                'status' => 'draft',
            ],
            [
                'judul' => 'Gathering Komunitas Literasi Gunungkidul di Pantai Wediombo',
                'konten' => 'Membaca bersama sambil menikmati deburan ombak. Gathering kali ini berfokus pada diskusi santai dan apresiasi karya tulis anggota komunitas lokal DIY.',
                'gambar_url' => 'image/img (6).jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Update Fitur ZHIB v1.0: Sistem Gamifikasi Kini Lebih Menantang',
                'konten' => 'Kami memperbarui sistem XP dan Trust Score. Sekarang, berpartisipasi dalam event akan memberikan badge unik yang bisa ditampilkan di profil Hall of Fame Anda.',
                'gambar_url' => 'image/img (7).jpg',
                'status' => 'published',
            ],
        ];

        foreach ($data as $item) {
            Berita::create([
                'user_id' => 1, // Semuanya di-assign ke Admin (ID 1)
                'judul' => $item['judul'],
                'slug' => Str::slug($item['judul']),
                'konten' => $item['konten'],
                'gambar_url' => $item['gambar_url'], // Mengarah ke public/image/ sesuai struktur aset Anda
                'status' => $item['status'],
            ]);
        }
    }
}