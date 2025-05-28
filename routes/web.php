<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/{slug?}', [PageController::class, 'get'])
    ->where('slug', '.+')
    ->name('page');
