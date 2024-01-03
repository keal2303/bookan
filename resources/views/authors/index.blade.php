<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors List') }}
        </h2>
    </x-slot>
    <br>
    <form action="{{ route('authors.index') }}" method="GET">
        <div class="inline-flex">
            &nbsp&nbsp<label>
                <input type="text" name="search" placeholder="Search for authors..." class="border-none">
            </label>
            <button type="submit" class="bg-blue-900 p-2 text-white rounded-r-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-3 0 34 22" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
            <button type="button" class="bg-blue-900 p-2 text-white ms-4 rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-3 0 34 22" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
            </button>
            <label>
                <select name="genre" onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </label>
            <div class="relative group">
                <button type="button" class="bg-blue-900 p-2 text-white ms-4 rounded-lg">
                    <a href="{{ route('authors.create') }}" class="border-solid">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </button>
                <span class="tooltip-text absolute hidden bg-gray-800 text-white text-xs py-1 px-2 rounded shadow-lg whitespace-nowrap group-hover:block">Create a new author</span>
            </div>
        </div>
    </form>
    <br>
    <ul role="list" class="divide-y divide-gray-100">
        @foreach ($authors as $author)
            <li class="flex justify-between">
                <div class="flex min-w-0 gap-x-4">
                    <img class="h-12 w-8 flex-none bg-gray-50" src="{{ asset('storage/authors_images/' . $author->image) }}" alt="Image of the author">
                    <div class="min-w-0 flex-auto">
                        <a href="{{ route('authors.show', $author->id) }}">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $author->name }}</p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $author->bio }}</p>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div style="padding: 20px;">
        {{ $authors->appends(['search' => request()->query('search')])->links() }}
    </div>
</x-app-layout>
