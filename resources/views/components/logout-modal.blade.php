<!-- Logout Confirmation Modal -->
<div id="logout-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-md"></div>

    <!-- Modal Card -->
    <div class="relative bg-white rounded-2xl shadow-2xl shadow-coffee-bean/30 max-w-sm w-full p-8 text-center transform transition-all duration-300 scale-95 opacity-0"
        id="logout-modal-card">
        <!-- Icon -->
        <div class="mx-auto h-16 w-16 bg-black-cherry/10 rounded-full flex items-center justify-center mb-5">
            <ion-icon name="log-out-outline" class="text-black-cherry text-3xl"></ion-icon>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-extrabold text-coffee-bean mb-2">Konfirmasi Keluar</h3>

        <!-- Message -->
        <p class="text-sm text-coffee-bean/70 mb-8 leading-relaxed">
            Apakah Anda yakin ingin keluar dari dashboard admin?
        </p>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3">
            <!-- Batal Button -->
            <button type="button" id="logout-cancel"
                class="flex-1 min-w-0 py-3 px-4 border-2 border-coffee-bean/20 bg-transparent hover:bg-coffee-bean/5 text-coffee-bean font-bold text-sm rounded-xl transition-all duration-200 cursor-pointer">
                Batal
            </button>

            <!-- Ya, Keluar Button -->
            <form action="{{ route('logout') }}" method="POST" class="flex-1 min-w-0" id="logout-form">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-black-cherry hover:bg-black-cherry/90 text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-black-cherry/25 cursor-pointer">
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('logout-modal');
        const modalCard = document.getElementById('logout-modal-card');
        const cancelBtn = document.getElementById('logout-cancel');

        // Function to open modal
        window.openLogoutModal = function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Trigger animation
            requestAnimationFrame(() => {
                modalCard.classList.remove('scale-95', 'opacity-0');
                modalCard.classList.add('scale-100', 'opacity-100');
            });
        };

        // Function to close modal
        function closeLogoutModal() {
            modalCard.classList.remove('scale-100', 'opacity-100');
            modalCard.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        // Close on cancel button
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeLogoutModal);
        }

        // Close on backdrop click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLogoutModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeLogoutModal();
            }
        });
    });
</script>
