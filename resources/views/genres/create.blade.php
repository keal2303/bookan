<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Genre') }}
        </h2>
    </x-slot>
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
</x-app-layout>
