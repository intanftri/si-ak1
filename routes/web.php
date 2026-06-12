<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakController;

Route::get('/cetak-ak1/{id}', [CetakController::class, 'cetakKartuAk1'])
    ->name('cetak.ak1')
    ->middleware('auth');
