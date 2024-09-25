@extends('layouts.landing')

@section('register')
    <div class="registerContainer">
        <h2 style="color: #bd0926">Join!</h2>
        <button type="button" name="regMail" class="button-pill" content="Email"><a href="/register">Register with Email</a></button>
    </div>
@endsection
@section('login')
    <div class="loginContainer">
        <h2 style="color:#bd0926 " >Sign In!</h2>
        <button type="button" name="Loginbtn" class="button-pill" content="Inloggen"><a href="/login">Log In</a></button>
    </div>
@endsection

