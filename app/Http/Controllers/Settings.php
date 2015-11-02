<?php

namespace App\Http\Controllers;

use Validator;
use URL;


class Settings extends Controller
{
    /**
     * Show the application settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.settings.list');
    }

    /**
     * Perform system settings update
     *
     */
    public function post()
    {
    }
}
