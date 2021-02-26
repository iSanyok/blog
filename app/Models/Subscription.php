<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'auhtor_id',
        'follower_id',
    ];

    public function followers(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function authors(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
