<style>
    .embed-responsive-2by1 {
        min-height: 500px;
    }
</style>

<div>
    <h3>Download Data</h3>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/cache') }}" class="btn btn-success">Cache Recorded Data</a>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/download') }}" class="btn btn-success" target="_blank">Download Cached Data</a>

    <h3>Air Flow (Real Time)</h3>
    <div id="a-{{ $moduleId }}" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>