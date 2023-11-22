<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Author</title>
</head>
<body>
<h1>Create New Author</h1>
<form action="{{ route('authors.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="bio">Bio:</label><br>
    <textarea name="bio" id="bio" name="bio" cols="30" rows="10"></textarea><br>
    <label for="birth_year">Birth Year:</label><br>
    <input type="number" id="birth_year" name="birth_year"><br>
    <label for="death_year">Death Year <em>(If applicable)</em>:</label><br>
    <input type="number" id="death_year" name="death_year"><br>
    <label for="nationality">Nationality</label><br>
    <select id="nationality" name="nationality">
        <option value="1">aaa</option>
        <option value="2">bbb</option>
        <option value="3">ccc</option>
    </select><br>
    <label for="link">Link:</label><br>
    <input type="text" id="link" name="link"><br>
    <label for="media">Media:</label><br>
    <input type="text" id="media" name="media"><br>
    <button type="submit">Submit</button>
</form>
<a href="{{ route('authors.index') }}">Back to list</a>
</body>
</html>
