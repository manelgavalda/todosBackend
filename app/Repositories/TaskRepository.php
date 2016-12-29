<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\Task;

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

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return Task::paginate($perPage);
    }

    public function create(array $request)
    {
        Task::create($request->all());
    }

    public function update(array $request,$id)
    {
        $task = $this->findOrFail($id);
        $task->update($request);
    }

    public function delete($id)
    {
        Task::findOrFail($id)->delete();
    }
}
