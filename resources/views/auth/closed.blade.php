@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')

<div class="login-box">
    <div class="logo">
        <a href="{{ route('frontpage') }}">Lobato Coiffeur</a>
        <small>Registration are closed right now.</small>
    </div>
    <div class="card">
        <div class="body">

                <div class="m-t-25 m-b--5 align-center">
                    <h4>Registrations are closed at the moment.</h4>
                    <p>
                        For more info contact the <a href="mailto:lobatocoiffeur@gmail.com?subject=Register" target="_parent">administrator</a>. Or if you already have an account login using the link bellow.
                    </p>
                </div>
                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">Log In</a>
                </div>
        </div>
    </div>
</div>


@endsection