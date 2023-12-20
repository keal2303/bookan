<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ' .  $book->title) }}
        </h2>
    </x-slot>
    <!-- Flash Message -->
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="author_id">Author:</label><br>
        <select id="author_id" name="author_id">
            <!-- Displays the recorded option value before the list of authors. -->
            <option value="{{ $book->author_id }}">{{ $book->author ? $book->author->name : 'N/A' }}</option>
            <!-- Then displays the rest of the list. -->
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select><br>
        <label for="genre_id">Genre:</label><br>
        <select id="genre_id" name="genre_id">
            <!-- Displays the recorded option value before the list of genres. -->
            <option value="{{ $book->genre_id }}">{{ $book->genre ? $book->genre->name : 'N/A' }}</option>
            <!-- Then displays the rest of the list. -->
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $book->title }}"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" cols="30" rows="10">{!! $book->description !!}</textarea><br>
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
    <script src="{{asset('ckeditor5/build/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-app-layout>
