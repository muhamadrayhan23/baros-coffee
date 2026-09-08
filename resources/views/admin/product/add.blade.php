@extends('layout.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.product.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Tambah Produk</h2>
                <p class="text-xs opacity-65">Isi informasi produk baru untuk ditampilkan di website.</p>
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

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-3xl space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nama_produk" class="block text-sm font-semibold mb-2 text-coffee-bean">Nama Produk</label>
                    <input id="nama_produk" type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                        placeholder="Contoh: Arabica House Blend">
                    @error('nama_produk')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="harga" class="block text-sm font-semibold mb-2 text-coffee-bean">Harga</label>
                    <input id="harga" type="number" name="harga" value="{{ old('harga') }}" min="0"
                        step="1000" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean">
                    @error('harga')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berat" class="block text-sm font-semibold mb-2 text-coffee-bean">Berat</label>
                    <input id="berat" type="text" name="berat" value="{{ old('berat') }}" required
                        class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean"
                        placeholder="Contoh: 250g">
                    @error('berat')
                        <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="gambar" class="block text-sm font-semibold mb-2 text-coffee-bean">Gambar Produk</label>
                <input id="gambar" type="file" name="gambar" required
                    class="w-full rounded-xl border border-coffee-bean/10 bg-frosted-blue/20 px-4 py-3 text-sm text-coffee-bean outline-none"
                    accept="image/*">
                @error('gambar')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold mb-2 text-coffee-bean">Deskripsi</label>
                <!-- Quill Editor Container -->
                <div id="editor-deskripsi" class="bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl overflow-hidden text-sm text-coffee-bean">
                    {!! old('deskripsi') !!}
                </div>
                <textarea id="deskripsi" name="deskripsi" class="hidden">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
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
                    min-height: 150px;
                }
                .ql-editor.ql-blank::before {
                    color: rgba(34, 15, 7, 0.4) !important;
                    font-style: normal !important;
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const editorEl = document.querySelector('#editor-deskripsi');
                    const textareaEl = document.querySelector('#deskripsi');
                    if (editorEl && textareaEl && window.Quill) {
                        const quill = new window.Quill('#editor-deskripsi', {
                            theme: 'snow',
                            placeholder: 'Jelaskan keunggulan produk ini...',
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

            <div class="flex items-center gap-3">
                <input id="published" type="checkbox" name="published" value="1"
                    class="h-4 w-4 rounded border-coffee-bean text-coffee-bean focus:ring-coffee-bean"
                    {{ old('published') ? 'checked' : '' }}>
                <label for="published" class="text-sm text-coffee-bean font-semibold">Publish produk sekarang</label>
            </div>

            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection
