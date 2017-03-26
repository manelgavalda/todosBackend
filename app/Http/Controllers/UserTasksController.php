<?php

namespace ManelGavalda\TodosBackend\Http\Controllers;

use ManelGavalda\TodosBackend\Repositories\UserTasksRepository;
use ManelGavalda\TodosBackend\Transformers\TaskTransformer;
use Illuminate\Http\Request;

/**
 * Class UserTasksController.
 */
class UserTasksController extends Controller
{
    /**
     * @var UserTasksRepository
     */
    protected $repository;

    /**
     * UserTasksController constructor.
     *
     * @param TaskTransformer     $transformer
     * @param UserTasksRepository $repository
     */
    public function __construct(TaskTransformer $transformer, UserTasksRepository $repository)
    {
        parent::__construct($transformer);
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $tasks = $this->repository->paginate($id, 5);

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Manel Gavaldà']);
    }

    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request, $id)
    {
        $this->repository->create($request->all(), $id);

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task from user created',
        ], 200);
    }

    /**
     * @param $id_user
     * @param $id_task
     *
     * @return mixed
     */
    public function show($id_user, $id_task)
    {
        $task = $this->repository->findOrFail($id_user, $id_task);

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
     * @param $id_user
     * @param $id_task
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id_user, $id_task)
    {
        $this->repository->update($request->all(), $id_user, $id_task);

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task from user updated',
        ], 200);
    }

    /**
     * @param $id_user
     * @param $id_task
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id_user, $id_task)
    {
        $this->repository->delete($id_user, $id_task);

        return response([
            'error'     => false,
            'deleted'   => true,
            'message'   => 'Task from user deleted',
        ], 200);
    }
}
