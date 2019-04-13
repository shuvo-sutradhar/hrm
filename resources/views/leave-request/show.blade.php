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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Leave Request From <b>{{ $leaveRequest->employee->name }}</b></h1>
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
            <div class="content" id="dataTable">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block block-rounded block-bordered">
                            <div class="block-header block-header-default ribbon @if($leaveRequest->status==1) ribbon-warning @elseif($leaveRequest->status==2) ribbon-primary @else ribbon-danger @endif ">
                                <div class="ribbon-box text-uppercase">
                                    @if($leaveRequest->status==1) 
                                    Pending..
                                    @elseif($leaveRequest->status==2) 
                                    Accepted
                                    @else 
                                    Rejected
                                    @endif
                                </div>
                                <h3 class="block-title">Leave Request Details</h3>
                                <div class="block-options">
                                    <div class="block-options-item">
                                        <code></code>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content">
                                <table class="table">
                                    
                                    <tbody>
                                        <tr>
                                            <td class="font-w600">
                                                Employee:
                                            </td>
                                            <td class=" d-sm-table-cell">
                                                <a href="{{ route('employee.show',$leaveRequest->employee->slug) }}">
                                                {{ $leaveRequest->employee->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-w600">
                                                Leave Category:
                                            </td>
                                            <td class=" d-sm-table-cell">
                                                {{ $leaveRequest->leave->leaveName }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-w600">
                                                Applied On:
                                            </td>
                                            <td class=" d-sm-table-cell">
                                               {{ \Carbon\Carbon::parse($leaveRequest->apply_date)->format('j F, Y') }}
                                                
                                                (<b>{{ \Carbon\Carbon::parse($leaveRequest->apply_date)->format('h:i A') }}</b>)
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-w600">
                                                Leave For:
                                            </td>
                                            <td class=" d-sm-table-cell">
                                               {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('j-F-Y') }}

                                               @if($leaveRequest->end_date)
                                               To
                                               {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('j-F-Y') }}
                                               @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-w600">
                                                Duration:
                                            </td>
                                            <td class=" d-sm-table-cell">
                                               
                                                @if($leaveRequest->duration == 1)

                                                    <em class="text-muted">
                                                        1 Day (8 Hours)
                                                    </em>

                                                @elseif($leaveRequest->duration == 2)
                                                    @php
                                                        $startDate  = date_create($leaveRequest->start_date);
                                                        $endDate    = date_create($leaveRequest->end_date);
                                                        //difference between two dates
                                                        $difference = date_diff($startDate,$endDate);
                                                    @endphp
                                                    <em class="text-muted">{{ $difference->d == 0 ? $difference->d+1 .' Day' : $difference->d+1 . ' Days' }}</em>
                                                @else 
                                                    <em class="text-muted">{{ $leaveRequest->hours == 1 ? $leaveRequest->hours . ' Hour' : $leaveRequest->hours . ' Hours'   }} </em>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>
                                                {{ $leaveRequest->comment ? $leaveRequest->comment : 'No description' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Attachment:</td>
                                            <td>
                                                <a href="{{$leaveRequest->attachment ? '/admin-assets/media/leave/'.$leaveRequest->attachment : '#'}}" target="__blank">
                                                <img width="100" height="100" style="border: 2px solid #999;" src="{{$leaveRequest->attachment ? '/admin-assets/media/leave/'.$leaveRequest->attachment : 'No attachment'}}"> 
                                            </td>
                                        </tr>
                                        @if($leaveRequest->status_change_by)
                                            @php
                                                $approvBy = App\User::findOrFail($leaveRequest->status_change_by);
                                            @endphp
                                            <tr>
                                                <td>Leave Status Changed By:</td>
                                                <td>
                                                    {{$approvBy->name }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Change Status :</td>
                                            <td>
                                                @if($leaveRequest->status == 1)
                                                <a href="{{route('leave-request.status',['status' => 'approve', 'id' => $leaveRequest->id]) }}" class="btn btn-sm btn-primary">
                                                    <i class="far fa-thumbs-up"></i> Approve</a>
                                                <a href="{{route('leave-request.status',['status' => 'reject', 'id' => $leaveRequest->id]) }}" class="btn btn-sm btn-warning"><i class="far fa-window-close"></i> Reject</a>
                                                @else 
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                           Change Status
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-align-primary" x-placement="bottom-end" style="position: absolute; transform: translate3d(-68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item" href="{{route('leave-request.status',['status' => 'pending', 'id' => $leaveRequest->id]) }}">Pending</a>
                                                            @if($leaveRequest->status == 2)
                                                            <a class="dropdown-item" href="{{route('leave-request.status',['status' => 'reject', 'id' => $leaveRequest->id]) }}">Reject</a>
                                                            @else
                                                            <a class="dropdown-item" href="{{route('leave-request.status',['status' => 'approve', 'id' => $leaveRequest->id]) }}">Aprove</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="block block-rounded block-bordered">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Avaliable Leave Request For {{ $leaveRequest->employee->name }}</h3>
                            </div>
                            <div class="block-content">
                                <table class="table table-vcenter">
                                    <tbody>
                                        <tr>
                                            <td class="text-center" scope="row">
                                                Casual Leave 
                                            </td>
                                            <td class="text-center" scope="row">
                                                10
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" scope="row">
                                                Casual Leave 
                                            </td>
                                            <td class="text-center" scope="row">
                                                10
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                url  : "{{ url('award') }}" + '/' + id,
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
