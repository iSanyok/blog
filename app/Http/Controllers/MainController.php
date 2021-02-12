<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index ()
    {
        $articles = Article::latest()->get();

        return view('index', compact('articles'));
    }
}
