<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
{{--    <link href=".css" rel="stylesheet" type="text/css" />--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>TurtleWiki</title>
</head>
<body>
<!-- Шапка сайта  -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/cards">
            <img
                src="{{asset('storage/turtle_head.png')}}"
                alt="turtle_logo"
                width="50"
                height="50"
                class="d-inline-block img-fluid align-top"
            />
            <p>TurtleWiki</p>
        </a>
        <button class="btn btn-outline-success" type="button" id="uploadButton">
            Загрузить
        </button>
    </div>
</nav>

<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div
        id="toastMessage"
        class="toast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
    >
        <div class="toast-header">
            <strong class="me-auto">Уведомление</strong>
            <img
                src="{{ asset('storage/spinner-solid.svg') }}"
                class="rotate-animation"
                alt="load"
            />
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="toast"
                aria-label="Close"
            ></button>
        </div>
        <div class="toast-body">
            На текущий момент этот функционал недоступен.
        </div>
    </div>
</div>

<!-- Основная часть -->
<div class="container mt-4">
    <h1>Семейства черепах</h1>

    <!-- Общее модальное окно -->
    <div
        class="modal fade"
        id="universalModal"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Заголовок</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body" id="modalBody">Основной текст</div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Сетка Bootstrap для карточек -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($cards as $card)
            <!-- Карточка {{$card -> id}}-->
            <div class="col">
                <div class="card h-100">
                    <p class="sign-label">Черепахи</p>
                    <img
                        src="{{asset('storage/KaimanTurtles.jpg')}}"
                        class="card-img-top img-fluid"
                        alt="{{$card -> head_card}}"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{$card -> head_card}}</h5>
                        <p class="card-text">
                            {{$card -> body_card}}
                        </p>
                        <a href="#" class="btn btn-primary more-info" data-bs-toggle="modal" data-bs-target="#universalModal"  data-title="{{$card->head_card}}" data-body="{{$card->body_modal}}">Подробнее</a>
                    </div>
                </div>
            </div>
        @empty<h1>Нет ни одной карточки</h1>
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
                <img src="{{asset('storage/vk_icon.png')}}" alt="vk_link" width="30" />
            </a>
            <a
                href="https://www.reddit.com/user/UpbeatKaleidoscope30/"
                target="_blank"
            >
                <img
                    src="{{asset('storage/reddit_icon.png')}}"
                    alt="reddit_link"
                    width="30"
                />
            </a>
        </div>
    </div>
</footer>

<!-- Подключение JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="../dist/bundle.js"></script>
</body>
</html>
