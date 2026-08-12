@extends('layout.user')

@section('title', 'Galeri')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Galeri</p>
                    <h1 class="mt-2 text-3xl font-black text-coffee-bean">Galeri Baros Coffee</h1>
                </div>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($galleries as $gallery)
                    <div class="overflow-hidden rounded-3xl border border-coffee-bean/10 bg-cornsilk">
                        @php
                            $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                            $imageUrl = $gallery->foto
                                ? (Str::startsWith($gallery->foto, ['http://', 'https://'])
                                    ? $gallery->foto
                                    : $baseUrl . '/' . ltrim($gallery->foto, '/'))
                                : asset('assets/home/home 2.png');
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $gallery->caption ?? 'Galeri Baros Coffee' }}"
                            onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                            class="h-60 w-full object-cover">
                    </div>
                @empty
                    <p class="text-sm text-coffee-bean/60">Belum ada galeri.</p>
                @endforelse
            </div>

            @if ($galleries->hasPages())
                <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                    {{ $galleries->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection
