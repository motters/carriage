<?php namespace App\Services\DataPresenters;


class Temperature extends Presenter implements Presenters
{

    public function __construct($moduleId, $data)
    {
        $this->moduleId = $moduleId;
        $this->data = $data;
    }


    public function getModule()
    {
        return 'temperature';
    }


    public function getModuleArray()
    {
        return ['moduleId'=> $this->moduleId, 'data' => $this->getModuleData()];
    }


    public function getModuleId()
    {
        return $this->moduleId;
    }


    public function getModuleData()
    {
        foreach($this->data as $no => $data){
            $temps[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>(int)$data];
        }
        return str_replace(['"new', ')"'],['new', ')'],json_encode($temps,JSON_UNESCAPED_SLASHES));

    }

}