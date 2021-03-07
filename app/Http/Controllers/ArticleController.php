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
    public function show($id)
    {
        $article = Article::find($id);
        $comments = $article->comments;

        return view('article.show', compact('article', 'comments',));
    }

    public function add()
    {
        return view('article.add');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view ('article.edit', compact('article'));
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ]);

        Article::where('id', $id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'body' => $data['body']]);

        if($request->file('banner'))
        {
            $article = Article::find($id);
            Storage::delete('banners/' . $article->banner);
            $request->file('banner')->store('banners');
            Article::where('id', $id)->update(['banner' => $request->file('banner')->hashName()]);
        }

        return redirect(route('show', ['id' => $id]));
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        Storage::delete('banners/' . $article->banner);
        $article->delete();

        return redirect(route('index'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ]);

        $article = new Article($data);
        $article->author_id = Auth::user()->id;

        $request->file('banner')->store('banners');
        $article->banner = $request->file('banner')->hashName();
        $article->save();

        return redirect(route('show', ['id' => $article->id]));
    }

    public function storeComment($id, Request $request)
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

    public function like($id)
    {
        $article = Article::find($id);
        $article->like();

        return back();
    }

    public function dislike($id)
    {
        $article = Article::find($id);
        $article->dislike();

        return back();
    }
}
