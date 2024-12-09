<form action="{{ isset($turtle) ? route('turtles.update', $turtle->id) : route('turtles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($turtle))
        @method('PUT')  <!-- Метод для обновления карточки -->
    @endif

    <!-- Название черепахи -->
    <div class="form-group">
        <label for="name_turtle">Название черепахи</label>
        <input type="text" name="name_turtle" id="name_turtle" class="form-control"
               value="{{ old('name_turtle', $turtle->name_turtle ?? '') }}" required>
    </div>
    @error('name_turtle')<p style="color: red">{{ $message }}</p>@enderror

    <!-- Основная информация -->
    <div class="form-group mt-3">
        <label for="main_info">Основная информация</label>
        <textarea name="main_info" id="main_info" class="form-control" rows="3" required>{{ old('main_info', $turtle->main_info ?? '') }}</textarea>
    </div>
    @error('main_info')<p style="color: red">{{ $message }}</p>@enderror

    <!-- Дополнительная информация -->
    <div class="form-group mt-3">
        <label for="add_info">Дополнительная информация</label>
        <textarea name="add_info" id="add_info" class="form-control" rows="3" required>{{ old('add_info', $turtle->add_info ?? '') }}</textarea>
    </div>
    @error('add_info')<p style="color: red">{{ $message }}</p>@enderror

    <!-- Загрузка изображения -->
    <div class="form-group mt-3">
        <label for="image">Загрузить изображение</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        @if(isset($turtle) && $turtle->img_name)
            <div class="mt-2">
                <p>Текущее изображение:</p>
                <img src="{{ asset('storage/turtles/' . $turtle->img_name) }}" class="img-fluid" alt="current_image">
            </div>
        @endif
    </div>
    @error('image')<p style="color: red">{{ $message }}</p>@enderror

    <!-- Кнопки -->
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($turtle) ? 'Обновить' : 'Создать' }}
        </button>
        <a href="{{ route('turtles.index') }}" class="btn btn-secondary mt-4">
            Назад к списку
        </a>
    </div>
</form>
