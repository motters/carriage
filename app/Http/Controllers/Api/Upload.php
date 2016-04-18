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
            $moduleSeperate = explode('!', $modules); // Separate the connection id with data

            if(array_key_exists(0, $moduleSeperate) and array_key_exists(1, $moduleSeperate) and array_key_exists(2, $moduleSeperate) and $sub_api)
            {
                // Perform some rough validation
                $validate = ['module_connection' => $moduleSeperate[0], 'module_type' => (int) $moduleSeperate[1], 'sub_api' => $sub_api, 'data' => $moduleSeperate[2]];
                //"/(SH-D-\\d)|(SH-SER-\\d*-\\d*)|(SH-12BIT-\\d*)|(SH-I2C-\\d*)/m"
                $validator = \Validator::make($validate, [
                    'module_connection' => 'required|between:5,12',
                    'module_type' => 'required|integer|between:2,5',
                    'sub_api' => 'required',
                    'data' => 'required',
                ]);

                // Custom regex to check module connections
               // $re = "/(SH-D-\\d)|(SH-SER-\\d*-\\d*)|(SH-12BIT-\\d*)|(SH-I2C-\\d*)/m";
                //preg_match_all($re, $moduleSeperate[0], $matches);

                // Validation fails return 400 (error)
                if ($validator->fails() /*and $matches*/){
                    \Log::info($modules);
                    \Log::info($moduleSeperate[1]);
                    \Log::info($validator->errors());
                }else{
                    // Check there is previous data
                    $records = false;
                    $records = ModulePayload::where('sub_hub_api', $sub_api)->where('module_connections', $moduleSeperate[0])->where('module_type', $moduleSeperate[1])->first();

                    if($records){
                        // Format the data
                        $DBData = $formatter->format($moduleSeperate[1],  $moduleSeperate[2], $records->payload);
                        \Log::info("Adding to DB");
                        \Log::info("=============");
                        \Log::info($DBData);
                        // Update an existing record
                        $records->sub_hub_api = $sub_api;
                        $records->module_connections = $moduleSeperate[0];
                        $records->module_type = $moduleSeperate[1];
                        $records->payload = $DBData;
                        $records->save();
                    }else{
                        // Format the data
                        $DBData = $formatter->format($moduleSeperate[1], $moduleSeperate[2]); //substr($moduleSeperate[2], 1)

                        \Log::info("Adding to DB New");
                        \Log::info("=============");
                        \Log::info($DBData);

                        // Create a new record
                        $module_new = new ModulePayload;
                        $module_new->sub_hub_api = $sub_api;
                        $module_new->module_connections = $moduleSeperate[0];
                        $module_new->module_type = $moduleSeperate[1];
                        $module_new->payload = $DBData;
                        $module_new->save();
                    }
                }
            }
        }

        echo 200;
        exit(0);
    }

}
