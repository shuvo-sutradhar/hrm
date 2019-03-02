@extends('layouts.app')


@section('page-content')

        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('../admin-assets/media/photos/photo19@2x.jpg');">
                    <div class="row no-gutters bg-gd-sun-op">
                        <!-- Main Section -->
                        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                            <div class="p-3 w-100">
                                <!-- Header -->
                                <div class="text-center">
                                    <a class="link-fx text-warning font-w700 font-size-h1" href="{{route('login')}}">
                                        <span class="text-dark">SAS-</span><span class="text-warning">HRM</span>
                                    </a>
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Password Reminder</p>
                                </div>
                                <!-- END Header -->

                                <!-- Reminder Form -->
                                <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->


                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">

                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form class="js-validation-reminder" action="{{ route('password.email') }}" method="post">
                                            @csrf
                                            <div class="form-group py-3">
                                                
                                                <input placeholder="Email" id="email" type="email" class="form-control-lg form-control-alt form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-warning">
                                                    <i class="fa fa-fw fa-reply mr-1"></i> Password Reminder
                                                </button>
                                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{route('login')}}">
                                                        <i class="fa fa-sign-in-alt text-muted mr-1"></i> Sign In
                                                    </a>
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{route('register')}}">
                                                        <i class="fa fa-plus text-muted mr-1"></i> New Account
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Reminder Form -->
                            </div>
                        </div>
                        <!-- END Main Section -->

                        <!-- Meta Info Section -->
                        <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                            <div class="p-3">
                                <p class="display-4 font-w700 text-white mb-0">
                                    Don’t worry of failure..
                                </p>
                                <p class="font-size-h1 font-w600 text-white-75 mb-0">
                                    ..but learn from it!
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