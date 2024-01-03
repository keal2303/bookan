<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ' . $genre->name) }}
        </h2>
    </x-slot>
    <!-- Flash Message -->
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('genres.update', $genre->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $genre->name }}"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{!! $genre->description !!}</textarea><br>
        <!-- Displays the genre associated image if it exists. -->
        @if ($genre->image)
            <img src="{{ asset('storage/genres_images/' .$genre->image) }}" alt="Image of the genre">
        @else
            <p>No image available for this genre.</p>
        @endif
        <input type="file" name="image">
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('genres.index') }}">Back to list</a>
</x-app-layout>
