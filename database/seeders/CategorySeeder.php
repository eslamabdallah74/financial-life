<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Workspace;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first workspace
        $workspace = Workspace::first();

        if (!$workspace) {
            $this->command->warn('No workspace found. Please run DatabaseSeeder first.');
            return;
        }

        // Default categories with Arabic and English names
        $categories = [
            // Income Categories
            [
                'name' => 'Salary',
                'name_ar' => 'راتب',
                'name_en' => 'Salary',
                'type' => 'income',
                'icon' => '💵',
                'color' => '#10B981',
                'is_default' => true,
            ],
            [
                'name' => 'Freelance',
                'name_ar' => 'عمل حر',
                'name_en' => 'Freelance',
                'type' => 'income',
                'icon' => '💼',
                'color' => '#34D399',
                'is_default' => true,
            ],
            [
                'name' => 'Investment',
                'name_ar' => 'استثمار',
                'name_en' => 'Investment',
                'type' => 'income',
                'icon' => '📈',
                'color' => '#059669',
                'is_default' => true,
            ],
            [
                'name' => 'Gift',
                'name_ar' => 'هدية',
                'name_en' => 'Gift',
                'type' => 'income',
                'icon' => '🎁',
                'color' => '#6EE7B7',
                'is_default' => true,
            ],
            [
                'name' => 'Other Income',
                'name_ar' => 'دخل آخر',
                'name_en' => 'Other Income',
                'type' => 'income',
                'icon' => '💰',
                'color' => '#A7F3D0',
                'is_default' => true,
            ],

            // Expense Categories
            [
                'name' => 'Food & Dining',
                'name_ar' => 'طعام ومطاعم',
                'name_en' => 'Food & Dining',
                'type' => 'expense',
                'icon' => '🍽️',
                'color' => '#EF4444',
                'is_default' => true,
            ],
            [
                'name' => 'Groceries',
                'name_ar' => 'بقالة',
                'name_en' => 'Groceries',
                'type' => 'expense',
                'icon' => '🛒',
                'color' => '#F87171',
                'is_default' => true,
            ],
            [
                'name' => 'Shopping',
                'name_ar' => 'تسوق',
                'name_en' => 'Shopping',
                'type' => 'expense',
                'icon' => '🛍️',
                'color' => '#FB923C',
                'is_default' => true,
            ],
            [
                'name' => 'Rent',
                'name_ar' => 'إيجار',
                'name_en' => 'Rent',
                'type' => 'expense',
                'icon' => '🏠',
                'color' => '#DC2626',
                'is_default' => true,
            ],
            [
                'name' => 'Transport',
                'name_ar' => 'مواصلات',
                'name_en' => 'Transport',
                'type' => 'expense',
                'icon' => '🚗',
                'color' => '#F59E0B',
                'is_default' => true,
            ],
            [
                'name' => 'Bills & Utilities',
                'name_ar' => 'فواتير',
                'name_en' => 'Bills & Utilities',
                'type' => 'expense',
                'icon' => '📄',
                'color' => '#7C3AED',
                'is_default' => true,
            ],
            [
                'name' => 'Entertainment',
                'name_ar' => 'ترفيه',
                'name_en' => 'Entertainment',
                'type' => 'expense',
                'icon' => '🎬',
                'color' => '#EC4899',
                'is_default' => true,
            ],
            [
                'name' => 'Healthcare',
                'name_ar' => 'صحة',
                'name_en' => 'Healthcare',
                'type' => 'expense',
                'icon' => '⚕️',
                'color' => '#06B6D4',
                'is_default' => true,
            ],
            [
                'name' => 'Education',
                'name_ar' => 'تعليم',
                'name_en' => 'Education',
                'type' => 'expense',
                'icon' => '📚',
                'color' => '#8B5CF6',
                'is_default' => true,
            ],
            [
                'name' => 'Travel',
                'name_ar' => 'سفر',
                'name_en' => 'Travel',
                'type' => 'expense',
                'icon' => '✈️',
                'color' => '#14B8A6',
                'is_default' => true,
            ],
            [
                'name' => 'Clothing',
                'name_ar' => 'ملابس',
                'name_en' => 'Clothing',
                'type' => 'expense',
                'icon' => '👕',
                'color' => '#F472B6',
                'is_default' => true,
            ],
            [
                'name' => 'Personal Care',
                'name_ar' => 'عناية شخصية',
                'name_en' => 'Personal Care',
                'type' => 'expense',
                'icon' => '💆',
                'color' => '#A78BFA',
                'is_default' => true,
            ],
            [
                'name' => 'Insurance',
                'name_ar' => 'تأمين',
                'name_en' => 'Insurance',
                'type' => 'expense',
                'icon' => '🛡️',
                'color' => '#6366F1',
                'is_default' => true,
            ],
            [
                'name' => 'Other Expense',
                'name_ar' => 'مصروف آخر',
                'name_en' => 'Other Expense',
                'type' => 'expense',
                'icon' => '📌',
                'color' => '#6B7280',
                'is_default' => true,
            ],
        ];

        // Create categories for the workspace
        foreach ($categories as $category) {
            Category::create(array_merge($category, [
                'workspace_id' => $workspace->id,
            ]));
        }

        $this->command->info('Created categories successfully.');
    }
}
