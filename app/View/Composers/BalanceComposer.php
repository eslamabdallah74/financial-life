<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class BalanceComposer
{
    public function compose(View $view): void
    {
        if (Auth::check()) {
            $user = Auth::user();

            $totalIncome = Transaction::where('user_id', $user->id)
                ->where('type', 'income')
                ->sum('amount');

            $totalExpenses = Transaction::where('user_id', $user->id)
                ->where('type', 'expense')
                ->sum('amount');

            $totalBalance = $totalIncome - $totalExpenses;

            $view->with('globalTotalBalance', $totalBalance);
        } else {
            $view->with('globalTotalBalance', 0);
        }
    }
}
