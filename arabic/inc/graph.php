<div class="w-100 mt-3">
<canvas id="graphCanvas"></canvas>
</div>

<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].date);
                        marks.push(data[i].times);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Views',
                                backgroundColor: '#28a745',
                                borderColor: '#1e7b34',
                                hoverBackgroundColor: '#46d267',
                                hoverBorderColor: 'lightblue',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>
