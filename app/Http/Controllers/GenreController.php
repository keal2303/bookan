<?php

namespace App\Http\Controllers;

use App\Models\Genre;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('genres.create');
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
                'name' => 'unique:genres|required|max:255',
                'description' => 'required',
                'image' => 'nullable|image|max:2048'
            ]);

            $genre = new Genre;
            $genre->fill($validatedData);

            /**
             * Create uploaded image logic.
             */
            if ($request->hasFIle('image'))
            {
                $storage_path = 'public/genres_images';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $request->file('image')->storeAs($storage_path, $image_name);
                $genre->image = $image_name;
            }

            $genre->save();
            return redirect()->route('genres.index')->with('success', 'Author created successfully.');
        } catch (Exception $e) {
            Log::error('Error in Genre creation: ' . $e->getMessage());
            return back()->with('error', 'Failed to create the genre.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genre = Genre::findOrFail($id);
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try
        {
            /**
             * Validate the data to create.
             */
            $validatedData = $request->validate([
                'name' => 'unique:genres|required|max:255',
                'description' => 'required',
                'image' => 'nullable|image|max:2048'
            ]);

            $genre = Genre::findOrFail($id);

            $genre->fill($validatedData);
            /**
             * Update uploaded image logic.
             */
            if ($request->hasFile('image'))
            {
                $storage_path = 'public/genres_images';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $request->file('image')->storeAs($storage_path, $image_name);
                $genre->image = $image_name;
            }

            $genre->save();
            return redirect()->route('genres.index')->with('success', 'Author updated successfully.');
        } catch (Exception $e) {
            Log::error('Error in Genre update: ' . $e->getMessage());
            return back()->with('error', 'Failed to update the genre.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Author deleted successfully.');
    }
}
