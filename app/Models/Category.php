<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasFilter;

class Category extends Model
{
    use HasFilter;

    protected $table = 'categories';
    protected $guarded = [];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class,'store_id','id')->withDefault();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class,'category_id','id');
    }

    public function scopeSelectable($query)
    {
        return $query->active()->orderBy('name','asc');
    }
}
