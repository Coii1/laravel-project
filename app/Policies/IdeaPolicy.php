<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Idea $idea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
//        return $user->isAdmin();  //example for a feature that only admins can create something
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Idea $idea): Response
    {
        return $user->is($idea->user) ? Response::allow() : Response::denyWithStatus(403, 'You are not the owner of this idea');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Idea $idea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Idea $idea): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Idea $idea): bool
    {
        return false;
    }
}
