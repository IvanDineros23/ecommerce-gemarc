<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TipsController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/tips', [TipsController::class, 'index'])->name('api.tips.index');
});