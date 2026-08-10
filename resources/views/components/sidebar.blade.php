<!-- Sidebar Container -->
<aside id="admin-sidebar"
    class="bg-cornsilk border-r border-coffee-bean/10 text-coffee-bean w-64 min-h-screen flex flex-col fixed inset-y-0 left-0 z-40 transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">

    <!-- Sidebar Header -->
    <div class="px-6 md:px-8">
        <div class="h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="h-10 w-10 bg-coffee-bean rounded-xl flex items-center justify-center shadow-md overflow-hidden">
                    <img src="{{ asset('assets/logo/logo1.png') }}" alt="Baros Coffee Logo"
                        class="h-10 w-10 object-contain rounded-xl">
                </div>
                <div>
                    <span class="font-extrabold text-lg leading-none tracking-tight block">Baros Coffee</span>
                    <span class="text-[10px] uppercase tracking-wider font-bold opacity-60">Admin Area</span>
                </div>
            </div>

            <!-- Close button (Mobile only) -->
            <button id="mobile-sidebar-close"
                class="md:hidden text-2xl hover:opacity-85 focus:outline-none cursor-pointer">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
        <div class="border-b border-coffee-bean/10"></div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <span class="px-3 text-[10px] uppercase font-bold tracking-widest opacity-40 block mb-2">Menu Utama</span>

        <!-- Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.dashboard') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon name="{{ Route::is('admin.dashboard') ? 'grid' : 'grid-outline' }}"></ion-icon>
            </span>
            <span>Dashboard</span>
        </a>

        <!-- Banner Link -->
        <a href="{{ route('admin.banner.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.banner.*') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon name="{{ Route::is('admin.banner.*') ? 'images' : 'images-outline' }}"></ion-icon>
            </span>
            <span>Banner</span>
        </a>

        <!-- Artikel Link -->
        <a href="{{ route('admin.article.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.article.*') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon
                    name="{{ Route::is('admin.article.*') ? 'document-text' : 'document-text-outline' }}"></ion-icon>
            </span>
            <span>Artikel</span>
        </a>

        <!-- Galeri Link -->
        <a href="{{ route('admin.gallery.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.gallery.*') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon name="{{ Route::is('admin.gallery.*') ? 'images' : 'images-outline' }}"></ion-icon>
            </span>
            <span>Galeri</span>
        </a>

        <!-- Produk Link -->
        <a href="{{ route('admin.product.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.product.*') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon name="{{ Route::is('admin.product.*') ? 'cube' : 'cube-outline' }}"></ion-icon>
            </span>
            <span>Produk</span>
        </a>

        <!-- Pengguna Link -->
        <a href="{{ route('admin.user.index') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 {{ Route::is('admin.user.*') ? 'bg-frosted-blue text-coffee-bean shadow-sm shadow-frosted-blue/35' : 'hover:bg-frosted-blue/40 text-coffee-bean/85 hover:text-coffee-bean' }}">
            <span class="text-xl flex items-center">
                <ion-icon name="{{ Route::is('admin.user.*') ? 'people' : 'people-outline' }}"></ion-icon>
            </span>
            <span>Pengguna</span>
        </a>

        <a href="{{ route('user.home') }}" target="_blank" rel="noopener noreferrer"
            class="w-full inline-flex items-center space-x-3 px-4 py-3 mb-3 bg-coffee-bean text-cornsilk rounded-xl font-bold text-sm transition-all duration-200 hover:bg-coffee-bean/90">
            <span class="text-xl flex items-center">
                <ion-icon name="earth-outline"></ion-icon>
            </span>
            <span>Lihat Website</span>
        </a>

    </nav>

    <!-- Sidebar Footer / Logout -->
    <div class="px-4 md:px-8 py-4 bg-cornsilk">
        <div class="border-t border-coffee-bean/10 mb-3"></div>

        <button type="button" onclick="openLogoutModal()"
            class="w-full flex items-center space-x-3 px-4 py-3 text-black-cherry hover:bg-black-cherry/10 rounded-xl font-bold text-sm transition-all duration-200 cursor-pointer">
            <span class="text-xl flex items-center">
                <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span>Keluar</span>
        </button>
    </div>
</aside>
