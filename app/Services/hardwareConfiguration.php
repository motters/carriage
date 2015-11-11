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
        $module = \App\Database\ModulePayload::where('module_id', $moduleId)->where('sub_hub_api', $hubApi)->first();

        if($module)
        {
            return 'data baby';
        }

        return false;
    }

}