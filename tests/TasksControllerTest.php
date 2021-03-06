<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;

class TasksControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function login()
    {
        $user = factory(ManelGavalda\TodosBackend\User::class)->create();
        $this->actingAs($user);

        return $user;
    }

    //Role not working
    public function testAuthorizedIndex()
    {
        $user = $this->login();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');

        $this->get('tasks');

        $this->assertResponseOk();
    }

    public function testNotAuthorized()
    {
        $this->login();

        $this->get('tasks');

        $this->assertResponseStatus(403);
    }
}
