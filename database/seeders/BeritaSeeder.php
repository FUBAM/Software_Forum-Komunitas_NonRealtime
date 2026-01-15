<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Berita::factory()->count(6)->create();  
    }
}
