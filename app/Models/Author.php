<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(string $id)
 * @method static inRandomOrder()
 * @method static when(mixed $search, \Closure $param)
 * @property mixed|string $language to get string from language key value
 * @property mixed|string $image
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'name',
        'bio',
        'birth_year',
        'death_year',
        'language',
        'link',
        'media',
        'image'
    ];

    protected $hidden = [
      'is_alive'
    ];

    /**
     * Set is_alive to false is death_year is not null.
     * Else, is_alive will be true by default.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($author) {
            if (!is_null($author->death_year)) {
                $author->is_alive = false;
            }
        });
    }

    /**
     * Get the genre(s).
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
