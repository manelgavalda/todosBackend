<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Auth;
use Gate;
use Illuminate\Http\Request;

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
        //        if (Gate::denies('show-tasks')) {
//
//            abort(403);
//        }
//        $user = Auth::user();
//        if($user->can('show', \App\Task::class)) {
//            //
//        }
        $this->authorize('show', \App\Task::class);

        $tasks = Task::paginate('15');

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Manel Gavaldà']);
    }

    public function create()
    {
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('user_id')) {
            $request->merge(['user_id' => Auth::id()]);
        }
        Task::create($request->all());

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task created',
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
     * @return \Response
     */
    public function update(Request $request, $id)
    {
        //Task::create([$request->all()]);

        Task::findOrFail($id)->update($request->all());

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task updated',
        ], 200);
    }

    /**
     * @param $id
     *
     * @return \Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Task deleted',
        ], 200);
    }
}
