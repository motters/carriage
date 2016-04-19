<style>
    .embed-responsive-2by1 {
        min-height: 400px;
    }
</style>

<div>
    <h3>Download Data</h3>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/cache') }}" class="btn btn-success">Cache Recorded Data</a>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/download') }}" class="btn btn-success" target="_blank">Download Cached Data</a>

    <h3>X Axis Vibrations</h3>
    <div id="container-a-{{ $moduleId }}" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    <h3>Y Axis Vibrations</h3>
    <div id="container-b-{{ $moduleId }}" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    <h3>Z Axis Vibrations</h3>
    <div id="container-c-{{ $moduleId }}" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>