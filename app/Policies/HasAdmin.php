<?php

namespace App\Policies;

/**
 * Class HasAdmin
 * @package App\Policies
 */
trait HasAdmin
{
    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) return true;
    }
}