<?php

namespace ManelGavalda\TodosBackend\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'ManelGavalda\TodosBackend\Events\SomeEvent' => [
            'ManelGavalda\TodosBackend\Listeners\EventListener',
        ],
      'ManelGavalda\TodosBackend\Events\NewRegisteredUserEvent' => [
        'ManelGavalda\TodosBackend\Listeners\GrantPermissionListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
