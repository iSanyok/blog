<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $articles = Article::latest()->paginate(3);
        return view('index', compact('articles'));
    }

    public function profile($id)
    {
        $author = User::find($id);
        return view('profile', compact('author'));
    }
}
