<?php

namespace App\Http\Controllers\Users;

use Validator;
use URL;


class User extends \App\Http\Controllers\Controller
{
    /**
     * Show the system users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.users.list');
    }


    /**
     * Add a user
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('app.users.add');
    }


    /**
     * Edit a user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('app.users.edit');
    }


    /**
     * Perform add a user
     *
     */
    public function addPost()
    {
    }


    /**
     * Perform edit a user
     *
     */
    public function editPost()
    {
    }
}
