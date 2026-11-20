@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="card hero">
    <p class="eyebrow">Portal Berita</p>
    <h1>Kabar terbaru dalam satu tempat</h1>
    <p>
        Selamat datang di portal berita sederhana berbasis Laravel.
        Berita di bawah ini diambil langsung dari tabel <code>articles</code>.
    </p>

    @guest
        <p class="muted">
            Kamu belum login. Untuk mengelola berita, silakan masuk atau buat akun
            terlebih dahulu.
        </p>
        <div class="actions">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
        </div>
    @endguest

    @auth
        <p class="muted">
            Kamu login sebagai <strong>{{ auth()->user()->name }}</strong>.
            Kelola berita melalui menu <a href="{{ route('articles.index') }}">Artikel</a>.
        </p>
        <div class="actions">
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Berita</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline">Buka Dashboard</a>
        </div>
    @endauth
</section>

<section class="card">
    <div class="section-head">
        <div>
            <p class="eyebrow" style="margin-bottom: .1rem;">Terkini</p>
            <h2>Berita Terbaru</h2>
        </div>
        @auth
            <a href="{{ route('articles.index') }}">Lihat semua artikel &rarr;</a>
        @endauth
    </div>

    @if ($articles->isNotEmpty())
        <div class="stack">
            @foreach ($articles as $article)
                <article class="article-card">
                    <img src="{{ $article->image_url }}"
                         alt="Gambar {{ $article->title }}"
                         class="thumb">

                    <div>
                        <h3>
                            <a href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="meta">
                            {{ $article->created_at->format('d M Y') }}
                            &bull; oleh {{ $article->user->name }}
                        </p>
                        <p>
                            {{ \Illuminate\Support\Str::limit($article->body, 150) }}
                        </p>
                        <a href="{{ route('articles.show', $article) }}">Baca selengkapnya &rarr;</a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="muted">
            Belum ada berita yang tersedia.
            @auth
                Silakan buat berita baru di menu
                <a href="{{ route('articles.create') }}">Tambah Artikel</a>.
            @endauth
        </p>
    @endif
</section>
@endsection
