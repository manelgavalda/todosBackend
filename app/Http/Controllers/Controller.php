<?php

namespace App\Http\Controllers;

use App\Transformers\Contracts\Transformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     */
    protected $transformer;

    /**
     * Controller constructor.
     *
     * @param $transformer
     */
    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param $resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generatePaginatedResponse($resources, array $metadata = [])
    {
        $paginationData = $this->generatePaginationData($resources);

        $data = [
            'data' => $this->transformer->transformCollection($resources->items()),
    ];

        return Response::json(array_merge($metadata, $paginationData, $data), 200);
    }


    /**
     * @param $resources
     * @return array
     */
    protected function generatePaginationData($resources)
    {
        $paginationData = [
            'total'             => $resources->total(),
            'per_page'          => $resources->perPage(),
            'current_page'      => $resources->currentPage(),
            'last_page'         => $resources->lastPage(),
            'previous_page_url' => $resources->previousPageUrl(),
            'next_page_url'     => $resources->nextPageUrl(),
        ];

        return $paginationData;
    }

    /**
     * @param $resources
     * @return array
     */
    protected function transformCollection($resources)
    {
        //Collections: Laravel Collections

        return array_map(function ($resource) {
            return $this->transformer->transform($resource);
        }, $resources);
    }

    //Crear test users a partir de tasks . abstracte per cada usuari per injeccio de dependencies $this->transform. transform es un objecte que he injectat.
//    protected function transform($resource)
//    {
//        //dd($resource['created_at']);
//
//
////        $collection = collect($resource['created_at']);
////
////        $timezone=$collection->pull('timezone');
////
////        $collection->put('timezone',$timezone);
////        //$resource['created_at']=$collection;
////        //dd($collection);
////        dd($collection);
////        dump($resource['created_at']);
//
//        return [
//            'name' => $resource['name'],
//            'done' => (boolean)$resource['done'],
//            'priority' => (integer)$resource['priority'],
//            'created_at' => $resource['created_at']->toDateString(),
//            'updated_at' => $resource['updated_at']->toDateString()
//        ];
//    }

    /*
    protected function carbonObjectToArray($array){
        $collection = collect($array);

        $timezone=$collection->pull('timezone');

        $collection->put('timezone',$timezone);

        //dd($collection);

        return $collection;

    }
*/

    // TODO: Traure mètodes d'aquest controlador i ficar-lo a una nova classe Paginator(necessitarà implementar el transformer).
}
