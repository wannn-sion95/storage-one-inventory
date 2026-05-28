@extends('layouts.master')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Data Produk')

@section('content')
    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card-enterprise p-4">
                <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control py-2"
                            value="{{ $product->nama_produk }}" required>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Kategori <span
                                    class="text-danger">*</span></label>
                            <select name="category_id" class="form-select py-2" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-dark">Harga (Rp) <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control py-2" value="{{ $product->harga }}"
                                min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-dark">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control py-2" value="{{ $product->stok }}"
                                min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control py-2" rows="4">{{ $product->deskripsi }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold text-dark d-block">Foto Produk Saat Ini</label>
                        @if ($product->gambar)
                            <img src="{{ asset('uploads/products/' . $product->gambar) }}"
                                class="rounded border mb-3 object-fit-cover" width="100" height="100">
                        @else
                            <div class="bg-light rounded border mb-3 d-flex align-items-center justify-content-center text-muted"
                                style="width: 100px; height: 100px; font-size: 0.8rem;">
                                No Image
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control py-2" accept="image/*">
                        <div class="form-text mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="/products" class="btn btn-light border px-4 py-2 fw-medium">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-medium">
                            <i class="fa-solid fa-check me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
