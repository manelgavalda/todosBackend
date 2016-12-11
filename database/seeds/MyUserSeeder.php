<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder.
 */
class MyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            factory(User::class)->create([
                    "name" => "Manel Gavaldà Andreu",
                    "email" => "manelgavalda@iesebre.com",
                    "password" => env('MANEL_PASS', 'secret')]
            );
        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}
