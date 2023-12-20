<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Genres List') }}
        </h2>
    </x-slot>
    <a href="{{ route('genres.create') }}">Create New Genre</a>
    <form action="{{ route('genres.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search for genres...">
        <button type="submit">Search</button>
    </form>
    <ul>
        @foreach ($genres as $genre)
            <li>
                {{ $genre->name }}
                <a href="{{ route('genres.show', $genre->id) }}">Show</a>
                <a href="{{ route('genres.edit', $genre->id) }}">Edit</a>
                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
