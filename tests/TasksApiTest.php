<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksApiTest extends TestCase
{
    use DatabaseMigrations;

    //Per no repetir la uri.
    private $uri = '/api/task';

    public function testExample()
    {
        //Comprovar si true és true.
        $this->assertTrue(true);
    }

    public function testShowAllTasks(){
        $task = factory(App\Task::class) ->create();
        $this->json('GET', $this->uri)
            //->dump()

            ->seeJsonContains([
                "name" => $task->name,
                "done" => $task->done,
                "priority" => $task->priority
            ])
            ->seeJson();
    }

    /**
     * @group failing
     */
    public function testShowOneTask(){
        $task = factory(App\Task::class) ->create();
        $this->json('GET', $this->uri . '/' . $task->id)
            //->dump();
                ->seeJsonStructure(
                    ["name","done","priority"]
            )
            ->seeJsonContains([
               "name" => $task->name,
               "done" => $task->done,
               "priority" => $task->priority
            ]);
    }
}
