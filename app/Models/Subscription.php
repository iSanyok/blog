<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'auhtor_id',
        'follower_id',
    ];

    public function followers(): HasMany
    {
        return $this->hasMany(User::class, 'follower_id');
    }

    public function authors(): HasMany
    {
        return $this->hasMany(User::class, 'author_id');
    }
}
