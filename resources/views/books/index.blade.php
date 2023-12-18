<!DOCTYPE html>
<html lang="en">
<head>
    <title>Books List</title>
</head>
<body>
<h1>Books</h1>
<a href="{{ route('books.create') }}">Create New Book</a>
<form action="{{ route('books.index') }}" method="GET">
    <input type="text" name="search" placeholder="Search for books...">
    <button type="submit">Search</button>
</form>

<ul>
    @foreach($books as $book)
        <li>
            {{ $book->title }}
            <a href="{{ route('books.show', $book->id) }}">Show</a>
            <a href="{{ route('books.edit', $book->id) }}">Edit</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            Review Count: {{ $book->review_count }}
            Average Review Note: {{ $book->reviews_note }}
        </li>
    @endforeach
</ul>
</body>
</html>
