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
        Schema::create('lesson_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('topic_id')->constrained('topics')->onDelete('cascade');
            $table->foreignId('subtopic_id')->nullable()->constrained('subtopics')->nullOnDelete();
            $table->foreignId('syllabus_entry_id')->nullable()->constrained('syllabus_entries')->nullOnDelete();
            $table->string('school_name')->nullable();
            $table->string('teacher_name')->nullable();
            $table->date('lesson_date')->nullable();
            $table->string('lesson_time')->nullable();
            $table->integer('registered_girls')->default(0);
            $table->integer('registered_boys')->default(0);
            $table->integer('registered_total')->default(0);
            $table->integer('present_girls')->default(0);
            $table->integer('present_boys')->default(0);
            $table->integer('present_total')->default(0);
            $table->text('main_competence')->nullable();
            $table->text('specific_competence')->nullable();
            $table->text('main_activity')->nullable();
            $table->text('specific_activity')->nullable();
            $table->text('teaching_learning_resources')->nullable();
            $table->text('references_text')->nullable();
            $table->json('introduction')->nullable();
            $table->json('competence_development')->nullable();
            $table->json('design_stage')->nullable();
            $table->json('realisation')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status')->default('draft');
            $table->string('pdf_path')->nullable();
            $table->string('word_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_plans');
    }
};
