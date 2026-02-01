<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'desc')->get(); // List all users by role
        return view('admin.dashboard', compact('users'));
    }
}
