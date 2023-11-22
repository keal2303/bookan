<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(string $id)
 * @method static pluck(string $string, string $string1)
 */
class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description'
    ];
}
