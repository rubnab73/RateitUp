<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function topics(): MorphToMany
    {
        return $this->morphedByMany(Topic::class, 'taggable');
    }

    public function reviews(): MorphToMany
    {
        return $this->morphedByMany(Review::class, 'taggable');
    }
}