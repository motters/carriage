<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsJIxEXTTgo8oGM9gLIPJ6fJfjRcpS6fo&libraries=geometry,places"></script>
<script>
    $(document).ready(function () {

        var MapPoints = '{!! $data[1] !!}';

        var MY_MAPTYPE_ID = 'custom_style';

        function initialize() {

            if (jQuery('#map').length > 0) {

                var locations = jQuery.parseJSON(MapPoints);

                window.map = new google.maps.Map(document.getElementById('map'), {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    zoom: 8,
                });

                var infowindow = new google.maps.InfoWindow();
                var flightPlanCoordinates = [];
                var bounds = new google.maps.LatLngBounds();

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                        map: map
                    });
                    flightPlanCoordinates.push(marker.getPosition());
                    bounds.extend(marker.position);

                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infowindow.setContent(locations[i]['title']);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }

                map.fitBounds(bounds);

                var flightPath = new google.maps.Polyline({
                    map: map,
                    path: flightPlanCoordinates,
                    strokeColor: "#FF0000",
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });

            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        $('#{{ $api.$moduleId }}').removeClass('active');

        $('a[href="#{{ $api.$moduleId }}"]').click(function() {
            setTimeout(function() { resizeMap(); }, 1000);
        });

        function resizeMap()
        {
            var locations = jQuery.parseJSON(MapPoints);
            var latLng = new google.maps.LatLng(locations[0].address.lat, locations[0].address.lng);
            google.maps.event.trigger(window.map,'resize');
            window.map.setZoom( 10 );
            map.setCenter(latLng);
        }
    });
</script>