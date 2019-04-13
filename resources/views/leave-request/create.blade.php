@extends('layouts.app')

@section('styles')
    

        
<link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css">

    <style>
        .single-day,
        .hours,
        .multiple-days{
            display: none;
        }

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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Request For Leave</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('leave-request.index') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-backward mr-1"></i>
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


                    {!! Form::open(['method'=>'POST','action'=>'LeaveRequestController@store', 'class'=>'form-horizontal form-validation','files'=>true]) !!}
                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;margin-bottom-left-radius:0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-group">

                                            {!! Form::label('apply_date','Leave Apply Date *') !!}
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
                                            <label for="xample-select2">Employee <span>*</span></label>
                                        
                                            {!! Form::select('employee_id',[''=>'test']+$employees,null,['class' => 'js-select2 form-control','id'=>'xample-select2','data-placeholder'=>'Choose one..']) !!}

                                            @if ($errors->has('employee_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="xample-select3">Leave Category <span>*</span></label>
                                        
                                            {!! Form::select('leave_id',[''=>'test']+$leaves,null,['class' => 'js-select2 form-control','id'=>'xample-select3','data-placeholder'=>'Choose one..']) !!}

                                            @if ($errors->has('leave_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('leave_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="example-radio-custom-inline1">Duration <span>*</span></label>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio custom-control-inline">

                                                    {!! Form::radio('duration',1,false,['class'=>'custom-control-input','id'=>'example-radio-custom-inline1']) !!}

                                                    {!! Form::label('example-radio-custom-inline1','Single Day',['class'=>'custom-control-label']) !!}
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    {!! Form::radio('duration',2,false,['class'=>'custom-control-input','id'=>'example-radio-custom-inline2']) !!}

                                                    {!! Form::label('example-radio-custom-inline2','Multiple Days',['class'=>'custom-control-label']) !!}
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    {!! Form::radio('duration',3,false,['class'=>'custom-control-input','id'=>'example-radio-custom-inline3']) !!}

                                                    {!! Form::label('example-radio-custom-inline3','Hours',['class'=>'custom-control-label']) !!}
                                                </div>
                                            </div>

                                            @if ($errors->has('duration'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('duration') }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                        <div class="form-row ">

                                            <div class="form-group single-day">

                                                {!! Form::label('start_date','Start Date *') !!}
                                                <div class='input-group date' id='datetimepicker2'>
                                                    {!! Form::text('start_date',null,['class' => 'form-control','id'=>'start_date','data-date-format'=>'DD MMMM YYYY']) !!}
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group col-sm-2 hours">
                                                {!! Form::label('hours','Hours *') !!}

                                                {!! Form::selectRange('hours',1,8,null,['class' => 'form-control','id'=>'hours']) !!}
                                            </div>
                                            @if ($errors->has('start_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('hours'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('hours') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group multiple-days">
                                            {!! Form::label('start_date2','Select Date *') !!}
                                            <div class="input-daterange input-group js-datepicker-enabled">
                              

                                                {!! Form::text('from',null,['class' => 'form-control','id'=>'startDate','placeholder'=>'From','data-date-format'=>'DD MMMM YYYY']) !!}
                                                <div class="input-group-prepend input-group-append">
                                                    <span class="input-group-text font-w600">
                                                        <i class="fa fa-fw fa-arrow-right"></i>
                                                    </span>
                                                </div>
                                                {{-- <input type="text" class="form-control" id="endDate" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true"> --}}
                                                {!! Form::text('to',null,['class' => 'form-control','id'=>'endDate','placeholder'=>'To','data-date-format'=>'DD MMMM YYYY']) !!}
                                            </div>

                                            @if ($errors->has('from'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('from') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('to'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('to') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="example-file-input-custom">Attachment(Optional): <span></span></label>

                                            <div class="custom-file">

                                                <input type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="example-file-input-custom" name="attachment">
                                                
                                                <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                            </div>

                                            @if ($errors->has('attachment'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('attachment') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="comment">Description(Optional):</label>
                                            {{ Form::textarea('reason',null,['rows'=>3,'class'=>'form-control', 'id'=>'comment','placeholder'=>'Description']) }}
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
        // date time calender for apply_date and start date
        $(function () {
            $('#datetimepicker1').datetimepicker(); 
            // $('#datetimepicker2').datetimepicker({
            //     format: 'MM/DD/YYYY',
            // }); 
            $('#datetimepicker2').datetimepicker({
                format: 'MM/DD/YYYY',
            }); 
        });
        // date time calender ranger From To
        $(function () {
            var sd = new Date();ed = new Date();
          
            $('#startDate').datetimepicker({ 
              format: 'MM/DD/YYYY',
            });
          
            $('#endDate').datetimepicker({ 
             format: 'MM/DD/YYYY', 
            });

            //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
            //bindDateRangeValidation($("#form"), 'startDate', 'endDate');
        });

        
        $('#example-radio-custom-inline1').on('change',function() {
            if( $('#example-radio-custom-inline1').is(':checked') ) {
                $('.single-day').css('display','block');
                $('.multiple-days').css('display','none');
                $('.hours').css('display','none');
                //
                $('.single-day').removeClass('col-sm-10');
                $('.single-day').addClass('col-sm-12');
            }
        });
        $('#example-radio-custom-inline2').on('change',function() {
            if( $(this).is(':checked') ) {
                $('.multiple-days').css('display','block');
                $('.single-day').css('display','none');
                $('.hours').css('display','none');
            }
        });
        $('#example-radio-custom-inline3').on('change',function() {
            if( $(this).is(':checked') ) {
                $('.single-day').css('display','block');
                $('.hours').css('display','block');
                $('.multiple-days').css('display','none');
                //
                $('.single-day').removeClass('col-sm-12');
                $('.single-day').addClass('col-sm-10');
            }
        });

        if ($("#example-radio-custom-inline1").is(":checked")) {
            $('.single-day').css('display','block');
            //
            $('.single-day').removeClass('col-sm-10');
            $('.single-day').addClass('col-sm-12');
        }
        if ($("#example-radio-custom-inline2").is(":checked")) {
            $('.multiple-days').css('display','block');
        }
        if ($("#example-radio-custom-inline3").is(":checked")) {

                $('.single-day').css('display','block');
                $('.hours').css('display','block');
                //
                $('.single-day').removeClass('col-sm-12');
                $('.single-day').addClass('col-sm-10');
        }
    </script>

@endsection