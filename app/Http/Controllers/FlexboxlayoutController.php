<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlexboxlayoutController extends BaseController
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('Flexboxlayout',$data);
    }

}
