<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
{
    $user = auth()->user();

    return match ($user->role->value) {
        UserRole::ADMIN->value => redirect()->route('admin.dashboard'),
        UserRole::CREATOR->value => redirect()->route('creator.dashboard'),
        UserRole::EMPLOYER->value => redirect()->route('employer.dashboard'),
        default => redirect('/'), // fallback to home page
    };
}
}
