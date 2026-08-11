@extends('layout.admin')

@section('title', 'Produk')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-coffee-bean/10 pb-5">
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Manajemen Produk</h2>
                <p class="text-xs opacity-65">Kelola produk kopi yang tampil di halaman website.</p>
            </div>
            <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:items-end sm:ml-auto">
                <a href="{{ route('admin.product.create') }}"
                    class="inline-flex items-center justify-center space-x-2 px-4 py-2 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-xs transition duration-150 shadow-sm cursor-pointer">
                    <span class="text-lg flex items-center"><ion-icon name="add-outline"></ion-icon></span>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6 mt-6">
            <label class="relative block w-full sm:w-80">
                <!-- Input Field (Teks/Placeholder di kiri, padding kanan pr-10 memberi ruang untuk icon) -->
                <input type="text" data-search-input placeholder="Cari produk..."
                    class="w-full rounded-xl border border-coffee-bean/10 bg-cornsilk pl-4 pr-10 py-2 text-sm text-coffee-bean outline-none transition focus:border-coffee-bean/40 placeholder:text-coffee-bean/50" />

                <!-- Icon Search (Dipindah ke sebelah kanan dengan right-3) -->
                <span
                    class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-coffee-bean/50 text-base">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
            </label>
        </div>

        @if ($products->count())
            <div id="product-list" class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($products as $product)
                    <div data-search-item
                        data-search="{{ strtolower($product->nama_produk) }} {{ strtolower($product->deskripsi) }} {{ number_format($product->harga, 0, ',', '.') }}"
                        class="rounded-2xl border border-coffee-bean/10 bg-cornsilk shadow-sm hover:shadow-md transition group">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            @if ($product->gambar)
                                <img src="{{ asset('product/' . $product->gambar) }}" alt="{{ $product->nama_produk }}"
                                    class="h-36 w-full object-cover rounded-t-2xl group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="flex h-36 w-full items-center justify-center rounded-t-2xl bg-frosted-blue/20 text-coffee-bean">
                                    <ion-icon name="cube-outline" class="text-3xl"></ion-icon>
                                </div>
                            @endif
                            <span
                                class="absolute top-3 right-3 z-10 inline-flex items-center rounded-full border bg-white px-3 py-1.5 text-[11px] font-semibold uppercase tracking-wide shadow-lg backdrop-blur-sm {{ $product->published ? 'text-green-600' : 'text-amber-600' }}">
                                {{ $product->published ? 'Published' : 'Unpublished' }}
                            </span>
                        </div>
                        <div class="p-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h3 class="text-sm font-bold text-coffee-bean truncate">{{ $product->nama_produk }}
                                    </h3>
                                    <p class="text-[11px] text-coffee-bean/60 mt-1.5">
                                        {{ Str::limit($product->deskripsi, 70) }}</p>
                                </div>
                                <div class="relative">
                                    <button type="button" onclick="toggleProductMenu('product-menu-{{ $product->id }}')"
                                        class="inline-flex h-7 w-7 items-center justify-center rounded-full border border-coffee-bean/10 bg-white text-coffee-bean hover:bg-frosted-blue/20 transition">
                                        <ion-icon name="ellipsis-vertical" class="text-sm"></ion-icon>
                                    </button>
                                    <div id="product-menu-{{ $product->id }}"
                                        class="absolute right-0 top-full mt-1 hidden w-44 rounded-xl border border-coffee-bean/10 bg-white p-1.5 shadow-lg shadow-coffee-bean/10 z-10 space-y-0.5">
                                        <form action="{{ route('admin.product.toggleStatus', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-coffee-bean hover:bg-frosted-blue/40 transition">
                                                <ion-icon
                                                    name="{{ $product->published ? 'close-circle' : 'checkmark-circle' }}"
                                                    class="text-sm"></ion-icon>
                                                {{ $product->published ? 'Unpublish' : 'Publish' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="flex items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-coffee-bean hover:bg-frosted-blue/40 transition">
                                            <ion-icon name="create-outline" class="text-sm"></ion-icon>
                                            Edit
                                        </a>
                                        <button type="button"
                                            data-route="{{ route('admin.product.destroy', $product->id) }}"
                                            data-product-name="{{ $product->nama_produk }}"
                                            onclick="openDeleteProductModal(this)"
                                            class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-[11px] font-semibold text-black-cherry hover:bg-black-cherry/10 transition cursor-pointer">
                                            <ion-icon name="trash-outline" class="text-sm"></ion-icon>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-coffee-bean/75">
                                <span>Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="product-empty-state" class="hidden rounded-3xl border border-coffee-bean/10 p-10 text-center mt-6">
                <p class="text-sm font-semibold text-coffee-bean">Produk tidak ditemukan.</p>
            </div>

            @if ($products->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="rounded-2xl border border-coffee-bean/10 bg-cornsilk/60 px-3 py-2 shadow-sm">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="rounded-3xl border border-coffee-bean/10 p-10 text-center">
                <p class="text-sm font-semibold text-coffee-bean">Belum ada produk. Silakan tambahkan produk baru untuk
                    ditampilkan.</p>
            </div>
        @endif
    </div>

    <div id="delete-product-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <h3 class="text-xl font-extrabold text-coffee-bean">Konfirmasi Hapus Produk</h3>
            <p class="mt-3 text-sm text-coffee-bean/75">Yakin ingin menghapus produk <span id="delete-product-name"
                    class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="delete-product-form" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closeDeleteProductModal()"
                        class="flex-1 rounded-3xl border border-coffee-bean/10 bg-cornsilk px-4 py-3 text-sm font-semibold text-coffee-bean hover:bg-coffee-bean/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 rounded-3xl bg-black-cherry px-4 py-3 text-sm font-semibold text-white hover:bg-black-cherry/90 transition">Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleProductMenu(menuId) {
            document.querySelectorAll('[id^="product-menu-"]').forEach(function(menu) {
                if (menu.id !== menuId) {
                    menu.classList.add('hidden');
                }
            });
            var menu = document.getElementById(menuId);
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        function openDeleteProductModal(button) {
            const modal = document.getElementById('delete-product-modal');
            const form = document.getElementById('delete-product-form');
            const productNameLabel = document.getElementById('delete-product-name');

            form.setAttribute('action', button.getAttribute('data-route'));
            productNameLabel.textContent = button.closest('[data-product-name]').getAttribute('data-product-name');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteProductModal() {
            const modal = document.getElementById('delete-product-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-product-modal');
            const cancelButton = document.getElementById('delete-product-cancel');

            if (modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeDeleteProductModal();
                    }
                });
            }

            if (cancelButton) {
                cancelButton.addEventListener('click', closeDeleteProductModal);
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    closeDeleteProductModal();
                }
            });
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('[id^="product-menu-"]') && !event.target.closest(
                    'button[onclick^="toggleProductMenu"]')) {
                document.querySelectorAll('[id^="product-menu-"]').forEach(function(menu) {
                    menu.classList.add('hidden');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('[data-search-input]');
            const items = Array.from(document.querySelectorAll('[data-search-item]'));
            const list = document.getElementById('product-list');
            const emptyState = document.getElementById('product-empty-state');

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
