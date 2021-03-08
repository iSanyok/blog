<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Показать один пост
     *
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $article = Article::find($id);
        $comments = $article->comments;
        $likes = $article->likes->where('liked', true);
        $dislikes = $article->likes->where('liked', false);

        return view('article.show', compact('article', 'comments', 'likes', 'dislikes'));
    }

    /**
     * Открыть форму для создания поста
     *
     * @return Renderable
     */
    public function add(): Renderable
    {
        return view('article.add');
    }

    /**
     *  Открыть форму для изменения поста
     *
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $article = Article::find($id);
        return view ('article.edit', compact('article'));
    }

    /**
     * Изменить пост из базы данных
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
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

    /**
     * Удалить пост из базы данных
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $article = Article::find($id);
        Storage::delete('banners/' . $article->banner);
        $article->delete();

        return redirect(route('index'));
    }

    /**
     * Сохранить пост в базу данных
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

    /**
     * Оставить комментарий для поста и сохранить его в базу данных
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeComment(int $id, Request $request): RedirectResponse
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

    /**
     * Поставить лайк на пост
     *
     * @param $id
     * @return RedirectResponse
     */
    public function like($id): RedirectResponse
    {
        $article = Article::find($id);
        $article->like();

        return back();
    }

    /**
     * Поставить дизлайк на пост
     *
     * @param $id
     * @return RedirectResponse
     */
    public function dislike($id): RedirectResponse
    {
        $article = Article::find($id);
        $article->dislike();

        return back();
    }
}
