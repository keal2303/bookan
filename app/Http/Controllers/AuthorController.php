<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Genre;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = $request->user();
        $search = $request->get('search');
        $genreFilter = $request->get('genre');
        $genres = Genre::all();

        $authors = Author::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->when($genreFilter, function($query) use ($genreFilter) {
          $query->whereHas('genre', function($query) use ($genreFilter) {
            $query->where('name', $genreFilter);
          });
        })->paginate(10);
        return view('authors.index', compact('authors', 'genres', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('create', Author::class);
        $genres = Genre::all(); // Used for select options in blade template.
        return view('authors.create', compact('genres'));
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
                'genre_id' => 'nullable',
                'name' => 'required|unique:authors|max:255',
                'bio' => 'required',
                'birth_year' => 'nullable',
                'death_year' => 'nullable',
                'language' => 'required',
                'link' => 'nullable',
                'media' => 'nullable',
                'image' => 'nullable|image|max:2048'
            ]);

            $languages = [
                '1' => 'English',
                '2' => 'French',
                '3' => 'Other',
            ];
            $selectedValue = $request->input('language');
            $selectedLanguage = $languages[$selectedValue] ?? 'default';

            $author = new Author;
            $author->fill($validatedData);
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
        } catch(Exception $e) {
            Log::error('Error in Author creation: ' . $e->getMessage());
            return back()->with('error', 'Failed to create the author.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = $request->user();
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genres = Genre::all(); // Used for select options in blade template
        $author = Author::findOrFail($id);
        $this->authorize('update', $author);
        return view('authors.edit', compact('author', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try
        {
            $author = Author::findOrFail($id);
            $this->authorize('update', $author);

            /**
             * Validate the data to update.
             */
            $validatedData = $request->validate([
                'genre_id' => 'required',
                'name' => 'required|max:255|unique:authors,name,' . $author->id,
                'bio' => 'required',
                'birth_year' => 'nullable',
                'death_year' => 'nullable',
                'language' => 'required',
                'link' => 'nullable',
                'media' => 'nullable',
                'image' => 'nullable|image|max:2048'
            ]);


            $author->fill($validatedData);

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
        } catch (Exception $e) {
            Log::error('Error in Author update: ' . $e->getMessage());
            return back()->with('error', 'Failed to update the author.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $author = Author::findOrFail($id);
        $this->authorize('destroy', $author);
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
