<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function show ($id)
    {
        $article = Article::find($id);
        $comments = Comment::where('article_id', $id)->get();
        $banner = asset('storage/img.jpg');

        return view('article.show', compact('article', 'comments', 'banner'));
    }

    public function add ()
    {
        return view('article.add');
    }

    public function update ($id)
    {

    }

    public function delete ($id)
    {
        $article = Article::find($id);
        $article->delete;

        return redirect()->back();
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

        $path = $request->file('banner')->store('banners');
        $article->banner = $request->file('banner')->hashName();
        $article->save();

        return redirect('/article/' . $article->id);
    }

    public function comment ($id, Request $request)
    {
        $request = $request->validate([
            'content' => 'required',
            'user_id' => 'required|integer',
        ]);

        $comment = new Comment($request);
        $comment->article_id = $id;
        $comment->user_id = $request['user_id'];
        $comment->save();

        return redirect()->back();
    }
}
