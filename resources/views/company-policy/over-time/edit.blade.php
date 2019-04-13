@extends('layouts.app')

@section('styles')
  <style>
      .overtimeForm .form-group {
        margin-bottom: 1rem;
        background: #f9f9f95c;
        margin-bottom: 16px;
        padding: 16px;
        border-radius: 5px;
        box-shadow: 0px 0px 69px rgba(134, 134, 134, 0.15);
    }
      .custome-input-border input {
        border-radius: 3px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .input-middle p {
      margin-top: 20px;
      font-weight: bold;
      margin-left: 70px;
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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Overtime Policy</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content">
                <!-- Dynamic Table Full -->
                <div class="content d-flex justify-content-center">
                  <div class="col-md-6">
                      {!! Form::model($overtime, ['method'=>'PUT','action'=>['OverTimePolicyController@update',$overtime->id], 'class'=>'form-horizontal form-validation']) !!}
                      @csrf
                          <div class="block block-rounded block-bordered">
                              <div class="block-header block-header-default block-header-rtl">
                                  <h3 class="block-title">Block Form</h3>
                                  <div class="block-options">
                                      <button type="button" class="btn-block-option">
                                          <i class="si si-settings"></i>
                                      </button>
                                  </div>
                              </div>
                              <div class="block-content">
                                  <div class="row justify-content-center py-sm-3 py-md-5">
                                      <div class="col-sm-10 col-md-10 overtimeForm">
                                          <div class="form-group">
                                              <label for="block-form-permission">Policy Name:</label>
                                              {{ Form::text('name',null,['id'=>'block-form-permission','class'=>'form-control','placeholder'=>'On daily or weekly basis']) }}

                                              @if ($errors->has('name'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                  </span>
                                              @endif

                                          </div>
                                          <div class="form-group">
                                              <label class="d-block">Do you want to pay overtime?</label>
                                              <div class="custom-control custom-radio custom-control-inline">

                                                {!! Form::radio('willPay', '1', false,['class'=>'custom-control-input','id'=>'example-radio-custom-inline1']); !!}

                                                <label class="custom-control-label" for="example-radio-custom-inline1">Yes</label>

                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">

                                                  {!! Form::radio('willPay', '0', false,['class'=>'custom-control-input','id'=>'example-radio-custom-inline2']); !!}

                                                  <label class="custom-control-label" for="example-radio-custom-inline2">No</label>
                                              </div>
                                              
                                              @if ($errors->has('willPay'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('willPay') }}</strong>
                                                  </span>
                                              @endif
                                          </div>

                                          <div class="form-group custome-input-border">
                                                <label>How do you pay overtime?</label>
                                                <div class="custom-control custom-checkbox">

                                                    {!! Form::checkbox('isDay',null, $overtime->isDay ? true : false ,['id'=>'example-checkbox-custom1','class'=>'custom-control-input']) !!}

                                                    <label class="custom-control-label" for="example-checkbox-custom1">After</label>


                                                    {!! Form::number('dayHours',null,['id'=>'block-form-permission7','placeholder'=>'08.00','placeholder'=>'08.00']) !!} Hours in a day

                                                    @if ($errors->has('dayHours'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('dayHours') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="input-middle">
                                                  <p>And / Or</p>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    {!! Form::checkbox('isWeek',null, $overtime->isWeek ? true : false ,['id'=>'example-checkbox-custom2','class'=>'custom-control-input']) !!}

                                                    <label class="custom-control-label" for="example-checkbox-custom2">After</label>

                                                    {!! Form::number('weekHours',null,['id'=>'block-form-permission8','placeholder'=>'40.00']) !!} Hours in a week

                                                    @if ($errors->has('weekHours'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('weekHours') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                @if ($errors->has('overtimeProcess'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('overtimeProcess') }}</strong>
                                                    </span>
                                                @endif
                                          </div>
                                          <div class="form-group custome-input-border">
                                              <label for="block-form-permission9">What is overtime rate?</label>
                                              <div class="custom-control" style="padding-left:0px">
                                                {!! Form::number('rate',null,['id'=>'block-form-permission9','placeholder'=>'1.00']) !!}  per hours

                                                @if ($errors->has('rate'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('rate') }}</strong>
                                                    </span>
                                                @endif
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="block-form-permission10">Comment(Optional):</label>

                                              {!! Form::textarea('comment',null,['id'=>'block-form-permission10','class'=>'form-control','rows'=>3,'placeholder'=>'Comment']) !!}

                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                              <div class="block-content block-content-full block-content-sm bg-body-light text-right">
                                  <button type="reset" class="btn btn-sm btn-light">
                                      <i class="fa fa-repeat"></i> Reset
                                  </button>
                                  <button type="submit" class="btn btn-sm btn-primary">
                                      <i class="fa fa-check"></i> Submit
                                  </button>
                              </div>
                          </div>
                      {!! Form::close() !!}
                  </div>
                </div>
                <!-- END Dynamic Table Full -->
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

     $(document).ready(function(){

        // check is day
        if ($('#example-checkbox-custom1').is(":checked")) {
            $('#block-form-permission7').prop("disabled", false);
        } else {
            $('#block-form-permission7').prop("disabled", true);
        }


        // check is day
        if ($('#example-checkbox-custom2').is(":checked")) {
            $('#block-form-permission8').prop("disabled", false);
        } else {
            $('#block-form-permission8').prop("disabled", true);
        }

    });
     // enable disable input field
    document.getElementById('example-checkbox-custom1').onchange = function() {
        document.getElementById('block-form-permission7').disabled = !this.checked;
    };
    document.getElementById('example-checkbox-custom2').onchange = function() {
        document.getElementById('block-form-permission8').disabled = !this.checked;
    };


  </script>

@endsection