<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Post extends Model implements HasMedia
{
    use HasFactory,HasSlug, InteractsWithMedia;

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

    public function Tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    //slug option
    public function getSlugoption()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    //
}
