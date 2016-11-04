<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 4/11/16
 * Time: 15:57
 */

namespace App\Transformers;


use App\Exceptions\IncorrectModelException;
use App\Task;
use App\Transformers\Contracts\Transformer;

//Usem el polimorfisme per evitar crear mètodes iguals.

class UserTransformer implements Transformer
{

public function transform($resource)
{
    if(! $resource instanceof Task){
        throw new IncorrectModelException;
    }
        return [
            'name' => $resource['name'],
            'email' => $resource['email'],
        ];
}
}