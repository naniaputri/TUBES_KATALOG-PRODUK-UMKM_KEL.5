
@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h1 class="h4 fw-bold mb-2">Login Admin</h1>
                <p class="text-muted mb-4">
                    Masuk untuk mengelola produk UMKM.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="form-check mb-3">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="form-check-input"
                            value="1"
                        >
                        <label for="remember" class="form-check-label">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-hijau w-100">
                        Login
                    </button>

                    <a href="{{ route('katalog.index') }}"
                       class="btn btn-outline-secondary w-100 mt-2">
                        Kembali ke Katalog
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
