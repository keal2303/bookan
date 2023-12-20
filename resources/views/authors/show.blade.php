<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($author->name) }}
        </h2>
    </x-slot>
    <p>{!! $author->bio !!}</p>
    <a href="{{ route('authors.index') }}">Back to list</a>
</x-app-layout>
