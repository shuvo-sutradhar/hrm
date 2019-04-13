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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Leave Policy</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-lg-10 col-md-12">


                    {!! Form::model($leavePolicy, ['method'=>'PUT','action'=>['LeavePolociController@update',$leavePolicy->id], 'class'=>'form-horizontal form-validation']) !!}
                    @csrf

                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Block Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-12">
                                        <div class="form-group">
                                            <label for="block-form-permission">Leave  Category</label>
                                            {{ Form::text('name',null,['class'=>'form-control','required' =>'required', 'id'=>'block-form-permission','placeholder'=>'Leave Category  (e.g. Leave for employee.)']) }}


                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
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
                                                            <th width="25%">Leave name</th>
                                                            <th width="25%">No. Of days</th>
                                                            <th width="10%">Pay for</th>
                                                            <th width="15%">Need approve</th>
                                                            <th width="15%">Color</th>
                                                            <th width="10%">Add Field</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
		                                                @if(count($leavePolicy->leave) > 0)
		                                                @php $i=0 @endphp
		                                                @foreach($leavePolicy->leave as $leave)
			                                            @php $i++ @endphp
                                                            <input type="hidden" name="rows[{{ $i }}][id]" value="{{ $leave->id }}">
	                                                        <tr class="text-center">  
	                                                            <td>
	                                                                {{ Form::text('rows['.$i.'][leaveName]',$leave->leaveName,['class'=>'form-control name_list','placeholder'=>'Leave Type (like Vacation, Holiday)','required' =>'required']) }}

		                                                              
	                                                                    @if ($errors->has('leaveName'))
	                                                                        <span class="invalid-feedback" role="alert">
	                                                                            <strong>{{ $errors->first('leaveName') }}</strong>
	                                                                        </span>
	                                                                    @endif

	                                                            </td>  
	                                                            <td>
	                                                                {{ Form::number('rows['.$i.'][leaveNumber]',$leave->leaveNumber,['class'=>'form-control name_list','placeholder'=>'Leave Type (like Vacation, Holiday)','required' =>'required']) }}

	                                                                    @if ($errors->has('leaveNumber'))
	                                                                        <span class="invalid-feedback" role="alert">
	                                                                            <strong>{{ $errors->first('leaveNumber') }}</strong>
	                                                                        </span>
	                                                                    @endif
	                                                            </td> 
	                                                            <td>
	                                                                <div style="margin-top: 5px;" class="custom-control custom-switch custom-control-lg mb-2">
	                                                                    
	                                                                    {!! Form::checkbox('rows['.$i.'][payFor]', '1', $leave->payFor == 1?  true : false, ['class' => 'custom-control-input','id'=>'example-sw-custom-lg1'.$i]) !!}
	                                                                    <label class="custom-control-label" for="example-sw-custom-lg1{{ $i }}"></label>
	                                                                </div>
	                                                            </td> 
	                                                            <td>
	                                                                <div style="margin-top: 5px;" class="custom-control custom-switch custom-control-warning custom-control-lg mb-2">

	                                                                    {!! Form::checkbox('rows['.$i.'][isApprove]', '1',  $leave->isApprove == 1?  true : false, ['class' => 'custom-control-input','id'=>'example-sw-custom-warning-lg'.$i]) !!}
	                                                                    <label class="custom-control-label" for="example-sw-custom-warning-lg{{ $i }}"></label>
	                                                                </div>
	                                                            </td>

	                                                            <td>
                                                                    <input value="{!! $leave->color !!}" type="color" name="rows[{!! $i !!}][color]" id="color{{ $i }}">

	                                                                <!-- END Bootstrap Colorpicker -->
	                                                            </td> 
	                                                            
	                                                            <td class="text-center">

                                                                    @if($i == 1)
                                                                        <button type="button" name="add" id="addRow" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                                        @else
                                                                        <button onClick="deleteData(event,{{ $leave->id }})" type="button" name="add" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>
                                                                    @endif
	                                                            </td>  
	                                                        </tr>  
		                                                @endforeach
		                                                @else

	                                                        <tr class="text-center">  
	                                                            <td>
	                                                                {{ Form::text('rows[0][leaveName]',null,['class'=>'form-control name_list','placeholder'=>'Leave Type (like Vacation, Holiday)','required' =>'required']) }}


	                                                                    @if ($errors->has('leaveName'))
	                                                                        <span class="invalid-feedback" role="alert">
	                                                                            <strong>{{ $errors->first('leaveName') }}</strong>
	                                                                        </span>
	                                                                    @endif

	                                                            </td>  
	                                                            <td>
	                                                                {{ Form::number('rows[0][leaveNumber]',null,['class'=>'form-control name_list','placeholder'=>'Leave Type (like Vacation, Holiday)','required' =>'required']) }}

	                                                                    @if ($errors->has('leaveNumber'))
	                                                                        <span class="invalid-feedback" role="alert">
	                                                                            <strong>{{ $errors->first('leaveNumber') }}</strong>
	                                                                        </span>
	                                                                    @endif
	                                                            </td> 
	                                                            <td>
	                                                                <div style="margin-top: 5px;" class="custom-control custom-switch custom-control-lg mb-2">
	                                                                    
	                                                                    {!! Form::checkbox('rows[0][payFor]', '1', true, ['class' => 'custom-control-input','id'=>'example-sw-custom-lg1']) !!}
	                                                                    <label class="custom-control-label" for="example-sw-custom-lg1"></label>
	                                                                </div>
	                                                            </td> 
	                                                            <td>
	                                                                <div style="margin-top: 5px;" class="custom-control custom-switch custom-control-warning custom-control-lg mb-2">

	                                                                    {!! Form::checkbox('rows[0][isApprove]', '1', true, ['class' => 'custom-control-input','id'=>'example-sw-custom-warning-lg2']) !!}
	                                                                    <label class="custom-control-label" for="example-sw-custom-warning-lg2"></label>
	                                                                </div>
	                                                            </td>

	                                                            <td>
	                                                                <input value="#0665D0" type="color" name="rows[0][color]" id="color1">
	                                                                <!-- END Bootstrap Colorpicker -->
	                                                            </td> 
	                                                            
	                                                            <td class="text-center">
	                                                                <button type="button" name="add" id="addRow" class="btn btn-primary"><i class="fa fa-plus"></i></button>
	                                                            </td>  
	                                                        </tr>  
		                                                @endif

                                                    </tbody>
                                                </table>    
                                            </div>
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


@section('scripts')
    
    <script src="{{ asset('admin-assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>





    <script type="text/javascript">
        var i={{ $i }};
        $('#addRow').on('click',function(){
            i++;
            addRow(i);
            
        });

        function addRow(i) {
            var tr = '<tr class="text-center" id="removeRow'+i+'">'+  
                        '<td>'+
                            '<input type="text" name="rows['+i+'][leaveName]" placeholder="Leave Type (like Vacation, Holiday)" class="form-control name_list" required="required">'+
                        '</td>'+  
                        '<td>'+
                            '<input type="number" name="rows['+i+'][leaveNumber]" placeholder="Number of allowed days per year" class="form-control name_list" required="required">'+
                        '</td>'+ 
                        '<td>'+
                            '<div style="margin-top: 5px;" class="custom-control custom-switch custom-control-lg mb-2">'+
                                '<input type="checkbox" class="custom-control-input" id="example-sw-custom-lg1'+i+'" name="rows['+i+'][payFor]" checked="" value="1">'+
                                '<label class="custom-control-label" for="example-sw-custom-lg1'+i+'"></label>'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div style="margin-top: 5px;" class="custom-control custom-switch custom-control-warning custom-control-lg mb-2">'+
                               ' <input type="checkbox" class="custom-control-input" id="example-sw-custom-warning-lg2'+i+'" name="rows['+i+'][isApprove]" checked="" value="1">'+
                                '<label class="custom-control-label" for="example-sw-custom-warning-lg2'+i+'"></label>'+
                            '</div>'+
                        '</td>'+  
                        '<td>'+
                            '<input type="color" name="rows['+i+'][color]" id="color'+i+'" value="#0665D0">'+
                        '</td> ' +
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



        // delete leave
        function deleteData(event,id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({ 
                url  : "{{ url('leaveDestroy') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token },
                cache: false,
                success: function (data) {
                    $("#dynamic_field").load(location.href + " #dynamic_field"); 
                    swal({
                        title: "Delete Done!",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Done",
                    });
                },
                error: function() {
                    swal({
                        title: "Oops...",
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                    })
                }
              });

            } else {
                swal("Your imaginary fill is safe!");
            }
            });
            event.preventDefault(); 
            event.stopPropagation();
        }
    </script>

@endsection
