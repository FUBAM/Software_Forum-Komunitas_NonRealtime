<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Komunitas;
use Illuminate\Database\Seeder;

class KomunitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Komunitas::factory()->count(20)->create();
    }
}
