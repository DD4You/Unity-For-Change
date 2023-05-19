<?php

namespace App\Http\Controllers\Dpanel;

use App\Enums\RaiseFundStatus;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\RaiseFund;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $total['category'] = Category::count();
        $total['campaign'] = Campaign::count();
        $total['activeCampaign'] = Campaign::active()->count();

        $raiseFund = RaiseFund::with('campaign:id,name')
            ->where('status', RaiseFundStatus::SUCCESS)
            ->latest()
            ->paginate(10);


        return view('dpanel.dashboard', compact('total', 'raiseFund'));
    }
}
