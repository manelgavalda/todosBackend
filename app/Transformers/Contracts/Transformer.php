<?php

namespace ManelGavalda\TodosBackend\Transformers\Contracts;

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
    /**
     * @param $resource
     *
     * @return mixed
     */
    public function transform($resource);

    /**
     * @param $resource
     *
     * @return mixed
     */
    public function transformCollection($resource);
}
