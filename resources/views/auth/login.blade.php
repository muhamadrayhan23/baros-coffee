<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Baros Coffee</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo/logo1.png') }}?v=1.1" type="image/png" sizes="32x32">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Ionicons for clean iconography -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-cornsilk text-coffee-bean font-sans min-h-screen flex antialiased">

    <!-- Floating Messages (Toast Popups) -->
    <x-message />

    <div class="w-full min-h-screen flex flex-col md:flex-row">
        <!-- Left Side: Image -->
        <div class="hidden md:block w-1/2 h-screen bg-coffee-bean relative">
            <img src="{{ asset('assets/login/login.png') }}" alt="Baros Coffee Login Image"
                class="w-full h-full object-cover opacity-85">
            <div
                class="absolute inset-0 bg-gradient-to-t from-coffee-bean via-transparent to-transparent flex flex-col justify-end p-12">
                <h2 class="text-cornsilk text-3xl font-extrabold tracking-tight mb-2">Baros Coffee</h2>
                <p class="text-cornsilk/80 text-sm max-w-md">Menyajikan cita rasa kopi pilihan terbaik langsung ke
                    cangkir Anda. Silakan masuk untuk mengelola konten dan produk.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-1/2 min-h-screen flex items-center justify-center p-8 sm:p-12 md:p-16">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="md:hidden flex flex-col items-center mb-8">
                    <div class="h-16 w-16 bg-coffee-bean rounded-full flex items-center justify-center mb-3">
                        <ion-icon name="cafe-outline" class="text-cornsilk text-3xl"></ion-icon>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-coffee-bean">Baros Coffee</h2>
                    <p class="text-xs opacity-60">Admin Management Portal</p>
                </div>

                <div class="mb-10 hidden md:block">
                    <h2 class="text-3xl font-extrabold tracking-tight text-coffee-bean mb-2">Selamat Datang</h2>
                    <p class="text-sm opacity-60">Masukkan kredensial Anda untuk mengakses dashboard admin.</p>
                </div>

                <!-- Form -->
                <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-coffee-bean/50 text-xl">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full pl-10 pr-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-2">Kata Sandi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-coffee-bean/50 text-xl">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-12 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                                placeholder="••••••••">
                            <!-- Toggle Show/Hide Password -->
                            <button id="toggle-password" type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-coffee-bean/50 hover:text-coffee-bean text-xl cursor-pointer">
                                <ion-icon id="password-icon" name="eye-outline"></ion-icon>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition-all duration-300 shadow-md shadow-coffee-bean/20 hover:shadow-lg hover:shadow-coffee-bean/30 transform hover:-translate-y-[1px] flex items-center justify-center space-x-2 cursor-pointer">
                        <span>Masuk</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </button>
                </form>

                <!-- Footer -->
                <x-footer />
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const passwordIcon = document.getElementById('password-icon');

            if (togglePasswordBtn && passwordInput && passwordIcon) {
                togglePasswordBtn.addEventListener('click', function() {
                    // Toggle type attribute
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle icon name
                    if (type === 'password') {
                        passwordIcon.setAttribute('name', 'eye-outline');
                    } else {
                        passwordIcon.setAttribute('name', 'eye-off-outline');
                    }
                });
            }
        });
    </script>
</body>

</html>
