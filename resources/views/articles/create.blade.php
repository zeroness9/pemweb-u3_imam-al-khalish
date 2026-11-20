@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<section class="card">
    <p class="eyebrow">Tulis</p>
    <h1 style="margin-bottom: .35rem;">Tambah Artikel / Berita</h1>
    <p class="muted">
        Isi formulir di bawah untuk menambahkan berita baru. Gambar menggunakan
        URL (opsional); jika kosong, sistem memakai placeholder online.
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

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <label for="title">Judul Artikel</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}"
               required placeholder="Masukkan judul berita"
               class="@error('title') is-invalid @enderror">
        @error('title')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <label for="image">URL Gambar (opsional)</label>
        <input type="url" id="image" name="image" value="{{ old('image') }}"
               placeholder="https://example.com/gambar.jpg"
               class="@error('image') is-invalid @enderror">
        <p class="muted" style="margin: .25rem 0 0;">
            Jika dikosongkan, sistem memakai gambar placeholder dari
            <code>picsum.photos</code>.
        </p>
        @error('image')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <label for="body">Isi Berita</label>
        <textarea id="body" name="body" rows="10" required
                  placeholder="Tulis isi berita di sini..."
                  class="@error('body') is-invalid @enderror">{{ old('body') }}</textarea>
        @error('body')
            <p class="field-error">{{ $message }}</p>
        @enderror

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</section>
@endsection
