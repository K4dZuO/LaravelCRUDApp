<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['id_post', 'user_id', 'text', 'time_comment'];

    protected $casts = [
        'time_comment' => 'datetime',
    ];

    // Связь с таблицей 'turtles' (карточки)
    // Связь с таблицей turtles (карточки)
    public function turtle()
    {
        return $this->belongsTo(Turtle::class, 'id_post', 'id');
    }

    // Связь с пользователем, если вам нужно (опционально)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
