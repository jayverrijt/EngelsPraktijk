@extends('admin.layouts.db')
@section('dbContent')
    @php
    $querys = \DB::table('borrowext')->get();
    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Foreign</th>
            <th>Text</th>
            <th>Date</th>
            <th>Owner</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->foreign}}</td>
                <td>{{$query->text}}</td>
                <td>{{$query->date}}</td>
                <td>{{$query->owner}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
        @endforeach

    </table>
@endsection
