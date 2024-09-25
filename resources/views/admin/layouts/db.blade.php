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
                <h2 id="addContHead">Applicaton Data</h2>
            </div>
            <form method="get" action="{{route('admin.dashboard-db-view')}}">
                <div class="container-body">
                    <div class="flexrow">
                        <div class="input-group">
                            <div class="input-group-icon">
                                <i class="fas fa-server" style="font-size: 1.2rem"></i>
                            </div>
                            <div class="input-group-input" style="width: 25%; cursor:pointer;">
                                <select type="submit" class="inputStyle" id="selected-action" name="action" style="color: #bd0926; background-color: #ececf6; border-radius: 10px; cursor:pointer; border: solid 1px #d8dee0">
                                    <option value="0" selected disabled>Select an table</option>
                                    <option value="borrowext">Borrow Extensions</option>
                                    <option value="borrowlist">Borrow List</option>
                                    <option value="clothes">Clothes List</option>
                                    <option value="colors">Colors</option>
                                    <option value="continent">Continents</option>
                                    <option value="country">Countries</option>
                                    <option value="friendrequest">Friend Request List</option>
                                    <option value="friends">Friends List</option>
                                    <option value="inyourcolour">In Your Colour</option>
                                    <option value="notification-settings">Notifications Configuration</option>
                                    <option value="notifications">Active Notifications</option>
                                    <option value="pref-shops">Preferred Shops</option>
                                    <option value="sales">Sales List</option>
                                    <option value="province">Subdivisions List</option>
                                    <option value="shops">Shops List</option>
                                    <option value="size-manager">Size Settings</option>
                                    <option value="sizes">Available Sizes</option>
                                    <option value="sold">Sold Items List</option>
                                    <option value="system">System Information per User</option>
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
