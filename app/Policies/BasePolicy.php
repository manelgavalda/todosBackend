<?php

namespace ManelGavalda\TodosBackend\Policies;

use ManelGavalda\TodosBackend\Task;
use ManelGavalda\TodosBackend\User;

/**
 * Class BasePolicy.
 */
abstract class BasePolicy
{
    abstract protected function model();

    /**
     * @param User $user
     *
     * @return bool
     */
    public function show(User $user)
    {
        //return true;
        if ($user->hasPermissionTo('show-'.$this->model())) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param \ManelGavalda\TodosBackend\User $user
     * @param \ManelGavalda\TodosBackend\Task $task
     *
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        if ($user->hasPermissionTo('view-').$this->model()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param \ManelGavalda\TodosBackend\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo('create-').$this->model()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param \ManelGavalda\TodosBackend\User $user
     * @param \ManelGavalda\TodosBackend\Task $task
     *
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        //        if ($user->isAdmin()) return true;
//        if ($user->hasRole('editor')) return true;
//        return $user->id == $task->user_id;
        if ($user->hasPermissionTo('update-').$this->model()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param \ManelGavalda\TodosBackend\User $user
     * @param \ManelGavalda\TodosBackend\Task $task
     *
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if ($user->hasPermissionTo('delete-').$this->model()) {
            return true;
        }

        return false;
    }
}
