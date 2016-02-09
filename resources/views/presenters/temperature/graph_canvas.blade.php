<style>
    .embed-responsive-2by1 {
        min-height: 500px;
    }
</style>

<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#temperature" aria-controls="temperature" role="tab" data-toggle="tab">Temperature</a></li>
        <li role="presentation"><a href="#humidity" aria-controls="humidity" role="tab" data-toggle="tab" data-need-render="true">Humidity</a></li>
        <li role="presentation"><a href="#archive" aria-controls="archive" role="tab" data-toggle="tab" data-need-render="true">Archive</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="temperature" style="margin-top: 25px;">
            <div class="embed-responsive embed-responsive-2by1">
                <canvas id="a{{ $moduleId }}" height="247" width="494" style="width: 494px; height: 247px;"></canvas>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane active" id="humidity" style="margin-top: 25px;">
            <div class="embed-responsive embed-responsive-2by1">
                <canvas id="b{{ $moduleId }}" height="247" width="494" style="width: 494px; height: 247px;"></canvas>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="archive" style="margin-top: 25px;">
            <button class="btn btn-success">Download Week Data</button>
            <button class="btn btn-success">Download Year Data</button>
            <button class="btn btn-success">Download All Data</button>
        </div>
    </div>

</div>