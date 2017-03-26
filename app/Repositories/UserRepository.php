<?php

namespace ManelGavalda\TodosBackend\Repositories;

use ManelGavalda\TodosBackend\Repositories\Contracts\Repository;
use ManelGavalda\TodosBackend\User;

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

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return User::paginate($perPage);
    }

    /**
     * @param array $request
     *
     * @return void
     */
    public function create(array $request)
    {
        User::create($request);
    }

    /**
     * @param array $request
     * @param $id
     *
     * @return void
     */
    public function update(array $request, $id)
    {
        $task = $this->findOrFail($id);
        $task->update($request);
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }
}
