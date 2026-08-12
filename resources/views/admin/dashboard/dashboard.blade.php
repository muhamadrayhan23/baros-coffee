@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        <!-- Welcome Card -->
        <div
            class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
            <!-- Abstract background pattern for rich aesthetics -->
            <div
                class="absolute right-0 top-0 translate-x-12 -translate-y-12 w-64 h-64 bg-frosted-blue/15 rounded-full blur-2xl">
            </div>
            <div class="absolute left-1/3 bottom-0 translate-y-12 w-48 h-48 bg-coffee-bean/5 rounded-full blur-xl"></div>

            <div class="relative z-10 space-y-2">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-coffee-bean">
                    Selamat Datang Kembali, {{ Auth::user()->name ?? 'Administrator' }}!
                </h2>
                <p class="text-sm text-coffee-bean/70 max-w-2xl leading-relaxed">
                    Hari ini adalah <span
                        class="font-bold text-coffee-bean">{{ now()->isoFormat('D MMMM Y') ?? date('d F Y') }}</span>.
                    Dashboard ini dirancang untuk mempermudah Anda mengelola konten menu website Baros Coffee, mulai dari
                    artikel, galeri, produk, testimoni, hingga akun pengguna.
                </p>
            </div>
            <div
                class="relative z-10 flex-shrink-0 bg-frosted-blue p-4 rounded-2xl text-coffee-bean shadow-sm shadow-frosted-blue/20">
                <div class="flex items-center space-x-3">
                    <span class="text-3xl flex items-center"><ion-icon name="time-outline"></ion-icon></span>
                    <div>
                        <span class="text-xs font-bold block opacity-60">Status Sistem</span>
                        <span class="text-sm font-extrabold text-deep-forest flex items-center gap-1.5">
                            <span class="h-2.5 w-2.5 bg-deep-forest rounded-full animate-pulse block"></span>
                            Aktif & Stabil
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Summary Cards Row -->
        <div class="flex flex-col sm:flex-row gap-4 md:gap-6">
            <!-- Total Products Card -->
            <div
                class="flex-1 min-w-0 bg-white border border-coffee-bean/10 p-5 rounded-2xl shadow-sm hover:scale-[1.02] hover:shadow-md transition-all duration-300 flex items-center space-x-4">
                <div
                    class="h-12 w-12 rounded-xl bg-frosted-blue flex items-center justify-center text-coffee-bean text-2xl flex-shrink-0">
                    <ion-icon name="cube"></ion-icon>
                </div>
                <div>
                    <span class="text-xs font-bold opacity-60 block">Total Produk</span>
                    <span class="text-2xl font-extrabold tracking-tight">{{ $totalProducts }}</span>
                </div>
            </div>

            <!-- Articles Card -->
            <div
                class="flex-1 min-w-0 bg-white border border-coffee-bean/10 p-5 rounded-2xl shadow-sm hover:scale-[1.02] hover:shadow-md transition-all duration-300 flex items-center space-x-4">
                <div
                    class="h-12 w-12 rounded-xl bg-frosted-blue flex items-center justify-center text-coffee-bean text-2xl flex-shrink-0">
                    <ion-icon name="document-text"></ion-icon>
                </div>
                <div>
                    <span class="text-xs font-bold opacity-60 block">Total Artikel</span>
                    <span class="text-2xl font-extrabold tracking-tight">{{ $totalArticles }}</span>
                </div>
            </div>

            <!-- Gallery Card -->
            <div
                class="flex-1 min-w-0 bg-white border border-coffee-bean/10 p-5 rounded-2xl shadow-sm hover:scale-[1.02] hover:shadow-md transition-all duration-300 flex items-center space-x-4">
                <div
                    class="h-12 w-12 rounded-xl bg-frosted-blue flex items-center justify-center text-coffee-bean text-2xl flex-shrink-0">
                    <ion-icon name="images"></ion-icon>
                </div>
                <div>
                    <span class="text-xs font-bold opacity-60 block">Total Galeri</span>
                    <span class="text-2xl font-extrabold tracking-tight">{{ $totalGalleries }}</span>
                </div>
            </div>


            <!-- User Card -->
            <div
                class="flex-1 min-w-0 bg-white border border-coffee-bean/10 p-5 rounded-2xl shadow-sm hover:scale-[1.02] hover:shadow-md transition-all duration-300 flex items-center space-x-4">
                <div
                    class="h-12 w-12 rounded-xl bg-frosted-blue flex items-center justify-center text-coffee-bean text-2xl flex-shrink-0">
                    <ion-icon name="people"></ion-icon>
                </div>
                <div>
                    <span class="text-xs font-bold opacity-60 block">Pengguna</span>
                    <span class="text-2xl font-extrabold tracking-tight">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>

        <!-- Main Grid: Tables and Sidebar Widgets -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">

            <!-- Left: Product & Article Tables -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">

                <!-- Tabel Produk Terbaru -->
                <div class="bg-white border border-coffee-bean/10 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-coffee-bean/10 flex items-center justify-between bg-white">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl flex items-center text-coffee-bean"><ion-icon
                                    name="cube-outline"></ion-icon></span>
                            <h3 class="font-extrabold text-base tracking-tight">Produk Terbaru</h3>
                        </div>
                        <a href="{{ route('admin.product.index') }}"
                            class="text-xs font-bold hover:underline opacity-80 flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-coffee-bean/10 bg-frosted-blue/10 text-xs font-bold opacity-75">
                                    <th class="px-6 py-3.5 w-12">No</th>
                                    <th class="px-6 py-3.5">Gambar</th>
                                    <th class="px-6 py-3.5">Nama Produk</th>
                                    <th class="px-6 py-3.5">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-coffee-bean/5">
                                @foreach ($products as $index => $product)
                                    <tr class="hover:bg-frosted-blue/5 transition duration-150">
                                        <td class="px-6 py-4 font-bold opacity-60">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-bold">
                                            @if ($product->gambar)
                                                @php
                                                    $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                                                    $productUrl = Str::startsWith($product->gambar, [
                                                        'http://',
                                                        'https://',
                                                    ])
                                                        ? $product->gambar
                                                        : $baseUrl . '/' . ltrim($product->gambar, '/');
                                                @endphp
                                                <img src="{{ $productUrl }}" alt="{{ $product->nama_produk }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                                                    class="h-10 w-10 object-cover rounded-lg border border-coffee-bean/10">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-lg bg-frosted-blue/40 border border-coffee-bean/10 flex items-center justify-center text-coffee-bean text-lg">
                                                    <ion-icon name="cafe-outline"></ion-icon>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold">{{ $product->nama_produk }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Artikel Terbaru -->
                <div class="bg-white border border-coffee-bean/10 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-coffee-bean/10 flex items-center justify-between bg-white">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl flex items-center text-coffee-bean"><ion-icon
                                    name="document-text-outline"></ion-icon></span>
                            <h3 class="font-extrabold text-base tracking-tight">Artikel Terbaru</h3>
                        </div>
                        <a href="{{ route('admin.article.index') }}"
                            class="text-xs font-bold hover:underline opacity-80 flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <ion-icon name="chevron-forward"></ion-icon>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-coffee-bean/10 bg-frosted-blue/10 text-xs font-bold opacity-75">
                                    <th class="px-6 py-3.5 w-12">No</th>
                                    <th class="px-6 py-3.5">Thumbnail</th>
                                    <th class="px-6 py-3.5">Judul Artikel</th>
                                    <th class="px-6 py-3.5">Tanggal Terbit</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-coffee-bean/5">
                                @foreach ($articles as $index => $article)
                                    <tr class="hover:bg-frosted-blue/5 transition duration-150">
                                        <td class="px-6 py-4 font-bold opacity-60">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-bold align-middle">
                                            @if ($article->thumbnail)
                                                @php
                                                    $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                                                    $articleUrl = Str::startsWith($article->thumbnail, [
                                                        'http://',
                                                        'https://',
                                                    ])
                                                        ? $article->thumbnail
                                                        : $baseUrl . '/' . ltrim($article->thumbnail, '/');
                                                @endphp
                                                <img src="{{ $articleUrl }}" alt="{{ $article->judul }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                                                    class="h-10 w-16 object-cover rounded-lg border border-coffee-bean/10">
                                            @else
                                                <div
                                                    class="h-10 w-16 rounded-lg bg-frosted-blue/40 border border-coffee-bean/10 flex items-center justify-center text-coffee-bean text-lg">
                                                    <ion-icon name="image-outline"></ion-icon>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold align-middle">
                                            <div class="line-clamp-1 max-w-[250px] sm:max-w-md">
                                                {{ $article->judul }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-medium opacity-80">
                                            {{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d M Y') ?? date('d M Y', strtotime($article->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Right: Low Stock Alert & Quick Actions -->
            <div class="space-y-6 md:space-y-8">

                <!-- Quick Actions -->
                <div class="bg-white border border-coffee-bean/10 rounded-2xl shadow-sm p-6 space-y-4">
                    <div class="flex items-center space-x-2 border-b border-coffee-bean/10 pb-3">
                        <span class="text-xl flex items-center text-coffee-bean"><ion-icon
                                name="flash-outline"></ion-icon></span>
                        <h3 class="font-extrabold text-base tracking-tight">Aksi Cepat</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Tambah Banner -->
                        <a href="{{ route('admin.banner.create') }}"
                            class="flex flex-col items-center justify-center p-4 bg-frosted-blue/20 hover:bg-frosted-blue border border-coffee-bean/10 rounded-xl text-center transition duration-200 group">
                            <span
                                class="text-2xl text-coffee-bean group        -hover:scale-110 transition-transform mb-1.5">
                                <ion-icon name="images-outline"></ion-icon>
                            </span>
                            <span class="text-xs font-bold">Tambah Banner</span>
                        </a>

                        <!-- Tambah Produk -->
                        <a href="{{ route('admin.product.create') }}"
                            class="flex flex-col items-center justify-center p-4 bg-frosted-blue/20 hover:bg-frosted-blue border border-coffee-bean/10 rounded-xl text-center transition duration-200 group">
                            <span class="text-2xl text-coffee-bean group-hover:scale-110 transition-transform mb-1.5">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </span>
                            <span class="text-xs font-bold">Tambah Produk</span>
                        </a>

                        <!-- Tambah Artikel -->
                        <a href="{{ route('admin.article.create') }}"
                            class="flex flex-col items-center justify-center p-4 bg-frosted-blue/20 hover:bg-frosted-blue border border-coffee-bean/10 rounded-xl text-center transition duration-200 group">
                            <span class="text-2xl text-coffee-bean group-hover:scale-110 transition-transform mb-1.5">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                            <span class="text-xs font-bold">Tambah Artikel</span>
                        </a>

                        <!-- Tambah Galeri -->
                        <a href="{{ route('admin.gallery.create') }}"
                            class="flex flex-col items-center justify-center p-4 bg-frosted-blue/20 hover:bg-frosted-blue border border-coffee-bean/10 rounded-xl text-center transition duration-200 group">
                            <span class="text-2xl text-coffee-bean group-hover:scale-110 transition-transform mb-1.5">
                                <ion-icon name="images-outline"></ion-icon>
                            </span>
                            <span class="text-xs font-bold">Tambah Galeri</span>
                        </a>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
