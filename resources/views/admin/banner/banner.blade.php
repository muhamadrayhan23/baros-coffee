@extends('layout.admin')

@section('title', 'Banner')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-coffee-bean/10 pb-5">
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Manajemen Banner</h2>
                <p class="text-xs opacity-65">Kelola banner carousel beranda. Gunakan tombol publikasi untuk menampilkan
                    banner.</p>
            </div>
            <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:items-end sm:ml-auto">
                <a href="{{ route('admin.banner.create') }}"
                    class="inline-flex items-center justify-center space-x-2 px-4 py-2 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-xs transition duration-150 shadow-sm cursor-pointer">
                    <span class="text-lg flex items-center"><ion-icon name="add-outline"></ion-icon></span>
                    <span>Tambah Banner</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6 mt-6">
            <label class="relative block w-full sm:w-80">
                <!-- Input Field (Teks/Placeholder di kiri, padding kanan pr-10 memberi ruang untuk icon) -->
                <input type="text" data-search-input placeholder="Cari banner..."
                    class="w-full rounded-xl border border-coffee-bean/10 bg-cornsilk pl-4 pr-10 py-2 text-sm text-coffee-bean outline-none transition focus:border-coffee-bean/40 placeholder:text-coffee-bean/50" />

                <!-- Icon Search (Dipindah ke sebelah kanan dengan right-3) -->
                <span
                    class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-coffee-bean/50 text-base">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
            </label>
        </div>

        <div class="mt-6">
            @if ($banners->count())
                <div id="banner-list" class="grid gap-5 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($banners as $banner)
                        <div data-search-item
                            data-search="{{ strtolower($banner->nama_banner) }} {{ $banner->published ? 'published' : 'unpublished' }}"
                            class="rounded-2xl border border-coffee-bean/10 bg-cornsilk shadow-sm hover:shadow-md transition group">
                            <div class="relative overflow-hidden rounded-t-2xl">
                                <img src="{{ asset('banner/' . $banner->gambar) }}" alt="{{ $banner->nama_banner }}"
                                    class="h-32 w-full object-cover rounded-t-2xl group-hover:scale-105 transition-transform duration-300">
                                <span
                                    class="absolute top-3 right-3 z-10 inline-flex items-center rounded-full border bg-white px-3 py-1.5 text-[11px] font-semibold uppercase tracking-wide shadow-lg backdrop-blur-sm @if ($banner->published) text-green-600 @else text-red-600 @endif">
                                    {{ $banner->published ? 'Published' : 'Unpublished' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-bold text-coffee-bean truncate">{{ $banner->nama_banner }}</h3>
                                <p class="text-[10px] text-coffee-bean/60 mt-1.5">Diunggah
                                    {{ $banner->created_at->translatedFormat('d M Y') }}</p>
                                <div class="flex items-center justify-end mt-3">
                                    <div class="relative">
                                        <button type="button" onclick="toggleBannerMenu('banner-menu-{{ $banner->id }}')"
                                            class="inline-flex h-7 w-7 items-center justify-center rounded-full border border-coffee-bean/10 bg-white text-coffee-bean hover:bg-frosted-blue/20 transition">
                                            <ion-icon name="ellipsis-vertical" class="text-sm"></ion-icon>
                                        </button>
                                        <div id="banner-menu-{{ $banner->id }}"
                                            class="absolute right-0 top-full mt-1 hidden w-40 rounded-xl border border-coffee-bean/10 bg-white p-1.5 shadow-lg shadow-coffee-bean/10 z-10 space-y-0.5">
                                            <form action="{{ route('admin.banner.toggleStatus', $banner->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-coffee-bean hover:bg-frosted-blue/40 transition">
                                                    <ion-icon
                                                        name="{{ $banner->published ? 'close-circle' : 'checkmark-circle' }}"
                                                        class="text-sm"></ion-icon>
                                                    {{ $banner->published ? 'Unpublish' : 'Publish' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-coffee-bean hover:bg-frosted-blue/40 transition">
                                                <ion-icon name="create-outline" class="text-sm"></ion-icon>
                                                Edit
                                            </a>
                                            <button type="button" data-id="{{ $banner->id }}"
                                                data-name="{{ $banner->nama_banner }}" onclick="confirmDeleteBanner(this)"
                                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-black-cherry hover:bg-black-cherry/10 transition">
                                                <ion-icon name="trash-outline" class="text-sm"></ion-icon>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="banner-empty-state" class="hidden rounded-3xl border border-coffee-bean/10 p-10 text-center mt-6">
                    <p class="text-sm font-semibold text-coffee-bean">Banner tidak ditemukan.</p>
                </div>

                @if ($banners->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="rounded-2xl border border-coffee-bean/10 bg-cornsilk/60 px-3 py-2 shadow-sm">
                            {{ $banners->links() }}
                        </div>
                    </div>
                @endif
            @else
                <div class="rounded-3xl border border-coffee-bean/10  p-10 text-center">
                    <p class="text-sm font-semibold text-coffee-bean">Belum ada banner. Silakan tambahkan banner baru
                        untuk
                        ditampilkan di beranda.</p>
                </div>
            @endif
        </div>
    </div>

    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <h3 class="text-xl font-extrabold text-coffee-bean">Konfirmasi Hapus Banner</h3>
            <p class="mt-3 text-sm text-coffee-bean/75">Apakah Anda yakin ingin menghapus banner ini? Tindakan ini tidak
                dapat dibatalkan.</p>
            <form id="delete-banner-form" method="POST" action="" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 rounded-3xl border border-coffee-bean/10 bg-cornsilk px-4 py-3 text-sm font-semibold text-coffee-bean hover:bg-coffee-bean/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 rounded-3xl bg-black-cherry px-4 py-3 text-sm font-semibold text-white hover:bg-black-cherry/90 transition">Hapus
                        Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleBannerMenu(menuId) {
            document.querySelectorAll('[id^="banner-menu-"]').forEach(function(menu) {
                if (menu.id !== menuId) {
                    menu.classList.add('hidden');
                }
            });
            var menu = document.getElementById(menuId);
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        function confirmDeleteBanner(button) {
            var bannerId = button.dataset.id;
            var bannerName = button.dataset.name;
            var modal = document.getElementById('delete-modal');
            var form = document.getElementById('delete-banner-form');
            form.action = '/admin/banner/' + bannerId;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            var modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('[id^="banner-menu-"]') && !event.target.closest(
                    'button[onclick^="toggleBannerMenu"]')) {
                document.querySelectorAll('[id^="banner-menu-"]').forEach(function(menu) {
                    menu.classList.add('hidden');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('[data-search-input]');
            const items = Array.from(document.querySelectorAll('[data-search-item]'));
            const list = document.getElementById('banner-list');
            const emptyState = document.getElementById('banner-empty-state');

            if (!searchInput || !list || !items.length) {
                return;
            }

            const normalize = (value) => (value || '').toLowerCase().trim();

            function filterItems(query) {
                const term = normalize(query);
                let visibleCount = 0;

                items.forEach(function(item) {
                    const matches = normalize(item.getAttribute('data-search')).includes(term);
                    item.style.display = matches ? '' : 'none';
                    if (matches) {
                        visibleCount++;
                    }
                });

                list.style.display = visibleCount > 0 ? '' : 'none';
                if (emptyState) {
                    emptyState.classList.toggle('hidden', visibleCount > 0);
                }
            }

            searchInput.addEventListener('input', function() {
                filterItems(this.value);
            });
        });
    </script>
@endsection
