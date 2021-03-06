<?php

namespace ManelGavalda\TodosBackend\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Route;

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
        'ManelGavalda\TodosBackend\Task' => 'ManelGavalda\TodosBackend\Policies\TaskPolicy',
        //TODO: 'ManelGavalda\TodosBackend\User' => 'ManelGavalda\TodosBackend\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Route::group(['middleware' => 'cors'], function () {
            Passport::routes();
        });

        Passport::enableImplicitGrant();

        //S'executarà al arrancar el laravel.
        $this->defineGates();
    }

    private function defineGates()
    {
        Gate::define('impossible-gate', function () {
            return false; //No autoritzat.
        });

        Gate::define('easy-gate', function () {
            return true; //autoritzat.
        });

        Gate::define('update-task1', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('update-task2', function ($user, $task) {
            if ($user->isAdmin()) {
                return true;
            }

            return $user->id == $task->user_id;
        });
    }
}
