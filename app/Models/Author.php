<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static findOrFail(string $id)
 * @property mixed|string $language to get string from key value
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
        'media'
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
     * Get the genre.
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
