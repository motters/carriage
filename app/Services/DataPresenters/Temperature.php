<?php namespace App\Services\DataPresenters;


class Temperature extends Presenter implements Presenters
{

    public function __construct($moduleId, $data)
    {
        $this->moduleId = $moduleId;
        $this->data = $data;
    }


    public function generateGraphHTML()
    {
        return '<canvas id="a'.$this->moduleId .'" height="247" width="494" style="width: 494px; height: 247px;"></canvas>';
    }


    public function generateGraphScript()
    {
        foreach($this->data as $no => $data){
            $temps[] = ['x'=>'new Date(\''.date('Y-m-d\TH:i:s',$no).'\')', 'y'=>(int)$data];
        }
        $dataEncoded = str_replace(['"new', ')"'],['new', ')'],json_encode($temps,JSON_UNESCAPED_SLASHES));

        return '
            <script>
            var lineChartData = [
				{
					label: "temperature",
					fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
                    strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                    pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
					data: '.$dataEncoded.'

				}];


                $(document).ready(function () {

                    new Chart(document.getElementById("a'.$this->moduleId .'").getContext("2d")).Scatter(lineChartData, {
                        responsive: true,
                        showScale: true,
                        scaleBeginAtZero: true,
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",

                        bezierCurve: true,
                        showTooltips: true,
                        scaleShowHorizontalLines: true,
                        scaleShowLabels: true,
                        scaleType: "date",
                        scaleLabel: "<%=value%> C"
                    });
                });
            </script>
        ';
    }
}