@extends('layout.user')

@section('title', 'Detail Produk')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm lg:p-10">
            <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="overflow-hidden rounded-3xl border border-coffee-bean/10">
                    <img src="{{ $product->gambar ? asset('product/' . $product->gambar) : asset('assets/home/home 2.png') }}"
                        alt="{{ $product->nama_produk }}" class="h-50 w-50 object-cover">
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Detail Produk</p>
                    <h1 class="mt-2 text-3xl font-black text-coffee-bean">{{ $product->nama_produk }}</h1>
                    <div class="mt-4">
                        <p class="mb-4 mt-4 text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Variasi
                            Produk
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center rounded-full border border-[#d8b993] bg-[#f5e5d4] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#7a4a1f] shadow-sm">Arabica</span>
                            <span
                                class="inline-flex items-center rounded-full border border-blue-200 bg-blue-100/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-700 shadow-sm">Natural</span>
                            <span
                                class="inline-flex items-center rounded-full border border-amber-200 bg-amber-100/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-amber-700 shadow-sm">Honey</span>
                            <span
                                class="inline-flex items-center rounded-full border border-red-200 bg-red-100/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-red-700 shadow-sm">Full
                                Wash</span>
                            <span
                                class="inline-flex items-center rounded-full border border-purple-200 bg-purple-100/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-purple-700 shadow-sm">Wine</span>
                            <span
                                class="inline-flex items-center rounded-full border border-[#8b5a2b]/20 bg-[#8b5a2b]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#6b3f1d] shadow-sm">Robusta</span>
                        </div>
                    </div>
                    <div class="mt-4 space-y-3 text-sm text-coffee-bean/75">
                        <p><span class="font-semibold text-coffee-bean">Harga:</span> Rp
                            {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <p><span class="font-semibold text-coffee-bean">Berat:</span> {{ $product->berat }} gram</p>
                        <p><span class="font-semibold text-coffee-bean">Stok:</span> {{ $product->stok }}</p>
                    </div>
                    <p class="mt-4 text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Deskripsi Produk
                    </p>
                    <p class="mt-2 text-sm leading-8 text-coffee-bean/75">{{ $product->deskripsi }}</p>
                    <div class="mt-6 rounded-3xl  ">
                        <a href="https://wa.me/6283861969316?text=Halo%20Admin%20Baros%20Coffee!%20%F0%9F%91%8B%0A%0AMau%20tanya%2C%20untuk%20kopi%20varian%20*Full%20Wash%20%2F%20Honey%20%2F%20Natural%20%2F%20Wine%20%2F%20Robusta*%20apakah%20masih%20ready%3F%0A%0ASaya%20bermaksud%20mau%20order.%20Mohon%20info%20ketersediaan%20stok%20dan%20total%20harganya%20ya%20Kak.%20Terima%20kasih!"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-xl shadow-emerald-600/20 ring-2 ring-emerald-600/20 transition hover:bg-emerald-700 hover:ring-emerald-700/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path
                                    d="M20.52 3.48A11.6 11.6 0 0 0 12.04.5c-6.35 0-11.5 5.16-11.5 11.52 0 2.03.55 4.01 1.6 5.74L.5 23.5l5.02-1.55a11.42 11.42 0 0 0 5.5 1.36h.01c6.35 0 11.5-5.16 11.5-11.52 0-3.08-1.2-5.97-3.48-8.03Zm-8.48 16.78h-.01a9.38 9.38 0 0 1-4.78-1.31l-.34-.2-2.99.92.95-2.92-.22-.35A9.42 9.42 0 1 1 12.04 20.26Zm5.18-6.48c-.28-.14-1.67-.82-1.93-.91-.26-.09-.45-.14-.64.14s-.74.91-.9 1.1c-.17.2-.33.22-.61.08-.28-.14-1.18-.44-2.24-1.38-.83-.74-1.39-1.64-1.55-1.92-.16-.28-.02-.43.12-.57.12-.12.28-.31.42-.47.14-.16.19-.28.28-.46.09-.17.05-.32-.03-.45-.08-.14-.64-1.54-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.37-.01-.56-.01-.19 0-.49.07-.75.35-.26.28-1 1-1 2.42 0 1.41 1.03 2.78 1.17 2.97.14.2 2.01 3.05 4.86 4.28.68.29 1.21.46 1.62.59.68.21 1.3.18 1.79.11.55-.08 1.67-.68 1.91-1.34.24-.66.24-1.23.17-1.35-.07-.12-.26-.19-.54-.33Z" />
                            </svg>
                            Beli Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 border-coffee-bean/10 pt-8">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-xl font-black text-coffee-bean">Produk Lainnya</h2>

                </div>

                @if ($relatedProducts->isNotEmpty())
                    <div class="mt-5 flex gap-4 overflow-x-auto pb-2">
                        @foreach ($relatedProducts as $relatedProduct)
                            <a href="{{ route('user.product.detail', $relatedProduct->id) }}"
                                class="min-w-[240px] max-w-[260px] flex-shrink-0 rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                <img src="{{ $relatedProduct->gambar ? asset('product/' . $relatedProduct->gambar) : asset('assets/home/home 2.png') }}"
                                    alt="{{ $relatedProduct->nama_produk }}"
                                    class="h-40 w-full rounded-[1.2rem] object-cover">
                                <h3 class="mt-4 text-lg font-bold text-coffee-bean">{{ $relatedProduct->nama_produk }}</h3>
                                <p class="mt-2 text-sm leading-6 text-coffee-bean/70">
                                    {{ Str::limit($relatedProduct->deskripsi, 90) }}</p>
                                <p class="mt-3 text-sm font-semibold text-black-cherry">Rp
                                    {{ number_format($relatedProduct->harga, 0, ',', '.') }}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="mt-5 text-sm text-coffee-bean/60">Belum ada produk lainnya.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
