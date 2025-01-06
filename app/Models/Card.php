<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Card extends Model
{
    protected $guarded = [];
    use SoftDeletes;


    // Мутатор для created_at
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y H:i'), // Преобразование даты
        );
    }

    // Мутатор для updated_at
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y H:i'), // Преобразование даты
        );
    }
}
