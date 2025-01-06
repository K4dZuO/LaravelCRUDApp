<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function addFriend(Request $request, $id)
    {
        $user = auth()->user();
        $friend = User::findOrFail($id);

        // Добавление дружбы
        $user->friends()->syncWithoutDetaching($friend->id);
        $friend->friends()->syncWithoutDetaching($user->id); // Обратная связь

        return redirect()->back()->with('success', 'Пользователь добавлен в друзья!');
    }

    public function removeFriend($id)
    {
        $user = auth()->user();
        $friend = User::findOrFail($id);

        // Удаление дружбы
        $user->friends()->detach($friend->id);
        $friend->friends()->detach($user->id); // Удаление обратной связи

        return redirect()->back()->with('success', 'Пользователь удален из друзей.');
    }

    // FriendController
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get(); // Все, кроме текущего пользователя
        return view('friends.index', compact('users'));
    }

}
