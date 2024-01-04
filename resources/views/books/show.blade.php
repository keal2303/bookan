<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($book->title) }} by {{ $book->author->name }}
        </h2>
    </x-slot>
    <br>
    Review Count: {{ $book->calculateReviewCount() }}
    Average Review Note: {{ number_format($book->calculateAverageReviewNote(), 2) }}
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'open-reviews')">
        Reviews
    </x-primary-button>
    <x-modal name="open-reviews">
        @foreach($book->reviews as $review)
            <p>Username {{ $review->review_note }}</p>
            <p>{{ $review->message }}</p>
        @endforeach
    </x-modal>
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-review')">
        Add Review
    </x-primary-button>
    <x-modal name="create-review">
        <h3>Add review to {{ $book->title }} by {{ $book->author->name }}</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <select name="book_id">
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            </select><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" cols="30" rows="10"></textarea><br>
            <select name="review_note">
                <option value="0">-</option>
                <option value="1">⭐️</option>
                <option value="2">⭐️⭐️</option>
                <option value="3">⭐️⭐️⭐️</option>
                <option value="4">⭐️⭐️⭐️⭐️</option>
                <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
            </select><br>
            <button type="submit">Submit</button>
        </form>
    </x-modal>

    <a href="{{ route('books.index') }}">Back to list</a>
</x-app-layout>
