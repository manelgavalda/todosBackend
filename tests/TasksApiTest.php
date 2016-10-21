<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksApiTest extends TestCase
{
    public function testExample()
    {
        //Comprovar si true és true.
        $this->assertTrue(true);
    }

    public function testShowAllTasks(){
        $this->json('GET','/api/task')
            //->dump();
            ->seeJson();
    }
}
