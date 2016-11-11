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

class UserTransformer extends Transformer
{
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
