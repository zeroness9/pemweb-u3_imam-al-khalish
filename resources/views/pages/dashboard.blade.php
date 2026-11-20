@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="card hero">
    <p class="eyebrow">Dashboard</p>
    <h1>Halo, {{ $user->name }}</h1>
    <p class="muted" style="margin-bottom: 0;">
        Ini ringkasan singkat aktivitas artikel di aplikasi.
    </p>
</section>

<section class="row">
    <div class="card">
        <h3>Total Artikel</h3>
        <p class="stat-value">{{ $totalArticles }}</p>
        <p class="muted">Seluruh artikel yang ada di sistem.</p>
    </div>
    <div class="card">
        <h3>Artikel Kamu</h3>
        <p class="stat-value">{{ $myArticles }}</p>
        <p class="muted">Artikel yang kamu tulis sendiri.</p>
    </div>
    <div class="card">
        <h3>Aksi Cepat</h3>
        <div class="actions" style="margin-top: .5rem;">
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Artikel Baru</a>
            <a href="{{ route('articles.index') }}" class="btn btn-outline">Semua Artikel</a>
            <a href="{{ route('home') }}" class="btn btn-outline">Halaman Home</a>
        </div>
    </div>
</section>

<section class="card">
    <div class="section-head">
        <div>
            <p class="eyebrow" style="margin-bottom: .1rem;">Terkini</p>
            <h3>Artikel Terbaru</h3>
        </div>
        <a href="{{ route('articles.index') }}">Lihat semua &rarr;</a>
    </div>

    @if ($latestArticles->isNotEmpty())
        <div class="stack">
            @foreach ($latestArticles as $article)
                <article class="article-card">
                    <img src="{{ $article->image_url }}"
                         alt="Thumbnail {{ $article->title }}"
                         class="thumb thumb-sm">

                    <div>
                        <h3>
                            <a href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="meta">
                            oleh {{ $article->user->name }}
                            &bull; {{ $article->created_at->format('d M Y') }}
                        </p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($article->body, 110) }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="muted">Belum ada artikel yang bisa ditampilkan.</p>
    @endif
</section>

<section class="card">
    <h3>Info Akun</h3>
    <ul>
        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
    </ul>
    <p class="muted" style="margin-bottom: 0;">
        Gunakan menu di navbar untuk berpindah antara Home, Artikel, dan Dashboard.
    </p>
</section>
@endsection
