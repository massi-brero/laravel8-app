<?php

namespace App\Policies;

use App\Models\Hobby;
use App\Models\User;

class HobbyPolicy extends AbstractPolicy
{
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hobby  $hobby
     * @return mixed
     */
    public function update(User $user, Hobby $hobby)
    {
        return $user->id === $hobby->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hobby  $hobby
     * @return mixed
     */
    public function delete(User $user, Hobby $hobby)
    {
        return $user->id === $hobby->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hobby  $hobby
     * @return mixed
     */
    public function restore(User $user, Hobby $hobby)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hobby  $hobby
     * @return mixed
     */
    public function forceDelete(User $user, Hobby $hobby)
    {
        //
    }
}
