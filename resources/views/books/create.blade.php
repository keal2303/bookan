<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Book</title>
</head>
<body>
<h1>Create Book</h1>
<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="author_id">Author:</label><br>
    <!-- TODO: Add search bar and action buttons -->
    <select id="author_id" name="author_id">
        @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select><br>
    <label for="genre_id">Genre:</label><br>
    <!-- TODO: Add search bar and action buttons-->
    <select id="genre_id" name="genre_id">
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select><br>
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" cols="30" rows="10"></textarea><br>
    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn"><br>
    <label for="language">Language</label><br>
    <select id="language" name="language">
        <option value="1">English</option>
        <option value="2">French</option>
        <option value="3">Others</option>
    </select><br>
    <label for="published_year">Published Year:</label><br>
    <input type="number" id="published_year" name="published_year"><br>
    <input type="file" name="image">
    <button type="submit">Submit</button><br>
</form>
<a href="{{ route('books.index') }}">Back to list</a>
</body>
</html>
