<?php

namespace App\Http\Controllers\Dpanel;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::paginate(10);

        return view('dpanel.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
