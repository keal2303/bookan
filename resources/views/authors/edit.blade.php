<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Author</title>
</head>
<body>
<h1>Edit Author</h1>
<!-- Flash Message -->
@if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
<form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ $author->name }}"><br>
    <label for="bio">Bio:</label><br>
    <textarea id="bio" name="bio" cols="30" rows="10"></textarea><br>
    <label for="birth_year">Birth Year:</label><br>
    <input type="number" id="birth_year" name="birth_year"><br>
    <label for="death_year">Death Year <em>(If applicable)</em>:</label><br>
    <input type="number" id="death_year" name="death_year"><br>
    <label for="language">Language</label><br>
    <select id="language" name="language">
        <option value="1">English</option>
        <option value="2">French</option>
        <option value="3">Others</option>
    </select><br>
    <label for="link">Link:</label><br>
    <input type="text" id="link" name="link"><br>
    <label for="media">Media:</label><br>
    <input type="text" id="media" name="media"><br>
    <label for="genre_id">Genre:</label>
    <!-- TODO: Add search bar and action buttons -->
    <select id="genre_id" name="genre_id">
        <!-- Checks if there are genres and list them. -->
        @if($author->genres && $author->genres->count() > 0)
            @foreach($author->genres as $genre)
                <option value="{{ $genre->id }}" {{ $author->genres->contains($genre) ? 'selected' : ''  }}>
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
    <!-- Displays the author associated image if it exists. -->
    @if($author->image)
        <img src="{{ asset('storage/authors_images/' . $author->image) }}" alt="Image of the author">
    @else
        <p>No image available for this author.</p>
    @endif
    <input type="file" name="image">
    <button type="submit">Submit</button>
</form>
<a href="{{ route('authors.index') }}">Back to list</a>
<script src="{{asset('ckeditor5/build/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#bio' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>
