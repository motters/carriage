@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Administration / Hubs / Add Hub</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Hub <small>Follow the wizard to add a new hub</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <!-- Smart Wizard -->
                        <p>Please follow the wizard step by step to add a new carriage hub.</p>
                        <div id="wizard" class="form_wizard wizard_horizontal">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                                    <span class="step_descr">
                                            Step 1<br />
                                            <small>Administration Details</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                                    <span class="step_descr">
                                            Step 2<br />
                                            <small>API Details</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                                    <span class="step_descr">
                                            Step 3<br />
                                            <small>Module Settings</small>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="step-1">
                                <form class="form-horizontal form-label-left">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="carriage_name">Carriage Name<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('carriage_name', null,['required' => 'true', 'placeholder' => 'Carriage Name', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="client" class="control-label col-md-3 col-sm-3 col-xs-12">Client <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::select('client', App\Database\Clients::lists('client', 'id'), null,['required' => 'true', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::textarea('carriage_desc', null,['required' => 'true', 'placeholder' => 'Carriage Description', 'class' => 'form-control col-md-7 col-xs-12']) !!}
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div id="step-2">
                                <h2 class="StepTitle">Step 2 Content</h2>
                                <p>
                                    do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                            <div id="step-3">
                                <h2 class="StepTitle">Step 3 Content</h2>
                                <p>
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
                        <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop


@section('js_bottom')
        <!-- form wizard -->
    <script type="text/javascript" src="{{ URL::to('vendor/manchesterTemplate/js/wizard/jquery.smartWizard.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Smart Wizard
            $('#wizard').smartWizard();
            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });
    </script>
@stop
