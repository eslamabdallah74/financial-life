<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->decimal('amount', 12, 2);
            $table->decimal('alert_threshold', 5, 2)->default(80.00); // Alert at 80% by default
            $table->enum('period', ['monthly', 'yearly'])->default('monthly');
            $table->integer('month')->nullable(); // 1-12 for monthly budgets
            $table->integer('year');
            $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade'); // Null = overall budget
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // Ensure unique budget per category/period
            $table->unique(['workspace_id', 'category_id', 'period', 'month', 'year'], 'unique_budget');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
