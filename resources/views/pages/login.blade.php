@extends('layouts.app-auth')
@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form method="POST" action="{{ url('login_user')  }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="login" type="text" class="form-control @error('login') is-invalid @enderror"
                               placeholder="Login"
                               value="{{ old('login') }}" required autocomplete="login" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('login')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                               class="form-control @error('mdp') is-invalid @enderror"
                               name="mdp" required autocomplete="current-password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('mdp')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">  {{ __('Login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{'register_user'}}" class="text-center">Register</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection