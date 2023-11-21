<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
      'author_id',
      'genre_id',
      'title',
      'isbn',
      'published_year'
    ];

    /**
     * Get the author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the genre
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
