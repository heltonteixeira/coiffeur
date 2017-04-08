@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')

<div class="login-box">
    <div class="logo">
        <a href="{{ route('frontpage') }}">Lobato Coiffeur</a>
        <small>Register a new Account</small>
    </div>
    <div class="card">
        <div class="body">
            <form action="{{ route('register') }}" id="sign_in" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <div class="msg">Register for a new account</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line{{ $errors->has('name') ? ' error' : '' }}">
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                      <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line{{ $errors->has('email') ? ' error' : '' }}">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                      <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line{{ $errors->has('password') ? ' error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    @if ($errors->has('password'))
                      <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>
                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">You already have a account?</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection