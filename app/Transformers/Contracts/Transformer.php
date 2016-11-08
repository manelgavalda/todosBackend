<?php

namespace App\Transformers\Contracts;

/**
 * Created by PhpStorm.
 * User: manel
 * Date: 4/11/16
 * Time: 15:44.
 */

//Amb la interfície podem pasar qualsevol tipus d'ojecte.
//Representa la carcasa de la informació.
interface Transformer
{
    public function transform($resource);
}
