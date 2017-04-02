<?php

namespace ManelGavalda\TodosBackend\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class LayoutfloatController extends BaseController
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];

        return view('layoutfloat', $data);
    }
}
