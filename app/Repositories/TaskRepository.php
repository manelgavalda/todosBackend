<?php

namespace ManelGavalda\TodosBackend\Repositories;

use ManelGavalda\TodosBackend\Repositories\Contracts\Repository;
use ManelGavalda\TodosBackend\Task;

/**
 * Class TaskRepository.
 */
class TaskRepository implements Repository
{
    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']) //all
    {
        return Task::findOrFail($id);
    }

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return Task::paginate($perPage);
    }

    /**
     * @param array $request
     *
     * @return void
     */
    public function create(array $request)
    {
        Task::create($request);
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
        Task::findOrFail($id)->delete();
    }
}
