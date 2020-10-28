<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'slug'
    ];

    public function Tag()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
