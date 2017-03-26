<?php

namespace ManelGavalda\TodosBackend\Policies;

use ManelGavalda\TodosBackend\Task;
use ManelGavalda\TodosBackend\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy.
 */
class TaskPolicy // extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * Determine whether the user can list all tasks.
     *
     * @param \ManelGavalda\TodosBackend\User $user
     *
     * @return mixed
     */
    protected function model()
    {
        return 'task';
    }
}
