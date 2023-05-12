<?php

namespace App\Http\Controllers\Dpanel;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CampaignImageController extends Controller
{
    public function store(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);

        $campaign->addMedia($request->image)
            ->usingName($request->image->hashName())
            ->usingFileName($request->image->hashName())
            ->toMediaCollection('campaign-images');

        return response()->json([
            'status' => 1,
            'msg' => [
                'id' => $campaign->getMedia('campaign-images')->last()->id,
                'url' => $campaign->getMedia('campaign-images')->last()->getUrl(),
                'message' => 'Image uploaded successfully'
            ]
        ]);
    }

    public function destroy(int $id)
    {
        Media::find($id)->delete();
        return response()->json(['msg' => 'Image delete successfully']);
    }
}
