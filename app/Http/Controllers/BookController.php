<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $search = $request->get('search');
        $genreFilter = $request->get('genre');
        $genres = Genre::all();

        $books = Book::when($search, function($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        })->when($genreFilter, function($query) use ($genreFilter) {
            $query->whereHas('genre', function($query) use ($genreFilter) {
                $query->where('name', $genreFilter);
            });
        })->paginate(10);
        return view('books.index', compact('books', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $authors = Author::all(); // Used for select options in blade template.
        $genres = Genre::all(); // Same here.
        return view('books.create', compact( 'authors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try
        {
            /**
             * Validate the data to create.
             */

            $validatedData = $request->validate([
                'author_id' => 'required',
                'genre_id' => 'required',
                'title' => 'required|max:255',
                'description' => 'required|safe_html',
                'isbn' => 'nullable|max:13',
                'published_year' => 'required|digits:4',
                'image' => 'nullable|image|max:2048'
            ]);

            $languages = [
                '1' => 'English',
                '2' => 'French',
                '3' => 'Other',
            ];
            $selectedValue = $request->input('language');
            $selectedLanguage = $languages[$selectedValue] ?? 'default';

            $book = new Book;
            $book->fill($validatedData);
            $book->language = $selectedLanguage;


            /**
             * Create uploaded image logic.
             */
            if ($request->hasFile('image'))
            {
                $storage_path = 'public/books_images';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $request->file('image')->storeAs($storage_path, $image_name);
                $book->image = $image_name;
            }

            $book->save();
            return redirect()->route('books.index')->with('success', 'Book created successfully.');

        } catch (Exception $e) {
            Log::error('Error in Book creation: ' . $e->getMessage());
            return back()->with('error', 'Failed to create the book.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        // $book = Book::findOrFail($id);
        $book = Book::with('reviews')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // Used for select options in blade template.
        $genres = Genre::all(); // Same here.
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try
        {
            /**
             * Validate the data to update.
             */
            $validatedData = $request->validate([
                'author_id' => 'nullable',
                'genre_id' => 'nullable',
                'title' => 'required|max:255',
                'description' => 'required|safe_html',
                'isbn' => 'required|max:13',
                'published_year' => 'required|digits:4',
                'image' => 'nullable|image|max:2048'
            ]);
            $book = Book::findOrFail($id);
            $book->fill($validatedData);

            /**
             * Update uploaded image logic.
             */
            if ($request->hasFile('image'))
            {
                $storage_path = 'public/books_images';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $request->file('image')->storeAs($storage_path, $image_name);
                $book->image = $image_name;
            }

            $book->save();
            return redirect()->route('books.index')->with('success', 'Book updated successfully.');

        } catch (Exception $e) {
            Log::error('Error in Book update: ' . $e->getMessage());
            return back()->with('error', 'Failed to update the book.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
