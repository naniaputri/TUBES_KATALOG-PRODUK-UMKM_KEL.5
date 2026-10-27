<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    private function aturan(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:100',
            'nama_umkm'   => 'required|string|max:100',
            'harga'       => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'status'      => 'required|in:tersedia,habis',
            'foto'        => 'nullable|array|max:5',
            'foto.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto'  => 'nullable|array',
            'hapus_foto.*'=> 'integer',
        ];
    }

    private function pesan(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists'   => 'Kategori tidak valid.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max'      => 'Nama produk maksimal 100 karakter.',
            'nama_umkm.required'   => 'Nama UMKM wajib diisi.',
            'nama_umkm.max'        => 'Nama UMKM maksimal 100 karakter.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.integer'        => 'Harga harus berupa bilangan bulat.',
            'harga.min'            => 'Harga tidak boleh kurang dari 0.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa bilangan bulat.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
            'status.required'      => 'Status wajib dipilih.',
            'status.in'            => 'Status hanya boleh Tersedia atau Habis.',
            'foto.max'             => 'Maksimal 5 foto sekali unggah.',
            'foto.*.image'         => 'Setiap file harus berupa gambar.',
            'foto.*.mimes'         => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.*.max'           => 'Ukuran tiap foto maksimal 2 MB.',
            'foto.*.uploaded'      => 'Foto gagal diunggah. Ukuran terlalu besar.',
        ];
    }

    private function simpanFoto(Request $request, Produk $produk): void
    {
        foreach ($request->file('foto', []) as $file) {
            $path = $file->store('produk', 'public');
            $produk->fotos()->create(['path' => $path]);
        }
    }

    // KATALOG UNTUK PENGUNJUNG
    public function katalog(Request $request)
    {
        $produks = Produk::with(['kategori', 'fotos'])
            ->when($request->filled('cari'), function ($q) use ($request) {
                $cari = $request->cari;

                $q->where(function ($sub) use ($cari) {
                    $sub->where('nama_produk', 'like', "%{$cari}%")
                        ->orWhere('nama_umkm', 'like', "%{$cari}%");
                });
            })
            ->when($request->filled('kategori'), function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('katalog.index', compact('produks', 'kategoris'));
    }

    // DAFTAR PRODUK ADMIN
    public function index(Request $request)
    {
        $produks = Produk::with(['kategori', 'fotos'])
            ->when($request->cari, fn ($q, $cari) => $q->cari($cari))
            ->when($request->kategori, fn ($q, $kat) => $q->where('kategori_id', $kat))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('produk.index', compact('produks', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        $produk = Produk::create(
            Arr::except($data, ['foto', 'hapus_foto'])
        );

        $this->simpanFoto($request, $produk);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load(['kategori', 'fotos']);

        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $produk->load('fotos');
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        $produk->update(
            Arr::except($data, ['foto', 'hapus_foto'])
        );

        // Hapus foto lama yang dipilih
        if ($request->filled('hapus_foto')) {
            $produk->fotos()
                ->whereIn('id', $request->hapus_foto)
                ->get()
                ->each(function ($foto) {
                    Storage::disk('public')->delete($foto->path);
                    $foto->delete();
                });
        }

        // Simpan foto baru
        $this->simpanFoto($request, $produk);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        foreach ($produk->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}