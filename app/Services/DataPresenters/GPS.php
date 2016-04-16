<?php namespace App\Services\DataPresenters;


class GPS extends Presenter implements Presenters
{

    public function __construct($moduleId, $data)
    {
        $this->moduleId = $moduleId;
        $this->data = $data;
    }


    public function getModule()
    {
        return 'gps';
    }


    public function getModuleArray()
    {
        return ['moduleId'=> $this->moduleId, 'data' => $this->getModuleData()];
    }


    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * @todo check google maps api for graphing commands
     */
    public function getModuleData()
    {
        // Combine Data
        return [1=>json_encode($this->data,JSON_UNESCAPED_SLASHES)];
    }

}