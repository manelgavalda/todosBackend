<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

//Usem el polimorfisme per evitar crear mètodes iguals.

/**
 * Class TaskTransformer
 * @package App\Transformers
 */
class TaskTransformer extends Transformer
{
    /**
     *
     * Transform a task
     *
     * @param $resource
     * @return array
     * @throws IncorrectModelException
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
