<?php

namespace App\Http\Controllers\Api;

use App\Database\ModulePayload;
use Validator;
use URL;
use App\Database\Hubs as Hubs;

class Upload extends \App\Http\Controllers\Controller
{
    /**
     * This function give the ability to for hubs to upload their data.
     *
     * Example data
     * sub_v1_1}SH-D-3!2!1459533399@24.2:12.5,1459533542@25.2,13.5,1459533642@27.2,13.5,1459533742@15.2,24.5}
     *
     * @return \Illuminate\Http\Response
     */
    public function upload($api)
    {
        // Sort data
        $data = \Input::get('data');
        $data = explode('}', $data);
        \Log::info($data);
        // Init uC formatter class
        $formatter = new \App\Services\DataFormatter();

        // Loop through all modules in data package
        foreach($data as $no => $modules){
            // 0 is the api and the last round is empty
            if($no == 0 or count($data) == $no + 1){
                $sub_api = $modules;
                continue;
            }

            // Check info block
           // if($no == 1) {
            $moduleSeperate = explode('!', $modules); // Separate the connection id with data

            // Check there is previous data
            $records = false;
            if ($sub_api and array_key_exists(0, $moduleSeperate) and array_key_exists(1, $moduleSeperate))
                $records = ModulePayload::where('sub_hub_api', $sub_api)->where('module_connections', $moduleSeperate[0])->where('module_type', $moduleSeperate[1])->first();

            // Perform some rough validation
            $validate = ['module_connection' => $moduleSeperate[0], 'module_type' => $moduleSeperate[1], 'sub_api' => $sub_api, 'data' => $moduleSeperate[2]];
            $validator = \Validator::make($validate, [
                'module_connection' => 'required',
                'module_type' => 'required|between:1,4',
                'sub_api' => 'required',
                'data' => 'required',
            ]);

            // Validation fails return 400 (error)
            if ($validator->fails()) {
                echo 200;
                exit(0);
            }
//            /}

            if($records){
                // Format the data
                $DBData = $formatter->format($moduleSeperate[1],  substr($moduleSeperate[2], 1), $records->payload);

                // Update an existing record
                $records->sub_hub_api = $sub_api;
                $records->module_connections = $moduleSeperate[0];
                $records->module_type = $moduleSeperate[1];
                $records->payload = $DBData;
                $records->save();
            }else{
                // Format the data
                $DBData = $formatter->format($moduleSeperate[1], substr($moduleSeperate[2], 1));

                // Create a new record
                $module_new = new ModulePayload;
                $module_new->sub_hub_api = $sub_api;
                $module_new->module_connections = $moduleSeperate[0];
                $module_new->module_type = $moduleSeperate[1];
                $module_new->payload = $DBData;
                $module_new->save();
            }
        }

        echo 200;
        exit(0);
    }

}
