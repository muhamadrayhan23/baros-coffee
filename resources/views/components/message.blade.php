<!-- Toast Container -->
<div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-3 max-w-md w-full px-4 sm:px-0">
    <!-- Success Message -->
    @if (session('success'))
        <div class="toast-item bg-deep-forest text-cornsilk p-4 rounded-2xl shadow-xl shadow-deep-forest/25 border border-white/10 flex items-start gap-3 transform translate-x-full transition-all duration-300 ease-out"
            role="alert">
            <span class="text-2xl mt-0.5 flex items-center">
                <ion-icon name="checkmark-circle-outline"></ion-icon>
            </span>
            <div class="flex-1">
                <h4 class="font-extrabold text-sm tracking-wide">Berhasil</h4>
                <p class="text-xs opacity-90 mt-1 leading-relaxed">{{ session('success') }}</p>
            </div>
            <button onclick="dismissToast(this.parentElement)"
                class="text-xl hover:opacity-75 focus:outline-none cursor-pointer">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
    @endif

    <!-- General Error Message -->
    @if (session('error'))
        <div class="toast-item bg-black-cherry text-cornsilk p-4 rounded-2xl shadow-xl shadow-black-cherry/25 border border-white/10 flex items-start gap-3 transform translate-x-full transition-all duration-300 ease-out"
            role="alert">
            <span class="text-2xl mt-0.5 flex items-center">
                <ion-icon name="alert-circle-outline"></ion-icon>
            </span>
            <div class="flex-1">
                <h4 class="font-extrabold text-sm tracking-wide">Kesalahan</h4>
                <p class="text-xs opacity-90 mt-1 leading-relaxed">{{ session('error') }}</p>
            </div>
            <button onclick="dismissToast(this.parentElement)"
                class="text-xl hover:opacity-75 focus:outline-none cursor-pointer">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
    @endif

    <!-- Validation Errors (from form inputs, etc.) -->
    @if ($errors->any())
        <div class="toast-item bg-black-cherry text-cornsilk p-4 rounded-2xl shadow-xl shadow-black-cherry/25 border border-white/10 flex items-start gap-3 transform translate-x-full transition-all duration-300 ease-out"
            role="alert">
            <span class="text-2xl mt-0.5 flex items-center">
                <ion-icon name="warning-outline"></ion-icon>
            </span>
            <div class="flex-1">
                <h4 class="font-extrabold text-sm tracking-wide">Wajib Di Isi</h4>
                <p class="text-xs opacity-90 mt-1 leading-relaxed">Pastikan semua data terisi. Periksa daftar berikut
                    untuk field yang kosong atau salah.</p>
                <ul class="list-disc list-inside text-xs opacity-90 mt-2 space-y-0.5 leading-relaxed">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button onclick="dismissToast(this.parentElement)"
                class="text-xl hover:opacity-75 focus:outline-none cursor-pointer">
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('.toast-item');

        toasts.forEach((toast, index) => {
            // Staggered entry animation
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            }, index * 150 + 50);

            // Auto dismiss after 5 seconds
            setTimeout(() => {
                dismissToast(toast);
            }, 5000);
        });
    });

    function dismissToast(toast) {
        if (toast) {
            // Exit animation
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
            toast.classList.add('opacity-0');

            // Remove from DOM after transition completes
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }
</script>
