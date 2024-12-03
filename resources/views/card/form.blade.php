<form action="{{ isset($card) ? route('cards.update', $card->id) : route('cards.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($card))
        @method('PUT')  <!-- Метод для обновления карточки -->
    @endif

    <div class="form-group">
        <label for="head_card">Название карточки</label>
        <input type="text" name="head_card" id="head_card" class="form-control"
               value="{{ old('head_card', $card->head_card ?? '') }}" required>
    </div>
    @error('head_card')<p style="color: red">{{$message}}</p>@enderror

    <div class="form-group mt-3">
        <label for="body_card">Основная информация</label>
        <textarea name="body_card" id="body_card" class="form-control" rows="3" required>{{ old('body_card', $card->body_card ?? '') }}</textarea>
    </div>
    @error('body_card')<p style="color: red">{{$message}}</p>@enderror

    <div class="form-group mt-3">
        <label for="body_modal">Дополнительная информация для модального окна</label>
        <textarea name="body_modal" id="body_modal" class="form-control" rows="3" required>{{ old('body_modal', $card->body_modal ?? '') }}</textarea>
    </div>
    @error('body_modal')<p style="color: red">{{$message}}</p>@enderror

    <div class="form-group mt-3">
        <label for="image">Загрузить изображение</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        @if(isset($card) && $card->img_name)
            <div class="mt-2">
                <p>Текущее изображение:</p>
                <img src="{{ asset('storage/cards/' . $card->img_name) }}" class="img-fluid" alt="Текущее изображение">
            </div>
        @endif
    </div>
    @error('image')<p style="color: red">{{$message}}</p>@enderror

    <div>
        <button type="submit" class="btn btn-primary mt-4">
            {{ isset($card) ? 'Обновить' : 'Создать' }}
        </button>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary mt-4">
            Назад к списку
        </a>
    </div>


</form>
