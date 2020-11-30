<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use \Conner\Tagging\Taggable;


class Post extends Model
{
    use HasFactory,HasSlug,InteractsWithMedia,Taggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'post_category_id',
        'user_id',
        'tags',
        'is_published'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->belongsTo(PostComment::class);
    }

    //slug option
    public function getSlugOptions() : SlugOptions
{
    return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug');
        // ->allowDuplicateSlugs();
}

    //
}
