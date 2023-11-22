<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Genre</title>
</head>
<body>
<h1>Create New Genre</h1>
<form action="{{ route('genres.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <button type="submit">Submit</button>
</form>
<a href="{{ route('genres.index') }}">Back to list</a>
</body>
</html>