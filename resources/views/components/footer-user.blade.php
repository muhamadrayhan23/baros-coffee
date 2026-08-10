<footer class="bg-white text-coffee-bean">
    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-3 mb-5 ">
            <div>
                <h3 class="mb-5 text-lg font-semibold">Hubungi Kami</h3>
                <p class="mb-3 text-sm font-medium text-coffee-bean/80">Kontak :</p>
                <p class="mb-4 text-sm">+62 838-6196-9316</p>
                <p class="mb-3 text-sm font-medium text-coffee-bean/80">Lokasi :</p>
                <p class="mb-4 text-sm">Kp. Pakusorok, Desa Baros, Kecamatan Arjasari, Kabupaten Bandung</p>
                <p class="mb-3 text-sm font-medium text-coffee-bean/80">Email :</p>
                <p class="text-sm">kopibaros77@gmail.com</p>
            </div>

            <div>
                <h3 class="mb-5 text-lg font-semibold">Menu</h3>
                <ul class="space-y-3 text-sm text-coffee-bean/90">
                    <li><a href="{{ url('/') }}" class="transition hover:text-coffee-bean">Beranda</a></li>
                    <li><a href="{{ url('/about') }}" class="transition hover:text-coffee-bean">Profil</a></li>
                    <li><a href="{{ url('/product') }}" class="transition hover:text-coffee-bean">Produk</a></li>
                    <li><a href="{{ url('/contact') }}" class="transition hover:text-coffee-bean">Kontak</a></li>
                </ul>
            </div>

            <div class="flex flex-col items-start gap-1">
                <div class="mb-0 w-full max-w-[220px]">
                    <img src="{{ asset('assets/logo/logo 2 remove bg.png') }}" alt="Logo Baros Coffee"
                        class="h-20 w-auto object-contain" />
                </div>
                <div class="w-full">
                    <h3 class="mb-1 text-lg font-semibold">Ikuti Kami</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/6283861969316?"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white text-coffee-bean shadow-sm transition hover:bg-coffee-bean/10"
                            aria-label="WhatsApp">
                            <ion-icon name="logo-whatsapp" class="text-lg"></ion-icon>
                        </a>
                        <a href="https://www.instagram.com/baroscoffe?igsh=MWVjYXlqdjF1dGh6Mw=="
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white text-coffee-bean shadow-sm transition hover:bg-coffee-bean/10"
                            aria-label="Instagram">
                            <ion-icon name="logo-instagram" class="text-lg"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-coffee-bean/10 mb-5"></div>

        <div class="mt-10 pt-10 text-center text-sm text-coffee-bean/70">
            &copy; {{ date('Y') }} Baros Coffee. All Rights Reserved. Crafted with passion.
        </div>
    </div>
</footer>
