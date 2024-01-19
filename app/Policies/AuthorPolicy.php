<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'admin' || $user->role == 'contributor';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user, Author $author): bool
    {
        return $user->role == 'admin' || $user->role == 'moderator';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Author $author): bool
    {
        return $user->role == 'admin' || $user->role == 'moderator';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user, Author $author): bool
    {
        return $user->role == 'admin' || $user->role == 'moderator';
    }

}
