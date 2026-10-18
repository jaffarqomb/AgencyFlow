<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_settings', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->default('openai')->unique();
            $table->text('api_key')->nullable();
            $table->string('model_name')->default('gpt-4o');
            $table->boolean('is_active')->default(true);
            $table->decimal('temperature', 3, 2)->default(0.70);
            $table->integer('max_tokens')->default(2048);
            $table->decimal('monthly_budget_usd', 8, 2)->default(100.00);
            $table->decimal('total_spent_usd', 8, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('ai_risk_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('risk_type')->index();
            $table->string('risk_level')->index();
            $table->decimal('probability_score', 5, 2);
            $table->json('recommendations')->nullable();
            $table->timestamp('evaluated_at');
            $table->timestamps();
        });

        Schema::create('ai_analysis_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('engine_type')->index();
            $table->integer('prompt_tokens')->default(0);
            $table->integer('completion_tokens')->default(0);
            $table->decimal('cost_usd', 8, 4)->default(0);
            $table->json('input_payload')->nullable();
            $table->json('output_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_analysis_logs');
        Schema::dropIfExists('ai_risk_predictions');
        Schema::dropIfExists('ai_settings');
    }
};
