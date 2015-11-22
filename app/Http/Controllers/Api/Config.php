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

        // Decode serial data
        $data = json_decode($hub->module_configuration);

        // Reduce data
        foreach($data->sub_hubs as $no => $values){
            unset($values->name);
            $data->sub_hubs[$values->api_key] = $values;
            unset($data->sub_hubs[$no]);
            foreach($data->modules as $mno => $mvalues){
                unset($mvalues->name);
                if($mvalues->sub_hub == $values->api_key){
                    unset($mvalues->sub_hub);
                    $data->sub_hubs[$values->api_key]->modules[] = $mvalues;
                }
            }
        }
        unset($data->modules);

        // Dirty but effective way of removing laravel headers
        echo json_encode($data);
        exit(0);
    }

}
