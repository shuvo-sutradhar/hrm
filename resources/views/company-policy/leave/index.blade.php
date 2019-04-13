@extends('layouts.app')


@section('styles')

  <style type="text/css">
    .swal-footer {
      text-align: center !important;
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
                        <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Leave Policy</h1>
                        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                            <a href="{{ route('leave-policy.create') }}" class="tn btn-hero-lg btn-square btn-hero-primary mr-1 mb-3"><i class="fa fa-fw fa-plus mr-1"></i>
                                Leave Policy
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            @if(count($leavePolicies) > 0)
            <div class="content">
              <div class="row justify-content-center">

                @php $i=0; @endphp
                @foreach($leavePolicies as $leavePolicie)
                @php $i++; @endphp
                  <div class="col-md-12 col-xl-12">
                      <div class="block block-rounded dataTable" id="dataTable">
                          <div class="block-content block-content-full bg-primary-darker text-center">
                              
                              <p class="text-white font-size-h3 font-w300 mt-3 mb-0">
                                  {{ $leavePolicie->name }}
                              </p>
                              <p class="text-white-75 mb-0">
                                  Leave Policy {{ $i }}
                              </p>
                              <p style="margin-top: 10px">
                                <a href="{{ route('leave-policy.edit',$leavePolicie->id) }}">
                                  <button type="button" class="btn btn-hero-sm btn-hero-success">Edit</button>
                                </a>
                                <a href="#" onClick="deleteData(event,{{ $leavePolicie->id }})">
                                  <button type="button" class="btn btn-hero-sm btn-hero-danger">Delete</button>
                                </a>
                              </p>
                          </div>
                          <div class="block-content block-content-full">
                              <table class="table table-borderless table-striped table-hover">
                                  <tbody>
                                      <tr style="background:#EFF2F8">
                                          <td class="text-center">
                                              Leave Name
                                          </td>
                                          <td class="text-center">
                                            Annual Day
                                          </td>
                                          <td class="text-center">
                                              Will Pay
                                          </td>
                                          <td class="text-center">
                                            Need approve
                                          </td>
                                          <td class="text-center">
                                            Color
                                          </td>
                                          <td class="text-center">
                                            Created at
                                          </td>
                                      </tr>
                                      @foreach($leavePolicie->leave as $leave)
                                      <tr>
                                          <td class="text-center">
                                              {{ $leave->leaveName }}
                                          </td>
                                          <td class="text-center">
                                              {{ $leave->annualDay }} Day(s)
                                              
                                          </td>
                                          <td class="text-center">
                                            @if($leave->payFor == 1)
                                              <span class="badge badge-pill badge-info">Yes</span>
                                            @else
                                              <span class="badge badge-pill badge-danger">No</span>
                                            @endif
                                          </td>
                                          <td class="text-center">

                                            @if($leave->isApprove == 1)
                                              <span class="badge badge-pill badge-success">Yes</span>
                                            @else
                                              <span class="badge badge-pill badge-warning">No</span>
                                            @endif
                                          </td>
                                          <td class="text-center">
                                            <span style="width: 30px; height: 30px; background: {{ $leave->color }}; display: block; margin:0 auto"></span>
                                          </td>
                                          <td class="text-center">
                                            {{ $leave->created_at->diffForHumans() }}
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                @endforeach
              </div>

              <div class="col-sm-12 col-md-12 d-flex justify-content-center">
                    {{ $leavePolicies->links() }}
              </div>
            </div>

            @else 
                <h2 style="text-align: center;margin-top: 40px;">No Leave Policy added yet.</h2>
            @endif
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        @include('includes.footer')
        <!-- END Footer -->
    </div>
       
@endsection


<script type="text/javascript">


    let dataTable = document.querySelector('.dataTable');
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
            url  : "{{ url('leave-policy') }}" + '/' + id,
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


