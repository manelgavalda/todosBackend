<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersApiTest extends TestCase
{

    protected $uri = '/api/v1/user';


    const DEFAULT_NUMBER_OF_USERS = 10;

    protected function seedDatabaseWithUsers($numberOfUsers = self::DEFAULT_NUMBER_OF_USERS)
    {
        factory(App\User::class, $numberOfUsers)->create();
    }

    protected function createUser()
    {
        return factory(App\User::class)->make(
        );
    }

    protected function convertUserToArray(Model $user)
    {
        // return $user->toArray();
        return [
            //'id'         => 1,//$user->id,
            'name'       => $user->name,
            'email'       => $user->email,
            'password'   => $user->password,
            'api_token'    => $user->api_token,
            //'created_at' => "2016-11-20",//$user->created_at,//->toDateString(),
            //'updated_at' => "2016-11-20"//$user->updated_at//->toDateString(),
        ];
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

}

