<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($author->name) }}
        </h2>
    </x-slot>
    <p>{{ $author->bio }}</p>
    @if($user['role'] == 'admin' || $user['role'] == 'moderator')
        <x-primary-button><a href="{{ route('authors.edit', $author->id) }}">Edit</a></x-primary-button>
        <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button type="submit" class="mt-2">Delete</x-danger-button>
        </form>
    @endif
    <a href="{{ route('authors.index') }}">Back to list</a>
</x-app-layout>
