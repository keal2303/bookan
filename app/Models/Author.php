<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'name',
        'bio',
        'birth_year',
        'death_year',
        'nationality',
        'link',
        'media'
    ];

    protected $hidden = [
      'is_alive'
    ];

    /**
     * Get the genre
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
