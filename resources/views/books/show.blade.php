<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Show Book</title>
    </head>
<body>
<h1>Book: {{ $book->title }}</h1>
<p>{{ $book->description }}</p>
<a href="{{ route('books.index') }}">Back to list</a>
</body>
</html>
