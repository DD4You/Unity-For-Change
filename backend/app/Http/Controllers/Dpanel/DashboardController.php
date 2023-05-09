<?php

namespace App\Http\Controllers\Dpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $chart['column']['name'] = ['Total', '30 Days', '7 Days', 'Today'];
        $chart['column']['data'] = [1320, 1073, 1060, 813];
        $chart['donut']['data'] = [
            ["name" => "Data 1", "y" => 100],
            ["name" => "Data 2", "y" => 105],
            ["name" => "Data 3", "y" => 250],
            ["name" => "Data 4", "y" => 50],
            ["name" => "Data 5", "y" => 155],
        ];
        $chart['pie']['data'] = [
            ["name" => "Data 1", "y" => 100],
            ["name" => "Data 2", "y" => 105],
            ["name" => "Data 3", "y" => 250],
            ["name" => "Data 4", "y" => 50],
            ["name" => "Data 5", "y" => 155],
        ];

        $chart['pyramid']['data'] = [
            ["name" => "Website visits", "y" => 15657],
            ["name" => "Downloads", "y" => 4064],
            ["name" => "Requested price list", "y" => 1987],
            ["name" => "Invoice sent", "y" => 976],
            ["name" => "Finalized", "y" => 846],
        ];

        $chart['tree']['data'] = [
            ['Proto Indo-European' => 'Balto-Slavic'],
            ['Proto Indo-European' => 'Germanic'],
            ['Proto Indo-European' => 'Italic'],
            ['Proto Indo-European' => 'Indo-Iranian'],
            ['Indo-Iranian' => 'Indic'],
            ['Indic' => 'Sanskrit'],
            ['Italic' => 'Osco-Umbrian'],
            ['Italic' => 'Latino-Faliscan'],
            ['Latino-Faliscan' => 'Latin'],
            ['Germanic' => 'North Germanic'],
            ['Germanic' => 'West Germanic'],
            ['Germanic' => 'East Germanic'],
            ['North Germanic' => 'Old Norse'],
            ['North Germanic' => 'Old Danish'],
            ['West Germanic' => 'Old English'],
            ['West Germanic' => 'Old Dutch'],
            ['West Germanic' => 'Old High German'],
            ['Old Norse' => 'Old Norwegian'],
            ['Old Norwegian' => 'Middle Norwegian'],
            ['Old English' => 'Middle English'],
            ['Old Dutch' => 'Middle Dutch'],
            ['Old High German' => 'Middle High German'],
            ['Balto-Slavic' => 'Baltic'],
            // Leaves:
            ['Proto Indo-European' => 'Armenian'],
            ['Sanskrit' => 'Hindi'],
            ['Sanskrit' => 'Bihari'],
            ['Sanskrit' => 'Marathi'],
            ['Sanskrit' => 'Gujarati'],
            ['Sanskrit' => 'Punjabi'],
            ['Osco-Umbrian' => 'Umbrian'],
            ['Osco-Umbrian' => 'Oscan'],
            ['Latino-Faliscan' => 'Faliscan'],
            ['Latin' => 'Spanish'],
            ['Latin' => 'French'],
            ['Latin' => 'Italian'],
            ['Latin' => 'Franco-Provençal'],
            ['East Germanic' => 'Gothic'],
            ['Middle English' => 'English'],
            ['Middle Dutch' => 'Dutch'],
            ['Middle Dutch' => 'Rhinelandic'],
            ['Middle Norwegian' => 'Norwegian'],
            ['Old Norse' => 'Faroese'],
            ['Baltic' => 'Old Prussian'],
            ['Baltic' => 'Lithuanian'],
            ['Baltic' => 'Latvian'],
        ];

        return view('dpanel.dashboard', compact('chart'));
    }
}
