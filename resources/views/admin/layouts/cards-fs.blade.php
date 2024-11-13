@extends("admin/dashboard")
@section('content')
    <link rel="stylesheet" href="{{asset('css/cms/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/cms/popups.css')}}">
    <link rel="stylesheet" href="{{ asset('css/cms/users.css') }}">
    <link rel="stylesheet" href="{{asset('css/cms/launch.css')}}">
    <div class="container popup-container" style="display: none" id="popupContainer">
        @yield('popupcontent')
    </div>
    <div class="container contentcardsfs">
        <div class="container cardsfshead">
            <p style="font-size: 1rem; position:relative; left: 2%; color: #2e3440; font-weight: 600; width: 50%">
                @if($type == 1) Open Vragen - Fullscreen @elseif ($type == 2) Ja/Nee vragen - Fullscreen @endif
            </p>
            <a href="{{route('admin.cards')}}"><i style="right: 1%; position:absolute; top: 25%; font-size: 1.5rem; color: darkred" class="fas fa-times"></i></a>
        </div>
        <div class="container cardsfsbody">
            <table id="customers">
                <tr class="">
                    <th>Vraag</th>
                    <th>Antwoord</th>
                    <th>Categorie</th>
                    <th>Level</th>
                    <th>Actions</th>
                </tr>
                @foreach($data as $q)
                    <tr>
                        <td>{{$q->question}}</td>
                        <td>{{$q->answer}}</td>
                        <td>{{$q->category_id}}</td>
                        <td>{{$q->level_id}}</td>
                        <td style="display: inline-flex; width: 100%; position:relative;">
                            <div id="btnEdit" style="height: 100%; width: 15%">
                                <form method="get" action="">
                                    <button type="submit" name="item" value="{{$q->id}}"><i class="fas fa-pencil-alt"></i></button>
                                </form>
                            </div>
                            <div id="btnDelete">
                                <form method="get" action="{{route('noti.cards-del', ['t' => $type])}}">
                                    <button type="submit" name="item" value="{{$q->id}}"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
