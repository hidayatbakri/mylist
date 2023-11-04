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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('bg_list')->nullable()->default('#f0f9ff');
            $table->enum('bg_type', [0, 1])->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('text_color')->nullable()->default('#000000');
            $table->string('list_color')->nullable()->default('#EAEAEA');
            $table->string('font')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
