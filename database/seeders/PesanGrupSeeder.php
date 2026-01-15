<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesanGrup;

class PesanGrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 200 pesan dummy
        PesanGrup::factory()->count(200)->create();
    }
}