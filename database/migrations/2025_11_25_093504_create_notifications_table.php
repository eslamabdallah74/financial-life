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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // budget_alert, savings_reminder, payment_due, overspending
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->text('message');
            $table->text('message_ar')->nullable();
            $table->json('data')->nullable(); // Additional data (transaction_id, budget_id, etc.)
            $table->boolean('read')->default(false);
            $table->timestamp('scheduled_for')->nullable(); // For scheduled notifications
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read']);
            $table->index('scheduled_for');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
