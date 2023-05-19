<?php

namespace App\Models;

use App\Enums\RaiseFundStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RaiseFund extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => RaiseFundStatus::class,
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
