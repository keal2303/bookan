<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Show Book</title>
    </head>
<body>
<h1>Book: {{ $book->title }}</h1>
<p>{{ $book->description }}</p>
Review Count: {{ $book->calculateReviewCount() }}
Average Review Note: {{ number_format($book->calculateAverageReviewNote(), 2) }}
<button onclick="openModal()">View Reviews</button>
<div id="bookModal" style="
        display:none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;">
    <div style="background-color: white; padding: 20px; border-radius: 5px;">
        <h3>Reviews:</h3>
        @foreach($book->reviews as $review)
            <p>Username {{ $review->review_note }}</p>
            <p>{{$review->message }}</p>
            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endforeach
        <button onclick="closeModal()">Close</button>
    </div>
</div>
<a href="{{ route('books.index') }}">Back to list</a>
</body>
    <script>
        function openModal() {
            document.getElementById('bookModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('bookModal').style.display = 'none';
        }
    </script>
</html>


