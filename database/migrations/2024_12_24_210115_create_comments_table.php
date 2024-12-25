<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_comment'); // ID комментария
            $table->foreignId('id_post')->constrained('turtles')->onDelete('cascade'); // Связь с таблицей turtles (карточки)
            $table->string('username'); // Имя пользователя, оставившего комментарий
            $table->timestamp('time_comment')->useCurrent(); // Время комментария
            $table->text('text'); // Текст комментария
            $table->timestamps(); // Временные метки
        });
    }

    /**
     * Отмена миграции.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
