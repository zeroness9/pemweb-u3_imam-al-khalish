@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-wrap">
    <section class="card">
        <h1>Masuk</h1>
        <p class="muted">Gunakan email dan password akunmu untuk melanjutkan.</p>

        <form method="POST" action="{{ url('/login') }}" novalidate>
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                   required autocomplete="email" autofocus
                   class="@error('email') is-invalid @enderror">
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required
                   autocomplete="current-password"
                   class="@error('password') is-invalid @enderror">
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <label class="check" for="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                Ingat saya
            </label>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
        </form>

        <p class="auth-footer muted center">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </section>
</div>
@endsection
