<?php

use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksApiTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/task/';

    /**
     * Default number of tasks created in database
     */
    const DEFAULT_NUMBER_OF_TASKS = 8;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks to create
     */

    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS)
    {
        return factory(App\Task::class,$numberOfTasks)->create();
    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask()
    {
        return factory(App\Task::class)->make();
    }

    /**
     * Convert task to array.
     *
     * @param $task
     * @return array
     */
    protected function convertTaskToArray(Model $task)
    {
       // return $task->toArray();
        return [
            "name" => $task->name,
            "done" => $task->done,
            "priority" => $task->priority,
            "created_at" => $task->created_at,
            "updated_at" => $task->updated_at
        ];
    }

    /**
     * Create and persist task on database.
     *
     * @return mixed
     */
    protected function createAndPersistTask()
    {
        return factory(App\Task::class)->create();
    }

    //TODO ADD TEST FOR AUTHENTICATION AND REFACTOR EXISTING TESTS
    //NOT AUTHORIZED: $this->assertEquals(301, $response->status());


    /**
     * Test Retrieve all tasks.
     *
     * @group failing
     * @return void
     */

    //Ok

    public function testRetrieveAllTasks()
    {
        //Seed database
        $this->seedDatabaseWithTasks();
        $this->json('GET', $this->uri)
            ->seeJsonStructure([
                'propietari',
                'total',
                'per_page',
                'current_page',
                'last_page',
                'previous_page_url',
                'next_page_url',
                'data' => [
                    '*' => [
                        'name',
                        'done',
                        'priority',
                        'created_at'=> [
                            'date',
                            'timezone_type',
                            'timezone',
                        ],
                        'updated_at' => [
                            'date',
                            'timezone_type',
                            'timezone',
                        ]
                    ]
                ]
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_TASKS,
                 count($this->decodeResponseJson())
            );

    }


    public function testRetrieveOneTask()
    {
        //Create task in database
        $task = $this->createAndPersistTask();
        $this->json('GET', $this->uri . $task->id)
            ->seeJsonStructure(
                ["name", "done", "priority", "created_at", "updated_at"])
//TODO  Needs Transformers to work: convert string to booelan and string to integer
            ->seeJsonContains([
                "name" => $task->name,
                "done" => $task->done,
                "priority" => $task->priority,
                "created_at" => $task->created_at,
                "updated_at" => $task->updated_at,
            ]);

    }


}
