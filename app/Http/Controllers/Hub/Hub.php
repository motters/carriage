<?php

namespace App\Http\Controllers\Hub;

use Illuminate\Support\Facades\Redirect;
use Validator;
use URL;
use Input;
use App\Database\Hubs as Hubs;


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
    public function edit($id)
    {
        return view('app.hubs.edit')->withId(e($id))->withHub(Hubs::find($id));
    }


    /**
     * Delete a carriage hub
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $hub = Hubs::find($id);
        if($hub->delete())
            return Redirect::to('hubs')->withSuccess('Deleted carriage successfully from the system');

        return Redirect::to('hubs')->withError('Could not delete carriage from the system, please try again');
    }


    /**
     * Perform a add carriage hub
     *
     * @todo VALIDATION!
     */
    public function create()
    {
        // Create module config json serial variable
        $sub = Input::get('sub_hubs');
        $mods = Input::get('modules');
        $moduleConfig = json_encode([
            'sub_hubs' => $sub,
            'modules' => $mods
        ]);

        // Create data array for ORM
        $data = [
            'carriage_name' => Input::get('carriage_name'),
            'client_id' => Input::get('carriage_client'),
            'desc' => Input::get('carriage_desc'),
            'api_key' => Input::get('hub_api_key'),
            'api_enc' => Input::get('hub_api_enc'),
            'api_user' => Input::get('hub_api_user'),
            'api_pass' => Input::get('hub_api_pass'),
            'module_configuration' => $moduleConfig
        ];

        // Create the hub
        if(Hubs::create($data))
        {
            // Return the new ID
            return Hubs::all()->last()->id;
        }

        // Return new csrf token for from
        return csrf_token();
    }


    /**
     * Perform an update on the carriage general settings
     *
     *  @todo VALIDATION!
     */
    public function updateGeneralSettings($id)
    {
        // Update the hub
        $hub =  Hubs::find($id);
        if($hub)
        {
            // Update
            $hub->carriage_name = Input::get('carriage_name');
            $hub->client_id = Input::get('client');
            $hub->desc = Input::get('carriage_desc');
            $hub->save();
            // Return the new ID
            return Redirect::to('hubs/'.$id.'/edit')->withSuccess('Updated settings successfully in the system');
        }

        // Return new csrf token for from
        return Redirect::to('hubs/'.$id.'/edit')->withError('Could not update settings, please try again');
    }


    /**
     * Perform an update on the carriage api settings
     *
     *  @todo VALIDATION!
     */
    public function updateAPISettings($id)
    {
        // Update the hub
        $hub =  Hubs::find($id);
        if($hub)
        {
            // Update
            $hub->api_key = Input::get('hub_api_key');
            $hub->api_enc = Input::get('hub_api_enc');
            $hub->api_user = Input::get('hub_api_user');
            $hub->api_pass = Input::get('hub_api_pass');
            $hub->save();
            // Return the new ID
            return Redirect::to('hubs/'.$id.'/edit')->withSuccess('Updated settings successfully in the system');
        }

        // Return new csrf token for from
        return Redirect::to('hubs/'.$id.'/edit')->withError('Could not update settings, please try again');
    }


    /**
     * Perform an update on the carriage module / sub hub setup
     *
     *  @todo VALIDATION!
     */
    public function updateHardwareSetup($id)
    {
        // Create module config json serial variable
        $moduleConfig = json_encode([
            'sub_hubs' => Input::get('sub_hubs'),
            'modules' => Input::get('modules')
        ]);

        // Update the hub
        $hub =  Hubs::find($id);
        if($hub)
        {
            // Update
            $hub->module_configuration = $moduleConfig;
            $hub->save();
            // Return the new ID
            return $id;
        }

        // Return new csrf token for from
        return csrf_token();
    }
}
