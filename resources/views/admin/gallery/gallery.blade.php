@extends('layout.admin')

@section('title', 'Galeri')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-coffee-bean/10 pb-5">
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Manajemen Galeri</h2>
                <p class="text-xs opacity-65">Kelola foto-foto dokumentasi kebun kopi, proses roasting, dan kedai.</p>
            </div>
            <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:items-end sm:ml-auto">
                <a href="{{ route('admin.gallery.create') }}"
                    class="inline-flex items-center justify-center space-x-2 px-4 py-2 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-xs transition duration-150 shadow-sm cursor-pointer">
                    <span class="text-lg flex items-center"><ion-icon name="add-outline"></ion-icon></span>
                    <span>Tambah Foto</span>
                </a>
            </div>
        </div>
        <div class ="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6">
            <label class="relative block w-full sm:w-80">
                <!-- Input Field (Teks/Placeholder di kiri, padding kanan pr-10 memberi ruang untuk icon) -->
                <input type="text" data-search-input placeholder="Cari galeri..."
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
                <table class="min-w-[700px] w-full text-left text-sm border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="border-b border-coffee-bean/10 bg-frosted-blue/10 text-xs font-bold opacity-75">
                            <th class="px-6 py-3.5 w-12 text-center">No</th>
                            <th class="px-6 py-3.5">Foto</th>
                            <th class="px-6 py-3.5">Keterangan</th>
                            <th class="px-6 py-3.5">Tanggal</th>
                            <th class="px-6 py-3.5 w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="gallery-table-body" class="divide-y divide-coffee-bean/5">
                        @forelse ($galleries as $index => $gallery)
                            <tr data-search-item
                                data-search="{{ strtolower($gallery->caption) }} {{ strtolower(\Carbon\Carbon::parse($gallery->created_at)->translatedFormat('d M Y')) }}"
                                class="hover:bg-frosted-blue/5 transition duration-150">
                                <td class="px-6 py-4 font-bold opacity-60 text-center">
                                    {{ ($galleries->currentPage() - 1) * $galleries->perPage() + $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($gallery->foto)
                                        <button type="button" data-image="{{ asset('gallery/' . $gallery->foto) }}"
                                            data-caption="{{ Str::limit($gallery->caption, 80) }}"
                                            onclick="openGalleryZoomModal(this)" aria-label="Lihat foto galeri"
                                            class="group inline-flex h-20 w-20 cursor-pointer overflow-hidden  border border-coffee-bean/10 bg-frosted-blue/20 transition hover:border-coffee-bean/40 focus:outline-none focus:ring-2 focus:ring-coffee-bean/40">
                                            <img src="{{ asset('gallery/' . $gallery->foto) }}"
                                                alt="{{ $gallery->caption }}"
                                                class="h-full w-full object-cover transition duration-150 group-hover:scale-105">
                                        </button>
                                    @else
                                        <div
                                            class="flex h-20 w-20 items-center justify-center rounded-3xl border border-coffee-bean/10 bg-frosted-blue/20 text-coffee-bean">
                                            <ion-icon name="images-outline" class="text-2xl"></ion-icon>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-coffee-bean">
                                    {{ Str::limit($gallery->caption, 100) }}
                                </td>
                                <td class="px-6 py-4 font-medium opacity-70">
                                    {{ $gallery->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:justify-center">
                                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150 shadow-sm font-semibold text-xs">
                                            <ion-icon name="create-outline" class="text-sm"></ion-icon>
                                            Edit
                                        </a>
                                        <button type="button"
                                            data-route="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                            data-gallery-caption="{{ Str::limit($gallery->caption, 80) }}"
                                            onclick="openDeleteGalleryModal(this)"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-black-cherry/10 hover:bg-black-cherry hover:text-cornsilk text-black-cherry rounded-xl transition duration-150 shadow-sm font-semibold text-xs">
                                            <ion-icon name="trash-outline" class="text-sm"></ion-icon>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr id="gallery-empty-state-row" class="hidden">
                                <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                    <ion-icon name="images-outline"
                                        class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                    <span>Foto tidak ditemukan.</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                    <ion-icon name="images-outline"
                                        class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                    <span>Belum ada foto galeri. Silakan tambahkan foto baru untuk ditampilkan.</span>
                                </td>
                            </tr>
                        @endforelse
                        <tr id="gallery-empty-state-row" class="hidden">
                            <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                <ion-icon name="images-outline"
                                    class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                <span>Tidak ada galeri yang sesuai dengan pencarian.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($galleries->hasPages())
                <div class="px-6 py-4 border-t border-coffee-bean/10">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="delete-gallery-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <h3 class="text-xl font-extrabold text-coffee-bean">Konfirmasi Hapus Foto Galeri</h3>
            <p class="mt-3 text-sm text-coffee-bean/75">Yakin ingin menghapus foto <span id="delete-gallery-caption"
                    class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="delete-gallery-form" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closeDeleteGalleryModal()"
                        class="flex-1 rounded-3xl border border-coffee-bean/10 bg-cornsilk px-4 py-3 text-sm font-semibold text-coffee-bean hover:bg-coffee-bean/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 rounded-3xl bg-black-cherry px-4 py-3 text-sm font-semibold text-white hover:bg-black-cherry/90 transition">Hapus
                        Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <div id="gallery-zoom-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-coffee-bean/60 backdrop-blur-md transition-all">
        <!-- Overlay Transparan untuk Klik-Tutup -->
        <div class="fixed inset-0" onclick="closeGalleryZoomModal()"></div>

        <!-- Container Card (Ukuran Lebih Besar & Transparan) -->
        <div class="relative z-10 w-full max-w-sm sm:max-w-md">

            <!-- Tombol Close (Di Luar Foto / Pojok Kanan Atas Tanpa Menyentuh Foto) -->
            <button type="button" onclick="closeGalleryZoomModal()"
                class="absolute -top-12 right-0 z-20 flex h-10 w-10 items-center justify-center rounded-full text-white shadow-lg hover:bg-black transition"
                aria-label="Tutup">
                <ion-icon name="close-outline" class="text-2xl"></ion-icon>
            </button>

            <!-- Bingkai Foto Ukuran Besar (320px - 384px) & Object-Cover -->
            <div class="h-80 sm:h-96 w-full overflow-hidden rounded-3xl bg-gray-900/10 shadow-2xl ring-1 ring-white/20">
                <img id="gallery-zoom-image" src="" alt=""
                    class="h-full w-full object-cover object-center transition-transform duration-150"
                    style="transform: scale(1);" />
            </div>

        </div>
    </div>

    <script>
        function openDeleteGalleryModal(button) {
            const modal = document.getElementById('delete-gallery-modal');
            const form = document.getElementById('delete-gallery-form');
            const captionLabel = document.getElementById('delete-gallery-caption');

            form.setAttribute('action', button.getAttribute('data-route'));
            captionLabel.textContent = button.getAttribute('data-gallery-caption');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteGalleryModal() {
            const modal = document.getElementById('delete-gallery-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openGalleryZoomModal(button) {
            const modal = document.getElementById('gallery-zoom-modal');
            const image = document.getElementById('gallery-zoom-image');

            image.style.transform = 'scale(1)';
            image.src = button.getAttribute('data-image');
            image.alt = button.getAttribute('data-caption');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeGalleryZoomModal() {
            const modal = document.getElementById('gallery-zoom-modal');
            const image = document.getElementById('gallery-zoom-image');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            image.style.transform = 'scale(1)';
            image.src = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('delete-gallery-modal');
            const zoomModal = document.getElementById('gallery-zoom-modal');

            if (deleteModal) {
                deleteModal.addEventListener('click', function(event) {
                    if (event.target === deleteModal) {
                        closeDeleteGalleryModal();
                    }
                });
            }

            if (zoomModal) {
                const zoomImage = document.getElementById('gallery-zoom-image');
                zoomModal.addEventListener('click', function(event) {
                    if (event.target === zoomModal) {
                        closeGalleryZoomModal();
                    }
                });

                zoomImage.addEventListener('wheel', function(event) {
                    event.preventDefault();
                    let currentScale = parseFloat(window.getComputedStyle(zoomImage).transform.split(',')[
                        3]) || 1;
                    const delta = event.deltaY < 0 ? 0.1 : -0.1;
                    const nextScale = Math.min(Math.max(currentScale + delta, 1), 2);
                    zoomImage.style.transform = `scale(${nextScale})`;
                });
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    if (zoomModal && !zoomModal.classList.contains('hidden')) {
                        closeGalleryZoomModal();
                    }
                    if (deleteModal && !deleteModal.classList.contains('hidden')) {
                        closeDeleteGalleryModal();
                    }
                }
            });

            const searchInput = document.querySelector('[data-search-input]');
            const rows = Array.from(document.querySelectorAll('[data-search-item]'));
            const emptyStateRow = document.getElementById('gallery-empty-state-row');

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
