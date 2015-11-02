<?php

namespace App\Http\Controllers\Hub;

use Validator;
use URL;


class Hub extends \App\Http\Controllers\Controller
{
    /**
     * Show the carriage hubs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.hubs.list');
    }


    /**
     * Add a carriage hub
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('app.hubs.add');
    }


    /**
     * Edit a carriage hub
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('app.hubs.edit');
    }


    /**
     * Perform a add carriage hub
     *
     */
    public function addPost()
    {
    }


    /**
     * Perform a edit on a carriage hub
     *
     */
    public function editPost()
    {
    }
}
