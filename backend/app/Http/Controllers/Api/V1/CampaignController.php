<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RaiseFundStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $campaigns = Campaign::with('category:id,name', 'images')
            ->withCount('images')
            ->withSum([
                'raiseFunds' => fn ($q) => $q->where('status', RaiseFundStatus::SUCCESS)
            ], 'amount')
            ->havingRaw('images_count > 0')
            ->get([
                'id',
                'category_id',
                'slug',
                'name',
                'description',
                'goal',
                'is_active'
            ]);

        return $this->responseOk(CampaignResource::collection($campaigns));
    }

    public function show(Campaign $campaign)
    {
        $campaign->loadMissing('images');

        return $this->responseOk(CampaignResource::make($campaign));
    }
}
