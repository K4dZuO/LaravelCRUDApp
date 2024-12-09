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
        Schema::create('turtles', function (Blueprint $table) {
            $table->id();
            $table->text('name_turtle');
            $table->text('main_info');
            $table->text('add_info');
            $table->text('img_name');
            $table->timestamps();
            $table->softDeletes(); // Добавляем поддержку Soft Deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turtles');
    }
};
