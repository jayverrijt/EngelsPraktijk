@extends('admin.layouts.db')
@section('dbContent')
    @php
        $querys = \DB::table('borrowlist')->get();

    @endphp
    <table id="customers">
        <tr class="">
            <th>ID</th>
            <th>Owner</th>
            <th>Lender</th>
            <th>Status</th>
            <th>Product</th>
            <th>Start</th>
            <th>End</th>
            <th>Actions</th>
        </tr>
        @foreach($querys as $query)
            <tr>
                <td>{{$query->id}}</td>
                <td>{{$query->owner}}</td>
                <td>{{$query->lender}}</td>
                <td>{{$query->status}}</td>
                <td>{{$query->product}}</td>
                <td>{{$query->start}}</td>
                <td>{{$query->end}}</td>
                <td style="display: inline-flex; width: 100%">
                    <form method="get" action="{{route('admin.dashboard-db-view.delete', ['id' => $query->id])}}">
                        <button type="submit" class="buttonStyle" style="background-color: red" name="table" value="{{$val}}"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>

        @endforeach

    </table>
@endsection
