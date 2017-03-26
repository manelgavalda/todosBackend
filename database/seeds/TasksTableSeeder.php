<?php

use Illuminate\Database\Seeder;

/**
 * Class TasksTableSeeder.
 */
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ManelGavalda\TodosBackend\User::class, 20)->create()->each(function ($user) {
            $user->tasks()->saveMany(
                factory(ManelGavalda\TodosBackend\Task::class, 5)->create(['user_id' => $user->id]));
//                return response()->json([
//                    'created' => true
//                ]);
        });
    }
}
