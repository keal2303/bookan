<!DOCTYPE html>
<html lang="en">
<head>
    <title>Genres List</title>
</head>
<body>
<h1>Genres</h1>
<a href="{{ route('genres.create') }}">Create New Genre</a>
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
</body>
</html>
