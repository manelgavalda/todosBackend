<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTasksApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $uri = '/api/v1/user';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_TASKS = 10;
    const DEFAULT_USER_ID = 1;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks to create
     */
    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS,$id = self::DEFAULT_USER_ID)
    {
        factory(App\Task::class, $numberOfTasks)->create(['user_id' => $id]);
    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask($id = self::DEFAULT_USER_ID)
    {
        return factory(App\Task::class)->make(
            [
                'user_id' => $id
            ]
        );
    }

    protected function createUser()
    {
        return factory(App\Task::class)->make();
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
    protected function createAndPersistTask($id = self::DEFAULT_USER_ID)
    {
        return factory(App\Task::class)->create(['user_id' => $id]);
    }

    protected function createAndPersistUser()
    {
        return factory(App\User::class)->create();
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

    public function testRetrieveAllTasksFromUser()
    {

        $user = $this->createAndPersistUser();
        //Seed database
        $this->seedDatabaseWithTasks();
        $this->login();
        $this->json('GET', $this->uri.'/'.$user->id.'/task')
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

    public function testRetrieveOneTaskFromUser()
    {
        //Create task in database

        $user = $this->createAndPersistUser();
        $task = $this->createAndPersistTask();

        $this->login();

        $this->json('GET', $this->uri.'/'.$user->id.'/task/'.$task->id)
            ->seeJsonStructure(
                ['name', 'done', 'priority'/*'created_at', 'updated_at'*/])
            ->seeJsonContains([
                'name'       => $task->name,
                'done'       => $task->done,
                'priority'   => $task->priority,
//                'created_at' => $task->created_at->toDateString(),
//                'updated_at' => $task->updated_at->toDateString(),
            ]);
    }

    public function testCreateNewTaskFromUser()
    {
        $user = $this->createAndPersistUser();
        $task = $this->createTask($user->id);

        $this->login();
        $this->json('POST', $this->uri.'/'.$user->id.'/task', $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

    public function testUpdateExistingTaskFromUser()
    {
        $user = $this->createAndPersistUser();
        $task = $this->createAndPersistTask($user->id);
        $this->login();
        $task->done = !$task->done;
        $task->name = 'New task name';
        $this->json('PUT', $this->uri.'/'.$user->id.'/task/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

}
