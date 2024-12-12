<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
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

    <div class="mt-4">
        <!-- Редактирование только для автора карточки -->
        @if(Auth::id() === $turtle->user_id)
            <a href="{{ route('turtles.edit', $turtle->id) }}" class="btn btn-primary">Изменить данные</a>
        @endif

        <!-- Удаление -->
        @if($turtle->deleted_at)
            <!-- Только для админа: полное удаление -->
            @if(Auth::user()->is_admin)
                <form action="{{ route('turtles.force_destroy', $turtle->id) }}" method="POST" style="margin-top: 1%" onsubmit="return confirm('Удалить навсегда?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить полностью</button>
                </form>
                <form action="{{ route('turtles.restore', $turtle->id) }}" method="POST" style="margin-top: 1%">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Восстановить</button>
                </form>
            @endif
        @else
            <!-- Мягкое удаление: доступно автору и админу -->
            @if(Auth::id() === $turtle->user_id || Auth::user()->is_admin)
                <form action="{{ route('turtles.destroy', $turtle->id) }}" method="POST" style="margin-top: 1%" onsubmit="return confirm('Удалить карточку?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            @endif
        @endif
    </div>
</div>
</body>
</html>
