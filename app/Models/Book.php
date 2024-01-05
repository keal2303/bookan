<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail(string $id)
 * @method static inRandomOrder()
 * @method static when(mixed $search, \Closure $param)
 * @property mixed|string $language to get string from language key value
 * @property mixed|string $image
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
        'image',
        'link'
    ];

    protected $hidden = [
        'is_bookan_original'
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
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
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
    public function calculateReviewCount(): int
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
