<script>
    $(document).ready(function () {
        $('#a-{{ $moduleId }}').highcharts({
            title: {
                text: 'Air Flow Readings',
                x: -20 //center
            },
            subtitle: {
                text: 'Air Flow Module',
                x: -20
            },
            yAxis: {
                title: {
                    text: 'Air Flow'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            credits: {
                enabled: false
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
                name: 'Air Flow',
                data: {!! $data[1] !!}
            }]
        });

        $('#{{ $api.$moduleId }}').removeClass('active');

        $("a[data-toggle=tab]").on('shown.bs.tab', function (e) {
            window.dispatchEvent(new Event('resize'));
        });

    });
</script>
