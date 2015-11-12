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
                                        <li class="@if($hardware->isFirstModule($data->api_key, $module->name)) active @endif"><a href="#{{ $module->module_id }}" data-toggle="tab">{{ $module->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-xs-9">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    @foreach($hardware->getModules($data->api_key) as $module)
                                        <div class="tab-pane @if($hardware->isFirstModule($data->api_key, $module->name)) active @endif" id="{{ $module->module_id }}">
                                            @if(!$hardware->dataGraph($module->module_id, $data->api_key))
                                                <div class="alert alert-error alert-dismissible fade in" role="alert" style="">
                                                    Sorry there seems to be no data for this module yet.
                                                </div>
                                            @else
                                                {!! $hardware->dataGraph($module->module_id, $data->api_key)->generateGraphHTML() !!}
                                            @endif
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
    <script type="text/javascript" src="{{ URL::to('vendor/manchesterTemplate/js/chartjs/chart.scatter.js') }}"></script>
    @foreach($hardware->getModules($data->api_key) as $module)
        @if($hardware->dataGraph($module->module_id, $data->api_key))
            {!! $hardware->dataGraph($module->module_id, $data->api_key)->generateGraphScript() !!}
        @endif
    @endforeach
@stop
