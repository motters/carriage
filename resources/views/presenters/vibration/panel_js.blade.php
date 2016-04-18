<script>
    $(document).ready(function () {

        $('#container-a-{{ $moduleId }}').highcharts({
            title: {
                text: 'X Axis Vibrations',
                x: -20 //center
            },
            subtitle: {
                text: 'Accelerometer Module',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'G Force'
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
                name: 'Force (G X 10-3)',
                data: {!! $data[1] !!}
            }]
        });


        $('#container-b-{{ $moduleId }}').highcharts({
            title: {
                text: 'Y Axis Vibrations',
                x: -20 //center
            },
            subtitle: {
                text: 'Accelerometer Module',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'G Force'
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
            credits: {
                enabled: false
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Force (G X 10-3)',
                data: {!! $data[2] !!}
            }]
        });



        $('#container-c-{{ $moduleId }}').highcharts({
            title: {
                text: 'Z Axis Vibrations',
                x: -20 //center
            },
            subtitle: {
                text: 'Accelerometer Module',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'G Force'
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
                name: 'Force (G X 10-3)',
                data: {!! $data[3] !!}
            }]
        });

        $('#{{ $api.$moduleId }}').removeClass('active');

        $("a[data-toggle=tab]").on('shown.bs.tab', function (e) {
            window.dispatchEvent(new Event('resize'));
        });

    });
</script>