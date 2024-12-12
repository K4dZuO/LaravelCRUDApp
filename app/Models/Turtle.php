<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Turtle extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Мутатор для created_at
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y H:i'), // Преобразование даты
        );
    }

    /**
     * Мутатор для updated_at
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y H:i'), // Преобразование даты
        );
    }

    /**
     * Связь с моделью User (черепаха принадлежит пользователю)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
