@extends('layout.user')

@section('title', 'Produk')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Katalog Produk</p>
                    <h1 class="mt-2 text-3xl font-black text-coffee-bean">Produk Baros Coffee</h1>
                </div>
            </div>

            <div class="mt-8">
                <div class="relative">
                    <input type="text" id="product-search" placeholder="Cari produk..." autocomplete="off"
                        class="w-full rounded-full border border-coffee-bean/10 bg-cornsilk py-3.5 pl-10 pr-24 text-sm text-coffee-bean placeholder:text-coffee-bean/40 transition duration-150 ease-in-out focus:border-black-cherry/40 focus:outline-none focus:ring-2 focus:ring-black-cherry/10" />
                    <button type="button" id="product-search-toggle"
                        class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full text-coffee-bean/50 transition hover:bg-black-cherry/10 hover:text-black-cherry"
                        aria-label="Cari produk">
                        <ion-icon id="product-search-icon" name="search-outline" class="text-base"></ion-icon>
                    </button>
                </div>
                <p id="product-search-count" class="mt-2 px-1 text-xs text-coffee-bean/50"></p>
            </div>

            <div id="product-list" class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($products as $product)
                    <div class="product-card rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4"
                        data-name="{{ strtolower($product->nama_produk) }}"
                        data-deskripsi="{{ strtolower($product->deskripsi) }}">
                        @php
                            $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                            $imageUrl = $product->gambar
                                ? (Str::startsWith($product->gambar, ['http://', 'https://'])
                                    ? $product->gambar
                                    : $baseUrl . '/' . ltrim($product->gambar, '/'))
                                : asset('assets/home/home 2.png');
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->nama_produk }}"
                            onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                            class="mt-4 h-56 w-full rounded-3xl object-cover border border-coffee-bean/10">
                        <h2 class="mt-4 text-xl font-bold text-coffee-bean">{{ $product->nama_produk }}</h2>
                        <p class="mt-2 text-sm leading-7 text-coffee-bean/70">{{ Str::limit($product->deskripsi, 120) }}</p>
                        <a href="{{ route('user.product.detail', $product->id) }}"
                            class="mt-4 inline-flex text-sm font-semibold text-black-cherry">Lihat Detail</a>
                    </div>
                @empty
                    <p class="text-sm text-coffee-bean/60">Belum ada produk.</p>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            @endif

            <div id="product-not-found"
                class="mt-8 hidden rounded-3xl border border-coffee-bean/10 bg-cornsilk p-12 text-center">
                <ion-icon name="search-outline" class="mx-auto text-5xl text-coffee-bean/30"></ion-icon>
                <p class="mt-4 text-lg font-bold text-coffee-bean">Produk tidak ditemukan</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search');
            const productCards = document.querySelectorAll('.product-card');
            const searchToggle = document.getElementById('product-search-toggle');
            const searchIcon = document.getElementById('product-search-icon');
            const countLabel = document.getElementById('product-search-count');
            const notFound = document.getElementById('product-not-found');

            if (!searchInput || productCards.length === 0) return;

            function updateSearchControl() {
                const hasValue = searchInput.value.trim() !== '';

                if (searchIcon) {
                    searchIcon.setAttribute('name', hasValue ? 'close' : 'search-outline');
                }

                if (searchToggle) {
                    searchToggle.setAttribute('aria-label', hasValue ? 'Hapus pencarian' : 'Cari produk');
                }
            }

            function updateCount(visibleCount, isSearching) {
                if (!countLabel) return;
                countLabel.textContent = isSearching ? visibleCount + ' produk ditemukan' : '';
            }

            function filterProducts() {
                const query = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;

                productCards.forEach(function(card) {
                    const name = (card.getAttribute('data-name') || '').toLowerCase();
                    const deskripsi = (card.getAttribute('data-deskripsi') || '').toLowerCase();
                    const match = name.includes(query) || deskripsi.includes(query);

                    card.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });

                if (query === '') {
                    notFound?.classList.add('hidden');
                    updateCount(0, false);
                } else if (visibleCount === 0) {
                    notFound?.classList.remove('hidden');
                    updateCount(0, true);
                } else {
                    notFound?.classList.add('hidden');
                    updateCount(visibleCount, true);
                }

                updateSearchControl();
            }

            searchInput.addEventListener('input', filterProducts);

            searchToggle?.addEventListener('click', function() {
                if (searchInput.value.trim() !== '') {
                    searchInput.value = '';
                    filterProducts();
                }
                searchInput.focus();
            });

            updateSearchControl();
            filterProducts();
        });
    </script>
@endsection
