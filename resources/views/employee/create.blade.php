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
            <div class="bg-body-light">
                <div class="content content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">All Employee</h1>
                        
                    </div>
                </div>
            </div>
            <div class="content">
                
                {!! Form::open(['method'=>'POST','action'=>'EmployeeController@store']) !!}
                @csrf

                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create New Employee</h3>
                            <div class="block-options">
                                <button type="reset" class="btn-block-option">Reset</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center py-sm-3 py-md-3">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('name','Name') }}
                                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter employee name.']) !!}

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email','Email') }}
                                        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email.']) !!}

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password','Password') }}
                                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter password.']) !!}
                                        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation','Confirm Password') }}
                                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter password.']) !!}
                                       
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('roles','Select Role *') }}
                                         {!! Form::select('roles[]', Spatie\Permission\Models\Role::get()->pluck('name','name'), null , ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','multiple'] : ['class' => 'form-control','multiple']) !!}
                                                



                                        @if ($errors->has('roles'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif


                                    </div>
                                </div>
                                <!-- end form block -->
                            </div>
                        </div>
                    </div>
                    {{-- <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create New Employee</h3>
                            <div class="block-options">
                                <button type="reset" class="btn-block-option">Reset</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center py-sm-3 py-md-3">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('name','Name') }}
                                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter employee name.']) !!}
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email','Email') }}
                                        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email.']) !!}
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password','Password') }}
                                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter password.']) !!}
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation','Confirm Password') }}
                                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter password.']) !!}

                                    </div>
                                </div>
                                <!-- end form block -->
                            </div>
                        </div>
                    </div> --}}

                    <!-- create new employee start -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Create New <small>Employee</small></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                                    <i class="si si-pin"></i>
                                </button>
                                <button type="reset" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center py-sm-3 py-md-3">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('name','Name') }}
                                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter employee name.']) !!}

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email','Email') }}
                                        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email.']) !!}

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password','Password') }}
                                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter password.']) !!}
                                        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation','Confirm Password') }}
                                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter password.']) !!}
                                       
                                    </div>
                                </div>
                                <!-- end form block -->
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('roles','Select Role *') }}
                                         {!! Form::select('roles[]', Spatie\Permission\Models\Role::get()->pluck('name','name'), null , ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','multiple'] : ['class' => 'form-control','multiple']) !!}
                                                



                                        @if ($errors->has('roles'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif


                                    </div>
                                </div>
                                <!-- end form block -->
                            </div>
                        </div>
                    </div>
                    <!-- create new employee start -->


                    <div class="block block-content block-content-full block-content-sm bg-body-light text-right">
                        <button type="reset" class="btn btn-sm btn-light">
                            <i class="fa fa-repeat"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection

