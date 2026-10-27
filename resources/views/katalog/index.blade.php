
@extends('layouts.app')

@section('title', 'Katalog Produk UMKM')

@section('content')
<div class="mb-4">
    <div class="text-muted small mb-1">Beranda / Katalog</div>
    <h1 class="h3 fw-bold mb-1">Katalog Produk UMKM</h1>
    <p class="text-muted mb-0">
        Temukan berbagai produk dari pelaku UMKM.
    </p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('katalog.index') }}">
            <div class="row g-2">
                <div class="col-lg-6">
                    <input
                        type="search"
                        name="cari"
                        class="form-control"
                        placeholder="Cari nama produk atau nama UMKM..."
                        value="{{ request('cari') }}"
                    >
                </div>

                <div class="col-lg-3">
                    <select name="kategori" class="form-select">
                        <option value="">Semua kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option
                                value="{{ $kategori->id }}"
                                {{ request('kategori') == $kategori->id ? 'selected' : '' }}
                            >
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-hijau flex-fill">
                        Cari Produk
                    </button>

                    @if (request('cari') || request('kategori'))
                        <a href="{{ route('katalog.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-header bg-white border-0 px-3 pt-3 pb-2">
        <h2 class="h6 fw-bold mb-1">Daftar Produk</h2>
        <p class="text-muted small mb-0">
            Total {{ $produks->total() }} produk
        </p>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 tabel-produk">
            <thead>
                <tr>
                    <th class="ps-3">No.</th>
                    <th>Produk</th>
                    <th>Nama UMKM</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th class="pe-3">Detail</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($produks as $produk)
                    <tr>
                        <td class="ps-3 text-muted">
                            {{ $produks->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if ($produk->fotos->isNotEmpty())
                                    <img
                                        src="{{ asset('storage/' . $produk->fotos->first()->path) }}"
                                        alt="{{ $produk->nama_produk }}"
                                        class="foto-produk"
                                    >
                                @else
                                    <div class="foto-placeholder">▧</div>
                                @endif

                                <span class="fw-semibold nama-produk">
                                    {{ $produk->nama_produk }}
                                </span>
                            </div>
                        </td>

                        <td>{{ $produk->nama_umkm }}</td>

                        <td>
                            <span class="badge kategori-badge">
                                {{ $produk->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <td class="fw-semibold text-nowrap">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </td>

                        <td>{{ $produk->stok }}</td>

                        <td>
                            @if ($produk->status === 'tersedia')
                                <span class="badge status-tersedia">
                                    ● Tersedia
                                </span>
                            @else
                                <span class="badge status-habis">
                                    ● Habis
                                </span>
                            @endif
                        </td>

                        <td class="pe-3">
                            <a
                                href="{{ route('katalog.show', $produk) }}"
                                class="btn btn-sm btn-outline-success"
                            >
                                Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="fw-semibold">Produk belum ditemukan</div>
                            <p class="text-muted small mb-0">
                                Coba kata pencarian atau kategori lain.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($produks->hasPages())
        <div class="card-footer bg-white border-0 px-3 py-3">
            {{ $produks->links() }}
        </div>
    @endif
</div>
@endsection
