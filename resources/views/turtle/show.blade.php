<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Подробнее о {{ $turtle->name_turtle }}</title>
</head>
<body>
<div class="container mt-4">
    <h1>{{ $turtle->name_turtle }}</h1>
    <img
        src="{{ asset('storage/turtles/' . $turtle->img_name) }}"
        alt="{{ $turtle->name_turtle }}"
        style="width: auto; max-height: 400px"
    />
    <div class="mt-4">
        <h3>Основная информация:</h3>
        <p>{{ $turtle->main_info }}</p>
    </div>
    <div class="mt-4">
        <h3>Дополнительная информация:</h3>
        <p>{{ $turtle->add_info }}</p>
    </div>
    <a href="{{ route('turtles.index') }}" class="btn btn-secondary mt-4">Вернуться к списку</a>
    <div>
        <a href="{{ route('turtles.edit', $turtle->id) }}" class="btn btn-primary mt-4">Изменить данные</a>
        <form action="{{ route('turtles.destroy', $turtle->id) }}" method="POST" style="margin-top: 1%" onsubmit="return confirm('Удалить карточку?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>
</body>
</html>
