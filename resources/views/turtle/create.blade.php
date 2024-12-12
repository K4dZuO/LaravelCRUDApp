<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Создать карточку</title>
</head>
<body>
<h1 style="margin-left: 1%">Создать новую карточку</h1>
@include('turtle.form')
</body>
</html>
