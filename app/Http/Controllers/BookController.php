<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact( 'authors', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $languages = [
            '1' => 'English',
            '2' => 'French',
            '3' => 'Other',
        ];
        $selectedValue = $request->input('language');
        $selectedLanguage = $languages[$selectedValue] ?? 'default';

        $book = new Book;
        $book->fill($request->only('author_id', 'genre_id', 'title', 'description', 'isbn', 'published_year'));
        $book->language = $selectedLanguage;
        $book->save();
        return redirect()->route('books.index')->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->fill($request->only('author_id', 'genre_id', 'title', 'description', 'isbn', 'published_year'));
        $book->save();
        return redirect()->route('books.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Author deleted successfully.');
    }
}
