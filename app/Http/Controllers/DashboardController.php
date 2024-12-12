<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Текущий пользователь
        $turtles = $user->turtles; // Загружаем связанные карточки

        return view('dashboard', compact('turtles'));
    }
}
