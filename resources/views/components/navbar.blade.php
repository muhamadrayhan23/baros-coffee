@php $isHome = request()->routeIs('user.home'); @endphp
<header id="main-header"
    class="sticky top-0 z-50 transition-all duration-300 {{ $isHome ? 'border-b border-coffee-bean/10 bg-white shadow-sm' : 'border-b border-coffee-bean/10 bg-white/95 shadow-sm backdrop-blur-md' }}">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-3 px-3 py-3 sm:px-5 lg:px-6">
        <a href="{{ route('user.home') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/logo/logo 2 remove bg.png') }}" alt="Logo Baros Coffee"
                class="h-14 w-auto object-contain sm:h-16">
        </a>

        <button type="button" id="mobile-nav-toggle"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-coffee-bean/10 bg-cornsilk text-coffee-bean shadow-sm md:hidden"
            aria-label="Buka menu navigasi">
            <ion-icon name="menu-outline" class="text-xl"></ion-icon>
        </button>

        <nav id="site-nav" class="items-center justify-end gap-3 text-base font-semibold sm:gap-5"
            style="display: none;">
            <a href="{{ route('user.home') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.home') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Beranda
            </a>
            <a href="{{ route('user.about') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.about') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Profil
            </a>
            <a href="{{ route('user.products') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.products') || request()->routeIs('user.product.detail') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Produk
            </a>
            <a href="{{ route('user.articles') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.articles') || request()->routeIs('user.article.detail') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Artikel
            </a>
            <a href="{{ route('user.gallery') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.gallery') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Galeri
            </a>
            <a href="{{ route('user.contact') }}"
                class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry {{ request()->routeIs('user.contact') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean' }}">
                Kontak
            </a>
            @guest
                <a href="{{ route('login') }}"
                    class="rounded-full px-3 py-2 transition hover:bg-black-cherry/10 hover:text-black-cherry text-coffee-bean inline-flex items-center gap-2"
                    aria-label="Login">
                    <span class="flex items-center justify-center h-5 w-5 text-lg leading-none"><ion-icon
                            name="log-in-outline"></ion-icon></span>
                    <span class="text-lg font-semibold leading-none">Login</span>
                </a>
            @endguest
        </nav>
    </div>
</header>

<div id="mobile-nav-overlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden"></div>

<div id="mobile-nav-panel"
    class="fixed left-0 top-0 z-50 h-full w-72 -translate-x-full border-r border-coffee-bean/10 bg-white p-5 shadow-2xl transition-transform duration-300 md:hidden">
    <div class="flex items-center justify-between gap-3">
        <a href="{{ route('user.home') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/logo/logo 2 remove bg.png') }}" alt="Logo Baros Coffee"
                class="h-12 w-auto object-contain">
        </a>
        <button type="button" id="mobile-nav-close"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-coffee-bean/10 text-coffee-bean"
            aria-label="Tutup menu navigasi">
            <ion-icon name="close-outline" class="text-xl"></ion-icon>
        </button>
    </div>

    <nav class="mt-8 flex flex-col gap-2 text-base font-semibold">
        <a href="{{ route('user.home') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.home') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Beranda</a>
        <a href="{{ route('user.about') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.about') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Profil</a>
        <a href="{{ route('user.products') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.products') || request()->routeIs('user.product.detail') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Produk</a>
        <a href="{{ route('user.articles') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.articles') || request()->routeIs('user.article.detail') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Artikel</a>
        <a href="{{ route('user.gallery') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.gallery') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Galeri</a>
        <a href="{{ route('user.contact') }}"
            class="rounded-2xl px-3 py-3 transition {{ request()->routeIs('user.contact') ? 'bg-black-cherry/10 text-black-cherry' : 'text-coffee-bean hover:bg-black-cherry/10' }}">Kontak</a>
        @guest
            <a href="{{ route('login') }}"
                class="rounded-2xl px-3 py-3 transition text-coffee-bean hover:bg-black-cherry/10 inline-flex items-center gap-3"
                aria-label="Login">
                <span class="text-xl"><ion-icon name="log-in-outline"></ion-icon></span>
                <span>Masuk</span>
            </a>
        @endguest
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-nav-toggle');
        const closeBtn = document.getElementById('mobile-nav-close');
        const overlay = document.getElementById('mobile-nav-overlay');
        const panel = document.getElementById('mobile-nav-panel');
        const siteNav = document.getElementById('site-nav');

        function syncNavVisibility() {
            if (!siteNav) return;
            siteNav.style.display = window.innerWidth >= 768 ? 'flex' : 'none';
        }

        function openMenu() {
            panel.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            if (toggle) toggle.style.display = 'none';
        }

        function closeMenu() {
            panel.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            if (toggle) toggle.style.display = '';
        }

        if (toggle) {
            toggle.addEventListener('click', openMenu);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeMenu);
        }

        if (overlay) {
            overlay.addEventListener('click', closeMenu);
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });

        syncNavVisibility();
        window.addEventListener('resize', syncNavVisibility);

        // Scroll behavior for navbar on home page
        const header = document.getElementById('main-header');
        const isHome = @json($isHome);

        if (header && isHome) {
            function handleScroll() {
                if (window.scrollY > 80) {
                    header.classList.remove('border-transparent', 'shadow-none');
                    header.classList.add('border-b', 'border-coffee-bean/10', 'shadow-sm', 'backdrop-blur-md');
                } else {
                    header.classList.remove('border-b', 'border-coffee-bean/10', 'shadow-sm',
                        'backdrop-blur-md');
                    header.classList.add('border-transparent', 'shadow-none');
                }
            }

            window.addEventListener('scroll', handleScroll, {
                passive: true
            });
            // Run once on load to set correct state
            handleScroll();
        }
    });
</script>
