@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-wrap">
    <section class="card">
        <h1>Buat Akun</h1>
        <p class="muted">Daftar untuk mulai menulis dan mengelola berita.</p>

        <form method="POST" action="{{ url('/register') }}" novalidate>
            @csrf

            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   required autocomplete="name" autofocus
                   class="@error('name') is-invalid @enderror">
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   required autocomplete="email"
                   class="@error('email') is-invalid @enderror">
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required
                   autocomplete="new-password"
                   class="@error('password') is-invalid @enderror">
            <p class="muted" style="margin: .25rem 0 0;">Minimal 8 karakter.</p>
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Ulangi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   required autocomplete="new-password">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </div>
        </form>

        <p class="auth-footer muted center">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </section>
</div>
@endsection
