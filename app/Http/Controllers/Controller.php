<?php

namespace App\Http\Controllers;

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
    protected function generatePaginatedResponse($resource, array $metadata = [])
    {

        $paginationData = $this->generatePaginationData($resource);

        $data = ['data' => $resource->toArray()
    ];
        return Response::json(array_merge($metadata, $paginationData, $data));
    }

    /**
     * @param $resource
     * @return array
     */
    protected function generatePaginationData($resource)
    {
        $paginationData = [
            'propietari' => 'manel',
            'total' => $resource->total(),
            'perPage' => $resource->perPage()
        ];
        return $paginationData;
    }
}
