<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy
 * @package App\Policies
 */
class TaskPolicy extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * Determine whether the user can list all tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    protected function model()
    {
        return 'task';
    }
}
