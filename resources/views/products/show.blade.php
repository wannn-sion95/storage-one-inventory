@extends('layouts.master')

@section('title', $product->nama_produk)
@section('page-title', 'Detail Produk')

@push('styles')
    <style>
        /* ── Detail Grid ─────────────────────────────────────── */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 991px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Panel ──────────────────────────────────────────── */
        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: background .3s;
        }

        .panel-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .panel-title {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-heading);
            margin: 0;
        }

        .panel-body {
            padding: 24px;
        }

        /* ── Product Hero ────────────────────────────────────── */
        .product-hero {
            display: flex;
            gap: 24px;
            align-items: flex-start;
            margin-bottom: 28px;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }

        @media (max-width: 575px) {
            .product-hero {
                flex-direction: column;
            }
        }

        .hero-image {
            width: 160px;
            height: 160px;
            border-radius: var(--radius);
            object-fit: cover;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .hero-placeholder {
            width: 160px;
            height: 160px;
            border-radius: var(--radius);
            background: var(--accent-muted);
            border: 1px dashed var(--accent);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
            gap: 8px;
            font-size: .78rem;
        }

        .hero-info {
            flex: 1;
            min-width: 0;
        }

        .hero-category {
            display: inline-block;
            background: var(--accent-muted);
            color: var(--accent);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .hero-name {
            font-family: 'Fraunces', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 8px;
            line-height: 1.3;
        }

        .hero-desc {
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin: 0 0 16px;
        }

        .hero-meta {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        /* ── Info Grid ───────────────────────────────────────── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        @media (max-width: 575px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-item {}

        .info-item-label {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .info-item-value {
            font-size: .925rem;
            font-weight: 600;
            color: var(--text-heading);
        }

        /* ── Stock Gauge ─────────────────────────────────────── */
        .stock-gauge-wrap {
            margin-bottom: 20px;
        }

        .gauge-label {
            display: flex;
            justify-content: space-between;
            font-size: .8rem;
            margin-bottom: 8px;
        }

        .gauge-label .val {
            font-family: 'Fraunces', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1;
        }

        .gauge-label .unit {
            color: var(--text-muted);
            font-size: .78rem;
        }

        .gauge-bar {
            height: 8px;
            background: var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        .gauge-fill {
            height: 100%;
            border-radius: 8px;
            transition: width .6s cubic-bezier(.4, 0, .2, 1);
        }

        /* Badge status (shared) */
        .so-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .72rem;
            font-weight: 700;
        }

        .so-badge__dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .so-badge--green {
            background: var(--green-muted);
            color: var(--green);
        }

        .so-badge--yellow {
            background: var(--yellow-muted);
            color: var(--yellow);
        }

        .so-badge--red {
            background: var(--red-muted);
            color: var(--red);
        }

        /* ── Price card ──────────────────────────────────────── */
        .price-card {
            background: var(--accent-muted);
            border: 1px solid var(--accent);
            border-radius: var(--radius-sm);
            padding: 16px;
            text-align: center;
            margin-bottom: 16px;
        }

        .price-label {
            font-size: .72rem;
            color: var(--accent);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 4px;
        }

        .price-value {
            font-family: 'Fraunces', serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-heading);
        }

        /* ── Action buttons ──────────────────────────────────── */
        .action-stack {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-full {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px;
            border-radius: var(--radius-sm);
            font-size: .875rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            border: none;
            width: 100%;
        }

        .btn-full--edit {
            background: var(--accent);
            color: #fff;
        }

        .btn-full--edit:hover {
            background: var(--accent-hover);
            color: #fff;
            box-shadow: 0 4px 16px var(--accent-glow);
            transform: translateY(-1px);
        }

        .btn-full--outline {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .btn-full--outline:hover {
            background: var(--surface);
            color: var(--text);
        }

        .btn-full--danger {
            background: var(--red-muted);
            color: var(--red);
            border: 1px solid var(--red);
        }

        .btn-full--danger:hover {
            background: var(--red);
            color: #fff;
        }

        /* ── Meta dates ──────────────────────────────────────── */
        .date-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: .8rem;
        }

        .date-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .date-row .dk {
            color: var(--text-muted);
        }

        .date-row .dv {
            color: var(--text-heading);
            font-weight: 600;
        }

        /* ── Modal ───────────────────────────────────────────── */
        .modal-content {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: var(--radius) !important;
            color: var(--text) !important;
        }

        .modal-header,
        .modal-footer {
            border-color: var(--border) !important;
        }

        .modal-danger-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--red-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .btn-cancel-modal {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            font-size: .845rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all .18s;
        }

        .btn-cancel-modal:hover {
            background: var(--surface);
        }

        .btn-danger-so {
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            font-size: .845rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-danger-so:hover {
            opacity: .88;
        }
    </style>
@endpush

@section('content')

    @php
        $stok = $product->stok;

        // Status
        if ($stok == 0) {
            $badgeClass = 'so-badge--red';
            $badgeLabel = 'Habis';
            $gaugeColor = 'var(--red)';
            $gaugeWidth = 0;
        } elseif ($stok <= 10) {
            $badgeClass = 'so-badge--yellow';
            $badgeLabel = 'Kritis';
            $gaugeColor = 'var(--yellow)';
            $gaugeWidth = max(5, min(30, $stok * 3));
        } else {
            $badgeClass = 'so-badge--green';
            $badgeLabel = 'Aman';
            $gaugeColor = 'var(--green)';
            $gaugeWidth = min(100, $stok);
        }
    @endphp

    {{-- Back breadcrumb --}}
    <div class="d-flex align-items-center gap-2 mb-4" style="font-size:.82rem; color:var(--text-muted);">
        <a href="{{ route('products.index') }}"
            style="color:var(--text-muted); display:flex; align-items:center; gap:5px; transition:color .18s;"
            onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
        <i class="fa-solid fa-chevron-right" style="font-size:.65rem;"></i>
        <span style="color:var(--accent);">{{ $product->nama_produk }}</span>
    </div>

    <div class="detail-grid">

        {{-- ── Main Info ──────────────────────────────────── --}}
        <div>
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">Informasi Produk</h2>
                    <div style="font-size:.75rem; color:var(--text-muted);">
                        ID: <strong style="color:var(--text-heading);">#{{ $product->id }}</strong>
                    </div>
                </div>
                <div class="panel-body">

                    {{-- Hero --}}
                    <div class="product-hero">
                        @if ($product->gambar && file_exists(public_path('uploads/products/' . $product->gambar)))
                            <img src="{{ asset('uploads/products/' . $product->gambar) }}" alt="{{ $product->nama_produk }}"
                                class="hero-image">
                        @else
                            <div class="hero-placeholder">
                                <i class="fa-solid fa-image" style="font-size:2rem;"></i>
                                <span>Tidak ada foto</span>
                            </div>
                        @endif

                        <div class="hero-info">
                            @if ($product->category)
                                <div class="hero-category">{{ $product->category->nama_kategori }}</div>
                            @endif
                            <h3 class="hero-name">{{ $product->nama_produk }}</h3>
                            @if ($product->deskripsi)
                                <p class="hero-desc">{{ $product->deskripsi }}</p>
                            @else
                                <p class="hero-desc" style="font-style:italic;">Tidak ada deskripsi.</p>
                            @endif
                            <div class="hero-meta">
                                <span class="so-badge {{ $badgeClass }}">
                                    <span class="so-badge__dot"></span>
                                    {{ $badgeLabel }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Info grid --}}
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-label">Harga Satuan</div>
                            <div class="info-item-value" style="font-family:'Fraunces',serif; font-size:1.1rem;">
                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Jumlah Stok</div>
                            <div class="info-item-value" style="font-family:'Fraunces',serif; font-size:1.1rem;">
                                {{ number_format($product->stok) }}
                                <span
                                    style="font-size:.8rem; color:var(--text-muted); font-family:'Plus Jakarta Sans',sans-serif; font-weight:400;">
                                    unit</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Nilai Inventaris</div>
                            <div class="info-item-value">
                                Rp{{ number_format($product->harga * $product->stok, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label">Kategori</div>
                            <div class="info-item-value">
                                {{ $product->category->nama_kategori ?? '—' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Sidebar ──────────────────────────────────────── --}}
        <div>

            {{-- Stock Card --}}
            <div class="panel mb-4">
                <div class="panel-header">
                    <h2 class="panel-title">Status Stok</h2>
                </div>
                <div class="panel-body">

                    <div class="stock-gauge-wrap">
                        <div class="gauge-label">
                            <div>
                                <div class="val">{{ number_format($stok) }}</div>
                                <div class="unit">unit tersedia</div>
                            </div>
                            <span class="so-badge {{ $badgeClass }}">
                                <span class="so-badge__dot"></span>
                                {{ $badgeLabel }}
                            </span>
                        </div>
                        <div class="gauge-bar">
                            <div class="gauge-fill" style="width:{{ $gaugeWidth }}%; background:{{ $gaugeColor }};">
                            </div>
                        </div>
                        @if ($stok == 0)
                            <div
                                style="font-size:.75rem; color:var(--red); margin-top:6px; display:flex; align-items:center; gap:5px;">
                                <i class="fa-solid fa-rotate-right"></i> Segera lakukan restock.
                            </div>
                        @elseif($stok <= 10)
                            <div
                                style="font-size:.75rem; color:var(--yellow); margin-top:6px; display:flex; align-items:center; gap:5px;">
                                <i class="fa-solid fa-triangle-exclamation"></i> Stok hampir habis, pertimbangkan restock.
                            </div>
                        @else
                            <div
                                style="font-size:.75rem; color:var(--green); margin-top:6px; display:flex; align-items:center; gap:5px;">
                                <i class="fa-solid fa-circle-check"></i> Stok dalam kondisi aman.
                            </div>
                        @endif
                    </div>

                    {{-- Price card --}}
                    <div class="price-card">
                        <div class="price-label">Harga Satuan</div>
                        <div class="price-value">Rp{{ number_format($product->harga, 0, ',', '.') }}</div>
                    </div>

                    {{-- Actions --}}
                    <div class="action-stack">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-full btn-full--edit">
                            <i class="fa-solid fa-pen"></i> Edit Produk
                        </a>
                        <a href="{{ route('products.index') }}" class="btn-full btn-full--outline">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <button type="button" class="btn-full btn-full--danger" onclick="openDeleteModal()">
                            <i class="fa-solid fa-trash"></i> Hapus Produk
                        </button>
                    </div>

                </div>
            </div>

            {{-- Dates --}}
            <div class="panel">
                <div class="panel-header">
                    <h2 class="panel-title">Riwayat Data</h2>
                </div>
                <div class="panel-body" style="padding:16px 24px;">
                    <div class="date-row">
                        <span class="dk">Dibuat</span>
                        <span class="dv">{{ $product->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="date-row">
                        <span class="dk">Terakhir diperbarui</span>
                        <span class="dv">{{ $product->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="date-row">
                        <span class="dk">ID Produk</span>
                        <span class="dv">#{{ $product->id }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-danger-icon"><i class="fa-solid fa-trash"></i></div>
                        <div>
                            <h5 class="modal-title mb-1" style="font-family:'Fraunces',serif;color:var(--text-heading);">
                                Hapus Produk?
                            </h5>
                            <div style="font-size:.78rem;color:var(--text-muted);">
                                Tindakan ini permanen dan tidak bisa dibatalkan.
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="filter:invert(.5);"></button>
                </div>
                <div class="modal-body" style="padding:20px 24px;">
                    <p style="font-size:.875rem;color:var(--text-muted);margin:0;line-height:1.6;">
                        Kamu yakin ingin menghapus
                        <strong style="color:var(--text-heading);">{{ $product->nama_produk }}</strong>?
                        File gambar juga akan dihapus dari server.
                    </p>
                </div>
                <div class="modal-footer border-0 pt-0" style="padding:0 24px 20px;gap:8px;">
                    <button class="btn-cancel-modal" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-so">
                            <i class="fa-solid fa-trash"></i> Hapus Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openDeleteModal() {
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endpush
