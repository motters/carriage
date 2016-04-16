<style>
    .embed-responsive-2by1 {
        min-height: 400px;
    }
</style>

<div>
    <h3>Download Data</h3>
    <button class="btn btn-success">Download All Data</button>

    <h3>X Axis Vibrations</h3>
    <div class="embed-responsive embed-responsive-2by1">
        <canvas id="a{{ $moduleId }}" height="247" width="494" style="width: 494px; height: 247px;"></canvas>
    </div>

    <h3>Y Axis Vibrations</h3>
    <div class="embed-responsive embed-responsive-2by1">
        <canvas id="b{{ $moduleId }}" height="247" width="494" style="width: 494px; height: 247px;"></canvas>
    </div>

    <h3>Z Axis Vibrations</h3>
    <div class="embed-responsive embed-responsive-2by1">
        <canvas id="c{{ $moduleId }}" height="247" width="494" style="width: 494px; height: 247px;"></canvas>
    </div>
</div>