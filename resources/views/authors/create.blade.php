<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Author') }}
        </h2>
    </x-slot>
    <!-- Flash Message -->
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
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
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select><br>
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
</x-app-layout>
