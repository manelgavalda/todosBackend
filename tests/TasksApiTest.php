<?php

use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TasksApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/task';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_TASKS = 10;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks to create
     */
    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS)
    {
        factory(App\Task::class, $numberOfTasks)->create(['user_id' => 1]);
    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask()
    {
        return factory(App\Task::class)->make(
            [
            'user_id' => 1,
            //'updated_at' => "2016-11-20",//$task->created_at->toDateString(),
            //'created-at' => "2016-11-20"//$task->updated_at->toDateString()
            ]
    );
    }

    /**
     * Convert task to array.
     *
     * @param $task
     *
     * @return array
     */
    protected function convertTaskToArray(Model $task)
    {
        // return $task->toArray();
        return [
            //'id'         => 1,//$task->id,
            'name'       => $task->name,
            'done'       => $task->done,
            'priority'   => $task->priority,
            'user_id'    => $task->user_id,
            //'created_at' => "2016-11-20",//$task->created_at,//->toDateString(),
            //'updated_at' => "2016-11-20"//$task->updated_at//->toDateString(),
        ];
    }

    /**
     * Create and persist task on database.
     *
     * @return mixed
     */
    protected function createAndPersistTask()
    {
        return factory(App\Task::class)->create(['user_id' => 1]);
    }

    protected function login()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user, 'api');
    }

    //TODO ADD TEST FOR AUTHENTICATION AND REFACTOR EXISTING TESTS (ho farem al MP9), no fer-ho. i els de test validation igual.
    public function userNotAuthenticated()
    {
        $response = $this->json('GET', $this->uri)->getResult();
        $this->assertEquals(401, $response->status());
        //TODO: Test message error.
    }

    //NOT AUTHORIZED: $this->assertEquals(301, $response->status());

    /**
     * Test Retrieve all tasks.
     *
     * @group failing
     *
     * @return void
     */

    //Ok

    public function testRetrieveAllTasks()
    {

        //Seed database
        $this->seedDatabaseWithTasks();
        $this->login();
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
//                        'created_at', // => [
//                            'date',
//                            'timezone_type',
//                            'timezone',
//                        ],
//                        'updated_at',  //=> [
//                            'date',
//                           'timezone_type',
//                            'timezone',
 //                       ]
                    ],
                ],
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

        $this->json('GET', $this->uri.'/'.$task->id)
            ->seeJsonStructure(
                ['name', 'done', 'priority', /*'created_at', 'updated_at'*/])
            ->seeJsonContains([
                'name'       => $task->name,
                'done'       => $task->done,
                'priority'   => $task->priority,
//                'created_at' => $task->created_at->toDateString(),
//                'updated_at' => $task->updated_at->toDateString(),
            ]);
    }

    public function testCreateNewTask()
    {
        $task = $this->createTask();
        //login necessari
        $this->login();
        //dd($this->convertTaskToArray($task));
        $this->json('POST', $this->uri, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

    /**
     * Test update existing task.
     *
     * @return void
     */

    public function testUpdateExistingTask()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $task->done = !$task->done;
        $task->name = 'New task name';
        $this->json('PUT', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }



}


