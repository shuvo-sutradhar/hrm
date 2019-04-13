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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Role</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">

                    {!! Form::model($role, ['method'=>'PATCH','action'=>['RoleController@update',$role->id],'class'=>'form-horizontal form-validation']) !!}

                    @csrf

                        <div class="block block-rounded block-bordered">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                                <div class="block-options">
                                    <button type="submit" class="btn-block-option">
                                        <i class="fa fa-fw fa-check"></i> Submit
                                    </button>
                                    <button type="reset" class="btn-block-option">Reset</button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-8">
                                        <div class="form-group">
                                            {!! Form::label('name','Name') !!}

                                            {{ Form::text('name',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Role Name']) }}

                                            {!! $errors->first('name','<p class="invalid-feedback">:message</p>') !!}

                                        </div>
                                        <div class="form-group">

                                            {!! Form::label('name','Permissions') !!}

                                            {!! Form::select('permissions[]',$permissions ,old('permissions')??$role->permissions->pluck('name','name'), ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','multiple'] : ['class' => 'form-control','multiple']) !!}


                                            {!! $errors->first('permissions','<p class="invalid-feedback">:message</p>') !!}


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
