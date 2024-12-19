<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <br />
    <div style="
    display: flex;
    justify-content: center;
    height: 50px">
        <a class='btn btn-primary' href="/turtles"
           style="
             border: 3px black solid;
             padding: 10px;
             font-size: 18px;
           vertical-align: center">К черепахам</a>
    </div>

</x-app-layout>
