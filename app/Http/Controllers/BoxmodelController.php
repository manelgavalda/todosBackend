<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class BoxmodelController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];

        return view('boxmodel', $data);
    }
}
