@extends('layouts.auth_app')
@section('title')
    Register
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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div id="error" style="display:none;" class="alert alert-danger"></div><br/>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="first_name">First Name:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="first_name" type="text"
                                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                           name="first_name"
                                                           tabindex="1" placeholder="Enter First Name" value="{{ old('first_name') }}"
                                                           autofocus required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('first_name') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="last_name" type="text"
                                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                           name="last_name"
                                                           tabindex="2" placeholder="Enter Last Name" value="{{ old('last_name') }}"
                                                           autofocus required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('last_name') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="email">Email:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="email" type="email"
                                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Email address" name="email" tabindex="3"
                                                           value="{{ old('email') }}"
                                                           required autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="username">Username:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="username" type="text"
                                                           class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Username" name="username" tabindex="4"
                                                           value="{{ old('username') }}"
                                                           required autofocus>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('username') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">Password
                                                        :</label><span
                                                        class="text-danger">*</span>
                                                    <input id="password" type="password"
                                                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                                           placeholder="Set account password" name="password" tabindex="5" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="password_confirmation"
                                                           class="control-label">Confirm Password:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="password_confirmation" type="password" placeholder="Confirm account password"
                                                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                                           name="password_confirmation" tabindex="6">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="tenant"
                                                           class="control-label">Tenant:</label><span
                                                        class="text-danger">*</span>
                                                    <input id="tenant" type="text" placeholder="Tenant"
                                                           class="form-control{{ $errors->has('tenant') ? ' is-invalid': '' }}"
                                                           name="tenant" tabindex="7">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('tenant') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="8">
                                                        Register
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="text-muted text-center ml-3">
                                                Already have an account ? <a
                                                    href="{{ route('login') }}">SignIn</a>
                                            </div>
                                        </div>
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
