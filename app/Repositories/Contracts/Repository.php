<?php

namespace App\Repositories\Contracts;

/**
 * Interface Repository.
 */
interface Repository
{
    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);

 //all

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*']);

    /**
     * @param array $request
     *
     * @return mixed
     */
    public function create(array $request);

    /**
     * @param array $request
     * @param $id
     *
     * @return mixed
     */
    public function update(array $request, $id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);
}
