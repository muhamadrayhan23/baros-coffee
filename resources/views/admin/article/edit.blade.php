@extends('layout.admin')

@section('title', 'Edit Artikel')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.article.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Edit Artikel</h2>
                <p class="text-xs opacity-65">Perbarui informasi artikel dan thumbnail yang tampil di halaman publik.</p>
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

        <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data"
            class="max-w-xl space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block text-sm font-semibold mb-2 text-coffee-bean">Judul Artikel</label>
                <input id="judul" type="text" name="judul" value="{{ old('judul', $article->judul) }}" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="Contoh: Tips Menikmati Kopi di Pagi Hari">
                @error('judul')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isi" class="block text-sm font-semibold mb-2 text-coffee-bean">Isi Artikel</label>
                <textarea id="isi" name="isi" rows="8" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="Tulis isi artikel di sini...">{{ old('isi', $article->isi) }}</textarea>
                @error('isi')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-semibold mb-2 text-coffee-bean">Thumbnail Artikel
                    Baru</label>
                <input id="thumbnail" type="file" name="thumbnail" accept="image/*"
                    class="w-full rounded-xl border border-coffee-bean/10 bg-frosted-blue/20 px-4 py-3 text-sm text-coffee-bean outline-none">
                <p class="mt-2 text-xs text-coffee-bean/70">Unggah hanya jika ingin mengganti thumbnail yang sekarang.</p>
                @error('thumbnail')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            @if ($article->thumbnail)
                <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4">
                    <div class="text-sm font-semibold text-coffee-bean">Preview Thumbnail Saat Ini</div>
                    @php
                        $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                        $imageUrl = $article->thumbnail
                            ? (Str::startsWith($article->thumbnail, ['http://', 'https://'])
                                ? $article->thumbnail
                                : $baseUrl . '/' . ltrim($article->thumbnail, '/'))
                            : asset('assets/home/home 2.png');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}"
                        onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                        class="mt-4 h-56 w-full rounded-3xl object-cover border border-coffee-bean/10">
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Update</span>
                </button>
                <a href="{{ route('admin.article.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection
