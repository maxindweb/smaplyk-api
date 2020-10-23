<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PostCategory extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
        'category',
        'slug'
    ];

    public function Post()
    {
        return $this->hasMany(Post::class);
    }

    public function getSlugOption()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug');
    }
}
