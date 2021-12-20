<?php

namespace App\Http\Library;

trait Library
{
    /**
     * Check if the user has admin rule
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isAdmin($user)
    {
        if (!empty($user) && strcmp($user->rule, "admin") == 0) {
            return true;
        }
        return false;
    }

    /**
     * Check if the user has owner rule
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isOwner($user)
    {
        if (!empty($user) && strcmp($user->rule, "owner") == 0) {
            return true;
        }
        return false;
    }

    /**
     * Check if the user has user rule
     *
     * @param \App\Models\User $user user connecté
     *
     * @return bool
     */
    protected function isUser($user)
    {
        if (!empty($user) && strcmp($user->rule, "user") == 0) {
            return true;
        }
        return false;
    }
}
