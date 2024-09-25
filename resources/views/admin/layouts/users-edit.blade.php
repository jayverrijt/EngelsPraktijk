@extends("admin/layouts/admins")
@section("content")
    <form method="get" action="{{route('admin.dashboard-users-edit-update', ['id' => $id])}}">
        <input type="text" name="firstname" value="" placeholder="First Name">
        <input type="text" name="lastname" value="" placeholder="Last Name">
        <input type="text" name="username" value="" placeholder="Username">
        <input type="text" name="email" value="" placeholder="Email">
        <input type="date" name="dob" value="">
        <input type="number" name="phone" value="" placeholder="Phone">
        <select name="gender">
            <option value="0">Select Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
        </select>
        <br>
        <input type="text" name="city" value="" placeholder="City">
        <select name="country">
            <option value="0">Select Country</option>
            @foreach($countrys as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
@endsection
