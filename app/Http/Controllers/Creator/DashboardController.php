<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $creator = auth()->user();

        $stats = [
            'tools_count'   => $creator->tools()->count(),
            'courses_count' => $creator->courses()->count(),

            // Sum only PAID payouts for this creator
            'earnings'      => $creator->payouts()
                ->where('status', 'paid')
                ->sum('amount'),
        ];

        return view('creator.dashboard', compact('stats'));
    }
}
