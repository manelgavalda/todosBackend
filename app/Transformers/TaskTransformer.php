<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

//Usem el polimorfisme per evitar crear mètodes iguals.

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
            'name'       => $resource['name'],
            'done'       => (bool) $resource['done'],
            'priority'   => (int) $resource['priority'],
            'created_at' => $resource['created_at']->toDateString(),
            'updated_at' => $resource['updated_at']->toDateString(),
        ];
    }
}
