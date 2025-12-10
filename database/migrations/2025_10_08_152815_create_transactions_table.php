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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['expense', 'income']);
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            $table->text('transcript')->nullable(); // Original voice transcript
            $table->string('audio_file_path')->nullable(); // Path to stored audio file
            $table->integer('ai_confidence_score')->nullable(); // 0-100 confidence
            $table->boolean('manually_edited')->default(false);
            $table->date('transaction_date'); // Actual transaction date
            $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // Indexes for efficient querying
            $table->index(['workspace_id', 'transaction_date']);
            $table->index(['category_id', 'type']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
