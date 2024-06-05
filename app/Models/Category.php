<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasFilter;

class Category extends Model
{
    use HasFilter, HasUlids;

    protected $table = 'category';
    protected $guarded = [];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class,'store_id','id')->withDefault();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'category_id','id')->withDefault();
    }

    public function scopeSelectable($query)
    {
        return $query->active()->orderBy('name','asc');
    }
}
