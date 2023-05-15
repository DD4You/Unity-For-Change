<?php

namespace App\Http\Controllers\Dpanel;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Category;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::with('category', 'images')->paginate(10);

        return view('dpanel.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('dpanel.campaign.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        Campaign::create($request->validated());

        return redirect()->route('dpanel.campaign.index')->withSuccess('New Campaign Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $raisedFunds = RaiseFund::with('campaign:id,name')
            ->where('campaign_id', $campaign->id)
            ->where('status', RaiseFundStatus::SUCCESS)
            ->select('id', 'campaign_id', 'name', 'email', 'phone', 'amount', 'created_at')
            ->get();

        return response($raisedFunds);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $campaign->loadMedia('campaign-images');

        return view('dpanel.campaign.edit', compact('categories', 'campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());

        return redirect()->route('dpanel.campaign.index')->withSuccess('Campaign Updated Successfully.');
    }


    public function updateStatus(Campaign $campaign, $status)
    {
        $campaign->update(['is_active' => $status]);

        return back()->withSuccess('Status change successfully');
    }
}
