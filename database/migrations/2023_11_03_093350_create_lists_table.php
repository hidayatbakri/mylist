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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();
            $table->string('wa')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', [1, 2, 3]);
            $table->integer('position');
            $table->bigInteger('clicked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
