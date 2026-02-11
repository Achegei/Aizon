<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payout;
use App\Models\Order;
use App\Models\Wallet;

class PayoutController extends Controller
{
    /**
     * Display all payouts
     */
    public function index()
    {
        $payouts = Payout::with(['user', 'order'])
            ->latest()
            ->get();

        return view('admin.payouts.index', compact('payouts'));
    }

    /**
     * Create payout from completed order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'method'   => 'required|string|max:255',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Ensure order is completed before payout
        if ($order->status !== 'completed') {
            return back()->with('error', 'Order must be completed before payout.');
        }

        // Prevent duplicate payout
        if ($order->payout) {
            return back()->with('error', 'Payout already created for this order.');
        }

        $netAmount = $order->amount - $order->platform_fee;

        Payout::create([
            'user_id'      => $order->creator_id,
            'order_id'     => $order->id,
            'amount'       => $order->amount,
            'platform_fee' => $order->platform_fee,
            'net_amount'   => $netAmount,
            'method'       => $validated['method'],
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('admin.payouts.index')
            ->with('success', 'Payout created successfully.');
    }

    /**
     * Update payout status
     */
    public function update(Request $request, Payout $payout)
    {
        $validated = $request->validate([
            'status'    => 'required|in:pending,approved,paid',
            'reference' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($payout, $validated) {

            // If marking as paid, deduct from creator wallet
            if ($validated['status'] === 'paid' && $payout->status !== 'paid') {
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => $payout->user_id],
                    ['balance' => 0]
                );

                if ($wallet->balance < $payout->net_amount) {
                    throw new \Exception("Insufficient wallet balance for payout.");
                }

                $wallet->decrement('balance', $payout->net_amount);
            }

            $payout->update([
                'status'    => $validated['status'],
                'reference' => $validated['reference'] ?? $payout->reference,
                'paid_at'   => $validated['status'] === 'paid' ? now() : null,
            ]);
        });

        return redirect()
            ->route('admin.payouts.index')
            ->with('success', 'Payout updated successfully.');
    }

    /**
     * Delete payout
     */
    public function destroy(Payout $payout)
    {
        $payout->delete();

        return back()->with('success', 'Payout deleted successfully.');
    }
}
