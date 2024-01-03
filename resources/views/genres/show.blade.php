<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($genre->name) }}
        </h2>
    </x-slot>
    <p>{{ $genre->description }}</p>
    <a href="{{ route('genres.index') }}">Back to list</a>
</x-app-layout>
