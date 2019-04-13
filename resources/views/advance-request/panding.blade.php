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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Pending Advance Salary Requests</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('advance-request.create') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-plus mr-1"></i>
                               Add New
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content" id="dataTable">
                @if(count($advanceRequests) > 0)
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Advance Salary Request Table</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th>Sl-No</th>
                                    <th>Employee</th>
                                    <th>Apply Date</th>
                                    <th>Request Amount</th>
                                    <th>Salary Request For</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 0 @endphp
                                @foreach($advanceRequests as $advanceRequest)
                                @php $count++ @endphp
                                    <tr>

                                        <td>{{ $count }} </td>
                                        <td>{{ ucfirst($advanceRequest->employee->name) }} </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($advanceRequest->apply_date)->format('j F, Y') }}
                                            <br>
                                            {{ \Carbon\Carbon::parse($advanceRequest->apply_date)->format('h:i A') }}
                                            <br>
                                        </td>
                                        <td>{{ ucfirst($advanceRequest->request_amount) }} </td>
                                        <td>
                                            @php
                                                $monthName = date("F", mktime(0, 0, 0, $advanceRequest->month, 10));
                                            @endphp
                                            <span class="badge-primary badge">{{ ucfirst($monthName) }} / {{ $advanceRequest->year }}</span>
                                        </td>
                                        <td>

                                            @if($advanceRequest->status == 1)
                                                <span class="badge badge-pill badge-warning">Pending</span>
                                            @elseif($advanceRequest->status == 2)
                                                <span class="badge badge-pill badge-info">Accepted</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Rejected</span>
                                            @endif

                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">

                                                  <a href="{{ route('advance-request.show',$advanceRequest->id) }}" class="btn btn-sm btn-primary js-tooltip-enabled text-light" title="View" data-original-title="View">
                                                    <i class="fa fa-eye"></i>
                                                  </a>

                                                  <a href="{{ route('advance-request.edit',$advanceRequest->id) }}" class="btn btn-sm btn-warning js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                      <i class="fa fa-pencil-alt"></i>
                                                  
                                                  </a>
                                                  <a href="#" onclick="deleteData(event,{{ $advanceRequest->id }})" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                      <i class="fa fa-times"></i>
                                                  </a>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 col-md-12 d-flex justify-content-end">
                                  {{ $advanceRequests->links() }}
                            </div>
                         </div>
                    </div>
                </div>
                @else
                  <h1 class="text-center">Advance Salary Request Empty.</h1>
                @endif
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
        let dataTable = document.getElementById('dataTable');
        //window.table1 = table1;

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
                url  : "{{ url('advance-request') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token },
                cache: false,
                success: function (data) {
                    $("#dataTable").load(location.href + " #dataTable"); 
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
