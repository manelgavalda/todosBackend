<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
        'App\Model' => 'App\Policies\ModelPolicy',
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
            return false; //No autoritzat.
        });

        Gate::define('update-task', function ($user, $task) {
            return $user->id == $task->user_id;
        });

        Gate::define('update-task1', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('update-task2', function ($user, $task) {
            if ($user->isAdmin()) return true;
            return $user->id == $task->user_id;
        });

        Gate::define('show-tasks', function ($user) {
            return false;
        });

        Gate::define('update-task3', function ($user, $task) {
            if ($user->isAdmin()) return true;
            if ($user->hasRole('editor')) return true;
            return $user->id == $task->user_id;
        });
    }
}
