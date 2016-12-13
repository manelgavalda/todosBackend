<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Task' => 'App\Policies\TaskPolicy',
        //TODO: 'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //S'executarà al arrancar el laravel.
        $this->defineGates();
    }

    private function defineGates()
    {
        Gate::define('impossible-gate',function () {
            return false; //No autoritzat.
        });

        Gate::define('easy-gate',function () {
            return true; //autoritzat.
        });

        Gate::define('update-task1', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('update-task2', function ($user, $task) {
            if ($user->isAdmin()) return true;
            return $user->id == $task->user_id;
        });
    }
}
