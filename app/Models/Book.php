<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail(string $id)
 * @method static inRandomOrder()
 * @property mixed|string $language to get string from language key value
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'genre_id',
        'title',
        'description',
        'isbn',
        'language',
        'published_year',
        'image'
    ];

    protected $hidden = [
        'is_bookan_original'
        /** TODO:
         * created_by
         * review_count
         * reviews_note
         */
    ];

    /**
     * Get the author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the genre(s).
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    /**
     * Get the review(s).
     */
    public function reviews(): HasMany
    {
        return $this->HasMany(Review::class);
    }

    /**
     * Get review(s) count.
     */
    public function calculateReviewCount()
    {
        return $this->reviews()->count();
    }

    /**
     * Get review average note.
     */
    public function calculateAverageReviewNote()
    {
        return $this->reviews()->avg('review_note');
    }

}
