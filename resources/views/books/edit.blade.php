<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book</title>
</head>
<body>
<h1>Edit Book</h1>
<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="author_id">Author:</label>
    <!-- TODO: Add search bar and action buttons-->
    <select id="author_id" name="author_id">
        @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>
    <label for="genre_id">Genre:</label>
    <!-- TODO: Add search bar and action buttons-->
    <select id="genre_id" name="genre_id">
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    <label for="description">Description:</label>
    <textarea id="description" name="description" cols="30" rows="10"></textarea>
    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn">
    <label for="language">Language</label><br>
    <select id="language" name="language">
        <option value="1">English</option>
        <option value="2">French</option>
        <option value="3">Others</option>
    </select><br>
    <label for="published_year">Published Year:</label>
    <input type="number" id="published_year" name="published_year">
    <button type="submit">Submit</button>
</form>
<a href="{{ route('books.index') }}">Back to list</a>
</body>
</html>
