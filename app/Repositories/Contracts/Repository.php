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
    public function findOrFail($id, $columns = ['*']); //all

    public function paginate($perPage = 15, $columns= array('*'));

    public function create(array $request);

    public function update(array $request, $id);

    public function delete($id);
}
