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
        Schema::create('syllabus_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('topic_id')->constrained('topics')->onDelete('cascade');
            $table->foreignId('subtopic_id')->nullable()->constrained('subtopics')->nullOnDelete();
            $table->text('main_competence');
            $table->text('specific_competence');
            $table->text('main_activity')->nullable();
            $table->text('specific_activity')->nullable();
            $table->json('suggested_methods')->nullable();
            $table->json('assessment_criteria')->nullable();
            $table->json('resources')->nullable();
            $table->json('references')->nullable();
            $table->integer('number_of_periods')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syllabus_entries');
    }
};
