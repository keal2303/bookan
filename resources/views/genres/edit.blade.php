<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Genre</title>
</head>
<body>
<h1>Edit Genre</h1>
<form action="{{ route('genres.update', $genre->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ $genre->name }}"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description">{!! $genre->description !!}</textarea><br>
    <!-- Displays the genre associated image if it exists. -->
    @if ($genre->image)
        <img src="{{ asset('storage/genres_images/' .$genre->image) }}" alt="Image of the genre">
    @else
        <p>No image available for this genre.</p>
    @endif
    <input type="file" name="image">
    <button type="submit">Submit</button>
</form>
<a href="{{ route('genres.index') }}">Back to list</a>
<script src="{{asset('ckeditor5/build/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>
