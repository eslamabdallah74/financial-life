<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::post('/add-transaction', [TransactionController::class, 'processVoice'])->name('transactions.processVoice');
