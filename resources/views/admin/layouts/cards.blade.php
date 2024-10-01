@extends("admin/dashboard")
@section('content')
    <link rel="stylesheet" href="{{asset('css/cms/cards.css')}}">
    <link rel="stylesheet" href="{{ asset('css/cms/users.css') }}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="{{asset('css/cms/launch.css')}}">
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Questions', 'Type of Questions'],
                ['Open vragen',     20],
                ['Ja/Nee vragen',      22],
            ]);

            var options = {
                legend: 'none',
                pieSliceText: 'label',
                backgroundColor: 'transparent',
                pieStartAngle: 0,
                pieHole: 0.1,
                stroke: '#2e3440',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

    </script>
    <div class="container" id="dashContainer">
        <div class="locationBody" style="height: 100%; top: 1%">
            <!--- Card Left Top - Donut Chart GoogleChartAPI --->
            <div class="bodyControl" style="left: 0; top: 0">
                <div class="canvaGenderHead">
                    <i id="labelGen" class="fas fa-chart-pie" style="left: 2%; position:absolute; top: 1%; color: #2e3440; font-size: 2rem"></i>
                    <label id="labelGenLabel" for="labelGen" style="left: 8%; position:absolute; padding: 0; margin: 0; color: #2e3440; font-size: 1.8rem">Soorten vragen</label>
                </div>
                <div class="canvaGenderBody">
                    <div id="piechart" style="min-height: 100%; min-width: 100% "></div>
                </div>

            </div>
            <!--- Card Left Bottom - List Yes No Qs --->
            <div class="bodyControl" style="bottom: 0; left: 0">
                <div class="maxbtn">
                    <i id="maxbtnico" class="fas fa-compress"></i>
                </div>
                <table id="customers">
                    <tr class=""> <th>Vraag</th>
                        <th>Antwoord</th>
                        <th>Categorie</th>
                        <th>Level</th>
                    </tr>
                    @foreach($qs as $q)
                        <tr>
                            <td>{{$q->question}}</td>
                            <td>{{$q->answer}}</td>
                            <td>{{$q->category_id}}</td>
                            <td>{{$q->level_id}}</td>
                        </tr>

                    @endforeach
                </table>

            </div>
            <!--- Card Right Top - Controls --->
            <div class="bodyControl" style="right: 0; top: 0">

            </div>
            <!--- Card Right Bottom - List Qs --->
            <div class="bodyControl" style="right: 0; bottom: 0">
                <div class="maxbtn">
                    <i id="maxbtnico" class="fas fa-compress"></i>
                </div>
                <table id="customers">
                    <tr class="">
                        <th>Vraag</th>
                        <th>Antwoord (Ja/Nee)</th>
                        <th>Categorie</th>
                        <th>Level</th>
                    </tr>
                    @foreach($qsyn as $qy)
                        <tr>
                            <td>{{$qy->question}}</td>
                            <td>{{$qy->answer}}</td>
                            <td>{{$qy->category_id}}</td>
                            <td>{{$qy->level_id}}</td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>


@endsection
