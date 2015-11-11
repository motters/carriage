@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Administration / View Hub Data</h4>
            </div>
        </div>
        <div class="clearfix"></div>

        @foreach($hardware->getSubHubs() as $data)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $data->name }} <small>Data for {{ $data->name }}</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="col-xs-3">
                                <!-- required for floating -->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-left">
                                    @foreach($hardware->getModules($data->api_key) as $module)
                                        <li class="@if($hardware->isFirstModule($data->api_key, $module->name)) active @endif"><a href="#{{ $module->name }}" data-toggle="tab">{{ $module->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-xs-9">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @foreach($hardware->getModules($data->api_key) as $module)
                                        <div class="tab-pane @if($hardware->isFirstModule($data->api_key, $module->name)) active @endif" id="{{ $module->name }}">
                                            {{ $module->name }}
                                            {{ $hardware->dataGraph($module->module_id, $data->api_key) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop

@section('js_bottom')
    <script>
        //<div class="tab-pane active" id="home"><canvas id="canvas_line" height="247" width="494" style="width: 494px; height: 247px;"></canvas></div>
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
                    strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                    pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [31, 74, 6, 39, 20, 85, 7]
                },
            ]

        }

        $(document).ready(function () {
            new Chart(document.getElementById("canvas_line").getContext("2d")).Line(lineChartData, {
                responsive: true,
                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
            });
        });
    </script>
@stop
