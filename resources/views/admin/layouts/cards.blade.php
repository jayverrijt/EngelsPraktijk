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
                ['Open vragen',     {{$ov}}],
                ['Ja/Nee vragen',      {{$jnv}}],
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
            <div class="bodyControl" style="right: 0; top: 0; background-color: transparent">
                <div class="bodyControl" style="width: 48%;height: 100%; left: 0; top: 0;">
                    <div class="cardAddHeader">
                        <p class="cardAddHeaderP">Open vragen toevoegen</p>
                    </div>
                    <div class="cardAddBody">
                        <form method="get" action="">
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qname">Naam van vraag</label>
                                <input type="text" id="qname" name="qname"/>
                            </div>
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qanswer">Antwoord</label>
                                <input type="text" id="qanswer" name="qanswer"/>
                            </div>
                            <div style="height: 5vh">
                            <label style="left: 5%; position:relative;" for="qlevel">Level</label>
                            <select name="qlevel" id="qlevel">
                                @foreach($levels as $lvl)
                                    <option value="{{$lvl->id}}">{{$lvl->level_name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <button class="cardBtnSubmit" type="submit"> Toevoegen</button>
                        </form>
                    </div>
                </div>
                <div class="bodyControl" style="width: 48%;height: 100%; right: 0; top: 0;">
                    <div class="cardAddHeader">
                        <p class="cardAddHeaderP">Ja/Nee vragen toevoegen</p>
                    </div>
                    <form method="get" action="">
                        <div class="cardAddBody">
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qname">Naam van vraag</label>
                                <input type="text" id="qname" name="qname"/>
                            </div>
                            <div style="height: 5vh">
                                <label style="left: 5%; position:relative;" for="qansweryn">Antwoord</label>
                                <select name="qansweryn" id="qansweryn">
                                    <option value="0">Ja/nee kiezen</option>
                                    <option value="1">Ja</option>
                                    <option value="2">Nee</option>
                                </select>
                            </div>
                            <div style="height: 5vh">
                                <label style="position:relative; left: 5%" for="qlevel">Level</label>
                                <select name="qlevel" id="qlevel">
                                    @foreach($levels as $lvl)
                                        <option value="{{$lvl->id}}">{{$lvl->level_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="cardBtnSubmit" type="submit"> Toevoegen</button>
                        </div>
                    </form>
                </div>
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
