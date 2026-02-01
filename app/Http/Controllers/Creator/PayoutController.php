<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::where('creator_id', auth()->id())->latest()->get();
        return view('creator.payouts.index', compact('payouts'));
    }

    public function request(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Payout::create([
            'creator_id' => auth()->id(),
            'amount'     => $request->amount,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Payout request submitted.');
    }
}
