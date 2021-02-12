<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show ($id)
    {
        $article = Article::find($id);

        return view('article.show', compact('article'));
    }

    public function add ()
    {
        return view('article.add');
    }

    public function store (Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ]);

        $article = new Article($data);
        $article->author_id = Auth::user()->id;
        $article->save();
    }
}
