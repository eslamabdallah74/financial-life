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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('currency', 3)->default('USD'); // ISO 4217 currency code
            $table->string('language', 2)->default('ar'); // ar or en
            $table->enum('theme', ['light', 'dark', 'auto'])->default('auto');
            $table->boolean('notifications_enabled')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('push_notifications')->default(true);
            $table->boolean('budget_alerts')->default(true);
            $table->boolean('savings_reminders')->default(true);
            $table->boolean('cloud_sync_enabled')->default(true);
            $table->string('timezone')->default('Africa/Cairo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
