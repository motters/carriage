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
        // Graph one
        foreach($this->data as $no => $data){
            $g1[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>(int)$data];
        }
        $graph1 = str_replace(['"new', ')"'],['new', ')'],json_encode($g1,JSON_UNESCAPED_SLASHES));

        // Graph two
        foreach($this->data as $no => $data){
            $g2[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>(int)$data + 20];
        }
        $graph2 = str_replace(['"new', ')"'],['new', ')'],json_encode($g2,JSON_UNESCAPED_SLASHES));

        // Combine Data
        $graphs[1] = $graph1;
        $graphs[2] = $graph2;

        return $graphs;

    }

}