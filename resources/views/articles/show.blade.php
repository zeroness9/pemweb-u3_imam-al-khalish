@extends('layouts.app')

@section('title', $article->title)

@section('content')
<section class="card">
    <p class="eyebrow">Berita</p>
    <h1 style="margin-bottom: .35rem;">{{ $article->title }}</h1>
    <p class="meta">
        Dipublikasikan pada {{ $article->created_at->format('d M Y') }}
        oleh <strong>{{ $article->user->name }}</strong>
    </p>

    <div style="margin: 1rem 0;">
        <img src="{{ $article->image_url }}"
             alt="Gambar untuk {{ $article->title }}"
             class="thumb-full">
    </div>

    <div class="article-body">
        {!! nl2br(e($article->body)) !!}
    </div>

    <div class="actions" style="margin-top: 1.75rem;">
        <a href="{{ route('home') }}" class="btn btn-outline">&larr; Kembali ke Home</a>
        <a href="{{ route('articles.index') }}" class="btn btn-outline">Semua Artikel</a>
        @auth
            @if ($article->user_id === auth()->id())
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">Edit Artikel</a>
            @endif
        @endauth
    </div>
</section>
@endsection
