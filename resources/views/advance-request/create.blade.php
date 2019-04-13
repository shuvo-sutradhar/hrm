@extends('layouts.app')

@section('styles')
        
    <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css">

    <style>
        .input-group.date .input-group-addon {
            cursor: pointer;
            width: 40px;
            background: #ddd;
            text-align: center;
            line-height: 35px;
        }
    </style>
@endsection

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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Request For Advance Salary</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('advance-request.index') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-backward mr-1"></i>
                               Back
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">


                    {!! Form::open(['method'=>'POST','action'=>'AdvanceRequestController@store', 'class'=>'form-horizontal form-validation']) !!}
                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;margin-bottom-left-radius:0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-group">

                                            {!! Form::label('apply_date','Advance Salary Apply Date *') !!}
                                            <div class='input-group date' id='datetimepicker1'>
                                                {!! Form::text('apply_date',null,['class' => 'form-control','id'=>'apply_date','placeholder'=>'Select Date & Time']) !!}
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>

                                            @if ($errors->has('apply_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('apply_date') }}</strong>
                                                </span>
                                            @endif

                                        </div>
        
                                        <div class="form-group">
                                            <label for="xample-select2">Advance Request For <span>*</span></label>
                                        
                                            {!! Form::select('employee_id',[''=>'']+$employees,null,['class' => 'js-select2 form-control','id'=>'xample-select2','data-placeholder'=>'Choose one..']) !!}

                                            @if ($errors->has('employee_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="request_amount">Request Amount<span>*</span></label>
                                        
                                            {!! Form::number('request_amount',null,['class' => 'form-control','id'=>'request_amount']) !!}

                                            @if ($errors->has('request_amount'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('request_amount') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">

                                                @php
                                                    $today = Carbon\Carbon::now();
                                                    $today->month; // retrieve the month
                                                    $today->year; // retrieve the year of the date
                                                @endphp

                                                <label for="block-form-permission">Month: <span>*</span></label>
                                                {!! Form::selectMonth('month',$today->month,['class'=>'form-control']) !!}

                                                @if ($errors->has('month'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('month') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">

                                                <label for="block-form-permission">Year: <span>*</span></label>
                                                {!! Form::selectRange('year', $today->year, 2010,$today->year,['class'=>'form-control']) !!}

                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 


                                        <div class="form-group">
                                            <label for="status">Status <span>*</span></label>
                                        
                                            {!! Form::select('status',['1'=>'Pending','2'=>'Accept','3'=>'Rejected'],null,['class' => 'form-control','id'=>'status']) !!}

                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                 
                                        <div class="form-group">
                                            <label for="comment">Description(Optional)</label>
                                            {{ Form::textarea('comment',null,['rows'=>3,'class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'comment']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="block block-content block-content-full block-content-sm bg-body-light text-right">
                            <button type="reset" class="btn btn-sm btn-light">
                                <i class="fa fa-repeat"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Submit
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


@section('scripts')
    <script src="{{asset('admin-assets/js/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>


    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker(); 
        });
    </script>

@endsection