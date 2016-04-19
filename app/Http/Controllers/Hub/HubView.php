<?php

namespace App\Http\Controllers\Hub;

use Validator;
use URL;
use App\Database\Hubs as Hubs;
use App\Database\ModulePayload as ModulePayload;
use Storage;
use Redirect;

class HubView extends \App\Http\Controllers\Controller
{
    /**
     * Show the carriage hubs
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // Get hub config
        $hub = Hubs::find($id);

        // Init the hardware configuration services
        $hardware = new \App\Services\HardwareConfiguration($hub->module_configuration);

        // Return the view
        return view('app.hubs.view')->withHub($hub)->withHardware($hardware);
    }


    /**
     * Download carriage hub data
     *
     * @return \Illuminate\Http\Response
     */
    public function download($findme)
    {
        // Cache the data
        $exists = Storage::disk('local')->has($findme.'.txt');

        // Check if file exists
        if(!$exists){
            return Redirect::back()->withError('No data has been cached yet.');
        }

        // Download file
        return response()->download(storage_path('app/'.$findme.'.txt'));
    }


    /**
     * Cache Carriage hub data
     *
     * @return \Illuminate\Http\Response
     */
    public function cache($findme)
    {
        // Get the identification data
        $findmeExplode = explode('$', $findme);

        // Get payload data
        $module = ModulePayload::where('sub_hub_api', $findmeExplode[0])->where('module_connections', $findmeExplode[1])->first();

        // Cache the data
        $exists = Storage::disk('local')->has($findme.'.txt');

        // If the module payload field has no data then return with error
        if($module->payload == "{}")
            return Redirect::back()->withError('There is not data to cache.');

        // Does the file exists
        if(!$exists) {
            // Create the file and add the data
            Storage::disk('local')->put($findme . '.txt', $module->payload);
        }else{
            // Get file content
            $contents = Storage::disk('local')->get($findme.'.txt');

            // Generate new data
            $dataCached = json_decode($contents, true);
            $newData = json_decode($module->payload, true);
            $newData += $dataCached;

            // Add new data
            Storage::disk('local')->put($findme.'.txt', json_encode($newData));
        }

        // Delete data payload field in DB
        $module->payload = "{}";
        $module->save();

        // Redirect to view page with success
        return Redirect::back()->withSuccess('Data has been cached successful.');
    }

}
