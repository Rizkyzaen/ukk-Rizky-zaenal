<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'Laravel for Beginners',
            'penulis' => 'Rizky Zaenal',
            'kategori' => 'Programming',
            'stok' => 1000
        ]);
    }
}
