<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['id_post', 'username', 'text', 'time_comment'];

    // Указываем, что поле 'time_comment' должно быть автоматически преобразовано в Carbon
    protected $dates = ['time_comment'];

    // Связь с таблицей 'turtles' (карточки)
    public function turtle()
    {
        return $this->belongsTo(Turtle::class, 'id_post');
    }

    // Связь с пользователем, если вам нужно (опционально)
    public function user()
    {
//        return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class, 'username', 'username'); // Assuming 'username' is unique
    }
}
