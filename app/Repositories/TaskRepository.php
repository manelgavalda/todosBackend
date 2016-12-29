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
    public function find($id, $columns = ['*']) //all
    {
        return Task::findOrFail($id);
    }

    public function paginate($numberOfTasks)
    {
        return Task::paginate($numberOfTasks);
    }

    public function create(array $request)
    {
        Task::create($request->all());
    }

    public function update($id, array $request)
    {
        $task = $this->findOrFail($id);
        $task->update($request);
    }

    public function delete($id)
    {
        Task::findOrFail($id)->delete();
    }
}
