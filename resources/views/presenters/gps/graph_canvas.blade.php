<style>
    .embed-responsive-2by1 {
        min-height: 500px;
    }

    #map {
        height: 500px;
        width: 500px;
        margin: 0px;
        padding: 0px
    }
</style>

<div>
    <h3>Download Data</h3>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/cache') }}" class="btn btn-success">Cache Recorded Data</a>
    <a href="{{ URL::to('hubs/module/'.$api.'$'.$moduleId.'/download') }}" class="btn btn-success" target="_blank">Download Cached Data</a>

    <h3>GPS Location</h3>
    <div id="map" style="border: 2px solid #3872ac;"></div>
</div>