
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KatalogUMKM')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --hijau: #216b4b;
            --hijau-gelap: #174f37;
            --latar: #f4f5f1;
            --teks: #26352d;
            --garis: #e5e9e3;
        }

        body {
            background: var(--latar);
            color: var(--teks);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            min-height: 62px;
            background: #fff;
            border-bottom: 1px solid var(--garis);
            box-shadow: 0 2px 8px rgba(30, 60, 40, 0.03);
        }

        .navbar-brand {
            color: var(--hijau) !important;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .brand-icon {
            display: inline-flex;
            width: 25px;
            height: 25px;
            align-items: center;
            justify-content: center;
            margin-right: 6px;
            border-radius: 6px;
            background: var(--hijau);
            color: white;
            font-size: 13px;
        }

        .nav-link {
            color: #66736b;
            font-size: 13px;
            padding: 9px 13px !important;
            border-radius: 7px;
            margin-right: 4px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--hijau) !important;
            background: #eaf3ed;
        }

        .admin-badge {
            background: #fff4d8;
            color: #986b13;
            border-radius: 20px;
            padding: 7px 11px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Area konten */
        main.container {
            flex: 1;
            padding-top: 28px;
            padding-bottom: 36px;
        }

        h1, h2, h3 {
            color: #26382d;
        }

        .text-muted {
            color: #7b857d !important;
        }

        /* Tombol */
        .btn-hijau {
            background: var(--hijau);
            color: #fff;
            border: 1px solid var(--hijau);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .btn-hijau:hover,
        .btn-hijau:focus {
            background: var(--hijau-gelap);
            color: #fff;
            border-color: var(--hijau-gelap);
        }

        .btn {
            border-radius: 6px;
        }

        .btn-sm {
            font-size: 11px;
        }

        /* Card dan form */
        .card {
            background: #fff;
            border: 1px solid var(--garis);
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(30, 60, 40, 0.025);
        }

        .form-control,
        .form-select,
        .input-group-text {
            border-color: #dfe5de;
            border-radius: 6px;
            font-size: 13px;
            min-height: 38px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #75a98b;
            box-shadow: 0 0 0 3px rgba(33, 107, 75, 0.1);
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #405247;
        }

        /* Tabel produk */
        .tabel-produk {
            font-size: 12px;
        }

        .tabel-produk thead th,
        .table thead th {
            background: #f7f8f5;
            color: #657168;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
            padding: 13px 10px;
            border-bottom: 1px solid var(--garis);
        }

        .tabel-produk tbody td,
        .table tbody td {
            padding: 12px 10px;
            border-color: #edf0eb;
        }

        .tabel-produk tbody tr:hover,
        .table-hover tbody tr:hover {
            background: #f8fbf8;
        }

        .nama-produk {
            color: #293c30;
            font-weight: 600;
        }

        /* Foto produk */
        .foto-produk,
        .foto-placeholder {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 7px;
        }

        .foto-produk {
            object-fit: cover;
            border: 1px solid #e8ebe5;
        }

        .foto-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf0e7;
            color: #66816b;
            font-size: 21px;
        }

        /* Badge */
        .kategori-badge {
            background: #edf3e7;
            color: #537343;
            font-size: 10px;
            font-weight: 600;
            padding: 5px 8px;
        }

        .status-tersedia {
            background: #e1f3e7;
            color: #237447;
            font-size: 10px;
            padding: 5px 8px;
        }

        .status-habis {
            background: #fde9e6;
            color: #b53e32;
            font-size: 10px;
            padding: 5px 8px;
        }

        /* Notifikasi */
        .alert {
            border: 0;
            border-radius: 8px;
            font-size: 13px;
        }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
            gap: 3px;
        }

        .pagination .page-link {
            border-color: var(--garis);
            border-radius: 5px;
            color: var(--hijau);
            font-size: 12px;
        }

        .pagination .active .page-link {
            background: var(--hijau);
            border-color: var(--hijau);
            color: #fff;
        }

        /* Footer */
        footer {
            background: transparent;
            border-top: 1px solid #e5e9e3;
            padding: 15px 12px;
            color: #879087;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 768px) {
            main.container {
                padding: 20px 14px 28px;
            }

            .navbar-brand {
                font-size: 15px;
            }

            .tabel-produk,
            .table {
                min-width: 850px;
            }

            .navbar .admin-badge {
                display: inline-block;
                margin: 8px 0;
            }
        }
    </style>
</head>

<body>


{{-- Navbar utama --}}
<nav class="navbar navbar-expand-md sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center"
           href="{{ route('katalog.index') }}">
            <span class="brand-icon">▦</span>
            KatalogUMKM
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuUtama"
            aria-controls="menuUtama"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav me-auto ms-md-3">
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('katalog.index', 'katalog.show') ? 'active fw-bold' : '' }}"
                        href="{{ route('katalog.index') }}"
                    >
                        Katalog Produk
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('produk.index', 'produk.edit') ? 'active fw-bold' : '' }}"
                            href="{{ route('produk.index') }}"
                        >
                            Kelola Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->routeIs('produk.create') ? 'active fw-bold' : '' }}"
                            href="{{ route('produk.create') }}"
                        >
                            Tambah Produk
                        </a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="admin-badge">
                        <span class="me-1">●</span> Admin
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-hijau btn-sm px-3 py-2">
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

    {{-- Konten halaman --}}
    <main class="container">
        @if (session('success'))
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"
                ></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"
                ></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        KatalogUMKM &middot; Proyek Laravel
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
