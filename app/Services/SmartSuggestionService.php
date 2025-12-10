<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Budget;
use App\Models\SavingsGoal;
use Illuminate\Support\Facades\DB;

class SmartSuggestionService
{
    /**
     * Generate smart suggestions based on spending patterns
     *
     * @param int $workspaceId
     * @param int $userId
     * @return array
     */
    public function generateSuggestions(int $workspaceId, int $userId): array
    {
        $suggestions = [];

        // Check for overspending
        $suggestions = array_merge($suggestions, $this->checkOverspending($workspaceId));

        // Check for unusual spending
        $suggestions = array_merge($suggestions, $this->detectUnusualSpending($workspaceId, $userId));

        // Suggest savings based on income
        $suggestions = array_merge($suggestions, $this->suggestSavings($workspaceId, $userId));

        // Check for recurring payments
        $suggestions = array_merge($suggestions, $this->detectRecurringPayments($workspaceId, $userId));

        return $suggestions;
    }

    /**
     * Check if user is overspending on budgets
     */
    protected function checkOverspending(int $workspaceId): array
    {
        $suggestions = [];
        $budgets = Budget::where('workspace_id', $workspaceId)->get();

        foreach ($budgets as $budget) {
            if ($budget->isExceeded()) {
                $suggestions[] = [
                    'type' => 'budget_exceeded',
                    'severity' => 'high',
                    'title' => 'Budget Exceeded',
                    'title_ar' => 'تجاوز الميزانية',
                    'message' => "You've exceeded your {$budget->localized_name} budget by " .
                        number_format($budget->spent_amount - $budget->amount, 2),
                    'message_ar' => "لقد تجاوزت ميزانية {$budget->localized_name} بمقدار " .
                        number_format($budget->spent_amount - $budget->amount, 2),
                ];
            } elseif ($budget->isAlertThresholdExceeded()) {
                $suggestions[] = [
                    'type' => 'budget_warning',
                    'severity' => 'medium',
                    'title' => 'Budget Alert',
                    'title_ar' => 'تنبيه الميزانية',
                    'message' => "You've used {$budget->spent_percentage}% of your {$budget->localized_name} budget",
                    'message_ar' => "لقد استخدمت {$budget->spent_percentage}% من ميزانية {$budget->localized_name}",
                ];
            }
        }

        return $suggestions;
    }

    /**
     * Detect unusual spending patterns
     */
    protected function detectUnusualSpending(int $workspaceId, int $userId): array
    {
        $suggestions = [];

        // Get this month's spending by category
        $thisMonthSpending = Transaction::where('workspace_id', $workspaceId)
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->thisMonth()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->get();

        // Get average spending for the last 3 months
        $threeMonthsAgo = now()->subMonths(3);
        $avgSpending = Transaction::where('workspace_id', $workspaceId)
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->where('transaction_date', '>=', $threeMonthsAgo)
            ->where('transaction_date', '<', now()->startOfMonth())
            ->select('category_id', DB::raw('AVG(amount) as avg_amount'))
            ->groupBy('category_id')
            ->get()
            ->keyBy('category_id');

        foreach ($thisMonthSpending as $spending) {
            $avg = $avgSpending->get($spending->category_id);
            if ($avg && $spending->total > ($avg->avg_amount * 1.5)) {
                $category = \App\Models\Category::find($spending->category_id);
                $suggestions[] = [
                    'type' => 'unusual_spending',
                    'severity' => 'medium',
                    'title' => 'Unusual Spending Detected',
                    'title_ar' => 'اكتشاف إنفاق غير عادي',
                    'message' => "You're spending 50% more on {$category->localized_name} this month",
                    'message_ar' => "أنت تنفق 50% أكثر على {$category->localized_name} هذا الشهر",
                ];
            }
        }

        return $suggestions;
    }

    /**
     * Suggest savings based on income
     */
    protected function suggestSavings(int $workspaceId, int $userId): array
    {
        $suggestions = [];

        // Calculate this month's income and expenses
        $income = Transaction::where('workspace_id', $workspaceId)
            ->where('user_id', $userId)
            ->where('type', 'income')
            ->thisMonth()
            ->sum('amount');

        $expenses = Transaction::where('workspace_id', $workspaceId)
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->thisMonth()
            ->sum('amount');

        $remaining = $income - $expenses;

        // Suggest savings if there's remaining money
        if ($remaining > 0) {
            $suggestedAmount = $remaining * 0.2; // Suggest saving 20%

            $suggestions[] = [
                'type' => 'savings_opportunity',
                'severity' => 'low',
                'title' => 'Savings Opportunity',
                'title_ar' => 'فرصة للادخار',
                'message' => "You have " . number_format($remaining, 2) .
                    " left this month. Consider saving " . number_format($suggestedAmount, 2),
                'message_ar' => "لديك " . number_format($remaining, 2) .
                    " متبقي هذا الشهر. فكر في ادخار " . number_format($suggestedAmount, 2),
            ];
        }

        return $suggestions;
    }

    /**
     * Detect recurring payments that might need reminders
     */
    protected function detectRecurringPayments(int $workspaceId, int $userId): array
    {
        $suggestions = [];

        // This is a simplified version
        // In production, you'd want more sophisticated pattern matching
        $potentialRecurring = Transaction::where('workspace_id', $workspaceId)
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->whereIn('category_id', function ($query) {
                $query->select('id')
                    ->from('categories')
                    ->whereIn('name', ['Rent', 'Bills & Utilities', 'Insurance']);
            })
            ->orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        // Simple check: if we haven't seen a rent payment this month
        $rentCategory = \App\Models\Category::where('workspace_id', $workspaceId)
            ->where('name', 'Rent')
            ->first();

        if ($rentCategory) {
            $hasRentThisMonth = Transaction::where('workspace_id', $workspaceId)
                ->where('user_id', $userId)
                ->where('category_id', $rentCategory->id)
                ->thisMonth()
                ->exists();

            if (!$hasRentThisMonth && now()->day > 5) {
                $suggestions[] = [
                    'type' => 'payment_reminder',
                    'severity' => 'high',
                    'title' => 'Rent Payment Reminder',
                    'title_ar' => 'تذكير بدفع الإيجار',
                    'message' => "Don't forget to record your rent payment",
                    'message_ar' => "لا تنسى تسجيل دفع الإيجار",
                ];
            }
        }

        return $suggestions;
    }
}
