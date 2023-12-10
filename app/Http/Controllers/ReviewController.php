<?php

namespace App\Http\Controllers;

use App\Models\Review;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reviews = Review::all();
        return view('books.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('reviews.create');
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
                'book_id' => 'required',
                'message' => 'required|safe_html',
                'review_note' => 'required'
            ]);

            $review = new Review;
            $review->fill($validatedData);
            $review->save();
            return redirect()->route('books.show', ['id' => $validatedData['book_id']])->with('success', 'Review created successfully.');
        } catch (Exception $e) {
            Log::error('Error in Genre update: ' . $e->getMessage());
            return back()->with('error', 'Failed to create the review.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('books.index')->with('success', 'Review deleted successfully');
    }
}
