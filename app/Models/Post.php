<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'user_id',
        'tag_id'
    ];

    public function Category()
    {
        return $this->belongTo(Category::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getSlugoption()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
