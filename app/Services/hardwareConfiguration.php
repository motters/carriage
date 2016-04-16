<?php namespace App\Services;

class HardwareConfiguration
{
    public $jsonConfig;

    public function __construct($jsonConfig)
    {
        $this->jsonConfig = json_decode($jsonConfig);
    }


    public function getSubHubs()
    {
        return  $this->jsonConfig->sub_hubs;
    }


    public function getModules($subHub=false)
    {
        if(!$subHub)
            return $this->jsonConfig->modules;

        $toReturn = [];
        foreach($this->jsonConfig->modules as $no){
            if($no->sub_hub == $subHub)
                $toReturn[] = $no;
        }

        return $toReturn;
    }

    public function isFirstModule($api, $name)
    {
        $modules = $this->getModules($api);
        if($modules{0}->name == $name)
            return true;

        return false;
    }


    public function dataGraph($moduleId, $hubApi)
    {
        $module = \App\Database\ModulePayload::where('module_connections', $moduleId)->where('sub_hub_api', $hubApi)->first();

        if($module)
        {
            switch($module->module_type)
            {
                case 2:
                    $temperature = new DataPresenters\Temperature($moduleId, json_decode($module->payload));
                    return $temperature;
                    break;
                case 3:
                    $vibration = new DataPresenters\Vibration($moduleId, json_decode($module->payload));
                    return $vibration;
                    break;
                case 4:
                    $airflow = new DataPresenters\AirFlow($moduleId, json_decode($module->payload));
                    return $airflow;
                    break;
                case 5:
                    $gps = new DataPresenters\GPS($moduleId, json_decode($module->payload));
                    return $gps;
                    break;
            }
        }

        return false;
    }

}