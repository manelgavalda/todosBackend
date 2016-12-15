<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy.
 */
class TaskPolicy //extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * Determine whether the user can list all tasks.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    protected function model()
    {
        return 'task';
    }
}
