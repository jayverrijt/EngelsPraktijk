@extends('admin/layouts/cards-fs')
@section('popupcontent')
    <script>
        document.getElementById('popupContainer').style.display = 'block';
    </script>
    <div class="popup-icon-holder">
        <i class="fas fa-pencil-alt"></i>
    </div>
    <form method="get" action="">
        <div class="popup-text-holder">
            @if($type == 1)
                <input type="text" id="ename" name="ename"/>
                <input type="text" id="eanswer" name="eanswer"/>
                <select name="qlevel" id="elevel">
                    @foreach($levels as $lvl)
                        <option value="{{$lvl->id}}">{{$lvl->level_name}}</option>
                    @endforeach
                </select>
            @elseif($type == 2)
                <input type="text" id="ename" name="ename"/>
                <select name="eansweryn" id="eansweryn">
                    <option value="0">Ja/nee kiezen</option>
                    <option value="1">Ja</option>
                    <option value="2">Nee</option>
                </select>
                <select name="elevel" id="elevel">
                    @foreach($levels as $lvl)
                        <option value="{{$lvl->id}}">{{$lvl->level_name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="popup-btn-holder">
            <button type="submit" name="choise" value="1" style="left: 0">Opslaan</button>
            <button type="submit" name="choise" value="2" style="right: 0">Annuleren</button>
        </div>
    </form>

@endsection
