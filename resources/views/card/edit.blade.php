<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Изменить данные о {{ $card->head_card }}</title>
</head>
<body>
    <h1>Изменить данные о {{$card->head_card}}</h1>
    <div class="form-group mt-4">
        <label>Дата создания:</label>
        <p>{{ $card->created_at }}</p>
    </div>

    <div class="form-group">
        <label>Дата изменения:</label>
        <p>{{ $card->updated_at }}</p>
    </div>

    @include('card.form')

</body>
</html>
