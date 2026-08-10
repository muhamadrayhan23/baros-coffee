@extends('layout.admin')

@section('title', 'Edit Foto Galeri')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.gallery.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Edit Foto Galeri</h2>
                <p class="text-xs opacity-65">Perbarui keterangan photo atau ganti file foto galeri.</p>
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

        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data"
            class="max-w-xl space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="caption" class="block text-sm font-semibold mb-2 text-coffee-bean">Keterangan Foto</label>
                <input id="caption" type="text" name="caption" value="{{ old('caption', $gallery->caption) }}" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="Contoh: Suasana roasting di pagi hari">
                @error('caption')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="foto" class="block text-sm font-semibold mb-2 text-coffee-bean">Ganti Foto Galeri</label>
                <input id="foto" type="file" name="foto"
                    class="w-full rounded-xl border border-coffee-bean/10 bg-frosted-blue/20 px-4 py-3 text-sm text-coffee-bean outline-none"
                    accept="image/*">
                <p class="mt-2 text-xs text-coffee-bean/70">Unggah hanya jika ingin mengganti foto saat ini.</p>
                @error('foto')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4">
                <div class="text-sm font-semibold text-coffee-bean">Preview Foto Saat Ini</div>
                @if ($gallery->foto)
                    <img src="{{ asset('gallery/' . $gallery->foto) }}" alt="{{ $gallery->caption }}"
                        class="mt-4 h-56 w-full rounded-3xl object-cover border border-coffee-bean/10">
                @else
                    <div class="mt-4 h-56 rounded-3xl bg-frosted-blue/20 flex items-center justify-center text-coffee-bean">
                        <ion-icon name="images-outline" class="text-4xl"></ion-icon>
                    </div>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Update</span>
                </button>
                <a href="{{ route('admin.gallery.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection
