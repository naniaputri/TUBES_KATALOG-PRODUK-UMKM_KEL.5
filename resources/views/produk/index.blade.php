
@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="text-muted small mb-1">Produk / Daftar Produk</div>
        <h1 class="h3 fw-bold mb-1">Daftar Produk</h1>
        <p class="text-muted mb-0">
            Kelola produk UMKM, lihat detail, ubah, dan hapus data.
        </p>
    </div>

    <a href="{{ route('produk.create') }}" class="btn btn-hijau px-3 py-2">
        <span class="me-1">+</span> Tambah Produk
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan.</strong>
        Periksa kembali data yang kamu masukkan.
    </div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('produk.index') }}">
            <div class="row g-2">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">⌕</span>
                        <input
                            type="search"
                            name="cari"
                            class="form-control"
                            placeholder="Cari nama produk atau nama UMKM..."
                            value="{{ request('cari') }}"
                        >
                    </div>
                </div>

                <div class="col-lg-3">
                    <select name="kategori" class="form-select">
                        <option value="">Semua kategori</option>
                        @foreach ($kategoris as $k)
                            <option
                                value="{{ $k->id }}"
                                {{ request('kategori') == $k->id ? 'selected' : '' }}
                            >
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-hijau flex-fill">
                        Cari Produk
                    </button>

                    @if (request('cari') || request('kategori'))
                        <a href="{{ route('produk.index') }}"
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
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h2 class="h6 fw-bold mb-1">Data Produk UMKM</h2>
                <p class="text-muted small mb-0">
                    Total {{ $produks->total() }} produk terdaftar
                </p>
            </div>
            <span class="badge rounded-pill text-bg-light border">
                Katalog Produk
            </span>
        </div>
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
                    <th class="text-center pe-3">Aksi</th>
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
                                    <div class="foto-placeholder">
                                        <span>▧</span>
                                    </div>
                                @endif

                                <div>
                                    <div class="fw-semibold nama-produk">
                                        {{ $produk->nama_produk }}
                                    </div>
                                    <div class="text-muted small">
                                        ID: {{ $produk->id }}
                                    </div>
                                </div>
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
                            <div class="d-flex justify-content-center gap-1">
                                <a
                                    href="{{ route('produk.show', $produk) }}"
                                    class="btn btn-sm btn-outline-success"
                                    title="Lihat detail"
                                >
                                    Lihat
                                </a>

                                <a
                                    href="{{ route('produk.edit', $produk) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Edit produk"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('produk.destroy', $produk) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus produk"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="fs-2 mb-2">▧</div>
                            <div class="fw-semibold">Produk belum ditemukan</div>
                            <p class="text-muted small mb-3">
                                Coba ubah kata pencarian atau tambahkan produk baru.
                            </p>
                            <a href="{{ route('produk.create') }}"
                               class="btn btn-hijau btn-sm">
                                + Tambah Produk
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($produks->hasPages())
        <div class="card-footer bg-white border-0 px-3 py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <small class="text-muted">
                    Menampilkan {{ $produks->firstItem() ?? 0 }}–{{ $produks->lastItem() ?? 0 }}
                    dari {{ $produks->total() }} produk
                </small>

                {{ $produks->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
