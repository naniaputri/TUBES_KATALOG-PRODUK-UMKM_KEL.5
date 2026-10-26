@extends('layouts.app')

@section('title', $produk->nama_produk)

@section('content')
<nav class="mb-3 small">
    <a href="{{ route('produk.index') }}" class="text-success fw-semibold text-decoration-none">Produk</a>
    <span class="text-muted"> / {{ $produk->nama_produk }}</span>
</nav>

<div class="card card-body">
    <div class="row g-4">
        <div class="col-lg-6">
            @if ($produk->fotos->count())
                <div id="galeri" class="carousel slide">
                    <div class="carousel-inner rounded">
                        @foreach ($produk->fotos as $foto)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $foto->path) }}" class="d-block w-100"
                                     alt="Foto {{ $loop->iteration }} {{ $produk->nama_produk }}"
                                     style="height: 380px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @if ($produk->fotos->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#galeri" data-bs-slide="prev" aria-label="Sebelumnya">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galeri" data-bs-slide="next" aria-label="Berikutnya">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            @else
                <div class="rounded bg-light border d-flex align-items-center justify-content-center text-muted"
                     style="height: 380px;">Belum ada foto</div>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="mb-2">
                <span class="badge text-bg-light border">{{ $produk->kategori->nama_kategori }}</span>
                @if ($produk->status === 'tersedia')
                    <span class="badge bg-success">Tersedia</span>
                @else
                    <span class="badge bg-danger">Habis</span>
                @endif
            </div>

            <h1 class="h3 fw-bold mb-1">{{ $produk->nama_produk }}</h1>
            <p class="text-muted">oleh {{ $produk->nama_umkm }}</p>
            <p class="fs-2 fw-bold text-success mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

            <h2 class="h6 fw-bold">Deskripsi</h2>
            <p>{!! nl2br(e($produk->deskripsi ?: 'Belum ada deskripsi.')) !!}</p>

            <hr>
            <dl class="row mb-4">
                <dt class="col-sm-4">Stok</dt>
                <dd class="col-sm-8">{{ $produk->stok }} unit</dd>
                <dt class="col-sm-4">Ditambahkan</dt>
                <dd class="col-sm-8">{{ $produk->created_at->format('d M Y') }}</dd>
                <dt class="col-sm-4">Diperbarui</dt>
                <dd class="col-sm-8">{{ $produk->updated_at->format('d M Y') }}</dd>
            </dl>

            <div class="d-flex gap-2">
                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-hijau">Edit Produk</a>
                <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Kembali ke daftar</a>
            </div>
        </div>
    </div>
</div>
@endsection