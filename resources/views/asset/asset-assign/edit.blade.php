@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Assign Asset To Employee</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-lg-6 col-md-6">


                    {!! Form::model($assetAssignment, ['method'=>'PUT','action'=>['AssetAssignmentController@update',$assetAssignment->id], 'class'=>'form-horizontal form-validation']) !!}
                    @csrf


                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-12">
                                        <div class="form-group">
                                            <label for="block-form-permission">Employee*</label>

                                            {!! Form::select('employee_id',[''=>'Choose Employee'] + $employees,null,['class'=>'form-control','required' =>'required', 'id'=>'block-form-permission']) !!}

                                            @if ($errors->has('employee_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            {{-- <label for="block-form-module">Leave name</label> --}}
                                            <div class="responsive">
                                                <table class="table table-bordered" id="dynamic_field">  
                                                    <thead style="background: #f5f5f5;text-align: center;">
                                                        <tr>
                                                            <th>Equipment</th>
                                                            <th>Add Field</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center">  
                                                            <td>
                                                                {!! Form::select('equipment_id[]',[''=>'Choose Equipment'] + $equipments,null,['class'=>'form-control','required' =>'required', 'id'=>'block-form-permission0']) !!}
                                                                @if ($errors->has('equipment_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('equipment_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </td>  
                                                            <td class="text-center">
                                                                <button type="button" name="add" id="addRow" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                            </td>  
                                                        </tr>  
                                                    </tbody>
                                                </table>    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-permission5">Description(optional)</label>

                                            {!! Form::textarea('details',null,['rows'=>3,'class'=>'form-control', 'id'=>'block-form-permission5']) !!}

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
    
    <script src="{{ asset('admin-assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>





    <script type="text/javascript">
        var i=1;
        $('#addRow').on('click',function(){
            
            addRow(i);
            i++;
        });

        function addRow(i) {


            var tr = '<tr class="text-center" id="removeRow'+i+'">'+  
                        '<td rows['+i+']>'+
                            '{!! Form::select('equipment_id[]',[''=>'Choose Equipment'] + $equipments,null,['class'=>'form-control','required' =>'required', 'id'=>'block-form-permission']) !!}'+
                        '</td>'+ 
                        '<td class="text-center">'+
                            '<button type="button" name="add" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>'+
                        '</td> '+  
                    '</tr>';
   
            $('tbody').append(tr);
        };
        $('tbody').on('click','.remove',function(){
            var button_id = $(this).attr("id");   
            $('#removeRow'+button_id+'').remove(); 
        });
    </script>

@endsection
