<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Baros Coffee') - Baros Coffee</title>
    <link rel="icon" href="{{ asset('assets/logo/logo1.png') }}?v=1.1" type="image/png" sizes="32x32">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-cornsilk text-coffee-bean font-sans antialiased">
    <x-navbar />

    <main class="min-h-screen">
        @yield('content')
    </main>

    <x-footer-user />
</body>

</html>
