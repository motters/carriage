<?php

namespace App\Http\Controllers\Api;

use Validator;
use URL;
use App\Database\Hubs as Hubs;

class Config extends \App\Http\Controllers\Controller
{
    /**
     * This function give the ability to configure the hubs and sub hubs
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
        $i = 1;
        $modules = [];
        foreach($data->sub_hubs as $no => $values){
            unset($values->name);
            unset($values->api_enc);
            unset($values->api_user);
            unset($data->sub_hubs[$no]);
            $data->sub_hubs[$i] = $values;
            $ii = -1;

            if($data->modules){
                foreach($data->modules as $mno => $mvalues){
                    $ii++;
                    if(property_exists($mvalues, 'sub_hub')){
                        if($mvalues->sub_hub == $values->api_key){
                            //unset($mvalues->sub_hub);
                            $data->sub_hubs[$i]->modules[$ii] = $mvalues;
                            unset($data->sub_hubs[$i]->modules[$ii]->sub_hub);
                            unset($data->sub_hubs[$i]->modules[$ii]->name);
                        }
                    }
                    $ii = 1;
                }
                $data->sub_hubs[$i]->modules = array_values($data->sub_hubs[$i]->modules);
            }
            $i++;
            $modules = array_merge($data->sub_hubs, $modules);
        }
        unset($data->modules);
        // Dirty but effective way of removing laravel headers and minimising json string length for uC
        echo str_replace(['api_key', 'api_pass', 'modules', 'module_connections', 'interval', 'module'], ['s', 'p', 'm', 'mc', 'in', 't'], json_encode($modules));
        exit(0);
    }

}
