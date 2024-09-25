@extends("admin/dashboard")
@section('content')
    <script src="{{asset('js/cms/admins.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/cms/admins.css') }}">
    <div class="yield">
        @yield('content')
    </div>
    <div class="container">
        <div class="locationBar">
            <p style="margin-left: 1%"><a href="{{route('admin.dashboard')}}">Home</a> / Administrators</p>
            <div class="addAdminBtn"><a style="top: 20%; position:absolute;" href="{{route('admin.dashboard-admins-add')}}"><i class="fa fa-regular fa-user-plus"></i> Add Administrator</a></div>
            <div class="elevateAdminBtn" onclick="toggleDropdown()"><a style="top: 20%; cursor: pointer;"><i class="fa fa-solid fa-arrow-up"></i> Elevate User</a></div>
            <div class="unElevateAdminBtn" onclick="toggleUnDropdown()"><a style="top: 20%; cursor: pointer;"><i class="fa fa-solid fa-arrow-down"></i> Undo-Elevation User</a></div>
        </div>
        <div id="dropdown" class="dropmenu away">
            @foreach($users as $user)
                @if($user->type == 1)
                    <form method="get" action="{{route('admin.dashboard-admins-change-elevate', ['id' => $user->id])}}">
                        <button class="dropDownBtnStyle" name="elevateUser" type="submit" value="{{$user->id}}"><p>Elevate {{$user->name}}</p></button>
                        <br>
                    </form>

                @endif
            @endforeach
        </div>
        <div id="undropdown" class="undropmenu away">
            @foreach($users as $user)
                @if($user->type == 2)
                    @if($user->id != Auth::user()->id)
                        <form method="get" action="{{route('admin.dashboard-admins-change-de-elevate', ['id' => $user->id])}}">
                            <button class="dropDownBtnStyle" name="elevateUser" type="submit" value="{{$user->id}}"><p>De-Elevate {{$user->name}}</p></button>
                            <br>
                        </form>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="adminContainer show" id="controlContainer">
            <div class="adminContainerNormal">
                @foreach($users as $user)
                    @if($user->type == 2)
                    @if($user->acctype == 0)
                        <div class="adminCard">
                            <div class="cardHeader">
                                <p style="left: 2%; position:absolute;">Account details</p>
                            </div>
                            <div class="cardBody">
                                <div class="cardIcon" style="text-align: center; font-size:3em;">
                                    <i style="color: #007bff" class="fas fa-user-shield"></i>
                                </div>
                                <div class="cardContext">
                                    <div class="cardContextName">
                                        <p style="margin: 0; top: 20%; font-size: 1.2rem; font-weight: 600; left: 2%; position:absolute;">{{$user->name}}</p>
                                        <form action="{{route('admin.dashboard-admins-change-name', ['id' => $user->id])}}">
                                            <button class="buttonStyle changeButtoncard" name="{{$user->id}}" type="submit"><p style="font-size: 1rem; left: 10%; position:relative;">Change</p></button>
                                        </form>
                                    </div>
                                    <div class="cardContextMail">
                                        <p style="font-size: 1rem; font-weight: 400; left: 2%; position:absolute;">{{$user->email}}</p>
                                        <form action="{{route('admin.dashboard-admins-change-email', ['id' => $user->id])}}">
                                            <button class="buttonStyle changeButtoncard" name="{{$user->id}}" type="submit"><p style="font-size: 1rem; left: 10%; position:relative;">Change</p></button>
                                        </form>
                                    </div>
                                    <div class="cardContextChange">
                                    </div>
                                    <div class="cardContextChangePass">
                                        <form action="{{route('admin.dashboard-admins-change-password', ['id' => $user->id])}}">
                                            <button class="buttonStyle" name="{{$user->id}}" type="submit" style="font-size: 1rem; font-weight: 400; left: 2%;bottom: 2%; position:absolute; color: #007bff"><p>Change password</p></button>
                                        </form>
                                    </div>
                                    <div class="cardContextDelete">
                                        <form action="{{route('admin.dashboard-admins-delete', ['id' => $user->id])}}">
                                            <button class="buttonStyle" name="{{$user->id}}" type="submit" style="font-size: 1rem; font-weight: 400; left: 2%; bottom: 0%; position:absolute; color: darkred"><p>Delete account</p></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif
                @endforeach
            </div>
            <div class="adminContainerSocial">
                @foreach($users as $user)
                    @if($user->type == 2)
                    @if($user->acctype == 1)
                        <div class="adminCard">
                            <div class="cardHeader">
                                <p style="left: 2%; position:absolute;">Account details</p>
                            </div>
                            <div class="cardBody">
                                <div class="cardIcon" style="text-align: center; font-size:3em;">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="cardContext">
                                    <div class="cardContextName">
                                        <p style="margin: 0; top: 20%; font-size: 1.0rem; font-weight: 600; left: 2%; position:absolute;">{{$user->name}}</p>
                                    </div>
                                    <div class="cardContextMail">
                                        <p style="font-size: 1rem; font-weight: 400; left: 2%; position:absolute;">{{$user->email}}</p>
                                    </div>
                                    <div class="cardContextChange">
                                    </div>
                                    <div class="cardContextChangePass">
                                        <form method="GET" action="{{route('admin.dashboard-admins-change-unsocial', ['id' => $user->id])}}">
                                            <button class="buttonStyle" name="{{$user->id}}" type="submit" style="font-size: 1rem; font-weight: 400; left: 2%; position:absolute; color: #007bff">Unlink Social Media</button>
                                        </form>
                                    </div>
                                    <div class="cardContextDelete">
                                        <form method="post" action="{{route('admin.dashboard-admins-delete', ['id' => $user->id])}}">
                                            <button class="buttonStyle" name="{{$user->id}}" type="submit" style="font-size: 1rem; font-weight: 400; left: 2%; bottom: 0%; position:absolute; color: darkred"><p>Delete account</p></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif
                @endforeach

            </div>
        </div>
    </div>

@endsection
