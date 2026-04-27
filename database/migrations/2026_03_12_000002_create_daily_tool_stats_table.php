<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_tool_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->nullable()->constrained('tools')->nullOnDelete();
            $table->string('tool_slug')->nullable()->index();
            $table->date('date')->index();
            $table->unsignedBigInteger('visits')->default(0);
            $table->unsignedBigInteger('unique_visitors')->default(0);
            $table->unsignedBigInteger('actions')->default(0);
            $table->timestamps();

            $table->unique(['tool_slug', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_tool_stats');
    }
};