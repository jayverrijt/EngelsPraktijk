@extends("admin/dashboard")
@section('content')
    <link rel="stylesheet" href="{{ asset('css/cms/users.css') }}">
    <div class="yield">
        @yield('content')
    </div>
    <div class="container">
        <div class="locationBar">
            <p style="margin-left: 1%"><a href="{{route('admin.dashboard')}}">Home</a> / Users</p>
        </div>
        <div class="locationBody">
            <table id="customers">
                <tr class="">
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Klas</th>
                    <th>Actions</th>
                </tr>
                @foreach($users as $user)
                    @if($user->type == 1)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->class}}</td>
                            <td style="display: inline-flex; width: 100%">
                                <form method="get" action="{{route('admin.dashboard-users-edit', ['id' => $user->id])}}" style="margin-left: 2%">
                                    <button  type="submit" value="{{$user->id}}" class="buttonStyle"><i class="fas fa-pencil-alt"></i></button>
                                </form>
                                <br>
                                <form method="get" action="{{route('admin.dashboard-users-delete', ['id' => $user->id])}}" style="margin-right: 2%; position:relative;">
                                    <button style="background-color: red" type="submit" value="{{$user->id}}" class="buttonStyle"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection
