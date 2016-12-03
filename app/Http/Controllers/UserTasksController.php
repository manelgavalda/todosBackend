<?php

namespace App\Http\Controllers;

use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserTasksController.
 */
class UserTasksController extends Controller
{
    /**
     * UserTasksController constructor.
     *
     * @param TaskTransformer $transformer
     */
    public function __construct(TaskTransformer $transformer)
    {
        parent::__construct($transformer);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $tasks = $user->tasks()->paginate(5);

        //mateix que abans pero nomes ab les tasques del usuari que ens han donat, i fer el mateix al show.

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
        $user = User::findOrFail($id);

        $user->tasks()->create([$request->all()]);

        return response([
            'created' => true,
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
        $task = User::findOrFail($id_user)->tasks[$id_task];

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
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param $id_user
     * @param $id_task
     */
    public function destroy($id_user, $id_task)
    {
        //dd($id_task);
        User::findOrFail($id_user)->tasks[$id_task]->delete();
    }
}
