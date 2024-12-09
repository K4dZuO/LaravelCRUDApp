<?php
namespace App\Http\Controllers;

use App\Models\Turtle;
use Illuminate\Http\Request;

class TurtleController extends Controller
{
    public function index()
    {
        $turtles = Turtle::all();
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

        // Обработка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['name_turtle'] . '.' . $image->getClientOriginalExtension();
            $image->storeAs('turtles', $imageName, 'public'); // Сохранение изображения
            $validatedData['img_name'] = $imageName;
        }
        unset($validatedData['image']);
//        dd($validatedData);
        // Сохранение данных
        Turtle::create($validatedData);
        return redirect()->route('turtles.index');
    }

    public function show(Turtle $turtle)
    {
        return view('turtle.show', compact('turtle'));
    }

    public function edit(Turtle $turtle)
    {
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

    protected function validateRequest($id = null)
    {
        return request()->validate([
            'name_turtle' => ['required', 'max:50', 'unique:turtles,name_turtle,' . $id],
            'main_info' => ['required', 'max:512'],
            'add_info' => ['required', 'max:512'],
            'image' => $id ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ]);
    }
}
