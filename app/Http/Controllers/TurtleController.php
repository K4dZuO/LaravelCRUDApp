<?php
namespace App\Http\Controllers;

use App\Models\Turtle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurtleController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Текущий пользователь
//        if (!$user) {
//            abort(403, 'Unauthorized access');
//        }
        if ($user->is_admin) {
            $turtles = Turtle::withTrashed()->get();
        }
        else{
            $turtles = Turtle::all();
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
        $turtle = Turtle::withTrashed()->findOrFail($id);
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
