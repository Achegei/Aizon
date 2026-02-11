<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Wallet;

class DashboardController extends Controller
{
    public function index()
{
    $users = User::all();

    $totalRevenue = Order::where('status', 'completed')->sum('amount');
    $platformEarnings = Order::where('status', 'completed')->sum('platform_fee');
    $pendingPayouts = Payout::where('status', 'pending')->sum('net_amount');
    $totalPaidOut = Payout::where('status', 'paid')->sum('net_amount');

    return view('admin.dashboard', compact(
        'users',
        'totalRevenue',
        'platformEarnings',
        'pendingPayouts',
        'totalPaidOut'
    ));
}
}
