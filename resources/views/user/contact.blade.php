@extends('layout.user')

@section('title', 'Kontak')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm lg:p-10">
            <div class="grid gap-8">
                <div class="overflow-hidden rounded-[1.5rem] border border-coffee-bean/10 bg-cornsilk shadow-sm">
                    <img src="{{ asset('assets/about/about 1.png') }}" alt="Baros Coffee" class="w-full h-72 object-cover">
                </div>

                <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Hubungi Kami</p>
                    <h1 class="mt-2 text-3xl font-black text-coffee-bean">Kontak Baros Coffee</h1>
                    <p class="mt-4 text-sm leading-8 text-coffee-bean/70">Jika Anda tertarik untuk bekerja sama, membeli
                        produk, atau sekadar ingin berdiskusi lebih lanjut tentang kopi Baros, kami siap membantu.</p>
                    <div
                        class="mt-6 grid gap-4 rounded-3xl border border-coffee-bean/10 bg-white p-6 text-sm text-coffee-bean/80">
                        <div>
                            <p class="font-semibold text-coffee-bean">Alamat</p>
                            <p class="mt-1">Kp. Pakusorok, Desa Baros, Arjasari, Kabupaten Bandung</p>
                        </div>
                        <div>
                            <p class="font-semibold text-coffee-bean">Email</p>
                            <p class="mt-1">kopibaros77@gmail.com</p>
                        </div>
                        <div>
                            <p class="font-semibold text-coffee-bean">Telepon</p>
                            <p class="mt-1">+62 838-6196-9316</p>
                        </div>
                        <div>
                            <p class="font-semibold text-coffee-bean">Jam Operasional</p>
                            <p class="mt-1">Senin - Minggu, 08.00 - 20.00</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Detail Lokasi</p>
                    <h2 class="mt-2 text-2xl font-black text-coffee-bean">Lokasi Baros Coffee</h2>
                    <p class="mt-4 text-sm leading-7 text-coffee-bean/75">Temukan kedai kami secara langsung di Google Maps.
                        Cukup klik dan lihat petunjuk arah untuk menuju lokasi.</p>
                    <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-coffee-bean/10 shadow-sm">
                        <iframe class="h-[420px] w-full border-0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.41403852082!2d107.6376524!3d-7.0779033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68eb813031124d%3A0x2dd3e32125bb8d31!2sKopi%2098!5e0!3m2!1sid!2sid!4v1785934863317!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
