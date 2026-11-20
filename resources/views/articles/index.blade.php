@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<section class="card">
    <div class="section-head">
        <div>
            <p class="eyebrow" style="margin-bottom: .1rem;">Kelola</p>
            <h2>Daftar Artikel</h2>
        </div>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Artikel Baru</a>
    </div>

    @if ($articles->isNotEmpty())
        <ul class="list-clean">
            @foreach ($articles as $article)
                <li>
                    <img src="{{ $article->image_url }}"
                         alt="Thumbnail {{ $article->title }}"
                         class="list-thumb">

                    <div class="list-main">
                        <a href="{{ route('articles.show', $article) }}">
                            {{ $article->title }}
                        </a>
                        <div class="meta">
                            oleh {{ $article->user->name }}
                            &bull; {{ $article->created_at->format('d M Y') }}
                        </div>
                    </div>

                    @if ($article->user_id === auth()->id())
                        <div class="actions spacer">
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

        {{ $articles->links('pagination::default') }}
    @else
        <p class="muted">Belum ada artikel.</p>
    @endif
</section>
@endsection
