<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Created by PhpStorm.
 * User: manel
 * Date: 13/03/17
 * Time: 19:11
 */
class GrantPermissionListener
{

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }
  /**
   * Handle the event.
   *
   * @param  Registered $event
   * @return void
   */
  public function handle()
  {
    dd('hola');
  }

}