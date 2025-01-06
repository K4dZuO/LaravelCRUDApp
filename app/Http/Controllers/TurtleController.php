<?php
namespace App\Http\Controllers;

use App\Models\Turtle;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurtleController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Текущий пользователь

        if ($user->is_admin) {
            // Администратор видит всех черепах, включая удаленных
            $turtles = Turtle::withTrashed()->get();
        } else {
            // Получаем ID друзей текущего пользователя
            $friends = $user->friends->pluck('id');

            // Добавляем ID текущего пользователя в список
            $userAndFriends = $friends->push($user->id);

            // Выбираем черепах, которые принадлежат текущему пользователю или его друзьям
            $turtles = Turtle::whereIn('user_id', $userAndFriends)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('turtle.index', compact('turtles'));
    }



    public function index_persone($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if ($user->is_admin) {
            $turtles = Turtle::where('user_id', $user->id)->withTrashed()->get();
        } else {
            $turtles = Turtle::where('user_id', $user->id)->get();
        }

        return view('turtle.index', compact('turtles'));
    }


    public function create()
    {
        return view('turtle.create');
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $this->validateRequest();
        $validatedData['user_id'] = Auth::id(); // Добавляем id текущего пользователя

        // Обработка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name_turtle'] . '.' . $image->getClientOriginalExtension();
            $image->storeAs('turtles', $imageName, 'public'); // Сохранение изображения
            $validatedData['img_name'] = $imageName;
        }
        unset($validatedData['image']);

        // Сохранение данных
        Turtle::create($validatedData);
        return redirect()->route('turtles.index');
    }

    public function show($id)
    {
        $turtle = Turtle::with(['comments.user'])->findOrFail($id);
        return view('turtle.show', compact('turtle'));
    }


    public function edit($id)
    {
        $turtle = Turtle::withTrashed()->findOrFail($id);
        return view('turtle.edit', compact('turtle'));
    }

    public function update(Request $request, Turtle $turtle)
    {
        // Валидация данных
        $validatedData = $this->validateRequest($turtle->id);

        // Обновление текста карточки
        $turtle->update([
            'name_turtle' => $validatedData['name_turtle'],
            'main_info' => $validatedData['main_info'],
            'add_info' => $validatedData['add_info'],
        ]);

        // Обновление изображения (если новое загружено)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name_turtle'] . '.' . $image->getClientOriginalExtension();
            $image->storeAs('turtles', $imageName, 'public');
            $turtle->update(['img_name' => $imageName]);
        }

        return redirect()->route('turtles.index');
    }

    public function destroy(Turtle $turtle)
    {
        $turtle->delete();
        return redirect()->route('turtles.index')->with('success', 'Карточка успешно удалена!');
    }

    public function restore(Turtle $turtle)
    {
        // Проверка, является ли пользователь администратором
        if (!Auth::user()->is_admin) {
            abort(403, 'У вас нет прав восстановить данную карточку');
        }

        // Восстановление мягко удаленной карточки
        $turtle->restore();

        return redirect()->route('turtles.index');
    }

    public function forceDestroy($id)
    {
        $turtle = Turtle::withTrashed()->findOrFail($id);
        $turtle->forceDelete();

        return redirect()->route('turtles.index');
    }

    public function addComment(Request $request, Turtle $turtle)
    {
        $request->validate([
            'text' => 'required|string|max:500',
        ]);

        Comment::create([
            'id_post' => $turtle->id,
            'user_id' => auth()->user()->id,  // Убедитесь, что `user_id` передается
            'text' => $request->input('text'),
            'time_comment' => now(),
        ]);

        return redirect()->route('turtles.show', $turtle->id)->with('success', 'Комментарий добавлен.');
    }


    protected function validateRequest($id = null)
    {
        return request()->validate([
            'name_turtle' => ['required', 'max:50', 'unique:turtles,name_turtle,' . ($id ?? 'NULL')],
            'main_info' => ['required', 'max:512'],
            'add_info' => ['required', 'max:512'],
            'image' => $id ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ]);
    }
}
