@extends('layouts.app')


@section('page-content')
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('assets/media/photos/photo19@2x.jpg');">
                    <div class="hero bg-white-95">
                        <div class="hero-inner">
                            <div class="content content-full">
                                <div class="px-3 py-5 text-center">
                                    <div class="row invisible" data-toggle="appear">
                                        <div class="col-sm-6 text-center text-sm-right">
                                            <div class="display-1 text-danger font-w700">403</div>
                                        </div>
                                        <div class="col-sm-6 text-center d-sm-flex align-items-sm-center">
                                            <div class="display-1 text-muted font-w300">Error</div>
                                        </div>
                                    </div>
                                    <h1 class="h2 font-w700 mt-5 mb-3 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">Oops.. You just found an error page..</h1>
                                    <h2 class="h3 font-w400 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="450">We are sorry but you do not have permission to access this page..</h2>
                                    <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                                        <a href="{{ url('/') }}" class="btn btn-hero-secondary" href="be_pages_error_all.html">
                                            <i class="fa fa-arrow-left mr-1"></i> Back to all Errors
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
@endsection