@extends('layout.admin')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <!-- Header -->
        <div class="flex items-center space-x-3 border-b border-coffee-bean/10 pb-5">
            <a href="{{ route('admin.user.index') }}"
                class="inline-flex items-center justify-center h-9 w-9 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150"
                title="Kembali">
                <span class="text-xl flex items-center"><ion-icon name="arrow-back"></ion-icon></span>
            </a>
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Tambah Pengguna</h2>
                <p class="text-xs opacity-65">Buat akun administrator baru untuk manajemen website</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.user.store') }}" method="POST" class="max-w-xl space-y-6">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-coffee-bean">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-coffee-bean">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                    placeholder="nama@email.com">
                @error('email')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-semibold mb-2 text-coffee-bean">Kata Sandi</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full pr-12 px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                        placeholder="Minimal 6 karakter">
                    <button type="button" onclick="togglePasswordVisibility('password', this)"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-coffee-bean/50 hover:text-coffee-bean text-xl cursor-pointer"
                        aria-label="Tampilkan atau sembunyikan kata sandi">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-coffee-bean">Konfirmasi Kata
                    Sandi</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full pr-12 px-4 py-3 bg-frosted-blue/20 border border-coffee-bean/10 rounded-xl focus:border-coffee-bean/40 focus:ring-1 focus:ring-coffee-bean/40 outline-none transition text-sm text-coffee-bean placeholder-coffee-bean/40"
                        placeholder="Ulangi kata sandi">
                    <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-coffee-bean/50 hover:text-coffee-bean text-xl cursor-pointer"
                        aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-2 text-xs text-black-cherry font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center sm:justify-start gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-sm transition duration-150 shadow-sm cursor-pointer min-w-[140px]">
                    <span class="text-base flex items-center"><ion-icon name="save-outline"></ion-icon></span>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('admin.user.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-frosted-blue/30 hover:bg-frosted-blue/50 text-coffee-bean rounded-xl font-bold text-sm transition duration-150 cursor-pointer min-w-[140px]">
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(fieldId, button) {
            const input = document.getElementById(fieldId);
            if (!input) return;
            const icon = button.querySelector('ion-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.name = 'eye-outline';
            } else {
                input.type = 'password';
                icon.name = 'eye-off-outline';
            }
        }
    </script>
@endsection
