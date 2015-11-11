@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in" role="alert" style="">
        <strong>Success!</strong> {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-error alert-dismissible fade in" role="alert" style="">
        <strong>Woops!</strong> {{ Session::get('error') }}
    </div>
@endif