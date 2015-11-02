<?php

namespace App\Http\Controllers\Hub;

use Validator;
use URL;


class HubView extends \App\Http\Controllers\Controller
{
    /**
     * Show the carriage hubs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.hubs.view');
    }

}
