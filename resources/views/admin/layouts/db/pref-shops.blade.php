@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('pref-shops')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Foreign</th>
            <th>s1</th>
            <th>s2</th>
            <th>s3</th>
            <th>s4</th>
            <th>s5</th>
            <th>f1</th>
            <th>f2</th>
            <th>f3</th>
            <th>f4</th>
            <th>f5</th>
            <th>a1</th>
            <th>a2</th>
            <th>a3</th>
            <th>a4</th>
            <th>a5</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->foreign}}</td>
                <td>{{$query->s1}}</td>
                <td>{{$query->s2}}</td>
                <td>{{$query->s3}}</td>
                <td>{{$query->s4}}</td>
                <td>{{$query->s5}}</td>
                <td>{{$query->f1}}</td>
                <td>{{$query->f2}}</td>
                <td>{{$query->f3}}</td>
                <td>{{$query->f4}}</td>
                <td>{{$query->f5}}</td>
                <td>{{$query->a1}}</td>
                <td>{{$query->a2}}</td>
                <td>{{$query->a3}}</td>
                <td>{{$query->a4}}</td>
                <td>{{$query->a5}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>


        @endforeach

    </table>
@endsection
