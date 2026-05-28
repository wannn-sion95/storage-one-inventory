<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Database tiruan for categories
        Category::create(['nama_kategori' => 'Elektronik']);
        Category::create(['nama_kategori' => 'Pakaian & Tekstil']);
        Category::create(['nama_kategori' => 'Makanan & Minuman']);
        Category::create(['nama_kategori' => 'Peralatan Kantor & Sekolah']);
        Category::create(['nama_kategori' => 'Kesehatan & Kecantikan']);
        Category::create(['nama_kategori' => 'Olahraga & Outdoor']);
    }
}
