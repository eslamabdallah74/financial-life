<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $workspace = Workspace::first();

        if (!$user || !$workspace) {
            $this->command->warn('No user or workspace found. Please run DatabaseSeeder first.');
            return;
        }

        $expenseCategories = Category::where('type', 'expense')->get();

        if ($expenseCategories->isEmpty()) {
            $this->command->warn('No expense categories found. Please run CategorySeeder first.');
            return;
        }

        // Create monthly budgets for common categories
        $monthlyBudgets = [
            'Food & Dining' => 800,
            'Groceries' => 600,
            'Rent' => 1500,
            'Transport' => 300,
            'Entertainment' => 200,
            'Bills & Utilities' => 400,
        ];

        foreach ($monthlyBudgets as $categoryName => $amount) {
            $category = $expenseCategories->where('name', $categoryName)->first();

            if ($category) {
                Budget::create([
                    'name' => $categoryName . ' Budget',
                    'name_ar' => null,
                    'amount' => $amount,
                    'alert_threshold' => 80,
                    'period' => 'monthly',
                    'month' => now()->month,
                    'year' => now()->year,
                    'workspace_id' => $workspace->id,
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // Create a total monthly budget
        Budget::create([
            'name' => 'Total Monthly Budget',
            'name_ar' => 'ميزانية شهرية',
            'amount' => 4000,
            'alert_threshold' => 85,
            'period' => 'monthly',
            'month' => now()->month,
            'year' => now()->year,
            'workspace_id' => $workspace->id,
            'category_id' => null,
            'user_id' => $user->id,
        ]);

        $this->command->info('Created budgets successfully.');
    }
}
