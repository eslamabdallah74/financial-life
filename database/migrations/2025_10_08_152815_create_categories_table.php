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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Fallback name
            $table->string('name_ar')->nullable(); // Arabic name
            $table->string('name_en')->nullable(); // English name
            $table->enum('type', ['income', 'expense', 'both'])->default('expense');
            $table->string('color')->default('#6B7280'); // Default gray color
            $table->string('icon')->nullable();
            $table->boolean('is_default')->default(false); // System default categories
            $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
