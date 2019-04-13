@extends('layouts.app')

@section('page-content')

    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">


        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('includes.page-header')
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            <!-- Hero -->
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Permission</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">
                    {!! Form::model($permission, ['method'=>'PATCH','action'=>['PermissionController@update',$permission->id],'class'=>'form-horizontal form-validation']) !!}

                    @csrf

                        <div class="block block-rounded block-bordered">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Edit Form</h3>
                                <div class="block-options">
                                    <button type="submit" class="btn-block-option">
                                        <i class="fa fa-fw fa-check"></i> Update
                                    </button>
                                    
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-8">
                                        <div class="form-group">
                                            <label for="block-form-permission">Permission</label>
                                            {{ Form::text('name',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'edit-employee']) }}

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-module">Module</label>
                                            {{ Form::text('module',null,['class'=>'form-control', 'id'=>'block-form-module','placeholder'=>'employee']) }}

                                            @if ($errors->has('module'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('module') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection
