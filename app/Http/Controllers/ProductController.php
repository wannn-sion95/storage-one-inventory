<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // 1. Nampilin semua daftar produk di dashboard
    public function index(Request $request)
    {
        // Tangkap kata kunci pencarian dari URL
        $search = $request->input('search');

        // Query ke database
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Mempertahankan parameter pencarian saat pindah halaman

        return view('products.index', compact('products'));
    }

    // 3. Memproses penyimpanan data produk baru ke database
    public function store(Request $request)
    {
        // Validasi ketat standar industri
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        $nama_file_gambar = null;

        // Logika mutakhir untuk handling upload file gambar produk
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Bikin nama file unik biar gak tabrakan (Contoh: 1716942123_laptop.jpg)
            $nama_file_gambar = time() . '_' . $file->getClientOriginalName();
            // Pindahkan file gambar asli ke folder 'public/uploads/products' di proyek kita
            $file->move(public_path('uploads/products'), $nama_file_gambar);
        }

        // Simpan data ke database lewat Model Product
        Product::create([
            'category_id' => $request->category_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'gambar'      => $nama_file_gambar,
        ]);

        // Lempar kembali ke halaman utama produk
        return redirect('/products')->with('success', 'Produk baru berhasil ditambahkan ke inventaris!');
    }

    // 4. Menampilkan halaman form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Cari produk, kalau gak ada langsung auto-404
        $categories = Category::all();       // Ambil kategori buat dropdown

        return view('products.edit', compact('product', 'categories'));
    }

    // 5. Memproses perubahan data (Update)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi data masukan
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|numeric|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ambil nama gambar lama dari database sebagai cadangan default
        $nama_file_gambar = $product->gambar;

        // JIKA USER UPLOAD GAMBAR BARU
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari folder public/uploads/products jika filenya ada
            if ($product->gambar && File::exists(public_path('uploads/products/' . $product->gambar))) {
                File::delete(public_path('uploads/products/' . $product->gambar));
            }

            // Upload gambar baru yang fresh
            $file = $request->file('gambar');
            $nama_file_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $nama_file_gambar);
        }

        // Update semua data ke database
        $product->update([
            'category_id' => $request->category_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'gambar'      => $nama_file_gambar,
        ]);
        return redirect('/products')->with('success', 'Detail produk berhasil diperbarui!');
    }

    // 6. Menghapus Produk total dari database & storage
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar fisiknya dari laptop biar gak nyampah
        if ($product->gambar && File::exists(public_path('uploads/products/' . $product->gambar))) {
            File::delete(public_path('uploads/products/' . $product->gambar));
        }

        // Hapus data dari baris tabel database MySQL
        $product->delete();

        return redirect('/products')->with('success', 'Produk berhasil dihapus dari gudang!');
    }
}
