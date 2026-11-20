<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $request->user()->articles()->create([
            'title' => $data['title'],
            'slug' => $this->makeSlug($data['title']),
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function show(Article $article)
    {
        $article->load('user');

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorizeOwner($article);

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeOwner($article);

        $data = $this->validated($request);

        $article->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy(Article $article)
    {
        $this->authorizeOwner($article);

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /* ---------- helper ---------- */

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'url', 'max:255'],
        ]);
    }

    private function makeSlug(string $title): string
    {
        return Str::slug($title).'-'.Str::lower(Str::random(6));
    }

    private function authorizeOwner(Article $article): void
    {
        abort_unless(
            (int) $article->user_id === (int) Auth::id(),
            403,
            'Kamu tidak berhak mengubah artikel ini.'
        );
    }
}
