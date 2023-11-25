<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Genre;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genres = Genre::all(); // Used for select options in blade template.
        return view('authors.create', compact('genres'));
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

        $author = new Author;
        $author->fill($request->only('genre_id', 'name', 'bio', 'birth_year', 'death_year', 'link', 'media', 'image'));
        $author->language = $selectedLanguage;


        /**
         * Create uploaded image logic.
         */
        if ($request->hasFile('image'))
        {
            $storage_path = 'public/authors_images';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $request->file('image')->storeAs($storage_path, $image_name);
            $author->image = $image_name;
        }
        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genres = Genre::all(); // Used for select options in blade template
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $author = Author::findOrFail($id);
        $author->fill($request->only('genre_id', 'name', 'bio', 'birth_year', 'death_year', 'language', 'link', 'media', 'image'));

        /**
         * Update uploaded image logic.
         */
        if ($request->hasFile('image'))
        {
            $storage_path = 'public/authors_images';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $request->file('image')->storeAs($storage_path, $image_name);
            $author->image = $image_name;
        }

        $author->save();
        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
