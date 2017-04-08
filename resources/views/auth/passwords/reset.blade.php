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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ url('password/reset') }}" id="reset_password" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="msg">Reset Password</div>
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
                        <input type="password" id="password_confirm" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    @if ($errors->has('password'))
                      <label id="password-confirm-error" class="error" for="password_confirm">{{ $errors->first('password_confirmation') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">RESET PASSWORD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
