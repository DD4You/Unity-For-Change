<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'slug', 'name', 'description', 'goal', 'is_active'];

    protected static function booted(): void
    {
        parent::boot();

        self::creating(fn ($campaign) => $campaign->slug = Str::slug($campaign->name));

        self::updating(fn ($campaign) => $campaign->slug = Str::slug($campaign->name));
    }

    protected function goal(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => $value * 100
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
