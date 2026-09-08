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
                <!-- Quill Editor Container -->
                <div id="editor-isi" class="bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl overflow-hidden text-sm text-coffee-bean placeholder-coffee-bean/40">
                    {!! old('isi', $article->isi) !!}
                </div>
                <textarea id="isi" name="isi" class="hidden">{{ old('isi', $article->isi) }}</textarea>
                @error('isi')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <style>
                /* Custom style for Quill to match the design */
                .ql-toolbar.ql-snow {
                    border-top-left-radius: 0.75rem;
                    border-top-right-radius: 0.75rem;
                    border-color: rgba(34, 15, 7, 0.1) !important;
                    background-color: rgba(173, 232, 244, 0.2);
                }
                .ql-container.ql-snow {
                    border-bottom-left-radius: 0.75rem;
                    border-bottom-right-radius: 0.75rem;
                    border-color: rgba(34, 15, 7, 0.1) !important;
                    background-color: rgba(173, 232, 244, 0.2);
                    font-family: 'Inconsolata', ui-sans-serif, system-ui, sans-serif !important;
                    font-size: 0.875rem !important;
                    color: #220F07 !important;
                }
                .ql-editor {
                    min-height: 200px;
                }
                .ql-editor.ql-blank::before {
                    color: rgba(34, 15, 7, 0.4) !important;
                    font-style: normal !important;
                    content: "Tulis isi artikel di sini..." !important;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const editorEl = document.querySelector('#editor-isi');
                    const textareaEl = document.querySelector('#isi');
                    if (editorEl && textareaEl && window.Quill) {
                        const quill = new window.Quill('#editor-isi', {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{ 'header': [1, 2, 3, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    ['link', 'clean']
                                ]
                            }
                        });

                        // Synchronize Quill editor content with hidden textarea
                        quill.on('text-change', function() {
                            let html = quill.root.innerHTML;
                            if (html === '<p><br></p>') {
                                html = '';
                            }
                            textareaEl.value = html;
                        });
                        
                        // Initial sync
                        let html = quill.root.innerHTML;
                        if (html === '<p><br></p>') {
                            html = '';
                        }
                        textareaEl.value = html;
                    }
                });
            </script>

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
