<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generatePaginatedResponse($resources, array $metadata = [])
    {

        $paginationData = $this->generatePaginationData($resources);

        $data = ['data' => $resources->items()
    ];
        return Response::json(array_merge($metadata, $paginationData, $data), 200);
    }

    /**
     * @param $resource
     * @return array
     */
    protected function generatePaginationData($resources)
    {
        $paginationData = [
            'propietari' => 'manel',
            'total' => $resources->total(),
            'perPage' => $resources->perPage(),
            'currentPage' => $resources->currentPage()
        ];
        return $paginationData;
    }

    protected function transformCollection($resources)
    {
        //Collections: Laravel Collections

        return array_map(function ($resource) {
            return $this->transform($resource);
        }, $resources->toArray());

    }

    //Crear test users a partir de tasks . abstracte per cada usuari per injeccio de dependencies $this->transform. transform es un objecte que he injectat.
    protected function transform($resource)
    {
        //retornem un simple.
        return [
            'name' => $resource['name'],
            'done' => (boolean)$resource['done'],
            'priority' => (integer)$resource['priority']
        ];
    }
}
