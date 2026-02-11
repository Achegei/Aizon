<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Tool;
use App\Models\Course;
use App\Models\User;
use App\Models\Wallet;

class OrderController extends Controller
{
    /**
     * Display all orders
     */
    public function index()
    {
        $orders = Order::with(['buyer', 'tool', 'course', 'creator'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store order (Admin use-case)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_id'  => 'required|exists:users,id',
            'tool_id'   => 'nullable|exists:tools,id',
            'course_id' => 'nullable|exists:courses,id',
            'amount'    => 'required|numeric|min:0',
            'status'    => 'required|in:pending,paid,delivered,completed,canceled',
        ]);

        // Determine creator automatically
        $creatorId = null;

        if ($validated['tool_id']) {
            $tool = Tool::find($validated['tool_id']);
            $creatorId = $tool?->creator_id;
        }

        if ($validated['course_id']) {
            $course = Course::find($validated['course_id']);
            $creatorId = $course?->creator_id;
        }

        // Calculate platform fee
        $platformFeePercentage = 20; // 20% commission
        $platformFee = ($validated['amount'] * $platformFeePercentage) / 100;

        $order = Order::create([
            'buyer_id'     => $validated['buyer_id'],
            'creator_id'   => $creatorId,
            'tool_id'      => $validated['tool_id'],
            'course_id'    => $validated['course_id'],
            'amount'       => $validated['amount'],
            'platform_fee' => $platformFee,
            'status'       => $validated['status'],
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update order and handle wallet release
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,delivered,completed,canceled,released',
        ]);

        DB::transaction(function () use ($order, $validated) {

            $order->update([
                'status' => $validated['status']
            ]);

            // If order completed and not yet released, credit creator wallet
            if ($validated['status'] === 'completed' && !$order->released_at && $order->creator_id) {

                $netAmount = $order->amount - $order->platform_fee;

                // Update wallet
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => $order->creator_id],
                    ['balance' => 0]
                );

                $wallet->increment('balance', $netAmount);

                // Mark order as released
                $order->update([
                    'released_at' => now()
                ]);
            }
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Delete order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }
}
