<!DOCTYPE html>
<html lang="en">
<head>
    <title>Show Genre</title>
</head>
<body>
<h1>Genre: {{ $genre->name }}</h1>
<p>{!! $genre->description !!}</p>
<a href="{{ route('genres.index') }}">Back to list</a>
</body>
</html>
