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
        Schema::create('deliverables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('stage_id')->nullable()->constrained('project_stages')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('current_status')->default('draft')->index();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        Schema::create('deliverable_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliverable_id')->constrained('deliverables')->cascadeOnDelete();
            $table->integer('version_number')->default(1);
            $table->string('file_path')->nullable();
            $table->string('preview_url')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('client_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliverable_id')->constrained('deliverables')->cascadeOnDelete();
            $table->foreignId('deliverable_version_id')->constrained('deliverable_versions')->cascadeOnDelete();
            $table->foreignId('client_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('decision')->index();
            $table->text('feedback_comments')->nullable();
            $table->string('signature_hash')->nullable();
            $table->timestamp('actioned_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_approvals');
        Schema::dropIfExists('deliverable_versions');
        Schema::dropIfExists('deliverables');
    }
};
