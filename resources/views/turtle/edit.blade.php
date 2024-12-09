<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Изменить данные о {{ $turtle->name_turtle }}</title>
</head>
<body>
<h1>Изменить данные о {{$turtle->name_turtle}}</h1>
<div class="form-group mt-4">
    <label>Дата создания:</label>
    <p>{{ $turtle->created_at }}</p>
</div>

<div class="form-group">
    <label>Дата изменения:</label>
    <p>{{ $turtle->updated_at }}</p>
</div>

@include('turtle.form')
</body>
</html>
