<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasFilter;

class Post extends Model
{
    use HasFilter;

    protected $guarded = [];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id')->withDefault();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status','published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status','draft');
    }
}
