@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Administration / Edit Hub</h4>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>General Settings</h2>
                        <div class="clearfix"></div>
                    </div>
                    {!! Form::open(['url'=>URL::to('hubs/'.e($id).'/general'), 'method'=>'put', 'class'=>'form-horizontal form-label-left']) !!}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="carriage_name">Carriage Name<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::text('carriage_name', $hub->carriage_name,['required' => 'true', 'placeholder' => 'Carriage Name', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client" class="control-label col-md-3 col-sm-3 col-xs-12">Client <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::select('client', App\Database\Clients::lists('client', 'id'), $hub->client_id,['required' => 'true', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::textarea('carriage_desc', $hub->desc,['required' => 'true', 'placeholder' => 'Carriage Description', 'class' => 'form-control col-md-7 col-xs-12', 'rows'=>'4']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <input type="submit" value="Update" class="btn btn-success pull-right"/>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hub API settings</h2>
                        <div class="clearfix"></div>
                    </div>
                    {!! Form::open(['url'=>URL::to('hubs/'.e($id).'/api'), 'method'=>'put', 'class'=>'form-horizontal form-label-left']) !!}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="carriage_name">Carriage Hub API Key<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::text('hub_api_key', $hub->api_key,['required' => 'true', 'placeholder' => 'Carriage Hub API Key', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client" class="control-label col-md-3 col-sm-3 col-xs-12">Carriage Hub Encryption Key <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::text('hub_api_enc', $hub->api_enc,['required' => 'true', 'placeholder' => 'Carriage Hub Encryption Key', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Carriage Hub API Username <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::text('hub_api_user', $hub->api_user,['required' => 'true', 'placeholder' => 'Carriage Hub API Username', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Carriage Hub API Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                {!! Form::password('hub_api_pass',['required' => 'true', 'placeholder' => 'Carriage Hub API Password', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <input type="submit" value="Update" class="btn btn-success pull-right"/>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sub Hub / Module Configuration</h2>
                        <div class="clearfix"></div>
                    </div>


                    <div class="alert alert-danger alert-dismissible fade in" role="alert" id="step-three-valid-failed" style="display: none;">
                        <strong>Woops!</strong> Please double check the below fields and try again!
                    </div>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert" id="sub-module-failed" style="display: none;">
                        <strong>Woops!</strong> There must be at least one sub hub.
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="well" style="border-radius: 0px;">
                                <div id="sub-hubs"></div>
                                <h4>Add Wireless Sub Hubs</h4>
                                <div class="add-sub-hub form-horizontal form-label-left">
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert" id="sub-hub-val-failed" style="display: none;">
                                        <strong>Woops!</strong> Please ensure that all the fields are fill in below and are correct!
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriage_name">Sub Ref Name<span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('sub_name', null,['required' => 'true', 'placeholder' => 'Sub Hub Reference', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriage_name">Sub API Key<span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('sub_api_key', null,['required' => 'true', 'placeholder' => 'Sub Hub API Key', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="client" class="control-label col-md-4 col-sm-4 col-xs-12">Sub Encryption Key <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('sub_api_enc', null,['required' => 'true', 'placeholder' => 'Sub Hub Encryption Key', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Sub API Username <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('sub_api_user', null,['required' => 'true', 'placeholder' => 'Sub Hub API Username', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Sub API Password <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::password('sub_api_pass',['required' => 'true', 'placeholder' => 'Sub Hub API Password', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="add-sub-hub" class="btn btn-primary" style="float:right;">Add Sub Hub</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="well" style="border-radius: 0px;">
                                <div id="sub-hub-modules"></div>
                                <h4>Add Modules to Sub Hubs</h4>
                                <div class="add-sub-hub-module form-horizontal form-label-left">
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert" id="module-val-failed" style="display: none;">
                                        <strong>Woops!</strong> Please ensure that all the fields are fill in below and are correct!
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriage_name">Sub Ref Name<span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('module_name', null,['required' => 'true', 'placeholder' => 'Module Reference', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carriage_name">Module<span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::select('modules', App\Database\Settings::where('settings_type', 2)->lists('setting', 'id'), null,['required' => 'true', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="client" class="control-label col-md-4 col-sm-4 col-xs-12">Sub Hub <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::select('sub_hubs', [''=>'Please Select'], null,['required' => 'true', 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'sub_hubs']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Record interval <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            {!! Form::text('module_interval', null,['required' => 'true', 'placeholder' => 'Take a reading every X seconds', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="add-module" class="btn btn-primary" style="float:right;">Add Module</button>
                                    </div>
                                    <br/>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{ $hub->module_configuration }}" id="hardware_config"/>
                        <input type="hidden" value="{{ $id }}" id="id"/>
                        <input type="hidden" value="{{ \App\Database\Settings::where('settings_type', 2)->select(['id','setting'])->get()->toJson() }}" id="module_list"/>
                        <input type="submit" value="Update" class="btn btn-success" id="update_hardware"/>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js_bottom')
    <script type="text/javascript" src="{{ URL::to('vendor/manchesterTemplate/js/wizard/jquery.smartWizard.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/edit_hub.js') }}"></script>
@stop