<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 4/11/16
 * Time: 15:57.
 */
namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;
use App\Transformers\Contracts\Transformer;

//Usem el polimorfisme per evitar crear mètodes iguals.

class TaskTransformer implements Transformer
{
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
