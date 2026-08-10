@extends('layout.admin')

@section('title', 'Ubah Produk')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.product.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Ubah Produk</h2>
                <p class="text-xs opacity-65">Perbarui informasi produk yang sudah ada.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-6 p-4 rounded-2xl bg-black-cherry/10 border border-black-cherry/20">
                <ul class="text-sm text-black-cherry space-y-2">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="max-w-3xl space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nama_produk" class="block text-sm font-semibold mb-2 text-coffee-bean">Nama Produk</label>
                    <input id="nama_produk" type="text" name="nama_produk"
                        value="{{ old('nama_produk', $product->nama_produk) }}" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40">
                    @error('nama_produk')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="harga" class="block text-sm font-semibold mb-2 text-coffee-bean">Harga</label>
                    <input id="harga" type="number" name="harga" value="{{ old('harga', $product->harga) }}"
                        min="0" step="1000" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean">
                    @error('harga')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berat" class="block text-sm font-semibold mb-2 text-coffee-bean">Berat</label>
                    <input id="berat" type="text" name="berat" value="{{ old('berat', $product->berat) }}" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean">
                    @error('berat')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="gambar" class="block text-sm font-semibold mb-2 text-coffee-bean">Gambar Produk Baru</label>
                <input id="gambar" type="file" name="gambar"
                    class="w-full rounded-xl border border-coffee-bean/10 bg-frosted-blue/20 px-4 py-3 text-sm text-coffee-bean outline-none"
                    accept="image/*">
                <p class="mt-2 text-xs text-coffee-bean/70">Unggah hanya jika ingin mengganti gambar yang sekarang.</p>
                @error('gambar')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            @if ($product->gambar)
                <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4">
                    <div class="text-sm font-semibold text-coffee-bean">Preview Gambar Saat Ini</div>
                    <img src="{{ asset('product/' . $product->gambar) }}" alt="{{ $product->nama_produk }}"
                        class="mt-4 h-56 w-full rounded-3xl object-cover border border-coffee-bean/10">
                </div>
            @endif

            <div>
                <label for="deskripsi" class="block text-sm font-semibold mb-2 text-coffee-bean">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input id="published" type="checkbox" name="published" value="1"
                    class="h-4 w-4 rounded border-coffee-bean text-coffee-bean focus:ring-coffee-bean"
                    {{ old('published', $product->published) ? 'checked' : '' }}>
                <label for="published" class="text-sm text-coffee-bean font-semibold">Produk dipublikasikan</label>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Update</span>
                </button>
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection
