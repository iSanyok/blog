<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SidebarController extends Controller
{
    public function getToday(): JsonResponse
    {
        return $this->response(0);
    }

    public function getWeek(): JsonResponse
    {
        return $this->response(7);
    }

    public function getMouth(): JsonResponse
    {
        return $this->response(30);
    }

    public function getYear(): JsonResponse
    {
        return $this->response(365);
    }

    private function response(int $days): JsonResponse
    {
        $articles = Article::selectRaw('articles.*, sum(likes.liked) likes')
            ->leftJoin('likes', 'likes.article_id', '=', 'articles.id')
            ->where('articles.created_at', '>', Carbon::now()->subDays($days))
            ->groupBy('likes.article_id')
            ->orderBy('likes', 'desc')
            ->take(5)
            ->get();

        $response = [];

        foreach($articles as $article) {
            $arr['id'] = $article->id;
            $arr['author_id'] = $article->author_id;
            $arr['title'] = $article->title;
            $arr['description'] = $article->description;
            $arr['body'] = $article->body;
            $arr['banner'] = asset("banners") . "/" . $article->banner;
            $arr['likes'] = $article->likes;
            $arr['updated'] = $article->updated_at->format('d.m.Y');

            $response[] = $arr;
        }

        return response()->json($response, 200);
    }
}
