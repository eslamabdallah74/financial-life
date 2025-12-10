<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user and workspace
        $user = User::first();
        $workspace = Workspace::first();

        if (!$user || !$workspace) {
            $this->command->warn('No user or workspace found. Please run DatabaseSeeder first.');
            return;
        }

        // Get categories
        $incomeCategories = Category::where('type', 'income')->get();
        $expenseCategories = Category::where('type', 'expense')->get();

        if ($incomeCategories->isEmpty() || $expenseCategories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategorySeeder first.');
            return;
        }

        // Create income transactions (fewer, higher amounts)
        foreach (range(1, 15) as $index) {
            Transaction::create([
                'type' => 'income',
                'amount' => fake()->randomFloat(2, 800, 5000),
                'description' => fake()->optional(0.6)->sentence(6) ?? '',
                'transaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
                'workspace_id' => $workspace->id,
                'category_id' => $incomeCategories->random()->id,
                'user_id' => $user->id,
                'manually_edited' => false,
            ]);
        }

        // Create expense transactions (more frequent, varying amounts)
        foreach (range(1, 85) as $index) {
            Transaction::create([
                'type' => 'expense',
                'amount' => fake()->randomFloat(2, 5, 800),
                'description' => fake()->optional(0.8)->sentence(6) ?? '',
                'transaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
                'workspace_id' => $workspace->id,
                'category_id' => $expenseCategories->random()->id,
                'user_id' => $user->id,
                'manually_edited' => false,
            ]);
        }

        // Create a few voice-generated transactions
        foreach (range(1, 5) as $index) {
            Transaction::create([
                'type' => fake()->randomElement(['income', 'expense']),
                'amount' => fake()->randomFloat(2, 20, 500),
                'description' => fake()->sentence(6),
                'transcript' => fake()->sentence(12),
                'ai_confidence_score' => fake()->randomFloat(2, 0.8, 0.99),
                'transaction_date' => fake()->dateTimeBetween('-1 month', 'now'),
                'workspace_id' => $workspace->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'user_id' => $user->id,
                'manually_edited' => false,
            ]);
        }

        $this->command->info('Created 105 transactions successfully.');
    }
}
