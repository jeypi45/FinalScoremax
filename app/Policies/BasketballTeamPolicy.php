<?php

namespace App\Policies;

use App\Models\BasketballTeam;
use App\Models\User;

class BasketballTeamPolicy
{
    /**
     * Determine whether the user can update the basketball team.
     */
    public function update(User $user, BasketballTeam $basketballTeam): bool
    {
        // Only allow updates if the basketball team belongs to the user
        return $basketballTeam->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the basketball team.
     */
    public function delete(User $user, BasketballTeam $basketballTeam): bool
    {
        // Only allow deletion if the basketball team belongs to the user
        return $basketballTeam->user_id === $user->id;
    }
}
