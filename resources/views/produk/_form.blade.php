<div class="row g-3">
    <div class="col-md-6">
        <label for="kategori_id" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
        <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
            <option value="">Pilih kategori</option>
            @foreach ($kategoris as $k)
                <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="nama_produk" class="form-label fw-semibold">Nama produk <span class="text-danger">*</span></label>
        <input type="text" name="nama_produk" id="nama_produk"
               class="form-control @error('nama_produk') is-invalid @enderror"
               value="{{ old('nama_produk', $produk->nama_produk ?? '') }}">
        @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="nama_umkm" class="form-label fw-semibold">Nama UMKM <span class="text-danger">*</span></label>
        <input type="text" name="nama_umkm" id="nama_umkm"
               class="form-control @error('nama_umkm') is-invalid @enderror"
               value="{{ old('nama_umkm', $produk->nama_umkm ?? '') }}">
        @error('nama_umkm') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text">Rp</span>
            <input type="number" name="harga" id="harga"
                   class="form-control @error('harga') is-invalid @enderror"
                   value="{{ old('harga', $produk->harga ?? '') }}">
            @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
        <input type="number" name="stok" id="stok"
               class="form-control @error('stok') is-invalid @enderror"
               value="{{ old('stok', $produk->stok ?? '') }}">
        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold d-block">Status <span class="text-danger">*</span></label>
        @php $status = old('status', $produk->status ?? 'tersedia'); @endphp
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="st1" value="tersedia" {{ $status === 'tersedia' ? 'checked' : '' }}>
            <label class="form-check-label" for="st1">Tersedia</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="st2" value="habis" {{ $status === 'habis' ? 'checked' : '' }}>
            <label class="form-check-label" for="st2">Habis</label>
        </div>
        @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-muted fw-normal">(opsional)</span></label>
        <textarea name="deskripsi" id="deskripsi" rows="4"
                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="foto" class="form-label fw-semibold">Foto produk <span class="text-muted fw-normal">(opsional, maks. 5 foto, 2 MB per foto)</span></label>
        <input type="file" name="foto[]" id="foto" multiple accept="image/*"
               class="form-control @error('foto') is-invalid @enderror @error('foto.*') is-invalid @enderror">
        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @foreach ($errors->get('foto.*') as $pesanFoto)
            <div class="text-danger small">{{ $pesanFoto[0] }}</div>
        @endforeach
        <div class="form-text">Tahan tombol Ctrl untuk memilih lebih dari satu foto.</div>
    </div>

    @if (isset($produk) && $produk->fotos->count())
        <div class="col-12">
            <label class="form-label fw-semibold">Foto saat ini <span class="text-muted fw-normal">(centang untuk menghapus)</span></label>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($produk->fotos as $foto)
                    <label class="border rounded p-2 text-center" style="width: 130px; cursor: pointer;">
                        <img src="{{ asset('storage/' . $foto->path) }}" alt="Foto {{ $produk->nama_produk }}"
                             class="img-fluid rounded mb-2" style="height: 90px; width: 100%; object-fit: cover;">
                        <div class="form-check d-flex justify-content-center gap-1">
                            <input class="form-check-input" type="checkbox" name="hapus_foto[]" value="{{ $foto->id }}">
                            <span class="small">Hapus</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    @endif
</div> 