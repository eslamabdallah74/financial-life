<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    // Get recent transactions
    $recentTransactions = \App\Models\Transaction::with('category')
        ->where('user_id', $user->id)
        ->orderBy('transaction_date', 'desc')
        ->limit(5)
        ->get();

    // Calculate total balance (all time)
    $totalIncome = \App\Models\Transaction::where('user_id', $user->id)
        ->where('type', 'income')
        ->sum('amount');

    $totalExpenses = \App\Models\Transaction::where('user_id', $user->id)
        ->where('type', 'expense')
        ->sum('amount');

    $totalBalance = $totalIncome - $totalExpenses;

    // Calculate monthly stats (current month)
    $monthlyIncome = \App\Models\Transaction::where('user_id', $user->id)
        ->where('type', 'income')
        ->whereYear('transaction_date', now()->year)
        ->whereMonth('transaction_date', now()->month)
        ->sum('amount');

    $monthlyExpenses = \App\Models\Transaction::where('user_id', $user->id)
        ->where('type', 'expense')
        ->whereYear('transaction_date', now()->year)
        ->whereMonth('transaction_date', now()->month)
        ->sum('amount');

    // Calculate savings rate
    $savingsRate = $monthlyIncome > 0
        ? round((($monthlyIncome - $monthlyExpenses) / $monthlyIncome) * 100, 1)
        : 0;

    return view('dashboard', compact(
        'recentTransactions',
        'totalBalance',
        'monthlyIncome',
        'monthlyExpenses',
        'savingsRate'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [UserSettingController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [UserSettingController::class, 'update'])->name('settings.update');

    Route::post('/transactions/process-voice', [TransactionController::class, 'processVoice'])->name('transactions.process-voice');
    Route::resource('transactions', TransactionController::class);
    Route::resource('categories', CategoryController::class);
});

require __DIR__ . '/auth.php';
