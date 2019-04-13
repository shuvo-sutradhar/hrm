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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Asset Type</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">


                    {!! Form::model($equipment, ['method'=>'PUT','action'=>['EquipmentController@update',$equipment->id], 'class'=>'form-horizontal form-validation']) !!}

                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;margin-bottom-left-radius:0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-group">
                                            <label for="block-form-permission">Name <span>*</span></label>
                                            {{ Form::text('name',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Type name (Computer, Printer)']) }}

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Asset Type <span>*</span></label>
                                        

                                            {!! Form::select('asset_type_id',$assetType,null,['class' => 'form-control']) !!}

                                            @if ($errors->has('asset_type_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('asset_type_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Model <span>*</span></label>
                                            {{ Form::text('model',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Model']) }}

                                            @if ($errors->has('model'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('model') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission">Serial No <span>*</span></label>
                                            {{ Form::text('serial_no',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Serial No']) }}

                                            @if ($errors->has('serial_no'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('serial_no') }}</strong>
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