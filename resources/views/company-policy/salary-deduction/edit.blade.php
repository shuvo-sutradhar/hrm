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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Salary Deduction Policy</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content">
               <div class="content d-flex justify-content-center">
                  <div class="col-md-6">


                    {!! Form::model($salaryDeduction, ['method'=>'PUT','action'=>['SalaryDeductionPolicyController@update',$salaryDeduction->id], 'class'=>'form-horizontal form-validation']) !!}

                    @csrf
                        <div class="block block-rounded block-bordered">
                           <div class="block-header block-header-default block-header-rtl">
                              <h3 class="block-title">Block Form</h3>
                           </div>
                           <div class="block-content">
                              <div class="row justify-content-center py-sm-3 py-md-5">
                                 <div class="col-sm-10 col-md-10">
                                    <div class="form-group">
                                       <label for="block-form-permission">Policy Name:</label> 
                                       {{ Form::text('policyName',null,['id'=>'block-form-permission','class'=>'form-control','placeholder'=>'Deduction Policy Name Here']) }}

                                        @if ($errors->has('policyName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('policyName') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                       <label class="d-block">Deduction Form:</label> 
                                       @php
                                            $options = [
                                                '1' => 'Deduction From Basic Salary',
                                                '2' => 'Deduction From Gross Salary'
                                            ];

                                            $selected = $salaryDeduction->deductionForm;
                                        @endphp

                                        {!! Form::select('deductionForm', $options, $selected,['class'=>'form-control']) !!}
                                        @if ($errors->has('deductionForm'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deductionForm') }}</strong>
                                            </span>
                                        @endif
                                       <!---->
                                    </div>
                                    <div class="form-group">
                                       <label for="block-form-permission3">Deduction Start After :</label> 

                                       {{ Form::number('deductionAfter',null,['id'=>'block-form-permission3','class'=>'form-control','placeholder'=>'5 Days']) }}
                                       
                                        @if ($errors->has('deductionAfter'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deductionAfter') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                       <label for="block-form-permission4">Deduction Rate Per Day :</label>
                                       {{ Form::number('deductionRate',null,['id'=>'block-form-permission4','class'=>'form-control','placeholder'=>'5 Days']) }}
                                       
                                        @if ($errors->has('deductionRate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deductionRate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                       <label for="block-form-permission5">Comment(Optional):</label> 
                                       {{ Form::textarea('deductionComment',null,['rows'=>3,'id'=>'block-form-permission5','class'=>'form-control','placeholder'=>'Your comment Here']) }}
                                       <!---->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="block-content block-content-full block-content-sm bg-body-light text-right"> <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Update
                              </button>
                           </div>
                        </div>
                    {!! Form::close() !!}
                  </div>
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