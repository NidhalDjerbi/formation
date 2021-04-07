@extends('layouts.app-auth')
@section('content')
    <div class="register-box">
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ url('register_user') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input placeholder="Full name" id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input placeholder="Login" id="login" type="text"
                               class="form-control @error('login') is-invalid @enderror"
                               name="login" value="{{ old('login') }}" required autocomplete="login">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input placeholder="Password" id="password" type="password"
                               class="form-control @error('mdp') is-invalid @enderror" name="mdp"
                               required autocomplete="new-password">
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
                    <div class="input-group mb-3">
                        <input placeholder="Password confirm" id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit"
                                class="btn btn-primary btn-block">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </form>
                <div class="social-auth-links text-center mb-3">
                    <p class="mb-0">
                        <a href="{{'/'}}" class="text-center">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection