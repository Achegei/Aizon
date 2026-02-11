<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of all orders
     */
    public function index()
    {
        $orders = Order::with(['buyer', 'tool', 'course'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_id'   => 'required|exists:users,id',
            'tool_id'    => 'nullable|exists:tools,id',
            'course_id'  => 'nullable|exists:courses,id',
            'amount'     => 'required|numeric|min:0',
            'status'     => 'nullable|in:pending,completed,canceled',
        ]);

        Order::create($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Show the form for editing an existing order
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update an existing order in storage
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'buyer_id'   => 'required|exists:users,id',
            'tool_id'    => 'nullable|exists:tools,id',
            'course_id'  => 'nullable|exists:courses,id',
            'amount'     => 'required|numeric|min:0',
            'status'     => 'nullable|in:pending,completed,canceled',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }
}
