<?php

namespace Modules\Web\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class RootController extends WebBaseController
{

    function index()
    {
        return view('web::top');
    }

}