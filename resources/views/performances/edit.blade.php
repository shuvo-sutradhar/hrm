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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Performance</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">


                    {!! Form::model($performance, ['method'=>'PUT','action'=>['PerformanceController@update',$performance->id], 'class'=>'form-horizontal form-validation']) !!}
                    @csrf

                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;margin-bottom-left-radius:0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <label for="block-form-permission">Initial points: <span>*</span></label>
                                            {{ Form::number('initialPoints',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Initial Point']) }}

                                            @if ($errors->has('initialPoints'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('initialPoints') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group m-b-0">
                                            <label class="control-label">Last Inc/Dec points: </label>
                                            <input type="number" class="form-control" name="lastPoints" id="lastPoints" value="{{ $performance->lastPoints}}">

                                            @if ($errors->has('lastPoints'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lastPoints') }}</strong>
                                                </span>
                                            @endif
                                        </div>                                         
                                        <div class="form-group">
                                            <label for="pointAction">Points Action: </label>
                    
                                            <select name="pointAction" class="select2 form-control">
                                                <option value="">Select a Action</option>
                                                <option value="increment">Increment</option>
                                                <option value="decrement">Decrement</option>
                                            </select>

                                            
                                            @if ($errors->has('pointAction'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('pointAction') }}</strong>
                                                </span>
                                            @endif
                                        </div>    
                                        <div class="form-group">
                                            <label for="comment">Description(Optional)</label>
                                            {{ Form::textarea('performanceComment',null,['rows'=>3,'class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Description']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="block block-content block-content-full block-content-sm bg-body-light text-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Update
                            </button>
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