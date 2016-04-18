<script>
    $(document).ready(function () {

        $('#a-{{ $moduleId }}').highcharts({
            title: {
                text: 'Temperature Readings',
                x: -20 //center
            },
            subtitle: {
                text: 'Temperature and Humidity Module',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'Temperature'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            tooltip: {
                valueSuffix: 'G'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Temperature (C)',
                data: {!! $data[1] !!}
            }]
        });



        $('#b-{{ $moduleId }}').highcharts({
            title: {
                text: 'Humidity Readings',
                x: -20 //center
            },
            subtitle: {
                text: 'Temperature and Humidity Module',
                x: -20
            },
            credits: {
                enabled: false
            },
            yAxis: {
                title: {
                    text: 'Humidity'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            tooltip: {
                valueSuffix: 'G'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Humidity',
                data: {!! $data[2] !!}
            }]
        });

        $('#humidity').removeClass('active');

    });
</script>