<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Campaign extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['category_id', 'slug', 'name', 'description', 'goal', 'is_active'];

    protected static function booted(): void
    {
        parent::boot();

        self::creating(fn ($campaign) => $campaign->slug = Str::slug($campaign->name));

        self::updating(fn ($campaign) => $campaign->slug = Str::slug($campaign->name));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    public function images()
    {
        return $this->media()->where('collection_name', 'campaign-images');
    }
}
