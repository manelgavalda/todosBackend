<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use Auth;

/**
 * Class TasksController.
 */
class TasksController extends Controller
{
    //mirar enrollmenttest controller
    //Més avant ja veurem si el pujem al pare.

    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * TasksController constructor.
     *
     * @param TaskTransformer $transformer
     * @param TaskRepository  $repository
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository) //pasar paginator (TaskTransformer $transformer,Paginator $paginator).
    {
        //$this-> paginator= new Paginator($transformer)
        //pasar el transformer al apginator
        parent::__construct($transformer);
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //provem alert
        //        $tasks = Task::all();
//        return Response::json([
//            'data' => $tasks->toArray()
//        ],200);

        //return Task::paginate(Request::input(per_page));
    //dd($this->transformCollection(Task::all()));

        $tasks = Task::paginate('15');

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Manel Gavaldà']);
    }


    public function create()
    {
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function store(Request $request)
    {
        if(!$request ->has('user_id'))
        {
            $request->merge(['user_id' => Auth::id()]);
        }
        Task::create([$request->all()]);

        return response([
            'created' => true,
        ], 200);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $task = $this->repository->find($id);

        return $this->transformer->transform($task);
/*
        if ($resource != null) {
            return $resource;
        }
        return $this->generatePaginatedResponse($resource);
        */
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function update(Request $request)
    {
        Task::create([$request->all()]);

        return response([
            'created' => true,
        ], 200);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Task::destroy($id);
    }
}
