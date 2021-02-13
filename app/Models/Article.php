<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
    ];

    public function author ()
    {
        return $this->belongsTo(User::class);
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class);
    }
}
