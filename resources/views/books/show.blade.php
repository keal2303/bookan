<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Show Book</title>
    </head>
<body>
<button onclick="openModal()">View Book Details</button>

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
        <h1>Book: {{ $book->title }}</h1>
        <p>{{ $book->description }}</p>
        <!-- Review Modal -->
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


