<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Response;

use App\Http\Requests;

class TasksController extends Controller
{
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

        $tasks=Task::paginate('15');

        return Response::json([
            'propietari' => 'manel',
            'total' => $tasks->total(),
            'perPage' => $tasks->perPage()
        ],404);
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
        Task::create($request->all
        ());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        try {
//            return Task::findOrFail($id);
//        } catch (\Exception $e ){
//            return Response::json([
//                "error" => "Hi ha hagut una excepció",
//                "codi" => 10
//
//            ],404);
//        }
        $task = Task::find($id);

        if ($task != null) {
            return $task;
        }
        return Response::json([
            'propietari' => 'manel',
            'total' => $tasks->total(),
            'perPage' => $tasks->perPage()
        ],404);
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
    public function destroy($id)
    {
        //
    }
}
