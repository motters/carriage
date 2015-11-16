<?php

namespace App\Http\Controllers\Api;

use Validator;
use URL;
use App\Database\Hubs as Hubs;

class Config extends \App\Http\Controllers\Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show($api)
    {
        // Grade data
        $hub = json_decode(Hubs::where('api_key', $api)->first());

        // Reduce data
        $data = json_decode($hub->module_configuration);

       foreach($data->sub_hubs as $no => $values){
            $temp = $data->sub_hubs;
            unset($temp[$no]->name);
        }
        foreach($data->modules as $no => $values){
            $temp = $data->modules;
            unset($temp[$no]->name);
        }


        // Dirty but effective way of removing laravel headers
        echo json_encode($data);
        exit(0);
    }

}
