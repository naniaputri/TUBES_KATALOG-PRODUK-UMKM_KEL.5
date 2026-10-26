@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h1 class="h3 fw-bold mb-1">Edit Produk</h1>
<p class="text-muted">Ubah data produk, lalu perbarui katalog.</p>

@if ($errors->any())
    <div class="alert alert-danger">Ada {{ $errors->count() }} isian yang perlu diperbaiki.</div>
@endif

<div class="card card-body">
    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('produk._form')

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-hijau">Perbarui Produk</button>
            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection 