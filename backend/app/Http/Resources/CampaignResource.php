<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $request->routeIs('campaigns.*');

        if ($request->routeIs('campaigns.index')) {
            $images = $this->images->isNotEmpty() ? $this->images[0]->original_url : null;
        } else {
            $images = $this->images->pluck('original_url');
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'goal' => $this->goal,
            'raise_funds_sum_amount' => $this->raise_funds_sum_amount,
            'category_name' => $this->category_name,
            'images' => $images,
        ];
    }
}
