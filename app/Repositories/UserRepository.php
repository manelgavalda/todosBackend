<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\User;

/**
 * Class UserRepository.
 */
class UserRepository implements Repository
{
    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return User::findOrFail($id);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return User::paginate($perPage);
    }

    public function create(array $request)
    {
        User::create($request);
    }

    public function update(array $request,$id)
    {
        $task = $this->findOrFail($id);
        $task->update($request);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
