<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subscription;
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

        return Auth::user()? view('profile', [
            'author' => $author,
            'sub' => $author->followers->where('follower_id', Auth::user()->id),]) :
            view('profile', compact('author'));

    }

    public function subscribe($id)
    {
        $subscription = new Subscription();

        $subscription->author_id = $id;
        $subscription->follower_id = Auth::user()->id;

        $subscription->save();

        return redirect(route('profile', ['id' => $id]));
    }
}
