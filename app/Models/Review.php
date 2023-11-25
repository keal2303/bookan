<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(string $id)
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'message',
        'review_note'
    ];

    /**
     * Get the book.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
