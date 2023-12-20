<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Book') }}
        </h2>
    </x-slot>
    <!-- Flash Message -->
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="author_id">Author:</label><br>
        <select id="author_id" name="author_id">
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select><br>
        <label for="genre_id">Genre:</label><br>
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
    <script src="{{asset('ckeditor5/build/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-app-layout>
