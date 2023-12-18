<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authors List</title>
</head>
<body>
<h1>Authors</h1>
<a href="{{ route('authors.create') }}">Create New Author</a>
<form action="{{ route('authors.index') }}" method="GET">
    <input type="text" name="search" placeholder="Search for authors...">
    <button type="submit">Search</button>
</form>
<ul>
    @foreach ($authors as $author)
        <li>
            {{ $author->name }}
            <a href="{{ route('authors.show', $author->id) }}">Show</a>
            <a href="{{ route('authors.edit', $author->id) }}">Edit</a>
            <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
</body>
</html>
