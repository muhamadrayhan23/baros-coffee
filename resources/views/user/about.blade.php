@extends('layout.user')

@section('title', 'Profil')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div
            class="grid gap-8 rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm lg:grid-cols-[0.95fr_1.05fr] lg:p-10">
            <div class="overflow-hidden rounded-3xl border border-coffee-bean/10">
                <img src="{{ asset('assets/about/about-5.jpeg') }}" alt="Profil Baros Coffee"
                    class="h-full w-full object-cover">
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Tentang Kami</p>
                <h1 class="mt-3 text-3xl font-black text-coffee-bean sm:text-4xl">Kopi Baros, warisan hulu yang tumbuh secara
                    organik</h1>
                <p class="mt-5 text-sm leading-8 text-coffee-bean/75">
                    Kopi Baros merupakan jenama kopi specialty organik dari hulu Desa Baros, Arjasari, Kabupaten Bandung,
                    yang tumbuh di lereng Gunung Sangar-Malabar. Lahir dari kegelisahan terhadap maraknya pertanian kimia,
                    sejak tahun 2010 perkebunan yang diinisiasi oleh Pak Ika selaku pemilik kebun melakukan restorasi lahan
                    secara total dengan beralih penuh ke metode pertanian organik.
                </p>
                <p class="mt-4 text-sm leading-8 text-coffee-bean/75">
                    Pemulihan hulu ekosistem ini didukung oleh inovasi pupuk organik cair berbahan limbah batang pisang
                    untuk menaikkan dan pupuk kandang, serta pemanfaatan air murni dari mata air lokal Ciberecek yang
                    dilindungi kelestariannya demi keberlanjutan hidrologi kawasan.
                </p>
                <p class="mt-4 text-sm leading-8 text-coffee-bean/75">
                    Secara bisnis, Kopi Baros mengusung nilai konsumsi berkesadaran (conscious consumerism) dan kejelasan
                    asal-usul produk untuk memutus rantai tengkulak tradisional. Melalui pendekatan ini, proses konservasi
                    lingkungan di hulu diintegrasikan secara transparan dengan penyajian produk premium di hilir guna
                    meningkatkan daya saing komoditas lokal. Narasi integritas inilah yang melekat kuat pada identitas Kopi
                    Baros, menjadikannya simbol pemulihan tanah hulu yang tidak hanya menyajikan secangkir kopi berkualitas
                    tinggi, tetapi juga memberdayakan ekonomi para petani secara adil dan berkelanjutan.
                </p>
            </div>
        </div>
    </section>
@endsection
