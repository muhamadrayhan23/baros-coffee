@extends('layout.user')

@section('title', 'Artikel')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Artikel Baros Coffee</p>
                    <h1 class="mt-2 text-3xl font-black text-coffee-bean">Artikel</h1>
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($articles as $article)
                    <div class="rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4">
                        @php
                            $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                            $imageUrl = $article->thumbnail
                                ? (Str::startsWith($article->thumbnail, ['http://', 'https://'])
                                    ? $article->thumbnail
                                    : $baseUrl . '/' . ltrim($article->thumbnail, '/'))
                                : asset('assets/home/home 2.png');
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $article->judul }}"
                            onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                            class="h-48 w-full rounded-[1.2rem] object-cover">
                        <h2 class="mt-4 text-xl font-bold text-coffee-bean">{{ $article->judul }}</h2>
                        <p class="mt-2 text-sm leading-7 text-coffee-bean/70">
                            {{ Str::limit(strip_tags($article->isi), 120) }}</p>
                        <a href="{{ route('user.article.detail', $article->id) }}"
                            class="mt-4 inline-flex text-sm font-semibold text-black-cherry">Baca Selengkapnya</a>
                    </div>
                @empty
                    <p class="text-sm text-coffee-bean/60">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
