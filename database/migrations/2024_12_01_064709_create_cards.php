<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->text('head_card');
            $table->text('body_card');
            $table->text('body_modal');
            $table->text('img_name');
            $table->timestamps();
            $table->softDeletes(); // Добавляем поддержку Soft Deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
