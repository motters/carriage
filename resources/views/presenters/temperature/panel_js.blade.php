<script>
    $(document).ready(function () {
        var graph1 = [{
            label: "temperature",
            fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
            strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
            pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: {!! $data[1] !!}
        }];

        new Chart(document.getElementById("a{{ $moduleId }}").getContext("2d")).Scatter(graph1, {
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






        var graph2 = [{
            label: "temperature",
            fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
            strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
            pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: {!! $data[2] !!}
            }];

        var graphint = new Chart($("#b{{ $moduleId }}").get(0).getContext("2d")).Scatter(graph2, {
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

        $('#humidity').removeClass('active');
        $('a[href=#humidity]').click(function(){
            $(window).resize();
        });






    });
</script>