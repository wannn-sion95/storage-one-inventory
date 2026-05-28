@extends('layouts.master')

@section('title', 'Tambah Produk Baru')
@section('page-title', 'Tambah Produk Baru')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card-enterprise p-4">
                <form action="/products" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control py-2"
                            placeholder="Contoh: Laptop ASUS ROG" required>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Kategori <span
                                    class="text-danger">*</span></label>
                            <select name="category_id" class="form-select py-2" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-dark">Harga (Rp) <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control py-2" placeholder="0" min="0"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-dark">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control py-2" placeholder="0" min="0"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control py-2" rows="4"
                            placeholder="Tulis spesifikasi atau detail barang di sini..."></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold text-dark">Foto Produk (Opsional)</label>
                        <input type="file" name="gambar" class="form-control py-2" accept="image/*">
                        <div class="form-text mt-2">Format: JPG, PNG, WEBP. Maksimal 2MB.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="/products" class="btn btn-light border px-4 py-2 fw-medium">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-medium">
                            <i class="fa-solid fa-save me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
