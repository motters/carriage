<?php namespace App\Services\DataPresenters;


class AirFlow extends Presenter implements Presenters
{

    public function __construct($moduleId, $data)
    {
        $this->moduleId = $moduleId;
        $this->data = $data;
    }


    public function getModule()
    {
        return 'airflow';
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
        // Graph one
        $g1=[];
        foreach($this->data as $no => $data){
            $g1[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>(int)$data->flow];
        }
        $graph1 = str_replace(['"new', ')"'],['new', ')'],json_encode($g1,JSON_UNESCAPED_SLASHES));

        // Combine Data
        $graphs[1] = $graph1;

        return $graphs;

    }

}