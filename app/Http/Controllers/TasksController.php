<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use Response;

class TasksController extends Controller
{
    //Més avant ja veurem si el pujem al pare.
    protected $repository;

    /**
     * TasksController constructor.
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository) //pasar paginator (TaskTransformer $transformer,Paginator $paginator).
    {
        //$this-> paginator= new Paginator($transformer)
        //pasar el transformer al apginator
        parent::__construct($transformer);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        $tasks = Task::all();
//        return Response::json([
//            'data' => $tasks->toArray()
//        ],200);

        //return Task::paginate(Request::input(per_page));
    //dd($this->transformCollection(Task::all()));

        $tasks = Task::paginate('15');

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Manel Gavaldà']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create([$request->all()]);

        return response([
            'created' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Task::create([$request->all()]);
        return response([
            'created' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
    }
}
