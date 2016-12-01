<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 4/11/16
 * Time: 15:57.
 */
namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\User;

//Usem el polimorfisme per evitar crear mètodes iguals.

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
