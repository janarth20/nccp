<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Clean route pointing to the Controller
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

