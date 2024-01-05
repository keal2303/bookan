<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ($book->title) }} by {{ $book->author->name }}
        </h2>
    </x-slot>
    <br>
    <div class="flex flex-initial">
        <div class="flex-none ml-5 -mr-300">
            <img src="{{ asset('storage/books_images/' . $book->image) }}" alt="Image of the book." class="w-1/2">
            <br>
            <div>
                <x-read-button>
                    <a href="{{ Str::startsWith($book->link, ['http://', 'https://']) ? $book->link : 'http://' . $book->link }}">READ</a>
                </x-read-button>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'open-reviews')">
                    Reviews
                </x-primary-button>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-review')">
                    Add Review
                </x-primary-button>
            </div>
            <br>
            <p><strong>Review Count: </strong>{{ $book->calculateReviewCount() }}</p>
            <p><strong>Average Review Note: </strong>{{ number_format($book->calculateAverageReviewNote(), 2) }}</p>
            <p><strong>ISBN: </strong>{{ $book->isbn }}</p>
            <p><strong>Language: </strong>{{ $book->language }}</p>
            <p><strong>Published year: </strong>{{ $book->published_year }}</p>
        </div>
        <div>
            <p>{{ $book->description }}</p>
        </div>
    </div>
    <x-modal name="open-reviews">
        @foreach($book->reviews as $review)
            <p>Username {{ $review->review_note }}</p>
            <p>{{ $review->message }}</p>
        @endforeach
    </x-modal>
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
    <br>
    <x-secondary-button class="ml-5">
        <a href="{{ route('books.index') }}">Back to list</a>
    </x-secondary-button>
</x-app-layout>
