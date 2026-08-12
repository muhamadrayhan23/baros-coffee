@extends('layout.user')

@section('title', 'Detail Artikel')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="rounded-4xl border border-coffee-bean/10 bg-white p-6 shadow-sm sm:p-8 lg:p-10">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-black-cherry/70">Detail Artikel</p>
            <h1 class="mt-2 text-3xl font-black text-coffee-bean">{{ $article->judul }}</h1>
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
                class="mt-6 h-72 w-full rounded-[1.5rem] object-cover border border-coffee-bean/10">
            <div class="prose prose-sm mt-6 max-w-none text-sm leading-8 text-coffee-bean/75">
                {!! $article->isi !!}
            </div>

            <div class="mt-10 border-coffee-bean/10 pt-8">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-xl font-black text-coffee-bean">Artikel Lainnya</h2>
                </div>

                @if ($relatedArticles->isNotEmpty())
                    <div class="mt-5 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($relatedArticles as $relatedArticle)
                            <a href="{{ route('user.article.detail', $relatedArticle->id) }}"
                                class="group overflow-hidden rounded-3xl border border-coffee-bean/10 bg-cornsilk p-4 transition hover:-translate-y-1 hover:shadow-md">
                                @php
                                    $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
                                    $imageUrl = $relatedArticle->thumbnail
                                        ? (Str::startsWith($relatedArticle->thumbnail, ['http://', 'https://'])
                                            ? $relatedArticle->thumbnail
                                            : $baseUrl . '/' . ltrim($relatedArticle->thumbnail, '/'))
                                        : asset('assets/home/home 2.png');
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $relatedArticle->judul }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/home/home 2.png') }}';"
                                    class="h-48 w-full rounded-[1.2rem] object-cover object-center">
                                <h3 class="mt-4 text-lg font-bold text-coffee-bean">{{ $relatedArticle->judul }}</h3>
                                <p class="mt-2 text-sm leading-7 text-coffee-bean/70">
                                    {{ Str::limit(strip_tags($relatedArticle->isi), 100) }}
                                </p>
                                <span
                                    class="mt-4 inline-flex text-sm font-semibold text-black-cherry transition group-hover:text-black-cherry/90">Baca
                                    Selengkapnya</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="mt-5 text-sm text-coffee-bean/60">Belum ada artikel lainnya.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
