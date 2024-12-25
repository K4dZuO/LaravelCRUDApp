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
