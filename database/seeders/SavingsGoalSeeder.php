<?php

namespace Database\Seeders;

use App\Models\SavingsGoal;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;

class SavingsGoalSeeder extends Seeder
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

        $goals = [
            [
                'name' => 'Emergency Fund',
                'name_ar' => 'صندوق الطوارئ',
                'description' => 'Build an emergency fund for unexpected expenses',
                'target_amount' => 10000,
                'current_amount' => 3500,
                'deadline' => now()->addMonths(12),
                'icon' => '🏥',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Vacation Fund',
                'name_ar' => 'صندوق العطلة',
                'description' => 'Save for summer vacation',
                'target_amount' => 5000,
                'current_amount' => 1200,
                'deadline' => now()->addMonths(6),
                'icon' => '✈️',
                'color' => '#14B8A6',
            ],
            [
                'name' => 'New Car',
                'name_ar' => 'سيارة جديدة',
                'description' => 'Save for a down payment on a new car',
                'target_amount' => 15000,
                'current_amount' => 2500,
                'deadline' => now()->addMonths(18),
                'icon' => '🚗',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Home Renovation',
                'name_ar' => 'تجديد المنزل',
                'description' => 'Renovate the kitchen and bathroom',
                'target_amount' => 8000,
                'current_amount' => 4500,
                'deadline' => now()->addMonths(10),
                'icon' => '🏠',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Education Fund',
                'name_ar' => 'صندوق التعليم',
                'description' => 'Save for professional certification',
                'target_amount' => 3000,
                'current_amount' => 800,
                'deadline' => now()->addMonths(8),
                'icon' => '🎓',
                'color' => '#8B5CF6',
            ],
        ];

        foreach ($goals as $goal) {
            SavingsGoal::create(array_merge($goal, [
                'status' => 'active',
                'workspace_id' => $workspace->id,
                'user_id' => $user->id,
            ]));
        }

        $this->command->info('Created savings goals successfully.');
    }
}
