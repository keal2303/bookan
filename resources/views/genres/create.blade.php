<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Genre</title>
</head>
<body>
<h1>Create New Genre</h1>
<form action="{{ route('genres.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
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
