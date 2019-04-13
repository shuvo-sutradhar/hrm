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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Edit Department</h1>
                    </div>
                </div>
            </div>
            <!-- END Hero -->


            <!-- Page Content -->
            <div class="content d-flex justify-content-center">
                <div class="col-md-6">


                    {!! Form::model($department,['method'=>'PATCH','class'=>'form-horizontal form-validation','autocomplete'=>'off','action'=>['DepartmentController@update',$department->slug]]) !!}
                    @csrf


                        <div class="block block-rounded block-bordered" style="margin-bottom: 0px;">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Edit Form</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-8">
                                        <div class="form-group">
                                            <label for="block-form-permission">Department</label>
                                            {{ Form::text('name',null,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'Department Name  (e.g. Sales, Marketing)']) }}

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="block-form-module">Designation</label>
                                            <table  class="table table-bordered" id="dynamic_field">  
                                                <tbody>
                                                @if(count($department->designation) > 0)
                                                    @php $i=0 @endphp
                                                    @foreach($department->designation as $des)
                                                    @php $i++ @endphp
                                                        
                                                        <input type="hidden" name="designationId[]" value="{{ $des->id }}">
                                                        <tr>    
                                                            <td width="90%">
                                                                {{ Form::text('designation[]',$des->name,['class'=>'form-control', 'id'=>'block-form-permission','placeholder'=>'designation']) }}
                                                            </td>  
                                                            <td width="10%" class="text-center">
                                                                @if($i == 1)
                                                                <button type="button" name="add" id="addRow" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                                @else
                                                                <button onClick="deleteData(event,{{ $des->id }})" type="button" name="add" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>
                                                                @endif
                                                            </td>  
                                                        </tr>

                                                    @endforeach
                                                @else
                                                    <tr>  
                                                        <td width="90%">
                                                            <input type="text" name="designation[]" placeholder="Enter designation" class="form-control name_list">
                                                        </td>  
                                                        <td width="10%" class="text-center">
                                                            <button type="button" name="add" id="addRow" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                                        </td>  

                                                        @if ($errors->has('designation'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('designation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </tr>  
                                                @endif
                                                </tbody>
                                            </table>

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
        var i=1;
        $('#addRow').on('click',function(){
            i++;
            addRow(i);
        });

        function addRow(i) {
            var button_id = $(this).attr("id");  

            var tr = '<tr id="removeRow'+i+'">'+
                        '<td width="90%">'+
                            '<input type="text" name="designation[]" placeholder="Enter designation" class="form-control name_list">'+
                            '</td>'+  
                            '<td width="10%" class="text-center">'+
                               ' <button type="button" name="add" id="'+i+'" class="btn btn-danger remove"><i class="fa fa-minus"></i></button>'+
                            '</td>'+  
                        '</tr>';
            $('tbody').append(tr);
        };
        function removeId(id){            
            $('#removeRow'+id+'').remove(); 

        };
        $('tbody').on('click','.remove',function(){
            var button_id = $(this).attr("id");   
            $('#removeRow'+button_id+'').remove(); 
        });


        // delete designaiton
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
                url  : "{{ url('designationDestroy') }}" + '/' + id,
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