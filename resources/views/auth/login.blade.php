@extends('layouts.auth_app')
@section('title')
    Login
@endsection
@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger p-0">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="email">Username</label>
                                            <input aria-describedby="emailHelpBlock" id="email" type="text"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email"
                                                   placeholder="Enter E-mail or User Name" tabindex="1"
                                                   value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                                                   autofocus
                                                   required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                                <div class="float-right">
                                                    <a href="{{ route('password.request') }}" class="text-small">
                                                        Forgot Password?
                                                    </a>
                                                </div>
                                            </div>
                                            <input aria-describedby="passwordHelpBlock" id="password" type="password"
                                                   value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                                   placeholder="Enter Password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                                   name="password"
                                                   tabindex="2" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                       tabindex="3"
                                                       id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
