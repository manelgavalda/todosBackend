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
    public function find($id, $columns = ['*']);
}
