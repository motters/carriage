<script>
    var lineChartData = [{
        label: "temperature",
        fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
        strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
        pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: {!! $data !!}
    }];


    $(document).ready(function () {
        new Chart(document.getElementById("a{{ $moduleId }}").getContext("2d")).Scatter(lineChartData, {
            responsive: true,
            showScale: true,
            scaleBeginAtZero: true,
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",

            bezierCurve: true,
            showTooltips: true,
            scaleShowHorizontalLines: true,
            scaleShowLabels: true,
            scaleType: "date",
            scaleLabel: "<%=value%> C"
        });
    });
</script>