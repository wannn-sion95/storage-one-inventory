@extends('layouts.master')

@section('title', 'Dashboard Storage One')
@section('page-title', 'Welcome to Dashboard')

@section('content')
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-end mb-4">
            <a href="/products/create" class="btn btn-primary fw-medium px-4 py-2 rounded-pill shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Tambah Produk
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm d-flex align-items-center mb-4"
                role="alert">
                <i class="fa-solid fa-circle-check fs-5 me-2"></i>
                <span class="fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="input-group shadow-sm" style="max-width: 400px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama barang atau kategori..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary fw-medium" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="d-flex justify-content-end mt-4">
            {{ $products->links() }}
        </div>

        <div class="card-enterprise overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap">
                    <thead class="bg-light text-muted"
                        style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3 fw-semibold border-0">Produk</th>
                            <th class="py-3 fw-semibold border-0">Kategori</th>
                            <th class="py-3 fw-semibold border-0">Harga</th>
                            <th class="py-3 fw-semibold border-0 text-center">Stok</th>
                            <th class="pe-4 py-3 fw-semibold border-0 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($product->gambar)
                                            <img src="{{ asset('uploads/products/' . $product->gambar) }}"
                                                class="rounded object-fit-cover" width="48" height="48">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="fa-solid fa-image text-muted fs-5"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">{{ $product->nama_produk }}</p>
                                            <p class="mb-0 text-muted small text-truncate" style="max-width: 200px;">
                                                {{ $product->deskripsi }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3"><span
                                        class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle px-2 py-1">{{ $product->category->nama_kategori ?? 'Umum' }}</span>
                                </td>
                                <td class="py-3 fw-medium">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td class="py-3 text-center">
                                    @if ($product->stok <= 5)
                                        <span
                                            class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-2 py-1"><i
                                                class="fa-solid fa-circle-exclamation me-1"></i> {{ $product->stok }}
                                            Pcs</span>
                                    @else
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-2 py-1"><i
                                                class="fa-solid fa-check me-1"></i> {{ $product->stok }} Pcs</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    <a href="/products/{{ $product->id }}/edit"
                                        class="btn btn-sm btn-light text-primary border me-1"><i
                                            class="fa-solid fa-pen"></i></a>
                                    <form action="/products/{{ $product->id }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger border"
                                            onclick="return confirm('Hapus data ini?')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-box-open fs-2 mb-2"></i>
                                    <p class="mb-0">Belum ada data inventaris.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
