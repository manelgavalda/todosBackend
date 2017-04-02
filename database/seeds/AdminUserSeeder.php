<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class AdminUserSeeder.
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $user = factory(ManelGavalda\TodosBackend\User::class)->create([
                    'name'     => 'manel',
                    'email'    => 'manelgavalda@iesebre.com',
                    'password' => bcrypt(env('ADMIN_PWD', '123456')), ]
            );
            //Admin role for my user.
            Role::create(['name' => 'admin']);
            $user->assignRole('admin');
        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}
