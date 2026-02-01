<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Payout;

class EarningsController extends Controller
{
    public function index()
    {
        $creator = auth()->user();

        // Use user_id instead of creator_id
        $payouts = Payout::where('user_id', $creator->id)
                         ->orderBy('created_at', 'desc')
                         ->get();

        // Optional: calculate total earnings (only 'paid' payouts)
        $totalEarnings = Payout::where('user_id', $creator->id)
                               ->where('status', 'paid')
                               ->sum('amount');

        return view('creator.earnings', compact('payouts', 'totalEarnings'));
    }
}
