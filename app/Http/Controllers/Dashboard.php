<?php

namespace App\Http\Controllers;

use Validator;
use URL;


class Dashboard extends Controller
{
/**
     * Show the application dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.dashboard');
    }

}
