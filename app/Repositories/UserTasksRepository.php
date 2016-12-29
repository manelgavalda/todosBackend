<?php

namespace App\Repositories;

use App\User;

class UserTasksRepository
{
    public function findOrFail($id_user,$id_task, $columns = ['*'])
    {
        $user = User::findOrFail($id_user);

        return $user->tasks()->findOrFail($id_task);
    }

    public function paginate($id, $perPage = 15, $columns = array('*'))
    {
        $user = User::findOrFail($id);

        return $user->tasks()->paginate($perPage);
    }
}