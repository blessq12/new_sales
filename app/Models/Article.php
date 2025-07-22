<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'cover_image',
        'short_description',
        'content',
        'is_active',
        'views_count',
        'is_scheduled',
        'scheduled_at',
        'published_at',
        'suggested_services_ids',
        'published'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_scheduled' => 'boolean',
        'scheduled_at' => 'datetime',
        'published_at' => 'datetime',
        'suggested_services_ids' => 'array',
        'published' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($article) {

            if (!$article->is_active && $article->getOriginal('is_active')) {
                $article->published_at = null;
            }

            if (!$article->slug && $article->title) {
                $article->slug = \Illuminate\Support\Str::slug($article->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('is_active', false)
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now());
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
