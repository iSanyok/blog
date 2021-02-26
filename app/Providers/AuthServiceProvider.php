<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-article', function (User $author, Article $article) {
            return $author->id === $article->author->id;
        });
        Gate::define('delete-article', function (User $author, Article $article) {
            return $author->id === $article->author->id;
        });
        Gate::define('subscribe', function (User $user, User $author) {
            return count($author->followers->where('follower_id', $user->id));
        });
        Gate::define('view-subscriptions', function (User $user, User $author) {
            return $user->id === $author->id;
        });
    }
}
