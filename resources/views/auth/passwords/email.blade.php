@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div class="login-box">
    <div class="logo">
        <a href="{{ route('frontpage') }}">Lobato Coiffeur</a>
        <small>Reset Password</small>
    </div>
    <div class="card">
        <div class="body">
            <form action="{{ route('password.email') }}" id="reset_password" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <div class="msg">
                    Enter your email address that you used to register. We'll send you an email with your username and a link to reset your password.
                </div>
                @if (session('status'))
                    <div class="alert bg-light-green">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line{{ $errors->has('email') ? ' error' : '' }}">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                      <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                    <button class="btn btn-lg btn-block bg-pink waves-effect" type="submit">SEND RESET LINK</button>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-12 text-center">
                        <a href="{{ route('login') }}">Sign In</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
