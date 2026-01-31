<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/ai-tools', [PageController::class, 'aiTools'])->name('tools.index');
Route::get('/courses', [PageController::class, 'courses'])->name('courses.index');
Route::get('/jobs', [PageController::class, 'jobs'])->name('jobs.index');
Route::get('/hire-talent', [PageController::class, 'hireTalent'])->name('hire.index');
Route::get('/sell-on-aizon', [PageController::class, 'sell'])->name('sell.index');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing.index');
