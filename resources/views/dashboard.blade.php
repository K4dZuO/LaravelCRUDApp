<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <a href="/turtles">К черепашкам</a>
{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    @if ($turtles->isEmpty())--}}
{{--                        <p>У вас пока нет добавленных карточек.</p>--}}
{{--                    @else--}}
{{--                        <h3>Ваши карточки:</h3>--}}
{{--                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">--}}
{{--                            @foreach ($turtles as $turtle)--}}
{{--                                <div class="p-4 bg-gray-100 rounded shadow">--}}
{{--                                    <h4 class="font-bold">{{ $turtle->name_turtle }}</h4>--}}
{{--                                    <p>{{ $turtle->main_info }}</p>--}}
{{--                                    <img src="{{ asset('storage/turtles/' . $turtle->img_name) }}" alt="{{ $turtle->name_turtle }}" class="w-full h-48 object-cover rounded">--}}
{{--                                    <a href="{{ route('turtles.show', $turtle->id) }}" class="text-blue-500 underline">Подробнее</a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</x-app-layout>
