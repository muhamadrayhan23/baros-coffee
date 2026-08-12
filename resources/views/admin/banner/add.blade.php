@extends('layout.admin')

@section('title', 'Tambah Banner')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.banner.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Tambah Banner</h2>
                <p class="text-xs opacity-65">Unggah gambar banner untuk carousel beranda.</p>
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

        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-xl space-y-6">
            @csrf

            <div>
                <label for="nama_banner" class="block text-sm font-semibold mb-2 text-coffee-bean">Judul Banner</label>
                <input id="nama_banner" type="text" name="nama_banner" value="{{ old('nama_banner') }}" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="Contoh: Promo Kopi Spesial">
                @error('nama_banner')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gambar" class="block text-sm font-semibold mb-2 text-coffee-bean">Gambar Banner</label>
                <input id="gambar" type="file" name="gambar" required
                    class="w-full rounded-xl border border-coffee-bean/10 bg-frosted-blue/20 px-4 py-3 text-sm text-coffee-bean outline-none"
                    accept="image/*">
                @error('gambar')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input id="published" type="checkbox" name="published" value="1"
                    class="h-4 w-4 rounded border-coffee-bean text-coffee-bean focus:ring-coffee-bean">
                <label for="published" class="text-sm text-coffee-bean font-semibold">Publish banner sekarang</label>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('admin.banner.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection
