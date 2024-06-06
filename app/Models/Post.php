<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Enums\PostStatus;
use App\Traits\HasFilter;

class Post extends Model
{
    use HasFactory, HasFilter, Sluggable;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'status' => PostStatus::class,
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id')->withDefault();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status','published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status','draft');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
