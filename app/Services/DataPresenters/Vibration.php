<?php namespace App\Services\DataPresenters;


class Vibration extends Presenter implements Presenters
{

    public function __construct($moduleId, $data)
    {
        $this->moduleId = $moduleId;
        $this->data = $data;
    }


    public function getModule()
    {
        return 'vibration';
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
            $g1[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>str_replace('-','',$data->x)];
        }
        $graph1 = str_replace(['"new', ')"'],['new', ')'],json_encode($g1,JSON_UNESCAPED_SLASHES));

        $g2=[];
        foreach($this->data as $no => $data){
            $g2[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>str_replace('-','',$data->y)];
        }
        $graph2 = str_replace(['"new', ')"'],['new', ')'],json_encode($g2,JSON_UNESCAPED_SLASHES));

        $g3=[];
        foreach($this->data as $no => $data){
            $g3[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>str_replace('-','',$data->z)];
        }
        $graph3 = str_replace(['"new', ')"'],['new', ')'],json_encode($g3,JSON_UNESCAPED_SLASHES));

        // Combine Data
        $graphs[1] = $graph1;
        $graphs[2] = $graph2;
        $graphs[3] = $graph3;

        return $graphs;

    }

}