@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Все пользователи</h1>
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $user->name }}</span>
                    <div>
                        @if(auth()->user()->friends->contains($user))
                            <form action="{{ route('friends.remove', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Удалить из друзей</button>
                            </form>
                        @else
                            <form action="{{ route('friends.add', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Добавить в друзья</button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
