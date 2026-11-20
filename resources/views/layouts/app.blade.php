<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portal Berita') - Portal Berita</title>
    <style>
        :root {
            --bg: #f3f5f8;
            --surface: #ffffff;
            --text: #1b2430;
            --muted: #64748b;
            --border: #e2e8f0;
            --accent: #0f766e;
            --accent-dark: #0b5c56;
            --accent-soft: #e6f4f1;
            --danger: #b91c1c;
            --danger-soft: #fdecec;
            --shadow: 0 1px 2px rgba(15, 23, 42, .05);
            --shadow-hover: 0 8px 24px rgba(15, 23, 42, .08);
            --radius: 14px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 { line-height: 1.25; letter-spacing: -.015em; }

        a { color: var(--accent); text-decoration-thickness: 1px; text-underline-offset: 2px; }
        a:hover { color: var(--accent-dark); }

        img { max-width: 100%; }

        .container {
            max-width: 1060px;
            margin: 0 auto;
            padding: 1.25rem;
        }

        /* ---------- Header ---------- */
        .site-header {
            background: rgba(255, 255, 255, .96);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(6px);
        }

        .site-header .container {
            padding-top: .75rem;
            padding-bottom: .75rem;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-weight: 800;
            font-size: 1.05rem;
            color: var(--text);
            text-decoration: none;
            margin-right: .6rem;
        }

        .brand:hover { color: var(--text); }

        .brand-dot {
            width: .7rem;
            height: .7rem;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-soft);
        }

        .nav {
            display: flex;
            gap: .25rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav > a:not(.brand):not(.btn) {
            text-decoration: none;
            color: var(--muted);
            padding: .42rem .72rem;
            border-radius: .55rem;
            font-weight: 600;
            font-size: .93rem;
            transition: background .15s, color .15s;
        }

        .nav > a:not(.brand):not(.btn):hover {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .nav > a:not(.brand):not(.btn).active {
            background: var(--accent-soft);
            color: var(--accent);
        }

        .nav .right {
            margin-left: auto;
            display: flex;
            gap: .5rem;
            align-items: center;
        }

        .nav .user-chip {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .3rem .65rem .3rem .35rem;
            border: 1px solid var(--border);
            border-radius: 999px;
            font-size: .88rem;
            color: var(--muted);
            background: #fbfcfd;
        }

        .avatar {
            width: 1.7rem;
            height: 1.7rem;
            border-radius: 50%;
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 700;
            font-size: .78rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
        }

        /* ---------- Layout ---------- */
        .site-footer {
            margin-top: 2.5rem;
            padding: 1.5rem 0;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: .88rem;
            text-align: center;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.4rem;
            box-shadow: var(--shadow);
        }

        .card + .card,
        .card + .row,
        .row + .card,
        .card + .stack {
            margin-top: 1rem;
        }

        .card h1, .card h2, .card h3 { margin-top: 0; }

        .row {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .row > .card { margin-top: 0; }

        .stack { display: grid; gap: 1rem; }

        .muted { color: var(--muted); font-size: .93rem; }

        .center { text-align: center; }

        .eyebrow {
            margin: 0 0 .35rem;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .hero {
            border-left: 4px solid var(--accent);
            padding-left: 1.5rem;
        }

        .hero h1 { margin: 0 0 .5rem; font-size: clamp(1.6rem, 3vw, 2.15rem); }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: .9rem;
        }

        .section-head h2, .section-head h3 { margin: 0; }

        /* ---------- Article cards ---------- */
        .article-card {
            display: flex;
            gap: 1rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: .85rem;
            background: var(--surface);
            transition: box-shadow .18s, border-color .18s, transform .18s;
        }

        .article-card:hover {
            border-color: #cbd5e1;
            box-shadow: var(--shadow-hover);
            transform: translateY(-1px);
        }

        .article-card h3 { margin: 0 0 .2rem; font-size: 1.06rem; }

        .article-card h3 a { color: var(--text); text-decoration: none; }
        .article-card h3 a:hover { color: var(--accent); }

        .article-card p { margin: 0 0 .45rem; }

        .thumb {
            width: 220px;
            height: 140px;
            object-fit: cover;
            border-radius: 9px;
            flex-shrink: 0;
            background: var(--border);
        }

        .thumb-sm { width: 128px; height: 84px; }

        .thumb-full {
            width: 100%;
            max-height: 360px;
            object-fit: cover;
            border-radius: 12px;
            background: var(--border);
        }

        .meta { color: var(--muted); font-size: .88rem; }

        .article-body {
            margin-top: 1rem;
            max-width: 72ch;
            font-size: 1.02rem;
        }

        /* ---------- Stats ---------- */
        .stat-value {
            font-size: 2.1rem;
            font-weight: 800;
            margin: .2rem 0;
            color: var(--accent);
            letter-spacing: -.03em;
        }

        /* ---------- Buttons ---------- */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            border: 1px solid transparent;
            border-radius: .55rem;
            padding: .52rem .95rem;
            font: inherit;
            font-weight: 650;
            font-size: .92rem;
            line-height: 1.2;
            text-decoration: none;
            cursor: pointer;
            background: #eef1f4;
            color: var(--text);
            transition: background .15s, color .15s, border-color .15s;
        }

        .btn:hover { background: #e3e8ee; color: var(--text); }

        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-dark); color: #fff; }

        .btn-outline {
            background: transparent;
            border-color: var(--border);
            color: var(--text);
        }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-soft); }

        .btn-danger { background: var(--danger-soft); color: var(--danger); }
        .btn-danger:hover { background: #f9d7d7; color: var(--danger); }

        .btn-block { width: 100%; }

        button { font-family: inherit; }

        .actions {
            display: flex;
            gap: .4rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-actions {
            margin-top: 1.2rem;
            display: flex;
            gap: .6rem;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ---------- Lists ---------- */
        .list-clean {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: .6rem;
        }

        .list-clean li {
            display: flex;
            gap: .85rem;
            align-items: center;
            flex-wrap: wrap;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: .7rem .9rem;
            transition: border-color .15s, background .15s;
        }

        .list-clean li:hover { border-color: #cbd5e1; background: #fbfcfd; }

        .list-clean li .spacer { margin-left: auto; }

        .list-clean .list-thumb {
            width: 96px;
            height: 66px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
            background: var(--border);
        }

        .list-clean .list-main { min-width: 0; }
        .list-clean .list-main > a { font-weight: 650; text-decoration: none; }
        .list-clean .list-main > a:hover { text-decoration: underline; }

        /* ---------- Alerts ---------- */
        .flash {
            background: #e8f6ee;
            border: 1px solid #b7dfc3;
            color: #14532d;
            padding: .7rem .9rem;
            border-radius: 9px;
            margin-bottom: 1rem;
            font-size: .95rem;
        }

        .error {
            background: var(--danger-soft);
            border: 1px solid #f5c2bd;
            color: var(--danger);
            padding: .7rem .9rem;
            border-radius: 9px;
            margin-bottom: 1rem;
            font-size: .95rem;
        }

        .error ul { margin: .35rem 0 0; padding-left: 1.2rem; }

        /* ---------- Forms ---------- */
        form label {
            display: block;
            margin-top: .9rem;
            margin-bottom: .3rem;
            font-weight: 650;
            font-size: .92rem;
        }

        input[type=text],
        input[type=url],
        input[type=email],
        input[type=password],
        textarea {
            width: 100%;
            padding: .58rem .72rem;
            border: 1px solid var(--border);
            border-radius: 9px;
            font: inherit;
            background: #fff;
            color: var(--text);
            transition: border-color .15s, box-shadow .15s;
        }

        textarea { resize: vertical; min-height: 8rem; }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }

        input.is-invalid, textarea.is-invalid {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px var(--danger-soft);
        }

        .field-error {
            margin: .3rem 0 0;
            color: var(--danger);
            font-size: .84rem;
        }

        .check {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-top: 1rem;
            font-weight: 500;
            font-size: .92rem;
            color: var(--text);
        }

        .check input { width: auto; }

        .auth-wrap {
            max-width: 460px;
            margin: 1rem auto;
        }

        .auth-wrap .card { padding: 1.8rem; }
        .auth-wrap h1 { margin-bottom: .25rem; font-size: 1.6rem; }
        .auth-wrap .muted { margin-top: 0; }
        .auth-footer { margin-top: 1.1rem; font-size: .92rem; }

        /* ---------- Pagination ---------- */
        .pagination {
            display: flex;
            gap: .3rem;
            list-style: none;
            padding: 0;
            margin: 1.2rem 0 0;
            flex-wrap: wrap;
        }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            min-width: 2.15rem;
            text-align: center;
            padding: .38rem .62rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            background: #fff;
            font-size: .9rem;
        }

        .pagination li a:hover { border-color: var(--accent); color: var(--accent); }

        .pagination li.active span {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            font-weight: 700;
        }

        .pagination li.disabled span { color: #b6bec9; background: #f8fafc; }

        @media (max-width: 640px) {
            .container { padding: 1rem; }
            .article-card { flex-direction: column; }
            .thumb { width: 100%; height: 190px; }
            .thumb-sm { width: 100%; height: 150px; }
            .nav .right { margin-left: 0; width: 100%; justify-content: flex-start; }
            .list-clean li .spacer { margin-left: 0; }
            .hero { padding-left: 1.1rem; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container">
            @include('partials.nav')
        </div>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            &copy; {{ date('Y') }} Portal Berita &middot; Praktikum Pemrograman Web
        </div>
    </footer>
</body>
</html>
