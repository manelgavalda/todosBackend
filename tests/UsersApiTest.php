<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class UsersApiTest.
 */
class UsersApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var string
     */
    protected $uri = '/api/v1/user';

    /**
     * Default number of users created in database.
     */
    const DEFAULT_NUMBER_OF_USERS = 10;

    /**
     * Seed database with users.
     *
     * @param int $numberOfUsers
     */
    protected function seedDatabaseWithUsers($numberOfUsers = self::DEFAULT_NUMBER_OF_USERS)
    {
        factory(ManelGavalda\TodosBackend\User::class, $numberOfUsers)->create();
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(ManelGavalda\TodosBackend\User::class)->make(
        );
    }

    /**
     * Convert user to array.
     *
     * @param Model $user
     *
     * @return array
     */
    protected function convertUserToArray(Model $user)
    {
        // return $user->toArray();
        return [
            //'id'         => 1,//$user->id,
            'name'         => $user->name,
            'email'        => $user->email,
            'password'     => $user->password,
            'api_token'    => $user->api_token,
            //'created_at' => "2016-11-20",//$user->created_at,//->toDateString(),
            //'updated_at' => "2016-11-20"//$user->updated_at//->toDateString(),
        ];
    }

    /**
     * Create an persist user on database.
     *
     * @return mixed
     */
    protected function createAndPersistUser()
    {
        return factory(ManelGavalda\TodosBackend\User::class)->create();
    }

    /**
     * Create and act as a logged user on database.
     */
    protected function login()
    {
        $user = factory(ManelGavalda\TodosBackend\User::class)->create();
        $this->actingAs($user, 'api');
    }

    //TODO ADD TEST FOR AUTHENTICATION AND REFACTOR EXISTING TESTS (ho farem al MP9), no fer-ho. i els de test validation igual.

    /**
     * Get unauthenticated response on petition without valid user.
     */
    public function userNotAuthenticated()
    {
        $response = $this->json('GET', $this->uri)->getResult();
        $this->assertEquals(401, $response->status());
        //TODO: Test message error.
    }

    /**
     * Test Retrieve all users.
     */
    public function testRetrieveAllUsers()
    {

        //Seed database
        $this->seedDatabaseWithUsers();
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
                        'email',
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
                self::DEFAULT_NUMBER_OF_USERS,
                count($this->decodeResponseJson())
            );
    }

    /**
     * Test Retrieve one User.
     */
    public function testRetrieveOneUser()
    {
        //Create task in database
        $user = $this->createAndPersistUser();
        $this->login();
        $this->json('GET', $this->uri.'/'.$user->id)
            ->seeJsonStructure(
                ['name', 'email' /*,'created_at', 'updated_at'*/])
            ->seeJsonContains([
                'name'        => $user->name,
                'email'       => $user->email,
//                'created_at' => $task->created_at->toDateString(),
//                'updated_at' => $task->updated_at->toDateString(),
            ]);
    }

    /**
     * Test Create new user on database.
     */
    public function testCreateNewUser()
    {
        $user = $this->createUser();
        //login necessari
        $this->login();
        //dd($this->convertTaskToArray($task));
        $this->json('POST', $this->uri, $anuser = $this->convertUserToArray($user))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('users', $anuser);
    }

    /**
     * Test update existing user on database.
     */
    public function testUpdateExistingUser()
    {
        $user = $this->createAndPersistUser();
        $this->login();
        $user->done = !$user->done;
        $user->name = 'New user name';
        $this->json('PUT', $this->uri.'/'.$user->id, $anuser = $this->convertUserToArray($user))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('users', $anuser);
    }

    /**
     * Function check response if user not exists.
     *
     * @param $http_method
     */
    protected function userNotExists($http_method)
    {
        $this->login();
        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    /**
     * Test get not existing user.
     */
    public function testGetNotExistingUser()
    {
        $this->userNotExists('GET');
    }

    /**
     * Test update not existing user.
     */
    public function testUpdateNotExistingUser()
    {
        $this->userNotExists('PUT');
    }

    /**
     * Test delete not existing user.
     */
    public function testDeleteNotExistingUser()
    {
        $this->userNotExists('DELETE');
    }

    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //TODO
        //Ja el tinc al de retornar tots els users.
    }

    //TODO: Test validation

    /**
     * Test name is required and done is set to false and priority to 1.
     *
     * @group failing
     *
     * @return void
     */
    public function testNameIsRequiredAndDefaultValues()
    {
        //TODO
        $user = $this->createUser();

        $this->assertArrayHasKey('name', $user);
    }

    /**
     * Test email has to be an String.
     *
     * @group failing
     *
     * @return void
     */
    public function testEmailHaveToBeString()
    {
        //TODO
        $user = $this->createUser();

        $this->assertInternalType('string', $user['email']);
    }
}
