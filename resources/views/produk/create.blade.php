@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h1 class="h3 fw-bold mb-1">Tambah Produk</h1>
<p class="text-muted">Isi data produk UMKM, lalu simpan ke katalog.</p>

@if ($errors->any())
    <div class="alert alert-danger">Ada {{ $errors->count() }} isian yang perlu diperbaiki.</div>
@endif

<div class="card card-body">
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('produk._form')

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-hijau">Simpan Produk</button>
            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection 