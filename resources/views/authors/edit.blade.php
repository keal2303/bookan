<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Author</title>
    </head>
<body>
<h1>Edit Author</h1>
<form action="{{ route('authors.update', $author->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label><br>
    <input type="text" id="name" value="{{ $author->name }}"><br>
    <label for="bio">Bio:</label><br>
    <textarea name="bio" id="bio" cols="30" rows="10"></textarea><br>
    <label for="birth_year">Birth Year:</label><br>
    <input type="number" id="birth_year"><br>
    <label for="death_year">Death Year <em>(If applicable)</em>:</label><br>
    <input type="number" id="death_year"><br>
    <label for="nationality">Nationality</label><br>
    <select id="nationality">
        <option value="1">aaa</option>
        <option value="2">bbb</option>
        <option value="3">ccc</option>
    </select><br>
    <label for="link">Link:</label><br>
    <input type="text" id="link"><br>
    <label for="media">Media:</label><br>
    <input type="text" id="media"><br>
    <button type="submit">Submit</button>
</form>
<a href="{{ route('authors.index') }}">Back to list</a>
</body>
</html>
