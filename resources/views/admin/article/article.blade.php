@extends('layout.admin')

@section('title', 'Artikel')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-coffee-bean/10 pb-5">
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Manajemen Artikel</h2>
                <p class="text-xs opacity-65">Tulis dan sunting blog/artikel untuk website kopi Baros Coffee</p>
            </div>
            <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:items-end sm:ml-auto">
                <a href="{{ route('admin.article.create') }}"
                    class="inline-flex items-center justify-center space-x-2 px-4 py-2 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-xs transition duration-150 shadow-sm cursor-pointer">
                    <span class="text-lg flex items-center"><ion-icon name="add-outline"></ion-icon></span>
                    <span>Tambah Artikel</span>
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6">
            <label class="relative block w-full sm:w-80">
                <!-- Input Field (Teks/Placeholder di kiri, padding kanan pr-10 memberi ruang untuk icon) -->
                <input type="text" data-search-input placeholder="Cari artikel..."
                    class="w-full rounded-xl border border-coffee-bean/10 bg-cornsilk pl-4 pr-10 py-2 text-sm text-coffee-bean outline-none transition focus:border-coffee-bean/40 placeholder:text-coffee-bean/50" />

                <!-- Icon Search (Dipindah ke sebelah kanan dengan right-3) -->
                <span
                    class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-coffee-bean/50 text-base">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
            </label>
        </div>

        <div class="border border-coffee-bean/10 rounded-2xl overflow-hidden bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="border-b border-coffee-bean/10 bg-frosted-blue/10 text-xs font-bold opacity-75">
                            <th class="px-6 py-3.5 w-12 text-center">No</th>
                            <th class="px-6 py-3.5">Foto Thumbnail</th>
                            <th class="px-6 py-3.5">Judul</th>
                            <th class="px-6 py-3.5">Tanggal</th>
                            <th class="px-6 py-3.5 w-44 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="article-table-body" class="divide-y divide-coffee-bean/5">
                        @forelse ($articles as $index => $article)
                            <tr data-search-item
                                data-search="{{ strtolower($article->judul) }} {{ strtolower(\Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y')) }}"
                                class="hover:bg-frosted-blue/5 transition duration-150">
                                <td class="px-6 py-4 font-bold opacity-60 text-center">
                                    {{ ($articles->currentPage() - 1) * $articles->perPage() + $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($article->thumbnail)
                                        <button type="button" data-image="{{ asset($article->thumbnail) }}"
                                            data-caption="{{ Str::limit($article->judul, 80) }}"
                                            onclick="openArticleZoomModal(this)" aria-label="Lihat foto thumbnail"
                                            class="group inline-flex h-20 w-24 cursor-pointer overflow-hidden border border-coffee-bean/10 bg-frosted-blue/20 transition hover:border-coffee-bean/40 focus:outline-none focus:ring-2 focus:ring-coffee-bean/40">
                                            <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->judul }}"
                                                class="h-full w-full object-cover transition duration-150 group-hover:scale-105">
                                        </button>
                                    @else
                                        <div
                                            class="flex h-20 w-24 items-center justify-center border border-coffee-bean/10 bg-frosted-blue/20 text-coffee-bean">
                                            <ion-icon name="image-outline" class="text-2xl"></ion-icon>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold text-coffee-bean">
                                    {{ $article->judul }}
                                </td>
                                <td class="px-6 py-4 font-medium opacity-70">
                                    {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') ?? date('d M Y', strtotime($article->created_at)) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:justify-center">
                                        <a href="{{ route('admin.article.edit', $article->id) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150 shadow-sm font-semibold text-xs">
                                            <ion-icon name="create-outline" class="text-sm"></ion-icon>
                                            Edit
                                        </a>
                                        <button type="button"
                                            data-route="{{ route('admin.article.destroy', $article->id) }}"
                                            data-article-title="{{ $article->judul }}"
                                            onclick="openDeleteArticleModal(this)"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-black-cherry/10 hover:bg-black-cherry hover:text-cornsilk text-black-cherry rounded-xl transition duration-150 shadow-sm font-semibold text-xs">
                                            <ion-icon name="trash-outline" class="text-sm"></ion-icon>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-sm opacity-55">
                                    <ion-icon name="document-text-outline"
                                        class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                    <span>Belum ada artikel. Silakan tambahkan artikel baru untuk ditampilkan.</span>
                                </td>
                            </tr>
                        @endforelse
                        <tr id="article-empty-state-row" class="hidden">
                            <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                <ion-icon name="document-text-outline"
                                    class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                <span>Artikel tidak ditemukan.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($articles->hasPages())
                <div class="px-6 py-4 border-t border-coffee-bean/10">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="delete-article-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <h3 class="text-xl font-extrabold text-coffee-bean">Konfirmasi Hapus Artikel</h3>
            <p class="mt-3 text-sm text-coffee-bean/75">Yakin ingin menghapus artikel <span id="delete-article-title"
                    class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="delete-article-form" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closeDeleteArticleModal()"
                        class="flex-1 rounded-3xl border border-coffee-bean/10 bg-cornsilk px-4 py-3 text-sm font-semibold text-coffee-bean hover:bg-coffee-bean/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 rounded-3xl bg-black-cherry px-4 py-3 text-sm font-semibold text-white hover:bg-black-cherry/90 transition">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteArticleModal(button) {
            const modal = document.getElementById('delete-article-modal');
            const form = document.getElementById('delete-article-form');
            const articleTitleLabel = document.getElementById('delete-article-title');

            form.setAttribute('action', button.getAttribute('data-route'));
            articleTitleLabel.textContent = button.getAttribute('data-article-title');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteArticleModal() {
            const modal = document.getElementById('delete-article-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-article-modal');

            if (modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeDeleteArticleModal();
                    }
                });
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    closeDeleteArticleModal();
                }
            });

            const searchInput = document.querySelector('[data-search-input]');
            const rows = Array.from(document.querySelectorAll('[data-search-item]'));
            const emptyStateRow = document.getElementById('article-empty-state-row');

            if (!searchInput || !emptyStateRow) {
                return;
            }

            if (!rows.length) {
                return;
            }

            const normalize = (value) => (value || '').toLowerCase().trim();

            function filterRows(query) {
                const term = normalize(query);
                let visibleCount = 0;

                rows.forEach(function(row) {
                    const matches = normalize(row.getAttribute('data-search')).includes(term);
                    row.style.display = matches ? '' : 'none';
                    if (matches) {
                        visibleCount++;
                    }
                });

                emptyStateRow.classList.toggle('hidden', visibleCount > 0);
            }

            searchInput.addEventListener('input', function() {
                filterRows(this.value);
            });
        });
    </script>
@endsection
