@extends('layouts.app')


@section('page-content')

        <div id="page-container">
            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('admin-assets/media/photos/photo22@2x.jpg');">
                    <div class="row no-gutters bg-primary-op">
                        <!-- Main Section -->
                        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                            <div class="p-3 w-100">
                                <!-- Header -->
                                <div class="mb-3 text-center">
                                    <a class="link-fx font-w700 font-size-h1" href="{{url('/')}}">
                                        <span class="text-dark">SAS-</span><span class="text-primary">HRM</span>
                                    </a>
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                                </div>
                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">
                                        <form class="js-validation-signin" action="{{route('login')}}" method="post">
                                            @csrf
                                            <div class="py-3">
                                                <div class="form-group">

                                                    <input placeholder="User email" id="email" type="email" class="form-control-lg form-control-alt form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <input id="password" type="password" class="form-control-lg form-control-alt form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary" onclick="Dashmix.loader('show', 'bg-primary');
                                                setTimeout(function () {
                                                    Dashmix.loader('hide');
                                                }, 3000);">
                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                                </button>
                                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('password.request') }}">
                                                            <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Forgot password
                                                        </a>
                                                    @endif
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{route('register')}}">
                                                        <i class="fa fa-plus text-muted mr-1"></i> New Account
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                        <!-- END Main Section -->

                        <!-- Meta Info Section -->
                        <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                            <div class="p-3">
                                <p class="display-4 font-w700 text-white mb-3">
                                    Welcome to the future
                                </p>
                                <p class="font-size-lg font-w600 text-white-75 mb-0">
                                    Copyright &copy; <span class="js-year-copy">{{ date('Y') }}</span>
                                </p>
                            </div>
                        </div>
                        <!-- END Meta Info Section -->
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

@endsection