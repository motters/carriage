<?php

namespace App\Http\Controllers\Api;

use Validator;
use URL;
use App\Database\Hubs as Hubs;

class Upload extends \App\Http\Controllers\Controller
{
    /**
     * This function give the ability to for hubs to upload their data.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload($api)
    {
        echo 200;
        exit(0);
    }

}
