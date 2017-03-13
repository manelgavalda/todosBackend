<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class CsstablesController extends BaseController
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];

        return view('csstables', $data);
    }
}
