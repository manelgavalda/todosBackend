<?php

namespace App\Http\Controllers;

use App\Task;
use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller as BaseController;


class UserTasksController extends Controller
{
    public function __construct(TaskTransformer $transformer)
    {
        parent::__construct($transformer);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $user = User::findOrFail($id);
        $tasks=$user->tasks()->paginate(5);

        //mateix que abans pero nomes ab les tasques del usuari que ens han donat, i fer el mateix al show.


        return $this->generatePaginatedResponse($tasks, ["propietari" => "Manel Gavaldà"]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($id);

        $user->tasks()->create([$request->all
        ()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_user,$id_task)
    {
            $task = User::findOrFail($id_user)->tasks[$id_task];
            return $this->transformer->transform($task);
    }

            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_user,$id_task)
    {
        //$task = User::findOrFail($id_user)->tasks[$id_task];
        //dd($task);
        //Task::destroy($task);
    }
}
