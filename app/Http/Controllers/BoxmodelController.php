<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoxmodelController extends Controller
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('boxmodel',$data);
    }

}
