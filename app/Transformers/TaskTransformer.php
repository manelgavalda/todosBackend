<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

/**
 * Class TaskTransformer.
 */
class TaskTransformer extends Transformer
{
    /**
     * Transform a task.
     *
     * @param $resource
     *
     * @throws IncorrectModelException
     *
     * @return array
     */
    public function transform($resource)
    {
        if (!$resource instanceof Task) {
            throw new IncorrectModelException();
        }

        return [
            'id'         => (int) $resource['id'],
            'name'       => $resource['name'],
            'done'       => (bool) $resource['done'],
            'priority'   => (int) $resource['priority'],
            'user_id'    => (int) $resource['user_id'],
            //'created_at' => $resource['created_at']->toDateString(),
            //'updated_at' => $resource['updated_at']->toDateString(),
        ];
    }
}
