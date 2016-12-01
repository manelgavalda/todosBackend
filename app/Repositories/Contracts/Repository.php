<?php

namespace App\Repositories\Contracts;

/**
 * Created by PhpStorm.
 * User: manel
 * Date: 11/11/16
 * Time: 16:16.
 */
interface Repository
{
    //TODO: implementar l5-repository (si volem).

    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);
}
