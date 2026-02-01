<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::latest()->get();
        return view('admin.payouts.index', compact('payouts'));
    }

    public function create()
    {
        return view('admin.payouts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,completed,canceled',
        ]);

        Payout::create($validated);

        return redirect()->route('payouts.index')->with('success', 'Payout created successfully.');
    }

    public function edit(Payout $payout)
    {
        return view('admin.payouts.edit', compact('payout'));
    }

    public function update(Request $request, Payout $payout)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,completed,canceled',
        ]);

        $payout->update($validated);

        return redirect()->route('payouts.index')->with('success', 'Payout updated successfully.');
    }

    public function destroy(Payout $payout)
    {
        $payout->delete();
        return back()->with('success', 'Payout deleted successfully.');
    }
}
 