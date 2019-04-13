@extends('layouts.app')

@section('styles')

    <style>
        .ui-datepicker-calendar {
            display: none;
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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Performance</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">


                    {!! Form::open(['method'=>'POST','action'=>'AwardController@store', 'class'=>'form-horizontal form-validation','files'=>true]) !!}
                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;margin-bottom-left-radius:0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <label for="block-form-permission">Employee <span>*</span></label>
                                        
                                            {!! Form::select('employee_id',[''=>'test']+$employees,null,['class' => 'js-select2 form-control','id'=>'xample-select2','data-placeholder'=>'Choose one..']) !!}

                                            @if ($errors->has('employee_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Award Type <span>*</span></label>
                                        
                                            {!! Form::select('award_type_id',[''=>'test']+$awardTypes,null,['class' => 'js-select2 form-control','id'=>'xample-select3','data-placeholder'=>'Choose one..']) !!}

                                            @if ($errors->has('award_type_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('award_type_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
              
                                        <div class="form-group">
                                            <label for="block-form-permission">Gift: <span>*</span></label>
                                            {{ Form::text('gift',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Gift']) }}

                                            @if ($errors->has('gift'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gift') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Amount: <span>*</span></label>
                                            {{ Form::number('amount',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Amount']) }}

                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">

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
                                        <div class="form-group">

                                            <label for="block-form-permission">Year: <span>*</span></label>
                                            {!! Form::selectRange('year', $today->year, 2010,$today->year,['class'=>'form-control']) !!}

                                            @if ($errors->has('year'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Gift Image: <span>*</span></label>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="example-file-input-custom" name="award_img">
                                                
                                                <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                            </div>

                                            @if ($errors->has('award_img'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('award_img') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Description(Optional)</label>
                                            {{ Form::textarea('description',null,['rows'=>3,'class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Description']) }}
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

    <script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'MM yy',
                onClose: function(dateText, inst) { 
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
        });
    </script>
@endsection