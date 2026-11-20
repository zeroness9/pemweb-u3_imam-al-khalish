@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<section class="card">
    <p class="eyebrow">Perbarui</p>
    <h1 style="margin-bottom: .35rem;">Edit Artikel / Berita</h1>
    <p class="muted">
        Perbarui data berita di bawah ini. Kosongkan URL gambar untuk kembali
        memakai gambar placeholder.
    </p>

    @if ($errors->any())
        <div class="error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Judul Artikel</label>
        <input type="text" id="title" name="title"
               value="{{ old('title', $article->title) }}"
               required placeholder="Masukkan judul berita"
               class="@error('title') is-invalid @enderror">
        @error('title')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <label for="image">URL Gambar (opsional)</label>
        <input type="url" id="image" name="image"
               value="{{ old('image', $article->image) }}"
               placeholder="https://example.com/gambar.jpg"
               class="@error('image') is-invalid @enderror">
        @error('image')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <p class="muted" style="margin: .75rem 0 .25rem;">Pratinjau gambar saat ini:</p>
        <img src="{{ $article->image_url }}" alt="Gambar artikel"
             style="width: 100%; max-width: 400px; max-height: 220px;
                    object-fit: cover; border-radius: 10px; margin-bottom: 1rem;">

        <label for="body">Isi Berita</label>
        <textarea id="body" name="body" rows="10"
                  required
                  class="@error('body') is-invalid @enderror">{{ old('body', $article->body) }}</textarea>
        @error('body')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</section>
@endsection
