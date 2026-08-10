<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') - Baros Coffee</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo/logo1.png') }}?v=1.1" type="image/png" sizes="32x32">
    <!-- Tailwind CSS and JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Ionicons for clean coffee & admin iconography -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-cornsilk text-coffee-bean
        font-sans min-h-screen flex flex-col md:flex-row antialiased">

    <!-- Floating Messages (Toast Popups) -->
    <x-message />

    <!-- Logout Confirmation Modal -->
    <x-logout-modal />

    <!-- Sidebar Navigation -->
    <x-sidebar />

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 min-h-screen overflow-x-hidden">
        <!-- Top Navbar -->
        <header
            class="bg-cornsilk/80 backdrop-blur-md border-b border-coffee-bean/10 sticky top-0 z-30 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- Hamburger menu button (only visible on mobile, triggers sidebar) -->
                <button id="mobile-sidebar-toggle"
                    class="md:hidden text-2xl text-coffee-bean hover:opacity-85 focus:outline-none cursor-pointer">
                    <ion-icon name="menu-outline"></ion-icon>
                </button>
                <div>
                    <h1 class="text-xl font-bold tracking-tight">Baros Coffee Admin</h1>
                    <p class="text-xs opacity-60">Manajemen Konten Website Kopi</p>
                </div>
            </div>

            <!-- Profile Info and Logout -->
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-xs opacity-60">Admin</span>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-coffee-bean text-cornsilk flex items-center justify-center font-bold border-2 border-coffee-bean">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- Dynamic Content Section -->
        <div class="p-6 md:p-8 flex-1">
            @yield('content')
        </div>

        <!-- Footer -->
        <x-footer />
    </main>

    <!-- Sidebar toggle helper script for mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const toggleBtn = document.getElementById('mobile-sidebar-toggle');
            const closeBtn = document.getElementById('mobile-sidebar-close');

            if (sidebar && toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.remove('-translate-x-full');
                });
            }

            if (sidebar && closeBtn) {
                closeBtn.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                });
            }
        });
    </script>
</body>

</html>
