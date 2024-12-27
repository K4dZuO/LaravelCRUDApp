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
    <br>
    <br>


    <div class="comments-section">
        <h3>Комментарии</h3>
        @forelse($turtle->comments as $comment)
            <div class="comment" style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #ddd; border-radius: 5px;">
                @if(auth()->user()->friends->contains($comment->user_id))
                    <p style="color: green; font-weight: bold;">(Ваш друг)</p>
                @endif
                <strong>{{ $comment->user->username }}</strong>
                ({{ $comment->time_comment->format('d.m.Y H:i') }}):
                <p>{{ $comment->text }}</p>
            </div>
        @empty
            <p>Комментариев пока нет.</p>
        @endforelse
    </div>




    <!-- Форма добавления комментария -->
    @if(auth()->check())
        <form action="{{ route('comments.store', $turtle->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="text" class="form-control" rows="3" placeholder="Ваш комментарий..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Добавить комментарий</button>
        </form>
    @endif

    <br>
    <br>

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
