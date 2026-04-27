<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tool_usage_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tool_id')->nullable()->constrained('tools')->nullOnDelete();
            $table->string('tool_slug')->nullable()->index();
            $table->string('session_id', 120)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->string('country')->nullable()->index();
            $table->string('city')->nullable();
            $table->string('browser')->nullable()->index();
            $table->string('device')->nullable()->index();
            $table->string('os')->nullable()->index();
            $table->text('referrer')->nullable();
            $table->text('landing_page')->nullable();
            $table->text('page_url')->nullable();
            $table->string('action_type', 50)->index();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['action_type', 'created_at']);
            $table->index(['tool_slug', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tool_usage_logs');
    }
};