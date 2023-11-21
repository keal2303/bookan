<!DOCTYPE html>
<html>
<head>
    <title>Edit Genre</title>
</head>
<body>
<h1>Edit Genre</h1>
<form action="{{ route('genres.update', $genre->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ $genre->name }}"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description">{{ $genre->description }}</textarea><br>
    <button type="submit">Submit</button>
</form>
<a href="{{ route('genres.index') }}">Back to list</a>
</body>
</html>
