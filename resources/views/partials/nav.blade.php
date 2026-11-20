<nav class="nav" aria-label="Main Navigation">
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-dot" aria-hidden="true"></span>
        Portal Berita
    </a>

    <a href="{{ route('home') }}"
       class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

    @auth
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('articles.index') }}"
           class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Artikel</a>

        <div class="right">
            <span class="user-chip">
                <span class="avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                {{ auth()->user()->name }}
            </span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="btn btn-outline">Logout</button>
            </form>
        </div>
    @endauth

    @guest
        <div class="right">
            <a href="{{ route('login') }}"
               class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
            <a href="{{ route('register') }}"
               class="btn btn-primary {{ request()->routeIs('register') ? 'active' : '' }}">Daftar</a>
        </div>
    @endguest
</nav>
