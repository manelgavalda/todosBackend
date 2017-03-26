<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class UserTasksApiTest.
 */
class UserTasksApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var string
     */
    protected $uri = '/api/v1/user';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_TASKS = 10;
    /**
     * Default id of user in tests.
     */
    const DEFAULT_USER_ID = 1;

    /**
     * Seed the database with tasks with user id.
     *
     * @param int $numberOfTasks
     * @param int $id
     */
    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS, $id = self::DEFAULT_USER_ID)
    {
        factory(ManelGavalda\TodosBackend\Task::class, $numberOfTasks)->create(['user_id' => $id]);
    }

    /**
     * Create Task with user id.
     *
     * @param int $id
     *
     * @return mixed
     */
    protected function createTask($id = self::DEFAULT_USER_ID)
    {
        return factory(ManelGavalda\TodosBackend\Task::class)->make(
            [
                'user_id' => $id,
            ]
        );
    }

    /**
     * Create User.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(ManelGavalda\TodosBackend\Task::class)->make();
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
        return factory(ManelGavalda\TodosBackend\Task::class)->create(['user_id' => $id]);
    }

    /**
     * @return mixed
     */
    protected function createAndPersistUser()
    {
        return factory(ManelGavalda\TodosBackend\User::class)->create();
    }

    protected function login()
    {
        $user = factory(ManelGavalda\TodosBackend\User::class)->create();
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

    public function testDeleteExistingTaskFromUser()
    {
        $user = $this->createAndPersistUser();
        $task = $this->createAndPersistTask($user->id);

        $this->login();

        $this->json('DELETE', $this->uri.'/'.$user->id.'/task/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'deleted' => true,
            ])
            ->notSeeInDatabase('tasks', $atask);
    }

    /**
     * @param $http_method
     */
    protected function taskNotExistsFromUser($http_method)
    {
        $user = $this->createAndPersistUser();

        $this->login();
        $this->json($http_method, $this->uri.'/'.$user->id.'/task/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    public function testGetNotExistingTaskFromUser()
    {
        $this->taskNotExistsFromUser('GET');
    }

    /**
     * Test delete not existing task.
     *
     * @return void
     */
    public function testUpdateNotExistingTaskFromUser()
    {
        $this->taskNotExistsFromUser('PUT');
    }

    /**
     * Test delete not existing task.
     *
     * @return void
     */
    public function testDeleteNotExistingTaskFromUser()
    {
        $this->taskNotExistsFromUser('DELETE');
    }

    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //TODO
    }

    //TODO: Test validation

    /**
     * Test name is required and done is set to false and priority to 1.
     *
     * @return void
     */
    public function testNameIsRequiredAndDefaultValues()
    {
        //TODO
    }

    /**
     * Test priority has to be an integer.
     *
     * @return void
     */
    public function testPriorityHaveToBeAnInteger()
    {
        //TODO
    }

    /**
     * Test done has to be a boolean.
     *
     * @return void
     */
    public function testDoneHaveToBeBoolean()
    {
        //TODO
    }
}
