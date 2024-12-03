<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Подробнее о {{ $card->head_card }}</title>
</head>
<body>
<div class="container mt-4">
    <h1 style="margin-left: 0%">{{ $card->head_card }}</h1>
    <img
        src="{{ asset('storage/cards/' . $card->img_name) }}"
{{--        class="img-fluid"--}}
        alt="{{ $card->head_card }}"
        style="width: auto; max-height: 400px"
    />
    <div class="mt-4">
        <h3>Основная информация:</h3>
        <p>{{ $card->body_card }}</p>
    </div>
    <div class="mt-4">
        <h3>Дополнительная информация:</h3>
        <p>{{ $card->body_modal }}</p>
    </div>
    <a href="{{ route('cards.index') }}" class="btn btn-secondary mt-4">Вернуться к списку</a>
    <div>
        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-primary mt-4">Изменить данные</a>
        <form action="{{ route('cards.destroy', $card->id) }}" method="POST"
              style="margin-top: 1%" onsubmit="return confirm('Удалить карточку?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>
</body>
</html>
