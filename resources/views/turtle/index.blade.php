<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>TurtleWiki</title>
</head>
<body>
<!-- Шапка сайта  -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/turtles">
            <img
                src="{{ asset('storage/turtle_head.png') }}"
                alt="turtle_logo"
                width="50"
                height="50"
                class="d-inline-block img-fluid align-top"/>
            <p>TurtleWiki</p>
        </a>
        <a href="/dashboard">
            <button class="btn btn-outline-success" type="button" id="uploadButton">{{\Illuminate\Support\Facades\Auth::user()->username}}</button>
        </a>
        <a href="{{ route('turtles.create') }}">
            <button class="btn btn-primary" type="button" id="uploadButton">Добавить</button>
        </a>
    </div>
</nav>

<!-- Основная часть -->
<div class="container mt-4">
    <h1>Семейства черепах</h1>

    <!-- Сетка Bootstrap для карточек -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($turtles as $turtle)
            <div class="col">
                <div class="card h-100">
                    <p class="sign-label">Черепахи</p>
                    <img
                        src="{{ asset('storage/turtles/' . $turtle->img_name) }}"
                        class="card-img-top img-fluid"
                        alt="{{ $turtle->name_turtle }}"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ $turtle->name_turtle }}</h5>
                        <p style="font-weight: bold">Автор: {{$turtle->user_id}}</p>
                        <p class="card-text">{{ $turtle->main_info }}</p>
                        <div class="d-flex justify-content-end">
                            @if($turtle -> deleted_at)
                                <div style="justify-content: left; width: 270px;">
                                        <p class="btn btn-secondary"
                                                style="color: red;"
                                        >Удалено</p>
                                </div>
                            @endif
                            <a href="{{ route('turtles.show', $turtle->id) }}" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="height: 16em; width: 100%; justify-content: center">
                <br />
                <h2 class="text-center">Нет ни одной карточки!</h2>
                <h2 class="text-center">Добавьте что-нибудь!</h2>
            </div>
        @endforelse
    </div>
    <!-- Конец сетки карточек -->
</div>

<!-- Footer -->
<footer class="container-fluid text-center text-md-start mt-4 p-3">
    <div class="row align-items-center">
        <hr />
        <div class="col-12 col-md-6 text-md-start">
            <p class="mb-0">&copy; Ершов Максим</p>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <a href="https://vk.com/erschoff" target="_blank">
                <img src="{{ asset('storage/vk_icon.png') }}" alt="vk_link" width="30" />
            </a>
            <a href="https://www.reddit.com/user/UpbeatKaleidoscope30/" target="_blank">
                <img src="{{ asset('storage/reddit_icon.png') }}" alt="reddit_link" width="30" />
            </a>
        </div>
    </div>
</footer>
</body>
</html>
