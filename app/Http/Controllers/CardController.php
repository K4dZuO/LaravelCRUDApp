<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index ()
    {
//        $cards = Card::all();
        $cards = Card::all();
        return view('card.index', compact('cards'));
    }

    public function create()
    {
        return view('card.create');
    }

    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $this->validateRequest();
        // Обработка изображения
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['head_card'] . '.' . $image->getClientOriginalExtension();
            // Сохранение изображения в storage/app/public/cards
            $image->storeAs('cards', $imageName, 'public');
            // Добавление имени изображения в данные для сохранения
            $validatedData['img_name'] = $imageName;
        }
        unset($validatedData['image']);
        // Сохранение данных карточки
        Card::create($validatedData);

        // Перенаправление с сообщением об успехе
        return redirect()->route('cards.index');
    }


    public function show(Card $card)
    {
        return view('card.show', compact('card'));
    }

    public function edit(Card $card)
    {
        return view('card.edit', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        // Валидация данных
        $validatedData = $this->validateRequest($card->id);

        // Обновление текста карточки
        $card->update([
            'head_card' => $validatedData['head_card'],
            'body_card' => $validatedData['body_card'],
            'body_modal' => $validatedData['body_modal'],
        ]);

        // Обновление изображения (если загружено новое)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $validatedData['head_card'] . '.' . $image->getClientOriginalExtension();

            // Сохранение изображения
            $image->storeAs('cards', $imageName, 'public');

            // Обновление имени изображения
            $card->update(['img_name' => $imageName]);
            unset($validatedData['image']);
        }
        return redirect()->route('cards.index');
    }


    public function destroy(Card $card) {
        // удаление карточки по id
        $card->delete();
        return redirect()->route('cards.index');
    }

    public function restore($id)
    {
        $card = Card::withTrashed()->find($id); // Включает удалённые записи
        $card->restore(); // Восстановление записи
        return redirect()->route('cards.index')->with('success', 'Карточка успешно восстановлена!');
    }


    protected function validateRequest($id = null)
    {
        return request()->validate([
            'head_card' => ['required', 'max:50', 'unique:cards,head_card,' . $id],
            'body_card' => ['required', 'max:255'],
            'body_modal' => ['required', 'max:255'],
            'image' => $id ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'] : ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ]);
    }

}
