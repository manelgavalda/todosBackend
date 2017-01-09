<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Transformers\TaskTransformer;
use Auth;
use Illuminate\Http\Request;

/**
 * Class TasksController.
 */
class TasksController extends Controller
{
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
        parent::__construct($transformer);
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = $this->repository->paginate(15);

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
        $this->validate($request, [
            'name' => 'required|min:4|max:255',
        ]);

        if (!$request->has('user_id')) {
            $request->merge(['user_id' => Auth::id()]);
        }
        $this->repository->create($request->all());

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
        $task = $this->repository->findOrFail($id);

        return $this->transformer->transform($task);
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
        $this->repository->update($request->all(), $id);

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
        //Task::findOrFail($id)->delete();
        $this->repository->delete($id);

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Task deleted',
        ], 200);
    }
}
//TODO: ficar el repository pattern. ficar testos validacio todos backend ara que tenim un exemple. Ficar les rules de cada. El delete no te request.
//TODO: enrollment: CRUD web, todos: CRUD Ajax.
