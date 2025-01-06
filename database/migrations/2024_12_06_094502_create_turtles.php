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

            // Добавляем столбец для связи с пользователем
            $table->unsignedBigInteger('user_id'); // Добавляем столбец для связи с таблицей users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Устанавливаем внешний ключ

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turtles', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Удаляем внешний ключ
        });
        Schema::dropIfExists('turtles');
    }
};
