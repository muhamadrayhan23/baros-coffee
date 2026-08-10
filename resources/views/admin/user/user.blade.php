@extends('layout.admin')

@section('title', 'Pengguna')

@section('content')
    <div class="bg-white border border-coffee-bean/10 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-coffee-bean/10 pb-5">
            <div>
                <h2 class="text-xl font-extrabold tracking-tight text-coffee-bean">Manajemen Pengguna</h2>
                <p class="text-xs opacity-65">Kelola akun administrator dan pengguna terdaftar</p>
            </div>
            <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:items-end sm:ml-auto">
                <a href="{{ route('admin.user.create') }}"
                    class="inline-flex items-center justify-center space-x-2 px-4 py-2 bg-coffee-bean hover:bg-coffee-bean/95 text-cornsilk rounded-xl font-bold text-xs transition duration-150 shadow-sm cursor-pointer">
                    <span class="text-lg flex items-center"><ion-icon name="add-outline"></ion-icon></span>
                    <span>Tambah Pengguna</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6">
            <label class="relative block w-full sm:w-56">
                <!-- Input Field (Teks/Placeholder di kiri, padding kanan pr-10 memberi ruang untuk icon) -->
                <input type="text" data-search-input placeholder="Cari pengguna..."
                    class="w-full rounded-xl border border-coffee-bean/10 bg-cornsilk pl-4 pr-10 py-2 text-sm text-coffee-bean outline-none transition focus:border-coffee-bean/40 placeholder:text-coffee-bean/50" />

                <!-- Icon Search (Dipindah ke sebelah kanan dengan right-3) -->
                <span
                    class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 flex items-center text-coffee-bean/50 text-base">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
            </label>
        </div>

        <!-- Table Listing -->
        <div class="border border-coffee-bean/10 rounded-2xl overflow-hidden bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-coffee-bean/10 bg-frosted-blue/10 text-xs font-bold opacity-75">
                            <th class="px-6 py-3.5 w-12 text-center">No</th>
                            <th class="px-6 py-3.5">Nama Lengkap</th>
                            <th class="px-6 py-3.5">Email</th>
                            <th class="px-6 py-3.5">Tanggal Terdaftar</th>
                            <th class="px-6 py-3.5 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body" class="divide-y divide-coffee-bean/5">
                        @forelse($users as $index => $user)
                            <tr data-search-item
                                data-search="{{ strtolower($user->name) }} {{ strtolower($user->email) }} {{ strtolower(\Carbon\Carbon::parse($user->created_at)->translatedFormat('d M Y')) }}"
                                class="hover:bg-frosted-blue/5 transition duration-150">
                                <td class="px-6 py-4 font-bold opacity-60 text-center">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                                </td>
                                <td class="px-6 py-4 font-bold text-coffee-bean">{{ $user->name }}</td>
                                <td class="px-6 py-4 font-medium opacity-85">{{ $user->email }}</td>
                                <td class="px-6 py-4 font-medium opacity-70">
                                    {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d M Y') ?? date('d M Y', strtotime($user->created_at)) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Action -->
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-frosted-blue/30 hover:bg-frosted-blue text-coffee-bean rounded-xl transition duration-150 shadow-sm"
                                            title="Ubah Pengguna">
                                            <ion-icon name="create-outline" class="text-base"></ion-icon>
                                            <span class="text-xs font-semibold">Edit</span>
                                        </a>

                                        <!-- Delete Action (Only for other users) -->
                                        @if (auth()->id() !== $user->id)
                                            <button type="button" data-route="{{ route('admin.user.destroy', $user->id) }}"
                                                data-user-name="{{ $user->name }}" onclick="openDeleteUserModal(this)"
                                                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-black-cherry/10 hover:bg-black-cherry hover:text-cornsilk text-black-cherry rounded-xl transition duration-150 shadow-sm cursor-pointer"
                                                title="Hapus Pengguna">
                                                <span>Hapus</span>
                                                <ion-icon name="trash-outline" class="text-lg"></ion-icon>
                                            </button>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-[10px] font-bold bg-deep-forest/10 text-deep-forest border border-deep-forest/20">
                                                Aktif (Anda)
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr id="user-empty-state-row" class="hidden">
                                <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                    <ion-icon name="people-outline"
                                        class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                    <span>Tidak ada pengguna yang sesuai dengan pencarian.</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm opacity-55">
                                    <ion-icon name="people-outline"
                                        class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                    <span>Tidak ada data pengguna yang ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                        <tr id="user-empty-state-row" class="hidden">
                            <td colspan="5" class="px-6 py-12 text-center text-sm opacity-55">
                                <ion-icon name="people-outline"
                                    class="text-4xl mb-2 block mx-auto text-coffee-bean/50"></ion-icon>
                                <span>Pengguna tidak ditemukan</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-coffee-bean/10">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="delete-user-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-coffee-bean/70 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <h3 class="text-xl font-extrabold text-coffee-bean">Konfirmasi Hapus Pengguna</h3>
            <p class="mt-3 text-sm text-coffee-bean/75">Yakin ingin menghapus <span id="delete-user-name"
                    class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="delete-user-form" method="POST" class="mt-6 space-y-4">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closeDeleteUserModal()"
                        class="flex-1 rounded-3xl border border-coffee-bean/10 bg-cornsilk px-4 py-3 text-sm font-semibold text-coffee-bean hover:bg-coffee-bean/5 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 rounded-3xl bg-black-cherry px-4 py-3 text-sm font-semibold text-white hover:bg-black-cherry/90 transition">Hapus
                        Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteUserModal(button) {
            const modal = document.getElementById('delete-user-modal');
            const form = document.getElementById('delete-user-form');
            const userNameLabel = document.getElementById('delete-user-name');

            form.setAttribute('action', button.getAttribute('data-route'));
            userNameLabel.textContent = button.getAttribute('data-user-name');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteUserModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('delete-user-modal');
            const cancelButton = document.getElementById('delete-user-cancel');

            if (modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeDeleteUserModal();
                    }
                });
            }

            if (cancelButton) {
                cancelButton.addEventListener('click', closeDeleteUserModal);
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    closeDeleteUserModal();
                }
            });

            const searchInput = document.querySelector('[data-search-input]');
            const rows = Array.from(document.querySelectorAll('[data-search-item]'));
            const emptyStateRow = document.getElementById('user-empty-state-row');

            if (!searchInput || !emptyStateRow) {
                return;
            }

            if (!rows.length) {
                emptyStateRow.classList.remove('hidden');
                return;
            }

            const normalize = (value) => (value || '').toLowerCase().trim();

            function filterRows(query) {
                const term = normalize(query);
                let visibleCount = 0;

                rows.forEach(function(row) {
                    const matches = normalize(row.getAttribute('data-search')).includes(term);
                    row.style.display = matches ? '' : 'none';
                    if (matches) {
                        visibleCount++;
                    }
                });

                emptyStateRow.classList.toggle('hidden', visibleCount > 0);
            }

            searchInput.addEventListener('input', function() {
                filterRows(this.value);
            });
        });
    </script>
@endsection
