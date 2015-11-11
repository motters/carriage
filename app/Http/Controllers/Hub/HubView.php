<?php

namespace App\Http\Controllers\Hub;

use Validator;
use URL;
use App\Database\Hubs as Hubs;

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

}
