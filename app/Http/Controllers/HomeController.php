<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Показать главную страницу сайта
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $articles = Article::latest()->paginate(5);
//        dd($articles[0]->likes);
        $popular = Article::selectRaw('articles.*, sum(likes.liked) likes')
            ->leftJoin('likes', 'likes.article_id', '=', 'articles.id')
            ->groupBy('likes.article_id')
            ->orderBy('likes', 'desc')
            ->take(5)
            ->get();
        return view('index', compact('articles', 'popular'));
    }

    /**
     * Показать профиль пользователя
     *
     * @param int $id
     * @return Renderable
     */
    public function profile(int $id): Renderable
    {
        $author = User::find($id);
        return view('profile', compact('author'));
    }

    /**
     * Подписка на автора
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function subscribe(int $id): RedirectResponse
    {
        $subscription = new Subscription();

        $subscription->author_id = $id;
        $subscription->follower_id = Auth::user()->id;

        $subscription->save();

        return redirect(route('profile', ['id' => $id]));
    }

    /**
     * Отписка от автора
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function unsubscribe(int $id): RedirectResponse
    {
        $subscription = Subscription::where('author_id', $id)->where('follower_id', Auth::user()->id);
        $subscription->delete();

        return redirect(route('profile', ['id' => $id]));
    }
}
