<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
    // PENTING: Daftarkan semua kolom agar diizinkan masuk ke database
    protected $fillable = ['category_id', 'nama_produk', 'deskripsi', 'harga', 'stok', 'gambar'];

    // Relasi ke tabel Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
