<?php

namespace App\Repositories;

use App\Task;
use App\User;

class UserTasksRepository
{
    public function findOrFail($id_user, $id_task, $columns = ['*'])
    {
        $user = User::findOrFail($id_user);

        return $user->tasks()->findOrFail($id_task);
    }

    public function paginate($id, $perPage = 15, $columns = ['*'])
    {
        $user = User::findOrFail($id);

        return $user->tasks()->paginate($perPage);
    }

    public function create(array $request, $id)
    {
        User::findOrFail($id);
        Task::create($request);
    }

    public function update(array $request, $id_user, $id_task)
    {
        $user = User::findOrFail($id_user);
        $task = $user->tasks()->findOrFail($id_task);
        $task->update($request);
    }

    public function delete($id_user, $id_task)
    {
        $user = User::findOrFail($id_user);
        $task = $user->tasks()->findOrFail($id_task);
        $task->delete();
    }
}
