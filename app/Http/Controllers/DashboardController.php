<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalArticles = Article::count();
        $myArticles = $user->articles()->count();
        $latestArticles = Article::with('user')->latest()->take(5)->get();

        return view('pages.dashboard', compact(
            'user',
            'totalArticles',
            'myArticles',
            'latestArticles'
        ));
    }
}
