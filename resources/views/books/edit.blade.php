<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book</title>
</head>
<body>
<h1>Edit Book</h1>
<form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="author_id">Author:</label><br>
    <!-- TODO: Add search bar and action buttons -->
    <select id="author_id" name="author_id">
        <!-- Displays the recorded option value before the list of authors. -->
        <option value="{{ $book->author_id }}">{{ $book->author ? $book->author->name : 'N/A' }}</option>
        @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select><br>
    <label for="genre_id">Genre:</label><br>
    <!-- TODO: Add search bar and action buttons -->
    <!-- TODO: Add multiple selection -->
    <select id="genre_id" name="genre_id">
        <!-- Checks if there are genres and list them. -->
        @if($book->genres && $book->genres->count() > 0)
            @foreach($book->genres as $genre)
                <option value="{{ $genre->id }}" {{ $book->genres->contains($genre) ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        @else
            <option value="">N/A</option>
        @endif

        <!-- Lists all genres for selection. -->
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select><br>
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ $book->title }}"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" cols="30" rows="10">{{ $book->description }}</textarea><br>
    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}"><br>
    <label for="language">Language</label><br>
    <select id="language" name="language">
        <option value="1">English</option>
        <option value="2">French</option>
        <option value="3">Others</option>
    </select><br>
    <label for="published_year">Published Year:</label><br>
    <input type="number" id="published_year" name="published_year" value="{{ $book->published_year }}"><br>
    <!-- Displays the book associated image if it exists. -->
    @if ($book->image)
        <img src="{{ asset('storage/books_images/' . $book->image) }}" alt="Image of the book">
    @else
        <p>No image available for this book.</p>
    @endif
    <input type="file" name="image">
    <button type="submit">Submit</button>
</form>
<a href="{{ route('books.index') }}">Back to list</a>
</body>
</html>
