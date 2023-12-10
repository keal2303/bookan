<!DOCTYPE html>
<html lang="en">
<head>
    <title>Show Author</title>
</head>
<body>
<h1>Author: {{ $author->name }}</h1>
<p>{!! $author->bio !!}</p>
<a href="{{ route('authors.index') }}">Back to list</a>
</body>
</html>
