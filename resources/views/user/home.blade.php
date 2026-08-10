@extends('layout.user')

@section('title', 'Beranda')

@section('content')
    {{-- Banner Carousel Section --}}
    @if ($banners->count())
        <div id="banner-carousel" class="relative w-full h-[60vh] sm:h-[70vh] md:h-[80vh] overflow-hidden gap-6">
            {{-- Slides --}}
            @foreach ($banners as $index => $banner)
                <div class="banner-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                    data-index="{{ $index }}">
                    <img src="{{ asset('banner/' . $banner->gambar) }}" alt="{{ $banner->nama_banner }}"
                        class="w-full h-full object-cover">
                    {{-- Overlay gradient for readability --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-coffee-bean/70 via-coffee-bean/10 to-transparent">
                    </div>

                </div>
            @endforeach

            {{-- Left Arrow --}}
            <button id="banner-prev"
                class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-all duration-200 shadow-lg border border-white/30"
                aria-label="Previous slide">
                <ion-icon name="chevron-back-outline" class="text-2xl sm:text-3xl"></ion-icon>
            </button>

            {{-- Right Arrow --}}
            <button id="banner-next"
                class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-all duration-200 shadow-lg border border-white/30"
                aria-label="Next slide">
                <ion-icon name="chevron-forward-outline" class="text-2xl sm:text-3xl"></ion-icon>
            </button>

            {{-- Dot Indicators --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2.5">
                @foreach ($banners as $index => $banner)
                    <button
                        class="banner-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white w-7' : 'bg-white/50 hover:bg-white/75' }}"
                        data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('banner-carousel');
            if (!carousel) return;

            const slides = carousel.querySelectorAll('.banner-slide');
            const dots = carousel.querySelectorAll('.banner-dot');
            const prevBtn = document.getElementById('banner-prev');
            const nextBtn = document.getElementById('banner-next');
            let currentIndex = 0;
            let autoPlayInterval;
            const AUTO_PLAY_DELAY = 5000; // 5 seconds

            function goToSlide(index) {
                if (index < 0) index = slides.length - 1;
                if (index >= slides.length) index = 0;

                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                    slide.classList.toggle('z-10', i === index);
                    slide.classList.toggle('z-0', i !== index);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === index);
                    dot.classList.toggle('w-7', i === index);
                    dot.classList.toggle('bg-white/50', i !== index);
                    dot.classList.toggle('hover:bg-white/75', i !== index);
                });

                currentIndex = index;
            }

            function nextSlide() {
                goToSlide(currentIndex + 1);
            }

            function prevSlide() {
                goToSlide(currentIndex - 1);
            }

            function startAutoPlay() {
                if (autoPlayInterval) clearInterval(autoPlayInterval);
                autoPlayInterval = setInterval(nextSlide, AUTO_PLAY_DELAY);
            }

            function stopAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            }

            // Event listeners for arrows
            if (nextBtn) nextBtn.addEventListener('click', function() {
                nextSlide();
                startAutoPlay(); // Restart auto-play
            });

            if (prevBtn) prevBtn.addEventListener('click', function() {
                prevSlide();
                startAutoPlay(); // Restart auto-play
            });

            // Event listeners for dots
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    goToSlide(index);
                    startAutoPlay(); // Restart auto-play
                });
            });

            // Pause on hover
            if (carousel) {
                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
            }

            // Touch/swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoPlay();
            }, {
                passive: true
            });

            carousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
                startAutoPlay();
            }, {
                passive: true
            });

            // Start auto-play
            startAutoPlay();
        });
    </script>

    <section class="mx-auto flex max-w-7xl flex-col gap-10 px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="overflow-hidden rounded-4xl border border-coffee-bean/10 bg-white shadow-sm">
                <img src="{{ asset('assets/about/about-3.jpeg') }}" alt="Baros Coffee" class="h-90 w-full object-cover">
            </div>
            <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Kopi Specialty</p>
                <h1 class="mt-3 text-3xl font-black leading-tight text-coffee-bean sm:text-4xl">Nikmati kopi organik dari
                    hulu Desa Baros</h1>
                <p class="mt-4 text-sm leading-7 text-coffee-bean/70">Baros Coffee menghadirkan kopi specialty yang tumbuh
                    secara organik, diproses secara bertanggung jawab, dan dibawa langsung dari hulu ekosistem Baros.</p>
                <a href="{{ route('user.products') }}"
                    class="mt-6 inline-flex items-center rounded-full bg-coffee-bean px-5 py-2.5 text-sm font-semibold text-cornsilk transition hover:bg-coffee-bean/90">Lihat
                    Produk</a>
            </div>
        </div>

        <div class="flex flex-col gap-10 rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="min-w-0 rounded-4xl border border-coffee-bean/10 p-8 bg-white">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Produk Unggulan</p>
                    <h2 class="mt-6 text-4xl font-black leading-tight text-coffee-bean">Temukan Produk Andalan Kami</h2>
                    <p class="mt-6 max-w-xl text-sm leading-7 text-coffee-bean/75">
                        Setiap produk dirancang untuk menemani gaya hidup modern dengan kualitas kopi terbaik dari
                        Desa Baros. Hadir sebagai wujud dedikasi kami pada rasa, kualitas, dan pengalaman minum kopi yang
                        tak terlupakan.
                    </p>
                    <p class="mt-4 max-w-xl text-sm leading-7 text-coffee-bean/75">
                        Dengan desain yang elegan dan material pilihan, koleksi ini membawa energi budaya muda dan
                        semangat eksplorasi dalam setiap sajian.
                    </p>
                    <a href="{{ route('user.products') }}"
                        class="mt-8 inline-flex items-center rounded-full bg-coffee-bean px-6 py-3 text-sm font-semibold text-cornsilk transition hover:bg-coffee-bean/90">
                        → Lihat Selengkapnya
                    </a>
                </div>

                <div class="relative min-w-0 h-full">
                    <div id="home-product-carousel" class="overflow-hidden h-full">
                        <div id="home-product-track"
                            class="flex h-full w-full flex-nowrap transition-transform duration-500 ease-out">
                            @forelse($products as $product)
                                <article data-slide
                                    class="w-full flex-shrink-0 h-full flex flex-col justify-between rounded-4xl border border-coffee-bean/10 bg-cornsilk p-4">
                                    <div>
                                        <img src="{{ $product->gambar ? asset('product/' . $product->gambar) : asset('assets/home/home 2.png') }}"
                                            alt="{{ $product->nama_produk }}"
                                            class="h-48 w-full rounded-[1.2rem] object-cover">
                                        <h2 class="mt-4 text-xl font-bold text-coffee-bean">{{ $product->nama_produk }}
                                        </h2>
                                        <p class="mt-2 text-sm leading-7 text-coffee-bean/70">
                                            {{ Str::limit($product->deskripsi, 120) }}</p>
                                    </div>
                                    <div class="mt-6">
                                        <a href="{{ route('user.product.detail', $product->id) }}"
                                            class="inline-flex text-sm font-semibold text-black-cherry">Lihat Detail</a>
                                    </div>
                                </article>
                            @empty
                                <div
                                    class="w-full flex-shrink-0 h-full rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4 text-center text-sm text-coffee-bean/60">
                                    Belum ada produk.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <button id="home-product-next"
                        class="group absolute right-3 top-1/2 -translate-y-1/2 flex h-14 w-14 items-center justify-center rounded-full bg-coffee-bean text-cornsilk shadow-lg transition hover:scale-105">
                        <ion-icon name="chevron-forward-outline" class="text-2xl"></ion-icon>
                    </button>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const track = document.getElementById('home-product-track');
                    const carousel = document.getElementById('home-product-carousel');
                    const nextBtn = document.getElementById('home-product-next');
                    if (!track || !carousel || !nextBtn) return;

                    const slides = track.querySelectorAll('[data-slide]');
                    let currentIndex = 0;
                    let autoPlayInterval;
                    const AUTO_PLAY_DELAY = 5000;

                    function updateSlide() {
                        const offset = carousel.clientWidth * currentIndex;
                        track.style.transform = `translateX(-${offset}px)`;
                    }

                    function nextSlide() {
                        if (slides.length === 0) return;
                        currentIndex = (currentIndex + 1) % slides.length;
                        updateSlide();
                    }

                    function startAutoPlay() {
                        stopAutoPlay();
                        autoPlayInterval = setInterval(nextSlide, AUTO_PLAY_DELAY);
                    }

                    function stopAutoPlay() {
                        if (autoPlayInterval) {
                            clearInterval(autoPlayInterval);
                            autoPlayInterval = null;
                        }
                    }

                    nextBtn.addEventListener('click', function() {
                        nextSlide();
                        startAutoPlay();
                    });

                    carousel.addEventListener('mouseenter', stopAutoPlay);
                    carousel.addEventListener('mouseleave', startAutoPlay);

                    window.addEventListener('resize', updateSlide);

                    startAutoPlay();
                });
            </script>

            <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-2xl font-extrabold text-coffee-bean">Artikel Terbaru</h2>
                        <p class="mt-1 text-sm text-coffee-bean/70">Temukan kisah dan informasi menarik seputar kopi Baros.
                        </p>
                    </div>
                    <a href="{{ route('user.articles') }}" class="text-sm font-semibold text-black-cherry">Lihat Lebih
                        Banyak</a>
                </div>

                <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @forelse($articles as $article)
                        <div class="rounded-2xl border border-coffee-bean/10 bg-cornsilk p-4">
                            <img src="{{ $article->thumbnail ? (Str::startsWith($article->thumbnail, 'article/') ? asset($article->thumbnail) : asset('article/' . $article->thumbnail)) : asset('assets/home/home 2.png') }}"
                                alt="{{ $article->judul }}" class="h-36 w-full rounded-xl object-cover">
                            <h3 class="mt-4 text-lg font-bold text-coffee-bean">
                                {{ Str::limit($article->judul, 50, '...') }}
                            </h3>
                            <p class="mt-2 text-sm text-coffee-bean/70">{{ Str::limit(strip_tags($article->isi), 80) }}</p>
                            <a href="{{ route('user.article.detail', $article->id) }}"
                                class="mt-4 inline-flex text-sm font-semibold text-black-cherry">Baca Selengkapnya</a>
                        </div>
                    @empty
                        <p class="text-sm text-coffee-bean/60">Belum ada artikel.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-2xl font-extrabold text-coffee-bean">Galeri</h2>
                        <p class="mt-1 text-sm text-coffee-bean/70">Kumpulan visual perjalanan Baros Coffee.</p>
                    </div>
                    <a href="{{ route('user.gallery') }}" class="text-sm font-semibold text-black-cherry">Lihat Semua</a>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($galleries as $gallery)
                        <img src="{{ $gallery->foto ? asset('gallery/' . $gallery->foto) : asset('assets/home/home 2.png') }}"
                            alt="{{ $gallery->caption ?? 'Galeri Baros Coffee' }}"
                            class="h-48 w-full rounded-2xl object-cover border border-coffee-bean/10">
                    @empty
                        <p class="text-sm text-coffee-bean/60">Belum ada galeri.</p>
                    @endforelse
                </div>
            </div>
    </section>
@endsection
