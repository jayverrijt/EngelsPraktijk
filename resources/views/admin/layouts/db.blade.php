@extends("admin/dashboard")
@section('content')
    <link rel="stylesheet" href="{{asset('css/cms/db.css')}}">
    <div class="container">
        <div class="locationBar">
            <p style="margin-left: 1%"><a href="{{route('admin.dashboard')}}">Home</a> / Database</p>
        </div>
    </div>
    <div class="locationBody">
        <div class="containerAddBody">
            <div class="containerAddBodyHead">
                <h2 id="addContHead" style="color: #2e3440">Applicaton Data</h2>
            </div>
            <form method="get" action="{{route('admin.dashboard-db-view')}}">
                <div class="container-body">
                    <div class="flexrow">
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fas fa-server" style="font-size: 1.2rem; color: #2e3440"></i>
                            </div>
                            <div class="input-group-input" style="width: 25%; cursor:pointer;">
                                <select type="submit" class="inputStyle" id="selected-action" name="action" style="color: #2e3440; background-color: #ececf6; border-radius: 10px; cursor:pointer; border: solid 1px #d8dee0">
                                    <option value="0" selected disabled>Select an table</option>
                                    <option value="users">Users List</option>
                                </select>
                            </div>
                            <div class="input-group-submit">
                                <button type="submit" class="buttonInput"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="dbHolder">
            @yield('dbContent')
        </div>

    </div>

@endsection
