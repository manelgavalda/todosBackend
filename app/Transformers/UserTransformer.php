<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\User;

/**
 * Class UserTransformer.
 */
class UserTransformer extends Transformer
{
    /**
     * @param $resource
     *
     * @throws IncorrectModelException
     *
     * @return array
     */
    public function transform($resource)
    {
        if (!$resource instanceof User) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],
        ];
    }
}
