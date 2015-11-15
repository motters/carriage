<?php

namespace App\Http\Controllers\Api;

use Validator;
use URL;


class Config extends \App\Http\Controllers\Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show($api)
    {

        return response()->json(['name' => 'Abigail', 'state' => 'CA']);;
    }

}
