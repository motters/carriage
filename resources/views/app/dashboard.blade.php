@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Administration / {{ $page }}</h4>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                    <div class="x_title">
                        <h2>{{ $page }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    Content Baby
                </div>
            </div>
        </div>
    </div>

@stop
